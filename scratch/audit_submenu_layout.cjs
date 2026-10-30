// Browser-based layout audit. Uses Chrome's built-in debugging protocol.
const fs = require('node:fs');
const path = require('node:path');
const {spawn} = require('node:child_process');
const sleep = ms => new Promise(r => setTimeout(r, ms));
const samples = ['faculte-de-droit', 'faculte-de-philosophie', 'faculte-des-humanites-lettres-et-societes-1', 'faculte-des-langues', 'cycle-master', 'cycle-bts', 'recherche-management-gouvernance', 'campus-de-bourg-en-bresse', 'bibliotheques-universitaires-3', 'finance-controle-audit-comptabilite', 'histoire', 'formations'];
const mode = process.argv[2] || 'before';
const all = process.argv.includes('--all');
const mobile = process.argv.includes('--mobile');
const references = process.argv.includes('--reference');
const port = mobile ? 9345 : 9344;
const retry = process.argv.includes('--retry');
const reportFile = `scratch/submenu-layout-${mode}${mobile?'-mobile':''}${references?'-reference':''}.json`;
const previous = retry ? JSON.parse(fs.readFileSync(reportFile, 'utf8')) : [];
(async () => {
  const chrome = spawn('C:/Program Files/Google/Chrome/Application/chrome.exe', ['--headless=new', '--disable-gpu', '--no-first-run', '--remote-debugging-port='+port, `--user-data-dir=${path.resolve('storage/app/chrome-submenus'+(mobile?'-mobile':''))}`, 'about:blank'], {windowsHide: true, stdio: 'ignore'});
  let target;
  for(let n=0;n<75;n++) {
    try {target=(await (await fetch('http://127.0.0.1:'+port+'/json')).json()).find(t=>t.type==='page'); if(target) break;} catch {}
    await sleep(200);
  }
  if(!target) {chrome.kill(); throw Error('Chrome did not start');}
  const socket = new WebSocket(target.webSocketDebuggerUrl);
  await new Promise(r=>socket.onopen=r);
  let id=0;
  const pending=new Map();
  socket.onmessage=e=>{const m=JSON.parse(e.data);if(pending.has(m.id)){pending.get(m.id)(m);pending.delete(m.id);}};
  function send(method,params={}) {return new Promise((resolve,reject)=>{
    const next=++id;
    const timer=setTimeout(()=>{pending.delete(next);reject(Error(method+' timed out'));},20000);
    pending.set(next,m=>{clearTimeout(timer);m.error?reject(Error(JSON.stringify(m.error))):resolve(m.result);});
    socket.send(JSON.stringify({id:next,method,params}));
  });}
  await send('Page.enable');
  await send('Network.enable');
  if(retry) await send('Network.setCacheDisabled',{cacheDisabled:true});
  await send('Emulation.setDeviceMetricsOverride',{width:mobile?390:1440,height:1000,deviceScaleFactor:1,mobile});
  const pages=retry?previous.filter(p=>!p.areas.some(a=>a.id==='page_deco')).map(p=>p.slug):references?['https://facdedroit.univ-lyon3.fr/','https://www.univ-lyon3.fr/faculte-de-philosophie','https://www.univ-lyon3.fr/finance-controle-audit-comptabilite','https://www.univ-lyon3.fr/histoire']:all?fs.readdirSync('html_static').filter(f=>f.endsWith('.html')).map(f=>f.slice(0,-5)):samples;
  const report=[];
  try {
    for(let n=0;n<pages.length;n++) {
      const slug=pages[n];
      await send('Page.navigate',{url:references?slug:'http://insg-gabon2.test/'+encodeURI(slug)});
      for(let attempt=0;attempt<60;attempt++) {
        await sleep(references?250:50);
        const status=await send('Runtime.evaluate',{expression:'document.readyState',returnByValue:true});
        if(status.result.value==='complete')break;
      }
      if(!references) await send('Runtime.evaluate',{expression:'document.fonts.ready.then(() => true)',awaitPromise:true,returnByValue:true});
      if(!all||samples.includes(slug)) await sleep(900);
      const data=await send('Runtime.evaluate',{expression:`JSON.stringify((()=>{
        const measure=e=>{const r=e.getBoundingClientRect(),s=getComputedStyle(e);return {id:e.id,class:e.className,x:Math.round(r.x),y:Math.round(r.y),w:Math.round(r.width),h:Math.round(r.height),display:s.display,width:s.width,margin:s.margin,padding:s.padding};};
        const areas=[...document.querySelectorAll('#page_deco,#contenu-encadres,.contenu,#encadres,.layout__simple-grid__row')].map(measure);
        const overflow=[...document.querySelectorAll('#page .colonne_deco,#page .paragraphe--0,#page .paragraphe--4,#page .vignette_deco,#page iframe,#page .layout__slot')].filter(e=>e.getBoundingClientRect().width>0).map(measure).filter(r=>r.x<-2||r.x+r.w>innerWidth+2);
        const columns=[...document.querySelectorAll('#page [class^="colonne_"]')].filter(e=>e.className!=='colonne_deco'&&e.getBoundingClientRect().width>0).map(measure);
        return {title:document.title,url:location.href,viewport:innerWidth,height:document.documentElement.scrollHeight,areas,overflow,columns};
      })())`,returnByValue:true});
      report.push({slug,...JSON.parse(data.result.value)});
      if(!all||samples.includes(slug)) {
        const metrics=await send('Page.getLayoutMetrics');
        const screenshot=await send('Page.captureScreenshot',{format:'png',captureBeyondViewport:true,clip:{x:0,y:0,width:mobile?390:1440,height:Math.min(metrics.cssContentSize.height,2600),scale:1}});
        const label=references?`reference-${n}`:slug;
        fs.writeFileSync(`scratch/submenu-${label}-${mode}${mobile?'-mobile':''}.png`,Buffer.from(screenshot.data,'base64'));
      }
      if(n%25===0)console.log(`Reviewed ${n+1}/${pages.length}`);
    }
  } finally {
    if(retry) {
      const merged=previous.map(p=>report.find(r=>r.slug===p.slug)||p);
      report.splice(0,report.length,...merged);
    }
    fs.writeFileSync(reportFile,JSON.stringify(report,null,2));
    try {await send('Browser.close');} catch {}
    socket.close();
  }
  console.log(JSON.stringify({pages:report.length,overflow:report.filter(r=>r.overflow.length).map(r=>r.slug),missing:report.filter(p=>!p.areas.some(a=>a.id==='page_deco')).map(p=>p.slug)}));
})();

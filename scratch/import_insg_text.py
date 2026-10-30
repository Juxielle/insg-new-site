"""Import editorial content only; the source SQLite database is opened read-only.

Run from the repository root. No source assets, layouts, users or submissions
are copied. Existing page containers and their attributes are preserved.
"""
from pathlib import Path
import html
import json
import re
import sqlite3
import unicodedata

ROOT = Path(__file__).resolve().parents[1]
SOURCE = Path(r'C:\Users\User\Documents\Projets\Projets Web\insg-site')
connection = sqlite3.connect((SOURCE / 'database/database.sqlite').as_uri() + '?mode=ro', uri=True)
connection.row_factory = sqlite3.Row

def rows(table, columns):
    return [dict(r) for r in connection.execute(f'SELECT {columns} FROM {table}')]

data = {
    'pages': rows('pages', 'id,slug,meta_title,meta_description,hero_title,hero_text'),
    'sections': rows('page_sections', 'page_id,key,title,body,items,sort_order,active'),
    'partners': rows('partners', 'name,category,active'),
    'statistics': rows('site_statistics', 'key,label,value,suffix'),
    'testimonials': rows('testimonials', 'name,role,quote,featured'),
    'articles': rows('articles', 'title,slug,category,excerpt,content,published_at,featured'),
    'events': rows('events', 'title,location,starts_at,ends_at'),
    'announcements': rows('announcements', 'title,type,description,published_at,deadline_at,status'),
    'settings': rows('site_settings', 'key,value'),
    'programs': rows('programs', 'name,category,description,opportunities,curriculum'),
}
connection.close()
for section in data['sections']:
    section['items'] = json.loads(section['items']) if section['items'] else []
pages = {p['slug']: p for p in data['pages']}
sections = {p['slug']: {s['key']: s for s in data['sections'] if s['page_id'] == p['id'] and s['active']} for p in data['pages']}

def escape(text):
    return html.escape(text, quote=False)

def paragraph(text, chapo=False):
    return '<p' + (' class="chapo"' if chapo else '') + '>' + escape(text) + '</p>'

def section_html(page, key, heading=True):
    s = sections[page][key]
    result = ('<h2>' + ('LARSG — ' if key == 'research-lab' else '') + escape(s['title']) + '</h2>') if heading and s['title'] else ''
    body = s['body'] or ''
    result += body if '<p>' in body else paragraph(body)
    if s['items']:
        result += '<ul>' + ''.join('<li><strong>' + escape(i['title']) + ' :</strong> ' + i['text'] + '</li>' for i in s['items']) + '</ul>'
    return result

def content(page, *keys):
    return '\n'.join(section_html(page, key) for key in keys)

def write(path, text):
    path.write_text(text, encoding='utf-8', newline='\n')

def edit_view(name, transform):
    p = ROOT / 'resources/views' / name
    original = p.read_text(encoding='utf-8')
    updated = transform(original)
    if updated != original:
        write(p, updated)

def replace_chapo(text, value):
    return re.sub(r'<p class="chapo">.*?</p>', lambda m: paragraph(value, True), text, count=1, flags=re.S)

def replace_block(text, index, value):
    pattern = r'(<div class="paragraphe__contenu--\d+ toolbox">)(.*?)(</div><!-- \.paragraphe__contenu--\d+ \.toolbox -->)'
    matches = list(re.finditer(pattern, text, re.S))
    if index >= len(matches):
        raise ValueError(f'Missing editorial block {index}')
    m = matches[index]
    return text[:m.start(2)] + '\n' + value + '\n' + text[m.end(2):]

# The source catalogue is maintained in this partial, rather than in programs.
catalogue = (SOURCE / 'resources/views/partials/formations-content.blade.php').read_text(encoding='utf-8')
formation_notes = re.search(r'<div class="cms-rich-text">(.*?)</div>', catalogue, re.S)[1]
data['formation_notes'] = formation_notes
groups = []
for match in re.finditer(r"\['([^']+)', 'bi-[^']+', '([^']+)', '\d+ fili[èe]res?', \[(.*?)\]\]", catalogue):
    ident, level, items = match.groups()
    courses = re.findall(r"'([^']+)'", items)
    mode = 'Formation continue' if 'continu' in ident else 'Formation initiale'
    groups.append({'key': ident, 'level': level, 'mode': mode, 'courses': courses})
assert len(groups) == 8, 'Source catalogue structure changed'
data['catalogue'] = groups
out = ROOT / 'resources/content/insg-source.json'
out.parent.mkdir(parents=True, exist_ok=True)
write(out, json.dumps(data, ensure_ascii=False, indent=2) + '\n')

# Use the source's metadata on the corresponding public pages.
for name, slug in [('pages/home.blade.php', 'home'), ('pages/about.blade.php', 'about'), ('pages/admissions.blade.php', 'admissions'), ('pages/contact.blade.php', 'contact'), ('pages/entreprises.blade.php', 'entreprises'), ('pages/vie-associative.blade.php', 'vie-etudiante'), ('formations/index.blade.php', 'formations'), ('actualites/index.blade.php', 'actualites')]:
    def metadata(t, slug=slug):
        for field, source_field in [('title', 'meta_title'), ('meta_description', 'meta_description')]:
            value = pages[slug][source_field].replace('\\', '\\\\').replace("'", "\\'")
            t = re.sub(r"@section\('" + field + r"', .*?\)\s*\n", lambda m: "@section('" + field + "', '" + value + "')\n", t, count=1)
        return t
    edit_view(name, metadata)

edit_view('pages/about.blade.php', lambda t: replace_block(t, 0, content('about', 'history', 'values', 'vision', 'mission')))
edit_view('pages/about.blade.php', lambda t: t.replace("L'Institut National des Sciences de Gestion est structuré autour de directions opérationnelles et de comités scientifiques garantissant la fluidité du parcours académique et l'insertion professionnelle :", sections['about']['governance']['body']))
for name, slug in [('pages/contact.blade.php', 'contact'), ('pages/vie-associative.blade.php', 'vie-etudiante'), ('pages/entreprises.blade.php', 'entreprises')]:
    edit_view(name, lambda t, slug=slug: replace_chapo(t, pages[slug]['hero_text']))

edit_view('pages/vie-associative.blade.php', lambda t: replace_block(t, 0, paragraph(pages['vie-etudiante']['hero_text'], True) + content('vie-etudiante', 'student-clubs')))
edit_view('pages/vie-associative.blade.php', lambda t: re.sub(r'(<div class="paragraphe__contenu--4 toolbox">).*?(?=\s*@if)', lambda m: m[1] + section_html('vie-etudiante', 'student-services', False), t, count=1, flags=re.S))

partner_groups = {}
for p in data['partners']:
    if p['active']:
        partner_groups.setdefault(p['category'], []).append(p['name'])
partner_html = '<h2>Un réseau engagé aux côtés de l’INSG</h2><ul>' + ''.join('<li><strong>' + escape(category) + ' :</strong> ' + escape(', '.join(names)) + '.</li>' for category, names in partner_groups.items()) + '</ul>'
edit_view('pages/entreprises.blade.php', lambda t: replace_block(t, 0, paragraph(pages['entreprises']['hero_text'], True) + partner_html))
edit_view('pages/entreprises.blade.php', lambda t: replace_block(t, 1, section_html('entreprises', 'partner-benefits', False) + '<p>► <a href="/contact" class="lien_interne">Échanger sur un partenariat avec l’INSG</a></p>'))

def admissions(t):
    intro = paragraph(pages['admissions']['hero_text'], True) + section_html('admissions', 'process')
    intro += '<h3>Premier cycle</h3><p>Consultez les parcours accessibles selon votre série de baccalauréat et vérifiez les conditions d’accès auprès du service des admissions.</p>'
    intro += '<h3>Candidature en Master</h3>' + paragraph(pages['inscription-master']['hero_text'].replace('Candidatez en ligne', 'Préparez votre candidature'))
    t = replace_block(t, 0, intro)
    items = sections['inscription-master']['master-process']['items']
    accordion = '<dl aria-label="Accordéons" class="ckeditor-accordion">'
    for i, item in enumerate(items, 1):
        body = item['text']
        if i == 1:
            body = 'Préparez vos diplômes, relevés, CV, lettre de motivation et pièce d’identité. Contactez le service des admissions pour connaître les modalités de dépôt.'
        accordion += '<dt>' + str(i) + '. ' + escape(item['title']) + '</dt><dd>' + paragraph(body) + '</dd>'
    accordion += '</dl>'
    t = replace_block(t, 1, paragraph(sections['inscription-master']['master-process']['body']) + accordion)
    return t.replace('Les candidatures sont officiellement ouvertes pour la rentrée académique.', 'Consultez les avis officiels de l’Institut pour connaître les dates et modalités de candidature.')
edit_view('pages/admissions.blade.php', admissions)

def course_list(group):
    return '<h3>' + escape(group['mode'] + ' — ' + group['level']) + '</h3><ul>' + ''.join('<li><strong>' + escape(c) + '</strong></li>' for c in group['courses']) + '</ul>'

def formations(t):
    t = replace_block(t, 0, paragraph('L’INSG déploie une offre structurée autour de la formation initiale et de la formation continue. Ces deux voies associent excellence académique, professionnalisation et adaptation aux besoins des organisations.', True) + '<h2>Des formations développées en partenariat</h2>' + formation_notes)
    t = replace_block(t, 1, ''.join(course_list(g) for g in groups if g['level'] == 'BTS'))
    t = replace_block(t, 2, ''.join(course_list(g) for g in groups if g['level'].startswith('Licence')))
    t = replace_block(t, 3, ''.join(course_list(g) for g in groups if g['level'].startswith('Master')))
    return t.replace('2. Cycle Licence Professionnelle (Bac+3)', '2. Licences en sciences de gestion et professionnelles').replace('3. Cycle Master Professionnel &amp; MBA (Bac+5)', '3. Masters professionnels et recherche').replace('Département :</label>', 'Voie de formation :</label>')
edit_view('formations/index.blade.php', formations)

edit_view('pages/campus.blade.php', lambda t: replace_chapo(t, sections['home']['campus-life']['body']))
edit_view('pages/home.blade.php', lambda t: t.replace('Cérémonie de Remise des Diplômes', escape(pages['home']['hero_title'])).replace("L'Institut National des Sciences de Gestion célèbre ses diplômés de Licence et Master professionnel.", escape(pages['home']['hero_text'])))

# Align practical information with the source, retaining all existing elements.
for name in ['pages/contact.blade.php', 'pages/campus.blade.php', 'pages/entreprises.blade.php']:
    def contacts(t):
        t = t.replace('+241 011 76 25 20', '+241 01 23 45 67').replace('+241 077 12 34 56', '+241 01 23 45 67')
        t = t.replace('entreprises@insg-gabon.ga', 'contact@insg-gabon.ga')
        t = t.replace('Boulevard Triomphal Omar BONGO<br>\n                        BP 403 Libreville, Gabon', 'Boulevard Triomphal<br>\n                        Libreville, Gabon')
        t = t.replace('07h30 &ndash; 15h30', 'Horaires communiqués par l’Institut')
        return t
    edit_view(name, contacts)

def governance(t):
    pattern = r'@if\(isset\(\$gouvernances\).*?@endif'
    items = sections['about']['values']['items']
    listing = '<ul>' + ''.join('<li><strong>' + escape(i['title']) + ' :</strong> ' + i['text'] + '</li>' for i in items) + '</ul>'
    return re.sub(pattern, lambda m: listing, t, count=1, flags=re.S)
edit_view('pages/about.blade.php', governance)

# These two additional figures come from the source history, replacing sample
# laboratory/association counts in the same homepage mosaic cells.
edit_view('pages/home.blade.php', lambda t: t.replace('<strong>4</strong>\n                                                    <span>laboratoires &amp; chaires</span>', '<strong>1973</strong>\n                                                    <span>année de fondation</span>').replace("{{ $stats['associations'] ?? '15+' }}", '50+').replace('clubs &amp; associations étudiantes', 'années d’expérience'))

# Adapt the existing research navigation labels; keep all menu items and URLs.
research_links = {
    'laboratoire-de-recherche-historique-rhone-alpes': ('Finance et gouvernance', 'Performance financière, risques et gouvernance des organisations.'),
    'centre-lyonnais-d-histoire-du-droit-et-de-la-pensee-politique': ('Management et RH', 'Leadership, compétences et transformation des organisations.'),
    'equipe-lyonnaise-en-information-et-communication': ('Développement durable', 'Responsabilité sociale, territoires et transitions économiques.'),
}
def research_menu(t):
    for slug, (title, description) in research_links.items():
        t = re.sub(r'(<a href="/' + slug + r'"[^>]*>).*?(</a>)', lambda m: m[1] + '<strong>' + escape(title) + '</strong> — ' + escape(description) + m[2], t, flags=re.S)
    return t
edit_view('partials/header.blade.php', research_menu)

# Replace editorial text inside legacy pages, preserving their existing layout,
# navigation, banners and media. Related source sections share the same blocks.
mapping = {
    'histoire': ('about', ['history']),
    'gouvernance': ('about', ['governance', 'leadership']),
    'organisation': ('about', ['values', 'governance', 'mission']),
    'grands-projets': ('about', ['vision', 'mission']),
    'recherche': ('recherche', ['research-lab', 'research-areas']),
    'la-recherche-a-luniversite-jean-moulin-1': ('recherche', ['research-lab', 'research-areas']),
    'politique-de-recherche': ('recherche', ['research-lab', 'research-areas']),
    'unites-de-recherche': ('recherche', ['research-lab', 'research-areas']),
    'international': ('international', ['international-strategy', 'international-pillars', 'international-incoming']),
    'venir-a-lyon-3': ('international', ['international-incoming', 'international-pillars']),
    'partir-a-l-etranger': ('international', ['international-pillars', 'international-strategy']),
    'bibliotheques-universitaires-3': ('bibliotheque', ['library-services', 'library-access']),
    'bibliotheque-numerique': ('bibliotheque', ['library-services', 'library-access']),
    'vie-etudiante': ('vie-etudiante', ['student-clubs', 'student-services']),
    'sante-social': ('vie-etudiante', ['student-services']),
    'sport-1': ('vie-etudiante', ['student-services']),
    'culture-1': ('vie-etudiante', ['student-clubs', 'student-services']),
    'entrepreneuriat-innovation': ('entrepreneuriat', ['entrepreneurship-vision', 'entrepreneurship-skills', 'entrepreneurship-path', 'entrepreneurship-impact']),
    'campus-de-bourg-en-bresse': ('incubateur', ['incubator-purpose', 'incubator-program']),
    'former-ses-collaborateurs': ('entreprises', ['partner-benefits']),
    'recruter-ses-collaborateurs': ('entreprises', ['partner-benefits']),
    'verser-la-taxe-dapprentissage': ('entreprises', ['partner-benefits']),
    'entrepreneuriat-etudiant': ('incubateur', ['incubator-purpose', 'incubator-program']),
    'preparation-aux-concours': ('annonces-concours', ['announcement-list', 'announcement-advice']),
}
for slug in research_links:
    mapping[slug] = ('recherche', ['research-lab', 'research-areas'])

# Department pages reuse the source's disciplinary presentation and syllabus.
for slug, categories in {
    'faculte-de-droit': ['finance', 'comptabilite', 'audit'],
    'faculte-de-philosophie': ['marketing'],
    'faculte-des-humanites-lettres-et-societes-1': ['management', 'rh'],
    'faculte-des-langues': ['informatique'],
}.items():
    key = 'department-' + slug
    items = [p for p in data['programs'] if p['category'] in categories]
    sections['formations'][key] = {'title': 'Domaines de formation', 'body': pages['formations']['hero_text'], 'items': [{'title': p['name'], 'text': p['description']} for p in items]}
    mapping[slug] = ('formations', [key])
changed = []
for slug, (page, keys) in mapping.items():
    path = ROOT / 'html_static' / (slug + '.html')
    if not path.exists():
        continue
    original = path.read_text(encoding='utf-8')
    match = re.search(r'<main\b[^>]*>.*?</main>', original, re.S)
    if not match:
        raise ValueError(f'No main element in {slug}')
    main = match[0]
    titles = {'histoire': 'Notre histoire — Depuis 1973', 'gouvernance': 'Gouvernance de l’INSG', 'organisation': 'Organisation de l’INSG', 'grands-projets': 'Notre vision et nos missions', 'sante-social': 'Santé, écoute et inclusion', 'sport-1': 'Sport et culture à l’INSG', 'culture-1': 'Culture et engagement étudiant', 'recruter-ses-collaborateurs': 'Recruter les talents de l’INSG', 'former-ses-collaborateurs': 'Développer les compétences de vos équipes', 'verser-la-taxe-dapprentissage': 'Soutenir les formations de l’INSG'}
    main = re.sub(r'(<h1\b[^>]*>).*?(</h1>)', lambda m: m[1] + escape(titles.get(slug, pages[page]['hero_title'])) + m[2], main, count=1, flags=re.S)
    blocks = []
    for opening in re.finditer(r'<div class="paragraphe__contenu--\d+ toolbox">', main):
        depth = 1
        for tag in re.finditer(r'<div\b[^>]*>|</div\s*>', main[opening.end():], re.I):
            depth += -1 if tag[0].lower().startswith('</') else 1
            if depth == 0:
                blocks.append((opening.end(), opening.end() + tag.start()))
                break
    if not blocks:
        # Grid landing pages keep their cards; only their text nodes are edited.
        texts = [pages[page]['hero_text']]
        for key in keys:
            s = sections[page][key]
            texts += [re.sub('<[^>]+>', ' ', s['body'])]
            texts += [i['text'] for i in s['items']]
        counter = [0]
        def card_text(m):
            value = texts[counter[0] % len(texts)]
            counter[0] += 1
            return m[1] + escape(value) + m[3]
        main = re.sub(r'(<p\b[^>]*>)([^<]+)(</p>)', card_text, main)
        card_titles = [i['title'] for s in sections[page].values() for i in s['items']]
        counter[0] = 0
        def card_heading(m):
            value = card_titles[counter[0] % len(card_titles)]
            counter[0] += 1
            return m[1] + escape(value) + m[3]
        if card_titles:
            main = re.sub(r'(<h[23]\b[^>]*>)([^<]+)(</h[23]>)', card_heading, main)
        main = re.sub(r'href="https?://(?:bu\.)?univ-lyon3\.fr[^\"]*"', 'href="/contact"', main)
        main = re.sub(r'(<a href="/contact"[^\n]*?<!--)[ \t]+\n', r'\1\n', main)
        write(path, original[:match.start()] + main + original[match.end():])
        changed.append(slug)
        continue
    chunks = ['' for _ in blocks]
    for i, key in enumerate(keys):
        chunks[min(i, len(chunks) - 1)] += section_html(page, key)
    if page == 'annonces-concours':
        chunks[0] += '<ul>' + ''.join('<li><strong>' + escape(a['title']) + ' :</strong> ' + escape(a['description']) + ' — Publication : ' + escape(a['published_at'][:10]) + ('. Date limite : ' + escape(a['deadline_at'][:10]) if a['deadline_at'] else '') + '.</li>' for a in data['announcements']) + '</ul>'
    for i in range(len(chunks)):
        if not chunks[i]:
            chunks[i] = paragraph(pages[page]['hero_text']) + '<p>► <a href="/contact" class="lien_interne">Contacter l’INSG pour en savoir plus</a></p>'
    for (start, end), chunk in reversed(list(zip(blocks, chunks))):
        main = main[:start] + '\n' + chunk + '\n' + main[end:]
    # Source contact details replace legacy Lyon contacts in sidebars.
    main = re.sub(r'(<div class="encadre_contenu[^\"]*toolbox[^\"]*">).*?(</div>\s*<!-- \.encadre_contenu -->)', lambda m: m[1] + '<p>Institut National des Sciences de Gestion<br>Boulevard Triomphal, Libreville, Gabon<br><a href="mailto:contact@insg-gabon.ga">contact@insg-gabon.ga</a><br>+241 01 23 45 67</p>' + m[2], main, flags=re.S)
    updated = original[:match.start()] + main + original[match.end():]
    updated = re.sub(r'<title>.*?</title>', lambda m: '<title>' + escape(titles.get(slug, pages[page]['hero_title'])) + ' — INSG Gabon</title>', updated, count=1, flags=re.S)
    write(path, updated)
    changed.append(slug)
print(f'Imported {len(data["pages"])} source pages, {len(groups)} catalogue groups and {len(changed)} legacy pages.')

# Subsequent text imports must retain the public identity cleanup.
from clean_public_references import clean_file
for path in list((ROOT / 'html_static').glob('*.html')) + list((ROOT / 'resources/views').rglob('*.blade.php')):
    clean_file(path)

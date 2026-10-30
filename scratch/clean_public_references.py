"""Edit public text and links without renaming CSS classes or page containers."""
from pathlib import Path
from html.parser import HTMLParser
import html
import re
import sys
from urllib.parse import unquote, urlsplit

sys.stdout.reconfigure(encoding='utf-8')
ROOT = Path(__file__).resolve().parents[1]
FORBIDDEN = re.compile(r'\bFrance\b|\bParis\w*|lyon|jean[\s-]+moulin', re.I)
ALIASES = dict(re.findall(r"'([^']+)'\s*=>\s*'([^']+)'", (ROOT / 'config/legacy_page_urls.php').read_text(encoding='utf-8')))

def topic_text(path):
    name = str(path).lower()
    if any(s in name for s in ('aides-', 'bourse', 'social')):
        return 'Pour connaître les dispositifs d’accompagnement et leurs conditions d’accès, contactez les services de l’INSG.'
    if any(s in name for s in ('integrite', 'jurid', 'legal', 'donnees')):
        return 'Pour connaître les textes et les procédures applicables à l’Institut, contactez l’administration de l’INSG.'
    if any(s in name for s in ('international', 'cooperation', 'venir-', 'etudier-', 'mobilite')):
        return 'Les services de l’INSG accompagnent les étudiants dans leurs démarches de mobilité et de coopération académique.'
    if any(s in name for s in ('recherche', 'scientifi', 'laboratoire', 'sources-', 'focus-iuf')):
        return 'La recherche à l’INSG contribue à la production et au partage de connaissances en sciences de gestion.'
    if any(s in name for s in ('emploi', 'insertion', 'carriere', 'management')):
        return 'L’INSG accompagne les étudiants et les diplômés dans la construction de leur parcours professionnel.'
    return 'Retrouvez les informations sur les formations, les activités et les services de l’INSG auprès de l’Institut.'

def clean_text(value, path, title=False):
    decoded = html.unescape(value)
    if not FORBIDDEN.search(decoded):
        return value
    if 'institut académique de france' in decoded.lower() or 'institut academique de france' in decoded.lower():
        return 'Équipe de recherche de l’INSG'
    if re.search(r'bienvenue\s+en\s+france', decoded, re.I):
        return 'Accueil des étudiants internationaux'
    if title:
        return 'Institut National des Sciences de Gestion — INSG Gabon'
    if re.fullmatch(r'\s*(?:france|paris)\s*', decoded, re.I):
        return 'International'
    if re.search(r'(?:universit[eé]|institut).*?(?:lyon|jean[ -]moulin)', decoded, re.I) and len(decoded) < 160:
        return 'Institut National des Sciences de Gestion — INSG Gabon'
    if len(decoded.strip()) < 100:
        return 'Informations et activités de l’INSG'
    return topic_text(path)

def clean_url(value):
    decoded = unquote(html.unescape(value))
    # Keep Blade's asset expression intact while replacing the old logo.
    if any(s in decoded.lower() for s in ('universite-de-lyon_', 'v_campusf-label', 'bienvenue-en-france', 'campusfrance')):
        if '{{' in value and 'asset(' in value:
            return "{{ asset('assets/images/insg-logo.png') }}"
        return '/assets/images/insg-logo.png' if re.search(r'\.(?:png|jpg|jpeg|svg|gif)(?:[?\'"}]|$)', decoded, re.I) else '/contact'
    if decoded.lower().startswith('mailto:') and FORBIDDEN.search(decoded):
        return 'mailto:contact@insg-gabon.ga'
    if decoded.startswith(('http://', 'https://', '//')):
        parsed = urlsplit(decoded if not decoded.startswith('//') else 'https:' + decoded)
        if FORBIDDEN.search(parsed.netloc + parsed.path):
            slug = parsed.path.strip('/').removesuffix('.html')
            return '/' + ALIASES[slug] if slug in ALIASES else '/contact'
    stripped = decoded.lstrip('/').removesuffix('.html')
    if stripped in ALIASES:
        return '/' + ALIASES[stripped]
    if FORBIDDEN.search(decoded):
        if re.search(r'\.(?:png|jpg|jpeg|svg|gif)', decoded, re.I):
            return '/assets/images/insg-logo.png'
        return '/contact'
    return value

class Cleaner(HTMLParser):
    def __init__(self, source, path):
        super().__init__(convert_charrefs=False)
        self.source = source
        self.path = path
        self.offsets = [0]
        self.offsets += [m.end() for m in re.finditer('\n', source)]
        self.hidden = 0
        self.in_title = False
        self.edits = []

    def absolute_offset(self):
        line, col = self.getpos()
        return self.offsets[line - 1] + col

    def handle_starttag(self, tag, attrs):
        if tag in ('script', 'style'):
            self.hidden += 1
        if tag == 'title':
            self.in_title = True
        raw = self.get_starttag_text()
        start = self.absolute_offset()
        for m in re.finditer(r'''([\w:-]+)\s*=\s*(["'])(.*?)\2''', raw, re.S):
            name, _, value = m.groups()
            # Class/ID/style names are implementation hooks, not site content.
            if name in ('href', 'src', 'poster', 'data-src', 'action', 'data-href') and tag != 'script':
                updated = clean_url(value)
            elif name in ('alt', 'title', 'aria-label', 'content', 'data-section-title'):
                updated = clean_text(value, self.path, title=(tag == 'meta'))
                if updated != value:
                    updated = html.escape(updated, quote=True)
            else:
                continue
            if updated != value:
                self.edits.append((start + m.start(3), start + m.end(3), updated))

    def handle_startendtag(self, tag, attrs):
        self.handle_starttag(tag, attrs)
        if tag in ('script', 'style'):
            self.hidden -= 1

    def handle_endtag(self, tag):
        if tag in ('script', 'style'):
            self.hidden = max(0, self.hidden - 1)
        if tag == 'title':
            self.in_title = False

    def handle_data(self, value):
        if self.hidden:
            return
        if re.search(r'@(?:include|section|php|endphp)|\{\{--', value):
            return
        updated = clean_text(value, self.path, title=self.in_title)
        if updated != value:
            self.edits.append((self.absolute_offset(), self.absolute_offset() + len(value), html.escape(updated, quote=False)))

def clean_file(path):
    source = path.read_text(encoding='utf-8')
    cleaner = Cleaner(source, path)
    cleaner.feed(source)
    updated = source
    for start, end, value in sorted(cleaner.edits, reverse=True):
        updated = updated[:start] + value + updated[end:]
    if updated != source:
        path.write_text(updated, encoding='utf-8', newline='\n')
    return len(cleaner.edits)

if __name__ == '__main__':
    files = list((ROOT / 'html_static').glob('*.html')) + list((ROOT / 'resources/views').rglob('*.blade.php'))
    changed = edits = 0
    for path in files:
        count = clean_file(path)
        changed += bool(count)
        edits += count
    print(f'{len(files)} templates reviewed; {changed} updated; {edits} public text/link corrections.')

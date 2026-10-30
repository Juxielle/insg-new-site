"""Compare legacy page layout containers with their pre-import Git version."""
from html.parser import HTMLParser
from pathlib import Path
import re
import subprocess

class Layout(HTMLParser):
    def __init__(self):
        super().__init__(convert_charrefs=True)
        self.stack = []
        self.signature = []
        self.main = False

    def handle_starttag(self, tag, attrs):
        if tag == 'main':
            self.main = True
        if not self.main or tag not in ('main', 'div', 'aside'):
            return
        attrs = dict(attrs)
        classes = attrs.get('class', '')
        editorial = 'paragraphe__contenu' in classes or 'encadre_contenu' in classes
        hidden = editorial or (self.stack and self.stack[-1])
        self.stack.append(hidden)
        if not hidden:
            self.signature.append((tag, tuple(sorted(attrs.items()))))

    def handle_endtag(self, tag):
        if self.main and tag in ('main', 'div', 'aside') and self.stack:
            self.stack.pop()
        if tag == 'main':
            self.main = False

def layout(text):
    parser = Layout()
    parser.feed(text)
    return parser.signature

paths = subprocess.check_output(['git', 'diff', '--name-only'], text=True).splitlines()
count = 0
for name in paths:
    if name.startswith('html_static/') and name.endswith('.html'):
        before = subprocess.check_output(['git', 'show', 'HEAD:' + name]).decode('utf-8')
        after = Path(name).read_text(encoding='utf-8')
        assert layout(before) == layout(after), f'Layout containers changed: {name}'
        count += 1
    if name.endswith(('.css', '.js')):
        raise AssertionError(f'Unexpected style/script change: {name}')
print(f'{count} legacy pages: layout containers and attributes preserved. No CSS/JS changes.')

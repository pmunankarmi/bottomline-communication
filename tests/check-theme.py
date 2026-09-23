"""Portable checks for the distributable theme; no WordPress runtime required."""
from pathlib import Path
import re
root = Path(__file__).resolve().parents[1] / 'bottomline-communication'
for file in ('style.css', 'index.php', 'header.php', 'footer.php', 'functions.php', 'front-page.php'):
    assert (root / file).is_file(), file
php = '\n'.join(p.read_text() for p in root.rglob('*.php'))
js = '\n'.join(p.read_text() for p in (root / 'assets/js').glob('*.js'))
assert not list(root.rglob('*.json')), 'Theme must not depend on JSON content'
assert not re.search(r'projectsData|fetch\(', js), 'Content must be rendered by PHP'
assert 'BL_' not in php, 'Unresolved conversion placeholder'
assert 'onsubmit=' not in php, 'Form must use WordPress POST handling'
for path in re.findall(r"get_template_part\( '([^']+)' \)", php):
    assert (root / (path + '.php')).is_file(), path
for p in (root / 'assets/css').glob('*.css'):
    for target in re.findall(r'url\([\'\"]?([^\)\'\"]+)', p.read_text()):
        if not target.startswith(('data:', 'http')):
            assert (p.parent / target).is_file(), (p.name, target)
fields = (root / 'inc/acf-fields.php').read_text()
assert set(re.findall(r"'type' => '([^']+)'", fields)) == {'text', 'textarea', 'repeater'}
keys = re.findall(r"'key' => '(field_[^']+)'", fields)
assert len(keys) == len(set(keys)), 'Duplicate ACF field keys'
assert not (root / 'template-parts').exists()
assert '<nav id="nav">' in (root / 'header.php').read_text()
assert 'content-home' not in php
assert (root / 'screenshot.png').is_file()
assert 'bl_work_category' in php and 'bl_work_scope' in php
assert 'bl_export_submissions' in php
print('PASS: flat templates, shared header, screenshot, native taxonomies, unique page fields, PHP rendering and asset paths.')

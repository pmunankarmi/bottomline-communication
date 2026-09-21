"""Portable checks for the distributable theme; no WordPress runtime required."""
from pathlib import Path
import re
root = Path(__file__).resolve().parents[1] / 'bottomline-communication'
for file in ('style.css', 'index.php', 'header.php', 'footer.php', 'functions.php', 'front-page.php'):
    assert (root / file).is_file(), file
php = '\n'.join(p.read_text() for p in root.rglob('*.php'))
js = '\n'.join(p.read_text() for p in (root / 'assets/js').glob('*.js'))
assert not list(root.rglob('*.json')), 'Theme must not depend on JSON content'
assert not re.search(r'projectsData|innerHTML|fetch\(', js), 'Content must be rendered by PHP'
assert 'BL_' not in php, 'Unresolved conversion placeholder'
assert 'onsubmit=' not in php, 'Form must use WordPress POST handling'
for path in re.findall(r"get_template_part\( '([^']+)' \)", php):
    assert (root / (path + '.php')).is_file(), path
for p in (root / 'assets/css').glob('*.css'):
    for target in re.findall(r'url\([\'\"]?([^\)\'\"]+)', p.read_text()):
        if not target.startswith(('data:', 'http')):
            assert (p.parent / target).is_file(), (p.name, target)
fields = (root / 'inc/acf-fields.php').read_text()
assert set(re.findall(r"'type' => '([^']+)'", fields)) == {'text'}
keys = re.findall(r"'key' => '(field_[^']+)'", fields)
assert len(keys) == len(set(keys)), 'Duplicate ACF field keys'
assert len(list((root / 'template-parts/projects').glob('card-*.php'))) == 24
assert len(list((root / 'template-parts/projects').glob('work-*.php'))) == 24
assert len(list((root / 'template-parts/projects').glob('home-*.php'))) == 9
print('PASS: theme structure, 24 projects, 9 home panels, unique text-only ACF fields, PHP rendering, asset paths.')

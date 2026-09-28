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
stylesheets = list(root.rglob('*.css'))
assert stylesheets == [root / 'style.css'], 'Theme must ship one public CSS file'
images = [p for p in root.rglob('*') if p.is_file() and p.suffix.lower() in {'.png', '.jpg', '.jpeg', '.gif', '.webp', '.svg'}]
assert images == [root / 'screenshot.png'], 'Only the standard WordPress theme screenshot may remain in the theme'
assert "wp_enqueue_style( 'bl-theme', get_stylesheet_uri()" in php
assert "get_theme_file_uri( 'assets/css/" not in php
assert 'bl_social_links()' in php and "'' === $url || '#' === $url" in php
assert "add_filter( 'upload_mimes'" in php and "'svg'" in php
fields = (root / 'inc/acf-fields.php').read_text()
assert set(re.findall(r"'type' => '([^']+)'", fields)) == {'text', 'textarea', 'repeater', 'wysiwyg'}
keys = re.findall(r"'key' => '(field_[^']+)'", fields)
assert len(keys) == len(set(keys)), 'Duplicate ACF field keys'
assert not (root / 'template-parts').exists()
assert '<nav id="nav">' in (root / 'header.php').read_text()
assert 'content-home' not in php
assert (root / 'screenshot.png').is_file()
assert 'bl_work_category' in php and 'bl_work_scope' in php
assert 'bl_export_submissions' in php
print('PASS: flat templates, one stylesheet, Media Library images, conditional global socials, SVG support, native taxonomies and PHP rendering.')

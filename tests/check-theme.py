"""Portable checks for the distributable theme; no WordPress runtime required."""
from pathlib import Path
import re
root = Path(__file__).resolve().parents[1] / 'bottomline-communication'
for file in ('style.css', 'index.php', 'header.php', 'footer.php', 'functions.php', 'templates/template-home.php', 'template-parts/content-page.php'):
    assert (root / file).is_file(), file
php = '\n'.join(p.read_text() for p in root.rglob('*.php'))
js = '\n'.join(p.read_text() for p in (root / 'assets/js').glob('*.js'))
assert not list(root.rglob('*.json')), 'Theme must not depend on JSON content'
assert not re.search(r'projectsData|fetch\(', js), 'Content must be rendered by PHP'
assert 'BL_' not in php, 'Unresolved conversion placeholder'
assert 'onsubmit=' not in php, 'Form must use WordPress POST handling'
for path in re.findall(r"get_template_part\( '([^']+)' \)", php):
    assert (root / (path + '.php')).is_file(), path
stylesheets = set(root.rglob('*.css'))
assert stylesheets == {root / 'style.css', root / 'assets/css/mt-style.css'}, 'Theme must keep only its header and combined stylesheet'
assert (root / 'style.css').read_text().partition('*/')[2].strip() == '', 'style.css must contain only the WordPress theme header'
scripts = list((root / 'assets/js').glob('*.js'))
assert scripts == [root / 'assets/js/mt-script.js'], 'Theme must ship one combined JavaScript file'
images = [p for p in root.rglob('*') if p.is_file() and p.suffix.lower() in {'.png', '.jpg', '.jpeg', '.gif', '.webp', '.svg'}]
assert images == [root / 'screenshot.png'], 'Only the standard WordPress theme screenshot may remain in the theme'
assert "get_theme_file_uri( 'assets/css/mt-style.css' )" in php
assert "get_theme_file_uri( 'assets/js/mt-script.js' )" in php
assert 'bl_social_links()' in php and "'' === $url || '#' === $url" in php
assert "add_filter( 'upload_mimes'" in php and "'svg'" in php
fields = (root / 'inc/acf-fields.php').read_text()
assert set(re.findall(r"'type' => '([^']+)'", fields)) == {'text', 'textarea', 'repeater', 'wysiwyg'}
keys = re.findall(r"'key' => '(field_[^']+)'", fields)
assert len(keys) == len(set(keys)), 'Duplicate ACF field keys'
assert not list(root.glob('template-*.php')), 'Custom page templates belong in templates/'
assert {p.name for p in (root / 'templates').glob('*.php')} == {
    'template-home.php', 'template-about.php', 'template-projects.php', 'template-clients.php', 'template-contact.php'
}
assert {p.name for p in (root / 'data').glob('*.php')} == {'default-content.php', 'default-clients.php', 'legacy-fields.php'}
for inc_file in (root / 'inc').glob('*.php'):
    source = inc_file.read_text()
    assert 'function ' in source or 'add_action(' in source or 'add_filter(' in source, f'Non-functional file in inc/: {inc_file.name}'
assert '<nav id="nav">' in (root / 'header.php').read_text()
assert "wp_nav_menu(" in (root / 'header.php').read_text()
assert 'content-home' not in php
assert not (root / 'front-page.php').exists()
assert not re.search(r"(?:index|about|projects|clients|contact)\.html", php, re.I), 'Static document URL remains in PHP'
contact_template = (root / 'templates/template-contact.php').read_text()
contact_validation = (root.parent / 'js-source/contact-validation.js').read_text()
assert 'name="service[]"' in contact_template and '<span class="box">' not in contact_template, 'Service choices use hidden native checkboxes without visible indicators'
assert "'service[]': { required: true }" in contact_validation and ".validate().element(this)" in contact_validation, 'jQuery Validation handles service selection'
combined_css = (root / 'assets/css/mt-style.css').read_text()
assert 'grid-template-columns:repeat(2,minmax(0,1fr));gap:10px 12px' in combined_css, 'Contact service choices have equal row and column gaps'
assert 'grid-template-columns:repeat(4,minmax(0,1fr));gap:14px' in combined_css, 'Contact budget choices have equal gaps'
assert 'grid-template-columns:repeat(3,minmax(0,1fr));gap:24px' in combined_css, 'Homepage service cards have equal row and column gaps'
assert '.foot-socials a{' in combined_css and '.foot-socials svg{' in combined_css, 'Social buttons are styled globally'
assert '<footer class="site-footer">' in (root / 'footer.php').read_text(), 'All pages use the shared site footer'
assert 'html body .site-footer{background:' in combined_css and 'padding:100px 5vw 40px;margin-top:0' in combined_css, 'Shared footer matches homepage spacing'
assert (root / 'screenshot.png').is_file()
assert 'bl_work_category' in php and 'bl_work_scope' in php
assert 'bl_export_submissions' in php
print('PASS: standard template directories, WordPress permalinks and menus, combined CSS/JS assets, Media Library images, conditional global socials, SVG support, native taxonomies and PHP rendering.')

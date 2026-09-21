<?php
/** Run: BL_WP_PATH=/path/to/test/wordpress php tests/wordpress.php */
$path = getenv( 'BL_WP_PATH' );
if ( ! $path || ! is_file( $path . '/wp-load.php' ) ) { fwrite( STDERR, "Set BL_WP_PATH to a disposable WordPress test installation.\n" ); exit(1); }
require $path . '/wp-load.php';
function check( $condition, $message ) { if ( ! $condition ) throw new RuntimeException( $message ); echo "PASS: $message\n"; }
check( get_stylesheet() === 'bottomline-communication', 'Theme active on WordPress' );
check( function_exists( 'get_field' ), 'ACF text API available' );
$home = get_page_by_path( 'home' );
$key = 'bl_home_001';
$before = get_post_meta( $home->ID, $key, true );
$existed = metadata_exists( 'post', $home->ID, $key );
update_field( 'field_' . $key, 'Edited from admin <script>alert(1)</script>', $home->ID );
check( str_contains( bl_value( $key, 'fallback', $home->ID ), 'Edited from admin' ), 'Saved ACF text overrides PHP defaults' );
update_field( 'field_' . $key, '', $home->ID );
check( bl_value( $key, 'fallback', $home->ID ) === '', 'Intentional blank is respected' );
if ( $existed ) update_field( 'field_' . $key, $before, $home->ID );
else { delete_post_meta( $home->ID, $key ); delete_post_meta( $home->ID, '_' . $key ); }
check( bl_value( $key, 'fallback', $home->ID ) === ( $existed ? $before : 'fallback' ), 'PHP defaults restored' );
$groups = acf_get_local_field_groups();
$count = 0;
foreach ( $groups as $group ) {
    if ( ! str_starts_with( $group['key'], 'group_bl_' ) ) continue;
    foreach ( acf_get_fields( $group ) as $field ) { check( $field['type'] === 'text', 'Text field ' . $field['name'] ); $count++; }
}
foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $slug ) {
    $page = get_page_by_path( $slug );
    check( $page && get_page_template_slug( $page ) === 'template-' . $slug . '.php', "Page and native template: $slug" );
    $GLOBALS['wp_query'] = new WP_Query( array( 'page_id' => $page->ID ) );
    ob_start(); get_template_part( 'template-parts/content-' . $slug ); $html = ob_get_clean();
    $dom = new DOMDocument(); @$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $html ); $xp = new DOMXPath( $dom );
    check( $xp->query('//h1')->length === 1, "$slug has its PHP-rendered title" );
    check( ! str_contains( $html, '.html"' ), "$slug internal links resolved through WordPress" );
    if ( $slug === 'projects' ) {
        check( $xp->query('//*[@data-project]')->length === 24, 'All 24 project cards rendered without JavaScript' );
        check( $xp->query('//aside')->length === 24, 'All 24 detail panels rendered without JavaScript' );
    }
    if ( $slug === 'home' ) check( $xp->query('//aside')->length === 9, 'All 9 homepage detail panels rendered without JavaScript' );
    if ( $slug === 'contact' ) check( $xp->query('//form[@method="post"]//input[@name="bl_nonce"]')->length === 1, 'Native WordPress form action and nonce' );
    foreach ( $xp->query('//img/@src') as $src ) {
        $prefix = get_theme_file_uri( 'assets/' );
        if ( strpos( $src->value, $prefix ) === 0 ) {
            $asset = strtok( substr( $src->value, strlen( $prefix ) ), '?' );
            check( is_file( get_theme_file_path( 'assets/' . $asset ) ), 'Bundled image ' . $asset );
        }
    }
    file_put_contents( sys_get_temp_dir() . '/bl-rendered-' . $slug . '.html', $html );
}
echo "PASS: $count ACF text fields registered; all five pages rendered.\n";

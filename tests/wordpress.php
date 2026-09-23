<?php
/** Run only on a disposable local WordPress installation. */
$path = getenv( 'BL_WP_PATH' );
if ( ! $path || ! is_file( $path . '/wp-load.php' ) ) exit( 'Set BL_WP_PATH to a disposable WordPress site.' );
require $path . '/wp-load.php';
if ( wp_get_environment_type() !== 'local' ) exit( 'Local test site required.' );
function check( $ok, $message ) { if ( ! $ok ) throw new RuntimeException( $message ); echo "PASS: $message\n"; }
check( count( bl_content_posts( 'bl_service' ) ) === 6, 'Six imported Services posts' );
check( count( bl_content_posts( 'bl_work' ) ) === 24, '24 imported Work posts' );
check( count( bl_content_posts( 'bl_work', true ) ) === 9, 'Nine featured Work posts in original order' );
check( count( bl_client_groups( 'clients' ) ) === 10, 'Ten client sector posts' );
check( array_sum( array_map( function ( $sector ) { return count( bl_client_items( $sector ) ); }, bl_client_groups( 'clients' ) ) ) === 61, 'All 61 original client cells, including text-only logos' );
check( count( bl_client_gallery( bl_client_groups( 'home' )[0] ) ) === 25, 'Homepage client gallery has 25 logos' );
check( taxonomy_exists( 'bl_work_scope' ) && ! is_taxonomy_hierarchical( 'bl_work_scope' ), 'Scope of Work uses native tags' );
$categories = get_terms( array( 'taxonomy' => 'bl_work_category', 'hide_empty' => false, 'orderby' => 'term_id', 'fields' => 'names' ) );
check( $categories === array( 'Branding', 'Events', 'Digital', 'Campaign', 'Activation', 'Retail' ), 'All six native Work categories' );
check( ! use_block_editor_for_post_type( 'page' ) && ! use_block_editor_for_post_type( 'bl_work' ), 'Gutenberg disabled' );
$home = get_page_by_path( 'home' );
$key = 'bl_home_003'; $existed = metadata_exists( 'post', $home->ID, $key ); $before = get_post_meta( $home->ID, $key, true );
update_field( 'field_' . $key, 'Admin test value', $home->ID );
check( bl_value( $key, 'fallback', $home->ID ) === 'Admin test value', 'ACF page editing works' );
update_field( 'field_' . $key, '', $home->ID );
check( '' === bl_value( $key, 'fallback', $home->ID ), 'Blank text stays blank' );
if ( $existed ) update_field( 'field_' . $key, $before, $home->ID ); else { delete_post_meta( $home->ID, $key ); delete_post_meta( $home->ID, '_' . $key ); }
$global_fields = acf_get_fields( 'group_bl_globals' );
check( array_column( array_filter( $global_fields, function ( $field ) { return 'tab' === $field['type']; } ), 'label' ) === array( 'Branding', 'Contact', 'Offices', 'Social Media', 'Footer', 'Form Delivery' ), 'Global settings have six organized tabs' );
check( 'image' === acf_get_field( 'field_bl_logo' )['type'], 'Branding logo is an ACF image picker' );
$old_logo = get_theme_mod( 'custom_logo' );
$images = bl_client_gallery( bl_client_groups( 'home' )[0] );
$legacy_logo = get_option( 'options_bl_logo_url', false );
remove_theme_mod( 'custom_logo' );
delete_option( 'options_bl_logo' );
update_option( 'options_bl_logo_url', wp_get_attachment_image_url( $images[0], 'full' ) );
bl_migrate_logo_image();
check( (int) get_theme_mod( 'custom_logo' ) === $images[0], 'Legacy logo URL migrates to an attachment ID' );
if ( false === $legacy_logo ) delete_option( 'options_bl_logo_url' ); else update_option( 'options_bl_logo_url', $legacy_logo );
set_theme_mod( 'custom_logo', $images[0] );
check( (int) get_option( 'options_bl_logo' ) === $images[0], 'Customizer logo syncs to theme options' );
update_option( 'options_bl_logo', $images[1] );
$_POST['acf']['field_bl_logo'] = $images[1];
do_action( 'acf/save_post', 'options' );
check( (int) get_theme_mod( 'custom_logo' ) === $images[1], 'Theme option logo syncs to native custom_logo' );
$_POST['acf']['field_bl_logo'] = ''; update_option( 'options_bl_logo', '' ); do_action( 'acf/save_post', 'options' );
check( ! get_theme_mod( 'custom_logo' ) && 0 === (int) get_option( 'options_bl_logo' ), 'Logo removal syncs in both places' );
unset( $_POST['acf'] ); if ( $old_logo ) set_theme_mod( 'custom_logo', $old_logo );
$work = bl_content_posts( 'bl_work' )[0];
check( bl_work_scope( $work->ID )[0] === 'Brand identity', 'Scope tag order preserved' );
$old = bl_gallery_ids( 'work_gallery', $work->ID ); update_post_meta( $work->ID, 'work_gallery', array_reverse( $old ) );
check( bl_gallery_ids( 'work_gallery', $work->ID ) === array_reverse( $old ), 'Gallery order is editable' ); update_post_meta( $work->ID, 'work_gallery', $old );
foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $slug ) {
    $html = shell_exec( escapeshellarg( PHP_BINARY ) . ' -d error_reporting=22527 ' . escapeshellarg( __DIR__ . '/render.php' ) . ' ' . escapeshellarg( $slug ) );
    $dom = new DOMDocument(); @$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $html ); $xp = new DOMXPath( $dom );
    check( $xp->query( '//nav[@id="nav"]' )->length === 1, "$slug: one standard shared header" );
    check( $xp->query( '//footer' )->length === 1, "$slug: one shared footer" );
    check( $xp->query( '//h1' )->length === 1, "$slug: server-rendered page title" );
    if ( 'projects' === $slug ) check( $xp->query( '//aside' )->length === 24 && $xp->query( '//*[@data-project]' )->length === 24, 'All cards and panels rendered by PHP' );
    if ( 'clients' === $slug ) check( $xp->query( '//div[@class="sector reveal"]' )->length === 10, 'Client sectors rendered from posts' );
    file_put_contents( sys_get_temp_dir() . '/bl-rendered-' . $slug . '.html', $html );
}
check( "'=SUM(1,2)" === bl_csv_cell( '=SUM(1,2)' ) && "' +CMD()" === bl_csv_cell( ' +CMD()' ), 'CSV formula injection blocked' );
check( ! get_post_type_object( 'bl_submission' )->publicly_queryable && ! get_post_type_object( 'bl_submission' )->show_in_rest, 'Submissions are private' );
$counts = array_map( function ( $type ) { return count( bl_content_posts( $type ) ); }, array( 'bl_service', 'bl_work', 'bl_client' ) );
bl_import_content();
check( $counts === array_map( function ( $type ) { return count( bl_content_posts( $type ) ); }, array( 'bl_service', 'bl_work', 'bl_client' ) ), 'Content import is idempotent' );
echo "All WordPress integration checks passed.\n";
foreach ( glob( get_template_directory() . '/*.php' ) as $file ) {
    preg_match_all( "/bl_value\\(\\s*'([^']+)'/", file_get_contents( $file ), $matches );
    foreach ( $matches[1] as $name ) check( (bool) acf_get_field( 'field_' . $name ), 'Registered template field: ' . $name );
}

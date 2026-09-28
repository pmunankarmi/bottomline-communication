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
foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $template_slug ) {
    check( bl_page_template( $template_slug ) === get_page_template_slug( get_page_by_path( $template_slug )->ID ), 'Standard template folder assignment: ' . $template_slug );
}
$key = 'bl_home_011'; $existed = metadata_exists( 'post', $home->ID, $key ); $before = get_post_meta( $home->ID, $key, true );
update_field( 'field_' . $key, 'Admin test value', $home->ID );
check( bl_value( $key, 'fallback', $home->ID ) === 'Admin test value', 'ACF page editing works' );
update_field( 'field_' . $key, '', $home->ID );
check( '' === bl_value( $key, 'fallback', $home->ID ), 'Blank text stays blank' );
if ( $existed ) update_field( 'field_' . $key, $before, $home->ID ); else { delete_post_meta( $home->ID, $key ); delete_post_meta( $home->ID, '_' . $key ); }
$global_fields = acf_get_fields( 'group_bl_globals' );
check( array_column( array_filter( $global_fields, function ( $field ) { return 'tab' === $field['type']; } ), 'label' ) === array( 'Branding', 'Contact', 'Offices', 'Social Media', 'Footer', 'Form Delivery' ), 'Global settings have six organized tabs' );
check( 'image' === acf_get_field( 'field_bl_logo' )['type'], 'Branding logo is an ACF image picker' );
$service_image = get_post_meta( bl_content_posts( 'bl_service' )[0]->ID, 'service_image_url', true );
check( ctype_digit( (string) $service_image ) && wp_attachment_is_image( (int) $service_image ), 'Service images use Media Library attachment IDs' );
$work_cover = get_post_meta( bl_content_posts( 'bl_work' )[0]->ID, 'work_cover', true );
check( ctype_digit( (string) $work_cover ) && wp_attachment_is_image( (int) $work_cover ), 'Work covers use Media Library attachment IDs' );
check( false !== strpos( bl_media_url( 'work_cover', bl_content_posts( 'bl_work' )[0]->ID ), '/wp-content/uploads/' ), 'Work image URLs come from WordPress uploads' );
$media_attachments = get_posts( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'posts_per_page' => -1, 'meta_key' => '_bl_original_asset', 'fields' => 'ids' ) );
check( 88 === count( $media_attachments ), 'All supplied site images exist as Media Library attachments' );
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
$social_before = array();
foreach ( array( 'bl_social_instagram', 'bl_social_linkedin', 'bl_social_x' ) as $social_field ) {
    $social_before[$social_field] = get_option( 'options_' . $social_field, false );
    update_option( 'options_' . $social_field, '' );
}
check( array() === bl_social_links(), 'Blank social URLs hide every social icon' );
update_option( 'options_bl_social_instagram', 'https://instagram.com/bottomline' );
update_option( 'options_bl_social_linkedin', '#' );
check( 1 === count( bl_social_links() ) && 'Instagram' === bl_social_links()[0]['label'], 'Only configured social URLs render' );
foreach ( $social_before as $social_field => $social_value ) {
    if ( false === $social_value ) delete_option( 'options_' . $social_field );
    else update_option( 'options_' . $social_field, $social_value );
}
$admin = get_users( array( 'role' => 'administrator', 'number' => 1 ) )[0];
wp_set_current_user( $admin->ID );
check( 'image/svg+xml' === apply_filters( 'upload_mimes', array() )['svg'], 'Administrators can upload SVG files' );
$safe_svg = tempnam( sys_get_temp_dir(), 'safe-svg-' ); file_put_contents( $safe_svg, '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M0 0h10v10z"/></svg>' );
$unsafe_svg = tempnam( sys_get_temp_dir(), 'unsafe-svg-' ); file_put_contents( $unsafe_svg, '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>' );
$safe_result = apply_filters( 'wp_handle_upload_prefilter', array( 'name' => 'safe.svg', 'type' => 'image/svg+xml', 'tmp_name' => $safe_svg ) );
$unsafe_result = apply_filters( 'wp_handle_upload_prefilter', array( 'name' => 'unsafe.svg', 'type' => 'image/svg+xml', 'tmp_name' => $unsafe_svg ) );
check( empty( $safe_result['error'] ) && ! empty( $unsafe_result['error'] ), 'SVG validation accepts safe markup and rejects active content' );
wp_delete_file( $safe_svg ); wp_delete_file( $unsafe_svg );
$work = bl_content_posts( 'bl_work' )[0];
check( bl_work_scope( $work->ID )[0] === 'Brand identity', 'Scope tag order preserved' );
$old = bl_gallery_ids( 'work_gallery', $work->ID ); update_post_meta( $work->ID, 'work_gallery', array_reverse( $old ) );
check( bl_gallery_ids( 'work_gallery', $work->ID ) === array_reverse( $old ), 'Gallery order is editable' ); update_post_meta( $work->ID, 'work_gallery', $old );
update_option( 'options_bl_social_instagram', 'https://instagram.com/bottomline' );
foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $slug ) {
    $html = shell_exec( escapeshellarg( PHP_BINARY ) . ' -d error_reporting=22527 ' . escapeshellarg( __DIR__ . '/render.php' ) . ' ' . escapeshellarg( $slug ) );
    $dom = new DOMDocument(); @$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $html ); $xp = new DOMXPath( $dom );
    check( $xp->query( '//nav[@id="nav"]' )->length === 1, "$slug: one standard shared header" );
    check( $xp->query( '//footer' )->length === 1, "$slug: one shared footer" );
    check( $xp->query( '//footer//*[contains(concat(" ", normalize-space(@class), " "), " foot-socials ")]//a[@aria-label="Instagram"]' )->length === 1, "$slug: configured social icon in shared footer" );
    check( $xp->query( '//h1' )->length === 1, "$slug: server-rendered page title" );
    check( $xp->query( '//a[contains(translate(@href, "HTML", "html"), ".html")]' )->length === 0, "$slug: no static document links" );
    if ( 'projects' === $slug ) check( $xp->query( '//aside' )->length === 24 && $xp->query( '//*[@data-project]' )->length === 24, 'All cards and panels rendered by PHP' );
    if ( 'clients' === $slug ) check( $xp->query( '//div[@class="sector reveal"]' )->length === 10, 'Client sectors rendered from posts' );
    if ( 'contact' === $slug ) {
        check( $xp->query( '//label[contains(concat(" ", normalize-space(@class), " "), " check-pill ")]/input[@type="checkbox" and @name="service[]"]' )->length === 6, 'Contact services use native checkbox inputs' );
        check( $xp->query( '//*[contains(concat(" ", normalize-space(@class), " "), " check-pill ")]//*[contains(concat(" ", normalize-space(@class), " "), " box ")]' )->length === 0, 'Contact services have no visible checkbox indicator' );
    }
    file_put_contents( sys_get_temp_dir() . '/bl-rendered-' . $slug . '.txt', $html );
}
if ( false === $social_before['bl_social_instagram'] ) delete_option( 'options_bl_social_instagram' );
else update_option( 'options_bl_social_instagram', $social_before['bl_social_instagram'] );
check( "'=SUM(1,2)" === bl_csv_cell( '=SUM(1,2)' ) && "' +CMD()" === bl_csv_cell( ' +CMD()' ), 'CSV formula injection blocked' );
check( ! get_post_type_object( 'bl_submission' )->publicly_queryable && ! get_post_type_object( 'bl_submission' )->show_in_rest, 'Submissions are private' );
$counts = array_map( function ( $type ) { return count( bl_content_posts( $type ) ); }, array( 'bl_service', 'bl_work', 'bl_client' ) );
bl_import_content();
check( $counts === array_map( function ( $type ) { return count( bl_content_posts( $type ) ); }, array( 'bl_service', 'bl_work', 'bl_client' ) ), 'Content import is idempotent' );
echo "All WordPress integration checks passed.\n";
foreach ( array_merge( glob( get_template_directory() . '/*.php' ), glob( get_template_directory() . '/templates/*.php' ) ) as $file ) {
    preg_match_all( "/bl_value\\(\\s*'([^']+)'/", file_get_contents( $file ), $matches );
    foreach ( $matches[1] as $name ) check( (bool) acf_get_field( 'field_' . $name ), 'Registered template field: ' . $name );
}

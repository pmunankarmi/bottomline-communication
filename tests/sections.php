<?php
$path = getenv( 'BL_WP_PATH' );
if ( ! $path || ! is_file( $path . '/wp-load.php' ) ) exit( 'Set BL_WP_PATH.' );
require $path . '/wp-load.php';
if ( 'local' !== wp_get_environment_type() ) exit( 'Local test site required.' );
function section_check( $ok, $label ) { if ( ! $ok ) throw new RuntimeException( $label ); echo "PASS: $label\n"; }
require_once get_template_directory() . '/inc/section-defaults.php';
$home = get_page_by_path( 'home' );
$about = get_page_by_path( 'about' );
foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $kind ) {
    $page = get_page_by_path( $kind );
    $values = bl_section_seed_values( $kind, $page->ID );
    foreach ( $values as $key => $value ) {
        section_check( metadata_exists( 'post', $page->ID, $key ), 'Migrated section: ' . $key );
        section_check( (bool) acf_get_field( 'field_' . $key ), 'Registered section: ' . $key );
    }
}
$benefits = bl_section_rows( 'bl_home_benefits', array( 'content' ), $home->ID );
section_check( 4 === count( $benefits ) && false !== strpos( $benefits[0]['content'], 'Strategy-led' ), 'Benefits repeater contains the four original items' );
section_check( 3 === count( bl_section_rows( 'bl_about_pillars', array( 'icon', 'label', 'content' ), $about->ID ) ), 'Three value cards preserved' );
$original = get_post_meta( $home->ID, 'bl_home_heading_1', true );
try {
    update_post_meta( $home->ID, 'bl_home_heading_1', '' );
    delete_option( 'bl_sections_migrated' );
    bl_migrate_sections();
    section_check( '' === get_post_meta( $home->ID, 'bl_home_heading_1', true ), 'Migration respects deliberately empty content' );
} finally { update_post_meta( $home->ID, 'bl_home_heading_1', $original ); }
$settings = apply_filters( 'tiny_mce_before_init', array() );
$formats = json_decode( $settings['style_formats'], true );
section_check( in_array( 'text-gradient', array_column( $formats, 'classes' ), true ), 'Native editor exposes Gradient text format' );
$global_query = $GLOBALS['wp_query'];
$GLOBALS['wp_query'] = new WP_Query( array( 'page_id' => $home->ID ) );
try {
    update_post_meta( $home->ID, 'bl_home_heading_1', '<p>One <span class="text-gradient">complete heading</span><script>alert(1)</script></p>' );
    ob_start(); bl_section( 'bl_home_heading_1', true ); $html = ob_get_clean();
    section_check( false !== strpos( $html, 'class="text-gradient"' ) && false === strpos( $html, '<script' ) && false === strpos( $html, '<p>' ), 'Inline headings preserve editor formats and strip unsafe markup' );
} finally { update_post_meta( $home->ID, 'bl_home_heading_1', $original ); $GLOBALS['wp_query'] = $global_query; }

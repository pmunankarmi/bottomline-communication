<?php
/** One editable CTA section, with content and native ACF link controls. */
defined( 'ABSPATH' ) || exit;
add_action( 'acf/init', function () {
    acf_add_local_field_group( array(
        'key' => 'group_bl_cta', 'title' => 'CTA section',
        'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-home.php' ) ), array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ) ),
        'fields' => array(
            array( 'key' => 'field_bl_cta_content', 'name' => 'bl_cta_content', 'label' => 'Content', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'full', 'media_upload' => 0, 'instructions' => 'Use Heading 2 for the title and a paragraph for the description. Bold text in the heading appears in teal.' ),
            array( 'key' => 'field_bl_cta_primary', 'name' => 'bl_cta_primary', 'label' => 'Primary button', 'type' => 'link', 'return_format' => 'array' ),
            array( 'key' => 'field_bl_cta_secondary', 'name' => 'bl_cta_secondary', 'label' => 'Secondary button', 'type' => 'link', 'return_format' => 'array' ),
        ),
    ) );
} );
function bl_migrate_cta() {
    if ( get_option( 'bl_cta_migrated' ) ) return;
    $pages = get_posts( array( 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => -1, 'meta_key' => '_wp_page_template', 'meta_value' => 'template-home.php' ) );
    $front = get_post( (int) get_option( 'page_on_front' ) );
    if ( $front && 'page' === $front->post_type ) $pages[] = $front;
    if ( ! $pages ) return;
    $legacy = require __DIR__ . '/legacy-fields.php';
    foreach ( $pages as $page ) {
        $value = function ( $number ) use ( $page, $legacy ) {
            $name = 'bl_home_' . $number;
            return bl_value( $name, $legacy[$name], $page->ID );
        };
        $fields = array(
            'bl_cta_content' => '<h2>' . esc_html( $value(211) ) . ' <strong>' . esc_html( $value(212) ) . '</strong></h2><p>' . esc_html( $value(213) ) . '</p>',
            'bl_cta_primary' => array( 'title' => $value(214), 'url' => bl_url( $value(138) ), 'target' => '' ),
            'bl_cta_secondary' => array( 'title' => $value(216), 'url' => bl_phone_url( 'bl_events_phone', '+966 56 460 4739' ), 'target' => '' ),
        );
        bl_seed_meta( $page->ID, $fields );
    }
    update_option( 'bl_cta_migrated', 1, false );
}
add_action( 'init', 'bl_migrate_cta', 28 );

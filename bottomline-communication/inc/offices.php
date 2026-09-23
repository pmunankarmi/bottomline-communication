<?php
/** About office cards, stored in a standard ACF repeater. */
defined( 'ABSPATH' ) || exit;
function bl_office_rows( $page_id ) {
    $rows = array();
    $count = (int) get_post_meta( $page_id, 'bl_offices', true );
    for ( $i = 0; $i < $count; $i++ ) {
        $row = array();
        foreach ( array( 'country', 'city', 'description' ) as $name ) {
            $row[$name] = (string) get_post_meta( $page_id, 'bl_offices_' . $i . '_' . $name, true );
        }
        $rows[] = $row;
    }
    return $rows;
}
function bl_migrate_offices() {
    if ( get_option( 'bl_offices_migrated' ) ) return;
    $pages = get_posts( array( 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => -1, 'meta_key' => '_wp_page_template', 'meta_value' => 'template-about.php' ) );
    if ( ! $pages ) return;
    $legacy = require __DIR__ . '/legacy-fields.php';
    foreach ( $pages as $page ) {
        if ( metadata_exists( 'post', $page->ID, 'bl_offices' ) ) continue;
        $value = function ( $number ) use ( $page, $legacy ) {
            $name = 'bl_about_' . sprintf( '%03d', $number );
            return bl_value( $name, $legacy[$name], $page->ID );
        };
        $rows = array(
            array( 'country' => $value(34), 'city' => $value(35), 'description' => $value(36) . "\n" . $value(37) ),
            array( 'country' => $value(34), 'city' => $value(38), 'description' => $value(39) . "\n" . $value(40) . "\n" . $value(41) ),
            array( 'country' => $value(42), 'city' => $value(43), 'description' => $value(44) ),
            array( 'country' => $value(45), 'city' => $value(46), 'description' => $value(47) ),
        );
        // Seed native ACF row metadata even if Pro is temporarily inactive.
        foreach ( $rows as $i => $row ) {
            foreach ( $row as $name => $text ) {
                $key = 'bl_offices_' . $i . '_' . $name;
                update_post_meta( $page->ID, $key, $text );
                update_post_meta( $page->ID, '_' . $key, 'field_bl_office_' . $name );
            }
        }
        update_post_meta( $page->ID, 'bl_offices', count( $rows ) );
        update_post_meta( $page->ID, '_bl_offices', 'field_bl_offices' );
    }
    update_option( 'bl_offices_migrated', 1, false );
}
add_action( 'init', 'bl_migrate_offices', 27 );

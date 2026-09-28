<?php
defined( 'ABSPATH' ) || exit;

function bl_page_template( $slug ) {
    return 'templates/template-' . sanitize_key( $slug ) . '.php';
}

/** Keep existing page assignments valid after moving templates into the standard folder. */
function bl_migrate_page_template_paths() {
    if ( '1' === get_option( 'bl_template_paths_version' ) ) return;
    foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $slug ) {
        $page = get_page_by_path( $slug );
        if ( ! $page ) continue;
        $current = get_post_meta( $page->ID, '_wp_page_template', true );
        if ( 'template-' . $slug . '.php' === $current || '' === $current || 'default' === $current ) {
            update_post_meta( $page->ID, '_wp_page_template', bl_page_template( $slug ) );
        }
    }
    update_option( 'bl_template_paths_version', '1', false );
}
add_action( 'init', 'bl_migrate_page_template_paths', 5 );

/** Create missing theme pages once. Never overwrite existing page content or homepage settings. */
add_action( 'after_switch_theme', function () {
    $home_id = 0;
    foreach ( array( 'home' => 'Home', 'about' => 'About', 'projects' => 'Selected Work', 'clients' => 'Clients', 'contact' => 'Start a Project' ) as $slug => $title ) {
        $page = get_page_by_path( $slug );
        if ( $page ) continue;
        $id = wp_insert_post( array( 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $slug, 'meta_input' => array( '_wp_page_template' => bl_page_template( $slug ) ) ), true );
        if ( 'home' === $slug && ! is_wp_error( $id ) ) $home_id = $id;
    }
    if ( $home_id && ! get_option( 'page_on_front' ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_id );
    }
} );

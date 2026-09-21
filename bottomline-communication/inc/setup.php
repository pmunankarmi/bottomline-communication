<?php
defined( 'ABSPATH' ) || exit;
/** Create missing theme pages once. Never overwrite existing page content or homepage settings. */
add_action( 'after_switch_theme', function () {
    $home_id = 0;
    foreach ( array( 'home' => 'Home', 'about' => 'About', 'projects' => 'Selected Work', 'clients' => 'Clients', 'contact' => 'Start a Project' ) as $slug => $title ) {
        $page = get_page_by_path( $slug );
        if ( $page ) continue;
        $id = wp_insert_post( array( 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $slug, 'meta_input' => array( '_wp_page_template' => 'template-' . $slug . '.php' ) ), true );
        if ( 'home' === $slug && ! is_wp_error( $id ) ) $home_id = $id;
    }
    if ( $home_id && ! get_option( 'page_on_front' ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_id );
    }
} );

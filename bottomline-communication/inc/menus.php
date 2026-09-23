<?php
/** Create and assign the original navigation using native WordPress menus. */
defined( 'ABSPATH' ) || exit;
function bl_assign_default_menus() {
    if ( get_option( 'bl_menus_assigned' ) ) return;
    $lock = (int) get_option( 'bl_menu_setup_lock' );
    if ( $lock && $lock < time() - 120 ) delete_option( 'bl_menu_setup_lock' );
    if ( ! add_option( 'bl_menu_setup_lock', time(), '', false ) ) return;
    try {
        $locations = get_nav_menu_locations();
        foreach ( array( 'primary-home' => 'BottomLine — Homepage', 'primary-inner' => 'BottomLine — Inner pages' ) as $location => $name ) {
            // Respect menus already assigned by an administrator.
            if ( ! empty( $locations[$location] ) && wp_get_nav_menu_object( $locations[$location] ) ) continue;
            $menu = wp_get_nav_menu_object( $name );
            if ( ! $menu ) {
                $id = wp_create_nav_menu( $name );
                if ( is_wp_error( $id ) ) return;
                update_term_meta( $id, '_bl_seed_pending', 1 );
            } else $id = $menu->term_id;
            if ( get_term_meta( $id, '_bl_seed_pending', true ) ) {
                $links = array( 'About' => 'about', 'Services' => 'services', 'Work' => 'projects' );
                if ( 'primary-home' === $location ) $links['Process'] = 'process';
                $links['Clients'] = 'clients';
                $links['Contact'] = 'contact';
                $items = wp_get_nav_menu_items( $id ) ?: array();
                $urls = wp_list_pluck( $items, 'url' );
                $position = 0;
                foreach ( $links as $label => $anchor ) {
                    $position++;
                    $url = home_url( '/#' . $anchor );
                    if ( in_array( $url, $urls, true ) ) continue;
                    $item_id = wp_update_nav_menu_item( $id, 0, array(
                        'menu-item-title' => $label, 'menu-item-url' => $url,
                        'menu-item-type' => 'custom', 'menu-item-status' => 'publish',
                        'menu-item-position' => $position,
                    ) );
                    if ( is_wp_error( $item_id ) ) return;
                }
                delete_term_meta( $id, '_bl_seed_pending' );
            }
            $locations[$location] = (int) $id;
        }
        set_theme_mod( 'nav_menu_locations', $locations );
        update_option( 'bl_menus_assigned', 1, false );
    } finally { delete_option( 'bl_menu_setup_lock' ); }
}
add_action( 'init', 'bl_assign_default_menus', 40 );

<?php
$path = getenv( 'BL_WP_PATH' );
if ( ! $path || ! is_file( $path . '/wp-load.php' ) ) exit( 'Set BL_WP_PATH.' );
require $path . '/wp-load.php';
if ( 'local' !== wp_get_environment_type() ) exit( 'Local test site required.' );
function menu_check( $ok, $message ) { if ( ! $ok ) throw new RuntimeException( $message ); echo "PASS: $message\n"; }
$locations = get_nav_menu_locations();
foreach ( array( 'primary-home' => 6, 'primary-inner' => 5 ) as $location => $count ) {
    menu_check( ! empty( $locations[$location] ), 'Assigned menu: ' . $location );
    menu_check( count( wp_get_nav_menu_items( $locations[$location] ) ) === $count, 'Original links imported: ' . $location );
    $html = wp_nav_menu( array( 'theme_location' => $location, 'echo' => false, 'fallback_cb' => false ) );
    menu_check( false !== strpos( $html, 'menu-item-' ), 'Native WordPress menu renders: ' . $location );
    foreach ( wp_get_nav_menu_items( $locations[$location] ) as $item ) {
        menu_check( 'html' !== strtolower( pathinfo( wp_parse_url( $item->url, PHP_URL_PATH ) ?: '', PATHINFO_EXTENSION ) ), 'No static document URL: ' . $item->title );
    }
}
$home_items = wp_get_nav_menu_items( $locations['primary-home'] );
update_post_meta( $home_items[0]->ID, '_menu_item_url', home_url( '/broken-document/' ) );
delete_option( 'bl_menu_links_version' );
bl_repair_default_menu_links();
$repaired = wp_setup_nav_menu_item( get_post( $home_items[0]->ID ) );
menu_check( home_url( '/#about' ) === $repaired->url, 'Legacy default menu URL repaired with WordPress API' );
$before = count( wp_get_nav_menus() );
bl_assign_default_menus();
menu_check( count( wp_get_nav_menus() ) === $before, 'Repeated setup does not duplicate menus' );
try {
    set_theme_mod( 'nav_menu_locations', array() );
    bl_assign_default_menus();
    menu_check( ! get_nav_menu_locations(), 'Intentional unassignment remains untouched' );
} finally { set_theme_mod( 'nav_menu_locations', $locations ); }

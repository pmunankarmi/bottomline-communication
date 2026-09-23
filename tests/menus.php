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
}
$before = count( wp_get_nav_menus() );
bl_assign_default_menus();
menu_check( count( wp_get_nav_menus() ) === $before, 'Repeated setup does not duplicate menus' );
try {
    set_theme_mod( 'nav_menu_locations', array() );
    bl_assign_default_menus();
    menu_check( ! get_nav_menu_locations(), 'Intentional unassignment remains untouched' );
} finally { set_theme_mod( 'nav_menu_locations', $locations ); }

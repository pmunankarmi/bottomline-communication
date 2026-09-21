<?php
/** TEST ONLY: put in a disposable local site's mu-plugins directory. Never deploy. */
if ( ! defined( 'ABSPATH' ) ) exit;
if ( wp_get_environment_type() !== 'local' ) return;
add_filter( 'pre_wp_mail', function ( $return, $attributes ) {
    return strpos( $attributes['message'], 'SIMULATE_FAILURE' ) === false;
}, 10, 2 );

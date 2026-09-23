<?php
require getenv( 'BL_WP_PATH' ) . '/wp-load.php';
if ( wp_get_environment_type() !== 'local' ) exit(1);
$role = ( $argv[1] ?? '' ) === 'subscriber' ? 'subscriber' : 'administrator';
$users = get_users( array( 'role' => $role, 'number' => 1 ) );
if ( ! $users && 'subscriber' === $role ) {
    $id = wp_insert_user( array( 'user_login' => 'bl_test_subscriber', 'user_pass' => wp_generate_password( 30 ), 'role' => 'subscriber' ) );
} else $id = $users[0]->ID;
wp_set_current_user( $id );
$expires = time() + 300;
$token = WP_Session_Tokens::get_instance( $id )->create( $expires );
$cookies = array( AUTH_COOKIE => wp_generate_auth_cookie( $id, $expires, 'auth', $token ), LOGGED_IN_COOKIE => wp_generate_auth_cookie( $id, $expires, 'logged_in', $token ) );
$_COOKIE = array_merge( $_COOKIE, $cookies );
echo wp_json_encode( array( 'cookies' => $cookies, 'nonce' => wp_create_nonce( 'bl_export_submissions' ) ) );

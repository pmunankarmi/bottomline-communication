<?php
/** One logo shared by ACF global settings, Customizer, header, footer and preloader. */
defined( 'ABSPATH' ) || exit;
function bl_logo_url() {
    $url = wp_get_attachment_image_url( (int) get_theme_mod( 'custom_logo' ), 'full' );
    return $url ?: get_theme_file_uri( 'assets/bottomline-logo-white.svg' );
}
function bl_phone_url( $field, $default ) { return 'tel:' . preg_replace( '/[^0-9+]/', '', bl_value( $field, $default, 'option' ) ); }
function bl_sync_logo_to_options( $old, $new ) {
    if ( ( $old['custom_logo'] ?? 0 ) === ( $new['custom_logo'] ?? 0 ) ) return;
    $url = wp_get_attachment_image_url( (int) ( $new['custom_logo'] ?? 0 ), 'full' ) ?: '';
    update_option( 'options_bl_logo_url', $url, false );
    update_option( '_options_bl_logo_url', 'field_bl_logo_url', false );
}
add_action( 'update_option_theme_mods_' . get_option( 'stylesheet' ), 'bl_sync_logo_to_options', 10, 2 );
add_action( 'added_option', function ( $name, $value ) {
    if ( 'theme_mods_' . get_option( 'stylesheet' ) === $name ) bl_sync_logo_to_options( array(), (array) $value );
}, 10, 2 );
add_filter( 'acf/load_value/name=bl_logo_url', function ( $value ) {
    return wp_get_attachment_image_url( (int) get_theme_mod( 'custom_logo' ), 'full' ) ?: '';
} );
add_filter( 'acf/validate_value/name=bl_logo_url', function ( $valid, $value ) {
    if ( true !== $valid || '' === trim( $value ) ) return $valid;
    $id = attachment_url_to_postid( esc_url_raw( trim( $value ) ) );
    return $id && wp_attachment_is_image( $id ) ? true : 'Use an image URL from this WordPress Media Library so it can sync with the Customizer logo.';
}, 10, 2 );
add_action( 'acf/save_post', function ( $post_id ) {
    if ( ! in_array( $post_id, array( 'options', 'option' ), true ) || ! isset( $_POST['acf']['field_bl_logo_url'] ) ) return;
    $url = trim( (string) get_option( 'options_bl_logo_url', '' ) );
    if ( '' === $url ) { remove_theme_mod( 'custom_logo' ); return; }
    $id = attachment_url_to_postid( esc_url_raw( $url ) );
    if ( $id && wp_attachment_is_image( $id ) ) set_theme_mod( 'custom_logo', $id );
}, 20 );

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
    $id = (int) ( $new['custom_logo'] ?? 0 );
    update_option( 'options_bl_logo', $id, false );
    update_option( '_options_bl_logo', 'field_bl_logo', false );
}
add_action( 'update_option_theme_mods_' . get_option( 'stylesheet' ), 'bl_sync_logo_to_options', 10, 2 );
add_action( 'added_option', function ( $name, $value ) {
    if ( 'theme_mods_' . get_option( 'stylesheet' ) === $name ) bl_sync_logo_to_options( array(), (array) $value );
}, 10, 2 );
add_filter( 'acf/load_value/name=bl_logo', function ( $value ) {
    return (int) get_theme_mod( 'custom_logo' );
} );
add_filter( 'acf/validate_value/name=bl_logo', function ( $valid, $value ) {
    if ( true !== $valid || empty( $value ) ) return $valid;
    return wp_attachment_is_image( absint( $value ) ) ? true : 'Select an image from the Media Library.';
}, 10, 2 );
add_action( 'acf/save_post', function ( $post_id ) {
    if ( ! in_array( $post_id, array( 'options', 'option' ), true ) || ! isset( $_POST['acf']['field_bl_logo'] ) ) return;
    $id = absint( get_option( 'options_bl_logo', 0 ) );
    if ( ! $id ) { remove_theme_mod( 'custom_logo' ); return; }
    if ( wp_attachment_is_image( $id ) ) set_theme_mod( 'custom_logo', $id );
}, 20 );

// Preserve a previously saved logo URL when upgrading to the image picker.
function bl_migrate_logo_image() {
    if ( false !== get_option( 'options_bl_logo', false ) ) return;
    $id = (int) get_theme_mod( 'custom_logo' );
    if ( ! $id ) $id = attachment_url_to_postid( (string) get_option( 'options_bl_logo_url', '' ) );
    if ( $id && wp_attachment_is_image( $id ) ) set_theme_mod( 'custom_logo', $id );
    else $id = 0;
    update_option( 'options_bl_logo', $id, false );
    update_option( '_options_bl_logo', 'field_bl_logo', false );
}
add_action( 'init', 'bl_migrate_logo_image' );

<?php
/** Native TinyMCE formats shared by the Classic Editor and ACF content editors. */
defined( 'ABSPATH' ) || exit;
add_action( 'after_setup_theme', function () {
    add_editor_style( 'assets/css/editor.css' );
} );
add_filter( 'mce_buttons_2', function ( $buttons ) {
    if ( ! in_array( 'styleselect', $buttons, true ) ) array_unshift( $buttons, 'styleselect' );
    return $buttons;
} );
add_filter( 'tiny_mce_before_init', function ( $settings ) {
    $formats = ! empty( $settings['style_formats'] ) ? json_decode( $settings['style_formats'], true ) : array();
    if ( ! is_array( $formats ) ) $formats = array();
    $formats[] = array( 'title' => 'Gradient text', 'inline' => 'span', 'classes' => 'text-gradient' );
    $formats[] = array( 'title' => 'Accent text', 'inline' => 'span', 'classes' => 'text-accent' );
    $settings['style_formats'] = wp_json_encode( $formats );
    $settings['style_formats_merge'] = true;
    return $settings;
} );

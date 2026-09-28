<?php
/** BottomLine classic WordPress theme. */
defined( 'ABSPATH' ) || exit;
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/contact.php';
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/global-settings.php';
require_once get_template_directory() . '/inc/logo.php';
require_once get_template_directory() . '/inc/content-types.php';
require_once get_template_directory() . '/inc/migrate.php';
require_once get_template_directory() . '/inc/submissions.php';
require_once get_template_directory() . '/inc/updates.php';
require_once get_template_directory() . '/inc/about-story.php';
require_once get_template_directory() . '/inc/offices.php';
require_once get_template_directory() . '/inc/cta.php';
require_once get_template_directory() . '/inc/sections.php';
require_once get_template_directory() . '/inc/section-fields.php';
require_once get_template_directory() . '/inc/editor.php';
require_once get_template_directory() . '/inc/menus.php';
require_once get_template_directory() . '/inc/media.php';
require_once get_template_directory() . '/inc/svg.php';

/** PHP defaults are used until an editor explicitly saves a value, including blank. */
function bl_value( $name, $default, $post_id = null ) {
    $post_id = $post_id ?: get_queried_object_id();
    $exists = 'option' === $post_id
        ? false !== get_option( 'options_' . $name, false )
        : metadata_exists( 'post', $post_id, $name );
    if ( ! $exists ) return $default;
    $value = 'option' === $post_id ? get_option( 'options_' . $name ) : get_post_meta( $post_id, $name, true );
    return is_scalar( $value ) ? (string) $value : '';
}

/** Resolve original links through WordPress, including subdirectory installations. */
function bl_url( $url ) {
    if ( '' === $url ) return '';
    if ( preg_match( '~^(?:https?:|mailto:|tel:|#|//)~i', $url ) ) return $url;
    if ( preg_match( '~^(index|about|projects|clients|contact)\.html(#[^\s]*)?$~', $url, $match ) ) {
        $slug = 'index' === $match[1] ? '' : $match[1];
        $page = $slug ? get_page_by_path( $slug ) : null;
        return ( $page ? get_permalink( $page ) : home_url( '/' . ( $slug ? $slug . '/' : '' ) ) ) . ( $match[2] ?? '' );
    }
    if ( '/' === substr( $url, 0, 1 ) ) return home_url( $url );
    return get_theme_file_uri( 'assets/' . ltrim( $url, '/' ) );
}
function bl_page_kind() {
    if ( is_front_page() ) return 'home';
    $template = get_page_template_slug();
    foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $kind ) {
        if ( 'template-' . $kind . '.php' === $template ) return $kind;
    }
    return 'about';
}
function bl_asset_version( $file ) { return substr( hash_file( 'sha256', get_theme_file_path( $file ) ), 0, 12 ); }
function bl_social_links() {
    $icons = array(
        'bl_social_instagram' => array( 'Instagram', '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>' ),
        'bl_social_linkedin'  => array( 'LinkedIn', '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>' ),
        'bl_social_x'         => array( 'X', '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>' ),
    );
    $links = array();
    foreach ( $icons as $field => $details ) {
        $url = trim( bl_value( $field, '', 'option' ) );
        if ( '' === $url || '#' === $url ) continue;
        $links[] = array( 'label' => $details[0], 'icon' => $details[1], 'url' => bl_url( $url ) );
    }
    return $links;
}
add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array( 'flex-width' => true, 'flex-height' => true ) );
    register_nav_menus( array( 'primary-home' => 'Homepage navigation', 'primary-inner' => 'Inner-page navigation' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    load_theme_textdomain( 'bottomline', get_template_directory() . '/languages' );
} );
add_filter( 'body_class', function ( $classes ) {
    $classes[] = 'bl-page-' . bl_page_kind();
    return $classes;
} );
add_action( 'wp_enqueue_scripts', function () {
    $kind = bl_page_kind();
    wp_enqueue_style( 'bl-theme', get_stylesheet_uri(), array(), bl_asset_version( 'style.css' ) );
    if ( 'contact' === $kind ) {
        wp_enqueue_script( 'bl-jquery-validation', get_theme_file_uri( 'assets/js/jquery.validate.min.js' ), array( 'jquery' ), '1.21.0', true );
        wp_enqueue_script( 'bl-contact-validation', get_theme_file_uri( 'assets/js/contact-validation.js' ), array( 'bl-jquery-validation' ), bl_asset_version( 'assets/js/contact-validation.js' ), true );
    }
    wp_enqueue_script( 'bl-page', get_theme_file_uri( 'assets/js/' . $kind . '.js' ), array(), bl_asset_version( 'assets/js/' . $kind . '.js' ), true );
    wp_enqueue_script( 'bl-interactions', get_theme_file_uri( 'assets/js/interactions.js' ), array( 'bl-page' ), bl_asset_version( 'assets/js/interactions.js' ), true );
} );
add_action( 'admin_notices', function () {
    if ( current_user_can( 'activate_plugins' ) && ! function_exists( 'acf_add_options_page' ) ) {
        echo '<div class="notice notice-warning"><p>BottomLine: activate your licensed ACF Pro plugin to edit the text fields and global settings. The original PHP content remains available.</p></div>';
    }
} );

// Preserve incoming links from the static site using native WordPress redirects.
add_action( 'template_redirect', function () {
    if ( ! in_array( $_SERVER['REQUEST_METHOD'] ?? 'GET', array( 'GET', 'HEAD' ), true ) ) return;
    $request_path = wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH );
    $base = trailingslashit( wp_parse_url( home_url( '/' ), PHP_URL_PATH ) ?: '/' );
    foreach ( array( 'index', 'about', 'projects', 'clients', 'contact' ) as $slug ) {
        if ( $request_path === $base . $slug . '.html' ) {
            wp_safe_redirect( bl_url( $slug . '.html' ), 301 );
            exit;
        }
    }
} );

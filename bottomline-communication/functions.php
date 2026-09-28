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

/** Resolve internal slugs through WordPress, including subdirectory installations. */
function bl_url( $url ) {
    $url = trim( (string) $url );
    if ( '' === $url ) return '';
    if ( preg_match( '~^(?:mailto:|tel:|#)~i', $url ) ) return $url;
    $parts = wp_parse_url( $url );
    if ( false === $parts ) return '';
    $home = wp_parse_url( home_url( '/' ) );
    if ( ! empty( $parts['host'] ) && 0 !== strcasecmp( $parts['host'], $home['host'] ?? '' ) ) return $url;
    $slug = trim( $parts['path'] ?? '', '/' );
    $home_path = trim( $home['path'] ?? '', '/' );
    if ( $home_path && ( $slug === $home_path || 0 === strpos( $slug, $home_path . '/' ) ) ) {
        $slug = trim( substr( $slug, strlen( $home_path ) ), '/' );
    }
    $query = empty( $parts['query'] ) ? '' : '?' . $parts['query'];
    $fragment = empty( $parts['fragment'] ) ? '' : '#' . $parts['fragment'];
    $extension = strtolower( pathinfo( $slug, PATHINFO_EXTENSION ) );
    if ( 'html' === $extension ) {
        $slug = substr( $slug, 0, -( strlen( $extension ) + 1 ) );
        if ( 'index' === basename( $slug ) ) $slug = trim( dirname( $slug ), './' );
    }
    if ( '' === $slug ) return home_url( '/' ) . $query . $fragment;
    $page = get_page_by_path( $slug );
    return ( $page ? get_permalink( $page ) : home_url( '/' . trailingslashit( $slug ) ) ) . $query . $fragment;
}
add_filter( 'nav_menu_link_attributes', function ( $attributes ) {
    if ( ! empty( $attributes['href'] ) ) $attributes['href'] = bl_url( $attributes['href'] );
    return $attributes;
} );
function bl_page_kind() {
    if ( is_front_page() ) return 'home';
    $template = get_page_template_slug();
    foreach ( array( 'home', 'about', 'projects', 'clients', 'contact' ) as $kind ) {
        if ( 'templates/template-' . $kind . '.php' === $template ) return $kind;
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
    wp_enqueue_style( 'bl-theme', get_theme_file_uri( 'assets/css/mt-style.css' ), array(), bl_asset_version( 'assets/css/mt-style.css' ) );
    wp_enqueue_script( 'bl-theme', get_theme_file_uri( 'assets/js/mt-script.js' ), array( 'jquery' ), bl_asset_version( 'assets/js/mt-script.js' ), true );
} );
add_action( 'admin_notices', function () {
    if ( current_user_can( 'activate_plugins' ) && ! function_exists( 'acf_add_options_page' ) ) {
        echo '<div class="notice notice-warning"><p>BottomLine: activate your licensed ACF Pro plugin to edit the text fields and global settings. The original PHP content remains available.</p></div>';
    }
} );

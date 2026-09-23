<?php
/** Native content editing: Services, Work and Scope of Work tags. */
defined( 'ABSPATH' ) || exit;
add_action( 'init', function () {
    foreach ( array( 'bl_client' => array( 'Clients', 'Client sector', 'dashicons-groups' ), 'bl_service' => array( 'Services', 'Service', 'dashicons-admin-tools' ), 'bl_work' => array( 'Work', 'Work', 'dashicons-portfolio' ) ) as $type => $labels ) {
        register_post_type( $type, array(
            'labels' => array( 'name' => $labels[0], 'singular_name' => $labels[1], 'add_new_item' => 'Add ' . $labels[1], 'edit_item' => 'Edit ' . $labels[1] ),
            'public' => false, 'show_ui' => true, 'show_in_menu' => true,
            'menu_icon' => $labels[2], 'supports' => 'bl_client' === $type ? array( 'title', 'page-attributes' ) : ( 'bl_service' === $type ? array( 'title', 'excerpt', 'page-attributes' ) : array( 'title', 'editor', 'excerpt', 'page-attributes' ) ),
            'rewrite' => false, 'show_in_rest' => false,
        ) );
    }
    register_taxonomy( 'bl_work_category', 'bl_work', array(
        'labels' => array( 'name' => 'Work Categories', 'singular_name' => 'Work Category' ),
        'hierarchical' => true, 'public' => false, 'show_ui' => true, 'show_admin_column' => true,
        'show_in_rest' => false, 'rewrite' => false,
    ) );
    register_taxonomy( 'bl_work_scope', 'bl_work', array(
        'labels' => array( 'name' => 'Scope of Work', 'singular_name' => 'Scope tag', 'add_new_item' => 'Add scope tag', 'separate_items_with_commas' => 'Separate scope tags with commas' ),
        'hierarchical' => false, 'public' => false, 'show_ui' => true, 'show_admin_column' => true,
        'show_in_rest' => false, 'rewrite' => false, 'sort' => true,
    ) );
} );

function bl_content_posts( $type, $home_only = false ) {
    $args = array( 'post_type' => $type, 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'ID' => 'ASC' ), 'no_found_rows' => true );
    if ( $home_only ) {
        $args['meta_key'] = 'work_home_order';
        $args['meta_query'] = array( array( 'key' => 'work_home_order', 'value' => 0, 'compare' => '>', 'type' => 'NUMERIC' ) );
        $args['orderby'] = array( 'meta_value_num' => 'ASC', 'ID' => 'ASC' );
    }
    return get_posts( $args );
}
function bl_text_list( $text ) { return array_values( array_filter( array_map( 'trim', explode( '|', $text ) ), 'strlen' ) ); }
function bl_work_meta( $id ) {
    return array_values( array_filter( array( bl_value( 'work_year', '', $id ), bl_value( 'work_sector', '', $id ), bl_value( 'work_location', '', $id ) ), 'strlen' ) );
}
function bl_work_scope( $id ) {
    $terms = wp_get_object_terms( $id, 'bl_work_scope', array( 'orderby' => 'term_order', 'order' => 'ASC' ) );
    return is_wp_error( $terms ) ? array() : wp_list_pluck( $terms, 'name' );
}
add_action( 'acf/init', function () {
    $groups = array(
        'bl_client' => array( 'client_text_logos' => array( 'Clients without logo images', 'Keep text-only clients using position: name, separated by |. Example: 2: Centrepoint | 4: Femi 9. Remove an entry after adding its logo to the gallery.' ), 'client_gallery' => array( 'Client logos', 'Add logo images and drag to reorder.' ), 'client_placement' => array( 'Display on', 'Enter clients, home, or both.' ) ),
        'bl_service' => array(
            'service_tag' => array( 'Image label', 'Short label displayed over the service image.' ),
            'service_image_url' => array( 'Image URL', 'Paste a Media Library URL or bundled asset path.' ),
            'service_disciplines' => array( 'Disciplines', 'Separate items with |, for example Strategy | Digital | Social.' ),
        ),
        'bl_work' => array(
            'work_category' => array( 'Category label', 'For example Branding · Campaign.' ),
            'work_cover' => array( 'Cover image URL', 'Paste a Media Library URL or bundled asset path.' ),
            'work_year' => array( 'Year', '' ), 'work_sector' => array( 'Sector', '' ), 'work_location' => array( 'Location', '' ),
            'work_gallery' => array( 'Project gallery', 'Add images and drag to reorder.' ),
            'work_home_order' => array( 'Homepage order', 'Enter a positive number to feature this work on the homepage. Leave blank to hide it there.' ),
            'work_home_width' => array( 'Homepage card width', 'Enter wide for a large card; leave blank for a regular card.' ),
            'work_home_title' => array( 'Homepage title override', 'Leave blank to use the post title.' ),
            'work_home_summary' => array( 'Homepage summary override', 'Leave blank to use the Excerpt.' ),
            'work_home_mark' => array( 'Homepage brand mark', 'Short decorative brand name from the original design.' ),
            'work_home_description' => array( 'Homepage description override', 'Leave blank to use the main description. Plain text only.' ),
        ),
    );
    foreach ( $groups as $type => $definitions ) {
        $fields = array();
        foreach ( $definitions as $name => $details ) {
            $gallery = in_array( $name, array( 'client_gallery', 'work_gallery' ), true );
            $fields[] = array( 'key' => 'field_' . $name, 'name' => $name, 'label' => $details[0], 'instructions' => $details[1], 'type' => $gallery ? 'gallery' : 'text', 'return_format' => 'id', 'preview_size' => 'thumbnail', 'default_value' => 'client_placement' === $name ? 'clients' : '' );
        }
        acf_add_local_field_group( array( 'key' => 'group_' . $type, 'title' => 'bl_work' === $type ? 'Work details' : ( 'bl_client' === $type ? 'Client gallery' : 'Service details' ), 'fields' => $fields, 'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => $type ) ) ) ) );
    }
} );

// Use the Classic Editor for every post type and the classic Widgets screen.
add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
add_filter( 'use_block_editor_for_post', '__return_false', 100 );
add_filter( 'use_widgets_block_editor', '__return_false', 100 );

function bl_work_filters( $id ) {
    $terms = wp_get_object_terms( $id, 'bl_work_category', array( 'fields' => 'slugs' ) );
    return is_wp_error( $terms ) ? '' : implode( ' ', $terms );
}

function bl_client_groups( $placement ) {
    return array_values( array_filter( bl_content_posts( 'bl_client' ), function ( $post ) use ( $placement ) {
        $value = bl_value( 'client_placement', 'clients', $post->ID );
        return $placement === $value || 'both' === $value;
    } ) );
}
function bl_client_gallery( $post ) {
    return bl_gallery_ids( 'client_gallery', $post->ID );
}

function bl_gallery_ids( $name, $id ) {
    // Raw attachment IDs work with or without ACF active; never expose gallery JSON to the browser.
    $value = get_post_meta( $id, $name, true );
    return is_array( $value ) ? array_values( array_filter( array_map( 'absint', $value ) ) ) : array();
}

function bl_client_items( $post ) {
    $items = bl_client_gallery( $post );
    $text = array();
    foreach ( bl_text_list( bl_value( 'client_text_logos', '', $post->ID ) ) as $entry ) {
        if ( preg_match( '/^(\d+):\s*(.+)$/u', $entry, $match ) ) $text[] = array( 'position' => max( 0, (int) $match[1] - 1 ), 'label' => $match[2] );
    }
    usort( $text, function ( $a, $b ) { return $a['position'] <=> $b['position']; } );
    foreach ( $text as $entry ) array_splice( $items, min( count( $items ), $entry['position'] ), 0, array( $entry['label'] ) );
    return $items;
}

add_filter( 'acf/validate_value/name=client_placement', function ( $valid, $value ) {
    return true !== $valid || in_array( $value, array( 'clients', 'home', 'both' ), true ) ? $valid : 'Enter clients, home, or both.';
}, 10, 2 );
add_filter( 'acf/validate_value/name=work_home_order', function ( $valid, $value ) {
    return true !== $valid || '' === $value || ( ctype_digit( (string) $value ) && (int) $value > 0 ) ? $valid : 'Enter a positive number, or leave blank.';
}, 10, 2 );

<?php
/** Import the supplied content once; later edits and deletions remain under admin control. */
defined( 'ABSPATH' ) || exit;
function bl_legacy_value( $prefix, $default, $page_id = 0 ) {
    static $fields;
    if ( null === $fields ) $fields = require __DIR__ . '/legacy-fields.php';
    $result = $default;
    foreach ( $fields as $name => $original ) {
        if ( strpos( $name, $prefix ) !== 0 || $original !== $default ) continue;
        if ( $page_id && metadata_exists( 'post', $page_id, $name ) ) $result = get_post_meta( $page_id, $name, true );
        elseif ( false !== get_option( 'options_' . $name, false ) ) $result = get_option( 'options_' . $name );
    }
    return $result;
}
function bl_seed_meta( $id, $fields ) {
    foreach ( $fields as $name => $value ) {
        if ( metadata_exists( 'post', $id, $name ) ) continue;
        update_post_meta( $id, $name, $value );
        update_post_meta( $id, '_' . $name, 'field_' . $name );
    }
}
function bl_import_content_run() {
    if ( '2.2' === get_option( 'bl_content_version' ) ) return;
    $defaults = require __DIR__ . '/default-content.php';
    $home = get_page_by_path( 'home' );
    $home_id = (int) get_option( 'page_on_front' ) ?: ( $home ? $home->ID : 0 );
    $clients = get_page_by_path( 'clients' );
    $legacy = require __DIR__ . '/legacy-fields.php';
    foreach ( array( 'branding' => 'Branding', 'events' => 'Events', 'digital' => 'Digital', 'campaign' => 'Campaign', 'activation' => 'Activation', 'retail' => 'Retail' ) as $slug => $name ) {
        if ( ! term_exists( $slug, 'bl_work_category' ) ) wp_insert_term( $name, 'bl_work_category', array( 'slug' => $slug ) );
    }
    foreach ( $defaults['services'] as $order => $service ) {
        $slug = sanitize_title( $service['title'] );
        $existing = get_page_by_path( $slug, OBJECT, 'bl_service' );
        if ( $existing ) continue;
        $id = wp_insert_post( array( 'post_type' => 'bl_service', 'post_status' => 'publish', 'post_name' => $slug, 'post_title' => bl_legacy_value( 'bl_home_', $service['title'], $home_id ), 'post_excerpt' => bl_legacy_value( 'bl_home_', $service['description'], $home_id ), 'menu_order' => $order ), true );
        if ( is_wp_error( $id ) ) return;
        bl_seed_meta( $id, array( 'service_tag' => bl_legacy_value( 'bl_home_', $service['tag'], $home_id ), 'service_image_url' => bl_legacy_value( 'bl_home_', $service['image'], $home_id ), 'service_disciplines' => implode( ' | ', array_map( function ( $text ) use ( $home_id ) { return bl_legacy_value( 'bl_home_', $text, $home_id ); }, $service['disciplines'] ) ) ) );
    }
    foreach ( $defaults['work'] as $order => $work ) {
        $slug = $work['slug'];
        $existing = get_page_by_path( $slug, OBJECT, 'bl_work' );
        if ( $existing && ! get_post_meta( $existing->ID, '_bl_import_pending', true ) ) continue;
        $prefix = 'bl_project_' . str_replace( '-', '_', $slug ) . '_';
        $id = $existing ? $existing->ID : wp_insert_post( array( 'post_type' => 'bl_work', 'post_status' => 'publish', 'post_name' => $slug, 'post_title' => bl_legacy_value( $prefix, $work['title'] ), 'post_excerpt' => bl_legacy_value( $prefix, $work['brief'] ), 'post_content' => $work['desc'], 'menu_order' => $order ), true );
        if ( is_wp_error( $id ) ) return;
        update_post_meta( $id, '_bl_import_pending', 1 );
        $meta = array(
            'work_category' => bl_legacy_value( $prefix, $work['cat'] ),
            'work_cover' => bl_legacy_value( $prefix, $work['images'][0] ),
            'work_gallery' => array(),
            'work_year' => bl_legacy_value( $prefix, $work['meta'][0] ?? '' ),
            'work_sector' => bl_legacy_value( $prefix, $work['meta'][1] ?? '' ),
            'work_location' => bl_legacy_value( $prefix, $work['meta'][2] ?? '' ),
        );
        if ( $work['home'] ) {
            $meta['work_home_order'] = (string) $work['home']['order'];
            $meta['work_home_width'] = $work['home']['wide'] ? 'wide' : '';
            $meta['work_home_title'] = bl_legacy_value( 'bl_home_', $work['home']['title'], $home_id );
            $meta['work_home_summary'] = bl_legacy_value( 'bl_home_', $work['home']['brief'], $home_id );
            $meta['work_home_mark'] = bl_legacy_value( 'bl_home_', $work['home']['mark'], $home_id );
            // Only store an override when the original home copy differs.
            $meta['work_home_description'] = $work['home']['description'] === $work['desc'] ? '' : wp_strip_all_tags( $work['home']['description'] );
        }
        foreach ( $work['images'] as $image ) {
            $image_id = bl_import_image( $image, $work['title'] );
            if ( ! $image_id ) return;
            $meta['work_gallery'][] = $image_id;
        }
        bl_seed_meta( $id, $meta );
        wp_set_object_terms( $id, $work['scope'], 'bl_work_scope' );
        wp_set_object_terms( $id, $work['filters'], 'bl_work_category' );
        delete_post_meta( $id, '_bl_import_pending' );
    }
    $contact = get_page_by_path( 'contact' );
    if ( $contact ) {
        foreach ( array(
            'bl_contact_046' => 'bl_marketing_phone',
            'bl_contact_048' => 'bl_contact_email',
            'bl_contact_051' => 'bl_events_phone',
            'bl_contact_053' => 'bl_jeddah_office',
            'bl_contact_054' => 'bl_jeddah_address',
            'bl_contact_056' => 'bl_riyadh_office',
            'bl_contact_057' => 'bl_riyadh_address',
        ) as $old => $new ) {
            if ( metadata_exists( 'post', $contact->ID, $old ) && false === get_option( 'options_' . $new, false ) ) {
                update_option( 'options_' . $new, get_post_meta( $contact->ID, $old, true ), false );
                update_option( '_options_' . $new, 'field_' . $new, false );
            }
        }
    }
    // Migrate the old shared footer copy if an editor had changed it.
    if ( false === get_option( 'options_bl_footer_description', false ) && false !== get_option( 'options_bl_global_footer_004', false ) ) {
        update_option( 'options_bl_footer_description', get_option( 'options_bl_global_footer_004' ), false );
        update_option( '_options_bl_footer_description', 'field_bl_footer_description', false );
    }
    if ( ! bl_import_clients() ) return;
    update_option( 'bl_content_version', '2.2', false );
}
function bl_import_content() {
    if ( '2.2' === get_option( 'bl_content_version' ) ) return;
    $lock = (int) get_option( 'bl_import_lock' );
    if ( $lock && $lock < time() - 300 ) delete_option( 'bl_import_lock' );
    if ( ! add_option( 'bl_import_lock', time(), '', false ) ) return;
    try { bl_import_content_run(); } finally { delete_option( 'bl_import_lock' ); }
}
add_action( 'init', 'bl_import_content', 20 );

function bl_import_clients() {
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $groups = require __DIR__ . '/default-clients.php';
    foreach ( $groups as $order => $group ) {
        $slug = sanitize_title( $group['title'] );
        $existing = get_page_by_path( $slug, OBJECT, 'bl_client' );
        if ( $existing ) {
            bl_seed_meta( $existing->ID, array( 'client_text_logos' => implode( ' | ', $group['text_logos'] ?? array() ) ) );
            continue;
        }
        $images = array();
        foreach ( $group['images'] as $image ) {
            $id = bl_import_image( $image['path'], $image['alt'] );
            if ( ! $id ) return false;
            $images[] = $id;
        }
        $id = wp_insert_post( array( 'post_type' => 'bl_client', 'post_status' => 'publish', 'post_title' => $group['title'], 'post_name' => $slug, 'post_content' => '', 'menu_order' => $order ), true );
        if ( is_wp_error( $id ) ) return false;
        bl_seed_meta( $id, array( 'client_placement' => $group['placement'], 'client_gallery' => $images, 'client_text_logos' => implode( ' | ', $group['text_logos'] ?? array() ) ) );
    }
    return true;
}

function bl_import_image( $asset, $alt ) {
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $existing = get_posts( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'posts_per_page' => 1, 'meta_key' => '_bl_original_asset', 'meta_value' => $asset, 'fields' => 'ids' ) );
    if ( $existing ) return (int) $existing[0];
    $file = get_theme_file_path( 'assets/' . $asset );
    if ( ! is_file( $file ) ) return 0;
    $upload = wp_upload_bits( basename( $asset ), null, file_get_contents( $file ) );
    if ( $upload['error'] ) return 0;
    $id = wp_insert_attachment( array( 'post_mime_type' => wp_check_filetype( $upload['file'] )['type'], 'post_title' => $alt, 'post_status' => 'inherit' ), $upload['file'], 0, true );
    if ( is_wp_error( $id ) ) return 0;
    update_post_meta( $id, '_wp_attachment_image_alt', $alt );
    update_post_meta( $id, '_bl_original_asset', $asset );
    wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
    return (int) $id;
}

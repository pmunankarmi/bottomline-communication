<?php
/** Media Library helpers and migration away from image files bundled in the theme. */
defined( 'ABSPATH' ) || exit;

define( 'BOTTOMLINE_MEDIA_RELEASE', 'v' . wp_get_theme( get_template() )->get( 'Version' ) );
define( 'BOTTOMLINE_MEDIA_MIGRATION_VERSION', '3.1' );

function bl_attachment_by_source( $asset ) {
    $ids = get_posts( array(
        'post_type' => 'attachment', 'post_status' => 'inherit', 'posts_per_page' => 1,
        'meta_key' => '_bl_original_asset', 'meta_value' => ltrim( $asset, '/' ), 'fields' => 'ids',
    ) );
    return $ids ? (int) $ids[0] : 0;
}

function bl_media_source_file( $asset ) {
    $asset = ltrim( $asset, '/' );
    if ( defined( 'BOTTOMLINE_MEDIA_SOURCE_DIR' ) ) {
        $file = trailingslashit( BOTTOMLINE_MEDIA_SOURCE_DIR ) . $asset;
        if ( is_file( $file ) ) return $file;
    }
    $legacy = get_theme_file_path( 'assets/' . $asset );
    if ( is_file( $legacy ) ) return $legacy;

    static $directory;
    if ( null === $directory ) {
        if ( get_transient( 'bottomline_media_download_failed' ) ) return '';
        require_once ABSPATH . 'wp-admin/includes/file.php';
        $directory = trailingslashit( get_temp_dir() ) . 'bottomline-media-' . BOTTOMLINE_MEDIA_RELEASE;
        if ( ! is_file( $directory . '/.ready' ) ) {
            $zip = download_url( 'https://github.com/pmunankarmi/bottomline-communication/releases/download/' . BOTTOMLINE_MEDIA_RELEASE . '/bottomline-media.zip', 30 );
            if ( is_wp_error( $zip ) ) {
                set_transient( 'bottomline_media_download_failed', 1, 5 * MINUTE_IN_SECONDS );
                $directory = '';
                return '';
            }
            if ( ! WP_Filesystem() ) {
                wp_delete_file( $zip );
                set_transient( 'bottomline_media_download_failed', 1, 5 * MINUTE_IN_SECONDS );
                $directory = '';
                return '';
            }
            $result = unzip_file( $zip, $directory );
            wp_delete_file( $zip );
            if ( is_wp_error( $result ) ) {
                set_transient( 'bottomline_media_download_failed', 1, 5 * MINUTE_IN_SECONDS );
                $directory = '';
                return '';
            }
            global $wp_filesystem;
            $wp_filesystem->put_contents( $directory . '/.ready', '', FS_CHMOD_FILE );
            delete_transient( 'bottomline_media_download_failed' );
        }
    }
    if ( ! $directory ) return '';
    $file = $directory . '/media-library-source/' . $asset;
    return is_file( $file ) ? $file : '';
}

function bl_media_url( $field, $post_id, $size = 'full' ) {
    $value = get_post_meta( $post_id, $field, true );
    $id = absint( $value );
    if ( ! $id && is_string( $value ) ) {
        $id = attachment_url_to_postid( $value );
        if ( ! $id ) $id = bl_attachment_by_source( $value );
    }
    return $id ? ( wp_get_attachment_image_url( $id, $size ) ?: '' ) : '';
}

function bl_migrate_media_fields() {
    if ( BOTTOMLINE_MEDIA_MIGRATION_VERSION === get_option( 'bl_media_fields_version' ) ) return;
    $complete = true;
    foreach ( array( 'bl_service' => 'service_image_url', 'bl_work' => 'work_cover' ) as $type => $field ) {
        foreach ( bl_content_posts( $type ) as $post ) {
            $value = get_post_meta( $post->ID, $field, true );
            if ( absint( $value ) && wp_attachment_is_image( absint( $value ) ) ) continue;
            $id = is_string( $value ) ? attachment_url_to_postid( $value ) : 0;
            if ( ! $id && is_string( $value ) ) $id = bl_attachment_by_source( $value );
            if ( ! $id && 'bl_work' === $type ) $id = (int) ( bl_gallery_ids( 'work_gallery', $post->ID )[0] ?? 0 );
            if ( ! $id && is_string( $value ) && '' !== $value ) $id = bl_import_image( $value, $post->post_title );
            if ( $id ) {
                update_post_meta( $post->ID, $field, $id );
                update_post_meta( $post->ID, '_' . $field, 'field_' . $field );
            } else $complete = false;
        }
    }

    $logo = (int) get_theme_mod( 'custom_logo' );
    if ( ! $logo ) $logo = bl_import_image( 'bottomline-logo-white.svg', 'BottomLine' );
    if ( $logo ) set_theme_mod( 'custom_logo', $logo );
    else $complete = false;
    foreach ( array(
        'bottomline-logo-color.svg' => 'BottomLine colour logo',
        'clients/k-logo.png' => 'K logo',
        'clients/naies.png' => 'NAIES',
        'clients/nashir.png' => 'Nashir',
        'clients/rekab.png' => 'Rekab',
    ) as $asset => $alt ) {
        if ( ! bl_import_image( $asset, $alt ) ) $complete = false;
    }
    if ( $complete ) update_option( 'bl_media_fields_version', BOTTOMLINE_MEDIA_MIGRATION_VERSION, false );
}
add_action( 'init', 'bl_migrate_media_fields', 35 );

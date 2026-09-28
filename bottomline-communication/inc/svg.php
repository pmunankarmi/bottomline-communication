<?php
/** Administrator-only SVG uploads with basic active-content validation. */
defined( 'ABSPATH' ) || exit;

add_filter( 'upload_mimes', function ( $mimes ) {
    if ( current_user_can( 'manage_options' ) ) $mimes['svg'] = 'image/svg+xml';
    return $mimes;
} );

add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename ) {
    if ( current_user_can( 'manage_options' ) && 'svg' === strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) ) ) {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
        $data['proper_filename'] = $filename;
    }
    return $data;
}, 10, 3 );

add_filter( 'wp_handle_upload_prefilter', function ( $file ) {
    if ( 'image/svg+xml' !== ( $file['type'] ?? '' ) && 'svg' !== strtolower( pathinfo( $file['name'] ?? '', PATHINFO_EXTENSION ) ) ) return $file;
    if ( ! current_user_can( 'manage_options' ) ) {
        $file['error'] = 'Only administrators can upload SVG files.';
        return $file;
    }
    $svg = file_get_contents( $file['tmp_name'] );
    if ( false === $svg || ! preg_match( '/<svg\b/i', $svg ) || preg_match( '/<!DOCTYPE|<!ENTITY|<script\b|<foreignObject\b|\bon\w+\s*=|javascript:|data:text\/html|@import|expression\s*\(/i', $svg ) ) {
        $file['error'] = 'This SVG contains unsupported or unsafe content.';
    }
    return $file;
} );

add_filter( 'wp_prepare_attachment_for_js', function ( $response, $attachment ) {
    if ( 'image/svg+xml' === $attachment->post_mime_type && ! empty( $response['url'] ) ) {
        $response['sizes']['full'] = array( 'url' => $response['url'], 'width' => 512, 'height' => 512, 'orientation' => 'landscape' );
    }
    return $response;
}, 10, 2 );

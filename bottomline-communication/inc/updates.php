<?php
/** Offer published GitHub releases through the native WordPress theme updater. */
defined( 'ABSPATH' ) || exit;

function bl_theme_release_update( $update, $theme_data, $stylesheet ) {
    $repo = 'https://github.com/pmunankarmi/bottomline-communication';
    if ( 'bottomline-communication' !== $stylesheet || $repo !== ( $theme_data['UpdateURI'] ?? '' ) ) return $update;

    // WordPress already caches update checks. Do not add another cache that delays Check again.
    $response = wp_remote_get( 'https://api.github.com/repos/pmunankarmi/bottomline-communication/releases/latest', array(
        'timeout' => 10,
        'headers' => array( 'Accept' => 'application/vnd.github+json' ),
    ) );
    if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) return $update;
    $release = json_decode( wp_remote_retrieve_body( $response ), true );
    if ( ! is_array( $release ) || ! empty( $release['draft'] ) || ! empty( $release['prerelease'] ) ) return $update;
    $tag = $release['tag_name'] ?? '';
    if ( ! is_string( $tag ) || ! preg_match( '/^v(\d+\.\d+\.\d+)$/', $tag, $match ) ) return $update;

    // Only accept the installable theme asset, never GitHub's whole-repository source ZIP.
    $package = $repo . '/releases/download/' . $tag . '/bottomline-communication.zip';
    foreach ( (array) ( $release['assets'] ?? array() ) as $asset ) {
        if ( 'bottomline-communication.zip' === ( $asset['name'] ?? '' ) && $package === ( $asset['browser_download_url'] ?? '' ) ) {
            return array(
                'id' => $repo,
                'theme' => $stylesheet,
                'version' => $match[1],
                'url' => $repo . '/releases/tag/' . $tag,
                'package' => $package,
                'requires' => '6.4',
                'requires_php' => '7.4',
            );
        }
    }
    return $update;
}
add_filter( 'update_themes_github.com', 'bl_theme_release_update', 10, 3 );

// Clear an older result after installing or switching to this theme.
add_action( 'after_switch_theme', function () { delete_site_transient( 'update_themes' ); } );

<?php
/** Test the real WordPress update pipeline with controlled HTTP responses. */
$path = getenv( 'BL_WP_PATH' );
if ( ! $path || ! is_file( $path . '/wp-load.php' ) ) exit( 'Set BL_WP_PATH.' );
require $path . '/wp-load.php';
if ( 'local' !== wp_get_environment_type() ) exit( 'Local test site required.' );
function check_update( $ok, $message ) { if ( ! $ok ) throw new RuntimeException( $message ); echo "PASS: $message\n"; }
$repo = 'https://github.com/pmunankarmi/bottomline-communication';
$release = array( 'tag_name' => 'v2.0.2', 'assets' => array( array( 'name' => 'bottomline-communication.zip', 'browser_download_url' => $repo . '/releases/download/v2.0.2/bottomline-communication.zip' ) ) );
$failure = false;
$mock = function ( $pre, $args, $url ) use ( &$release, &$failure ) {
    if ( strpos( $url, 'https://api.github.com/repos/pmunankarmi/bottomline-communication/' ) === 0 ) {
        return $failure ? new WP_Error( 'offline', 'Simulated outage' ) : array( 'response' => array( 'code' => 200 ), 'body' => wp_json_encode( $release ) );
    }
    if ( strpos( $url, 'api.wordpress.org/themes/update-check/' ) !== false ) return array( 'response' => array( 'code' => 200 ), 'body' => '{"themes":[],"no_update":[],"translations":[]}' );
    return new WP_Error( 'test_network_blocked', 'No external HTTP during test' );
};
add_filter( 'pre_http_request', $mock, 10, 3 );
$previous = get_site_transient( 'update_themes' );
try {
    $headers = array( 'UpdateURI' => $repo );
    check_update( false === bl_theme_release_update( false, $headers, 'another-theme' ), 'Unrelated themes are untouched' );
    delete_site_transient( 'update_themes' );
    wp_update_themes();
    $result = get_site_transient( 'update_themes' );
    check_update( '2.0.2' === ( $result->response['bottomline-communication']['new_version'] ?? '' ), 'WordPress creates an Update available entry for a newer release' );
    check_update( $release['assets'][0]['browser_download_url'] === $result->response['bottomline-communication']['package'], 'Native updater receives installable theme ZIP' );
    $release['tag_name'] = 'v2.0.1';
    $release['assets'][0]['browser_download_url'] = $repo . '/releases/download/v2.0.1/bottomline-communication.zip';
    delete_site_transient( 'update_themes' );
    wp_update_themes();
    $result = get_site_transient( 'update_themes' );
    check_update( empty( $result->response['bottomline-communication'] ) && isset( $result->no_update['bottomline-communication'] ), 'Installed current version does not show a false update' );
    $release['prerelease'] = true;
    check_update( false === bl_theme_release_update( false, $headers, 'bottomline-communication' ), 'Prereleases are ignored' );
    $release['prerelease'] = false;
    $release['assets'][0]['browser_download_url'] = 'https://example.org/untrusted.zip';
    check_update( false === bl_theme_release_update( false, $headers, 'bottomline-communication' ), 'Unexpected package URLs are rejected' );
    $failure = true;
    check_update( false === bl_theme_release_update( false, $headers, 'bottomline-communication' ), 'Network failure is handled without a broken update' );
} finally {
    remove_filter( 'pre_http_request', $mock, 10 );
    if ( false === $previous ) delete_site_transient( 'update_themes' ); else set_site_transient( 'update_themes', $previous );
}

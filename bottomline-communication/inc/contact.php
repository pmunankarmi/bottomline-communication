<?php
defined( 'ABSPATH' ) || exit;
function bl_brief_sent() {
    $token = isset( $_GET['brief'] ) && is_string( $_GET['brief'] ) ? sanitize_key( wp_unslash( $_GET['brief'] ) ) : '';
    return $token && 'sent' === get_transient( 'bl_brief_' . $token );
}
function bl_form_notice() {
    // Successful submissions use a short-lived opaque receipt, never email or form data in the URL.
}
add_action( 'admin_post_bl_brief', 'bl_handle_brief' );
add_action( 'admin_post_nopriv_bl_brief', 'bl_handle_brief' );
function bl_handle_brief() {
    if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) ) wp_die( 'Method not allowed.', '', array( 'response' => 405 ) );
    $nonce = isset( $_POST['bl_nonce'] ) && is_string( $_POST['bl_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['bl_nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'bl_brief' ) ) wp_die( 'Your form expired. Please go back, reload the page and try again.', '', array( 'response' => 403, 'back_link' => true ) );
    if ( ! empty( $_POST['website'] ) ) wp_die( 'Unable to accept this submission.', '', array( 'response' => 400 ) );
    $input = array();
    foreach ( array( 'name', 'email', 'phone', 'company', 'budget', 'timeline', 'message' ) as $key ) {
        $raw = $_POST[ $key ] ?? '';
        if ( ! is_string( $raw ) || strlen( $raw ) > 10000 ) wp_die( 'Invalid form input.', '', array( 'response' => 400, 'back_link' => true ) );
        $input[ $key ] = 'message' === $key ? sanitize_textarea_field( wp_unslash( $raw ) ) : sanitize_text_field( wp_unslash( $raw ) );
    }
    $allowed = wp_list_pluck( bl_content_posts( 'bl_service' ), 'post_title' );
    $submitted = isset( $_POST['service'] ) && is_array( $_POST['service'] ) ? wp_unslash( $_POST['service'] ) : array();
    $services = array_intersect( $allowed, array_filter( $submitted, 'is_string' ) );
    if ( ! $input['name'] || ! is_email( $input['email'] ) || ! $input['message'] || ! $services ) wp_die( 'Please enter your name, a valid email, at least one service and your project brief.', '', array( 'response' => 400, 'back_link' => true ) );
    $rate_key = 'bl_rate_' . hash_hmac( 'sha256', $_SERVER['REMOTE_ADDR'] ?? '', wp_salt() );
    if ( get_transient( $rate_key ) ) wp_die( 'Please wait one minute before sending another brief.', '', array( 'response' => 429, 'back_link' => true ) );
    $recipient = sanitize_email( bl_value( 'bl_brief_recipient', get_option( 'admin_email' ), 'option' ) );
    if ( ! is_email( $recipient ) ) $recipient = get_option( 'admin_email' );
    $message = "New BottomLine project brief\n\n";
    foreach ( $input as $key => $value ) $message .= ucfirst( $key ) . ': ' . $value . "\n\n";
    $message .= 'Services: ' . implode( ', ', $services );
    set_transient( $rate_key, 1, MINUTE_IN_SECONDS );
    $submission_id = bl_save_submission( $input, $services );
    if ( is_wp_error( $submission_id ) ) {
        delete_transient( $rate_key );
        wp_die( 'Your brief could not be saved. Please try again or call our team.', '', array( 'response' => 503, 'back_link' => true ) );
    }
    $sent = wp_mail( $recipient, 'BottomLine project brief: ' . $input['name'], $message, array( 'Reply-To: ' . sanitize_email( $input['email'] ) ) );
    update_post_meta( $submission_id, '_bl_delivery', $sent ? 'Accepted by mail transport' : 'Failed — brief saved' );
    $token = strtolower( wp_generate_password( 32, false, false ) );
    set_transient( 'bl_brief_' . $token, 'sent', 10 * MINUTE_IN_SECONDS );
    wp_safe_redirect( add_query_arg( 'brief', $token, bl_url( 'contact.html' ) ) . '#form', 303 );
    exit;
}
add_action( 'template_redirect', function () {
    if ( 'contact' === bl_page_kind() ) {
        if ( ! defined( 'DONOTCACHEPAGE' ) ) define( 'DONOTCACHEPAGE', true );
        nocache_headers();
    }
} );

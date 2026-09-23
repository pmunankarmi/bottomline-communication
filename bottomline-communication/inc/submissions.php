<?php
/** Private form storage and an administrator-only screen/export. */
defined( 'ABSPATH' ) || exit;
add_action( 'init', function () {
    register_post_type( 'bl_submission', array( 'label' => 'Form Submissions', 'public' => false, 'publicly_queryable' => false, 'show_ui' => false, 'show_in_rest' => false, 'rewrite' => false, 'query_var' => false, 'exclude_from_search' => true, 'supports' => array(), 'capabilities' => array( 'edit_posts' => 'manage_options', 'read_private_posts' => 'manage_options', 'create_posts' => 'do_not_allow' ), 'map_meta_cap' => false ) );
} );
function bl_save_submission( $input, $services ) {
    $meta = array();
    foreach ( $input as $key => $value ) $meta[ '_bl_' . $key ] = $value;
    $meta['_bl_services'] = implode( ', ', $services );
    $meta['_bl_delivery'] = 'Pending';
    return wp_insert_post( array( 'post_type' => 'bl_submission', 'post_status' => 'private', 'post_title' => $input['name'], 'meta_input' => $meta ), true );
}
function bl_submission_columns() {
    return array( 'name' => 'Name', 'email' => 'Email', 'phone' => 'Phone', 'company' => 'Company', 'services' => 'Services', 'budget' => 'Budget', 'timeline' => 'Timeline', 'message' => 'Message', 'delivery' => 'Email notification' );
}
add_action( 'admin_menu', function () {
    add_menu_page( 'Form Submissions', 'Form Submissions', 'manage_options', 'bottomline-submissions', 'bl_submissions_screen', 'dashicons-feedback', 26 );
} );
function bl_submissions_screen() {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'You cannot view submissions.', '', array( 'response' => 403 ) );
    $page = isset( $_GET['paged'] ) ? max( 1, absint( $_GET['paged'] ) ) : 1;
    $query = new WP_Query( array( 'post_type' => 'bl_submission', 'post_status' => 'private', 'posts_per_page' => 20, 'paged' => $page, 'orderby' => 'ID', 'order' => 'DESC' ) );
    ?>
    <div class="wrap"><h1>Form Submissions</h1>
      <p>Contact briefs are saved here even if the email notification fails.</p>
      <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
        <input type="hidden" name="action" value="bl_export_submissions">
        <?php wp_nonce_field( 'bl_export_submissions' ); submit_button( 'Export CSV', 'secondary', 'submit', false ); ?>
      </form><br>
      <table class="widefat striped"><thead><tr><th>Date</th><th>Name / Company</th><th>Contact</th><th>Brief</th><th>Email notification</th></tr></thead><tbody>
        <?php if ( ! $query->posts ) : ?><tr><td colspan="5">No submissions yet.</td></tr><?php endif; ?>
        <?php foreach ( $query->posts as $entry ) : ?>
        <tr>
          <td><?php echo esc_html( get_the_date( 'Y-m-d H:i', $entry ) ); ?></td>
          <td><?php echo esc_html( get_post_meta( $entry->ID, '_bl_name', true ) ); ?><br><?php echo esc_html( get_post_meta( $entry->ID, '_bl_company', true ) ); ?></td>
          <td><?php echo esc_html( get_post_meta( $entry->ID, '_bl_email', true ) ); ?><br><?php echo esc_html( get_post_meta( $entry->ID, '_bl_phone', true ) ); ?></td>
          <td><details><summary>View brief</summary><?php foreach ( array( 'services' => 'Services', 'budget' => 'Budget', 'timeline' => 'Timeline', 'message' => 'Message' ) as $key => $label ) : ?><p><strong><?php echo esc_html( $label ); ?>:</strong><br><?php echo nl2br( esc_html( get_post_meta( $entry->ID, '_bl_' . $key, true ) ) ); ?></p><?php endforeach; ?></details></td>
          <td><?php echo esc_html( get_post_meta( $entry->ID, '_bl_delivery', true ) ); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody></table>
      <?php echo wp_kses_post( paginate_links( array( 'base' => add_query_arg( 'paged', '%#%', admin_url( 'admin.php?page=bottomline-submissions' ) ), 'format' => '', 'current' => $page, 'total' => $query->max_num_pages ) ) ); ?>
    </div>
    <?php
}
function bl_csv_cell( $value ) {
    $value = (string) $value;
    // Neutralize spreadsheet formulas, including formulas prefixed by whitespace.
    return preg_match( '/^[\s]*[=+@-]|^[\t\r\n]/u', $value ) ? "'" . $value : $value;
}
add_action( 'admin_post_bl_export_submissions', function () {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'You cannot export submissions.', '', array( 'response' => 403 ) );
    check_admin_referer( 'bl_export_submissions' );
    nocache_headers();
    header( 'Content-Type: text/csv; charset=utf-8' );
    header( 'Content-Disposition: attachment; filename="bottomline-submissions-' . gmdate( 'Y-m-d' ) . '.csv"' );
    $stream = fopen( 'php://output', 'w' );
    fwrite( $stream, "\xEF\xBB\xBF" );
    fputcsv( $stream, array_merge( array( 'ID', 'Date' ), array_values( bl_submission_columns() ) ), ',', '"', '' );
    $page = 1;
    do {
        $entries = get_posts( array( 'post_type' => 'bl_submission', 'post_status' => 'private', 'posts_per_page' => 200, 'paged' => $page++, 'orderby' => 'ID', 'order' => 'DESC' ) );
        foreach ( $entries as $entry ) {
            $row = array( $entry->ID, $entry->post_date );
            foreach ( bl_submission_columns() as $key => $label ) $row[] = get_post_meta( $entry->ID, '_bl_' . $key, true );
            fputcsv( $stream, array_map( 'bl_csv_cell', $row ), ',', '"', '' );
        }
    } while ( count( $entries ) === 200 );
    fclose( $stream );
    exit;
} );

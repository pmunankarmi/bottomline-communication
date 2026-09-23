<?php
/** Move existing About story fields into the native page editor once. */
defined( 'ABSPATH' ) || exit;
function bl_migrate_about_story() {
    if ( get_option( 'bl_about_story_editor_migrated' ) ) return;
    $pages = get_posts( array( 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => -1, 'meta_key' => '_wp_page_template', 'meta_value' => 'template-about.php' ) );
    if ( ! $pages ) return;
    foreach ( $pages as $page ) {
        if ( '' !== trim( $page->post_content ) ) continue;
        $page_id = $page->ID;
        ob_start();
        ?>
        <p><?php echo esc_html( bl_value('bl_about_008', 'BottomLine is a Marketing, Communication and Events agency established for', $page_id) ); ?> <strong><?php echo esc_html( bl_value('bl_about_009', 'more than 14 years', $page_id) ); ?></strong><?php echo esc_html( bl_value('bl_about_010', ', operated by a team of top-notch creative and experienced talents with hands-on experience in KSA and the MENA region.', $page_id) ); ?></p>
        <p><?php echo esc_html( bl_value('bl_about_011', 'We maintain an extended regional presence across', $page_id) ); ?> <strong><?php echo esc_html( bl_value('bl_about_012', 'Riyadh, Jeddah, Dubai and Beirut', $page_id) ); ?></strong><?php echo esc_html( bl_value('bl_about_013', '.', $page_id) ); ?></p>
        <blockquote>
          <p><?php echo esc_html( bl_value('bl_about_014', 'At BottomLine we strive to be your creative and performance-oriented success partner and consultants.', $page_id) ); ?></p>
        </blockquote>
        <p><?php echo esc_html( bl_value('bl_about_015', 'Our support starts with defining your business needs and the strategic actions to achieving your targets, while keeping your key objectives at the core of everything we do.', $page_id) ); ?></p>
        <?php
        $content = trim( ob_get_clean() );
        $result = wp_update_post( array( 'ID' => $page_id, 'post_content' => wp_slash( $content ) ), true );
        if ( is_wp_error( $result ) ) return;
    }
    update_option( 'bl_about_story_editor_migrated', 1, false );
}
add_action( 'init', 'bl_migrate_about_story', 25 );

/** Consolidate the Presence title without replacing existing editor changes. */
function bl_migrate_presence_heading() {
    if ( get_option( 'bl_presence_heading_migrated' ) ) return;
    $pages = get_posts( array( 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => -1, 'meta_key' => '_wp_page_template', 'meta_value' => 'template-about.php' ) );
    if ( ! $pages ) return;
    foreach ( $pages as $page ) {
        if ( metadata_exists( 'post', $page->ID, 'bl_presence_heading' ) ) continue;
        $heading = trim( bl_value( 'bl_about_032', 'Four cities.', $page->ID ) . ' ' . bl_value( 'bl_about_033', 'One creative engine.', $page->ID ) );
        update_post_meta( $page->ID, 'bl_presence_heading', $heading );
        update_post_meta( $page->ID, '_bl_presence_heading', 'field_bl_presence_heading' );
    }
    update_option( 'bl_presence_heading_migrated', 1, false );
}
add_action( 'init', 'bl_migrate_presence_heading', 26 );

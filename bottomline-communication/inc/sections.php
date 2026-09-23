<?php
/** Section content helpers and one-time migration. */
defined( 'ABSPATH' ) || exit;
function bl_copy( $name, $default, $page_id = null ) {
    $page_id = $page_id ?: get_queried_object_id();
    return metadata_exists( 'post', $page_id, $name ) ? (string) get_post_meta( $page_id, $name, true ) : $default;
}
function bl_section( $name, $inline = false ) {
    $html = (string) get_post_meta( get_queried_object_id(), $name, true );
    if ( $inline ) {
        $html = preg_replace( '~</p>\s*<p[^>]*>~i', '<br>', $html );
        echo wp_kses( $html, array( 'strong' => array(), 'em' => array(), 'br' => array(), 'span' => array( 'class' => array(), 'style' => array() ) ) );
    } else echo wp_kses_post( wpautop( $html ) );
}
function bl_section_button( $name, $class = '', $style = '' ) {
    $link = get_post_meta( get_queried_object_id(), $name, true );
    if ( ! is_array( $link ) || empty( $link['url'] ) ) return;
    echo '<a href="' . esc_url( bl_url( $link['url'] ) ) . '" class="' . esc_attr( $class ) . '" style="' . esc_attr( $style ) . '"';
    if ( '_blank' === ( $link['target'] ?? '' ) ) echo ' target="_blank" rel="noopener noreferrer"';
    echo '>' . esc_html( $link['title'] ?? '' ) . '</a>';
}
function bl_section_rows( $name, $columns, $page_id = null ) {
    $page_id = $page_id ?: get_queried_object_id();
    $rows = array();
    $count = (int) get_post_meta( $page_id, $name, true );
    for ( $i = 0; $i < $count; $i++ ) {
        $row = array();
        foreach ( $columns as $column ) $row[$column] = (string) get_post_meta( $page_id, $name . '_' . $i . '_' . $column, true );
        $rows[] = $row;
    }
    return $rows;
}
function bl_migrate_sections() {
    if ( get_option( 'bl_sections_migrated' ) ) return;
    require_once __DIR__ . '/section-defaults.php';
    $pages = get_posts( array( 'post_type' => 'page', 'post_status' => 'any', 'numberposts' => -1 ) );
    if ( ! $pages ) return;
    foreach ( $pages as $page ) {
        $kind = str_replace( array( 'template-', '.php' ), '', get_page_template_slug( $page->ID ) );
        if ( (int) get_option( 'page_on_front' ) === $page->ID ) $kind = 'home';
        if ( ! in_array( $kind, array( 'home', 'about', 'projects', 'clients', 'contact' ), true ) ) continue;
        if ( 'about' === $kind && ! get_post_meta( $page->ID, '_bl_presence_editor', true ) ) {
            $heading = (string) get_post_meta( $page->ID, 'bl_presence_heading', true );
            if ( false === strpos( $heading, '<' ) ) {
                $parts = preg_split( '/(?<=[.!?])\s+/u', $heading, 2 );
                $heading = esc_html( $parts[0] );
                if ( isset( $parts[1] ) ) $heading .= ' <span class="text-accent">' . esc_html( $parts[1] ) . '</span>';
                update_post_meta( $page->ID, 'bl_presence_heading', wp_slash( $heading ) );
            }
            update_post_meta( $page->ID, '_bl_presence_editor', 1 );
        }
        $values = bl_section_seed_values( $kind, $page->ID );
        foreach ( $values as $name => $value ) {
            if ( metadata_exists( 'post', $page->ID, $name ) ) continue;
            if ( in_array( $name, array( 'bl_home_stats', 'bl_home_benefits', 'bl_home_steps', 'bl_about_pillars' ), true ) ) {
                foreach ( $value as $i => $row ) foreach ( $row as $column => $text ) {
                    $key = $name . '_' . $i . '_' . $column;
                    update_post_meta( $page->ID, $key, wp_slash( $text ) );
                    update_post_meta( $page->ID, '_' . $key, 'field_' . $name . '_' . $column );
                }
                $value = count( $value );
            }
            update_post_meta( $page->ID, $name, wp_slash( $value ) );
            update_post_meta( $page->ID, '_' . $name, 'field_' . $name );
        }
    }
    update_option( 'bl_sections_migrated', 1, false );
}
add_action( 'init', 'bl_migrate_sections', 30 );

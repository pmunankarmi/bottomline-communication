<?php
$path = getenv( 'BL_WP_PATH' );
$_SERVER['SERVER_NAME'] = '127.0.0.1';
require $path . '/wp-load.php';
$slug = $argv[1] ?? 'home';
if ( ! in_array( $slug, array( 'home', 'about', 'projects', 'clients', 'contact' ), true ) ) exit(1);
$page_post = get_page_by_path( $slug );
$GLOBALS['wp_query'] = new WP_Query( array( 'page_id' => $page_post->ID ) );
include get_theme_file_path( 'template-' . $slug . '.php' );

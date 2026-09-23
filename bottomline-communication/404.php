<?php defined( 'ABSPATH' ) || exit; get_header();  ?>
<main class="page-hero"><div class="container"><h1><?php esc_html_e( 'Page not found', 'bottomline' ); ?></h1><a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'bottomline' ); ?></a></div></main>
<?php  get_footer(); ?>

<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main class="page-hero"><div class="container">
<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content', 'page' ); endwhile; ?>
</div></main>
<?php get_footer(); ?>

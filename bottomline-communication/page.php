<?php defined( 'ABSPATH' ) || exit; get_header();  ?>
<main class="page-hero"><div class="container"><?php while ( have_posts() ) : the_post(); ?><h1><?php the_title(); ?></h1><?php the_content(); wp_link_pages(); endwhile; ?></div></main>
<?php  get_footer(); ?>

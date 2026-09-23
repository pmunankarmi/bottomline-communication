<?php defined( 'ABSPATH' ) || exit; get_header();  ?>
<main class="page-hero"><div class="container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article <?php post_class(); ?>><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php the_content(); ?></article>
<?php endwhile; the_posts_pagination(); else : ?><h1><?php esc_html_e( 'Nothing found', 'bottomline' ); ?></h1><?php endif; ?>
</div></main>
<?php  get_footer(); ?>

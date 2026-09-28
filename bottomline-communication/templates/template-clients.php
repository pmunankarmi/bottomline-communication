<?php
/** Template Name: BottomLine Clients */
defined( 'ABSPATH' ) || exit;
get_header();
?>




<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_clients_001', 'Our Clients', get_queried_object_id()) ); ?></span>
<?php bl_section( 'bl_clients_hero' ); ?>
  </div>
</section>

<section class="sectors">
  <div class="container">

    <?php foreach ( bl_client_groups( 'clients' ) as $sector ) : $images = bl_client_items( $sector ); ?>
    <div class="sector reveal">
      <div class="sector-head"><h2><?php echo esc_html( $sector->post_title ); ?></h2><span class="count"><?php echo esc_html( count( $images ) . ' clients' ); ?></span></div>
      <div class="sector-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0">
        <?php foreach ( $images as $image_id ) : ?>
        <div class="col"><div class="c-cell"><?php if ( is_int( $image_id ) ) echo wp_get_attachment_image( $image_id, 'full', false, array( 'loading' => 'lazy' ) ); else echo esc_html( $image_id ); ?></div></div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="quote-section">
  <?php bl_section( 'bl_clients_quote' ); ?>
</section>

<section class="cta-banner">
<?php bl_section( 'bl_clients_cta' ); ?>
  <?php bl_section_button( 'bl_clients_button_1', 'btn btn-primary', '' ); ?>
</section>






<?php get_footer(); ?>

<?php
/** Template Name: BottomLine Clients */
defined( 'ABSPATH' ) || exit;
get_header();
?>




<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_clients_001', 'Our Clients', get_queried_object_id()) ); ?></span>
    <h1><?php echo esc_html( bl_value('bl_clients_002', 'Sixty brands.', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_clients_003', 'One creative partner.', get_queried_object_id()) ); ?></span></h1>
    <p><?php echo esc_html( bl_value('bl_clients_004', 'From global enterprises to government bodies and ambitious regional brands — we\'ve partnered with the businesses shaping KSA and the wider MENA region.', get_queried_object_id()) ); ?></p>
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
  <blockquote class="reveal">
    <?php echo esc_html( bl_value('bl_clients_131', 'Our clients are our greatest assets and the', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_clients_132', 'heartbeat of BottomLine.', get_queried_object_id()) ); ?></span>
  </blockquote>
  <cite class="reveal"><?php echo esc_html( bl_value('bl_clients_133', 'The BottomLine Promise', get_queried_object_id()) ); ?></cite>
</section>

<section class="cta-banner">
  <h2><?php echo esc_html( bl_value('bl_clients_134', 'Join the', get_queried_object_id()) ); ?> <span style="color:var(--teal)"><?php echo esc_html( bl_value('bl_clients_135', 'next chapter.', get_queried_object_id()) ); ?></span></h2>
  <p><?php echo esc_html( bl_value('bl_clients_136', 'Marketing, communications, or your next flagship event — let\'s build something worth remembering.', get_queried_object_id()) ); ?></p>
  <a href="<?php echo esc_url( bl_url( bl_value('bl_clients_137', 'contact.html', get_queried_object_id()) ) ); ?>" class="btn btn-primary"><?php echo esc_html( bl_value('bl_clients_138', 'Start a project →', get_queried_object_id()) ); ?></a>
</section>






<?php get_footer(); ?>

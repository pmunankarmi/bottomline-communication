<?php
/** Template Name: BottomLine About */
defined( 'ABSPATH' ) || exit;
get_header();
?>




<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_about_001', 'About BottomLine', get_queried_object_id()) ); ?></span>
<?php bl_section( 'bl_about_hero' ); ?>
  </div>
</section>

<section class="story">
  <div class="container">
    <div class="story-grid row g-5 align-items-start">
      <div class="col-lg-5 reveal">
        <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value('bl_about_005', 'Our Story', get_queried_object_id()) ); ?></span>
        <h2 class="section-title"><?php bl_section( 'bl_about_heading_1', true ); ?></h2>
      </div>
      <div class="col-lg-7 story-text reveal">
        <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
      </div>
    </div>
  </div>
</section>

<section class="pillars">
  <div class="container">
    <div class="reveal">
      <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value('bl_about_016', 'Vision · Mission · Values', get_queried_object_id()) ); ?></span>
      <h2 class="section-title"><?php bl_section( 'bl_about_heading_2', true ); ?></h2>
    </div>
    <div class="pillars-grid row g-4">
      <?php foreach ( bl_section_rows( 'bl_about_pillars', array( 'icon', 'label', 'content' ) ) as $row ) : ?>
      <div class="col-md-4"><div class="pillar reveal">
        <div class="pillar-icon"><?php echo esc_html( $row['icon'] ); ?></div>
        <span class="sub"><?php echo esc_html( $row['label'] ); ?></span>
        <?php echo wp_kses_post( wpautop( $row['content'] ) ); ?>
      </div></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="offices">
  <div class="container">
    <div class="reveal">
      <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value('bl_about_031', 'Our Presence', get_queried_object_id()) ); ?></span>
      <h2 class="section-title"><?php bl_section( 'bl_presence_heading', true ); ?></h2>
    </div>
    <div class="offices-grid row g-4">
      <?php foreach ( bl_office_rows( get_queried_object_id() ) as $office ) : ?>
      <div class="col-md-6 col-lg-3">
        <div class="office reveal">
          <span class="sub"><?php echo esc_html( $office['country'] ); ?></span>
          <h4><?php echo esc_html( $office['city'] ); ?></h4>
          <p><?php echo nl2br( esc_html( $office['description'] ) ); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="cta-banner">
<?php bl_section( 'bl_about_cta' ); ?>
  <?php bl_section_button( 'bl_about_button_1', 'btn btn-primary', '' ); ?>
</section>






<?php get_footer(); ?>

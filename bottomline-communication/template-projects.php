<?php
/** Template Name: BottomLine Projects */
defined( 'ABSPATH' ) || exit;
get_header();
?>




<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_projects_001', 'Selected Work', get_queried_object_id()) ); ?></span>
<?php bl_section( 'bl_projects_hero' ); ?>
  </div>
</section>

<section class="projects-page">
  <div class="container">
    <div class="projects-listing row g-4" id="grid">
<?php foreach ( bl_content_posts( 'bl_work' ) as $work ) : ?>
  <div class="col-md-6 col-lg-4 pl-col" data-project="<?php echo esc_attr( $work->post_name ); ?>">
    <article class="pl-card" role="button" tabindex="0" aria-controls="project-<?php echo esc_attr( $work->post_name ); ?>">
      <div class="pl-cover" style="background-image:url('<?php echo esc_url( bl_url( bl_value( 'work_cover', '', $work->ID ) ) ); ?>')">
        <span class="pl-cover-cat"><?php echo esc_html( trim( explode( '·', bl_value( 'work_category', '', $work->ID ) )[0] ) ); ?></span><span class="pl-cover-view">→</span>
      </div>
      <div class="pl-body"><h3><?php echo esc_html( $work->post_title ); ?></h3><p><?php echo esc_html( $work->post_excerpt ); ?></p>
      </div>
    </article>
  </div>
<?php endforeach; ?>
</div>
  </div>
</section>

<section class="cta-banner">
<?php bl_section( 'bl_projects_cta' ); ?>
  <?php bl_section_button( 'bl_projects_button_1', 'btn btn-primary', '' ); ?>
</section>



<!-- Floating contact -->


<!-- Slide-in panel -->
<div class="panel-backdrop" id="panelBackdrop"></div>
<?php foreach ( bl_content_posts( 'bl_work', false ) as $work ) : ?>
<aside class="project-panel" id="project-<?php echo esc_attr( $work->post_name ); ?>" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php echo esc_attr( $work->post_title ); ?>" tabindex="-1">
  <button class="panel-close" aria-label="Close"><svg viewBox="0 0 24 24"><path d="M6 6 L18 18 M18 6 L6 18"/></svg></button>
  <div class="panel-cover" style="background-image:url('<?php echo esc_url( bl_url( bl_value( 'work_cover', '', $work->ID ) ) ); ?>')"><span class="panel-cover-cat"><?php echo esc_html( bl_value( 'work_category', '', $work->ID ) ); ?></span></div>
  <div class="panel-body">
    <h2 class="panel-title"><?php echo esc_html( $work->post_title ); ?></h2>
    <p class="panel-desc"><?php echo wp_kses( false ? ( bl_value( 'work_home_description', '', $work->ID ) ?: $work->post_content ) : $work->post_content, array( 'strong' => array(), 'em' => array(), 'br' => array() ) ); ?></p>
    <div class="panel-scope"><h4>Scope of work</h4><ul><?php foreach ( bl_work_scope( $work->ID ) as $scope ) : ?><li><?php echo esc_html( $scope ); ?></li><?php endforeach; ?></ul></div>
    <div class="panel-gallery"><h4>Gallery</h4><div class="panel-gallery-grid">
      <?php foreach ( bl_gallery_ids( 'work_gallery', $work->ID ) as $image_id ) : ?><img src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'full' ) ); ?>" alt="<?php echo esc_attr( $work->post_title ); ?>" loading="lazy" /><?php endforeach; ?>
    </div></div>
    <div class="panel-footer"><p>Working on something similar?</p><a href="<?php echo esc_url( bl_url( 'contact.html' ) ); ?>" class="btn btn-primary">Start a project →</a></div>
  </div>
</aside>
<?php endforeach; ?>


<?php get_footer(); ?>

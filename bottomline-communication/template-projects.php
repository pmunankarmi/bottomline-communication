<?php
/** Template Name: BottomLine Projects */
defined( 'ABSPATH' ) || exit;
get_header();
?>




<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_projects_001', 'Selected Work', get_queried_object_id()) ); ?></span>
    <h1><?php echo esc_html( bl_value('bl_projects_002', 'Our projects.', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_projects_003', 'One creative engine.', get_queried_object_id()) ); ?></span></h1>
    <p><?php echo esc_html( bl_value('bl_projects_004', 'Branding, events, campaigns and digital — for global enterprises, government bodies and ambitious regional brands across KSA and the wider MENA region.', get_queried_object_id()) ); ?></p>
  </div>
</section>

<div class="filter-bar" id="filterBar">
  <button class="filter-btn active" data-filter="all">All <span class="filter-count" id="cnt-all">(<?php echo count( bl_content_posts( 'bl_work' ) ); ?>)</span></button>
  <?php $categories = get_terms( array( 'taxonomy' => 'bl_work_category', 'hide_empty' => false, 'orderby' => 'term_id' ) ); ?>
  <?php if ( ! is_wp_error( $categories ) ) : foreach ( $categories as $category ) : ?>
    <button class="filter-btn" data-filter="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></button>
  <?php endforeach; endif; ?>
</div>

<section class="projects-page">
  <div class="container">
    <div class="projects-listing row g-4" id="grid">
<?php foreach ( bl_content_posts( 'bl_work' ) as $work ) : ?>
  <div class="col-md-6 col-lg-4 pl-col" data-filters="<?php echo esc_attr( bl_work_filters( $work->ID ) ); ?>" data-project="<?php echo esc_attr( $work->post_name ); ?>">
    <article class="pl-card" role="button" tabindex="0" aria-controls="project-<?php echo esc_attr( $work->post_name ); ?>">
      <div class="pl-cover" style="background-image:url('<?php echo esc_url( bl_url( bl_value( 'work_cover', '', $work->ID ) ) ); ?>')">
        <span class="pl-cover-cat"><?php echo esc_html( trim( explode( '·', bl_value( 'work_category', '', $work->ID ) )[0] ) ); ?></span><span class="pl-cover-view">→</span>
      </div>
      <div class="pl-body"><h3><?php echo esc_html( $work->post_title ); ?></h3><p><?php echo esc_html( $work->post_excerpt ); ?></p>
        <div class="pl-meta"><?php foreach ( bl_work_meta( $work->ID ) as $meta ) : ?><span><?php echo esc_html( $meta ); ?></span><?php endforeach; ?></div>
      </div>
    </article>
  </div>
<?php endforeach; ?>
</div>
  </div>
</section>

<section class="cta-banner">
  <h2><?php echo esc_html( bl_value('bl_projects_013', 'Ready to build the next one?', get_queried_object_id()) ); ?></h2>
  <p><?php echo esc_html( bl_value('bl_projects_014', 'Marketing, communications, or a flagship event — tell us what you\'re planning and we\'ll get back within one business day.', get_queried_object_id()) ); ?></p>
  <a href="<?php echo esc_url( bl_url( bl_value('bl_projects_015', 'contact.html', get_queried_object_id()) ) ); ?>" class="btn btn-primary"><?php echo esc_html( bl_value('bl_projects_016', 'Start the conversation →', get_queried_object_id()) ); ?></a>
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
    <div class="panel-meta"><?php foreach ( bl_work_meta( $work->ID ) as $meta ) : ?><span><?php echo esc_html( $meta ); ?></span><?php endforeach; ?></div>
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



<?php get_template_part( 'template-parts/navigation-projects' ); ?>

<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_projects_001', 'Selected Work', get_queried_object_id()) ); ?></span>
    <h1><?php echo esc_html( bl_value('bl_projects_002', 'Our projects.', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_projects_003', 'One creative engine.', get_queried_object_id()) ); ?></span></h1>
    <p><?php echo esc_html( bl_value('bl_projects_004', 'Branding, events, campaigns and digital — for global enterprises, government bodies and ambitious regional brands across KSA and the wider MENA region.', get_queried_object_id()) ); ?></p>
  </div>
</section>

<div class="filter-bar" id="filterBar">
  <button class="filter-btn active" data-filter="all"><?php echo esc_html( bl_value('bl_projects_005', 'All', get_queried_object_id()) ); ?> <span class="filter-count" id="cnt-all"><?php echo esc_html( bl_value('bl_projects_006', '(24)', get_queried_object_id()) ); ?></span></button>
  <button class="filter-btn" data-filter="branding"><?php echo esc_html( bl_value('bl_projects_007', 'Branding', get_queried_object_id()) ); ?></button>
  <button class="filter-btn" data-filter="events"><?php echo esc_html( bl_value('bl_projects_008', 'Events', get_queried_object_id()) ); ?></button>
  <button class="filter-btn" data-filter="digital"><?php echo esc_html( bl_value('bl_projects_009', 'Digital', get_queried_object_id()) ); ?></button>
  <button class="filter-btn" data-filter="campaign"><?php echo esc_html( bl_value('bl_projects_010', 'Campaign', get_queried_object_id()) ); ?></button>
  <button class="filter-btn" data-filter="activation"><?php echo esc_html( bl_value('bl_projects_011', 'Activation', get_queried_object_id()) ); ?></button>
  <button class="filter-btn" data-filter="retail"><?php echo esc_html( bl_value('bl_projects_012', 'Retail', get_queried_object_id()) ); ?></button>
</div>

<section class="projects-page">
  <div class="container">
    <div class="projects-listing row g-4" id="grid"><?php get_template_part( 'template-parts/projects/grid' ); ?></div>
  </div>
</section>

<section class="cta-banner">
  <h2><?php echo esc_html( bl_value('bl_projects_013', 'Ready to build the next one?', get_queried_object_id()) ); ?></h2>
  <p><?php echo esc_html( bl_value('bl_projects_014', 'Marketing, communications, or a flagship event — tell us what you\'re planning and we\'ll get back within one business day.', get_queried_object_id()) ); ?></p>
  <a href="<?php echo esc_url( bl_url( bl_value('bl_projects_015', 'contact.html', get_queried_object_id()) ) ); ?>" class="btn btn-primary"><?php echo esc_html( bl_value('bl_projects_016', 'Start the conversation →', get_queried_object_id()) ); ?></a>
</section>

<?php get_template_part( 'template-parts/footer-projects' ); ?>

<!-- Floating contact -->
<?php get_template_part( 'template-parts/floating-contact' ); ?>

<!-- Slide-in panel -->
<div class="panel-backdrop" id="panelBackdrop"></div>
<?php get_template_part( 'template-parts/projects/panels-work' ); ?>


<?php
/** Template Name: BottomLine Home */
defined( 'ABSPATH' ) || exit;
get_header();
?>


<!-- PRELOADER -->
<div class="preloader" id="preloader">
  <div class="pl-stage">
    <img class="brand-logo lg" src="<?php echo esc_url( bl_logo_url() ); ?>" alt="<?php echo esc_attr( bl_copy('bl_home_002', 'BottomLine', get_queried_object_id()) ); ?>" />
    <div class="pl-bar"><div class="pl-bar-fill"></div></div>
  </div>
</div>

<!-- SCROLL PROGRESS -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- NAV -->



<!-- HERO -->
<section class="hero" id="hero">
  <div class="hero-particles" aria-hidden="true">
    <span class="particle"></span><span class="particle"></span><span class="particle"></span>
    <span class="particle"></span><span class="particle"></span><span class="particle"></span>
    <span class="particle"></span><span class="particle"></span>
  </div>

  <div class="hero-inner">
   <div class="row g-5 align-items-center">
    <!-- LEFT: Text -->
    <div class="col-lg-8 hero-text">
      <h1><?php bl_section( 'bl_home_heading_1', true ); ?></h1>
      <div class="hero-actions load load-2">
        <a href="#services" class="btn btn-ghost magnetic"><?php echo esc_html( bl_copy('bl_home_005', 'Explore our services', get_queried_object_id()) ); ?></a>
      </div>
    </div>

    <!-- Animated orthogonal strokes inspired by the BottomLine wordmark. -->
    <div class="col-lg-4 hero-visual" aria-hidden="true">
      <svg class="hero-line-pattern" viewBox="0 0 400 360" fill="none" aria-hidden="true" focusable="false">
        <g class="brand-line brand-line-h1"><path d="M40 170H370" /></g>
        <g class="brand-line brand-line-h2"><path d="M95 80H310" /></g>
        <g class="brand-line brand-line-h3"><path d="M70 275H325" /></g>
        <g class="brand-line brand-line-v1"><path d="M175 30V325" /></g>
        <g class="brand-line brand-line-v2"><path d="M145 135V300" /></g>
        <g class="brand-line brand-line-v3"><path d="M290 60V250" /></g>
      </svg>
    </div>
   </div>
  </div>

  <div class="scroll-indicator">
    <?php echo esc_html( bl_copy('bl_home_006', 'Scroll', get_queried_object_id()) ); ?>
    <span class="line"></span>
  </div>
</section>

<!-- STATS (separated from the hero banner) -->
<section class="stats-band">
  <div class="stats-inner">
    <div class="hero-stats reveal">
      <div class="row g-0">
        <?php foreach ( bl_section_rows( 'bl_home_stats', array( 'value', 'suffix', 'label' ) ) as $row ) : ?>
        <div class="col-6 col-md-3"><div class="hero-stat">
          <div class="hero-stat-num"><span class="accent" data-count="<?php echo esc_attr( $row['value'] ); ?>" data-suffix="<?php echo esc_attr( $row['suffix'] ); ?>"><?php echo esc_html( $row['value'] . $row['suffix'] ); ?></span></div>
          <div class="hero-stat-label"><?php echo esc_html( $row['label'] ); ?></div>
        </div></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT (now carries the descriptive copy) -->
<section id="about">
  <div class="container">
    <div class="about-grid row g-5 align-items-start">
      <div class="col-lg-6 about-text reveal">
        <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value('bl_home_011', 'About BottomLine', get_queried_object_id()) ); ?></span>
        <h2 class="section-title"><?php bl_section( 'bl_home_heading_2', true ); ?></h2>
        <?php bl_section_button( 'bl_home_button_1', 'btn btn-primary', 'margin-top:14px' ); ?>
      </div>
      <ul class="col-lg-6 why-list reveal-stagger">
        <?php foreach ( bl_section_rows( 'bl_home_benefits', array( 'content' ) ) as $i => $row ) : ?>
        <li class="why-item">
          <div class="why-icon"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></div>
          <div class="why-content"><?php echo wp_kses_post( wpautop( $row['content'] ) ); ?></div>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>




<!-- SERVICES -->
<section class="soft" id="services">
  <div class="container">
    <div class="services-head row g-5 align-items-end">
      <div class="col-lg-7 reveal">
        <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value('bl_home_028', 'Our Services', get_queried_object_id()) ); ?></span>
        <h2 class="section-title"><?php bl_section( 'bl_home_heading_3', true ); ?></h2>
      </div>
      <p class="col-lg-5 section-intro reveal"><?php echo esc_html( bl_value('bl_home_031', 'From the first concept to the final report, BottomLine covers every discipline a modern brand needs to grow — strategy, creative, execution and analytics.', get_queried_object_id()) ); ?></p>
    </div>

    <div class="services-grid row g-4 reveal-stagger">
<?php foreach ( bl_content_posts( 'bl_service' ) as $service ) : ?>
      <div class="col-md-6 col-lg-4">
        <div class="service tilt">
          <div class="service-img" style="background-image:url('<?php echo esc_url( bl_url( bl_value( 'service_image_url', '', $service->ID ) ) ); ?>')">
            <span class="service-img-tag"><?php echo esc_html( bl_value( 'service_tag', $service->post_title, $service->ID ) ); ?></span>
          </div>
          <div class="service-body">
            <h3><?php echo esc_html( $service->post_title ); ?></h3>
            <p><?php echo esc_html( $service->post_excerpt ); ?></p>
            <ul class="service-disciplines">
              <?php foreach ( bl_text_list( bl_value( 'service_disciplines', '', $service->ID ) ) as $discipline ) : ?><li><?php echo esc_html( $discipline ); ?></li><?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
<?php endforeach; ?>
    </div>
  </div>
</section>


<!-- PROJECTS -->
<section class="projects" id="projects">
  <div class="container">
    <div class="projects-head row g-5 align-items-end">
      <div class="col-lg-7 reveal">
        <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value('bl_home_086', 'Selected Work', get_queried_object_id()) ); ?></span>
        <h2 class="section-title"><?php bl_section( 'bl_home_heading_4', true ); ?></h2>
      </div>
      <p class="col-lg-5 section-intro reveal"><?php echo esc_html( bl_value('bl_home_089', 'From flagship launches to multi-year campaigns — a glimpse of recent work across branding, events, digital and activation.', get_queried_object_id()) ); ?></p>
    </div>

    <div class="projects-grid row g-4 reveal-stagger">

<?php $home_work = bl_content_posts( 'bl_work', true ); ?>
<?php foreach ( $home_work as $work ) : ?>
      <div class="project-col"><article class="project" data-project="<?php echo esc_attr( $work->post_name ); ?>" style="--proj-img:url('<?php echo esc_url( bl_url( bl_value( 'work_cover', '', $work->ID ) ) ); ?>')">
        <span class="project-mark"><?php echo esc_html( bl_value( 'work_home_mark', '', $work->ID ) ); ?></span>
        <span class="project-tag"><?php echo esc_html( bl_value( 'work_category', '', $work->ID ) ); ?></span>
        <div><h3><?php echo esc_html( bl_value( 'work_home_title', $work->post_title, $work->ID ) ?: $work->post_title ); ?></h3>
        <p><?php echo esc_html( bl_value( 'work_home_summary', $work->post_excerpt, $work->ID ) ?: $work->post_excerpt ); ?></p></div>
        <div class="project-meta"><span class="arrow">→</span></div>
      </article></div>
<?php endforeach; ?>

    </div>

    <div class="reveal" style="text-align:center;margin-top:60px;display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
      <?php bl_section_button( 'bl_home_button_2', 'btn btn-primary', '' ); ?>
      <?php bl_section_button( 'bl_home_button_3', 'btn btn-ghost', 'border-color:rgba(66,0,105,.2);color:var(--ink)' ); ?>
    </div>
  </div>
</section>


<!-- PROCESS -->
<section class="process dark" id="process">
  <div class="container">
    <div class="process-head row g-5 align-items-end">
      <div class="col-lg-7 reveal">
        <span class="eyebrow"><span class="line" style="background:var(--teal)"></span><?php echo esc_html( bl_value('bl_home_140', 'Our Event Strategy', get_queried_object_id()) ); ?></span>
        <h2 class="section-title"><?php bl_section( 'bl_home_heading_5', true ); ?></h2>
      </div>
      <p class="col-lg-5 section-intro reveal"><?php echo esc_html( bl_value('bl_home_143', 'Every BottomLine event follows a tested, transparent process — from the spark of an idea to the post-event report on your desk.', get_queried_object_id()) ); ?></p>
    </div>

    <div class="process-steps reveal-stagger">
      <div class="process-progress"><div class="process-progress-fill" id="procFill"></div></div>
      <?php foreach ( bl_section_rows( 'bl_home_steps', array( 'title', 'description' ) ) as $i => $row ) : ?>
      <div class="step" data-step="<?php echo esc_attr( $i ); ?>">
        <div class="row g-4">
          <div class="col-auto step-num-wrap"><div class="step-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></div></div>
          <div class="col-md-3"><div class="step-title"><?php echo esc_html( $row['title'] ); ?></div></div>
          <div class="col"><div class="step-desc"><?php echo nl2br( esc_html( $row['description'] ) ); ?></div></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- TESTIMONIAL -->
<section class="testimonial">
  <div class="container">
    <?php bl_section( 'bl_home_quote' ); ?>
  </div>
</section>



<!-- CLIENTS -->
<section class="clients-section" id="clients">
  <div class="container">
    <div class="clients-head row g-5 align-items-end">
      <div class="col-lg-7 reveal">
        <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value( 'bl_home_155', 'Our Clients', get_queried_object_id() ) ); ?></span>
        <h2 class="section-title"><?php bl_section( 'bl_home_heading_6', true ); ?></h2>
      </div>
      <p class="col-lg-5 section-intro reveal"><?php echo esc_html( bl_value('bl_home_158', 'From global enterprises to government bodies and regional retailers — we\'ve partnered with the brands shaping KSA and the wider MENA region.', get_queried_object_id()) ); ?></p>
    </div>
    <div class="clients-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0 reveal">
      <?php foreach ( bl_client_groups( 'home' ) as $sector ) : foreach ( bl_client_gallery( $sector ) as $image_id ) : ?>
      <div class="col"><div class="client-cell"><?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'loading' => 'lazy' ) ); ?></div></div>
      <?php endforeach; endforeach; ?>
    </div>
    <div class="reveal" style="text-align:center;margin-top:50px">
      <?php bl_section_button( 'bl_home_button_4', 'btn btn-ghost', 'border-color:rgba(66,0,105,.2);color:var(--ink)' ); ?>
    </div>
  </div>
</section>


<!-- CTA -->
<section class="cta-banner" id="contact">
  <div class="container">
    <div class="cta-content reveal"><?php echo wp_kses_post( wpautop( get_post_meta( get_queried_object_id(), 'bl_cta_content', true ) ) ); ?></div>
    <div class="hero-actions reveal" style="justify-content:center;margin-bottom:0">
      <?php foreach ( array( 'primary', 'secondary' ) as $button ) :
          $link = get_post_meta( get_queried_object_id(), 'bl_cta_' . $button, true );
          if ( ! is_array( $link ) || empty( $link['url'] ) ) continue;
          $new_tab = '_blank' === ( $link['target'] ?? '' );
      ?>
      <a href="<?php echo esc_url( bl_url( $link['url'] ) ); ?>" class="btn <?php echo 'primary' === $button ? 'btn-primary' : 'btn-ghost'; ?> magnetic"<?php if ( $new_tab ) echo ' target="_blank" rel="noopener noreferrer"'; ?>><?php echo esc_html( $link['title'] ?? '' ); ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FOOTER -->


<!-- PROJECT DETAIL PANEL -->
<div class="panel-backdrop" id="panelBackdrop"></div>
<?php foreach ( bl_content_posts( 'bl_work', true ) as $work ) : ?>
<aside class="project-panel" id="project-<?php echo esc_attr( $work->post_name ); ?>" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php echo esc_attr( $work->post_title ); ?>" tabindex="-1">
  <button class="panel-close" aria-label="Close"><svg viewBox="0 0 24 24"><path d="M6 6 L18 18 M18 6 L6 18"/></svg></button>
  <div class="panel-cover" style="background-image:url('<?php echo esc_url( bl_url( bl_value( 'work_cover', '', $work->ID ) ) ); ?>')"><span class="panel-cover-cat"><?php echo esc_html( bl_value( 'work_category', '', $work->ID ) ); ?></span></div>
  <div class="panel-body">
    <h2 class="panel-title"><?php echo esc_html( $work->post_title ); ?></h2>
    <p class="panel-desc"><?php echo wp_kses( bl_value( 'work_home_description', '', $work->ID ) ? esc_html( bl_value( 'work_home_description', '', $work->ID ) ) : $work->post_content, array( 'strong' => array(), 'em' => array(), 'br' => array() ) ); ?></p>
    <div class="panel-scope"><h4>Scope of work</h4><ul><?php foreach ( bl_work_scope( $work->ID ) as $scope ) : ?><li><?php echo esc_html( $scope ); ?></li><?php endforeach; ?></ul></div>
    <div class="panel-gallery"><h4>Gallery</h4><div class="panel-gallery-grid">
      <?php foreach ( bl_gallery_ids( 'work_gallery', $work->ID ) as $image_id ) : ?><img src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'full' ) ); ?>" alt="<?php echo esc_attr( $work->post_title ); ?>" loading="lazy" /><?php endforeach; ?>
    </div></div>
    <div class="panel-footer"><p>Working on something similar?</p><a href="<?php echo esc_url( bl_url( 'contact.html' ) ); ?>" class="btn btn-primary">Start a project →</a></div>
  </div>
</aside>
<?php endforeach; ?>

<!-- FLOATING CONTACT -->



<?php get_footer(); ?>

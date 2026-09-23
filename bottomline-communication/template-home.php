<?php
/** Template Name: BottomLine Home */
defined( 'ABSPATH' ) || exit;
get_header();
?>


<!-- PRELOADER -->
<div class="preloader" id="preloader">
  <div class="pl-stage">
    <img class="brand-logo lg" src="<?php echo esc_url( bl_logo_url() ); ?>" alt="<?php echo esc_attr( bl_value('bl_home_002', 'BottomLine', get_queried_object_id()) ); ?>" />
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
      <h1>
        <span class="line-mask"><span class="line-text" style="--d:.2s"><?php echo esc_html( bl_value('bl_home_003', 'We turn ambitious businesses into', get_queried_object_id()) ); ?></span></span>
        <span class="line-mask"><span class="line-text accent" style="--d:.5s"><?php echo esc_html( bl_value('bl_home_004', 'market-leading brands.', get_queried_object_id()) ); ?></span></span>
      </h1>
      <div class="hero-actions load load-2">
        <a href="#services" class="btn btn-ghost magnetic"><?php echo esc_html( bl_value('bl_home_005', 'Explore our services', get_queried_object_id()) ); ?></a>
      </div>
    </div>

    <!-- RIGHT: Floating gradient orbs -->
    <div class="col-lg-4 hero-visual" aria-hidden="true">
      <div class="orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="orb orb-4"></div>
      </div>
    </div>
   </div>
  </div>

  <div class="scroll-indicator">
    <?php echo esc_html( bl_value('bl_home_006', 'Scroll', get_queried_object_id()) ); ?>
    <span class="line"></span>
  </div>
</section>

<!-- STATS (separated from the hero banner) -->
<section class="stats-band">
  <div class="stats-inner">
    <div class="hero-stats reveal">
      <div class="row g-0">
        <div class="col-6 col-md-3">
          <div class="hero-stat">
            <div class="hero-stat-num"><span class="accent" data-count="<?php echo esc_attr( bl_value( 'bl_stat_1', '14', get_queried_object_id() ) ); ?>"><?php echo esc_html( bl_value( 'bl_stat_1', '14', get_queried_object_id() ) ); ?>+</span></div>
            <div class="hero-stat-label"><?php echo esc_html( bl_value('bl_home_007', 'Years +', get_queried_object_id()) ); ?></div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="hero-stat">
            <div class="hero-stat-num"><span class="accent" data-count="<?php echo esc_attr( bl_value( 'bl_stat_2', '50', get_queried_object_id() ) ); ?>"><?php echo esc_html( bl_value( 'bl_stat_2', '50', get_queried_object_id() ) ); ?>+</span></div>
            <div class="hero-stat-label"><?php echo esc_html( bl_value('bl_home_008', 'Clients +', get_queried_object_id()) ); ?></div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="hero-stat">
            <div class="hero-stat-num"><span class="accent" data-count="<?php echo esc_attr( bl_value( 'bl_stat_3', '4', get_queried_object_id() ) ); ?>"><?php echo esc_html( bl_value( 'bl_stat_3', '4', get_queried_object_id() ) ); ?></span></div>
            <div class="hero-stat-label"><?php echo esc_html( bl_value('bl_home_009', 'Offices', get_queried_object_id()) ); ?></div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="hero-stat">
            <div class="hero-stat-num"><span class="accent" data-count="<?php echo esc_attr( bl_value( 'bl_stat_4', '360', get_queried_object_id() ) ); ?>" data-suffix="°"><?php echo esc_html( bl_value( 'bl_stat_4', '360', get_queried_object_id() ) ); ?>°</span></div>
            <div class="hero-stat-label"><?php echo esc_html( bl_value('bl_home_010', 'Service', get_queried_object_id()) ); ?></div>
          </div>
        </div>
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
        <h2 class="section-title"><?php echo esc_html( bl_value('bl_home_012', 'A creative and performance-oriented', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_home_013', 'success partner.', get_queried_object_id()) ); ?></span></h2>
        <a href="<?php echo esc_url( bl_url( bl_value('bl_home_014', 'about.html', get_queried_object_id()) ) ); ?>" class="btn btn-primary" style="margin-top:14px"><?php echo esc_html( bl_value('bl_home_015', 'Read the full story →', get_queried_object_id()) ); ?></a>
      </div>
      <ul class="col-lg-6 why-list reveal-stagger">
        <li class="why-item">
          <div class="why-icon"><?php echo esc_html( bl_value('bl_home_016', '01', get_queried_object_id()) ); ?></div>
          <div class="why-content">
            <h4><?php echo esc_html( bl_value('bl_home_017', 'Strategy-led, ROI-driven', get_queried_object_id()) ); ?></h4>
            <p><?php echo esc_html( bl_value('bl_home_018', 'Every campaign and event starts with sharp strategic thinking and ends with measurable business outcomes.', get_queried_object_id()) ); ?></p>
          </div>
        </li>
        <li class="why-item">
          <div class="why-icon"><?php echo esc_html( bl_value('bl_home_019', '02', get_queried_object_id()) ); ?></div>
          <div class="why-content">
            <h4><?php echo esc_html( bl_value('bl_home_020', '360° integrated execution', get_queried_object_id()) ); ?></h4>
            <p><?php echo esc_html( bl_value('bl_home_021', 'Marketing, branding, content, animation, web, and events — under one strategic roof.', get_queried_object_id()) ); ?></p>
          </div>
        </li>
        <li class="why-item">
          <div class="why-icon"><?php echo esc_html( bl_value('bl_home_022', '03', get_queried_object_id()) ); ?></div>
          <div class="why-content">
            <h4><?php echo esc_html( bl_value('bl_home_023', 'Transparent and authentic', get_queried_object_id()) ); ?></h4>
            <p><?php echo esc_html( bl_value('bl_home_024', 'Clear scope, honest communication, and partnerships built to last — not transactions.', get_queried_object_id()) ); ?></p>
          </div>
        </li>
        <li class="why-item">
          <div class="why-icon"><?php echo esc_html( bl_value('bl_home_025', '04', get_queried_object_id()) ); ?></div>
          <div class="why-content">
            <h4><?php echo esc_html( bl_value('bl_home_026', 'Regional expertise', get_queried_object_id()) ); ?></h4>
            <p><?php echo esc_html( bl_value('bl_home_027', 'Fourteen years on the ground in KSA and MENA, with bilingual creative talent who understand the audience.', get_queried_object_id()) ); ?></p>
          </div>
        </li>
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
        <h2 class="section-title"><?php echo esc_html( bl_value('bl_home_029', 'A full-service', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_home_030', '360° agency.', get_queried_object_id()) ); ?></span></h2>
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
        <h2 class="section-title"><?php echo esc_html( bl_value('bl_home_087', 'Work that', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_home_088', 'moves brands forward.', get_queried_object_id()) ); ?></span></h2>
      </div>
      <p class="col-lg-5 section-intro reveal"><?php echo esc_html( bl_value('bl_home_089', 'From flagship launches to multi-year campaigns — a glimpse of recent work across branding, events, digital and activation.', get_queried_object_id()) ); ?></p>
    </div>

    <div class="projects-grid row g-4 reveal-stagger">

<?php $home_work = bl_content_posts( 'bl_work', true ); ?>
<?php foreach ( $home_work as $work ) : $wide = 'wide' === bl_value( 'work_home_width', '', $work->ID ); ?>
      <div class="<?php echo $wide ? 'col-md-8' : 'col-md-4'; ?>"><article class="project<?php echo $wide ? ' p-wide' : ''; ?>" data-project="<?php echo esc_attr( $work->post_name ); ?>" style="--proj-img:url('<?php echo esc_url( bl_url( bl_value( 'work_cover', '', $work->ID ) ) ); ?>')">
        <span class="project-mark"><?php echo esc_html( bl_value( 'work_home_mark', '', $work->ID ) ); ?></span>
        <span class="project-tag"><?php echo esc_html( bl_value( 'work_category', '', $work->ID ) ); ?></span>
        <div><h3><?php echo esc_html( bl_value( 'work_home_title', $work->post_title, $work->ID ) ?: $work->post_title ); ?></h3>
        <p><?php echo esc_html( bl_value( 'work_home_summary', $work->post_excerpt, $work->ID ) ?: $work->post_excerpt ); ?></p></div>
        <div class="project-meta"><span><?php echo esc_html( implode( ' · ', array_slice( bl_work_meta( $work->ID ), 0, 2 ) ) ); ?></span><span class="arrow">→</span></div>
      </article></div>
<?php endforeach; ?>

    </div>

    <div class="reveal" style="text-align:center;margin-top:60px;display:flex;gap:14px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url( bl_url( bl_value('bl_home_136', 'projects.html', get_queried_object_id()) ) ); ?>" class="btn btn-primary"><?php echo esc_html( bl_value('bl_home_137', 'View all work →', get_queried_object_id()) ); ?></a>
      <a href="<?php echo esc_url( bl_url( bl_value( 'bl_home_138', 'contact.html', get_queried_object_id() ) ) ); ?>" class="btn btn-ghost" style="border-color:rgba(66,0,105,.2);color:var(--ink)"><?php echo esc_html( bl_value('bl_home_139', 'Start your project', get_queried_object_id()) ); ?></a>
    </div>
  </div>
</section>


<!-- PROCESS -->
<section class="process dark" id="process">
  <div class="container">
    <div class="process-head row g-5 align-items-end">
      <div class="col-lg-7 reveal">
        <span class="eyebrow"><span class="line" style="background:var(--teal)"></span><?php echo esc_html( bl_value('bl_home_140', 'Our Event Strategy', get_queried_object_id()) ); ?></span>
        <h2 class="section-title"><?php echo esc_html( bl_value('bl_home_141', 'Four phases.', get_queried_object_id()) ); ?> <span class="accent" style="color:var(--teal)"><?php echo esc_html( bl_value('bl_home_142', 'One flawless experience.', get_queried_object_id()) ); ?></span></h2>
      </div>
      <p class="col-lg-5 section-intro reveal"><?php echo esc_html( bl_value('bl_home_143', 'Every BottomLine event follows a tested, transparent process — from the spark of an idea to the post-event report on your desk.', get_queried_object_id()) ); ?></p>
    </div>

    <div class="process-steps reveal-stagger">
      <div class="process-progress"><div class="process-progress-fill" id="procFill"></div></div>
      <div class="step" data-step="0">
        <div class="row g-4">
          <div class="col-auto step-num-wrap"><div class="step-num"><?php echo esc_html( bl_value('bl_home_016', '01', get_queried_object_id()) ); ?></div></div>
          <div class="col-md-3"><div class="step-title"><?php echo esc_html( bl_value('bl_home_045', 'Concept', get_queried_object_id()) ); ?></div></div>
          <div class="col"><div class="step-desc"><?php echo esc_html( bl_value('bl_home_144', 'We conceptualise the event and create the framework from which it will grow — understanding the why, who, when, where and what.', get_queried_object_id()) ); ?></div></div>
        </div>
      </div>
      <div class="step" data-step="1">
        <div class="row g-4">
          <div class="col-auto step-num-wrap"><div class="step-num"><?php echo esc_html( bl_value('bl_home_019', '02', get_queried_object_id()) ); ?></div></div>
          <div class="col-md-3"><div class="step-title"><?php echo esc_html( bl_value('bl_home_145', 'Coordination', get_queried_object_id()) ); ?></div></div>
          <div class="col"><div class="step-desc"><?php echo esc_html( bl_value('bl_home_146', 'Theme, design, budget, venue, entertainers, equipment, caterers — every moving piece locked in and aligned to scope.', get_queried_object_id()) ); ?></div></div>
        </div>
      </div>
      <div class="step" data-step="2">
        <div class="row g-4">
          <div class="col-auto step-num-wrap"><div class="step-num"><?php echo esc_html( bl_value('bl_home_022', '03', get_queried_object_id()) ); ?></div></div>
          <div class="col-md-3"><div class="step-title"><?php echo esc_html( bl_value('bl_home_147', 'Culmination', get_queried_object_id()) ); ?></div></div>
          <div class="col"><div class="step-desc"><?php echo esc_html( bl_value('bl_home_148', 'Live execution. We communicate with suppliers, vendors and staff, monitor timelines, and perform under pressure to deliver.', get_queried_object_id()) ); ?></div></div>
        </div>
      </div>
      <div class="step" data-step="3">
        <div class="row g-4">
          <div class="col-auto step-num-wrap"><div class="step-num"><?php echo esc_html( bl_value('bl_home_025', '04', get_queried_object_id()) ); ?></div></div>
          <div class="col-md-3"><div class="step-title"><?php echo esc_html( bl_value('bl_home_149', 'Closeout', get_queried_object_id()) ); ?></div></div>
          <div class="col"><div class="step-desc"><?php echo esc_html( bl_value('bl_home_150', 'Venue handover, supplier sign-off, and a complete post-event report so you know exactly what was delivered — and what\'s next.', get_queried_object_id()) ); ?></div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIAL -->
<section class="testimonial">
  <div class="container">
    <blockquote class="reveal">
      <?php echo esc_html( bl_value('bl_home_151', 'We create a vision, articulate it, own it, and', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_home_152', 'passionately drive it to completion.', get_queried_object_id()) ); ?></span>
    </blockquote>
    <cite class="reveal">
      <strong><?php echo esc_html( bl_value( 'bl_home_153', 'The BottomLine Promise', get_queried_object_id() ) ); ?></strong>
      <?php echo esc_html( bl_value('bl_home_154', 'Marketing · Communication · Events', get_queried_object_id()) ); ?>
    </cite>
  </div>
</section>



<!-- CLIENTS -->
<section class="clients-section" id="clients">
  <div class="container">
    <div class="clients-head row g-5 align-items-end">
      <div class="col-lg-7 reveal">
        <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value( 'bl_home_155', 'Our Clients', get_queried_object_id() ) ); ?></span>
        <h2 class="section-title"><?php echo esc_html( bl_value('bl_home_156', 'Our clients are the', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value( 'bl_home_157', 'heartbeat of BottomLine.', get_queried_object_id() ) ); ?></span></h2>
      </div>
      <p class="col-lg-5 section-intro reveal"><?php echo esc_html( bl_value('bl_home_158', 'From global enterprises to government bodies and regional retailers — we\'ve partnered with the brands shaping KSA and the wider MENA region.', get_queried_object_id()) ); ?></p>
    </div>
    <div class="clients-grid row row-cols-2 row-cols-md-3 row-cols-lg-5 g-0 reveal">
      <?php foreach ( bl_client_groups( 'home' ) as $sector ) : foreach ( bl_client_gallery( $sector ) as $image_id ) : ?>
      <div class="col"><div class="client-cell"><?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'loading' => 'lazy' ) ); ?></div></div>
      <?php endforeach; endforeach; ?>
    </div>
    <div class="reveal" style="text-align:center;margin-top:50px">
      <a href="<?php echo esc_url( bl_url( bl_value('bl_home_209', 'clients.html', get_queried_object_id()) ) ); ?>" class="btn btn-ghost" style="border-color:rgba(66,0,105,.2);color:var(--ink)"><?php echo esc_html( bl_value('bl_home_210', 'Explore all clients →', get_queried_object_id()) ); ?></a>
    </div>
  </div>
</section>


<!-- CTA -->
<section class="cta-banner" id="contact">
  <div class="container">
    <h2 class="reveal"><?php echo esc_html( bl_value('bl_home_211', 'Ready to build something', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_home_212', 'unforgettable?', get_queried_object_id()) ); ?></span></h2>
    <p class="reveal"><?php echo esc_html( bl_value('bl_home_213', 'Marketing, communications, or your next flagship event — tell us what you\'re working on and we\'ll get back within one business day.', get_queried_object_id()) ); ?></p>
    <div class="hero-actions reveal" style="justify-content:center;margin-bottom:0">
      <a href="<?php echo esc_url( bl_url( bl_value( 'bl_home_138', 'contact.html', get_queried_object_id() ) ) ); ?>" class="btn btn-primary magnetic"><?php echo esc_html( bl_value('bl_home_214', 'Start the conversation →', get_queried_object_id()) ); ?></a>
      <a href="<?php echo esc_url( bl_phone_url( 'bl_events_phone', '+966 56 460 4739' ) ); ?>" class="btn btn-ghost magnetic" style="color:#fff;border-color:rgba(255,255,255,.25)"><?php echo esc_html( bl_value('bl_home_216', 'Call our events team', get_queried_object_id()) ); ?></a>
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
    <div class="panel-meta"><?php foreach ( bl_work_meta( $work->ID ) as $meta ) : ?><span><?php echo esc_html( $meta ); ?></span><?php endforeach; ?></div>
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

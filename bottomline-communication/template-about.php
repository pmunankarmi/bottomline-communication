<?php
/** Template Name: BottomLine About */
defined( 'ABSPATH' ) || exit;
get_header();
?>




<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_about_001', 'About BottomLine', get_queried_object_id()) ); ?></span>
    <h1><?php echo esc_html( bl_value('bl_about_002', 'Strategic concepts for', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_about_003', 'evolving businesses.', get_queried_object_id()) ); ?></span></h1>
    <p><?php echo esc_html( bl_value('bl_about_004', 'BottomLine is a 360° Marketing, Communication and Events agency — operating across KSA and the wider MENA region, with offices in Riyadh, Jeddah, Dubai and Beirut.', get_queried_object_id()) ); ?></p>
  </div>
</section>

<section class="story">
  <div class="container">
    <div class="story-grid row g-5 align-items-start">
      <div class="col-lg-5 reveal">
        <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value('bl_about_005', 'Our Story', get_queried_object_id()) ); ?></span>
        <h2 class="section-title"><?php echo esc_html( bl_value('bl_about_006', 'Fourteen years in.', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_about_007', 'Just getting started.', get_queried_object_id()) ); ?></span></h2>
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
      <h2 class="section-title"><?php echo esc_html( bl_value('bl_about_017', 'We create a vision, articulate it, own it, and', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_about_018', 'passionately drive it to completion.', get_queried_object_id()) ); ?></span></h2>
    </div>
    <div class="pillars-grid row g-4">
      <div class="col-md-4">
        <div class="pillar reveal">
          <div class="pillar-icon"><?php echo esc_html( bl_value('bl_about_019', '◆', get_queried_object_id()) ); ?></div>
          <span class="sub"><?php echo esc_html( bl_value('bl_about_020', 'Our Destination', get_queried_object_id()) ); ?></span>
          <h3><?php echo esc_html( bl_value('bl_about_021', 'Vision', get_queried_object_id()) ); ?></h3>
          <p><?php echo esc_html( bl_value('bl_about_022', 'To be the leading 360 company by meeting and exceeding the expectations of our clients through innovative ideas and excellent service — building sustainable brand presence through strategic marketing.', get_queried_object_id()) ); ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="pillar reveal">
          <div class="pillar-icon"><?php echo esc_html( bl_value('bl_about_023', '→', get_queried_object_id()) ); ?></div>
          <span class="sub"><?php echo esc_html( bl_value('bl_about_024', 'Our Path', get_queried_object_id()) ); ?></span>
          <h3><?php echo esc_html( bl_value('bl_about_025', 'Mission', get_queried_object_id()) ); ?></h3>
          <p><?php echo esc_html( bl_value('bl_about_026', 'To provide integrated 360 Marketing, Communication and Events solutions that meet your business requirements — under one strategic roof, end to end.', get_queried_object_id()) ); ?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="pillar reveal">
          <div class="pillar-icon"><?php echo esc_html( bl_value('bl_about_027', '✦', get_queried_object_id()) ); ?></div>
          <span class="sub"><?php echo esc_html( bl_value('bl_about_028', 'How We Work', get_queried_object_id()) ); ?></span>
          <h3><?php echo esc_html( bl_value('bl_about_029', 'Values', get_queried_object_id()) ); ?></h3>
          <p><?php echo esc_html( bl_value('bl_about_030', 'ROI-driven, transparent, professional and authentic. Four principles that shape every campaign, every event, and every relationship we build.', get_queried_object_id()) ); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="offices">
  <div class="container">
    <div class="reveal">
      <span class="eyebrow"><span class="line"></span><?php echo esc_html( bl_value('bl_about_031', 'Our Presence', get_queried_object_id()) ); ?></span>
      <h2 class="section-title"><?php echo esc_html( bl_value('bl_about_032', 'Four cities.', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_about_033', 'One creative engine.', get_queried_object_id()) ); ?></span></h2>
    </div>
    <div class="offices-grid row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="office reveal">
          <span class="sub"><?php echo esc_html( bl_value('bl_about_034', 'KSA', get_queried_object_id()) ); ?></span>
          <h4><?php echo esc_html( bl_value('bl_about_035', 'Riyadh', get_queried_object_id()) ); ?></h4>
          <p><?php echo esc_html( bl_value('bl_about_036', 'Office 18B, 4th Floor', get_queried_object_id()) ); ?><br><?php echo esc_html( bl_value('bl_about_037', 'Al Sulaimaniyah, 7612 Salah Ad Din Al Ayyubi Road', get_queried_object_id()) ); ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="office reveal">
          <span class="sub"><?php echo esc_html( bl_value('bl_about_034', 'KSA', get_queried_object_id()) ); ?></span>
          <h4><?php echo esc_html( bl_value('bl_about_038', 'Jeddah', get_queried_object_id()) ); ?></h4>
          <p><?php echo esc_html( bl_value('bl_about_039', 'Office No. 3013, 3rd Floor', get_queried_object_id()) ); ?><br><?php echo esc_html( bl_value('bl_about_040', 'Al-Khuraji Business Center', get_queried_object_id()) ); ?><br><?php echo esc_html( bl_value('bl_about_041', 'Madinah Road', get_queried_object_id()) ); ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="office reveal">
          <span class="sub"><?php echo esc_html( bl_value('bl_about_042', 'UAE', get_queried_object_id()) ); ?></span>
          <h4><?php echo esc_html( bl_value('bl_about_043', 'Dubai', get_queried_object_id()) ); ?></h4>
          <p><?php echo esc_html( bl_value('bl_about_044', 'Regional presence supporting clients across the Gulf and wider region.', get_queried_object_id()) ); ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="office reveal">
          <span class="sub"><?php echo esc_html( bl_value('bl_about_045', 'Lebanon', get_queried_object_id()) ); ?></span>
          <h4><?php echo esc_html( bl_value('bl_about_046', 'Beirut', get_queried_object_id()) ); ?></h4>
          <p><?php echo esc_html( bl_value('bl_about_047', 'Regional presence supporting MENA creative production and content.', get_queried_object_id()) ); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cta-banner">
  <h2><?php echo esc_html( bl_value('bl_about_048', 'Let\'s build something', get_queried_object_id()) ); ?> <span style="color:var(--teal)"><?php echo esc_html( bl_value('bl_about_049', 'unforgettable.', get_queried_object_id()) ); ?></span></h2>
  <p><?php echo esc_html( bl_value('bl_about_050', 'Marketing, communications, or your next flagship event — tell us what you\'re planning.', get_queried_object_id()) ); ?></p>
  <a href="<?php echo esc_url( bl_url( bl_value('bl_about_051', 'contact.html', get_queried_object_id()) ) ); ?>" class="btn btn-primary"><?php echo esc_html( bl_value('bl_about_052', 'Start a project →', get_queried_object_id()) ); ?></a>
</section>






<?php get_footer(); ?>

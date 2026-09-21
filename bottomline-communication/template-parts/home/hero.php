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

<?php get_template_part( 'template-parts/home/statistics' ); ?>



<!-- PRELOADER -->
<div class="preloader" id="preloader">
  <div class="pl-stage">
    <img class="brand-logo lg" src="<?php echo esc_url( bl_url( bl_value('bl_home_001', 'bottomline-logo-white.svg?v=2', get_queried_object_id()) ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_home_002', 'BottomLine', get_queried_object_id()) ); ?>" />
    <div class="pl-bar"><div class="pl-bar-fill"></div></div>
  </div>
</div>

<!-- SCROLL PROGRESS -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- NAV -->
<?php get_template_part( 'template-parts/navigation-home' ); ?>


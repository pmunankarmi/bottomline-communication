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

<?php get_template_part( 'template-parts/home/about' ); ?>

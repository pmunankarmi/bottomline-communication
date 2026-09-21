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

<?php get_template_part( 'template-parts/home/testimonial' ); ?>

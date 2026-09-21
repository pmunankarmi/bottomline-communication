<!-- CTA -->
<section class="cta-banner" id="contact">
  <div class="container">
    <h2 class="reveal"><?php echo esc_html( bl_value('bl_home_211', 'Ready to build something', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_home_212', 'unforgettable?', get_queried_object_id()) ); ?></span></h2>
    <p class="reveal"><?php echo esc_html( bl_value('bl_home_213', 'Marketing, communications, or your next flagship event — tell us what you\'re working on and we\'ll get back within one business day.', get_queried_object_id()) ); ?></p>
    <div class="hero-actions reveal" style="justify-content:center;margin-bottom:0">
      <a href="<?php echo esc_url( bl_url( bl_value('bl_home_138', 'contact.html', get_queried_object_id()) ) ); ?>" class="btn btn-primary magnetic"><?php echo esc_html( bl_value('bl_home_214', 'Start the conversation →', get_queried_object_id()) ); ?></a>
      <a href="<?php echo esc_url( bl_url( bl_value('bl_home_215', 'tel:+966564604739', get_queried_object_id()) ) ); ?>" class="btn btn-ghost magnetic" style="color:#fff;border-color:rgba(255,255,255,.25)"><?php echo esc_html( bl_value('bl_home_216', 'Call our events team', get_queried_object_id()) ); ?></a>
    </div>
  </div>
</section>

<!-- FOOTER -->
<?php get_template_part( 'template-parts/footer-home' ); ?>

<!-- PROJECT DETAIL PANEL -->
<div class="panel-backdrop" id="panelBackdrop"></div>
<?php get_template_part( 'template-parts/projects/panels-home' ); ?>

<!-- FLOATING CONTACT -->
<?php get_template_part( 'template-parts/floating-contact' ); ?>


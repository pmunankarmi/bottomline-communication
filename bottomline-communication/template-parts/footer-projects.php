<?php defined( 'ABSPATH' ) || exit; ?>
<footer>
  <div class="foot-grid row g-5">
    <div class="col-lg-5 foot-brand">
      <a href="<?php echo esc_url( bl_url( bl_value('bl_global_footer_010', 'index.html', 'option') ) ); ?>" class="logo">
        <img class="brand-logo" src="<?php echo esc_url( bl_url( bl_value('bl_global_footer_002', 'bottomline-logo-white.svg?v=2', 'option') ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_global_footer_003', 'BottomLine', 'option') ); ?>" />
      </a>
      <p style="margin-top:24px"><?php echo esc_html( bl_value('bl_global_footer_004', 'Strategic concepts for evolving businesses, operating across the MENA region.', 'option') ); ?></p>
    </div>
    <div class="col-md-4 col-lg-2 foot-col">
      <h5><?php echo esc_html( bl_value('bl_global_footer_011', 'Riyadh', 'option') ); ?></h5>
      <strong><?php echo esc_html( bl_value('bl_global_footer_012', 'Office 18B, 4th Floor', 'option') ); ?></strong>
      <p><?php echo esc_html( bl_value('bl_global_footer_013', 'Al Sulaimaniyah, 7612 Salah Ad Din Al Ayyubi Road, KSA', 'option') ); ?></p>
    </div>
    <div class="col-md-4 col-lg-2 foot-col">
      <h5><?php echo esc_html( bl_value('bl_global_footer_014', 'Jeddah', 'option') ); ?></h5>
      <strong><?php echo esc_html( bl_value('bl_global_footer_015', 'Office No. 3013, 3rd Floor', 'option') ); ?></strong>
      <p><?php echo esc_html( bl_value('bl_global_footer_016', 'Al-Khuraji Business Center, Madinah Road, KSA', 'option') ); ?></p>
    </div>
    <div class="col-md-4 col-lg-3 foot-col">
      <h5><?php echo esc_html( bl_value('bl_global_footer_017', 'Contact', 'option') ); ?></h5>
      <strong><?php echo esc_html( bl_value('bl_global_footer_018', 'Marketing', 'option') ); ?></strong>
      <a href="<?php echo esc_url( bl_url( bl_value('bl_global_footer_008', 'tel:+966583841010', 'option') ) ); ?>"><?php echo esc_html( bl_value('bl_global_footer_019', '+966 58 384 1010', 'option') ); ?></a>
      <strong style="margin-top:14px"><?php echo esc_html( bl_value('bl_global_footer_020', 'Events', 'option') ); ?></strong>
      <a href="<?php echo esc_url( bl_url( bl_value('bl_global_footer_009', 'tel:+966564604739', 'option') ) ); ?>"><?php echo esc_html( bl_value('bl_global_footer_021', '+966 56 460 4739', 'option') ); ?></a>
    </div>
  </div>
  <div class="foot-bottom">
    <div><?php echo esc_html( bl_value('bl_global_footer_022', '© 2025 BottomLine Agency. All rights reserved.', 'option') ); ?></div>
    <div><?php echo esc_html( bl_value('bl_global_footer_023', 'Riyadh · Jeddah · Dubai · Beirut', 'option') ); ?></div>
  </div>
</footer>
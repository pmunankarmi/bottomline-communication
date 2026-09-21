<?php defined( 'ABSPATH' ) || exit; ?>
<footer>
  <div class="foot-grid row g-5">
    <div class="col-lg-5 foot-brand">
      <a href="<?php echo esc_url( bl_url( bl_value('bl_global_footer_001', '#', 'option') ) ); ?>" class="logo">
        <img class="brand-logo" src="<?php echo esc_url( bl_url( bl_value('bl_global_footer_002', 'bottomline-logo-white.svg?v=2', 'option') ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_global_footer_003', 'BottomLine', 'option') ); ?>" />
      </a>
      <p style="margin-top:24px"><?php echo esc_html( bl_value('bl_global_footer_004', 'Strategic concepts for evolving businesses, operating across the MENA region.', 'option') ); ?></p>
      <div class="foot-socials">
        <a href="<?php echo esc_url( bl_url( bl_value('bl_social_instagram', '#', 'option') ) ); ?>" aria-label="<?php echo esc_attr( bl_value('bl_global_footer_005', 'Instagram', 'option') ); ?>"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
        <a href="<?php echo esc_url( bl_url( bl_value('bl_social_linkedin', '#', 'option') ) ); ?>" aria-label="<?php echo esc_attr( bl_value('bl_global_footer_006', 'LinkedIn', 'option') ); ?>"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a>
        <a href="<?php echo esc_url( bl_url( bl_value('bl_social_x', '#', 'option') ) ); ?>" aria-label="<?php echo esc_attr( bl_value('bl_global_footer_007', 'X', 'option') ); ?>"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
      </div>
    </div>
    <div class="col-md-4 col-lg-2 foot-col">
      <h5>Riyadh</h5>
      <strong>Office 18B, 4th Floor</strong>
      <p>Al Sulaimaniyah, 7612 Salah Ad Din Al Ayyubi Road, KSA</p>
    </div>
    <div class="col-md-4 col-lg-2 foot-col">
      <h5>Jeddah</h5>
      <strong>Office No. 3013, 3rd Floor</strong>
      <p>Al-Khuraji Business Center, Madinah Road, KSA</p>
    </div>
    <div class="col-md-4 col-lg-3 foot-col">
      <h5>Contact</h5>
      <strong>Marketing</strong>
      <a href="<?php echo esc_url( bl_url( bl_value('bl_global_footer_008', 'tel:+966583841010', 'option') ) ); ?>">+966 58 384 1010</a>
      <strong style="margin-top:14px">Events</strong>
      <a href="<?php echo esc_url( bl_url( bl_value('bl_global_footer_009', 'tel:+966564604739', 'option') ) ); ?>">+966 56 460 4739</a>
    </div>
  </div>
  <div class="foot-bottom">
    <div>© 2025 BottomLine Agency. All rights reserved.</div>
    <div>Riyadh · Jeddah · Dubai · Beirut</div>
  </div>
</footer>

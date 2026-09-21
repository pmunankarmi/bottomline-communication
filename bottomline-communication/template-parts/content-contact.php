

<?php get_template_part( 'template-parts/navigation-contact' ); ?>

<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_contact_001', 'Start a Project', get_queried_object_id()) ); ?></span>
    <h1><?php echo esc_html( bl_value('bl_contact_002', 'Tell us what you\'re', get_queried_object_id()) ); ?> <span class="accent"><?php echo esc_html( bl_value('bl_contact_003', 'building.', get_queried_object_id()) ); ?></span></h1>
    <p><?php echo esc_html( bl_value('bl_contact_004', 'Marketing campaigns, brand identity, flagship events, or your next digital launch — share the brief and we\'ll come back within one business day.', get_queried_object_id()) ); ?></p>
  </div>
</section>

<section class="contact-section" id="form">
  <div class="contact-grid row g-5 align-items-start">
    <div class="col-lg-7 form-card-wrap"><div class="form-card" id="formCard">
      <form id="briefForm" <?php if ( bl_brief_sent() ) echo 'hidden'; ?> method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <?php wp_nonce_field( 'bl_brief', 'bl_nonce' ); ?><input type="hidden" name="action" value="bl_brief" /><div hidden><label>Leave empty<input name="website" tabindex="-1" autocomplete="off" /></label></div><?php bl_form_notice(); ?><div class="form-row row g-3">
          <div class="col-md-6 field">
            <label><?php echo esc_html( bl_value('bl_contact_005', 'Full Name', get_queried_object_id()) ); ?> <span class="req"><?php echo esc_html( bl_value('bl_contact_006', '*', get_queried_object_id()) ); ?></span></label>
            <input type="text" name="name" required placeholder="<?php echo esc_attr( bl_value('bl_contact_007', 'Your name', get_queried_object_id()) ); ?>" />
          </div>
          <div class="col-md-6 field">
            <label><?php echo esc_html( bl_value('bl_contact_008', 'Email', get_queried_object_id()) ); ?> <span class="req"><?php echo esc_html( bl_value('bl_contact_006', '*', get_queried_object_id()) ); ?></span></label>
            <input type="email" name="email" required placeholder="<?php echo esc_attr( bl_value('bl_contact_009', 'you@company.com', get_queried_object_id()) ); ?>" />
          </div>
        </div>

        <div class="form-row row g-3">
          <div class="col-md-6 field">
            <label><?php echo esc_html( bl_value('bl_contact_010', 'Phone', get_queried_object_id()) ); ?></label>
            <input type="tel" name="phone" placeholder="<?php echo esc_attr( bl_value('bl_contact_011', '+966 ...', get_queried_object_id()) ); ?>" />
          </div>
          <div class="col-md-6 field">
            <label><?php echo esc_html( bl_value('bl_contact_012', 'Company / Brand', get_queried_object_id()) ); ?></label>
            <input type="text" name="company" placeholder="<?php echo esc_attr( bl_value('bl_contact_013', 'Your organisation', get_queried_object_id()) ); ?>" />
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label><?php echo esc_html( bl_value('bl_contact_014', 'What can we help with?', get_queried_object_id()) ); ?> <span class="req"><?php echo esc_html( bl_value('bl_contact_006', '*', get_queried_object_id()) ); ?></span></label>
            <div class="service-checks row g-2">
              <label class="col-md-6 check-pill"><input type="checkbox" name="service[]" value="Marketing"><span class="box"></span><span><?php echo esc_html( bl_value('bl_contact_015', 'Marketing', get_queried_object_id()) ); ?></span></label>
              <label class="col-md-6 check-pill"><input type="checkbox" name="service[]" value="Event Management"><span class="box"></span><span><?php echo esc_html( bl_value('bl_contact_016', 'Event Management', get_queried_object_id()) ); ?></span></label>
              <label class="col-md-6 check-pill"><input type="checkbox" name="service[]" value="Branding"><span class="box"></span><span><?php echo esc_html( bl_value('bl_contact_017', 'Branding', get_queried_object_id()) ); ?></span></label>
              <label class="col-md-6 check-pill"><input type="checkbox" name="service[]" value="Content"><span class="box"></span><span><?php echo esc_html( bl_value('bl_contact_018', 'Content', get_queried_object_id()) ); ?></span></label>
              <label class="col-md-6 check-pill"><input type="checkbox" name="service[]" value="Animation"><span class="box"></span><span><?php echo esc_html( bl_value('bl_contact_019', 'Animation', get_queried_object_id()) ); ?></span></label>
              <label class="col-md-6 check-pill"><input type="checkbox" name="service[]" value="Website & Apps"><span class="box"></span><span><?php echo esc_html( bl_value('bl_contact_020', 'Website & Apps', get_queried_object_id()) ); ?></span></label>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label><?php echo esc_html( bl_value('bl_contact_021', 'Estimated Budget (SAR)', get_queried_object_id()) ); ?></label>
            <div class="budget-grid row g-2">
              <div class="col-6 col-md-3"><button type="button" class="budget-pill" data-budget="< 50k"><?php echo esc_html( bl_value('bl_contact_022', 'Under 50k', get_queried_object_id()) ); ?></button></div>
              <div class="col-6 col-md-3"><button type="button" class="budget-pill" data-budget="50k – 150k"><?php echo esc_html( bl_value('bl_contact_023', '50k – 150k', get_queried_object_id()) ); ?></button></div>
              <div class="col-6 col-md-3"><button type="button" class="budget-pill" data-budget="150k – 500k"><?php echo esc_html( bl_value('bl_contact_024', '150k – 500k', get_queried_object_id()) ); ?></button></div>
              <div class="col-6 col-md-3"><button type="button" class="budget-pill" data-budget="500k+"><?php echo esc_html( bl_value('bl_contact_025', '500k+', get_queried_object_id()) ); ?></button></div>
            </div>
            <input type="hidden" name="budget" id="budgetField" />
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label><?php echo esc_html( bl_value('bl_contact_026', 'Timeline', get_queried_object_id()) ); ?></label>
            <select name="timeline">
              <option value=""><?php echo esc_html( bl_value('bl_contact_027', 'When do you want to start?', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_value('bl_contact_028', 'Immediately', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_value('bl_contact_029', 'Within 1 month', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_value('bl_contact_030', '1–3 months', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_value('bl_contact_031', '3+ months', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_value('bl_contact_032', 'Just exploring', get_queried_object_id()) ); ?></option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label><?php echo esc_html( bl_value('bl_contact_033', 'Tell us about the project', get_queried_object_id()) ); ?> <span class="req"><?php echo esc_html( bl_value('bl_contact_006', '*', get_queried_object_id()) ); ?></span></label>
            <textarea name="message" required placeholder="<?php echo esc_attr( bl_value('bl_contact_034', 'Objective, audience, scope, references — whatever helps us understand.', get_queried_object_id()) ); ?>"></textarea>
          </div>
        </div>

        <button type="submit" class="form-submit"><?php echo esc_html( bl_value('bl_contact_035', 'Send the brief →', get_queried_object_id()) ); ?></button>
        <p class="form-note"><?php echo esc_html( bl_value('bl_contact_036', 'We\'ll get back to you within one business day. No spam, no sales call queues.', get_queried_object_id()) ); ?></p>
      </form>

      <div class="form-success <?php if ( bl_brief_sent() ) echo 'show'; ?>" id="formSuccess">
        <div class="success-mark"><?php echo esc_html( bl_value('bl_contact_037', '✓', get_queried_object_id()) ); ?></div>
        <h3 style="font-size:1.6rem;font-weight:700;color:var(--ink);margin-bottom:14px;letter-spacing:-.5px"><?php echo esc_html( bl_value('bl_contact_038', 'Brief received.', get_queried_object_id()) ); ?></h3>
        <p style="color:var(--muted);max-width:38ch;margin:0 auto 24px"><?php echo esc_html( bl_value('bl_contact_039', 'Thank you. A member of our team will be in touch within one business day to walk through the next steps.', get_queried_object_id()) ); ?></p>
        <a href="<?php echo esc_url( bl_url( bl_value('bl_contact_040', 'index.html', get_queried_object_id()) ) ); ?>" class="form-submit" style="display:inline-flex;width:auto;padding:14px 28px"><?php echo esc_html( bl_value('bl_contact_041', 'Back to home', get_queried_object_id()) ); ?></a>
      </div>
    </div></div>

    <div class="col-lg-5 contact-info">
      <div class="response-time">
        <span class="dot"></span>
        <div>
          <p><?php echo esc_html( bl_value('bl_contact_042', 'Currently accepting new briefs', get_queried_object_id()) ); ?></p>
          <small><?php echo esc_html( bl_value('bl_contact_043', 'Average response: one business day', get_queried_object_id()) ); ?></small>
        </div>
      </div>

      <h3><?php echo esc_html( bl_value('bl_contact_044', 'Or reach us directly', get_queried_object_id()) ); ?></h3>

      <div class="info-block">
        <h4><?php echo esc_html( bl_value('bl_contact_015', 'Marketing', get_queried_object_id()) ); ?></h4>
        <a href="<?php echo esc_url( bl_url( bl_value('bl_contact_045', 'tel:+966583841010', get_queried_object_id()) ) ); ?>"><?php echo esc_html( bl_value('bl_contact_046', '+966 58 384 1010', get_queried_object_id()) ); ?></a>
        <a href="<?php echo esc_url( bl_url( bl_value('bl_contact_047', 'mailto:hello@bottomline.com', get_queried_object_id()) ) ); ?>"><?php echo esc_html( bl_value('bl_contact_048', 'hello@bottomline.com', get_queried_object_id()) ); ?></a>
      </div>
      <div class="info-block">
        <h4><?php echo esc_html( bl_value('bl_contact_049', 'Events', get_queried_object_id()) ); ?></h4>
        <a href="<?php echo esc_url( bl_url( bl_value('bl_contact_050', 'tel:+966564604739', get_queried_object_id()) ) ); ?>"><?php echo esc_html( bl_value('bl_contact_051', '+966 56 460 4739', get_queried_object_id()) ); ?></a>
      </div>
      <div class="info-block">
        <h4><?php echo esc_html( bl_value('bl_contact_052', 'Jeddah', get_queried_object_id()) ); ?></h4>
        <strong><?php echo esc_html( bl_value('bl_contact_053', 'Office No. 3013, 3rd Floor', get_queried_object_id()) ); ?></strong>
        <p><?php echo esc_html( bl_value('bl_contact_054', 'Al-Khuraji Business Center, Madinah Road, KSA', get_queried_object_id()) ); ?></p>
      </div>
      <div class="info-block">
        <h4><?php echo esc_html( bl_value('bl_contact_055', 'Riyadh', get_queried_object_id()) ); ?></h4>
        <strong><?php echo esc_html( bl_value('bl_contact_056', 'Office 18B, 4th Floor', get_queried_object_id()) ); ?></strong>
        <p><?php echo esc_html( bl_value('bl_contact_057', 'Al Sulaimaniyah, 7612 Salah Ad Din Al Ayyubi Road, KSA', get_queried_object_id()) ); ?></p>
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'template-parts/footer-contact' ); ?>

<?php get_template_part( 'template-parts/floating-contact' ); ?>


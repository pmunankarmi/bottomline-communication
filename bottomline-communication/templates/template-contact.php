<?php
/** Template Name: BottomLine Contact */
defined( 'ABSPATH' ) || exit;
get_header();
?>




<section class="page-hero">
  <div class="page-hero-inner">
    <span class="page-eyebrow"><?php echo esc_html( bl_value('bl_contact_001', 'Start a Project', get_queried_object_id()) ); ?></span>
<?php bl_section( 'bl_contact_hero' ); ?>
  </div>
</section>

<section class="contact-section" id="form">
  <div class="contact-grid row g-5 align-items-start">
    <div class="col-lg-7 form-card-wrap"><div class="form-card" id="formCard">
      <form id="briefForm" data-validation="jquery" <?php if ( bl_brief_sent() ) echo 'hidden'; ?> method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <?php wp_nonce_field( 'bl_brief', 'bl_nonce' ); ?><input type="hidden" name="action" value="bl_brief" /><div hidden><label><?php echo esc_html( bl_copy( 'bl_contact_copy_1', 'Leave empty', get_queried_object_id() ) ); ?><input name="website" tabindex="-1" autocomplete="off" /></label></div><?php bl_form_notice(); ?><div class="form-row row g-3">
          <div class="col-md-6 field">
            <label><?php echo esc_html( bl_copy('bl_contact_005', 'Full Name', get_queried_object_id()) ); ?> <span class="req"><?php echo esc_html( bl_copy('bl_contact_006', '*', get_queried_object_id()) ); ?></span></label>
            <input type="text" name="name" data-msg-required="Please enter your full name." required placeholder="<?php echo esc_attr( bl_copy('bl_contact_007', 'Your name', get_queried_object_id()) ); ?>" />
          </div>
          <div class="col-md-6 field">
            <label><?php echo esc_html( bl_copy('bl_contact_008', 'Email', get_queried_object_id()) ); ?> <span class="req"><?php echo esc_html( bl_copy('bl_contact_006', '*', get_queried_object_id()) ); ?></span></label>
            <input type="email" name="email" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." required placeholder="<?php echo esc_attr( bl_copy('bl_contact_009', 'you@company.com', get_queried_object_id()) ); ?>" />
          </div>
        </div>

        <div class="form-row row g-3">
          <div class="col-md-6 field">
            <label><?php echo esc_html( bl_copy('bl_contact_010', 'Phone', get_queried_object_id()) ); ?></label>
            <input type="tel" name="phone" placeholder="<?php echo esc_attr( bl_copy('bl_contact_011', '+966 ...', get_queried_object_id()) ); ?>" />
          </div>
          <div class="col-md-6 field">
            <label><?php echo esc_html( bl_copy('bl_contact_012', 'Company / Brand', get_queried_object_id()) ); ?></label>
            <input type="text" name="company" placeholder="<?php echo esc_attr( bl_copy('bl_contact_013', 'Your organisation', get_queried_object_id()) ); ?>" />
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label><?php echo esc_html( bl_copy('bl_contact_014', 'What can we help with?', get_queried_object_id()) ); ?> <span class="req"><?php echo esc_html( bl_copy('bl_contact_006', '*', get_queried_object_id()) ); ?></span></label>
            <div class="service-checks row g-2">
              <?php foreach ( bl_content_posts( 'bl_service' ) as $service ) : ?>
              <label class="col-md-6 check-pill"><input type="checkbox" name="service[]" value="<?php echo esc_attr( $service->post_title ); ?>" data-msg-required="Please select at least one service."><span class="box"></span><span><?php echo esc_html( $service->post_title ); ?></span></label>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label><?php echo esc_html( bl_copy('bl_contact_021', 'Estimated Budget (SAR)', get_queried_object_id()) ); ?></label>
            <div class="budget-grid row g-2">
              <div class="col-6 col-md-3"><button type="button" class="budget-pill" data-budget="< 50k"><?php echo esc_html( bl_copy('bl_contact_022', 'Under 50k', get_queried_object_id()) ); ?></button></div>
              <div class="col-6 col-md-3"><button type="button" class="budget-pill" data-budget="50k – 150k"><?php echo esc_html( bl_copy('bl_contact_023', '50k – 150k', get_queried_object_id()) ); ?></button></div>
              <div class="col-6 col-md-3"><button type="button" class="budget-pill" data-budget="150k – 500k"><?php echo esc_html( bl_copy('bl_contact_024', '150k – 500k', get_queried_object_id()) ); ?></button></div>
              <div class="col-6 col-md-3"><button type="button" class="budget-pill" data-budget="500k+"><?php echo esc_html( bl_copy('bl_contact_025', '500k+', get_queried_object_id()) ); ?></button></div>
            </div>
            <input type="hidden" name="budget" id="budgetField" />
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label><?php echo esc_html( bl_copy('bl_contact_026', 'Timeline', get_queried_object_id()) ); ?></label>
            <select name="timeline">
              <option value=""><?php echo esc_html( bl_copy('bl_contact_027', 'When do you want to start?', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_copy('bl_contact_028', 'Immediately', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_copy('bl_contact_029', 'Within 1 month', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_copy('bl_contact_030', '1–3 months', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_copy('bl_contact_031', '3+ months', get_queried_object_id()) ); ?></option>
              <option><?php echo esc_html( bl_copy('bl_contact_032', 'Just exploring', get_queried_object_id()) ); ?></option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label><?php echo esc_html( bl_copy('bl_contact_033', 'Tell us about the project', get_queried_object_id()) ); ?> <span class="req"><?php echo esc_html( bl_copy('bl_contact_006', '*', get_queried_object_id()) ); ?></span></label>
            <textarea name="message" data-msg-required="Please tell us about your project." required placeholder="<?php echo esc_attr( bl_copy('bl_contact_034', 'Objective, audience, scope, references — whatever helps us understand.', get_queried_object_id()) ); ?>"></textarea>
          </div>
        </div>

        <button type="submit" class="form-submit"><?php echo esc_html( bl_copy('bl_contact_035', 'Send the brief →', get_queried_object_id()) ); ?></button>
        <p class="form-note"><?php echo esc_html( bl_value('bl_contact_036', 'We\'ll get back to you within one business day. No spam, no sales call queues.', get_queried_object_id()) ); ?></p>
      </form>

      <div class="form-success <?php if ( bl_brief_sent() ) echo 'show'; ?>" id="formSuccess">
        <div class="success-mark"><?php echo esc_html( bl_copy('bl_contact_037', '✓', get_queried_object_id()) ); ?></div>
<?php bl_section( 'bl_contact_receipt' ); ?>
        <?php bl_section_button( 'bl_contact_button_1', 'form-submit', 'display:inline-flex;width:auto;padding:14px 28px' ); ?>
      </div>
    </div></div>

    <div class="col-lg-5 contact-info">
      <div class="response-time">
        <span class="dot"></span>
        <div>
<?php bl_section( 'bl_contact_availability' ); ?>
        </div>
      </div>

      <h3><?php echo esc_html( bl_value('bl_contact_044', 'Or reach us directly', get_queried_object_id()) ); ?></h3>

      <div class="info-block">
        <h4><?php echo esc_html( bl_copy('bl_contact_015', 'Marketing', get_queried_object_id()) ); ?></h4>
        <a href="<?php echo esc_url( bl_phone_url( 'bl_marketing_phone', '+966 58 384 1010' ) ); ?>"><?php echo esc_html( bl_value( 'bl_marketing_phone', '+966 58 384 1010', 'option' ) ); ?></a>
        <a href="<?php echo esc_url( 'mailto:' . bl_value( 'bl_contact_email', 'hello@bottomline.com', 'option' ) ); ?>"><?php echo esc_html( bl_value( 'bl_contact_email', 'hello@bottomline.com', 'option' ) ); ?></a>
      </div>
      <div class="info-block">
        <h4><?php echo esc_html( bl_copy('bl_contact_049', 'Events', get_queried_object_id()) ); ?></h4>
        <a href="<?php echo esc_url( bl_phone_url( 'bl_events_phone', '+966 56 460 4739' ) ); ?>"><?php echo esc_html( bl_value( 'bl_events_phone', '+966 56 460 4739', 'option' ) ); ?></a>
      </div>
      <div class="info-block">
        <h4><?php echo esc_html( bl_copy('bl_contact_052', 'Jeddah', get_queried_object_id()) ); ?></h4>
        <strong><?php echo esc_html( bl_value( 'bl_jeddah_office', 'Office No. 3013, 3rd Floor', 'option' ) ); ?></strong>
        <p><?php echo esc_html( bl_value( 'bl_jeddah_address', 'Al-Khuraji Business Center, Madinah Road, KSA', 'option' ) ); ?></p>
      </div>
      <div class="info-block">
        <h4><?php echo esc_html( bl_copy('bl_contact_055', 'Riyadh', get_queried_object_id()) ); ?></h4>
        <strong><?php echo esc_html( bl_value( 'bl_riyadh_office', 'Office 18B, 4th Floor', 'option' ) ); ?></strong>
        <p><?php echo esc_html( bl_value( 'bl_riyadh_address', 'Al Sulaimaniyah, 7612 Salah Ad Din Al Ayyubi Road, KSA', 'option' ) ); ?></p>
      </div>
    </div>
  </div>
</section>






<?php get_footer(); ?>

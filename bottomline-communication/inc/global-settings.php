<?php
/** Global settings only, grouped into native ACF tabs. */
defined( 'ABSPATH' ) || exit;
add_action( 'acf/init', function () {
    acf_add_local_field_group( array(
        'key' => 'group_bl_globals', 'title' => 'Global site settings',
        'style' => 'seamless',
        'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'bottomline-settings' ) ) ),
        'fields' => array(
            array( 'key' => 'field_bl_tab_branding', 'label' => 'Branding', 'type' => 'tab', 'placement' => 'top' ),
            array( 'key' => 'field_bl_logo', 'name' => 'bl_logo', 'label' => 'Logo', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium', 'library' => 'all', 'instructions' => 'Upload or select your logo. Synced with Appearance → Customize → Site Identity → Logo. Remove it to use the original bundled logo.' ),
            array( 'key' => 'field_bl_tab_contact', 'label' => 'Contact', 'type' => 'tab', 'placement' => 'top' ),
            array( 'key' => 'field_bl_marketing_phone', 'name' => 'bl_marketing_phone', 'label' => 'Marketing phone', 'type' => 'text', 'default_value' => '+966 58 384 1010', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_events_phone', 'name' => 'bl_events_phone', 'label' => 'Events phone', 'type' => 'text', 'default_value' => '+966 56 460 4739', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_contact_email', 'name' => 'bl_contact_email', 'label' => 'Contact email', 'type' => 'text', 'default_value' => 'hello@bottomline.com', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_whatsapp_url', 'name' => 'bl_whatsapp_url', 'label' => 'WhatsApp URL', 'type' => 'text', 'default_value' => 'https://wa.me/966583841010', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_tab_offices', 'label' => 'Offices', 'type' => 'tab', 'placement' => 'top' ),
            array( 'key' => 'field_bl_riyadh_office', 'name' => 'bl_riyadh_office', 'label' => 'Riyadh office', 'type' => 'text', 'default_value' => 'Office 18B, 4th Floor', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_riyadh_address', 'name' => 'bl_riyadh_address', 'label' => 'Riyadh address', 'type' => 'text', 'default_value' => 'Al Sulaimaniyah, 7612 Salah Ad Din Al Ayyubi Road, KSA', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_jeddah_office', 'name' => 'bl_jeddah_office', 'label' => 'Jeddah office', 'type' => 'text', 'default_value' => 'Office No. 3013, 3rd Floor', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_jeddah_address', 'name' => 'bl_jeddah_address', 'label' => 'Jeddah address', 'type' => 'text', 'default_value' => 'Al-Khuraji Business Center, Madinah Road, KSA', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_office_cities', 'name' => 'bl_office_cities', 'label' => 'Office cities', 'type' => 'text', 'default_value' => 'Riyadh · Jeddah · Dubai · Beirut', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_tab_social_media', 'label' => 'Social Media', 'type' => 'tab', 'placement' => 'top' ),
            array( 'key' => 'field_bl_social_instagram', 'name' => 'bl_social_instagram', 'label' => 'Instagram URL', 'type' => 'text', 'default_value' => '#', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_social_linkedin', 'name' => 'bl_social_linkedin', 'label' => 'LinkedIn URL', 'type' => 'text', 'default_value' => '#', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_social_x', 'name' => 'bl_social_x', 'label' => 'X URL', 'type' => 'text', 'default_value' => '#', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_tab_footer', 'label' => 'Footer', 'type' => 'tab', 'placement' => 'top' ),
            array( 'key' => 'field_bl_footer_description', 'name' => 'bl_footer_description', 'label' => 'Footer description', 'type' => 'text', 'default_value' => 'Strategic concepts for evolving businesses, operating across the MENA region.', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_copyright', 'name' => 'bl_copyright', 'label' => 'Copyright', 'type' => 'text', 'default_value' => '© 2025 BottomLine Agency. All rights reserved.', 'instructions' => 'Shared across the site.' ),
            array( 'key' => 'field_bl_tab_form_delivery', 'label' => 'Form Delivery', 'type' => 'tab', 'placement' => 'top' ),
            array( 'key' => 'field_bl_brief_recipient', 'name' => 'bl_brief_recipient', 'label' => 'Brief recipient email', 'type' => 'text', 'instructions' => 'Defaults to the WordPress administration email. Configure SMTP with your hosting provider for reliable delivery.', 'default_value' => get_option( 'admin_email' ) ),
        ),
    ) );
} );

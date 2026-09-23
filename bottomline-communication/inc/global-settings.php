<?php
defined( 'ABSPATH' ) || exit;
add_action( 'acf/init', function () {
acf_add_local_field_group( array( 'key' => 'group_bl_globals', 'title' => 'Global site settings', 'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'bottomline-settings' ) ) ), 'fields' => array(
array( 'key' => 'field_bl_logo_url', 'name' => 'bl_logo_url', 'label' => 'Logo URL', 'type' => 'text', 'default_value' => '', 'instructions' => 'Paste an image URL from this site’s Media Library. This is synced with Appearance → Customize → Site Identity → Logo. Leave blank to use the original logo.' ),
array( 'key' => 'field_bl_footer_description', 'name' => 'bl_footer_description', 'label' => 'Footer description', 'type' => 'text', 'default_value' => 'Strategic concepts for evolving businesses, operating across the MENA region.', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_riyadh_office', 'name' => 'bl_riyadh_office', 'label' => 'Riyadh office', 'type' => 'text', 'default_value' => 'Office 18B, 4th Floor', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_riyadh_address', 'name' => 'bl_riyadh_address', 'label' => 'Riyadh address', 'type' => 'text', 'default_value' => 'Al Sulaimaniyah, 7612 Salah Ad Din Al Ayyubi Road, KSA', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_jeddah_office', 'name' => 'bl_jeddah_office', 'label' => 'Jeddah office', 'type' => 'text', 'default_value' => 'Office No. 3013, 3rd Floor', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_jeddah_address', 'name' => 'bl_jeddah_address', 'label' => 'Jeddah address', 'type' => 'text', 'default_value' => 'Al-Khuraji Business Center, Madinah Road, KSA', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_marketing_phone', 'name' => 'bl_marketing_phone', 'label' => 'Marketing phone', 'type' => 'text', 'default_value' => '+966 58 384 1010', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_events_phone', 'name' => 'bl_events_phone', 'label' => 'Events phone', 'type' => 'text', 'default_value' => '+966 56 460 4739', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_contact_email', 'name' => 'bl_contact_email', 'label' => 'Contact email', 'type' => 'text', 'default_value' => 'hello@bottomline.com', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_copyright', 'name' => 'bl_copyright', 'label' => 'Copyright', 'type' => 'text', 'default_value' => '© 2025 BottomLine Agency. All rights reserved.', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_office_cities', 'name' => 'bl_office_cities', 'label' => 'Office cities', 'type' => 'text', 'default_value' => 'Riyadh · Jeddah · Dubai · Beirut', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_whatsapp_url', 'name' => 'bl_whatsapp_url', 'label' => 'WhatsApp URL', 'type' => 'text', 'default_value' => 'https://wa.me/966583841010', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_social_instagram', 'name' => 'bl_social_instagram', 'label' => 'Instagram URL', 'type' => 'text', 'default_value' => '#', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_social_linkedin', 'name' => 'bl_social_linkedin', 'label' => 'LinkedIn URL', 'type' => 'text', 'default_value' => '#', 'instructions' => 'Shared across the site.' ),
array( 'key' => 'field_bl_social_x', 'name' => 'bl_social_x', 'label' => 'X URL', 'type' => 'text', 'default_value' => '#', 'instructions' => 'Shared across the site.' ),
) ) );
} );

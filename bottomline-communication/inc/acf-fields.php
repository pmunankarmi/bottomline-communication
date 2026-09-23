<?php
defined( 'ABSPATH' ) || exit;
add_action( 'acf/init', function () {
if ( function_exists( 'acf_add_options_page' ) ) { acf_add_options_page( array( 'page_title' => 'BottomLine Settings', 'menu_title' => 'BottomLine', 'menu_slug' => 'bottomline-settings', 'capability' => 'edit_theme_options', 'redirect' => false ) ); }

acf_add_local_field_group( array( 'key' => 'group_bl_home', 'title' => 'Home', 'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-home.php' ) ), array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ) ), 'fields' => array(
array( 'key' => 'field_bl_home_155', 'name' => 'bl_home_155', 'label' => 'Our Clients', 'type' => 'text', 'default_value' => 'Our Clients', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_home_011', 'name' => 'bl_home_011', 'label' => 'About BottomLine', 'type' => 'text', 'default_value' => 'About BottomLine', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_home_028', 'name' => 'bl_home_028', 'label' => 'Our Services', 'type' => 'text', 'default_value' => 'Our Services', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_home_031', 'name' => 'bl_home_031', 'label' => 'From the first concept to the final report, BottomLine covers every discipline a modern br', 'type' => 'text', 'default_value' => 'From the first concept to the final report, BottomLine covers every discipline a modern brand needs to grow — strategy, creative, execution and analytics.', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_home_086', 'name' => 'bl_home_086', 'label' => 'Selected Work', 'type' => 'text', 'default_value' => 'Selected Work', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_home_089', 'name' => 'bl_home_089', 'label' => 'From flagship launches to multi-year campaigns — a glimpse of recent work across branding,', 'type' => 'text', 'default_value' => 'From flagship launches to multi-year campaigns — a glimpse of recent work across branding, events, digital and activation.', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_home_140', 'name' => 'bl_home_140', 'label' => 'Our Event Strategy', 'type' => 'text', 'default_value' => 'Our Event Strategy', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_home_143', 'name' => 'bl_home_143', 'label' => 'Every BottomLine event follows a tested, transparent process — from the spark of an idea t', 'type' => 'text', 'default_value' => 'Every BottomLine event follows a tested, transparent process — from the spark of an idea to the post-event report on your desk.', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_home_158', 'name' => 'bl_home_158', 'label' => 'From global enterprises to government bodies and regional retailers — we\'ve partnered with', 'type' => 'text', 'default_value' => 'From global enterprises to government bodies and regional retailers — we\'ve partnered with the brands shaping KSA and the wider MENA region.', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
) ) );
acf_add_local_field_group( array( 'key' => 'group_bl_about', 'title' => 'About', 'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-about.php' ) ) ), 'fields' => array(
array( 'key' => 'field_bl_about_001', 'name' => 'bl_about_001', 'label' => 'About BottomLine', 'type' => 'text', 'default_value' => 'About BottomLine', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_about_005', 'name' => 'bl_about_005', 'label' => 'Our Story', 'type' => 'text', 'default_value' => 'Our Story', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_about_016', 'name' => 'bl_about_016', 'label' => 'Vision · Mission · Values', 'type' => 'text', 'default_value' => 'Vision · Mission · Values', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_about_031', 'name' => 'bl_about_031', 'label' => 'Presence — Section label', 'type' => 'text', 'default_value' => 'Our Presence' ),
array( 'key' => 'field_bl_presence_heading', 'name' => 'bl_presence_heading', 'label' => 'Presence — Heading', 'type' => 'wysiwyg', 'toolbar' => 'full', 'media_upload' => 0, 'instructions' => 'Write the complete heading. Select words and choose Formats → Accent text or Gradient text.' ),
array( 'key' => 'field_bl_offices', 'name' => 'bl_offices', 'label' => 'Offices', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add office', 'collapsed' => 'field_bl_office_city', 'sub_fields' => array(
    array( 'key' => 'field_bl_office_country', 'name' => 'country', 'label' => 'Country', 'type' => 'text' ),
    array( 'key' => 'field_bl_office_city', 'name' => 'city', 'label' => 'City', 'type' => 'text' ),
    array( 'key' => 'field_bl_office_description', 'name' => 'description', 'label' => 'Address / description', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'instructions' => 'Plain text. Add a new line for each address line.' ),
) ),
) ) );
acf_add_local_field_group( array( 'key' => 'group_bl_projects', 'title' => 'Projects', 'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-projects.php' ) ) ), 'fields' => array(
array( 'key' => 'field_bl_projects_001', 'name' => 'bl_projects_001', 'label' => 'Selected Work', 'type' => 'text', 'default_value' => 'Selected Work', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
) ) );
acf_add_local_field_group( array( 'key' => 'group_bl_clients', 'title' => 'Clients', 'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-clients.php' ) ) ), 'fields' => array(
array( 'key' => 'field_bl_clients_001', 'name' => 'bl_clients_001', 'label' => 'Our Clients', 'type' => 'text', 'default_value' => 'Our Clients', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
) ) );
acf_add_local_field_group( array( 'key' => 'group_bl_contact', 'title' => 'Contact', 'location' => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-contact.php' ) ) ), 'fields' => array(
array( 'key' => 'field_bl_contact_001', 'name' => 'bl_contact_001', 'label' => 'Start a Project', 'type' => 'text', 'default_value' => 'Start a Project', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_contact_036', 'name' => 'bl_contact_036', 'label' => 'We\'ll get back to you within one business day. No spam, no sales call queues.', 'type' => 'text', 'default_value' => 'We\'ll get back to you within one business day. No spam, no sales call queues.', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
array( 'key' => 'field_bl_contact_044', 'name' => 'bl_contact_044', 'label' => 'Or reach us directly', 'type' => 'text', 'default_value' => 'Or reach us directly', 'instructions' => 'Plain text only. Leave blank to hide this text. Original layout and emphasis are kept in PHP.' ),
) ) );
} );

add_action( 'acf/init', function () {
    acf_add_local_field_group( array( 'key' => 'group_bl_stats', 'title' => 'Homepage statistics', 'location' => array( array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ), array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-home.php' ) ) ), 'fields' => array(
        array( 'key' => 'field_bl_home_stats', 'name' => 'bl_home_stats', 'label' => 'Statistics', 'type' => 'repeater', 'layout' => 'table', 'sub_fields' => array(
            array( 'key' => 'field_bl_home_stats_value', 'name' => 'value', 'label' => 'Number', 'type' => 'text' ),
            array( 'key' => 'field_bl_home_stats_suffix', 'name' => 'suffix', 'label' => 'Suffix', 'type' => 'text' ),
            array( 'key' => 'field_bl_home_stats_label', 'name' => 'label', 'label' => 'Label', 'type' => 'text' ),
        ) ),
    ) ) );
} );

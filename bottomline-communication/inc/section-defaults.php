<?php
/** One-time migration from fragmented fields to section editors. Never evaluates stored PHP. */
defined( 'ABSPATH' ) || exit;
function bl_section_seed_values( $kind, $page_id ) {
    $values = array();
    switch ( $kind ) {
case 'home':
$values['bl_home_stats'] = array(
array( 'value' => bl_copy( 'bl_stat_1', '14', $page_id ), 'suffix' => '+', 'label' => bl_copy( 'bl_home_007', 'Years +', $page_id ) ),
array( 'value' => bl_copy( 'bl_stat_2', '50', $page_id ), 'suffix' => '+', 'label' => bl_copy( 'bl_home_008', 'Clients +', $page_id ) ),
array( 'value' => bl_copy( 'bl_stat_3', '4', $page_id ), 'suffix' => '', 'label' => bl_copy( 'bl_home_009', 'Offices', $page_id ) ),
array( 'value' => bl_copy( 'bl_stat_4', '360', $page_id ), 'suffix' => '°', 'label' => bl_copy( 'bl_home_010', 'Service', $page_id ) ),
);
ob_start(); ?>
        <span class="line-mask"><span class="line-text" style="--d:.2s"><?php echo esc_html( bl_copy('bl_home_003', 'We turn ambitious businesses into', $page_id) ); ?></span></span>
        <span class="line-mask"><span class="line-text accent" style="--d:.5s"><?php echo esc_html( bl_copy('bl_home_004', 'market-leading brands.', $page_id) ); ?></span></span>
      <?php $values['bl_home_heading_1'] = trim( ob_get_clean() );
ob_start(); ?><?php echo esc_html( bl_copy('bl_home_012', 'A creative and performance-oriented', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_home_013', 'success partner.', $page_id) ); ?></strong><?php $values['bl_home_heading_2'] = trim( ob_get_clean() );
ob_start(); ?><?php echo esc_html( bl_copy('bl_home_029', 'A full-service', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_home_030', '360° agency.', $page_id) ); ?></strong><?php $values['bl_home_heading_3'] = trim( ob_get_clean() );
ob_start(); ?><?php echo esc_html( bl_copy('bl_home_087', 'Work that', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_home_088', 'moves brands forward.', $page_id) ); ?></strong><?php $values['bl_home_heading_4'] = trim( ob_get_clean() );
ob_start(); ?><?php echo esc_html( bl_copy('bl_home_141', 'Four phases.', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_home_142', 'One flawless experience.', $page_id) ); ?></strong><?php $values['bl_home_heading_5'] = trim( ob_get_clean() );
ob_start(); ?><?php echo esc_html( bl_copy('bl_home_156', 'Our clients are the', $page_id) ); ?> <strong><?php echo esc_html( bl_copy( 'bl_home_157', 'heartbeat of BottomLine.', $page_id ) ); ?></strong><?php $values['bl_home_heading_6'] = trim( ob_get_clean() );
ob_start(); ?><blockquote class="reveal">
      <?php echo esc_html( bl_copy('bl_home_151', 'We create a vision, articulate it, own it, and', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_home_152', 'passionately drive it to completion.', $page_id) ); ?></strong>
    </blockquote>
    <cite class="reveal">
      <strong><?php echo esc_html( bl_copy( 'bl_home_153', 'The BottomLine Promise', $page_id ) ); ?></strong>
      <?php echo esc_html( bl_copy('bl_home_154', 'Marketing · Communication · Events', $page_id) ); ?>
    </cite><?php $values['bl_home_quote'] = trim( ob_get_clean() );
$values['bl_home_button_1'] = array( 'url' => bl_url( bl_copy('bl_home_014', 'about.html', $page_id) ), 'title' => bl_copy('bl_home_015', 'Read the full story →', $page_id), 'target' => '' );
$values['bl_home_button_2'] = array( 'url' => bl_url( bl_copy('bl_home_136', 'projects.html', $page_id) ), 'title' => bl_copy('bl_home_137', 'View all work →', $page_id), 'target' => '' );
$values['bl_home_button_3'] = array( 'url' => bl_url( bl_copy( 'bl_home_138', 'contact.html', $page_id ) ), 'title' => bl_copy('bl_home_139', 'Start your project', $page_id), 'target' => '' );
$values['bl_home_button_4'] = array( 'url' => bl_url( bl_copy('bl_home_209', 'clients.html', $page_id) ), 'title' => bl_copy('bl_home_210', 'Explore all clients →', $page_id), 'target' => '' );
$values['bl_home_benefits'] = array();
ob_start(); ?>
            <h4><?php echo esc_html( bl_copy('bl_home_017', 'Strategy-led, ROI-driven', $page_id) ); ?></h4>
            <p><?php echo esc_html( bl_copy('bl_home_018', 'Every campaign and event starts with sharp strategic thinking and ends with measurable business outcomes.', $page_id) ); ?></p>
          <?php $values['bl_home_benefits'][] = array( 'content' => trim( ob_get_clean() ) );
ob_start(); ?>
            <h4><?php echo esc_html( bl_copy('bl_home_020', '360° integrated execution', $page_id) ); ?></h4>
            <p><?php echo esc_html( bl_copy('bl_home_021', 'Marketing, branding, content, animation, web, and events — under one strategic roof.', $page_id) ); ?></p>
          <?php $values['bl_home_benefits'][] = array( 'content' => trim( ob_get_clean() ) );
ob_start(); ?>
            <h4><?php echo esc_html( bl_copy('bl_home_023', 'Transparent and authentic', $page_id) ); ?></h4>
            <p><?php echo esc_html( bl_copy('bl_home_024', 'Clear scope, honest communication, and partnerships built to last — not transactions.', $page_id) ); ?></p>
          <?php $values['bl_home_benefits'][] = array( 'content' => trim( ob_get_clean() ) );
ob_start(); ?>
            <h4><?php echo esc_html( bl_copy('bl_home_026', 'Regional expertise', $page_id) ); ?></h4>
            <p><?php echo esc_html( bl_copy('bl_home_027', 'Fourteen years on the ground in KSA and MENA, with bilingual creative talent who understand the audience.', $page_id) ); ?></p>
          <?php $values['bl_home_benefits'][] = array( 'content' => trim( ob_get_clean() ) );
$values['bl_home_steps'] = array();
$values['bl_home_steps'][] = array( 'title' => bl_copy('bl_home_045', 'Concept', $page_id), 'description' => bl_copy('bl_home_144', 'We conceptualise the event and create the framework from which it will grow — understanding the why, who, when, where and what.', $page_id) );
$values['bl_home_steps'][] = array( 'title' => bl_copy('bl_home_145', 'Coordination', $page_id), 'description' => bl_copy('bl_home_146', 'Theme, design, budget, venue, entertainers, equipment, caterers — every moving piece locked in and aligned to scope.', $page_id) );
$values['bl_home_steps'][] = array( 'title' => bl_copy('bl_home_147', 'Culmination', $page_id), 'description' => bl_copy('bl_home_148', 'Live execution. We communicate with suppliers, vendors and staff, monitor timelines, and perform under pressure to deliver.', $page_id) );
$values['bl_home_steps'][] = array( 'title' => bl_copy('bl_home_149', 'Closeout', $page_id), 'description' => bl_copy('bl_home_150', 'Venue handover, supplier sign-off, and a complete post-event report so you know exactly what was delivered — and what\'s next.', $page_id) );
break;
case 'about':
ob_start(); ?>    <h1><?php echo esc_html( bl_copy('bl_about_002', 'Strategic concepts for', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_about_003', 'evolving businesses.', $page_id) ); ?></strong></h1>
    <p><?php echo esc_html( bl_copy('bl_about_004', 'BottomLine is a 360° Marketing, Communication and Events agency — operating across KSA and the wider MENA region, with offices in Riyadh, Jeddah, Dubai and Beirut.', $page_id) ); ?></p><?php $values['bl_about_hero'] = trim( ob_get_clean() );
ob_start(); ?>  <h2><?php echo esc_html( bl_copy('bl_about_048', 'Let\'s build something', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_about_049', 'unforgettable.', $page_id) ); ?></strong></h2>
  <p><?php echo esc_html( bl_copy('bl_about_050', 'Marketing, communications, or your next flagship event — tell us what you\'re planning.', $page_id) ); ?></p><?php $values['bl_about_cta'] = trim( ob_get_clean() );
ob_start(); ?><?php echo esc_html( bl_copy('bl_about_006', 'Fourteen years in.', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_about_007', 'Just getting started.', $page_id) ); ?></strong><?php $values['bl_about_heading_1'] = trim( ob_get_clean() );
ob_start(); ?><?php echo esc_html( bl_copy('bl_about_017', 'We create a vision, articulate it, own it, and', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_about_018', 'passionately drive it to completion.', $page_id) ); ?></strong><?php $values['bl_about_heading_2'] = trim( ob_get_clean() );
$values['bl_about_button_1'] = array( 'url' => bl_url( bl_copy('bl_about_051', 'contact.html', $page_id) ), 'title' => bl_copy('bl_about_052', 'Start a project →', $page_id), 'target' => '' );
$values['bl_about_pillars'] = array();
ob_start(); ?><h3><?php echo esc_html( bl_copy('bl_about_021', 'Vision', $page_id) ); ?></h3>
          <p><?php echo esc_html( bl_copy('bl_about_022', 'To be the leading 360 company by meeting and exceeding the expectations of our clients through innovative ideas and excellent service — building sustainable brand presence through strategic marketing.', $page_id) ); ?></p><?php $values['bl_about_pillars'][] = array( 'icon' => bl_copy('bl_about_019', '◆', $page_id), 'label' => bl_copy('bl_about_020', 'Our Destination', $page_id), 'content' => trim( ob_get_clean() ) );
ob_start(); ?><h3><?php echo esc_html( bl_copy('bl_about_025', 'Mission', $page_id) ); ?></h3>
          <p><?php echo esc_html( bl_copy('bl_about_026', 'To provide integrated 360 Marketing, Communication and Events solutions that meet your business requirements — under one strategic roof, end to end.', $page_id) ); ?></p><?php $values['bl_about_pillars'][] = array( 'icon' => bl_copy('bl_about_023', '→', $page_id), 'label' => bl_copy('bl_about_024', 'Our Path', $page_id), 'content' => trim( ob_get_clean() ) );
ob_start(); ?><h3><?php echo esc_html( bl_copy('bl_about_029', 'Values', $page_id) ); ?></h3>
          <p><?php echo esc_html( bl_copy('bl_about_030', 'ROI-driven, transparent, professional and authentic. Four principles that shape every campaign, every event, and every relationship we build.', $page_id) ); ?></p><?php $values['bl_about_pillars'][] = array( 'icon' => bl_copy('bl_about_027', '✦', $page_id), 'label' => bl_copy('bl_about_028', 'How We Work', $page_id), 'content' => trim( ob_get_clean() ) );
break;
case 'projects':
ob_start(); ?>    <h1><?php echo esc_html( bl_copy('bl_projects_002', 'Our projects.', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_projects_003', 'One creative engine.', $page_id) ); ?></strong></h1>
    <p><?php echo esc_html( bl_copy('bl_projects_004', 'Branding, events, campaigns and digital — for global enterprises, government bodies and ambitious regional brands across KSA and the wider MENA region.', $page_id) ); ?></p><?php $values['bl_projects_hero'] = trim( ob_get_clean() );
ob_start(); ?>  <h2><?php echo esc_html( bl_copy('bl_projects_013', 'Ready to build the next one?', $page_id) ); ?></h2>
  <p><?php echo esc_html( bl_copy('bl_projects_014', 'Marketing, communications, or a flagship event — tell us what you\'re planning and we\'ll get back within one business day.', $page_id) ); ?></p><?php $values['bl_projects_cta'] = trim( ob_get_clean() );
$values['bl_projects_button_1'] = array( 'url' => bl_url( bl_copy('bl_projects_015', 'contact.html', $page_id) ), 'title' => bl_copy('bl_projects_016', 'Start the conversation →', $page_id), 'target' => '' );
break;
case 'clients':
ob_start(); ?>    <h1><?php echo esc_html( bl_copy('bl_clients_002', 'Sixty brands.', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_clients_003', 'One creative partner.', $page_id) ); ?></strong></h1>
    <p><?php echo esc_html( bl_copy('bl_clients_004', 'From global enterprises to government bodies and ambitious regional brands — we\'ve partnered with the businesses shaping KSA and the wider MENA region.', $page_id) ); ?></p><?php $values['bl_clients_hero'] = trim( ob_get_clean() );
ob_start(); ?>  <h2><?php echo esc_html( bl_copy('bl_clients_134', 'Join the', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_clients_135', 'next chapter.', $page_id) ); ?></strong></h2>
  <p><?php echo esc_html( bl_copy('bl_clients_136', 'Marketing, communications, or your next flagship event — let\'s build something worth remembering.', $page_id) ); ?></p><?php $values['bl_clients_cta'] = trim( ob_get_clean() );
ob_start(); ?><blockquote class="reveal">
    <?php echo esc_html( bl_copy('bl_clients_131', 'Our clients are our greatest assets and the', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_clients_132', 'heartbeat of BottomLine.', $page_id) ); ?></strong>
  </blockquote>
  <cite class="reveal"><?php echo esc_html( bl_copy('bl_clients_133', 'The BottomLine Promise', $page_id) ); ?></cite><?php $values['bl_clients_quote'] = trim( ob_get_clean() );
$values['bl_clients_button_1'] = array( 'url' => bl_url( bl_copy('bl_clients_137', 'contact.html', $page_id) ), 'title' => bl_copy('bl_clients_138', 'Start a project →', $page_id), 'target' => '' );
break;
case 'contact':
ob_start(); ?>    <h1><?php echo esc_html( bl_copy('bl_contact_002', 'Tell us what you\'re', $page_id) ); ?> <strong><?php echo esc_html( bl_copy('bl_contact_003', 'building.', $page_id) ); ?></strong></h1>
    <p><?php echo esc_html( bl_copy('bl_contact_004', 'Marketing campaigns, brand identity, flagship events, or your next digital launch — share the brief and we\'ll come back within one business day.', $page_id) ); ?></p><?php $values['bl_contact_hero'] = trim( ob_get_clean() );
ob_start(); ?>        <h3 style="font-size:1.6rem;font-weight:700;color:var(--ink);margin-bottom:14px;letter-spacing:-.5px"><?php echo esc_html( bl_copy('bl_contact_038', 'Brief received.', $page_id) ); ?></h3>
        <p style="color:var(--muted);max-width:38ch;margin:0 auto 24px"><?php echo esc_html( bl_copy('bl_contact_039', 'Thank you. A member of our team will be in touch within one business day to walk through the next steps.', $page_id) ); ?></p><?php $values['bl_contact_receipt'] = trim( ob_get_clean() );
ob_start(); ?>          <p><?php echo esc_html( bl_copy('bl_contact_042', 'Currently accepting new briefs', $page_id) ); ?></p>
          <small><?php echo esc_html( bl_copy('bl_contact_043', 'Average response: one business day', $page_id) ); ?></small><?php $values['bl_contact_availability'] = trim( ob_get_clean() );
$values['bl_contact_button_1'] = array( 'url' => bl_url( bl_copy('bl_contact_040', 'index.html', $page_id) ), 'title' => bl_copy('bl_contact_041', 'Back to home', $page_id), 'target' => '' );
break;
}
return $values;
}

<?php defined( 'ABSPATH' ) || exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
<noscript><style>
.preloader{display:none!important}body.locked{overflow:auto!important}.reveal,.reveal-stagger>*,.load,.line-text{opacity:1!important;transform:none!important}
.project-panel{position:relative!important;transform:none!important;width:100%!important;max-width:none!important;height:auto!important;visibility:visible!important}.panel-close{display:none}.hero-text .line-text{animation:none!important}
.nav-links{display:flex!important;flex-wrap:wrap}.menu-btn{display:none!important}
</style></noscript>
</head>
<body <?php body_class( is_front_page() || 'home' === bl_page_kind() ? 'locked' : '' ); ?>>
<?php wp_body_open(); ?>
<?php $home_header = 'home' === bl_page_kind(); ?>
<nav id="nav">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
    <img class="brand-logo" src="<?php echo esc_url( bl_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
  </a>
  <?php
  $menu_location = $home_header ? 'primary-home' : 'primary-inner';
  if ( has_nav_menu( $menu_location ) ) {
      wp_nav_menu( array( 'theme_location' => $menu_location, 'container' => false, 'menu_class' => 'nav-links', 'depth' => 1 ) );
  } else {
      ?>
      <ul class="nav-links">
        <li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>">About</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>">Services</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#projects' ) ); ?>">Work</a></li>
        <?php if ( $home_header ) : ?><li><a href="<?php echo esc_url( home_url( '/#process' ) ); ?>">Process</a></li><?php endif; ?>
        <li><a href="<?php echo esc_url( home_url( '/#clients' ) ); ?>">Clients</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a></li>
      </ul>
      <?php
  }
  ?>
  <?php if ( $home_header ) : ?><div class="nav-actions"><?php endif; ?>
    <a href="<?php echo esc_url( 'contact' === bl_page_kind() ? '#form' : bl_url( 'contact.html' ) ); ?>" class="nav-cta"><?php echo 'contact' === bl_page_kind() ? 'Jump to form ↓' : 'Start a project →'; ?></a>
  <?php if ( $home_header ) : ?></div><?php endif; ?>
  <button class="menu-btn" aria-label="menu">☰</button>
</nav>

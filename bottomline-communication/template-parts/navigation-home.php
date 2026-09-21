<?php defined( 'ABSPATH' ) || exit; ?>
<nav id="nav">
  <a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_home_001', '#', 'option') ) ); ?>" class="logo">
    <img class="brand-logo" src="<?php echo esc_url( bl_url( bl_value('bl_global_nav_home_002', 'bottomline-logo-white.svg?v=2', 'option') ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_global_nav_home_003', 'BottomLine', 'option') ); ?>" />
  </a>
  <?php if ( has_nav_menu( 'primary-home' ) ) { wp_nav_menu( array( 'theme_location' => 'primary-home', 'container' => false, 'menu_class' => 'nav-links', 'depth' => 1 ) ); } else { ?><ul class="nav-links">
    <li><a href="#about"><?php echo esc_html( bl_value('bl_global_nav_home_004', 'About', 'option') ); ?></a></li>
    <li><a href="#services"><?php echo esc_html( bl_value('bl_global_nav_home_005', 'Services', 'option') ); ?></a></li>
    <li><a href="#projects"><?php echo esc_html( bl_value('bl_global_nav_home_006', 'Work', 'option') ); ?></a></li>
    <li><a href="#process"><?php echo esc_html( bl_value('bl_global_nav_home_007', 'Process', 'option') ); ?></a></li>
    <li><a href="#clients"><?php echo esc_html( bl_value('bl_global_nav_home_008', 'Clients', 'option') ); ?></a></li>
    <li><a href="#contact"><?php echo esc_html( bl_value('bl_global_nav_home_009', 'Contact', 'option') ); ?></a></li>
  </ul><?php } ?>
  <div class="nav-actions">
    <a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_home_010', 'contact.html', 'option') ) ); ?>" class="nav-cta"><?php echo esc_html( bl_value('bl_global_nav_home_011', 'Start a project →', 'option') ); ?></a>
  </div>
  <button class="menu-btn" aria-label="<?php echo esc_attr( bl_value('bl_global_nav_home_012', 'menu', 'option') ); ?>"><?php echo esc_html( bl_value('bl_global_nav_home_013', '☰', 'option') ); ?></button>
</nav>
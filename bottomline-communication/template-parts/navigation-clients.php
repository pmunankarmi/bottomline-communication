<?php defined( 'ABSPATH' ) || exit; ?>
<nav id="nav">
  <a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_clients_001', 'index.html', 'option') ) ); ?>" class="logo"><img class="brand-logo" src="<?php echo esc_url( bl_url( bl_value('bl_global_nav_clients_002', 'bottomline-logo-white.svg?v=2', 'option') ) ); ?>" alt="<?php echo esc_attr( bl_value('bl_global_nav_clients_003', 'BottomLine', 'option') ); ?>" /></a>
  <?php if ( has_nav_menu( 'primary-inner' ) ) { wp_nav_menu( array( 'theme_location' => 'primary-inner', 'container' => false, 'menu_class' => 'nav-links', 'depth' => 1 ) ); } else { ?><ul class="nav-links">
    <li><a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_clients_004', 'index.html#about', 'option') ) ); ?>"><?php echo esc_html( bl_value('bl_global_nav_clients_005', 'About', 'option') ); ?></a></li>
    <li><a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_clients_006', 'index.html#services', 'option') ) ); ?>"><?php echo esc_html( bl_value('bl_global_nav_clients_007', 'Services', 'option') ); ?></a></li>
    <li><a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_clients_008', 'index.html#projects', 'option') ) ); ?>"><?php echo esc_html( bl_value('bl_global_nav_clients_009', 'Work', 'option') ); ?></a></li>
    <li><a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_clients_010', 'index.html#clients', 'option') ) ); ?>" class="current"><?php echo esc_html( bl_value('bl_global_nav_clients_011', 'Clients', 'option') ); ?></a></li>
    <li><a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_clients_012', 'index.html#contact', 'option') ) ); ?>"><?php echo esc_html( bl_value('bl_global_nav_clients_013', 'Contact', 'option') ); ?></a></li>
  </ul><?php } ?>
  <a href="<?php echo esc_url( bl_url( bl_value('bl_global_nav_clients_014', 'contact.html', 'option') ) ); ?>" class="nav-cta"><?php echo esc_html( bl_value('bl_global_nav_clients_015', 'Start a project →', 'option') ); ?></a>
  <button class="menu-btn" aria-label="<?php echo esc_attr( bl_value('bl_global_nav_clients_016', 'menu', 'option') ); ?>"><?php echo esc_html( bl_value('bl_global_nav_clients_017', '☰', 'option') ); ?></button>
</nav>
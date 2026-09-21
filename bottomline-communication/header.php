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

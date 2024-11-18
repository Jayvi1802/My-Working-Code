<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" id="bootstarp-css" href="/wp-content/themes/sterility/css/bootstrap.min.css" type="text/css" media="all">
    
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<script src="/wp-content/themes/sterility/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="<?php echo esc_attr( get_option('favicon') ); ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo esc_attr( get_option('favicon') ); ?>" type="image/x-icon">
	<script src="https://use.fontawesome.com/c4f4a5d023.js"></script>
	<link rel="stylesheet" href="/wp-content/themes/sterility/owl-carousel/owl.theme.css">
	<link rel="stylesheet" href="/wp-content/themes/sterility/owl-carousel/owl.carousel.css">
	
	<?php if(get_option('google-analytics-code')){ 
		echo get_option('google-analytics-code');
	} ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
		<div class="top-bar layout-set">
        <div class="container"><div class="row"><div class="col-lg-12 col-sm-12 col-xs-12 col-md-12"></div></div></div>
        </div>

		<header id="masthead" class="site-header layout-set" role="banner">
        	<div id="push-this">
				<div class="site-header-main layout-set">
	<div class="container"><div class="row">
	<div class="col-lg-3 col-sm-3 col-xs-12 col-md-3"><img src="<?php echo esc_attr( get_option('home-logo') ); ?>" /></div>
	<div class="col-lg-9 col-sm-9 col-xs-12 col-md-9">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'twentysixteen' ); ?></button>
	
						<div id="site-header-menu" class="site-header-menu">
							<?php if ( has_nav_menu( 'primary' ) ) : ?>
								<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'twentysixteen' ); ?>">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'primary',
											'menu_class'     => 'primary-menu',
										 ) );
									?>
								</nav><!-- .main-navigation -->
							<?php endif; ?>
	
							
						</div><!-- .site-header-menu -->
					<?php endif; ?>
				   </div></div></div>
				</div><!-- .site-header-main -->

			</div>
			<div id="push" class="push"></div>
		</header><!-- .site-header -->
        <?php 
		if(is_front_page())
		{ ?>
			<div class="slider">
				<div id="home-slider">
					<div class="item">aa</div>
					<div class="item">aa</div>
				</div>
			</div>
		<?php }
		
		else
		{ ?>
			<div class="banner"></div>
		<?php }
		?>

		<div id="content" class="site-content layout-set">

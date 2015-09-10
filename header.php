<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package e4
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php 
	global $reading_setting;
	$reading_setting = 999;
	
	if(empty($_GET['mod'])){
		$mod = '';	
	} else {
		$mod = $_GET['mod'];
	}
	
	if (is_singular()){
		$mod .= ' one';
	}
	
	if (is_user_logged_in() ) {
		$mod .= ' e4-logged';
	} else {
		$mod .= ' e4-not-logged';
	}
	
	wp_head(); ?>
</head>
<body <?php body_class($mod); ?> data-context="<?php echo current_page_url(); ?>">
<div id="page" class="ani hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'e4' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
		
		
			<?php if ( get_theme_mod( 'e4_logo' ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="site-logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
 
					<img src="<?php echo get_theme_mod( 'e4_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
 
    	</a>
 
    <?php else : ?>
               
	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
               
<?php endif; ?>
			
			
		
		
		
		
			
			
		</div><!-- .site-branding -->
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div id="header-widgets">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
		<?php } ?>
	</header><!-- #masthead -->
<div class="loader">
	<i class="fa fa-circle-o-notch ani fa-spin"></i>
</div>
	<div id="content" class="site-content">

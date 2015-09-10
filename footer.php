<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package e4
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
			<a href="#">E4</a>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php if ( is_active_sidebar( 'sidebar-1' ) || has_nav_menu( 'primary' ) ) { ?>
			<span class="menu-toggle ani"><i class="fa fa-bars"></i></span>
			<div id="side" class="ani">
				<div id="side-in">
					<?php if ( has_nav_menu( 'primary' ) ) { ?>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav><!-- #site-navigation -->
					<?php } ?>
					<div id="sidebar">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</div>
				</div>
			</div>
		<?php } ?>
<div id="pageloader"></div>
<?php wp_footer(); ?>

</body>
</html>

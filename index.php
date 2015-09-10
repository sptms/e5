<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package e4
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main grid ani" role="main">

		<?php $i = 0;
		if ( have_posts() ) : while ( have_posts() && $i < $reading_setting ) : the_post();
			$i++;
			get_template_part( 'content', get_post_format() );
			
			endwhile;
		
		else :
		
			get_template_part( 'content', 'none' );
		
		endif; ?>

		</main><!-- #main -->
		<?php the_posts_navigation(); ?>

	</div><!-- #primary -->
<?php get_footer(); ?>

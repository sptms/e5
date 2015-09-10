<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy ////
 *
 * @package e4
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<header class="page-header">
				<?php
					
					
					
					if ( is_category() ) {
						$archive_title = single_cat_title( '', false );
					} elseif ( is_tag() ) {
						$archive_title = single_tag_title( '', false ) ;
					} elseif ( is_author() ) {
						$archive_title = get_the_author();
					} elseif ( is_year() ) {
						$archive_title = get_the_date('Y');
					} elseif ( is_month() ) {
						$archive_title = get_the_date('M');
					} elseif ( is_day() ) {
						$archive_title = get_the_date('D');
					} 
					
					echo '<h1 class="page-title">'.$archive_title.'</h1>';
				?>
			</header><!-- .page-header -->
		<main id="main" class="grid archive ani" role="main">

		<?php $i = 0;
		if ( have_posts() ) : while ( have_posts() && $i < $reading_setting ) : the_post();
			$i++;
			get_template_part( 'content', get_post_format() );
			
			endwhile;
		
		else :
		
			get_template_part( 'content', 'none' );
		
		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>

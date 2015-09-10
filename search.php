<?php
/**
 * The template for displaying search results pages.
 *
 * @package e4
 */

get_header(); ?>

	<section id="primary" class="content-area">
		
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'e4' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
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
	</section><!-- #primary -->

<?php get_footer(); ?>

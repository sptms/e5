<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package e4
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'e4' ); ?></h1>
					<a href="<?php bloginfo('url');?>">&larr; <?php bloginfo('name');?></a>
				</header><!-- .page-header -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>

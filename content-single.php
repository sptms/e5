<?php
/**
 * @package e4
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="close ani" data-url="<?php bloginfo('url');?>">close</div>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
		<div class="clear"></div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if (is_single()) {
			e4_entry_footer(); 
			$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

			if ( comments_open() ) {
				if ( $num_comments == 0 ) {
					$comments = __('No Comments');
				} elseif ( $num_comments > 1 ) {
					$comments = $num_comments . __('&nbsp; Comments');
				} else {
					$comments = __('1 Comment');
				}
				$write_comments = '<a class="comments-link" href="' . get_the_permalink() .'">'. $comments.'</a>';
			
				echo $write_comments;
			
			}
			
		} ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

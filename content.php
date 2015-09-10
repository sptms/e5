<?php
/**
 * @package e4!=!=!=!=
 */
?>

<?php 
	$format = get_post_format( $post->ID );
	
	if ( !has_post_thumbnail() ) { 
		$content_class = 'no-img';
	} else {
		$content_class = 'img';
		

		$post_id  = get_the_ID();
		$thumb_id = get_post_thumbnail_id( $post_id );
		$img_src  = wp_get_attachment_image_src( $thumb_id, 'e4-thumbs' );
			
		$tn_url = $img_src[0];
		$tn_width = $img_src[1];
		$tn_height = $img_src[2];
		
	} 
	?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ($format == 'image'){
	//////////////////////////////////////////////// IT'S AN IMAGE POST ?>
	
	<div class="pre">
		<?php // IF POST HA THUMB
		if ( has_post_thumbnail() ) { ?>
			<div class="entry-image">
				<a class="image-lightbox" title="<?php the_title();?>" href="<?php echo $tn_url;?>">
					<div class="entry-image-overlay ani"></div>
					<?php echo '<img id="cover-'.$post->ID.'" class="lazy cover" data-original="'.$tn_url.'"  width="'.$tn_width.'" height="'.$tn_height.'" src="'.get_bloginfo('template_url').'/img/fake.png" alt="'.get_the_title().'">';?>
				</a>
			</div>
		<?php } ?>
	</div>
	
	<?php if( $post->post_excerpt ) { ?>
			<div class="card-content <?php echo $content_class; ?>">
				<div class="entry-content"><?php echo $post->post_excerpt; ?></div>
			</div>
		<?php } ?>
	<?php } elseif ($format == 'quote'){ 
	//////////////////////////////////////////////// IT'S A QUOTE POST 
		
	$quote_content = wp_strip_all_tags( get_the_content(), false );?>
	
	<div class="pre">
		<div class="card-content">
			<?php echo '<quote>'.$quote_content.'</quote>';?>
		</div>
	</div>
	
	<?php } elseif ($format == 'aside'){
	//////////////////////////////////////////////// IT'S AN ASIDE POST ?>
	<div class="pre">
		<div class="card-content">
			<?php the_content();?>
			<div class="clear"></div>
		</div>	
	</div>
	
	<?php } else { 
	//////////////////////////////////////////////// IT'S A STANDARD POST ?>
	
	<div class="pre">
	<?php // IF POST HA THUMB
	if ( has_post_thumbnail() ) { ?>
		<div class="entry-image">
			<a class="trigger cover-trigger" title="<?php the_title();?>" href="<?php the_permalink();?>">
				<?php echo '<img id="cover-'.$post->ID.'" class="lazy cover" data-original="'.$tn_url.'"  width="'.$tn_width.'" height="'.$tn_height.'" src="'.get_bloginfo('template_url').'/img/fake.png" alt="'.get_the_title().'">';?>
				<div class="entry-image-overlay ani">
					<div class="entry-image-overlay-in ani">
						<h3><?php the_title();?></h3>
					
						<?php 
							$args = array(
								'orderby' => 'name',
								'order' => 'ASC'
							);
							$categories = wp_get_post_categories( $post_id, $args );
							foreach($categories as $c){
								$cat = get_category( $c );
								echo '<h4>'.$cat->name.'</h4>';
							}
							?>
					</div>
				</div>
			</a>
			
		</div>
	<?php } ?>
	
	
			<div class="card-content <?php echo $content_class; ?>">
				<?php if (!has_post_thumbnail() ){ ?>
					<h3><a href="<?php the_permalink();?>" class="trigger trigger-title"><?php the_title();?></a></h3>
				<?php } ?>
				<?php if( $post->post_excerpt ) { ?>
				<div class="entry-content"><?php echo $post->post_excerpt; ?></div>
				<?php } ?>
			</div>
		
	
	</div> <!-- .pre -->
	<?php } ?>
</article><!-- #post-## -->
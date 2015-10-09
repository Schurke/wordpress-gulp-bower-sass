<?php
	// get featured image
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
	$image = $thumb['0'];
	// check for acf field
	if ( get_field('header_image') ){
		$image = get_field('header_image')['sizes']['large'];
	}

	// if present, 
	if ($image){
		?>
			<div class="fluid-width-image header-image" style="background-image:url('<?php echo $image; ?>');">
				<div class="headline">
					<a href="<?php echo get_home_url(); ?>">
						<div class="logo">
							
						</div>
					</a>
					<div class="reservations">
						<div>For reservations call:</div>
						<div>647-496-8275</div>
					</div>
				</div>

				<div class="jumbo-text">
					<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				</div>

			</div>

		<?php
	}
	the_breadcrumb();
?>

<?php
	// get featured image
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
	$image = $thumb['0'];
	$style = "";
	// check for acf field
	if ( get_field('header_image') ){
		$image = get_field('header_image')['sizes']['large'];
	}

	// if present
	if ($image) $style = "background-image:url('".$image."');";
	
	?>
	<div class="fluid-width-image header-image" style="<?php echo $style; ?>">
		<div class="row">
			<div class="col-sm-3">
			<?php
				wp_nav_menu( array(
					'menu_id'			=> 'header_sub_nav',
					'menu'              => 'header',
					'theme_location'    => 'header',
					'depth'             => 4,
					'container'         => 'div',
					'container_class'   => 'header_sub_nav',
					'container_id'      => '',
					'menu_class'        => '',
					'walker'            => new sub_nav_walker())
				);
			?>
			</div>
		</div>

	</div>

	<?php
	// add breadcrumb
	the_breadcrumb();
?>

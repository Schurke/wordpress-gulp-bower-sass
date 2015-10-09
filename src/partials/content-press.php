<header class="entry-header">
<?php 
	// get template header
	get_template_part( 'partials/header', get_post_type() ); 
?>
</header>
<div class="entry-content">


	

	<div>
		<div class="container">
			<?php the_content(); ?>
		</div>
	</div>
	<section id="press">
		<div class="container">
			<h1>Press</h1>

			<!-- press units -->

			<?php

				$type = 'press_release';
				
				$args=array(
					'post_type' => $type,
					'post_status' => 'publish',
					'posts_per_page' => 10,
					'ignore_sticky_posts'=> 1,
					
				);
				$releases = null;
				$releases = new WP_Query($args);
				$posts = $releases->get_posts();
				// start new array
				$releaseOutput = array();
				// for each post, create asc array in expected format
				
				foreach ($posts as $rel) {
					// get image
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($rel->ID), 'thumbnail' );
					$image = $thumb['0'];
					$title = $rel->post_title;
					$link = get_permalink($rel->ID);
					$row = array(
						'image'=> $image,
						'title'=> $title,
						'body'=> '',
						'link'=> $link,
					);
					
					n_wp_content_unit("image_title_body", $row, 'press-item', 'rel="shadowbox"' );
					// create tile
				
				}
				
			?>
		</div>
	</section>
	<section id="awards">
		<div class="container">
			<h1>Awards</h1>
		</div>
			<!-- get general units -->
			<?php 
				$rows = get_field('general_units');
				// var_dump($rows);
				n_wp_output_content_units($rows);

			?>
			
	</section>
	<footer>
	<?php
		// show footer text if defined
		if ( get_field("footer_text") ){
			the_field("footer_text");
		}

	?>
	</footer>
</div>
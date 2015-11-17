<section id="home-jumbo-carousel">
	<div class="container">
	<!-- output carousel -->
	
	<?php 

		$rows = get_field('carousel');
		// output using inc/content/n_wp_bootstrap_acf_carousel
		n_wp_bootstrap_acf_carousel($rows, "home-carousel", "carousel-fade carousel-zoom");

	?>


	<?php 
		// output video	
		if (get_field('video_src_mp4')){
			$video_title = get_field('video_title');
			$video_src_mp4 = get_field('video_src_mp4')['url'];
			$video_src_ogv = get_field('video_src_ogv')['url'];
			$video_placeholder_image = get_field('video_placeholder_image')['sizes']['large'];
			// output from inc/content/n_wp_html5_video	
			n_wp_html5_video($video_src_mp4, $video_src_ogv, $video_placeholder_image, $video_title);
		}
		
	?>
	</div>
</section>


<section id="feature-blocks">
	<div class="container">
		<?php 
			// output the image title body units that fade in left/right
			
			if (get_field('blocks')){
				while( has_sub_field('blocks') ){ 
					$style = "";
					$link = get_sub_field('link');
					// bg color
					$background_color = get_sub_field('background_color');
					$style .= "background-color:".$background_color.'; ';
					// bg image
					$background_image = get_sub_field('background_image');
					// column setup
					$columns = get_sub_field('columns');
					if (!$columns) $columns = 1;
					$col = $columns*4;
					$read_more_link = "";
					?>

					<div class="col-sm-<?php echo $col; ?> feature-block" style="<?php echo $style ?>">


					<?php
					// if page is news, get and display latest news item (post)

					// if page is testimonials, get customer_testimonials (field) from page and display text from first in list

					// if page is employee stories, get employee_stories (field) from page and display text from first in list

					// if page is aything else, display title, excerpt

					// output learn more link

					?>

					</div>

					<?php

				}
			}
		?>
	</div>
</section>

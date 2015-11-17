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

<section>
	
</section>

<section id="home-jumbo-carousel">
	<!-- output carousel -->
	<div class="headline">
		<div class="logo">
			
		</div>
		<div class="reservations">
			<div>For reservations call:</div>
			<div>647-496-8275</div>
		</div>
	</div>
	<?php 
		$rows = get_field('carousel');
		n_wp_bootstrap_acf_carousel($rows, "home-carousel", "carousel-fade carousel-zoom");

	?>
</section>



<section id="home-video">
	<!-- output video -->
	<?php 
		
		$video_title = get_field('video_title');
		$video_src_mp4 = get_field('video_src_mp4')['url'];
		$video_src_ogv = get_field('video_src_ogv')['url'];
		$video_placeholder_image = get_field('video_placeholder_image')['sizes']['large'];
		
		n_wp_html5_video($video_src_mp4, $video_src_ogv, $video_placeholder_image, $video_title);
		
	?>
</section>

<section id="how-we-do-it">
	<div class="container">
		<!-- output image units -->
		<div class="home-section-title">
			<div class="image how-we-do-it"></div>
			<h2>How we do it</h2>
		</div>
		<div>
			<?php 
				// output the image title body units that fade in left/right
				$type = "image_title_body";
				$rows = get_field($type);
				$attrs = "data-wow-offset-percent=25";
				$class = 'wow';
				$i=0;
				foreach ($rows as $row) {
					$c = $class;
					if ($i%2 == 0) $c .= ' fadeInRight';
					else $c .= ' fadeInLeft';
					n_wp_content_unit($type, $row, $c, $attrs);
					$i++;
				}
				
			?>
		</div>
	</div>
</section>

<section id="special-events">
	<div class="carousel-wrapper">
		<div class="home-section-title">
			<div class="container">
				<div class="image special-events"></div>
				<h2>Special Events</h2>
				<p class="framing-copy">
					<?php
					// get content from special events page
					$post_id = 35;
					$queried_post = get_post($post_id);
					echo $queried_post->post_content;
					?>
				</p>
			</div>
		</div>
	
	<!-- output carousel special events -->
	<?php
		// get special events that start after today
		$type = 'special_event';
		$today = date('Ymd');
		$args=array(
			'post_type' => $type,
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'ignore_sticky_posts'=> 1,
			'meta_query'	=> array(
				array(
					'key'		=> 'date',
					'compare'	=> '>=',
					'value'		=> $today,
				)
			)
		);
		$events = null;
		$events = new WP_Query($args);
		$posts = $events->get_posts();
		// start new array
		$eventOutput = array();
		// for each post, create asc array in expected format
		if (count($posts)==0){
			$posts = array(
				(object)array(
					'ID' => -1,
					'post_title' => 'No upcoming events at this time',
					'excerpt' => 'Please check back again later for more events at George on Queen.',
					'link' => false
				)
			);
		}
		
		foreach ($posts as $evt) {
			// get image
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($evt->ID), 'large' );
			$url = $thumb['0'];
			
			// get excerpt
			setup_postdata( $evt );
			$excerpt = $evt->excerpt;
			if (get_the_excerpt()){
				$excerpt = get_the_excerpt();
			}
			$link = $evt->link;
			if (get_post_permalink( $evt->ID, false ) && $link !== false){
				$link = get_post_permalink( $evt->ID, false );
			}

			$eventOutput[]=array(
				'title' => $evt->post_title,
				'body' => $excerpt,
				'image' => $url,
				'read_more_label' => 'Learn More',
				'read_more_link' => $link,
			);
		}
		n_wp_bootstrap_acf_carousel($eventOutput, "event-carousel");

		
	?>
	</div>

</section>
<section id="about">
	<div class="container">
		<!-- output about -->
		<div class="home-section-title">
			<div class="image special-events"></div>
			<h2>About Us</h2>
		</div>
		<?php
		// get content from special events page
		$post_id = 7;
		$queried_post = get_post($post_id);
		
		?>
		<div id="about-home-content">
			<h4>
				<?php echo $queried_post->post_title; ?>
			</h4>
			<p>
				<?php echo $queried_post->post_content; ?>
			</p>
			<div>
				<a class="btn btn-primary" href="<?php echo get_post_permalink($post_id, false); ?>">Read More</a>
			</div>
		</div>
	</div>
</section>
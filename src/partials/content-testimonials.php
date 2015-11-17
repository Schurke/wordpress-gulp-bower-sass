
<div class="container">
	<header class="entry-header">
	<?php 
		// get template header
		get_template_part( 'partials/header', 'page'); 
	?>
	</header>
</div>


<?php if ( have_posts() ) {
	while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

			<div class="entry-content">
				<div class="container">

					<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<div>
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					</div>

					<?php
					if (get_field('testimonials_or_stories')){
						while( has_sub_field('testimonials_or_stories') ){ 
							
							$name = get_sub_field('name');
							$title = get_sub_field('title');
							$video_src_mp4 = get_sub_field('video_src_mp4')['url'];
							$video_src_ogv = get_sub_field('video_src_ogv')['url'];

							?>

							<div>
								<h4><?php echo $name; ?></h4>
								<!-- link video here -->
							</div>

							<?php
						}
					}
					?>
				</div>

			</div>
		
		</article>
	<?php endwhile;
} else { ?>
	
	<?php
		// output the not_found partial
		get_template_part( 'partials/partial', 'not-found' ); 	
	?>

<?php } ?>
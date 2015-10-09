<?php if ( have_posts() ) {
	while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">


		
			<header class="entry-header">
			<?php 

				// get template header
				get_template_part( 'partials/header', 'page'); 
			?>
			</header>
			<div class="entry-content">
				<div class="container">

					<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					
					<div>
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					</div>
				</div>

				<!-- get sub pages menu -->
				<?php 
					// get all parallax units
					$rows =  get_field('general_units');
					n_wp_output_content_units($rows);
				?>

				<div class="container">
					<!-- get sub pages menu -->
					<?php 
						$nav_fields = array('role');
						//get_template_part( 'partials/navigation', 'sub_pages' ); 
						include(locate_template('partials/navigation-sub-pages.php'));
					?>
				</div>

				<div class="container">
					<div class="footer-text">
					<!-- get footer text -->
					<?php 
						if ( get_field("footer_text") ){
							the_field("footer_text");
						}

					?>

					</div>
				</div>

				<footer>
					<div class="container">
						<?php
							// show footer text if defined
							if ( get_field("table") ){
								the_field("table");
							}

						?>
					</div>
				</footer>
			</div>
		
		

		</article>
	<?php endwhile;
} else { ?>
	
	<?php
		// output the not_found partial
		get_template_part( 'partials/partial', 'not-found' ); 	
	?>

<?php } ?>
<?php if ( have_posts() ) {
	while ( have_posts() ) : the_post(); ?>

	<header class="entry-header">
	<?php 
		// get template header
		get_template_part( 'partials/header', get_post_type() ); 

	?>
	
	<!-- downloadable menu if applicable -->
	<?php if ( get_field("downloadable_menu") ): ?>
		
		<div class="download-menu">
			<a href="<?php echo get_field("downloadable_menu")['url']; ?>">Download Menu</a>
		</div>
		
	<?php endif; ?>



	</header>
	<div class="entry-content">
		<div class="container">

			<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php  if($post->post_content != ""){ ?>
				<div class="menu-content-block">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>
			<?php } ?>
			
			
			<!-- enter food menu walker -->
			
			<?php

				get_template_part( 'partials/sub-content', 'menu-walker' ); 

			?>

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
		</div>
	</div>

	<?php endwhile;
} else { ?>
	
	<?php
		// output the not_found partial
		get_template_part( 'partials/partial', 'not-found' ); 	
	?>

<?php } ?>
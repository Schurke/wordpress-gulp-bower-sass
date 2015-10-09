<?php if ( have_posts() ) {
	while ( have_posts() ) : the_post(); ?>

	<header class="entry-header">
	<?php 
		// get template header
		get_template_part( 'partials/header', 'parallax' ); 
	?>
	</header>
	<div class="entry-content">
		<div class="container">

			
			
			<div class="the-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		</div>

		<!-- get parallax fields -->
		<?php 

			$rows = get_field('parallax_units');
			if (!$rows) $rows = get_field('general_units');
			n_wp_output_content_units($rows, 'parallax-page-unit', null, null, 'div.container');
			
		?>
			
		<div class="container">
			<!-- get sub pages menu -->
			<?php 
				get_template_part( 'partials/navigation', 'sub_pages' ); 
			?>
		</div>

		<div class="container">
			<!-- get sub pages menu -->
			<?php 
				if ( get_field("table") ){
					the_field("footer_text");
				}

			?>
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

	<?php endwhile;
} else { ?>
	
	<?php
		// output the not_found partial
		get_template_part( 'partials/partial', 'not_found' ); 	
	?>

<?php } ?>
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

					<div class="row">
						<div class="col-md-6">
							<!-- characteristics/applications/data col -->
							<?php
								// characteristics
								if (get_field('characteristics')){
									while( has_sub_field('characteristics') ){ 
										// characteristics
										$characteristic = get_sub_field('characteristic');
										?>

										<li><?php echo $characteristic; ?></li>

										<?php
									}
								}
							?>
							<?php
								// applications
								if (get_field('applications')){
									while( has_sub_field('applications') ){ 
										// characteristics
										$application = get_sub_field('application');

										?>

										<li><?php echo $application; ?></li>

										<?php
									}
								}
							?>
							<?php
								// data
								if (get_field('technical_data')){
									while( has_sub_field('technical_data') ){ 
										// characteristics
										$property = get_sub_field('property');
										$test_method = get_sub_field('test_method');
										$unit = get_sub_field('unit');
										$value = get_sub_field('value');

										?>

										<li><?php echo $property; ?></li>

										<?php
									}
								}
							?>
						</div>

						<div class="col-md-6">
							<!-- content col -->
							<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
							<div>
								<?php the_content(); ?>
								<?php wp_link_pages(); ?>
							</div>
						</div>

					</div>
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
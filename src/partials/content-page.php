<div class="container">
	<header class="entry-header">
		<?php 
			// get template header
			get_template_part( 'partials/header', 'page'); 
		?>
	</header>
</div>

<?php 
	// sidebar layout configuration
	$sidebar_id = 'sidebar-page';
	$active_sidebar = is_active_sidebar( $sidebar_id );
	// check layout
	$full_cols = 12;
	$content_cols = $full_cols;
	// conditions and configuration
	$hide_sidebar = get_field('hide_sidebar');
	if ($active_sidebar && !$hide_sidebar){
		$content_cols = 8;
	}

?>

<div class="container">
	<div class="row">
		<!-- start listed content -->
		<div class="content-col col-md-<?php echo $content_cols; ?>">

			<?php if ( have_posts() ) {
				while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
						
						<div class="entry-content">
							<!-- title -->
							<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
							<!-- content -->
							<div>
								<?php the_content(); ?>
								<?php wp_link_pages(); ?>
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



	</div>
	<!-- start sidebar -->
	<?php if ($active_sidebar){ ?>

		<div id="wrap-sidebar" class="wrap-sidebar col-md-<?php echo $full_cols-$content_cols; ?>">
			<!-- output sidebar -->
			<?php 
				if ( $active_sidebar ) {
					// output sidebar
					dynamic_sidebar( $sidebar_id  );
				}
			?>
			
		</div>

	<?php } ?>	
</div>
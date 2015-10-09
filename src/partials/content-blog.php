<?php

// declare headerPost for comparison
$headerPost = null;
// get content header from the base page
if ( 'page' == get_option('show_on_front') && get_option('page_for_posts') && (is_home() || is_archive() || is_single() ) ) : the_post();
	$page_for_posts_id = get_option('page_for_posts');
	global $post;
	$post = get_page($page_for_posts_id);
	setup_postdata($post);
	$headerPost = $post;
	$signature = get_field("signature");
	// get template header
	get_template_part( 'partials/header', 'page' ); 
?>


<?php
	// rewind posts just in case
	rewind_posts();
endif;
?>

<div class="container">
	<div class="row">

		<!-- start listed content -->
		<div class="content-col col-sm-8">
			<div class="entry-content">
			<!-- output header content -->
			<?php if ($headerPost && (is_home() || is_archive()) ){ ?>

				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				
				<h4>
					<?php 
					$archiveTitle = get_the_archive_title(); 
					echo $archiveTitle;
					?>
				</h4>

			<?php } ?>


			<?php if ( have_posts() ) {
				while ( have_posts() ) : the_post(); ?>
					<?php
					if ( is_home() || is_archive() ){
						$class = "article-preview";
					} else {
						$class = "article-full";
					}
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?> role="article">

						<header class="entry-header">
						<?php 
							// get template header
							get_template_part( 'partials/header', get_post_type() ); 
						?>
						</header>
						<div class="entry-content">
							<?php 
								// if this is a listing, show nothing, otherwise show title
								if ( is_home() || is_archive() ){

								} else {
									?>
									<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
									<?php
								}
							?> 

							
							
								<?php 
									// if this is a listing, show nothing, otherwise show image
									if ( is_home() || is_archive() ){
										if ( has_post_thumbnail()){
											?>
											<div class="content-image">
											<?php
												the_post_thumbnail( 'thumbnail' );
											?>
											</div>
											<?php
										}
									} else {
										if ( has_post_thumbnail()){
											?>
											<div class="content-image">
											<?php
											the_post_thumbnail( 'large' );
											?>
											</div>
											<?php
										}
									}
								?> 
							
							<div>
								<?php 
									// if this is a listing, show nothing, otherwise show title
									if ( is_home() || is_archive() ){
										?>
										<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
										<?php
									} 
								?> 
								<?php 
									// if this is a listing, show excerpt, otherwise show full content
									if ( is_home() || is_archive() ){
										the_excerpt();

									} else {
										the_content(); 
									}
								?>
							</div>
							<?php wp_link_pages(); ?>
							
							<?php if(isset($signature) && !is_home() && !is_archive() ){ ?>

								<div class="blog-signature">
									<?php echo $signature; ?>
								</div>

							<?php } ?>
						</div>
						<div class="clearfix"></div>
					</article>
				<?php endwhile;
			} else { ?>
				
				<?php
					// output the not_found partial
					get_template_part( 'partials/partial', 'not-found' ); 	
				?>

			<?php } ?>
				
				<div class="page-nav">
					<!-- ?php echo paginate_links(); ? -->
					<?php voidx_post_navigation(); ?>
				</div>
			</div>
		</div>
		
		<!-- start sidebar -->
		<div id="wrap-sidebar" class="wrap-sidebar col-sm-4">
			<?php get_sidebar('blog'); ?>
		</div>

	</div>

</div>
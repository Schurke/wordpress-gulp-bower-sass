<?php

// query sub pages
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );
$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : ?>
<div class="subpage-navigation">

	
	<?php
		$i=0;
	?>
    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
		<?php
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
			$url = $thumb['0'];

			if ($i%3==0 && $i!=0) echo '</div>';
			if ($i%3==0) echo '<div class="row">';
		?>
        <div id="parent-<?php the_ID(); ?>" class="parent-page col-xs-12 col-md-4">
			<a href="<?php the_permalink(); ?>" class="">
				<div class="image" style="background-image:url('<?php echo $url; ?>');" alt=""></div>
				<h3><?php the_title(); ?></h3>
				<?php
					// if we defined fields in $nav_fields, output
					if (isset($nav_fields)){
						foreach ($nav_fields as $nf) {
							the_field($nf);
						}
					} 
				?>
			</a>
		</div>
		<?php
			
			$i++;
		?>

    <?php endwhile; ?>
    </div>
  
    
</div>
<?php endif; wp_reset_query(); ?>


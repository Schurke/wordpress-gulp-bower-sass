<?php

/**
* Fluid width image with text over top
*/
function n_wp_content_image($row, $class='', $attrs=''){
	
	$image = $row['image'];
	if ($image && $image['sizes']) $image = $image['sizes']['large'];
	$title = $row['title'];
	// get toggle for parallax
	$parallax_effect = '';
	if (isset($row['parallax_effects'])){
		if ( $row['parallax_effects']==true ) $class.=' parallax-background';
	}

	?>
		<div class="fluid-width-image <?php echo $class; ?>" style="background-image:url('<?php echo $image; ?>');">
	<?php if ($title){ ?>
			<div class="text-container"><h1><?php echo $title; ?></h1></div>
	<?php } ?>
		</div>
	<?php

}

/**
* Title and body content
*/
function n_wp_content_text($row, $class = "container", $attrs=''){
	if ($class==null) $class="container";
	$title = $row['title'];
	$body = $row['body'];
	?>

	<div class="content-text <?php echo $class; ?>">
		<h2><?php echo $title; ?></h2>
		<p><?php echo $body; ?></p>
	</div>

	<?php
}

/**
* Image title body blocks
*/
function n_wp_content_image_title_body($row, $class="", $attrs=""){
	// echo "IMAGE_TITLE_BODY ".$attrs;
	// var_dump($row);
	if ($row){
		// var_dump($row);
		//$image = $row['image']['url'];
		$image = '';
		if ($row['image']){
			if ( is_array($row['image'])) $image = $row['image']['sizes']['medium'];
			else $image = $row['image'];
		}
		$title = $row['title'];
		$body = '';
		if (isset($row['body'])) $body = $row['body'];
		// link
		$link = '';
		if (isset($row['link'])) $link = $row['link'];
		?>
		

		<div class="image-title-body <?php echo $class; ?>" <?php echo $attrs; ?>>
			<?php if($link) : ?>
				<a href="<?php echo $link; ?>?template=stripped" <?php echo $attrs; ?> rel="shadowbox">
			<?php endif; ?>

			<div class="image-container" >
				<div class="image" style="background-image:url('<?php echo $image; ?>');"></div>
			</div>
			<div class="text-container">
				<h3><?php echo $title; ?></h3>
				<p><?php echo $body; ?></p>
			</div>

			<?php if($link) : ?>
				</a>
			<?php endif; ?>
			
		</div>

		<?php
	}
}



/**
* Nested units
*/
function n_wp_content_nested_units($row, $class="", $attrs=""){
	$count = count($row["nested_units"]);
	$colsize = round( 12/$count);
	$rowsize = $count;
	if ($rowsize>6) $rowsize=6;
	if ($colsize<2) $colsize=2;
	$i=0;

	?>
	<div class="container nested-units">
		
		<?php
			// var_dump($row["nested_units"]);
			foreach ($row["nested_units"] as $n_row) {

				if ($i%$rowsize==0 && $i!=0) echo '</div>';
				if ($i%$rowsize==0) echo '<div class="row">';

				$t = null;
				if ( isset($n_row['type']) ) $t=$n_row['type'];
				n_wp_content_unit($t, $n_row, 'col-sm-'.$colsize.' '.$class);
				

				if ($i==$count-1) echo '</div>';
				$i++;
			}

		?>
			
	</div>
	<?php
}


function n_wp_content_wrapper_start($wrapper){
	$wrap_arr = explode( '.', $wrapper, 2 );
	echo '<'.$wrap_arr[0].' class="'.str_replace('.', ' ', $wrap_arr[1]).'">';
}
function n_wp_content_wrapper_end($wrapper){
	$wrap_arr = explode( '.', $wrapper, 2 );
	echo '</'.$wrap_arr[0].'>';
}




?>
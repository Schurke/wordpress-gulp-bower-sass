<?php

/**
 * Package Name: n_wp_bootstrap_acf_carousel
 * Description: A custom carousel designed for ACF fields.
 * Version: 1.0
 * Author: Craig Harwood @Naberius
 */



function n_wp_bootstrap_acf_carousel($rows = null, $id = "myCarousel", $class = "", $add_active_class=false){
	if ($rows!=null){
		// set basic variables
		$count = count($rows);
		$counter = 0;
		$slides = '';
		$indicators = '';
		$class.=' slide';
		// start loop
		while($counter < $count){
			// get variables for each slide
			$row = $rows[$counter];
			$title = $row['title'];
			$body = $row['body'];
			$image = null;
			if (is_array($row['image'])){
				$image = $row['image']['url'];
			} else {
				$image = $row['image'];
			}
			
			$readMoreLabel = $row['read_more_label'];
			$readMoreLink = $row['read_more_link'];
			// set up class for first, active item
			$slideClass = "";
			$data_class = "";
			if ($add_active_class){
				if ($counter == 0) $slideClass = "active";
				else $slideClass = "";
			} else {
				if ($counter == 0) $data_class = "active";
				else $data_class = "";
			}
			
			$indicators .='<li data-target="#'.$id.'" data-class="'.$data_class.'" data-slide-to="'.$counter.'" class="'.$slideClass.'"></li>';
			// slides
			$slides .= '<div data-class="'.$data_class.'" class="item '.$slideClass.'">
			<div class="carousel-image" style="background-image:url('.$image.');" ></div>
			<div class="container"><div class="carousel-caption">';
			// only output body if present
			// only title body if present
			if ($title) $slides .= '<h1>'.$title.'</h1>';
			// only output body if present
			if ($body) $slides .= '<p>'.$body.'</p>';   
			
			// only output button if present
			if ($readMoreLabel && $readMoreLink){
				$slides .= '<p><a class="btn btn-primary" href="'.$readMoreLink.'" role="button">'.$readMoreLabel.'</a></p>';  
			}
			$slides .='</div></div></div>';
			$counter++;
		}
		// actual output
		?>
		
		<div id="<?php echo $id; ?>" class="carousel <?php echo $class; ?>" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php echo $indicators; ?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?php echo $slides; ?>  
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#<?php echo $id; ?>" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#<?php echo $id; ?>" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	
		<?php
		
	}


}


?>
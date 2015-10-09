

<?php

// check if the repeater field has rows of data

if( have_rows('categories') ):
	$leftCol = '';
	$rightCol = '';
	$html = '';
	// loop through the rows of data
	while ( have_rows('categories') ) : the_row();
		$html = '';
		$column = get_sub_field('column');
		

		// display name
		$html .= '<div class="category">';
		$html .= '<h2>'.get_sub_field('name').'</h2>';
		// items
		if( have_rows('items') ):

			// loop through rows (sub repeater)
			while( have_rows('items') ): the_row();
				
				$html .= george_food_menu_walker();

			endwhile;

		endif;

		if( have_rows('sub_categories') ):
			// loop through rows (sub repeater)
			while( have_rows('sub_categories') ): the_row();
				
				// display name
				$html .= '<div class="sub-category">';
				$html .= '<h3>'.get_sub_field('name').'</h3>';
				$html .= '<div class="item-container">';
				while( have_rows('items') ): the_row();
					
					$html .= george_food_menu_walker();

				endwhile;
				$html .= '</div>';
				$html .= '</div>';

			endwhile;

		endif;

		$html.="</div>";

		// fill columns
		if ($column=="right"){
			$rightCol.=$html;
		} else {
			$leftCol.=$html;
		}

		
		
	endwhile;
	?>
	<div class="the-menu">

	<div class="row food-and-drink-menu">
			<div class="col-sm-6">
			<?php echo $leftCol; ?>
		</div>
		<div class="col-sm-6">
			<?php echo $rightCol; ?>	
		</div>
	</div>

	</div>
	<?php



else :

	// no rows found

endif;


function george_food_menu_walker(){
	$html = '<div class="menu-item">';
	$html .= '<h4>';
	$html .= '<span>'.get_sub_field('name').'</span>';
	if (get_sub_field('price')){
		$html .= '<span class="divider"></span>';
		$html .= '<span>'.get_sub_field('price').'</span>';
	}
	$html .= '</h4>';
	$html .= '<p>'.get_sub_field('description').'</p>';
	$html .= '</div>';
	return $html;
}


?>


<?php

function the_breadcrumb($show_home = true) {

	global $post;
	$data = '';

	if(!is_front_page()) {

		$data .= '<ol class="breadcrumb">';
			
			// get home link
			if ($show_home){
				$data .= '<li>';
					$data .= '<a href="'. get_home_url() .'" title="">Home</a>';
				$data .= '</li>';
			}


			if(is_page() || is_single()) {
			
				global $post;
							
				$ancs = get_ancestors($post->ID, $post->post_type);
				
				if($ancs) {
					
					$ancs = array_reverse($ancs);
					
					foreach($ancs as $anc) {
						
						$data .= '<li>';
																
							$data .= '<a href="'.get_permalink($anc).'" title="">'.get_the_title($anc).'</a>';
						
						$data .= '</li>';
						
					}
					
				}
				
				$data .= '<li class="active">';
												
					$data .= get_the_title($post->ID);
				
				$data .= '</li>';
				
			} elseif(is_tax()) {
				
				$tax = get_queried_object();
											
				$ancs = get_ancestors($tax->term_id, $tax->taxonomy);
				
				if($ancs) {
					
					$ancs = array_reverse($ancs);
					
					foreach($ancs as $anc) {
						
						$data .= '<li>';
						
							$name = get_term_by('id', $anc, $tax->taxonomy);
																
							$data .= '<a href="'.get_term_link($anc, $tax->taxonomy).'" title="">'.$name->name.'</a>';
						
						$data .= '</li>';
						
					}
					
				}
				
				$data .= '<li class="active">';
																							
					$data .= $tax->name;
				
				$data .= '</li>';                       
				
			}
				
		$data .= '</ol>';

	}

	echo $data;

}

?>

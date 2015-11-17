<?php

add_filter('wp_nav_menu_items','n_wp_add_search_box_to_menu', 10, 2);

function n_wp_add_search_box_to_menu( $items, $args ) {
	$theme_options = get_option( "voidx_theme_options" );
	// if navigation search set in theme options, add it to header menus
	if (isset($theme_options['navigation_search']) && $theme_options['navigation_search']){
		if( $args->menu_id == 'header_nav' ){
			return $items.n_wp_display_search();
		}
	}
	return $items;

}


function n_wp_display_search($classes = ''){
	$output = '
	<li class="dropdown '.$classes.'">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Search <span class="caret"></span></a>
		<ul class="dropdown-menu dropdown-menu-right">';
			$output .= get_search_form(false);
			$output .= '
		</ul>
	</li>
	';
	// "<li class='menu-header-search'><form action='http://example.com/' id='searchform' method='get'><input type='text' name='s' id='s' placeholder='Search'></form></li>"
	return $output;
}


?>
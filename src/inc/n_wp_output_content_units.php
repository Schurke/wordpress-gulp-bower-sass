<?php

// parallax units
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/content/n_wp_content_unit.php' );
// video
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/content/n_wp_html5_video.php' );

/**
* build each row supplied based on type
*/
function n_wp_output_content_units($rows, $class=null, $type=null, $attrs="", $wrapper=null){
	if ($rows){
		foreach ($rows as $row) {
			//echo 'type: '.$type;
			$t=null;
			if(!$type) $t = $row['type'];
			else $t = $type;
			n_wp_content_unit($t, $row, $class, $attrs, $wrapper);
		}
	}
}
function n_wp_content_unit($type = "image", $row = null, $class = null, $attrs="", $wrapper=null){
	// echo 'type: '.$type.' '.$wrapper;
	if ($wrapper && $type!="image" && $type!="nested_units") n_wp_content_wrapper_start($wrapper);
	
	switch ($type) {
		case "image":
			n_wp_content_image($row, $class, $attrs);
		break;
		case "text":
    		n_wp_content_text($row, $class);
    	break;
    	case "image_title_body":
    		n_wp_content_image_title_body($row, $class, $attrs);
    	break;
    	case "nested_units":
    		n_wp_content_nested_units($row, $class);
    	break;
	}
	if ($wrapper && $type!="image" && $type!="nested_units") n_wp_content_wrapper_end($wrapper);
}


?>
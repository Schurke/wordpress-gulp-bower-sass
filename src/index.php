<?php 

$template = get_template_name();

// ooutput header
get_header(); 

// output container top
get_template_part( 'partials/wrapper', 'content-top' ); 

// get content
get_template_part( 'partials/content', $template ); 

// output container bottom
get_template_part( 'partials/wrapper', 'content-bottom' ); 	

// get footer
get_footer();

?>

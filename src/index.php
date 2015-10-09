<?php 

// TODO move this to utils
// get template
if (!$template) $template = get_page_template_slug();
// get only last part
if ($template && strpos($template,'/') !== false){
	$templateArr = explode('/', $template);
	$template = $templateArr[count($templateArr)-1];
	// strip off .php
	$templateArr = explode('.php', $template);
	$template = $templateArr[0];
}
if(isset($_GET["template"])){
	$template = $_GET["template"];
}
// if no template set
if (!$template || $template == 'index') $template = 'default';

// ooutput header
get_header(); 

if($template!="stripped"){
	//echo $template;
	

	// output container top
	get_template_part( 'partials/wrapper', 'content-top' ); 	

}

if($template!="stripped"){
	// get content
	get_template_part( 'partials/content', $template ); 
} else{
	get_template_part( 'partials/content', 'default' ); 
}

if($template!="stripped"){
	// output container bottom
	get_template_part( 'partials/wrapper', 'content-bottom' ); 	

	// get footer
	get_footer();
}

?>

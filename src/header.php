<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title( '-', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<?php
	$theme_options = get_option( "voidx_theme_options" );
	//var_dump($theme_options);
	$additional_classes = array();
	// see if we have a template override coming in
	if (isset($_GET["template"])) $additional_classes[] = $_GET["template"];
	// check for fixed navbar setting
	if (isset($theme_options['fixed_navbar']) && $theme_options['fixed_navbar'])  $additional_classes[] ='fixed-navbar';

?>
<body <?php body_class($additional_classes); ?>>
	<?php
		// include optional ribbon if option defined
		if (isset($theme_options['persistent_ribbon']) && $theme_options['persistent_ribbon']) get_template_part( 'partials/ribbon', 'default' ); 	
	?>
	<div id="page" class="hfeed site">
		<!-- navbar-fixed-top -->
		<nav class="navbar navbar-default navbar-inverse <?php if (isset($theme_options['fixed_navbar']) && $theme_options['fixed_navbar']) echo 'navbar-fixed-top'; ?>" role="navigation">
			
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<?php 
						if (isset($theme_options['navigation_search']) && $theme_options['navigation_search']){
							echo n_wp_display_search('mobile-search hidden-lg hidden-md'); 
						}
					?>

					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#voidx-header-nav">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo get_site_url(); ?>"><?php bloginfo('name'); ?></a>

					
				</div>

					<?php
						wp_nav_menu( array(
							'menu_id'			=> 'header_nav',
							'menu'              => 'header',
							'theme_location'    => 'header',
							'depth'             => 2,
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse',
							'container_id'      => 'voidx-header-nav',
							'menu_class'        => 'nav navbar-nav',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'            => new wp_bootstrap_navwalker())
						);
					?>
				
			</div>
			
		</nav>
		<div id="wrap-main" class="wrap-main">

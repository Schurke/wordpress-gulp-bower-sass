<?php // ==== FUNCTIONS ==== //

// Load the configuration file for this installation; all options are set here
if ( is_readable( trailingslashit( get_stylesheet_directory() ) . 'functions-config.php' ) ){
	require_once( trailingslashit( get_stylesheet_directory() ) . 'functions-config.php' );
}

// Load configuration defaults for this theme; anything not set in the custom configuration (above) will be set here
require_once( trailingslashit( get_stylesheet_directory() ) . 'functions-config-defaults.php' );

// An example of how to manage loading front-end assets (scripts, styles, and fonts)
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/assets.php' );

// Required to demonstrate WP AJAX Page Loader (as WordPress doesn't ship with simple post navigation functions)
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/navigation.php' );

// Only the bare minimum to get the theme up and running
function voidx_setup() {

	// Language loading
	load_theme_textdomain( 'voidx', trailingslashit( get_template_directory() ) . 'languages' );

	// HTML5 support; mainly here to get rid of some nasty default styling that WordPress used to inject
	add_theme_support( 'html5', array( 'search-form', 'gallery' ) );

	// $content_width limits the size of the largest image size available via the media uploader
	// It should be set once and left alone apart from that; don't do anything fancy with it; it is part of WordPress core
	global $content_width;
	if ( !isset( $content_width ) || !is_int( $content_width ) )
		$content_width = (int) 960;

	// Register header and footer menus
	register_nav_menu( 'header', __( 'Header menu', 'voidx' ) );
	// register_nav_menu( 'footer', __( 'Footer menu', 'voidx' ) );

}
add_action( 'after_setup_theme', 'voidx_setup', 11 );


// ----------------------------------------------------
// Original voidx code above, custom additions below
// ---------------------------------------------------- 


// ----------------------------------------------------
// Inclusions
// ---------------------------------------------------- 

// add our theme options
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/n_wp_theme_admin.php' );
// register bootstrap menu walker
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/nav/wp_bootstrap_navwalker.php' );
// register  menu walker
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/nav/wp_coopa_subnav_navwalker.php' );
// register menu walker
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/nav/wp_walker_subnav_menu.php' );
// register menu walker
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/nav/wp_child_siblings_navwalker.php' );

// add breadcrumbs
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/n_wp_bootstrap_breadcrumbs.php' );
// add nav search
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/n_wp_nav_search.php' );

// general content units
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/n_wp_output_content_units.php' );
// register carousel builder
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/content/n_wp_bootstrap_acf_carousel.php' );

// add our custom post types
require_once( trailingslashit( get_stylesheet_directory() ) . 'custom-post-types.php' );

// contact widget
require_once( trailingslashit( get_stylesheet_directory() ) . 'widgets/contact.php' );
// arbitrary content widget
require_once( trailingslashit( get_stylesheet_directory() ) . 'widgets/page-specific-content.php' );
// arbitrary content widget
require_once( trailingslashit( get_stylesheet_directory() ) . 'widgets/sub-nav.php' );


// ----------------------------------------------------
// RTL Specific inclusions
// ---------------------------------------------------- 




function enqueue_language_styles() {
	// if this is an rtl language, load the rtl sheet
	if ( apply_filters( 'wpml_is_rtl', NULL) ) {
		wp_enqueue_style( 'rtl-style', "//cdn.rawgit.com/morteza/bootstrap-rtl/master/dist/css/bootstrap-rtl.min.css", array(), null );
	} else {

	}
	// language specific
	if(ICL_LANGUAGE_CODE == 'ar'){
		// wp_enqueue_style( 'style-en', get_template_directory_uri() . "/css/style-ar.css", array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_language_styles' );




// ----------------------------------------------------
// Theme configuration/modifications
// ---------------------------------------------------- 

// allow post thumbnails
add_theme_support('post-thumbnails');

// Page Slug Body Class (so that pages have a class relevant to slug also)
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
		
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


// modify archive titles to remove the words "Archive" and "Month"
function modify_archive_title ( $title ) {
	if (is_month()){
		$title = str_replace('Month:', '', $title);
	}
	// remove archives
	if( $title=="Archives" ) {
			$title = "";
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'modify_archive_title');


// add read more to excerpts
function new_excerpt_more($more) {
	global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');



// ----------------------------------------------------
// Widget registrations
// ---------------------------------------------------- 

// Sidebar declarations
function voidx_widgets_init() {
	// pages sidebar
	register_sidebar( array(
		'name'          => __( 'Page sidebar', 'voidx' ),
		'id'            => 'sidebar-page',
		'description'   => __( 'Appears to the right side of most pages.', 'voidx' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	) );
	// posts sidebar
	register_sidebar( array(
		'name'          => __( 'Post sidebar', 'voidx' ),
		'id'            => 'sidebar-post',
		'description'   => __( 'Appears to the right side of most posts.', 'voidx' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
	) );
	// add three footer slots
	register_sidebar( array(
		 'name' => 'Footer Sidebar 1',
		 'id' => 'footer-sidebar-1',
		 'description' => 'Appears in the footer area',
		 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		 'after_widget' => '</aside>',
		 'before_title' => '<h3 class="widget-title">',
		 'after_title' => '</h3>',
	 ) );
	 register_sidebar( array(
		 'name' => 'Footer Sidebar 2',
		 'id' => 'footer-sidebar-2',
		 'description' => 'Appears in the footer area',
		 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		 'after_widget' => '</aside>',
		 'before_title' => '<h3 class="widget-title">',
		 'after_title' => '</h3>',
	 ) );
	 register_sidebar( array(
		 'name' => 'Footer Sidebar 3',
		 'id' => 'footer-sidebar-3',
		 'description' => 'Appears in the footer area',
		 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		 'after_widget' => '</aside>',
		 'before_title' => '<h3 class="widget-title">',
		 'after_title' => '</h3>',
	 ) );
	
	// register widgets
	register_widget( 'Contact_Widget' );
	register_widget( 'Page_Specific_Content_Widget' );
	register_widget( 'Sub_Nav_Widget' );
}
add_action( 'widgets_init', 'voidx_widgets_init' );




// -------------------------------------
// Patches for common plugins
// -------------------------------------


if (class_exists('BootstrapShortcodes')){
	// patch for bs shortcodes notification (which is crazy inadequate at current)
	function n_bs_tooltip( $params, $content=null ) {
		extract( shortcode_atts( array(
				'title' => '',
				'placement' => 'top',
				'trigger' => 'hover',
				'href' => "#"
		), $params ) );

		$placement = (in_array( $placement, array( 'top', 'right', 'bottom', 'left' ) ))? $placement: 'top';
		$title = str_replace ('(br)', '<br>', $title);

		$result = '<a href="#" data-toggle="tooltip" title="' . $title . '" data-placement="' . esc_attr( $placement ) . '" data-trigger="' . esc_attr( $trigger ) . '">' . esc_attr( $content ) . '</a>';
		return force_balance_tags( $result );
	}
	remove_shortcode( 'bs_tooltip' );
	add_shortcode( 'bs_tooltip', 'n_bs_tooltip');
}


// -------------------------------------
// Utils
// -------------------------------------

/**
 * Gets the template name
 */
function get_template_name(){
	global $template;
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
	// assign defaults
	if (!$template || $template == 'index') {
		// if it's a page with no template
		if (is_page()) $template = "page"; 
		else $template = 'default';
	}
	// return result
	return $template;
}


// -------------------------------------
// Misc
// -------------------------------------


// Chrome patch
function chrome_fix() {
	if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome' ) !== false )
		wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
}
add_action('admin_enqueue_scripts', 'chrome_fix');



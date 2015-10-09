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
  register_nav_menu( 'footer', __( 'Footer menu', 'voidx' ) );

}
add_action( 'after_setup_theme', 'voidx_setup', 11 );







// register bootstrap menu walker
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/wp_bootstrap_navwalker.php' );
// breadcrumbs
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/n_wp_bootstrap_breadcrumbs.php' );
// general content units
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/n_wp_output_content_units.php' );
// register carousel builder
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/content/n_wp_bootstrap_acf_carousel.php' );
// contact widget
require_once( trailingslashit( get_stylesheet_directory() ) . 'widgets/contact.php' );

// add our custom post types
require_once( trailingslashit( get_stylesheet_directory() ) . 'custom-post-types.php' );

// allow post thumbnails
add_theme_support('post-thumbnails');



// Sidebar declaration
function voidx_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Main sidebar', 'voidx' ),
    'id'            => 'sidebar-main',
    'description'   => __( 'Appears to the right side of most pages.', 'voidx' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ) );

  register_sidebar( array(
    'name'          => __( 'Blog sidebar', 'voidx' ),
    'id'            => 'sidebar-blog',
    'description'   => __( 'Appears to the right side of most blog posts.', 'voidx' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ) );

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
  
  register_widget( 'Contact_Widget' );
}
add_action( 'widgets_init', 'voidx_widgets_init' );


// modify archive titles

add_filter( 'get_the_archive_title', function ( $title ) {

    if (is_month()){
      $title = str_replace('Month:', '', $title);
    }
    // remove archives
    if( $title=="Archives" ) {
        $title = "";
    }


    return $title;

});


// add read more to excerpts
function new_excerpt_more($more) {
    global $post;
    return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


// patch for bs shortcodes notification
remove_shortcode( 'bs_tooltip' );
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
add_shortcode( 'bs_tooltip', 'n_bs_tooltip');


//Page Slug Body Class
function add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
    return $classes;
  }
}
add_filter( 'body_class', 'add_slug_body_class' );


// temp
add_action('admin_enqueue_scripts', 'chrome_fix');
function chrome_fix() {
  if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Chrome' ) !== false )
    wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
}
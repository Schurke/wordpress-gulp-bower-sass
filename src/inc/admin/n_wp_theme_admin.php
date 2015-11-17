<?php


class VoidxBS3Settings{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;
	
	private $page_name = "Theme Settings";
	private $page_id = "voidx_theme_settings";
	// configure option name and group
	private $option_name = "voidx_theme_options";
	private $option_group = '';

	/**
	 * Start up
	 */
	public function __construct(){
		$this->setup_props();
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}
	/**
	 * Setup
	 */
	private function setup_props(){
		// set name of group
		$this->option_group = $this->option_name."_group";
		// Set class property
		$this->options = get_option( $this->option_name );
	}

	/**
	 * Add options page to the settings page
	 */
	public function add_plugin_page(){
		// This page will be under "Settings"
		add_options_page(
			'Settings Admin', 
			$this->page_name, // name of page
			'manage_options', // render under settings
			$this->page_id, // url id
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Create the basic structure of the options page
	 */
	public function create_admin_page(){
		?>
		<div class="wrap">
			<h2><?php echo $this->page_name; ?></h2>           
			<form method="post" action="options.php">
			<?php
				// This prints out all hidden setting fields
				settings_fields( $this->option_group );   
				do_settings_sections( $this->page_id );
				submit_button(); 
			?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init(){   
		// setup the setting bundle
		register_setting(
			$this->option_group, // Option group
			$this->option_name, // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		$id = '';
		// start a section
		$section_id = "general_settings";
		add_settings_section(
			$section_id, // ID
			'General Settings', // Title
			array( $this, 'print_section_info' ), // Callback
			$this->page_id // Page
		);  
		/*
		// add a basic number field
		add_settings_field(
			'id_number', // ID
			'ID Number', // Title 
			array( $this, 'id_number_callback' ), // Callback
			$this->page_id, // Page
			$section_id // Section           
		);      
		// add a basic text field
		add_settings_field(
			'title', 
			'Title', 
			array( $this, 'title_callback' ), 
			$this->page_id, 
			$section_id
		);
		*/

		// footer text and notices
		$id = 'customer_contact';
		register_setting($this->option_group, $this->option_name.'_'.$id, array( $this, 'sanitize' ));
		add_settings_field(
			$id, 
			'Customer Service Contact', 
			array( $this, 'string_callback' ), 
			$this->page_id, 
			$section_id,
			array('id'=>$id) // id as parameter in callback
		);

		// footer text and notices
		$id = 'copyright';
		register_setting($this->option_group, $this->option_name.'_'.$id, array( $this, 'sanitize' ));
		add_settings_field(
			$id, 
			'Copyright', 
			array( $this, 'string_callback' ), 
			$this->page_id, 
			$section_id,
			array('id'=>$id) // id as parameter in callback
		);

		// corp email
		$id = 'corp_email';
		register_setting($this->option_group, $this->option_name.'_'.$id, array( $this, 'sanitize' ));
		add_settings_field(
			$id, 
			'Corporate Email Link', 
			array( $this, 'string_callback' ), 
			$this->page_id, 
			$section_id,
			array('id'=>$id) // id as parameter in callback
		);

		// corp email
		$id = 'corp_backend';
		register_setting($this->option_group, $this->option_name.'_'.$id, array( $this, 'sanitize' ));
		add_settings_field(
			$id, 
			'Corporate Backend Link', 
			array( $this, 'string_callback' ), 
			$this->page_id, 
			$section_id,
			array('id'=>$id) // id as parameter in callback
		);

		// boolean for fixed navbar
		$id = 'fixed_navbar';
		register_setting($this->option_group, $this->option_name.'_'.$id, array( $this, 'sanitize' ));
		add_settings_field(
			$id, 
			'Sticky Navbar', 
			array( $this, 'checkbox_callback' ), 
			$this->page_id, 
			$section_id,
			array('id'=>$id) // id as parameter in callback
		);
		// boolean ribbon
		$id = 'persistent_ribbon';
		register_setting($this->option_group, $this->option_name.'_'.$id, array( $this, 'sanitize' ));
		add_settings_field(
			$id, 
			'Persistent Header Ribbon', 
			array( $this, 'checkbox_callback' ), 
			$this->page_id, 
			$section_id,
			array('id'=>$id) // id as parameter in callback
		);

		// navigation search
		$id = 'navigation_search';
		register_setting($this->option_group, $this->option_name.'_'.$id, array( $this, 'sanitize' ));
		add_settings_field(
			$id, 
			'Search in header Navigation', 
			array( $this, 'checkbox_callback' ), 
			$this->page_id, 
			$section_id,
			array('id'=>$id) // id as parameter in callback
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ){
		// assume that we want everything by default
		$new_input = $input;
		// sanitize x
		if( isset( $input['id_number'] ) )
			$new_input['id_number'] = absint( $input['id_number'] );
		// sanitize y
		if( isset( $input['title'] ) )
			$new_input['title'] = sanitize_text_field( $input['title'] );
		// return inputs
		return $new_input;
	}

	/** 
	 * Print the Section text
	 */
	public function print_section_info()
	{
		print 'Enter your settings below:';
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function id_number_callback()
	{
		printf(
			'<input type="text" id="id_number" name="'.$this->option_name.'[id_number]" value="%s" />',
			isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function string_callback($args){
		$name = $args['id'];
		// $field_name = $this->option_name.'['.$name.']';
		$field_name = $this->option_name.'_'.$name;
		// $value = $this->options[$name];
		$value = get_option( $field_name );
		// output
		printf(
			'<input type="text" id="'.$name.'" name="'.$field_name.'" value="%s" />',
			isset( $value ) ? esc_attr( $value ) : ''
		);
	}


	/** 
	 * Get the settings option array and print one of its values as a checkbox
	 */
	public function checkbox_callback($args){
		$name = $args['id'];
		$field_name = $this->option_name.'['.$name.']';
		//$field_name = $this->option_name.'_'.$name;
		$value = 0;
		if (isset($this->options[$name]) ) $value=$this->options[$name];
		//$value = get_option( $field_name );
		// output
		echo '<input type="checkbox" id="'.$name.'" name="'.$field_name.'" value="1"' . checked( 1, $value, false ) . '/>';
	}
}

// if the user is an admin, instantiate options
if( is_admin() ) $voidx_bs3_settings_page = new VoidxBS3Settings();



?>
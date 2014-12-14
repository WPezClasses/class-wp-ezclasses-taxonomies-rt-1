<?php
/** 
 * Wordpress register_taxonomy() The ezWay.
 *
 * Truth be told, the primary benefit here is automating the labels. That said, having the minimal TODOs laid out for you helps too.   
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WPezClasses
 * @author Mark Simchock <mark.simchock@alchemyunited.com>
 * @since 0.5.1
 * @license TODO
 */
 
/**
 * == Change Log == 
 *
 * -- 0.5.0 - Mon 8 Dec 2014
 * ---- Pop the champagne!
 */
 
/**
 * == TODO == 
 *
 *
 */

// No WP? Die! Now!!
if (!defined('ABSPATH')) {
	header( 'HTTP/1.0 403 Forbidden' );
    die();
}

if ( ! class_exists('Class_WP_ezClasses_Taxonomies_RT_1') ) {
  class Class_WP_ezClasses_Taxonomies_RT_1 extends Class_WP_ezClasses_Master_Singleton{
  
    private $_version;
	private $_url;
	private	$_path;
	private $_path_parent;
	private $_basename;
	private $_file;
	
	protected $_str_taxonomy;
	protected $_arr_object_type;
	protected $_str_name;
	protected $_str_singular_name;
	protected $_str_menu_name;
	protected $_arr_args_all;
	
	protected $_str_action;
	protected $_int_priority;
  
    protected $_arr_init;
	
	
	/**
	 *
	 */
	public function __construct() {
	  parent::__construct();
	}
	
	
	/**
	 * Takes the various arrays of defaults and custom args, merges them, addresses capabilities, rolls it all together and then calls the method custom_post_type_register() 
	 * which contains the WP register_post_type() function.
	 */
	 public function ez__construct() {
	 
	   $this->_str_action = 'init';
	   $this->_int_priority = 10;
	 
	   $arr_tax_todo = $this->taxonomy_todo();
	   
	   // set the taxonomy 
	   $this->_str_taxonomy = $arr_tax_todo['taxonomy'];
	   
	   // set the object type (aka array of post types for this tax
	   $this->_arr_object_type = $arr_tax_todo['object_type'];
	   
	   // let do some labels magic
	   $this->_str_name = $arr_tax_todo['arguments']['labels']['name']; 
	   $this->_str_singular_name = $arr_tax_todo['arguments']['labels']['singular_name'];
	   $this->_str_menu_name = $arr_tax_todo['arguments']['labels']['menu_name'];
	   
	   // merge labels
	   $arr_labels = WPezHelpers::ez_array_merge( array($this->labels_defaults(), $arr_tax_todo['arguments']['labels']) );
	   
	   // merge arguments
	   $arr_arguments = WPezHelpers::ez_array_merge( array($this->arguments_defaults(), $arr_tax_todo['arguments']) );
	   
	   // labels within arguments, can't forget that can we?
	   $arr_arguments['labels'] = $arr_labels;
	   
	   // set the args
	   $this->_arr_args_all = $arr_arguments;
	   
	   // do it! do it now!! well, okay, on action init :)
	   add_action($this->_str_action, array($this, 'register_taxonomy_do'), $this->_int_priority);
	}
	
	/**
	 * This is where your magic happens. The idea here is to (re) define as little as possible. 
	 *
	 * It is recommended you use this  boilerplate: https://github.com/WPezClasses/class-wp-ezclasses-taxonomies-rt-1-boilerplate-1
	 *
	 * This method remains simply as an example. 
	 */
	protected function taxonomy_todo(){
	
	// $this->_str_action = 'init', 
	// $this->_int_priortiy = 10, 
	
	  /**  
	   * --
	   
	  $str_taxonomy = substr('TODO_' . __CLASS__, 0, 31);
	  
	  $arr_capabilities = $this->capabilities_defaults();
	
	  $arr_taxonomy_todo = array(
	  
	    'taxonomy'		=> $str_taxonomy,
		'object_type'	=> array(),							// TODO - aka array of post_type(s) to attach this to.
		'arguments'		=> array(
		  'hierarchical'	=> false,						// TODO. fyi: default is false
		  'query_var'		=> $str_taxonomy,				// default is the 'taxonomy', or if ya want, do your own here
		  'labels'			=> array(
		    'name'				=> 'TODO: name',			// name
		    'singular_name'		=> 'TODO: singular_name',	// labels: 'singular_name'
			'menu_name' 		=> 'TODO: name',			// labe
			),
		  'rewrite' => array(
		    'slug' => 'TODO-slug',
			),
		  'capabilities' => $arr_capabilities,
		  ),
	    );
	  
	  return $arr_taxonomy_todo;
	  
	  * --
	  */
	}
	
	/**
	 * FYI - you might also in some cases want / need to muck with this.
	 */
	protected function capabilities_defaults(){
	
	  $arr_cap_defaults = array(
	    'manage_terms',
		'edit_terms',
		'delete_terms',
		'assign_terms'
		);
	  
	  return $arr_cap_defaults;
	}	
		
		
	/**
	 * This is where the magic happens. Everything else is to simplify the lead up to this moment. If you see the end, then the means is easier to understand. 
	 */
	public function register_taxonomy_do(){
		
	  register_taxonomy( $this->_str_taxonomy,  $this->_arr_object_type, $this->_arr_args_all );
	}

	
	/**
	 * currently NA
	 */
	protected function setup(){
	
	  $this->_version = '0.5.0';
	  $this->_url = plugin_dir_url( __FILE__ );
	  $this->_path = plugin_dir_path( __FILE__ );
	  $this->_path_parent = dirname($this->_path);
	  $this->_basename = plugin_basename( __FILE__ );
	  $this->_file = __FILE__ ;
	}
	
	/**
	 * currently NA
	 */
	protected function init_defaults(){
	
	  $arr_defaults = array(
	  
	  	'active'			 					=> false,
		'active_true'							=> false,	// use the active true "filtering"
		'filters'								=> false, 	// currently NA
		'arr_arg_validation'					=> false, 	// currently NA
		);
	
	  return $arr_defaults;
	}
	
	/**
	 * The TODOs are taken care of by the class that extends this base class. They are noted here strictly for clarity. 
	 */
	public function labels_defaults ($str_lang = 'en'){
	
	  $str_name =  $this->_str_name;
	  $str_singular_name =  $this->_str_singular_name;
	  $str_menu_name =  $this->_str_menu_name;
	
	  $arr_labels = array(
	    'name' 							=> $str_name,
		'singular_name' 				=> $str_singular_name,
		'menu_name'						=> $str_menu_name,										
		'all_items' 					=> 'All ' . $str_name,
		'edit_item'						=> 'Edit ' . $str_singular_name,
		'view_item'						=> 'View ' . $str_singular_name,
		'update_item'					=> 'Update ' . $str_singular_name,
		'add_new_item' 					=> 'Add New ' . $str_singular_name,
		'new_item_name'					=> 'New ' . $str_singular_name . ' Name',
		'parent_item'					=> 'Parent ' . $str_singular_name,
		'parent_item_colon'				=> 'Parent ' . $str_singular_name . ':',
		'search_items' 					=> 'Search ' . $str_name,
		'popular_items' 				=> 'Popular ' . $str_name,
		'separate_items_with_commas'	=> 'Separate ' . $str_name . ' with commas',
		'add_or_remove_items'			=> 'Add or remove ' . $str_name,
		'choose_from_most_used'			=> 'Choose from the most used ' . $str_name,
		'not_found'						=> 'No ' . $str_name . ' found'
		);
		
	  return $arr_labels;
    }
	
	/**
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	public function arguments_defaults(){
		  
	  $arr_arguments = array(
	    // ** = Listed for completeness
		// ---------------------------------------------
		
		// 'labels'				=> '',					// NOTE: The class sorts this out **
		'public' 				=> true,				// default: true
		'show_ui'				=> true, 				// default: value of public
		'show_in_nav_menus'		=> true, 				// default: value of public
		'show_tagcloud'			=> true, 				// default: value of public
		'meta_box_cb'			=> NULL,
		'show_admin_column'		=> false,				// default: false
		'hierarchical'			=> false,			// NOTE: The class sorts this out **
		'update_count_callback' => '',
		'query_var'				=> 'TODO taxonomy',
		'rewrite'				=> true,
		'capabilities'			=> $this->capabilities_defaults(),
		'sort'					=> false,				// note: WP Codex is not clear on default value
		//'_builtin'				=> false,			// per the WP Codex, not for general use **
		);							
	  return $arr_arguments;
	}
	
  }
} 

/**
 * And this is how you instantiate: 
 *
 * $obj_instantiate = Class_WP_ezClasses_TODO-FOLDER_TODO-Product_#::ez_new();
 */
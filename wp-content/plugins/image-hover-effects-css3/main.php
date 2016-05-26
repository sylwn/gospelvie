<?php 
/**
* Main Class
*/
class NA_HOVER_EFFECTS
{
	
	function __construct()
	{
		add_action( 'init', array($this, 'na_register_hover_effect'));
		add_action( 'add_meta_boxes', array($this, 'image_hover_data_box' ));
		add_action( 'save_post', array($this, 'saving_image_hover_effect' ));
		add_action('admin_enqueue_scripts', array($this, 'na_admin_script'));
		add_shortcode('hover-effect', array($this, 'render_gallery_shortcode') );
		add_filter( 'manage_image_hover_effect_posts_columns', array($this, 'my_edit_image_hover_effect_columns') ) ;
		add_action( 'manage_posts_custom_column' , array($this, 'insert_col_heading'), 10, 2 );
	}

	function my_edit_image_hover_effect_columns($columns){
		$shortcode_arr = array('shortcode' => 'Shortcode');
		return array_merge($columns, $shortcode_arr);	
	}

	function insert_col_heading($column, $id){
		echo '[hover-effect id="'.$id.'"]';

	}

	function na_admin_script($check) {
		if ($check == 'post-new.php' || $check == 'post.php' || 'edit.php') {
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'na-admin-script', plugin_dir_url( __FILE__ ). '/lib/admin.js', array('jquery', 'wp-color-picker', 'jquery-ui-sortable', 'jquery-ui-accordion'));	
			wp_enqueue_style( 'na-admin-style', plugin_dir_url( __FILE__ ). '/css/jquery-ui.theme.min.css');	
		}
	}

	function na_register_hover_effect() {
	
		$custom_labels = array(
			'name'                => __( 'Image Hover Effects', 'image-hover-effect' ),
			'singular_name'       => __( 'Hover Effect', 'image-hover-effect' ),
			'add_new'             => _x( 'Add New Hover Effect', 'image-hover-effect', 'image-hover-effect' ),
			'add_new_item'        => __( 'Add New Hover Effect', 'image-hover-effect' ),
			'edit_item'           => __( 'Edit Hover Effect', 'image-hover-effect' ),
			'new_item'            => __( 'New Hover Effect', 'image-hover-effect' ),
			'view_item'           => __( 'View Hover Effect', 'image-hover-effect' ),
			'search_items'        => __( 'Search Hover Effects', 'image-hover-effect' ),
			'not_found'           => __( 'No Hover Effects found', 'image-hover-effect' ),
			'not_found_in_trash'  => __( 'No Hover Effects found in Trash', 'image-hover-effect' ),
			'parent_item_colon'   => __( 'Parent Hover Effect:', 'image-hover-effect' ),
			'menu_name'           => __( 'Hover Effects', 'image-hover-effect' ),
		);
	
		$effect_args = array(
			'labels'                   => $custom_labels,
			'hierarchical'        => false,
			'description'         => 'Image Hover Effects',
			'taxonomies'          => array(),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-format-gallery',
			'show_in_nav_menus'   => false,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
			'title'
			)
		);
	
		register_post_type( 'image_hover_effect', $effect_args );
	}

	function render_gallery_shortcode($atts) {	
		wp_enqueue_style( 'na-bootstrap-style', plugin_dir_url( __FILE__ ). 'css/simplegrid.css');	
		wp_enqueue_style( 'na-hover-style', plugin_dir_url( __FILE__ ). 'css/ihover.css');	
		wp_enqueue_script( 'na-gallery-script', plugin_dir_url( __FILE__ ). 'js/script.js', array('jquery'));
		ob_start();
		include 'render_shortcode.php';
		return ob_get_clean();
	}

	function image_hover_data_box() {
	    add_meta_box('na_hover_options', 'Settings', array($this, 'render_metabox'), 'image_hover_effect');
	    add_meta_box('na_hover_shortcode', 'Shortcode', array($this, 'render_metabox_shortcode_display'), 'image_hover_effect', 'side');
	    add_meta_box('na_hover_colorpicker', 'Color Picker', array($this, 'render_metabox_colorpicker_display'), 'image_hover_effect', 'side');
	}
	// for shortcode
	function render_metabox_shortcode_display() {
		global $post;
		if (isset($post->ID)) {
			echo '[hover-effect id="'.$post->ID.'"]';
			echo '<br><br>Some effects may not work properly based on your theme.';
			echo '<br><br><a class="page-title-action" target="_blank" href="https://wordpress.org/support/view/plugin-reviews/image-hover-effects-css3">Rate & Suggestion ★★★★★</a>';
		}
	}

	function render_metabox_colorpicker_display(){
		echo '<input type="text" class="colorpicker">';
	}

	function render_metabox() {
		// Use nonce for verification
	    wp_nonce_field( plugin_basename( __FILE__ ), 'ihe_nonce' );
	    include 'render_metabox.php';
	}
	function saving_image_hover_effect( $post_id ) {
	    // verify if this is an auto save routine. 
	    // If it is our form has not been submitted, so we dont want to do anything
	    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	        return;

	    // verify this came from the our screen and with proper authorization,
	    // because save_post can be triggered at other times
	    if ( !isset( $_POST['ihe_nonce'] ) )
	        return;

	    if ( !wp_verify_nonce( $_POST['ihe_nonce'], plugin_basename( __FILE__ ) ) )
	        return;

	    // OK, we're authenticated: we need to find and save the data

	    $saved_options = $_POST['wcpop'];

	    update_post_meta($post_id,'wcpop',$saved_options);
	}				

	}

$na_object = new NA_HOVER_EFFECTS;
 ?>
<?php
/**
 * @author Carlos Matheu
 * class WpToFb
 *
 * Adds basic functionality to the plugin
 *
 */
class WpToFb{

	/**
	 * @var string
	 */
	const PLUGIN_NAME = 'WpToFacebook';

	/**
	 * @var string
	 */
	const MIN_PHP_VERSION = '5.2';

	/**
	 * @var string
	 */
	const MIN_MYSQL_VERSION = '5.0';

	/**
	 * @var string
	 */
	const MIN_WP_VERSION = '3.1';

	/**
	 * @var string
	 */
	const TABLE_VERSION = '1.2';
	
	/**
	 * Construct function
	 */
	public function __construct() {
		
		add_action( 'init', array( &$this, 'wptofb_init' ) );
		add_action( 'admin_menu', array( &$this, 'wptofb_add_menu_item' ) );
		if( version_compare( $wp_version, '3.3', '<' ) ){
			add_action( 'admin_init', array( &$this, 'wptofb_editor_admin_init' ) );
			add_filter( 'admin_head', array( &$this, 'wptofb_editor_admin_head' ) );
		}
		add_action( 'template_redirect', array( &$this, 'wptofb_template_redirect' ) );
		add_action('plugins_loaded', array( &$this, 'wptofb_upgrade' ) );

	}
	
	/**
	 * Basic system tests
	 */
	public function wptofb_tests(){
		PluginTest::test_min_php_version( self::MIN_PHP_VERSION, self::PLUGIN_NAME );
		PluginTest::test_min_mysql_version( self::MIN_MYSQL_VERSION, self::PLUGIN_NAME );
		PluginTest::test_min_wp_version( self::MIN_WP_VERSION, self::PLUGIN_NAME );

	}

	public function wptofb_init(){

		if( is_admin() ){
			
			load_plugin_textdomain( 'wptofacebook', '', 'wptofacebook/lang' );

			$script_src = plugins_url( 'js/wptofacebook.js', dirname( __FILE__ ) );
			wp_register_script( 'wptofb-script', $script_src );
			
			$script2_src = plugins_url( 'js/wptofacebook-help.js', dirname( __FILE__ ) );
			wp_register_script( 'wptofbhelp-script', $script2_src );
			
			wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css' );
			
			$src = plugins_url( 'css/wptofacebook.css', dirname( __FILE__ ) );
			wp_register_style( 'wptofb-css', $src );
			wp_enqueue_style( 'wptofb-css' );

		}
		
	}

	/**
	 * @return unknown_type
	 */
	public static function wptofb_activate(){

		//create table wptofb
		global $wpdb;

		$table_name = $wpdb->prefix . "wptofb";
		
			$sql = "CREATE TABLE " . $table_name . " (
						id int(15) NOT NULL AUTO_INCREMENT,
						title varchar(255) NOT NULL DEFAULT '',
						introtext mediumtext,
					  	outrotext mediumtext,
				  		hide_for_nofans smallint(6) NOT NULL DEFAULT '1',
				  		nofans mediumtext,
				  		active smallint(6) NOT NULL DEFAULT '1',
				  		created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  		created_by int(11) unsigned NOT NULL DEFAULT '0',
				  		contents text NOT NULL,
				  		tpl varchar(255) NOT NULL DEFAULT '',
				  		fb_app_id varchar(255) NOT NULL DEFAULT '',
				  		fb_app_secret varchar(255) NOT NULL DEFAULT '',
				  		featuredimg varchar(255) NOT NULL DEFAULT '',
				  		style mediumtext,
					  	UNIQUE KEY id (id)
					);";			

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		
		//add options for the plugin on register
		$wptofbOptions = get_option( 'wptofb_options_plastikaweb' );
		
		if( !isset( $wptofbOptions ) ){
			add_option( 'wptofb_options_plastikaweb', self::TABLE_VERSION );		
		}else if( $wptofbOptions != self::TABLE_VERSION ){
			update_option( 'wptofb_options_plastikaweb', self::TABLE_VERSION );
		}

	}

	
	public function wptofb_upgrade() {
    			
    	$wptofbOptions = get_option( 'wptofb_options_plastikaweb' );
    	
	    if ( $wptofbOptions != self::TABLE_VERSION ) {
	        self::wptofb_activate();
	    }
	}

	public function wptofb_editor_admin_init() {

		add_filter( "mce_buttons", "WpToFb::base_extended_editor_mce_buttons", 10 );
		add_filter( "mce_buttons_2", "WpToFb::base_extended_editor_mce_buttons_2", 20 );
		if( function_exists( 'wp_tiny_mce_preload_dialogs' ) ){
			add_action( 'admin_print_footer_scripts', 'wp_tiny_mce_preload_dialogs', 30 );
		}

	}

	static function base_extended_editor_mce_buttons($buttons) {
		// The settings are returned in this array. Customize to suite your needs.
		return array(
			'formatselect', 'bold', 'italic', 'bullist', 'numlist', 'link', 'unlink', 'blockquote', 'outdent', 'indent', 'charmap', 'removeformat', 'underline', 'justifyfull', 'forecolor', 'separator', 'pastetext', 'pasteword', 'separator', 'media', 'undo', 'redo'
			);
	}

	static function base_extended_editor_mce_buttons_2($buttons) {
		return array();
	}

	public function wptofb_editor_admin_head() {
			
		wp_tiny_mce(false, array(
			"editor_selector" => "wptofb_editor_class",
			"convert_urls" => false
		) );

	}

	/**
	 * Controller that generates admin page
	 */
	public function wptofb_generate_admin_page(){
		include( 'list_page.php' );
	}
	
	public function wptofb_help_page() {
		include ( 'help_page.php' );
	}
	/**
	 * Controller that generates new wptofb page
	 */
	public function wptofb_generate_new_page(){
		include( 'edit_page.php' );
	}

	/**
	 * Adds a menu item inside the WordPress admin
	 */
	public function wptofb_add_menu_item(){
		add_menu_page(
		'WpToFacebook Plugin', 
		'WpToFacebook', 
		'manage_options', 
		'wptofb' ,
		 array( &$this, 'wptofb_generate_admin_page' ),
		plugins_url( 'images/pw.png', dirname( __FILE__ ) )
		);

		$subpage_new = add_submenu_page(
		'wptofb',									//Menu page to attach to
		'New WpToFacebook Connection',		//page title
		__( 'New Connection', 'wptofacebook' ),			//menu title
		'manage_options',							//permissions
		'edit-wptofb',								//page-name used in the url
		array( &$this, 'wptofb_generate_new_page' )			//callback function	
		);
		
		add_action( 'admin_print_styles-' . $subpage_new, array( &$this, 'my_newpage_styles_scripts' ) );
		 
		$subpage_help = add_submenu_page( 
		'wptofb', 
		'WptoFacebook Help', 
		__( 'Help', 'wptofacebook' ),
		 'manage_options',
		 'help-wptofb',
		  array( &$this, 'wptofb_help_page' )
		 );
		 
		 add_action( 'admin_print_styles-' . $subpage_help, array( &$this, 'my_helppage_styles_scripts' ) );

	}
	
	public function my_newpage_styles_scripts() {
		wp_enqueue_script( array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-tabs', 'wptofb-script' ) );
	}
	
	public function my_helppage_styles_scripts() {
		wp_enqueue_script( array( 'jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'wptofbhelp-script' ) );
	}
	
	protected function wptofb_select_all(){
		global $wpdb;

		$table_name = $wpdb->prefix . "wptofb";
		$query = "SELECT id,title,created,created_by,tpl FROM " . $table_name . " ORDER BY created DESC";

		$records = $wpdb->get_results( $query );
		$wpdb->flush();
		return $records;
	}

	protected function wptofb_select_taxonomy( $types ){
		global $wpdb;
		
		$query = "SELECT DISTINCT wt.name, wt.term_id, wp.post_type, wtt.taxonomy FROM $wpdb->terms wt
					LEFT JOIN $wpdb->term_taxonomy wtt ON wt.term_id  = wtt.term_id
					LEFT JOIN $wpdb->term_relationships wtr ON wtt.
					term_taxonomy_id = wtr.term_taxonomy_id
					LEFT JOIN $wpdb->posts wp ON wtr.object_id = wp.ID 
					WHERE ( wtt.taxonomy <> 'link_category' AND wtt.taxonomy <> 'nav_menu' )";


		if($types && count( $types ) > 0 ){

			$subs_ar = array();

			foreach ($types  as $name => $value ) {
				$subs_ar[] = "wp.post_type = '$name'";
			}

			$subquery = ' AND ( ' . implode( " OR ", $subs_ar ) . ' )';
		}

		$query .= $subquery;

		$results = $wpdb->get_results( $wpdb->prepare( $query, $args=NULL ) );

		return  $results ;

	}

	protected function wptofb_delete( $id ){
		global $wpdb;

		$table_name = $wpdb->prefix . "wptofb";
		$wpdb->query( "DELETE FROM $table_name WHERE id = '$id'" );
		$wpdb->flush();
	}
	
	protected function wptofb_select_record( $id ){
		//select del registre
		global $wpdb;

		$table_name = $wpdb->prefix . "wptofb";

		$query = "SELECT id, title, introtext, outrotext, hide_for_nofans, nofans, contents, tpl, fb_app_id, fb_app_secret, featuredimg, style FROM " . $table_name . " WHERE id = %d";
		$safe_query = $wpdb->prepare( $query, $id );
		$data = $wpdb->get_row( $safe_query );


		return $data;
	}

	protected function wptofb_insert( $post ){

		global $current_user;
		global $wpdb;

		$table_name = $wpdb->prefix . "wptofb";

		$post_data = $this->_wptofb_format_post_data( $post );
		$post_data[ 'created_by' ] = get_current_user_id();

		$inserted = $wpdb->insert($table_name, $post_data, array( '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d' ) );

		$wpdb->flush();

		if( $inserted ){
			$return[ 'exit' ] = 1;
			$return[ 'message' ] = '<div class="updated"><p><strong>Settings saved.</strong></p></div>';
			$return[ 'new_id' ] = $wpdb->insert_id;

		}else{
			$return[ 'exit' ] = 0;
			$return[ 'message '] = '<div class="error"><p><strong>There was a database problem inserting this entry.</strong></p></div>';
		}

		return $return;
	}

	protected function wptofb_update( $post ){

		global $wpdb;

		$table_name = $wpdb->prefix . "wptofb";

		$post_data = self::_wptofb_format_post_data( $post );


		$updated = $wpdb->update( $table_name, $post_data , array( 'id' => $post[ 'wptofb_id' ] ), array( '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ), array( '%d' ));
		//$wpdb->print_error("Error ");
		$wpdb->flush();

		if( $updated ){
			$str = '<div class="updated"><p><strong>Settings saved.</strong></p></div>';

		}else{
			$str = '<div class="updated"><p><strong>No changes.</strong></p></div>';
		}
			
		return $str;
	}

	private function in_array_multi( $needle, $haystack ) {
		if (!is_array($haystack)) return false;

		while (list($key, $value) = each($haystack)) {
			if (is_array($value) && self::in_array_multi($needle, $value) || $value === $needle && $key == 'terms' ) {
					
				return true;			

			}
		}
		return false;
	}

	private function _wptofb_format_post_data( $post ){

		$post_types_ar = array();
		$contents_ar = array();
		$post_taxonomy_ar = array( 'relation' => 'OR' );

		//$wpdb->show_errors();

		foreach( $post as $name => $value){

			$name = substr( $name, strpos( $name, '_' ) + 1 );
			$value = trim( $value );

			if( strpos( $name, 'types_of_content' ) !== false && strpos( $name, $post[ 'wptofb_custom' ] ) !== false ){
				$post_types_ar[] = $value;

			}else if( strpos( $name, 'taxonomy' ) !== false ){

				$ini = strpos( $name,'_',7 ) + 1;
				$last = strrpos( $name,'_' );
				$taxonomy = substr( $name, $ini, $last - $ini );
					
				$post_taxonomy_ar[] = array( 'taxonomy' => $taxonomy, 'field' => 'id', 'terms' => $value );

			}else if( $name == 'custom' || $name == 'max_posts' || $name == 'order_by' || $name == 'order' ){

				$contents_ar[ $name ] = $value;

			}else if( $name == 'ids_conns' ){

				if( $post[ 'wptofb_custom' ] == 'manual' && $value != '' ){

					$contents_ar[ $name ] = explode(",", $value );


				}else{
					$contents_ar[ $name ] = array();
				}

			}else if( $name == 'title' || $name == 'fb_app_id' || $name == 'fb_app_secret' ){

				$post_data[ $name ] = trim( strip_tags( $value ) );

			}else if( $name == 'introtext' || $name == 'outrotext' || $name == 'hide_for_nofans' || $name == 'nofans' || $name == 'tpl' || $name == 'featuredimg' || $name == 'style' ){
					
				$post_data[ $name ] = stripslashes( $value );

			}

		}
		$contents_ar[ 'types_of_content' ] = $post_types_ar;
		$contents_ar[ 'taxonomy_ids' ] = $post_taxonomy_ar;

		$post_data[ 'contents' ] = serialize( $contents_ar );

		return $post_data;
	}


	protected function wptofb_get_available_post_types(){
		$args=array( 'public'   => true );
		$post_types=get_post_types( $args );

		//delete attachment
		if( $post_types[ 'attachment' ] ):
		unset( $post_types[ 'attachment' ] );
		endif;

		return $post_types;
	}

	protected function wptofb_get_available_posts( $types ){

		foreach ($types  as $name => $value ) {

			$post_types_shown[] = $name;
		}

		$args = array(
				'numberposts' => -1,
				'post_type' =>  $post_types_shown
		);

		$posts =  get_posts( $args );
		return $posts;
	}

	protected function wptofb_get_single_post_data( $id ){
		global $wpdb;

		$sql = "SELECT ID, post_title, post_type FROM $wpdb->posts WHERE ID = %d AND post_status = 'publish'";

		$safesql = $wpdb->prepare( $sql, $id );
		$selected_post = $wpdb->get_row( $safesql );
		return $selected_post;
	}

	protected function wptofb_get_maxposts_options(){
		$ar = array( __( 'all', 'wptofacebook' ) =>-1, '1'=>1, '2'=>2, '3'=>3, '4'=>4, '5'=>5, '6'=>6, '7'=>7, '8'=>8, '9'=>9, '10'=>10, '15'=>15, '20'=>20, '25'=>25 );
		return $ar;
	}

	protected function wptofb_get_orderby_options(){
		$ar = array( __( 'date', 'wptofacebook' )=>'date', __( 'title', 'wptofacebook' )=>'title', __( 'random', 'wptofacebook' )=>'rand' );
		return $ar;
	}

	protected function wptofb_get_imgs_sizes(){
		$ar = array( __( 'no image', 'wptofacebook' )=>'', __( 'thumbnail', 'wptofacebook' )=>'thumbnail', __( 'medium', 'wptofacebook' )=>'medium', __( 'large', 'wptofacebook' )=>'large' );
		return $ar;
	}

	protected function wptofb_get_templates() {

		$tmpl_ar = array();

		$directories = scandir( WP_PLUGIN_DIR . "/wptofacebook/tpls/" );

		foreach( $directories as $dir ){
			if( is_dir( WP_PLUGIN_DIR . "/wptofacebook/tpls/" . $dir ) && ( !in_array( $dir, array( '.','..' ) ) ) ) {
				$tmpl_ar[] = $dir;
			}
		}

		return $tmpl_ar;
	}

	// Template selection
	public function wptofb_template_redirect(){

		if( $_GET[ "wptofb" ] ){

			include( WP_PLUGIN_DIR . '/wptofacebook/includes/tpl_redirect.php' );
			die();
		}
	}
}

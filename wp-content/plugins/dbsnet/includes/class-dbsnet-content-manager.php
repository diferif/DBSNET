<?php
class DBSnet_Content_Manager {
	protected $loader;
	protected $plugin_slug;
	protected $version;
	protected $models;

	public function __construct() {
		$this->plugin_slug = 'dbsnet-content-manager-slug';
		$this->version = '0.1.0';
		$this->models  = array( "Model_Tenant", "Model_Bank" );

		$this->load_dependencies();
		$this->define_admin_hooks();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-dbsnet-content-manager-admin.php';

		require_once plugin_dir_path( __FILE__ ) . 'class-dbsnet-content-manager-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/interfaces/IListItem.php';
		foreach( $this->models as $model ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/models/'. $model . '.php';
		}
		$this->loader = new DBSnet_Content_Manager_Loader();
	}

	private function define_admin_hooks() {
		$admin = new DBSnet_Content_Manager_Admin( $this->get_version() );
		// $this->loader->add_action( 'init', $admin, 'register_dbsnet_custom_post');
		$this->loader->add_action('admin_menu', $admin, 'create_dbsnet_menu_admin' );
		$this->loader->add_action ( 'admin_enqueue_scripts', $admin, 'enqueue_scripts_and_styles') ;
		// $this->loader->add_action( 'add_meta_boxes', $admin, 'add_meta_box');

		$this->loader->add_action( 'wp_ajax_RetrievePagination', $admin, 'RetrievePagination' );
		$this->loader->add_action( 'wp_ajax_RetrieveList', $admin, 'RetrieveList' );

		$this->loader->add_action( 'wp_ajax_CreateNewTenant', $admin, 'CreateTenant' );
		$this->loader->add_action( 'wp_ajax_CreateNewBank', $admin, 'CreateBank' );

		$this->loader->add_action( 'wp_ajax_UpdateTenant', $admin, 'UpdateTenant' );
		$this->loader->add_action( 'wp_ajax_UpdateBank', $admin, 'UpdateBank' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_version() {
		return $this->version;
	}
}
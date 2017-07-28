<?php
/*
Plugin Name: DBSnet Plugin
Description: Plugin for Dibuang Sayang
Version: 1.0
*/

// class DBSnetPluginSkeleton {

// 	public function __construct(){
// 		// Add Js & CSS for admin screen
// 		//add_action('admin_enqueue_scripts', array($this, 'enqueueAdmin'));

// 		// Add Js & CSS for front-end display
// 		//add_action('wp_enqueue_scripts', array($this, 'enqueue'));

// 		// Sample menu
// 		add_action( 'admin_menu', array($this, 'renderMenu') );
// 	}

// 	public function renderMenu(){
// 		add_menu_page( 'DBS Plugin Page', 'DBS Plugin Menu', 'manage_options', 'dbs-plugin', '', '', 3 );

// 		add_submenu_page(
// 			'dbs-plugin',
// 			'Pemesanan',
// 			'Pemesanan',
// 			'manage_options',
// 			'dbs-pemesanan',
// 			 array( $this, 'RenderPage')
// 			);
// 	}

// 	function RenderPage(){
// 		echo "<div>test page menu</div>";
// 	}

// }


// $skeleton = new DBSnetPluginSkeleton();

//=========================================================================================
//=========================================================================================

if (! defined( 'WPINC' )) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-dbsnet-content-manager.php';

function run_dbsnet_content_manager() {
	$dcm = new DBSnet_Content_Manager();
	$dcm->run();
}

run_dbsnet_content_manager();
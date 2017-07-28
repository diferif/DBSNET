<?php
/*
Plugin Name: DBSnet Plugin
Description: Plugin for Dibuang Sayang
Version: 1.0
*/

if (! defined( 'WPINC' )) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/class-dbsnet-content-manager.php';

function run_dbsnet_content_manager() {
	$dcm = new DBSnet_Content_Manager();
	$dcm->run();
}

run_dbsnet_content_manager();
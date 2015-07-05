<?php

/*
Plugin Name: Wordcomat Social Plugin
Plugin URI: http://wordcomat.com
Description: display recent feed.
Version: 1.0
Author: Renish Khunt
Author URI: http://wordcomat.com
*/
// make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('TP_RECENT_TWEETS_PATH', plugin_dir_url( __FILE__ ));

//register stylesheet for widget
function tp_twitter_plugin_styles() {
	wp_enqueue_style( 'tp_twitter_plugin_css', TP_RECENT_TWEETS_PATH . 'tp_twitter_plugin.css', array(), '1.0', 'screen' );
}
add_action( 'wp_enqueue_scripts', 'tp_twitter_plugin_styles' );

// include widget function
require_once('widget.php');
require_once('pinterest.php');
require_once('instagram.php');

// Link to settings page from plugins screen
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

function add_action_links ( $links ) {
	$mylinks = array(
		'<a href="' . admin_url( 'options-general.php?page=recent-tweets' ) . '">Settings</a>',
	);

	return array_merge( $links, $mylinks );
}

function register_tp_twitter_setting() {
	register_setting( 'tp_twitter_plugin_options', 'tp_twitter_plugin_options'); 
} 
add_action( 'admin_init', 'register_tp_twitter_setting' );
//delete_option('tp_twitter_global_notification');
add_option('tp_twitter_global_notification', 1);
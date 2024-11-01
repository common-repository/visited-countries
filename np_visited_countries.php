<?php
/*
Plugin Name: Visited Countries
Plugin URI: http://www.p3ck.us/visited_countries/
Description: Utilizes amMap to keep track of visited Countries and displays a map via shortcode.
Version: 1.0.1
Author: Nic P
Author URI: http://www.p3ck.us
License: 
License URI: 
*/

defined('ABSPATH') or die("No script kiddies please!");
define('vc_plugin_path', plugin_dir_path(__FILE__)); 
define('vc_ammap_url', plugins_url( "ammap/", __FILE__ ));
require_once vc_plugin_path . 'inc/vc_settings_page.php';
require_once vc_plugin_path . 'inc/vc_countries_page.php';
require_once vc_plugin_path . 'inc/vc_map.php';

register_activation_hook( __FILE__,  'np_vc_activate'  );
register_deactivation_hook( __FILE__, 'np_vc_deactivate' ) ;
register_uninstall_hook( __FILE__,  'np_vc_uninstall'  );

function register_vc_settings() {
	register_setting( 'vc_visited_countries', 'vc_countries' );
  register_setting( 'vc_settings', 'vc_settings', 'vc_settings_validate' );
  add_settings_section('vc_settings_main', 'Country Settings', 'vc_settings_callback', 'vc_settings_section');
  add_settings_field('vc_theme', 'Theme', 'vc_setting_theme', 'vc_settings_section', 'vc_settings_main');
  add_settings_field('vc_waterColor', 'Water Color', 'vc_setting_waterColor', 'vc_settings_section', 'vc_settings_main');
  add_settings_field('vc_color', 'Unvisited Color', 'vc_setting_color', 'vc_settings_section', 'vc_settings_main');
  add_settings_field('vc_selectedColor', 'Visited Color', 'vc_setting_selectedColor', 'vc_settings_section', 'vc_settings_main');
  add_settings_field('vc_outlineColor', 'Outline Color', 'vc_setting_outlineColor', 'vc_settings_section', 'vc_settings_main');
  add_settings_field('vc_rollOverColor', 'Roll Over Color', 'vc_setting_rollOverColor', 'vc_settings_section', 'vc_settings_main');
  add_settings_field('vc_rollOverOutlineColor', 'Roll Over Outline Color', 'vc_setting_rollOverOutlineColor', 'vc_settings_section', 'vc_settings_main');
} 
add_action( 'admin_init', 'register_vc_settings' );

// Add options to DB on activate
function np_vc_activate(){
   add_option('vc_countries' );
   add_option('vc_settings' );
  vc_check_defaults();
}

function np_vc_deactivate(){

}

// Delete options from DB on uninstall
function np_vc_uninstall(){
	delete_option('vc_countries');
}

add_shortcode('visited_countries', 'np_vc_show_map');


add_action( 'admin_menu', 'np_vc_settings_menu' );

// Create options page
function np_vc_settings_menu() {
  add_menu_page( 'Visited Countries', 'Visited Countries', 'manage_options', 'vc-settings', '' );
  add_submenu_page( 'vc-settings', 'Settings', 'Settings', 'manage_options', 'vc-settings', 'vc_settings_page' );
	add_submenu_page( 'vc-settings', 'Countries', 'Countries', 'manage_options', 'vc-visited-countries', 'vc_countries_page' );
}


	// Add settings link on plugin page
	function vc_plugin_settings_link($links) { 
  	$settings_link = '<a href="admin.php?page=vc-settings">Settings</a>'; 
  	array_unshift($links, $settings_link); 
  	return $links; 
	}
  
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'vc_plugin_settings_link' );
?>
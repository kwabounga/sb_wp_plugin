<?php
/**
 * @package Spread Widget WP Plugin
 * @version 1.2.1
 */
/*
Plugin Name: Spread Widget WP Plugin
Plugin URI: https://github.com/kwabounga/sb_wp_plugin/
Description: Spread popup show up on Wordpress
Author: Jean-Yves Chaillou
Version: 1.2.1
Author URI: http://kwabounga.fr/
*/


const SB_VERSION = "1.2.1";
const SB_WP_TITLE = "SPREAD Popup Widget";
const SB_WP_TITLE_MENU = "SPREAD Popup";

/**
 * get the current plugin folder name /path/to/the/current/[folder_name/]
 * @return string folder_name/
 */
function  getPluginNamePath(){
  $plug_url = explode("\\",plugin_dir_path( __FILE__ ));
  $plug_url = $plug_url[count($plug_url) -1];
  return $plug_url;
}

include_once __DIR__ ."./src/sb-wp-admin.php";
include_once __DIR__ ."./src/sb-wp-front.php";


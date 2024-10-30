<?php
/*
Plugin Name: Bottone di Contatto Rapido
Description: Questo plugin aggiunge un bottone di contatto rapido sempre visibile sul tuo sito WordPress. Facilita la comunicazione tra i visitatori del sito e il proprietario del sito, rendendo più semplice ed immediato il contatto o il link ad una risorsa/pagina importante.
Version: 1.0.1
Author: Liberal Studio
Author URI: https://www.liberalstudio.it/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: bottone-di-contatto-rapido
Domain Path: /languages
*/

/**
 * Basic plugin definitions 
 * 
 * @package Bottone di Contatto Rapido
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !defined( 'BDCR_DIR' ) ) {
  define( 'BDCR_DIR', dirname( __FILE__ ) );      // Plugin dir
}
if( !defined( 'BDCR_URL' ) ) {
  define( 'BDCR_URL', plugin_dir_url( __FILE__ ) );   // Plugin url
}
if( !defined( 'BDCR_INC_DIR' ) ) {
  define( 'BDCR_INC_DIR', BDCR_DIR.'/includes' );   // Plugin include dir
}
if( !defined( 'BDCR_INC_URL' ) ) {
  define( 'BDCR_INC_URL', BDCR_URL.'includes' );    // Plugin include url
}
if( !defined( 'BDCR_ASSETS_DIR' ) ) {
  define( 'BDCR_ASSETS_DIR', BDCR_DIR.'/assets' );   // Plugin assets dir
}
if( !defined( 'BDCR_ASSETS_URL' ) ) {
  define( 'BDCR_ASSETS_URL', BDCR_URL.'assets' );    // Plugin assets url
}
if( !defined( 'BDCR_ADMIN_DIR' ) ) {
  define( 'BDCR_ADMIN_DIR', BDCR_INC_DIR.'/admin' );  // Plugin admin dir
}
if(!defined('BDCR_TD')) {
  define('BDCR_TD', 'bottone-di-contatto-rapido'); // Plugin Text Domain
}


/**
 * Load Text Domain
 *
 * This gets the plugin ready for translation.
 *
 * @package Bottone di Contatto Rapido
 * @since 1.0.0
 */
load_plugin_textdomain( BDCR_TD, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package Bottone di Contatto Rapido
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'bdcr_install' );

function bdcr_install(){
	
}

/**
 * Deactivation Hook
 *
 * Register plugin deactivation hook.
 *
 * @package Bottone di Contatto Rapido
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'bdcr_uninstall');

function bdcr_uninstall(){
  
}

// Global variables
global $bdcr_scripts, $bdcr_admin, $bdcr_options;

$bdcr_options = get_option('bdcr_options');

// Script class handles most of script functionalities of plugin
include_once( BDCR_INC_DIR.'/class-bdcr-scripts.php' );
$bdcr_scripts = new Bdcr_Scripts();
$bdcr_scripts->add_hooks();

// Admin class handles most of admin panel functionalities of plugin
include_once( BDCR_ADMIN_DIR.'/class-bdcr-admin.php' );
$bdcr_admin = new Bdcr_Admin();
$bdcr_admin->add_hooks();
?>
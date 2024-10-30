<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package Bottone di Contatto Rapido
 * @since 1.0.0
 */
class Bdcr_Scripts {

	//class constructor
	function __construct()
	{
		
	}
	
	/**
	 * Enqueue Scripts on Public Side
	 * 
	 * @package Bottone di Contatto Rapido
	 * @since 1.0.0
	 */
	public function bdcr_public_scripts(){

		wp_register_style( 'bdcr-public-style', BDCR_INC_URL.'/css/bdcr-public.css', array(), time() );
		
		wp_enqueue_script('jquery');
		
	}
	
	function bdcr_admin_scripts(){

		wp_register_style( 'bdcr-admin-style', BDCR_INC_URL.'/css/bdcr-admin.css', array(),  time() );
		wp_enqueue_style( 'bdcr-admin-style' );
	
		wp_enqueue_script('jquery');

		wp_register_script( 'bdcr-admin-script', BDCR_INC_URL.'/js/bdcr-admin.js', array(), time(), true );
		wp_enqueue_script( 'bdcr-admin-script' );

		wp_localize_script( 'bdcr-admin-script', 'Bdcr', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
		));
	}

	/**
	 * Adding Hooks
	 *
	 * Adding hooks for the styles and scripts.
	 *
	 * @package Bottone di Contatto Rapido
	 * @since 1.0.0
	 */
	function add_hooks(){
		
		add_action( 'wp_enqueue_scripts', array( $this, 'bdcr_public_scripts' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'bdcr_admin_scripts' ) );
	}
}
?>
<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Manage Admin Panel Class
 *
 * @package Bottone di Contatto Rapido
 * @since 1.0.0
 */
class Bdcr_Admin {

	public $scripts;

	//class constructor
	function __construct() {

		global $bdcr_scripts;

		$this->scripts = $bdcr_scripts;
	}

	public static function bdcr_get_icons() {

 		$is_admin = is_admin();
	
		$icon_count = 10;

		$bdcr_icons = array();
		 
		for ($i = 1; $i <= $icon_count; $i++) {

			$icon_name = "icon{$i}";

			$icon_path = $is_admin 
				? BDCR_ASSETS_URL . "/icons/{$i}-black.png" 
				: BDCR_ASSETS_URL . "/icons/{$icon_name}.png";
			
			$bdcr_icons[$icon_name] = $icon_path;
		}
	
		return $bdcr_icons;
	}
	

	function bdcr_setting_page() {

        add_menu_page(
            __( 'Bottone di Contatto Rapido', 'bottone-di-contatto-rapido' ), 	
            'Bottone di Contatto Rapido', 				
            'manage_options', 							
            'bdcr-settings', 							
            array( $this, 'bdcr_settings_file') 		
        );
    }

	function bdcr_settings_file() {

        include_once( BDCR_ADMIN_DIR . '/forms/bdcr_settings.php' );

    }

	function bdcr_register_settings() {

        register_setting( 'bdcr_settings', 'bdcr_options' );

    }

	function bdcr_btn_html() {

		if( wp_doing_ajax() ) return;

		global $bdcr_options;

		$bdcr_icons 				= $this->bdcr_get_icons();
		$bdcr_icon 					= isset( $bdcr_options['bdcr_icon'] ) ? $bdcr_options['bdcr_icon'] : '';
		$bdcr_background 			= isset( $bdcr_options['bdcr_background'] ) ? $bdcr_options['bdcr_background'] : '#fff';
		$bdcr_icon_color 			= isset( $bdcr_options['bdcr_icon_color'] ) ? $bdcr_options['bdcr_icon_color'] : '#000';
		$bdcr_destination_url 		= isset( $bdcr_options['bdcr_destination_url'] ) && !empty( $bdcr_options['bdcr_destination_url'] ) ? $bdcr_options['bdcr_destination_url'] : '';
		$bdcr_open_in_new_window 	= isset( $bdcr_options['bdcr_open_in_new_window'] ) && !empty( $bdcr_options['bdcr_open_in_new_window'] ) ? $bdcr_options['bdcr_open_in_new_window'] : '';
		$bdcr_button_alignment 		= isset( $bdcr_options['bdcr_button_alignment'] ) && !empty( $bdcr_options['bdcr_button_alignment'] ) ? $bdcr_options['bdcr_button_alignment'] : 'left';
		$bdcr_link_open 			= '';
	
		if ( $bdcr_open_in_new_window ) $bdcr_link_open = 'target="_blank"';
	
		if ( !empty( $bdcr_icon ) ) 
		{
			wp_enqueue_style( 'bdcr-public-style' );

			?>
				<a href="<?php echo esc_url($bdcr_destination_url); ?>" class="bdcr_btn_container <?php echo esc_attr($bdcr_button_alignment); ?>" style="background-color: <?php echo esc_attr($bdcr_background); ?>; color: <?php echo esc_attr($bdcr_icon_color); ?>;" <?php echo esc_attr($bdcr_link_open); ?>>

					<img src="<?php echo esc_url($bdcr_icons[$bdcr_icon]); ?>" alt="Icon" style="color: <?php echo esc_attr($bdcr_icon_color); ?>;" />
					
				</a>

			<?php
		}
	}

	function bdcr_save_settings(){

		$bdcr_response = array();

		if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'bdcr_save_settings' ) ) 
		{
			$bdcr_response['success'] = true;

			$bdcr_options = array(
				'bdcr_background' => isset( $_POST['bdcr_background'] ) ? sanitize_text_field( wp_unslash( $_POST['bdcr_background'] ) ) : '',
				'bdcr_icon_color' => isset( $_POST['bdcr_icon_color'] ) ? sanitize_text_field( wp_unslash( $_POST['bdcr_icon_color'] ) ): '',
				'bdcr_destination_url' => isset( $_POST['bdcr_destination_url'] ) ? sanitize_text_field( wp_unslash( $_POST['bdcr_destination_url'] ) ): '',
				'bdcr_open_in_new_window' => isset( $_POST['bdcr_open_in_new_window'] ) ? sanitize_text_field( wp_unslash( $_POST['bdcr_open_in_new_window'] ) ): '',
				'bdcr_button_alignment' => isset( $_POST['bdcr_button_alignment'] ) ? sanitize_text_field( wp_unslash( $_POST['bdcr_button_alignment'] ) ): '',
				'bdcr_icon' => isset( $_POST['bdcr_icon'] ) ? sanitize_text_field( wp_unslash( $_POST['bdcr_icon'] ) ): '',
			);

			update_option( 'bdcr_options',  $bdcr_options );

		} 
		else 
		{
			$bdcr_response['success'] = false;
		}

		echo wp_json_encode($bdcr_response);
		exit;

	}

	/**
	 * Adding Hooks
	 *
	 * @package Bottone di Contatto Rapido
	 * @since 1.0.0
	 */
	function add_hooks(){

		add_action( 'wp_ajax_bdcr_save_settings', array( $this, 'bdcr_save_settings' ) );
		add_action( 'wp_ajax_nopriv_bdcr_save_settings', array( $this, 'bdcr_save_settings' ) );

		add_action( 'admin_menu', array( $this, 'bdcr_setting_page' ) );

		add_action( 'admin_init', array( $this, 'bdcr_register_settings' ) );

		add_action( 'wp_footer', array( $this, 'bdcr_btn_html' ) );

	}
}
?>
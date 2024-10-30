<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $bdcr_options;


echo '<div class="updated bdcr_settings_success bdcr_hide" id="message" style="margin-left:0px; margin-top:20px;">
    <p><strong>'. esc_html( "Changes Saved Successfully.", 'bottone-di-contatto-rapido' ) .'</strong></p>
</div>';

echo '<div class="notice notice-error bdcr_settings_error bdcr_hide">
    <p><strong>'. esc_html( "Something went wrong.", 'bottone-di-contatto-rapido' ) .'</strong></p>
</div>';

$bdcr_icons                 = Bdcr_Admin::bdcr_get_icons();
$bdcr_icon_key              = isset($bdcr_options['bdcr_icon']) && !empty($bdcr_options['bdcr_icon']) ? $bdcr_options['bdcr_icon'] : '';
$bdcr_icon                  = isset($bdcr_icons[$bdcr_icon_key]) ? $bdcr_icons[$bdcr_icon_key] : '';
$bdcr_background            = isset($bdcr_options['bdcr_background']) && !empty($bdcr_options['bdcr_background']) ? $bdcr_options['bdcr_background'] : '#fff';
$bdcr_icon_color            = isset($bdcr_options['bdcr_icon_color']) && !empty($bdcr_options['bdcr_icon_color']) ? $bdcr_options['bdcr_icon_color'] : '#000';
$bdcr_destination_url       = isset($bdcr_options['bdcr_destination_url']) && !empty($bdcr_options['bdcr_destination_url']) ? $bdcr_options['bdcr_destination_url'] : '';
$bdcr_button_alignment      = isset($bdcr_options['bdcr_button_alignment']) && !empty($bdcr_options['bdcr_button_alignment']) ? $bdcr_options['bdcr_button_alignment'] : 'left';
$bdcr_open_in_new_window    = isset($bdcr_options['bdcr_open_in_new_window']) && !empty($bdcr_options['bdcr_open_in_new_window']) ? $bdcr_options['bdcr_open_in_new_window'] : '';

?>

<div class="wrap">

    <form method="post" id="bdcr_settings_form" >

        <?php

		settings_fields( 'bdcr_settings' );

		?>
    
        <input type="hidden" name="_wpnonce" value="<?php echo esc_attr( wp_create_nonce('bdcr_save_settings') ); ?>">

        <div id="bdcr_settings" class="post-box-container">

            <div class="metabox-holder">

                <div class="meta-box-sortables ui-sortable">

                    <div id="settings" class="postbox">

                        <h3 class="hndle">
                            <span style="vertical-align: top;"><?php echo esc_attr_e( 'Bottone di Contatto Rapido', 'bottone-di-contatto-rapido' ); ?></span>
                        </h3>

                        <div class="inside">
                            <table class="form-table">
                                <tbody>

                                    <tr>
                                        <th scope="row">
                                            <label><strong><?php echo esc_attr_e( 'Background color', 'bottone-di-contatto-rapido' ) ?></strong></label>
                                        </th>
                                        <td>
                                            <input type="color"  name="bdcr_background" class="" value="<?php echo  esc_attr($bdcr_background); ?>" >
                                        </td>
                                    </tr>

                                    <!-- <tr>
                                        <th scope="row">
                                            <label><strong></strong></label>
                                        </th>
                                        <td>
                                            <input type="color"  name="bdcr_icon_color" class="" value="" >
                                        </td>
                                    </tr> -->

                                    <tr>
                                        <th scope="row">
                                            <label><strong><?php echo esc_attr_e( 'Destination URL', 'bottone-di-contatto-rapido' ) ?></strong></label>
                                        </th>
                                        <td>
                                            <input type="url"  name="bdcr_destination_url" class="regular-text" value="<?php echo  esc_url($bdcr_destination_url); ?>" >
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">
                                            <label><strong><?php echo esc_attr_e( 'Open in new window', 'bottone-di-contatto-rapido' )?></strong></label>
                                        </th>
                                        <td>
                                            <input type="checkbox" name="bdcr_open_in_new_window" value="1" <?php checked( $bdcr_open_in_new_window, 1 );?> />
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">
                                            <label><strong><?php echo esc_attr_e( 'Icon position', 'bottone-di-contatto-rapido' )?></strong></label>
                                        </th>
                                        <td class="bdcr_button_alignment_setting">
                                            <label><input type="radio" name="bdcr_button_alignment" value="left" <?php checked( $bdcr_button_alignment, 'left' );?> /> <?php echo esc_attr_e( 'Left', 'bottone-di-contatto-rapido' )?></label>
                                            <label><input type="radio" name="bdcr_button_alignment" value="right" <?php checked( $bdcr_button_alignment, 'right' );?> /> <?php echo esc_attr_e( 'Right', 'bottone-di-contatto-rapido' )?></label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">
                                            <label><strong><?php echo esc_attr_e( 'Icon', 'bottone-di-contatto-rapido' ) ?></strong></label>
                                        </th>
                                        <td>
                                            <input type="hidden" id="bdcr_icon" name="bdcr_icon" class="regular-text" value="<?php echo  esc_attr($bdcr_icon_key); ?>" >
                                            <div class="bdcr_icon_select_wrap">
                                                <div class="bdcr_selected_icon">
                                                    <img src="<?php echo esc_url( $bdcr_icon ); ?>" alt="">
                                                </div>
                                                <div class="bdcr_select_icon_btn"><?php echo esc_attr_e( 'Select Icon', 'bottone-di-contatto-rapido' ) ?></div>
                                            </div>
                                            <div class="bdcr_icon_modal">
                                                <div class="bdcr_icon_modal_container">
                                                    <div class="bdcr_icon_modal_wrap">
                                                        <div class="bdcr_close_modal">&#10005;</div>
                                                            <div class="bdcr_all_icons_wrap">
                                                                <?php foreach ($bdcr_icons as $key => $value) : ?>
                                                                    <div class="bdcr_icon_wrap" title="<?php echo esc_attr(ucfirst($key)); ?>" data-icon_key="<?php echo esc_attr($key); ?>">
                                                                        <img src="<?php echo esc_url($value); ?>" alt="<?php echo esc_attr(ucfirst($key)); ?>" />
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </td>

                                    </tr>

                                    <tr>
                                        <td colspan="2" class="wpsm_options_save_wrap">
                                            <input type="submit" class="button-primary" id="bdcr_options_save" name="bdcr_options_save" value="<?php echo esc_attr_e( 'Save Changes', 'bottone-di-contatto-rapido' ) ?>" />
                                            <div class="bdcr_loader bdcr_hide"></div>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

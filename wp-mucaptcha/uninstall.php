<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  exit;
}

delete_option( 'mucaptcha_public_key' );
delete_option( 'mucaptcha_secret_key' );

delete_option( 'mucaptcha_in_comment_form' );
delete_option( 'mucaptcha_in_comment_form_logged' );
delete_option( 'mucaptcha_in_login_form' );
delete_option( 'mucaptcha_in_register_form' );

delete_option( 'mucaptcha_display_text' );
delete_option( 'mucaptcha_touchonly' );
delete_option( 'mucaptcha_line_color' );
delete_option( 'mucaptcha_line_width' );
delete_option( 'mucaptcha_background_color' );

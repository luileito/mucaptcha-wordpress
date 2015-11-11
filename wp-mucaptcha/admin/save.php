<?php
// Clean user input before further processing.
$_POST = array_map('sanitize_text_field', $_POST);

$public_key = $_POST['mucaptcha_public_key'];
update_option( 'mucaptcha_public_key', $public_key );

$secret_key = $_POST['mucaptcha_secret_key'];
update_option( 'mucaptcha_secret_key', $secret_key );

$in_comment = isset($_POST['mucaptcha_in_comment_form']) ?
                    $_POST['mucaptcha_in_comment_form'] : NULL;
if ( !is_null( $in_comment ) ) {
  update_option( 'mucaptcha_in_comment_form', $in_comment );
}

$in_comment_logged = isset($_POST['mucaptcha_in_comment_form_logged']) ?
                           $_POST['mucaptcha_in_comment_form_logged'] : NULL;
if ( !is_null( $in_comment_logged ) ) {
  update_option( 'mucaptcha_in_comment_form_logged', $in_comment_logged );
}

$in_login = !empty($_POST['mucaptcha_in_login_form']);
if ( !is_null( $in_login ) ) {
  update_option( 'mucaptcha_in_login_form', $in_login );
}

$in_register = isset($_POST['mucaptcha_in_register_form']) ?
                     $_POST['mucaptcha_in_register_form'] : NULL;
if ( !is_null( $in_register_form ) ) {
  update_option( 'mucaptcha_in_register_form', $in_register );
}

$display_text = $_POST['mucaptcha_display_text'];
update_option( 'mucaptcha_display_text', $display_text );

$touchonly = isset($_POST['mucaptcha_touchonly']) ?
                   $_POST['mucaptcha_touchonly'] : NULL;
if ( !is_null( $touchonly ) ) {
  update_option( 'mucaptcha_touchonly', $touchonly );
}

$line_color = $_POST['mucaptcha_line_color'];
update_option( 'mucaptcha_line_color', $line_color );

$line_width = intval( $_POST['mucaptcha_line_width'] );
if ( $line_width > 0 ) {
  update_option( 'mucaptcha_line_width', $line_width );
}

$background_color = $_POST['mucaptcha_background_color'];
update_option( 'mucaptcha_background_color', $background_color );
?>

<div class="wrap">
  <div class="updated">
    <p>
      <strong>
        <?php _e( 'Configuration saved.', 'mucaptcha' ); ?>
      </strong>
    </p>
  </div>
</div>

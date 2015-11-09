<?php
/*
  Plugin Name: μcaptcha
  Plugin URI: https://github.com/luileito/mucaptcha-wordpress
  Description: Plugin for displaying μcaptcha on your WordPress site.
  Author: Luis Leiva
  Text Domain: mucaptcha
  Version: 1.1
*/

// Add scripts to the current page.
function mucaptcha_add_scripts() {
  // Note: In Wordpress > 4.1 it seems conditional JS loading is possible.
  // For older WP versions let's use this tried-and-true approach.
  if ( preg_match('/MSIE [6-8]/', $_SERVER['HTTP_USER_AGENT']) ) {
    wp_enqueue_script( 'json2', 'https://cdn.jsdelivr.net/json2/0.2/json2.min.js', array(), NULL, TRUE );
    wp_enqueue_script( 'excanvas', 'https://cdn.jsdelivr.net/excanvas/r3/excanvas.compiled.js', array(), NULL, TRUE );
  }
  // Load the μcaptcha script.
  $key = get_option( 'mucaptcha_public_key' );
  wp_enqueue_script( 'mucaptcha', 'http://api.mucaptcha.com/v1/js?key=' . $key, array(), NULL, TRUE );
}

// Display μcaptcha on the current page.
function mucaptcha_display() {
  // Text option must be localized.
  $text = get_option( 'mucaptcha_display_text' );
  if ( empty( $text ) ) $text = __('Draw the math symbols:', 'mucaptcha');
  // The following options are all optional.
  $options = "";
  $touchonly = get_option( 'mucaptcha_touchonly' );
  $linecolor = get_option( 'mucaptcha_line_color' );
  $linewidth = get_option( 'mucaptcha_line_width' );
  $bgcolor   = get_option( 'mucaptcha_background_color' );
  if ( $touchonly ) $options .= ' data-touchonly="true"';
  if ( $linecolor ) $options .= ' data-linecolor="' . $linecolor . '"';
  if ( $linewidth ) $options .= ' data-linewidth="' . $linewidth . '"';
  if ( $bgcolor )   $options .= ' data-bgcolor="'   . $bgcolor   . '"';
  // Display the μcaptcha element.
  echo <<<CAPTCHA
  <div class="mucaptcha"$options>
    <label>$text</label>
    <br/>
    <canvas style="max-width:100%"></canvas>
  </div>
CAPTCHA;
}

// Load the plugin administration page.
function mucaptcha_admin_page() {
  include dirname(__FILE__) . '/admin/index.php';
}

// Add an entry to the plugins admin menu.
function mucaptcha_admin_menu() {
  add_submenu_page( 'plugins.php', __( 'μcaptcha configuration', 'mucaptcha' ),
    'μcaptcha', 'administrator', 'mucaptcha_config', 'mucaptcha_admin_page' );
}

// Load plugin translations.
function mucaptcha_localize() {
  load_plugin_textdomain( 'mucaptcha', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}

// Append error message to the current stack (which is passed in by reference, btw).
function mucaptcha_add_error( &$err, $response ) {
  if ($response['error_code'] == NULL) {
    // The user didn't pass the challenge.
    $msg  = __( '<strong>error</strong>: You didn\'t pass the μcaptcha.', 'mucaptcha' );
  } else {
    // Some error happened while solving the challenge.
    $msg  = sprintf( __( '<strong>μcaptcha error</strong>: %s.', 'mucaptcha' ), $response['error_code'] );
    $msg .= sprintf( __( '<a href="%s">More info</a>', 'mucaptcha' ), 'https://api.mucaptcha.com/v1/docs/#error-codes' );
  }
  $err->add( 'mucaptcha_error', $msg );
}

// Validate μcaptcha when a user submits a comment.
function mucaptcha_validate_comment( $comment, $number ) {
  $response = mucaptcha_verify();
  if ( $response['success'] == FALSE ) {
    $comment = new WP_Error;
    mucaptcha_add_error( $comment, $response );
  }
  return $comment;
}

// Validate μcaptcha when a user logs in.
function mucaptcha_validate_login( $user, $username, $password ) {
  $response = mucaptcha_verify();
  if ( $response['success'] == FALSE ) {
    $user = new WP_Error;
    mucaptcha_add_error( $user, $response );
  }
  return $user;
}

// Validate μcaptcha when a user registers.
function mucaptcha_validate_registration( $errors, $username, $email ) {
  $response = mucaptcha_verify();
  if ( $response['success'] == FALSE ) {
    mucaptcha_add_error( $errors, $response );
  }
  return $errors;
}

// Actual μcaptcha validatation.
function mucaptcha_verify() {
  // It may be the case that 'touchonly' option is set or JavaScript is disabled,
  // so ensure that the user has been shown a μcaptcha challenge.
  if ( isset( $_POST['mucaptcha-challenge'] ) ) {
    require 'class-mucaptcha.php';
    $challenge = $_POST['mucaptcha-challenge'];
    $strokes   = $_POST['mucaptcha-strokes'];
    $secret    = get_option( 'mucaptcha_secret_key' );
    $referer   = site_url();
    $mucaptcha = new MuCAPTCHA( $secret, $referer );
    return $mucaptcha->verify( $challenge, $strokes );
  }
  // Otherwise return the expected verification format.
  return array(
    'success'    => TRUE,
    'error_code' => NULL,
  );
}

// General hooks.
add_action( 'plugins_loaded', 'mucaptcha_localize' );
add_action( 'admin_menu', 'mucaptcha_admin_menu' );
add_action( 'init', 'mucaptcha_add_scripts' );

// Hooks for comment form (anonymouse users).
if ( get_option( 'mucaptcha_in_comment_form' ) ) {
  add_action( 'comment_form_after_fields', 'mucaptcha_display' );
  add_filter( 'comment_post', 'mucaptcha_validate_comment', 99, 2 );
}

// Hooks for comment form (logged users).
if ( get_option( 'mucaptcha_in_comment_form_logged' ) ) {
  add_action( 'comment_form_logged_in_after', 'mucaptcha_display' );
  add_filter( 'comment_post', 'mucaptcha_validate_comment', 99, 2 );
}

// Hooks for login form.
if ( get_option( 'mucaptcha_in_login_form' ) ) {
  add_action( 'login_form', 'mucaptcha_display' );
  add_filter( 'authenticate', 'mucaptcha_validate_login', 99, 3 );
}

// Hooks for registration form.
if ( get_option( 'mucaptcha_in_register_form' ) ) {
  add_action( 'register_form', 'mucaptcha_display' );
  add_filter( 'registration_errors', 'mucaptcha_validate_registration', 99, 3 );
}

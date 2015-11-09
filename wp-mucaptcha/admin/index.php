<?php if ( !empty( $_POST ) ) require 'save.php'; ?>

<?php if ( !function_exists( 'curl_init' ) ) { ?>
  <div class="update-nag">
    <?php printf( __( '<a href="%s">Please install the PHP cURL lib</a>. Otherwise the submitted μcaptchas won\'t be validated.', 'mucaptcha' ),
                'http://php.net/manual/book.curl.php'); ?>
  </div>
<?php } ?>

<?php include 'form.php'; ?>

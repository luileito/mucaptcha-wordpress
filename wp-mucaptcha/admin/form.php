<div class="wrap">
  <div id="icon-plugins" class="icon32"></div>
  <h2><?php _e( 'μcaptcha configuration', 'mucaptcha' ) ?></h2>

  <?php if ( !get_option( 'mucaptcha_public_key' ) || !get_option( 'mucaptcha_secret_key' ) ): ?>
    <div class="wrap">
      <div class="error">
        <p>
          <?php printf( __( 'Please enter your public and secret API keys. <a href="%s">Get them here</a>.', 'mucaptcha' ),
                            'https://api.mucaptcha.com'); ?>
        </p>
      </div>
    </div>
  <?php endif; ?>

  <form name="mucaptcha_form" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <h4><?php _e( 'General settings', 'mucaptcha' ) ?></h4>
    <table class="form-table">
      <tr valign="top">
        <th scope="row">
          <label for="mucaptcha_public_key">
            <?php _e( 'Public key', 'mucaptcha' ); ?><span>*</span>
          </label>
        </th>
        <td>
          <input type="text" class="regular-text" name="mucaptcha_public_key" id="mucaptcha_public_key"
            value="<?php echo get_option( 'mucaptcha_public_key' ); ?>" size="20" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="mucaptcha_secret_key">
            <?php _e( 'Secret key', 'mucaptcha' ); ?><span>*</span>
          </label>
        </th>
        <td>
          <input type="text" class="regular-text" name="mucaptcha_secret_key" id="mucaptcha_secret_key"
            value="<?php echo get_option( 'mucaptcha_secret_key' ); ?>" size="20" />
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <?php _e( 'Display', 'mucaptcha' ); ?>
        </th>
        <td>
          <label for="mucaptcha_in_comment_form">
            <input type="checkbox" name="mucaptcha_in_comment_form" id="mucaptcha_in_comment_form"
              <?php checked( 'on', get_option( 'mucaptcha_in_comment_form' ) ); ?> />
            <?php _e( 'When anonymous users comment', 'mucaptcha' ); ?>
          </label>
          <br />
          <label for="mucaptcha_in_comment_form_logged">
            <input type="checkbox" name="mucaptcha_in_comment_form_logged" id="mucaptcha_in_comment_form_logged"
              <?php checked( 'on', get_option( 'mucaptcha_in_comment_form_logged' ) ); ?> />
            <?php _e( 'When logged users comment', 'mucaptcha' ); ?>
          </label>
          <br />
          <label for="mucaptcha_in_login_form">
            <input type="checkbox" name="mucaptcha_in_login_form" id="mucaptcha_in_login_form"
              <?php checked( 'on', get_option( 'mucaptcha_in_login_form' ) ); ?> />
            <?php _e( 'When someone logs in', 'mucaptcha' ); ?>
          </label>
          <br />
          <label for="mucaptcha_in_register_form">
            <input type="checkbox" name="mucaptcha_in_register_form" id="mucaptcha_in_register_form"
              <?php checked( 'on', get_option( 'mucaptcha_in_register_form' ) ); ?> />
            <?php _e( 'When someone registers', 'mucaptcha' ); ?>
          </label>
        </td>
      </tr>
    </table>

    <h4><?php _e( 'Appearance settings', 'mucaptcha' ) ?></h4>
    <table class="form-table">
      <tr valign="top">
        <th scope="row">
          <label>
            <?php _e( 'Accompanying text', 'mucaptcha' ); ?>
          </label>
        </th>
        <td>
          <input type="text" class="regular-text" name="mucaptcha_display_text"
            value="<?php echo get_option( 'mucaptcha_display_text' ); ?>" size="20" />
          <span class="description">
            <?php _e( 'e.g. Draw the math symbols:', 'mucaptcha' ); ?>
          </span>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <?php _e( 'Scope', 'mucaptcha' ); ?>
        </th>
        <td>
          <label>
            <input type="checkbox" name="mucaptcha_touchonly" id="mucaptcha_touchonly"
              <?php checked( 'on', get_option( 'mucaptcha_touchonly' ) ); ?> />
            <?php _e( 'Display only on touch-capable devices', 'mucaptcha' ); ?>
          </label>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label>
            <?php _e( 'Line color', 'mucaptcha' ); ?>
          </label>
        </th>
        <td>
          <input type="text" class="regular-text" name="mucaptcha_line_color"
            value="<?php echo get_option( 'mucaptcha_line_color' ); ?>" size="20" />
          <span class="description">
            <?php _e( 'e.g. red (default), #FFF or any valid CSS color', 'mucaptcha' ); ?>
          </span>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label>
            <?php _e( 'Line width', 'mucaptcha' ); ?>
          </label>
        </th>
        <td>
          <input type="text" class="regular-text" name="mucaptcha_line_width"
            value="<?php echo get_option( 'mucaptcha_line_width' ); ?>" size="20" />
          <span class="description">
            <?php _e( 'e.g. 3 (default)', 'mucaptcha' ); ?>
          </span>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label>
            <?php _e( 'Background color', 'mucaptcha' ); ?>
          </label>
        </th>
        <td>
          <input type="text" class="regular-text" name="mucaptcha_background_color"
            value="<?php echo get_option( 'mucaptcha_background_color' ); ?>" size="20" />
          <span class="description">
            <?php _e( 'e.g. white (default), #F00 or any valid CSS color', 'mucaptcha' ); ?>
          </span>
        </td>
      </tr>
    </table>

    <p class="submit">
      <input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save', 'mucaptcha' ) ?>" />
    </p>
  </form>

</div>

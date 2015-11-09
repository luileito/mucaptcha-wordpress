<?php
/**
 * μcaptcha PHP class.
 * @version 1.0.0
 */
class MuCAPTCHA {

  private $secret;

  function __construct($secret)
  {
    if (empty($secret)) {
      throw new Exception("No secret key provided. Please register at https://api.mucaptcha.com");
    }
    $this->secret = $secret;
  }

  function verify($challenge, $strokes, $remote_ip = NULL)
  {
    $url = "https://api.mucaptcha.com/v1/verify";
    $fields = array(
      'secret'    => $this->secret,
      'challenge' => $challenge,
      'strokes'   => $strokes,
      'ip'        => $remote_ip,
    );
    $response = $this->postRequest($url, $fields);
    return json_decode($response, TRUE);
  }

  // TODO: Provide alt. methods for servers without curl support.
  protected function postRequest($url, $data)
  {
    $options = array(
      CURLOPT_URL            => $url,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_SSL_VERIFYPEER => TRUE,
      CURLOPT_HEADER         => FALSE,
      CURLOPT_POST           => TRUE,
      CURLOPT_POSTFIELDS     => $data,
    );
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
  }

}
?>

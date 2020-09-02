<?php
namespace blackbaud;

class Http {
  
  public static function get($url = '', $headers = array()) {
    $ch = curl_init($url);
    curl_setopt_array($ch, array(
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => $headers
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
  }

  public static function patch($url = '', $body = array(), $headers = array()) {
    $ch = curl_init($url);
    curl_setopt_array($ch, array(
      CURLOPT_CUSTOMREQUEST => 'PATCH',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => json_encode($body)
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
  }

  public static function post($url = '', $body = array(), $headers = array()) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));

    $response = curl_exec($ch);

    curl_close($ch);
    return $response;
  }

  public static function applicationPost($url = '', $body = array(), $headers = array()) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    $response = curl_exec($ch);

    curl_close($ch);
    return $response;
  }
}

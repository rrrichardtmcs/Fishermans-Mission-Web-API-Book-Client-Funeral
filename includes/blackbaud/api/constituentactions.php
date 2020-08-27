<?php
namespace blackbaud;

class ConstituentActions {
  private static $headers = array();
  private static $baseUri;
  
  public static function init() {
    self::$headers = array(
      'bb-api-subscription-key: ' . AUTH_SUBSCRIPTION_KEY,
      'Authorization: Bearer ' . Session::getAccessToken()
    );
    self::$baseUri = SKY_API_BASE_URI . 'constituent/v1/';
  }

  public static function getById($id = 0) {
    $url = self::$baseUri . 'constituents/' . $id;
    $headers = self::$headers;
    $headers[] = 'Content-type: application/x-www-form-urlencoded';
    $response = Http::get($url, $headers);
    return json_decode($response, true);
  }

  public static function add($action = array()) {
    $url = self::$baseUri . 'actions';
    $headers = self::$headers;
    $headers[] = 'Content-type: application/json';
    $response = Http::post($url, $action, $headers);
    return json_decode($response, true);
  }
  
  public static function update($action = array()) {
    $url = self::$baseUri . 'actions/' . $constituent['action_id'];
    $headers = self::$headers;
    $headers[] = 'Content-type: application/json';
    $response = Http::patch($url, $action, $headers);
    return json_decode($response, true);
  }

}

Constituents::init();

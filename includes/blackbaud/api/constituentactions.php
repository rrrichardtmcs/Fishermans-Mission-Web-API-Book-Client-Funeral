<?php
namespace blackbaud;

class ConstituentActions {
  private static $headers = array();
  private static $baseUri;
  
  public static function init() {
    self::$headers = array(
      'Bb-Api-Subscription-Key: ' . AUTH_SUBSCRIPTION_KEY,
      'Authorization: Bearer ' . Session::getAccessToken(),
    );
  }

  public static function getById($id = 0) {
    $url = self::$baseUri . 'constituents/' . $id;
    $headers = self::$headers;
    $headers[] = 'Content-type: application/x-www-form-urlencoded';
    $response = Http::get($url, $headers);
    return json_decode($response, true);
  }

  public static function add($action) {
    self::$baseUri = SKY_API_BASE_URI;
    $url = self::$baseUri . 'constituent/v1/actions';

    array_push(self::$headers,'Content-Type: application/json');
    array_push(self::$headers, 'Bb-Api-Subscription-Key: ' . AUTH_SUBSCRIPTION_KEY);
    array_push(self::$headers, 'Authorization: Bearer ' . Session::getAccessToken());

    $response = Http::applicationPost($url, $action, self::$headers);
    return json_decode($response, true);
  }

  public static function addCustomFields($action) {
    self::$baseUri = SKY_API_BASE_URI;
    $url = self::$baseUri . 'constituent/v1/actions/customfields';

    array_push(self::$headers,'Content-Type: application/json');
    array_push(self::$headers, 'Bb-Api-Subscription-Key: ' . AUTH_SUBSCRIPTION_KEY);
    array_push(self::$headers, 'Authorization: Bearer ' . Session::getAccessToken());

    $response = Http::applicationPost($url, $action, self::$headers);
    var_dump('success response');
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

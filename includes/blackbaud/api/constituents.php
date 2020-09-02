<?php
namespace blackbaud;

class Constituents {
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
  
  public static function getByName($search_text = "") {
    $url = self::$baseUri . 'constituents/search?search_text=' . $search_text;
    $headers = self::$headers;
    $headers[] = 'Content-type: application/x-www-form-urlencoded';
    $response = Http::get($url, $headers);
    return json_decode($response, true);
  }

  
  public static function getByDeceasedName($search_text = "") {
    $url = self::$baseUri . 'constituents/search?search_text=' . $search_text;
    $headers = self::$headers;
    $headers[] = 'Content-type: application/x-www-form-urlencoded';
    $response = Http::get($url, $headers);
    $value = json_decode($response, true);
    $full_set = $value['value'];
   
    // here we need to simplify the output to id/name of those who are deceased
    $deceased = array_filter($full_set,function($Arr){
      return $Arr['deceased'] == "true";
    });
    return $deceased;
     //return $full_set;
  }

  
  public static function getAllDeceased() {
    $url = self::$baseUri . 'constituents?limit=5000&include_deceased=true';
    $headers = self::$headers;
    $headers[] = 'Content-type: application/x-www-form-urlencoded';

    $response = Http::get($url, $headers); // response is outputting a string
    $value = json_decode($response, true);
   
    // here we need to simplify the output to id/name of those who are deceased
    $deceased = array_filter($value["value"], function($arr){
      if (isset($arr['deceased'])) {
        return $arr['deceased'] == 'true';
      }
    });
    
    print_r(json_encode($deceased));
     return json_encode($deceased); // the encode makes it into a json to index.php



     
    // //  GRABS one person which is out test data Mrs. Eileen Abel
    //  $url = self::$baseUri . 'constituents/215030';
    //  $headers = self::$headers;
    //  $headers[] = 'Content-type: application/x-www-form-urlencoded';
 
    //  $response = Http::get($url, $headers);
    // //  $value = json_decode($response, true);

    // print_r($response);
  }


  public static function update($constituent = array()) {
    $url = self::$baseUri . 'constituents/' . $constituent['constituent_id'];
    $headers = self::$headers;
    $headers[] = 'Content-type: application/json';
    $response = Http::patch($url, $constituent, $headers);
    return json_decode($response, true);
  }
}

Constituents::init();

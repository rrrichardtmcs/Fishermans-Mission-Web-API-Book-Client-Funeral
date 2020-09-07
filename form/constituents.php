<?php
require_once '../blackbaud/blackbaud.php';
require_once '../blackbaud/api/constituentsClass.php';


// // Get one constituent record by ID.
// if (isset($_GET['id'])) {
//   var_dump('id');
//   $data = blackbaud\Constituents::getById($_GET['id']);

//   // Access token has expired. Attempt to refresh.
//   if (isset($data['statusCode']) && $data['statusCode'] == 401) {
//     $response = blackbaud\Auth::refreshAccessToken();
//     $token = json_decode($response, true);

//     if (!isset($token['access_token'])) {
//       echo json_encode($token);
//       return;
//     }

//     $data = blackbaud\Constituents::getById($_GET['id']);
//   }

//   echo json_encode(array('constituent' => $data));
// }

// elseif (isset($_GET['search_text'])) {
//   var_dump('search text');
  
//   $data = blackbaud\Constituents::getByDeceasedName($_GET['search_text']);

//   //echo json_encode($data);
//   // Access token has expired. Attempt to refresh.
//   if (isset($data['statusCode']) && $data['statusCode'] == 401) {

//     $response = blackbaud\Auth::refreshAccessToken();
//     $token = json_decode($response, true);
    
        
//     if (!isset($token['access_token'])) {
//       echo json_encode($token);
//       return;
//     }

//     $data = blackbaud\Constituents::getByDeceasedName($_GET['search_text']);
//   }

//   echo json_encode($data);
// }

if (isset($_GET['all'])) {
  
  $data = blackbaud\Constituents::getAllDeceased();
  // Access token has expired. Attempt to refresh.
  if (isset($data['statusCode']) && $data['statusCode'] == 401) {

    $response = blackbaud\Auth::refreshAccessToken();
    $token = json_decode($response, true);
        
    if (!isset($token['access_token'])) {
      echo json_encode($token);
      return;
    }

    $data = blackbaud\Constituents::getAllDeceased();
  }

  return $data;
  // echo json_encode($data);
}
// Update a constituent record.
else {
  parse_str(file_get_contents('php://input'), $_PATCH);
  $request_body = json_decode($_PATCH['data'], true);
  if (isset($request_body['constituent_id'])) {
    $data = blackbaud\Constituents::update($request_body);
    echo json_encode(array('status' => 'success'));
  }
}

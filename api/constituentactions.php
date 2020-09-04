<?php
require_once '../includes/blackbaud/blackbaud.php';
require_once '../includes/blackbaud/api/constituentactions.php';

// Get one constituent action record by ID.
if (isset($_GET['id'])) {
  $data = blackbaud\ConstituentActions::getById($_GET['id']);

  // Access token has expired. Attempt to refresh.
  if (isset($data['statusCode']) && $data['statusCode'] == 401) {
    $response = blackbaud\Auth::refreshAccessToken();
    $token = json_decode($response, true);

    if (!isset($token['access_token'])) {
      echo json_encode($token);
      return;
    }

    $data = blackbaud\ConstituentActions::getById($_GET['id']);
  }

  echo json_encode(array('constituentaction' => $data));
}
elseif (isset($_GET['action_id'])) {
    //this is a Patch
  parse_str(file_get_contents('php://input'), $_PATCH);
  $request_body = json_decode($_PATCH['data'], true);
  if (isset($request_body['constituent_id'])) {
    $data = blackbaud\ConstituentActions::update($request_body);
    echo json_encode(array('status' => 'success'));
  }


}
// Add a constituent action record.
else {
  parse_str(file_get_contents('php://input'), $_POST);

  if (isset($_POST['constituent_id'])) {
    $data = blackbaud\ConstituentActions::add(json_encode($_POST));

    // this is to add those custom fields
    // to explain more about this, there are the two links
    // https://developer.sky.blackbaud.com/docs/services/56b76470069a0509c8f1c5b3/operations/ListActionCustomFieldCategoryDetails
    // https://developer.sky.blackbaud.com/docs/services/56b76470069a0509c8f1c5b3/operations/CreateActionCustomField

    if(isset($_POST['missionrepresentative'])) {
      $customField = [];
      $customField['category'] = "Mission Representative";
      $customField['parent_id'] = $data['id'];
      $customField['value'] = $_POST['missionrepresentative'];
      $customFieldResponse = blackbaud\ConstituentActions::addCustomFields(json_encode($customField));
    }

    echo json_encode(array('status' => 'success'));
    // header(Location: ); // update in the future to send where you want
  }
}

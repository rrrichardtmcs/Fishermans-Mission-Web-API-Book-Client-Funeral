<?php
require_once '../blackbaud/blackbaud.php';

$response = blackbaud\Auth::refreshAccessToken();

echo json_encode(array(
  'tokenResponse' => json_decode($response, true)
));

<?php
require_once '../blackbaud/blackbaud.php';

echo json_encode(array(
  'authenticated' => blackbaud\Session::isAuthenticated()
));

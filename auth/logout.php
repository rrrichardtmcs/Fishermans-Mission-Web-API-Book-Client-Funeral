<?php
require_once '../blackbaud/blackbaud.php';

blackbaud\Session::logout();
echo json_encode(array());

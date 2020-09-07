<?php
require_once '../blackbaud/blackbaud.php';

blackbaud\Auth::exchangeCodeForAccessToken($_GET['code']);

header('Location: /');
exit();

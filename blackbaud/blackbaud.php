<?php
// Error reporting, for development only.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("allow_url_fopen", 1);
require_once 'session.php';
// this basically just points to the config.php file. DIRECTORY_SEPARATOR seems more future safe when switching from Linux to Windows
require_once join(DIRECTORY_SEPARATOR, array($_SERVER['DOCUMENT_ROOT'], 'config.php'));
// points to the constituentClass.php
require_once join(DIRECTORY_SEPARATOR, array('api', 'constituentsClass.php'));
require_once 'auth.php';
require_once 'curl.php';

<?php
//############## SQL Connection ################################################
// Database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'RequestApp');

// Error Logging
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Get Connection
$link = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// If Connection Fail
if ($link->connect_error) {
	die('Connect Error (' . $link->connect_errno . ') ' . $link->connect_error);
}

// Global Variables.
define("LOCAL", "http://localhost/RequestApp/"); //local URL
define("WEB", "http://192.168.1.72:80/RequestApp/"); //website URL
$environment = LOCAL; //change to WEB if you're live

// Switches
$darkMode = 0;
$adminMode = 1;
$VAT = 0.20;
$currencySymb = "£";
?>

<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/session_server.php");

session_start();

// Start a session
if (isset($_POST['startSession'])) {
  $table = $_POST['session'];
  // echo $table;

  $session = new Session('1','1',$table);
  // $session->getInfo();
  // header('location:' . $environment . 'index.php');
}

// Logout
if (isset($_POST['sessionOut'])) {
  unset($_SESSION['session']);
  header('location:' . $environment . 'index.php');
}
?>

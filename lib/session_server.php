<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");

session_start();

if (isset($_POST['startSession'])) {
  $table = $_POST['session'];
  echo $table;

  $_SESSION['session'] = $_POST['session'];
  header('location:' . $environment . 'index.php');
}

if (isset($_POST['sessionOut'])) {
  unset($_SESSION['session']);
  header('location:' . $environment . 'index.php');
}
?>

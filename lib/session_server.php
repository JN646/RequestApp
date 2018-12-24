<?php
session_start();

if (isset($_POST['startSession'])) {
  $table = $_POST['session'];
  echo $table;

  $_SESSION['session'] = $_POST['session'];
  header('location: ../index.php');
}

if (isset($_POST['sessionOut'])) {
  unset($_SESSION['session']);
  header('location: ../index.php');
}
?>

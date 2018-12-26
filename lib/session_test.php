<?php
include 'sessions_class.php';
include '../config/db_config.php';

$table = '5';

$session = new Session('1','1',$table);

$session->countSession($link);
$session->countSessionClosed($link);
$session->createSessionDB($link,$table);
// $session->destroySessionSession();

if (isset($_SESSION['session'])) {
  echo "Success: " . $_SESSION['session'];
} else {
  echo "Session Empty :(";
}

?>

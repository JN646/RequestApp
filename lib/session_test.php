<style media="screen">
  body {
    font-family: monospace;
  }
</style>
<?php
include 'sessions_class.php';
include '../config/db_config.php';

$table = '5';

$session = new Session($table);

$session->countSession($link);
$session->countSessionClosed($link);
$session->createSessionDB($link,$table);
// $session->destroySessionSession($link);

if (isset($_SESSION['session'])) {
  echo "Success: " . $_SESSION['session'];
} else {
  echo "Session Empty :(";
}

?>

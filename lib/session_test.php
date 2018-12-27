<style media="screen">
  body {
    font-family: monospace;
  }
</style>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/sessions_class.php");

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

<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/sessions_class.php");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Start a session
if (isset($_POST['startSession'])) {
  $table = $_POST['table'];
  $session = new Session($table);

  if ($table != 0) {
    if (!isset($_SESSION['session'])) {
      $session->createSessionDB($link,$table);
    }
    header('location:' . $environment . 'index.php');
  }
}

// Logout
if (isset($_POST['sessionOut'])) {
  if (isset($_SESSION['session'])) {
    $table = $_SESSION['session'];
    echo "Running Session!";
    unset($_SESSION['session']);
    // header('location:' . $environment . 'index.php');
  } else {
    $table = 0;
  }

  $sqlCheck = "SELECT * FROM sessions WHERE session_location_id = '$table' AND session_closed = '0'";
  $result = mysqli_query($link, $sqlCheck);
  if (mysqli_num_rows($result) != 0) {
    while($row = mysqli_fetch_array($result)) {
      $sessionID = $row['session_id'];
      echo "<p>Found One!</p>";
      echo $sessionID;
    }
  } else {
    echo "<p>No matching session found.</p>";
  }
}

// Forced Logout
if (isset($_POST['sessionOutForced'])) {
  unset($_SESSION['session']);
  header('location:' . $environment . 'index.php');
}
?>

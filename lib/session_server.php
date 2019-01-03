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
      // Create a session
      $session->createSessionDB($link,$table);
    }
    // Change the page.
    header('location:' . $environment . 'index.php');
  }
}

// Logout
if (isset($_POST['sessionOut'])) {
  // If there is a session.
  if (isset($_SESSION['session'])) {
    // Map variables.
    $table = $_SESSION['session'];
    // Run SQL
    $sqlCheck = "SELECT * FROM sessions WHERE session_location_id = '$table' AND session_closed = '0'";
    $result = mysqli_query($link, $sqlCheck);
    // Count results.
    if (mysqli_num_rows($result) != 0) {
      while($row = mysqli_fetch_array($result)) {
        $sessionID = $row['session_id'];
        if (mysqli_query($link, "UPDATE sessions SET session_closed = '1' WHERE session_id = '$sessionID'")) {
          // Record updated and session closed.
          $_SESSION['message'] = "<p class='alert alert-success'>Record updated successfully</p>";
          // Remove session Session and change the page.
          unset($_SESSION['session']);
          header('location:' . $environment . 'index.php');
        } else {
          // Error Message.
          $_SESSION['message'] = "<p class='alert alert-danger'>ERROR: " . mysqli_error($link) . "</p>";
          unset($_SESSION['session']);
          header('location:' . $environment . 'index.php');
        }
      }
    } else {
      // No sessions found.
      $_SESSION['message'] = "<p class='alert alert-info'>No matching session found.</p>";
      unset($_SESSION['session']);
      header('location:' . $environment . 'index.php');
    }
  } else {
    $table = 0;
  }
}

// Forced Logout
if (isset($_POST['sessionOutForced'])) {
  unset($_SESSION['session']);
  header('location:' . $environment . 'index.php');
}
?>

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
    $sessionID = $_SESSION['session'];
    // Run SQL
    // Check to see if session id matches and session is not closed.
    $sqlCheck = "SELECT * FROM sessions WHERE session_id = '$sessionID' AND session_closed = '0'";
    $result = mysqli_query($link, $sqlCheck);
    // Count results.
    // If results do not equal 0.
    if (mysqli_num_rows($result) != 0) {
      // For each result in the array.
      while($row = mysqli_fetch_array($result)) {
        // Map session to variable.
        // Generate current timestamp.
        $sessionID = $row['session_id'];
        $timestamp = date('Y-m-d G:i:s');
        // Run SQL
        if (mysqli_query($link, "UPDATE sessions SET session_end = '$timestamp', session_closed = '1' WHERE session_id = '$sessionID'")) {
          // Record updated and session closed.
          $_SESSION['message'] = "<p class='alert alert-success'>Record updated successfully</p>";
          // Remove session Session and change the page.
          unset($_SESSION['session']);
          header('location:' . $environment . 'index.php');
        } else {
          // Error Message.
          $_SESSION['message'] = "<p class='alert alert-danger'>ERROR: " . mysqli_error($link) . "</p>";
          // Remove session Session and change the page.
          unset($_SESSION['session']);
          header('location:' . $environment . 'index.php');
        }
      }
    } else {
      // No sessions found.
      $_SESSION['message'] = "<p class='alert alert-info'>No matching session found.</p>";
      // Remove session Session and change the page.
      unset($_SESSION['session']);
      header('location:' . $environment . 'index.php');
    }
  } else {
    $table = 0;
  }
}

// Force Logout Session
if (isset($_GET['forceClose'])) {
  $sessionID = $_GET['forceClose'];
  $timestamp = date('Y-m-d G:i:s');
  // Run SQL
  if (mysqli_query($link, "UPDATE sessions SET session_end = '$timestamp', session_closed = '1' WHERE session_id = '$sessionID'")) {
    // Record updated and session closed.
    $_SESSION['message'] = "<p class='alert alert-success'>Record updated successfully</p>";
    // Remove session Session and change the page.
    unset($_SESSION['session']);
    header('location:' . $environment . 'index.php');
  } else {
    // Error Message.
    $_SESSION['message'] = "<p class='alert alert-danger'>ERROR: " . mysqli_error($link) . "</p>";
    // Remove session Session and change the page.
    unset($_SESSION['session']);
    header('location:' . $environment . 'index.php');
  }
}
?>

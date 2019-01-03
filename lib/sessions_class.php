<?php
/**
 * Sessions
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");

class Session
{
  private $sessionID;
  private $sessionTable;

  // Constructor
  function __construct($sessionTable)
  {
    $this->sessionTable = $sessionTable;
  }

  // Destroy the Session.
  function destroySessionSession($link) {
    $sqlCheck = "SELECT * FROM sessions
    WHERE session_location_id = '$sessionTable'
    AND session_closed = '0'";
    $result = mysqli_query($link, $sqlCheck);

    if (mysqli_num_rows($result) != 0) {
      echo "<p>There is already a session.</p>";
    } else {

      // Error catch
      if (!$result) {
          echo "<p>New record created successfully</p>";
          $_SESSION['session'] = $sessionTable;
          echo "<p style='color: green;'>Session was set.</p>";
      } else {
          echo "<p>Error: " . mysqli_error($link) . "</p>";
      }
    }

    // Unset the session
    unset($_SESSION['session']);

    echo "<p style='color: red;'>Session was destroyed.</p>";
  }

  // Count Number of Sessions
  function countSession($link) {
    // Count Sessions
    $query = "SELECT COUNT(*) FROM sessions";
    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_row($result);

    $count = $rows[0];

    if ($count == '') {
      $count = 'ERROR';
    }
    $_SESSION['message'] = "<p class='alert alert-info'>Number of Sessions: " . $count . "</p>";
  }

  // Add Session to database.
  function createSessionDB($link,$sessionTable) {
    $sqlCheck = "SELECT * FROM sessions WHERE  session_location_id = '$sessionTable' AND session_closed = '0'";
    $result = mysqli_query($link, $sqlCheck);
    if (mysqli_num_rows($result) != 0) {
      $_SESSION['message'] = "<p class='alert alert-info'>There is already a session.</p>";
    } else {
      $sqlAdd = "INSERT INTO sessions (session_location_id) VALUES ($sessionTable)";
      if (mysqli_query($link, $sqlAdd)) {
        $last_id = mysqli_insert_id($link);
        $_SESSION['message'] = "<p class='alert alert-success'>New Session Created. ({$last_id})</p>";
        $_SESSION['session'] = $last_id;
      } else {
        $_SESSION['message'] = "<p class='alert alert-danger'>ERROR: " . mysqli_error($link) . "</p>";
      }
    }
  }

  // Count number of closed sessions.
  function countSessionClosed($link) {
    // Count Types
    $query = "SELECT COUNT(*) FROM sessions
    WHERE session_closed = 1";
    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_row($result);

    $count = $rows[0];

    // Error catch
    if (!$result) {
        echo "<p>Error: " . mysqli_error($link) . "</p>";
    }
    echo "<p>Number of Sessions Closed: " . $count . "</p>";
  }
}
?>

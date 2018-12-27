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
      echo "There is already a session. </br>";
    } else {

      // Error catch
      if (!$result) {
          echo "New record created successfully </br>";
          $_SESSION['session'] = $sessionTable;
          echo "<p style='color: green;'>Session was set.</p>";
      } else {
          echo "Error: " . mysqli_error($link);
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
    echo "Number of Sessions: " . $count . "</br>";
  }

  // Add Session to database.
  function createSessionDB($link,$sessionTable) {
    $sqlCheck = "SELECT * FROM sessions
    WHERE session_location_id = '$sessionTable'
    AND session_closed = '0'";
    $result = mysqli_query($link, $sqlCheck);

    if (mysqli_num_rows($result) != 0) {
      echo "There is already a session. </br>";
    } else {

      // Error catch
      if (!$result) {
          echo "Error: " . mysqli_error($link) . " </br>";
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
        echo "Error: " . mysqli_error($link) . " </br>";
    }
    echo "Number of Sessions Closed: " . $count . "</br>";
  }
}
?>

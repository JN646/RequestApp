<?php
/**
 * Sessions
 */
include '../config/db_config.php';

class Session
{
  private $sessionID;
  private $sessionActive;
  private $sessionTable;

  // Constructor
  function __construct($sessionID,$sessionActive,$sessionTable)
  {
    $this->sessionID = $sessionID;
    $this->sessionActive = $sessionActive;
    $this->sessionTable = $sessionTable;
  }

  // Destroy the Session.
  function destroySessionSession() {
    unset($_SESSION['session']);

    echo "<p style='color: red;'>Session was destroyed.</p>";
  }

  // Count Number of Sessions
  function countSession($link) {
    // Count Types
    $query = "SELECT COUNT(*) FROM sessions";

    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_row($result);

    $count = $rows[0];

    if ($count == '') {
      $count = 'ERROR';
    }

    // Return Value.
    echo "Number of Sessions: " . $count . "</br>";
  }

  // Add Session to database.
  function createSessionDB($link,$sessionTable) {
    $sqlCheck = "SELECT * FROM sessions WHERE  session_location_id = '$sessionTable' AND session_closed = '0'";
    $result = mysqli_query($link, $sqlCheck);

    if (mysqli_num_rows($result) != 0) {
      echo "There is already a session. </br>";
    } else {
      $sqlAdd = "INSERT INTO sessions (session_location_id) VALUES ($sessionTable)";

      // Error catch
      if (mysqli_query($link, $sqlAdd)) {
          echo "New record created successfully </br>";
          $_SESSION['session'] = $sessionTable;
          echo "<p style='color: green;'>Session was set.</p>";
      } else {
          echo "Error: " . $sqlAdd . "<br>" . mysqli_error($link);
      }
    }

    mysqli_close($link);
  }

  // Count number of closed sessions.
  function countSessionClosed($link) {
    // Count Types
    $query = "SELECT COUNT(*) FROM sessions WHERE session_closed = 1 AND session_location_id = '$sessionTable'";

    $result = mysqli_query($link, $query);
    $rows = mysqli_fetch_row($result);

    $count = $rows[0];

    if ($count == '') {
      $count = 'ERROR';
    }

    // Return Value.
    echo "Number of Sessions Closed: " . $count . "</br>";
  }
}
?>

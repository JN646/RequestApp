<?php
/**
 * Sessions
 */
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");

class Session {
  private $sessionID;
  private $sessionTable;

  // Constructor
  function __construct($sessionTable) {
    $this->sessionTable = $sessionTable;
  }

  // Destroy the Session.
  function destroySession($link) {
  }

  // Add Session to database.
  function createSessionDB($link,$sessionTable) {
    // SQL check if session is running and if it is closed.
    $result = mysqli_query($link, "SELECT * FROM sessions WHERE  session_location_id = '$sessionTable' AND session_closed = '0'");

    // If there are results.
    if (mysqli_num_rows($result) != 0) {
      // There is already a session.
      $_SESSION['message'] = "<p class='alert alert-info'>There is already a session.</p>";
    } else {
      // If there are no results.
      if (mysqli_query($link, "INSERT INTO sessions (session_location_id) VALUES ($sessionTable)")) {
        // Get the last insert ID number.
        $last_id = mysqli_insert_id($link);
        $_SESSION['message'] = "<p class='alert alert-success'>New Session Created. ({$last_id})</p>";
        // Set the session ID as the last SQL IF number.
        $_SESSION['session'] = $last_id;
      } else {
        // If the insert fails to create a new session.
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
}
?>

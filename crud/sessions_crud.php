<!-- Header Partial -->
<?php include_once '../partials/_header.php' ?>

<?php
// Start Session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!-- Container -->
<div id='bodyContainer' class='container'>
  <br>
  <div class='col-md-12'>
    <!-- Notification Block -->
    <?php if (isset($_SESSION['message'])): ?>
      <div class="msg">
        <?php echo $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?>
      </div>
    <?php endif ?>

      <!-- Header -->
      <h1>Sessions</h1>
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>
      <p>This is the sessions management pane. You can use this page to close any existing sesisons that are running.</p>

      <?php
      function timeElapsed($sessionStart, $sessionEnd, $sessionClosed) {
        if ($sessionStart != NULL) {
          // Variables
          $start_date = new DateTime($sessionStart);
          $timestamp = date('Y-m-d G:i:s');

          // Has the session ended?
          // Session is currently running.
          if ($sessionClosed == 0 && $sessionEnd === NULL) {
            $since_start = $start_date->diff(new DateTime($timestamp));
          }

          // The session has ended and there is an end time recorded.
          if ($sessionClosed == 1 && $sessionEnd !== NULL) {
            $since_start = $start_date->diff(new DateTime($sessionEnd));
          }

          // The session has ended but no End time has been set.
          if ($sessionClosed == 1 && $sessionEnd === NULL) {
            return "N/A";
          } else {
            return $since_start->d . 'd ' . $since_start->h . 'h ' . $since_start->i . 'm';
          }
          // echo $since_start->days.' days total<br>';
          // echo $since_start->y.' years<br>';
          // echo $since_start->m.' months<br>';
          // echo $since_start->d.' days<br>';
          // echo $since_start->h.' hours<br>';
          // echo $since_start->i.' minutes<br>';
          // echo $since_start->s.' seconds<br>';
        }
      }

      // ACTIVE RESULTS
      $activesql = "SELECT * FROM sessions
      INNER JOIN locations ON sessions.session_location_id=locations.location_id
      ORDER BY session_start ASC";
      if ($result = mysqli_query($link, $activesql)) {
          if (mysqli_num_rows($result) > 0) {
              ?>
      <table id='resultTable' class='table table-sm table-bordered'>
        <thead class="thead-dark">
          <tr>
            <th class='text-center'>ID</th>
            <th class='text-center'>Location</th>
            <th class='text-center'>Start</th>
            <th class='text-center'>End</th>
            <th class='text-center'>Dur</th>
            <th class='text-center'>Paid</th>
            <th class='text-center'>Closed</th>
            <th class='text-center'>Actions</th>
          </tr>
        </thead>
        <?php
            while ($row = mysqli_fetch_array($result)) {
              $sessionID = $row['session_id'];
              $sessionStart = $row['session_start'];
              $sessionEnd = $row['session_end'];
              $sessionEndTime = date("H:m:s m/d/Y", strtotime($sessionEnd));
              $sessionPaid = $row['session_paid'];
              $sessionClosed = $row['session_closed'];
              $sessionLocation = $row['location_name'];

                // Draw Table.
                echo "<tbody>";
                  echo "<tr>";

                    // Session ID?
                    echo "<td class='text-center'>{$sessionID}</td>";

                    // Session Location?
                    echo "<td class='text-center'>{$sessionLocation}</td>";

                    // Session Start?
                    echo "<td>" . date("H:m:s - m/d/Y", strtotime($sessionStart)) . "</td>";

                    // Has the session ended?
                    // The session has ended but no End time has been set.
                    if ($sessionClosed == 1 && $sessionEnd === NULL) {
                      echo "<td class='text-center'>N/A</td>";
                    }

                    // Session is currently running.
                    if ($sessionClosed == 0 && $sessionEnd === NULL) {
                      echo "<td class='text-center' style='color: green;'>Session Running</td>";
                    }

                    // The session has ended and there is an end time recorded.
                    if ($sessionClosed == 1 && $sessionEnd !== NULL) {
                      echo "<td class='text-center'>{$sessionEndTime}</td>";
                    }

                    // Display the duration of the session.
                    if (false) {
                      echo "<td class='text-center'>" . timeElapsed($sessionStart, $sessionEndTime, $sessionClosed) . "</td>";
                    } else {
                      echo "<td></td>";
                    }

                    // Session Paid?
                    if ($sessionPaid == 1) {
                      echo "<td class='text-center'><i class='fas fa-check'></i></td>";
                    } else {
                      echo "<td></td>";
                    }

                    // Session Closed?
                    if ($sessionClosed == 1) {
                      echo "<td class='text-center'><i class='fas fa-check'></i></td>";
                    } else {
                      echo "<td></td>";
                    }

                    // Session Force Close.
                    if ($sessionClosed == 0 && $sessionEnd === NULL) {
                      echo "<td class='text-center'><a href='../lib/session_server.php?forceClose={$sessionID}'><i class='fas fa-times-circle'></i></a></td>";
                    } else {
                      echo "<td></td>";
                    }

                  echo "</tr>";
                echo "</tbody>";
            }
              echo "</table>";

              // Free result set
              mysqli_free_result($result);
          } else {
              echo "<p class='alert alert-info'>No sessions were found.</p>";
          }
      } else {
          echo "<p class='alert alert-info'>" . SQLError($link) . "</p>";
      } ?>
    </div>
</div>
<?php include '../partials/_footer.php'; ?>

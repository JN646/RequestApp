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
      <p>This is the sessions management pane.</p>

      <?php
      function timeElapsed($sessionStart) {
        $delta_time = time() - strtotime($sessionStart);
        $hours = floor($delta_time / 3600);
        $delta_time %= 3600;
        $minutes = floor($delta_time / 60);

        return "{$hours}H {$minutes}m";
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
              $sessionEndTime = date("H:m:s - m/d/Y", strtotime($sessionEnd));
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
                    echo "<td class='text-center'>" . timeElapsed($sessionStart) . "</td>";

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

                    if ($sessionClosed == 0 && $sessionEnd === NULL) {
                      echo "<td class='text-center'><a href='../lib/session_server.php?forceClose={$sessionID}'>Close</a>
                      </td>";
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

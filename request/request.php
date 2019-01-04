<!-- Load Header -->
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>

<!-- Start the session -->
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<?php isSessionSet('not', 'lib/sessionselect.php'); ?>

<?php
//############## Is Session Active Requests ####################################
function isSessionsActive($link, $sessionID) {
	$query = "SELECT * FROM sessions
	WHERE session_id='$sessionID' AND session_closed = 0";

	// Run Query.
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_array($result);
	$sessionNumber = $row['session_id'];
	$sessionEnd = $row['session_end'];

  if ($sessionEnd === NULL) {
    $sessionEnd == 'No End Time';
  }

	if ($sessionID == $sessionNumber) {
		return "<td class='text-center' title='Still Active!'>{$sessionID}</td>";
	} else {
		return "<td class='text-center' style='color: red;' title={$sessionEnd}>{$sessionID}</td>";
	}
}
?>

<body>
<div class="container">
  <br>
  <div class="col-md-12">
    <!-- Notification Block -->
    <?php if (isset($_SESSION['message'])): ?>
      <div class="msg">
        <?php echo $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?>
      </div>
    <?php endif ?>

    <h2>Request Index</h2>

    <!-- Debug Nav -->
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>

    <br>

    <?php
    // SQL
    $activesql = "SELECT * FROM transaction_log
    INNER JOIN items ON transaction_log.trans_item_id=items.item_id
    INNER JOIN types ON transaction_log.trans_type_id=types.type_id
    INNER JOIN sessions ON sessions.session_id=transaction_log.trans_session_id
    ORDER BY trans_time DESC";

    if ($result = mysqli_query($link, $activesql)) {
        if (mysqli_num_rows($result) > 0) {
    ?>

    <!-- Results Table -->
    <table id='resultTable' class='table table-sm table-bordered'>
      <thead class="thead-dark">
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>Session</th>
          <th class='text-center'>Item</th>
          <th class='text-center'>Type</th>
          <th class='text-center'>Time</th>
          <th class='text-center'>Closed</th>
          <th class='text-center'>Delivered</th>
          <th class='text-center' colspan="3">Action</th>
        </tr>
      </thead>
      <?php
          while ($row = mysqli_fetch_array($result)) {
            // Map Variables
            $transID = $row['trans_id'];
            $transSession = $row['trans_session_id'];
            $transItemID = $row['trans_id'];
            $transItem = $row['item_name'];
            $transType = $row['type_name'];
            $transTypeIcon = $row['type_icon'];
            $transTime = $row['trans_time'];
            $transDelivered = $row['trans_delivered'];
            $sessionID = $row['session_id'];
            $sessionClosed = $row['session_closed'];

              // Draw Table.
              echo "<tbody>";
                echo "<tr>";
                  echo "<td class='text-center'>{$transID}</td>";

                  // Display Session Information.
                  if ($transSession != '') {
                    if ($transSession != 0) {
                      echo isSessionsActive($link, $transSession);
                    } else {
                      echo "<td class='text-center'>Error</td>";
                    }
                  } else {
                    echo "<td class='text-center'>No Session</td>";
                  }

                  echo "<td>{$transItem}</td>";
                  echo "<td>{$transTypeIcon} {$transType}</td>";
                  echo "<td>" . date("H:m:s - m/d/Y", strtotime($transTime)) . "</td>";

                  if ($transSession == $sessionID) {
                    echo "<td id='rowSessionClosed' class='text-center'>{$sessionClosed}</td>";
                  } else {
                    echo "<td id='rowSessionClosed' class='text-center'>N/A</td>";
                  }

                  // Item been delivered?
                  if ($sessionClosed == 0) {
                    if ($transDelivered != 0 || $transDelivered != 1) {
                      if ($transDelivered == 1) {
                        echo "<td id='rowItemDelivered' class='text-center text-green'><i class='fas fa-check'></i></td>";
                      } else if ($transDelivered == 0) {
                        echo "<td id='rowItemDelivered'></td>";
                      }

                      if ($transDelivered == 0) {
                        echo "<td id='rowItemDeliveredAction' class='text-center'><a href='../crud/server.php?delivered={$transItemID}' class='view_btn'><i class='fas fa-truck'></i></a></td>";
                      } else if ($transDelivered == 1) {
                        echo "<td id='rowItemDeliveredAction'></td>";
                      }
                    } else {
                      echo "<td id='rowItemDeliveredAction' class='text-red'>Error</td>";
                    }
                  } else {
                    echo "<td id='rowItemDeliveredAction'></td>";
                    echo "<td id='rowItemDeliveredAction'></td>";
                  }

                  // Action Buttons
                  echo "<td class='text-center'></td>";
                  echo "<td class='text-center'></td>";
                echo "</tr>";
              echo "</tbody>";
          }
            echo "</table>";

            // Free result set
            mysqli_free_result($result);
        } else {
            echo "<p class='alert alert-info'>No items were found.</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>ERROR: " . SQLError($link) . "</p>";
    } ?>
  </div>
</div>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

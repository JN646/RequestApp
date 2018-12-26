<!-- Load Header -->
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>

<!-- Start the session -->
<?php session_start(); ?>

<?php
if (!isset($_SESSION['session'])) {
  header('location:' . $environment . 'lib/sessionselect.php');
}
?>

<body>
<div class="container">
  <br>
  <div class="col-md-12">
    <!-- Notification Block -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
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

              // Draw Table.
              echo "<tbody>";
                echo "<tr>";
                  echo "<td class='text-center'>" . $transID . "</td>";

                  // Display Session Information.
                  if ($transSession != '') {
                    // If Session <= 0.
                    if ($transSession != 0) {
                      // Show Session Value.
                      echo "<td class='text-center'>" . $transSession . "</td>";
                    } else {
                      // Show Error Message.
                      echo "<td class='text-center'>Error</td>";
                    }
                  } else {
                    // No active Session.
                    echo "<td class='text-center'>No Session</td>";
                  }

                  echo "<td>" . $transItem . "</td>";
                  echo "<td>" . $transTypeIcon . " " . $transType . "</td>";
                  echo "<td>" . date("H:m:s - m/d/Y", strtotime($transTime)) . "</td>";
                  echo "<td class='text-center'>" . $transDelivered . "</td>";

                  // Hide Deliver Button.
                  if ($transDelivered != 0 || $transDelivered != 1) {
                    if ($transDelivered == 0) {
                      // If item has not been delivered.
                      echo "<td class='text-center'><a href='../crud/server.php?delivered=" . $transItemID . "' class='view_btn'><i class='fas fa-truck'></i></a></td>";
                    } else if ($transDelivered == 1) {
                      // If item has been delivered.
                      echo "<td></td>";
                    }
                  } else {
                    // Show Error Message
                    echo "<td class='text-red'>Error</td>";
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
</body>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

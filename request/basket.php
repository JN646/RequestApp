<!-- Load Header -->
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>

<?php
// Start Session.
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

isSessionSet('not','../lib/sessionselect.php');

// Set session ID to variable.
$sessionID = $_SESSION['session'];
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

    <h2>Basket</h2>

    <!-- Debug Nav -->
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>

    <br>

    <?php
    // Get current item listings from session.
    $activesql = "SELECT * FROM transaction_log
    INNER JOIN items ON transaction_log.trans_item_id=items.item_id
    INNER JOIN types ON transaction_log.trans_type_id=types.type_id
    -- INNER JOIN sessions ON sessions.session_location_id=transaction_log.trans_session_id
    WHERE transaction_log.trans_session_id = '$sessionID'
    ORDER BY items.item_type, items.item_name DESC";

    // Catch multiple sessions.
    $sessionResult = mysqli_query($link, "SELECT * FROM sessions WHERE session_id = '$sessionID'");
    if (mysqli_num_rows($sessionResult) == 1) {
      $row = mysqli_fetch_array($sessionResult);
    } else {
      echo "<p class='alert alert-danger'>FATAL: Multiple sessions found!</p>";
    }

    // Get Prices
    $priceTotal = countPriceTotals($link, $sessionID);
    $vatPrice = calVAT($priceTotal, $VAT);

    // Run
    if ($result = mysqli_query($link, $activesql)) {
        if (mysqli_num_rows($result) > 0) {
          echo "<h2>Session {$_SESSION['session']}</h2>";
          echo "<p>";
            echo "<span>Start Time: </span> - <span>{$row['session_start']}</span>";
          echo "</p>";
    ?>

    <!-- Results Table -->
    <table id='resultTable' class='table table-sm table-bordered'>
      <thead class="thead-dark">
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>Item</th>
          <th class='text-center'>Type</th>
          <th class='text-center' colspan='2'>Time</th>
          <th class='text-center'>Delivered</th>
          <th class='text-center'>Price</th>
        </tr>
      </thead>
      <?php
          while ($row = mysqli_fetch_array($result)) {
            // Map Variables
            $itemID = $row['item_id'];
            $transID = $row['trans_id'];
            $transSession = $row['trans_session_id'];
            $transItemID = $row['trans_id'];
            $transItem = $row['item_name'];
            $itemPrice= $row['item_price'];
            $transType = $row['type_name'];
            $transTypeIcon = $row['type_icon'];
            $transTime = $row['trans_time'];
            $transDelivered = $row['trans_delivered'];

              // Draw Table.
              echo "<tbody>";
                echo "<tr>";
                  echo "<td class='text-center'>{$transID}</td>";
                  echo "<td><a href='../crud/view.php?id={$itemID}'>{$transItem}</a></td>";
                  echo "<td>{$transTypeIcon} {$transType}</td>";
                  echo "<td>" . date("d/m/Y", strtotime($transTime)) . "</td>";
                  echo "<td>" . date("H:m:s", strtotime($transTime)) . "</td>";

                  // Item been delivered?
                  if ($transDelivered != 0 || $transDelivered != 1) {
                    if ($transDelivered == 1) {
                      echo "<td class='text-center text-green'><i class='fas fa-check'></i></td>";
                    } else if ($transDelivered == 0) {
                      echo "<td class='text-center'><a href='#'>Edit</a></td>";
                    }
                  } else {
                    echo "<td class='text-center text-red'>Error</td>";
                  }

                  // Is the price a negative number? or is the item free?
                  if ($itemPrice < 0.00) {
                    echo "<td class='text-center text-red'>{$currencySymb}{$itemPrice}</td>";
                  } else if ($itemPrice == 0.00) {
                    echo "<td class='text-center text-green'>FREE!</td>";
                  } else {
                    echo "<td class='text-center'>{$currencySymb}{$itemPrice}</td>";
                  }

                echo "</tr>";
              echo "</tbody>";
          }
              // Table Footer
              echo "<tfooter>";
                // Sub Total
                echo "<tr>";
                  echo "<td colspan='5' rowspan='3'></td>";
                  echo "<td class='text-center'><strong>Sub Total:</strong></td>";
                  echo "<td class='text-center'>" . $currencySymb . ($priceTotal - $vatPrice) . "</td>";
                echo "</tr>";

                // VAT
                echo "<tr>";
                  echo "<td class='text-center'><strong>VAT:</strong></td>";
                  echo "<td class='text-center'>{$currencySymb}{$vatPrice}</td>";
                echo "</tr>";

                // Total
                echo "<tr>";
                  echo "<td class='text-center'><strong>Total:</strong></td>";
                  echo "<td class='text-center'>{$currencySymb}{$priceTotal}</td>";
                echo "</tr>";
              echo "</tfooter>";
            echo "</table>";

            // Free result set
            mysqli_free_result($result);
        } else {
            echo "<p class='alert alert-info'>No items were found.</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>ERROR: " . mysqli_error($link) . "</p>";
    } ?>

    <div>
      <h3>Finished Ordering?</h3>
      <p>If you have finished your session, press the button below to request your bill.</p>
      <form class="" action="#" method="post">
        <button class='btn btn-primary' type="button" name="closeSession" data-toggle="modal" data-target="#closeSession">Close Session</button>
      </form>
    </div>

  </div>
</div>

<!-- Close Session -->
<div class="modal fade" id="closeSession" tabindex="-1" role="dialog" aria-labelledby="closeSession" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Close the session?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Close the Session</button>
      </div>
    </div>
  </div>
</div>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

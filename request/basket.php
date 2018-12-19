<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>

<?php session_start(); ?>

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

    <h2>Basket</h2>

    <!-- Debug Nav -->
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>

    <br>

    <?php
    $sessionID = 1;

    // SQL
    $activesql = "SELECT * FROM transaction_log
    INNER JOIN items ON transaction_log.trans_item_id=items.item_id
    INNER JOIN types ON transaction_log.trans_type_id=types.type_id WHERE trans_session_id = '$sessionID' ORDER BY item_type, item_name DESC";
    if ($result = mysqli_query($link, $activesql)) {
        if (mysqli_num_rows($result) > 0) {
    ?>

    <h2>Session <?php echo $sessionID ?></h2>

    <!-- Results Table -->
    <table id='resultTable' class='table table-sm table-bordered'>
      <thead class="thead-dark">
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>Item</th>
          <th class='text-center'>Type</th>
          <th class='text-center'>Time</th>
          <th class='text-center'>Delivered</th>
          <th class='text-center'>Price</th>
        </tr>
      </thead>
      <?php
          while ($row = mysqli_fetch_array($result)) {
            // Map Variables
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
                  echo "<td class='text-center'>" . $transID . "</td>";
                  echo "<td>" . $transItem . "</td>";
                  echo "<td>" . $transTypeIcon . " " . $transType . "</td>";
                  echo "<td>" . date("H:m:s - d/m/Y", strtotime($transTime)) . "</td>";

                  if ($transDelivered == 1) {
                    echo "<td class='text-center'>" . $transDelivered . "</td>";
                  } else if ($transDelivered == 0) {
                    echo "<td class='text-center'><a href='#'>Edit</a></td>";
                  }

                  // Action Buttons
                  echo "<td class='text-center'>£" . $itemPrice . "</td>";
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
        SQLError($link);
    } ?>

  </div>
</div>
</body>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

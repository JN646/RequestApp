<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>

<?php session_start(); ?>

<body>
<div class="fluid-container">
  <br>
  <div class="col-md-12">
    <h2>Request Index</h2>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href='../crud/index.php'>CRUD</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href='../config/admin.php'>Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href='request/request.php'>Request Home</a>
      </li>
    </ul>

    <br>

    <?php
    // ACTIVE RESULTS
    $activesql = "SELECT * FROM transaction_log";
    if ($result = mysqli_query($link, $activesql)) {
        if (mysqli_num_rows($result) > 0) {
            ?>
    <table id='resultTable' class='table table-bordered'>
      <thead class="thead-dark">
        <tr>
          <th class='text-center'>ID</th>
          <th class='text-center'>Session</th>
          <th class='text-center'>Item</th>
          <th class='text-center'>Type</th>
          <th class='text-center'>Time</th>
          <th class='text-center' colspan="3">Action</th>
        </tr>
      </thead>
      <?php
          while ($row = mysqli_fetch_array($result)) {
            $transID = $row['trans_id'];
            $transSession = $row['trans_session_id'];
            $transItem = $row['trans_item_id'];
            $transType = $row['trans_type_id'];
            $transTime = $row['trans_time'];

              // Draw Table.
              echo "<tbody>";
                echo "<tr>";
                  echo "<td class='text-center'>" . $transID . "</td>";
                  echo "<td>" . $transSession . "</td>";
                  echo "<td>" . $transItem . "</td>";
                  echo "<td>" . $transType . "</td>";
                  echo "<td>" . $transTime . "</td>";
                  echo "<td class='text-center'></td>";
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
        SQLError($link);
    } ?>

  </div>
</div>
</body>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

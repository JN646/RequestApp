<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");
$q = intval($_GET['q']);

if (!$link) {
  die('Could not connect: ' . mysqli_error($link));
}

// Display Type Debug
if ($_SESSION['viewMode'] == '') {
  $displayType = 2;
} else {
  $displayType = $_SESSION['viewMode'];
}

// List
if ($displayType == 1) {
  mysqli_select_db($link,"ajax_demo");
  $sql="SELECT * FROM items WHERE item_type = '".$q."' ORDER BY item_name ASC";
  $result = mysqli_query($link,$sql);
  echo "<table class='table table-bordered'>
    <tr>
      <th width='64px'>Image</th>
      <th>Name</th>
      <th>Type</th>
      <th width='50px'>Request</th>
    </tr>";
  while($row = mysqli_fetch_array($result)) {
    if ($row['item_image'] == '') {
      $row['item_image'] = 'missing.jpg';
    }
    echo "<tr>";
      echo "<td class='align-middle'><img class='listImage' src='images/" . $row['item_image'] . "' height='64px' width'64px'</td>";
      echo "<td class='align-middle'>" . $row['item_name'] . "</td>";
      echo "<td class='align-middle'>" . $row['item_type'] . "</td>";

      // Is item active?
      if ($row['item_active'] == 1) {
        echo "<td class='align-middle text-center'><a href='#'><i class='fas fa-plus'></i></a></td>";
      } else {
        echo "<td></td>";
      }
    echo "</tr>";
  }
  echo "</table>";
  mysqli_close($link);
}

// Grid
if ($displayType == 2) {
  mysqli_select_db($link,"ajax_demo");
  $sql="SELECT * FROM items WHERE item_type = '".$q."' ORDER BY item_name ASC";
  $result = mysqli_query($link,$sql);
  echo "<div class='row'</div>";
  while($row = mysqli_fetch_array($result)) {
    if ($row['item_image'] == '') {
      $row['item_image'] = 'missing.jpg';
    }

    echo "<div class='gridCard card col-md-2'>";
      echo "<img class='gridImage card-img-top' src='images/" . $row['item_image'] . "' alt='" . $row['item_name'] . "'>";
      echo "<div class='card-body'>";
        echo "<h5 class='card-title text-center'>" . $row['item_name'] . "</h5>";
        // echo "<p class='card-text'>Some quick example text to build on the card title and make up the bulk of the cards content.</p>";

        // Is item active?
        if ($row['item_active'] == 1) {
          echo "<a href='#' class='btn btn-primary text-center'><i class='fas fa-plus'></i></a>";
        } else {
          echo "";
        }

      echo "</div>";
    echo "</div>";
  }
  echo "</table>";
  mysqli_close($link);
}
echo "</div>";
?>

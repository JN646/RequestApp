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
}

// Grid
if ($displayType == 2) {
  if ($q != 0) {
    mysqli_select_db($link,"ajax_demo");
    $sql="SELECT * FROM items WHERE item_type = '".$q."' ORDER BY item_name ASC";
    $result = mysqli_query($link,$sql);
    echo "<div class='row'</div>";
    while($row = mysqli_fetch_array($result)) {
      $itemImage = $row['item_image'];
      $itemName = $row['item_name'];
      $itemID = $row['item_id'];

      if ($itemImage == '') {
        $itemImage = 'missing.jpg';
      }

      echo "<div class='gridCard col-md-2 py-2'>";
        echo "<div class='gridCardInner col-md-12 card border'>";
        // echo "<div class='card-header'>Header</div>";
        echo "<a href='crud/view.php?id=" . $itemID . "'>";
          echo "<img class='gridImage card-img-top' src='images/" . $itemImage . "' alt='" . $itemName . "'>";
        echo "</a>";
          echo "<div class='card-body'>";
            echo "<h5 class='card-title text-center'>" . $itemName . "</h5>";
            // echo "<p class='card-text'>Some quick example text to build on the card title and make up the bulk of the cards content.</p>";

            // Is item active?
            if ($row['item_active'] == 1) {
              echo "<a href='crud/server.php?request=" . $row['item_id'] . "' class='btn btn-primary text-center'><i class='fas fa-plus'></i></a>";
            } else {
              echo "";
            }
          echo "</div>";
        echo "</div>";
      echo "</div>";
    }
    mysqli_close($link);
  } else if ($q == 0) {
    echo "<div id='nothingSelected'>Use the dropdown above to select your category.</div>";
  }
}
echo "</div>";
?>

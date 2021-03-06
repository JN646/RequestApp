<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");
$q = intval($_GET['q']);

if (!$link) {
  die('Could not connect: ' . mysqli_error($link));
}

// Grid
if (true) {
  if ($q != 0) {
    mysqli_select_db($link,"ajax_demo");
    if ($showItemsActive == 0) {
      $sql="SELECT * FROM items WHERE item_type = '".$q."' ORDER BY item_name ASC";
    }
    if ($showItemsActive == 1) {
      $sql="SELECT * FROM items WHERE item_type = '".$q."' AND item_active = 1 ORDER BY item_name ASC";
    }
    $result = mysqli_query($link,$sql);
    echo "<div class='row'</div>";
    while($row = mysqli_fetch_array($result)) {
      $itemImage = $row['item_image'];
      $itemName = $row['item_name'];
      $itemPrice = $row['item_price'];
      $itemID = $row['item_id'];
      $itemActive = $row['item_active'];

      if ($itemImage == '') {
        $itemImage = 'missing.jpg';
      }

      echo "<div class='gridCard col-sm-4 col-md-3 col-lg-2 py-2'>";
        echo "<div class='gridCardInner col-md-12 card border'>";
        // echo "<div class='card-header'>Header</div>";
        echo "<a href='crud/view.php?id={$itemID}'>";
          echo "<img class='gridImage card-img-top' src='images/{$itemImage}' alt='{$itemName}'>";
        echo "</a>";
          echo "<div class='card-body'>";
            echo "<h5 class='card-title text-center'>{$itemName}</h5>";

            // Is the price a negative number? or is the item free?
            if ($itemPrice < 0.00) {
              echo "<h5 class='card-title text-center text-red>{$currencySymb}{$itemPrice}</h5>";
            } else if ($itemPrice == 0.00) {
              echo "<h5 class='card-title text-center text-green'>FREE!</h5>";
            } else {
              echo "<h5 class='card-title text-center'>{$currencySymb}{$itemPrice}</h5>";
            }

            // Is item active?
            if ($itemActive == 1) {
              echo "<a href='crud/server.php?request={$itemID}' class='btn btn-primary text-center'><i class='fas fa-plus'></i></a>";
            } else {
              echo "<span class='text-muted text-center'>Not Available</span>";
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

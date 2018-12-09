<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");
$q = intval($_GET['q']);

if (!$link) {
  die('Could not connect: ' . mysqli_error($link));
}

mysqli_select_db($link,"ajax_demo");
$sql="SELECT * FROM items WHERE item_type = '".$q."' ORDER BY item_name ASC";
$result = mysqli_query($link,$sql);
echo "<table class='table table-bordered'>
  <tr>
    <th width='64px'>Image</th>
    <th>Name</th>
    <th>Type</th>
    <th>Request</th>
  </tr>";
while($row = mysqli_fetch_array($result)) {
  if ($row['item_image'] == '') {
    $row['item_image'] = 'missing.jpg';
  }
  echo "<tr>";
    echo "<td><img class='listImage' src='images/" . $row['item_image'] . "' height='64px' width'64px'</td>";
    echo "<td>" . $row['item_name'] . "</td>";
    echo "<td>" . $row['item_type'] . "</td>";

    // Is item active?
    if ($row['item_active'] == 1) {
      echo "<td><a href='#'>Request</a></td>";
    }
  echo "</tr>";
}
echo "</table>";
mysqli_close($link);
?>

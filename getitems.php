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
    <th>Name</th>
    <th>Type</th>
    <th>Request</th>
  </tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
    echo "<td>" . $row['item_name'] . "</td>";
    echo "<td>" . $row['item_type'] . "</td>";
    echo "<td><a href='#'>Request</a></td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($link);
?>

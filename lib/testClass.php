<head>
  <meta charset="utf-8">
  <title>Class Test</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style media="screen">
    body {
      font-family: sans-serif;
    }
  </style>
</head>
<?php
include 'items_class.php';
include '../config/db_config.php';

$sql = "SELECT * FROM items WHERE item_type = '5'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $objectName = "Person" . $row["item_id"];
      $objectName = new item($row["item_id"],$row["item_name"],$row["item_type"],$row["item_price"],$row["item_active"]);
      $objectName->isActive();
    }
} else {
    echo "0 results";
}
$conn->close();

// $pList = ['Bill Clinton','George HW Bush','George W Bush','Jimmy Carter','Barack Obama'];
// $pListNames = ['p1', 'p2', 'p3', 'p4', 'p5'];

// Create the people.
// $president41 = new item("George HW Bush","President","2.50","0");
// $president42 = new item("Bill Clinton","President","4.50","1");
// $president43 = new item("George W Bush","President","6.50","1");

// for ($i=0; $i < count($pList); $i++) {
//   $pListNames[$i] = new item($pList[$i],"President","2.50","1");
//   echo $pListNames[$i]->getName();
// }
//
// for ($i=0; $i < count($pList); $i++) {
//   $pListNames[$i] = new item($pList[$i],"President","2.50","1");
//   echo $pListNames[$i]->isActive();
// }

// echo $f->customize_print();
// Get the names of the people.
// echo $president41->getName();
// echo $president42->getName();
// echo $president43->getName();
//
// // Is the president active?
// echo $president43->isActive();
//
// // Reset the name.
// echo $president42->setName("This is a name change.");
?>

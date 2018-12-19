<?php
// Link to DB
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");

// Start Session
session_start();

// initialise variables
$name = $type = "";
$update = false;
$id = 0;

// Add
if (isset($_POST['save'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $type = dataTidy($_POST['type']);
  $imagePath = dataTidy($_POST['imagePath']);
  $price = dataTidy($_POST['price']);
  $schema = dataTidy($_POST['schema']);
  $notes = htmlspecialchars($_POST['notes'], ENT_QUOTES);
  $active = dataTidy($_POST['active']);
  $field1 = dataTidy($_POST['field1']);
  $field2 = dataTidy($_POST['field2']);
  $field3 = dataTidy($_POST['field3']);

  $itemSQL = mysqli_query($link, "INSERT INTO items (
    `item_name`,
    `item_type`,
    `item_image`,
    `item_active`,
    `item_price`,
    `item_schema`,
    `item_notes`,
    `item_f1`,
    `item_f2`,
    `item_f3`
  ) VALUES (
    '$name',
    '$type',
    '$imagePath',
    '$active',
    '$price',
    '$schema',
    '$notes',
    '$field1',
    '$field2',
    '$field3')"
  );

  if($itemSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Item Saved</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}

// Request
if (isset($_GET['request'])) {
  $id = $_GET['request'];

  // Get info from item database.
  $sql = "SELECT item_name, item_type FROM items WHERE item_id = $id";
  $result = mysqli_query($link, $sql);

  // If exists
  if ($result) {
    $item = mysqli_fetch_array($result);
    $itemName = $item['item_name'];
    $itemType = $item['item_type'];
  } else {
    $_SESSION['message'] = mysqli_error($link);
  }

  $transSQL = mysqli_query($link, "INSERT INTO transaction_log (
    `trans_session_id`,
    `trans_item_id`,
    `trans_type_id`
  ) VALUES (
    '1',
    '$id',
    '$itemType')"
  );

  if($transSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Item Requested</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}

// Edit
if (isset($_POST['update'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $type = dataTidy($_POST['type']);
  $imagePath = dataTidy($_POST['imagePath']);
  $price = dataTidy($_POST['price']);
  $schema = dataTidy($_POST['schema']);
  $notes = htmlspecialchars($_POST['notes'], ENT_QUOTES);
  $active = dataTidy($_POST['active']);
  $field1 = dataTidy($_POST['field1']);
  $field2 = dataTidy($_POST['field2']);
  $field3 = dataTidy($_POST['field3']);

  $itemUpdateSQL = mysqli_query($link, "UPDATE items SET
    item_name='$name',
    item_type='$type',
    item_image='$imagePath',
    item_active='$active',
    item_notes='$notes',
    item_price='$price',
    item_schema='$schema',
    item_f1='$field1',
    item_f2='$field2',
    item_f3='$field3'
    WHERE
    item_id='$id'"
  );

  if($itemUpdateSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Item Updated</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}

// Delete
if (isset($_GET['del'])) {
	$id = $_GET['del'];

  $itemDelSQL = mysqli_query($link, "DELETE FROM items WHERE item_id='$id'");

  if($itemDelSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Item Deleted</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}

// Delivered
if (isset($_GET['delivered'])) {
  $id = $_GET['delivered'];

  $itemUpdateSQL = mysqli_query($link, "UPDATE transaction_log SET
    trans_delivered='1'
    WHERE
    trans_id='$id'"
  );

  if($itemUpdateSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Item Delivered</p>";
    header('location: ../request/request.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: ../request/request.php');
  }
}

// TYPE
// Add
if (isset($_POST['type_save'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $icon = dataTidy($_POST['icon']);

  $itemSQL = mysqli_query($link, "INSERT INTO types (
    `type_name`,
    `type_icon`
  ) VALUES (
    '$name',
    '$icon',)"
  );

  if($itemSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Type Saved</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}

// Edit
if (isset($_POST['type_update'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $icon = dataTidy($_POST['icon']);

  $itemUpdateSQL = mysqli_query($link, "UPDATE items SET
    type_name='$name',
    type_icon='$icon'
    WHERE
    type_id='$id'"
  );

  if($itemUpdateSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Type Updated</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}

// Delete
if (isset($_GET['type_del'])) {
	$id = $_GET['del'];

  $itemDelSQL = mysqli_query($link, "DELETE FROM types WHERE type_id='$id'");

  if($itemDelSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Type Deleted</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}

// Data Tidy
function dataTidy($data) {
  $tidyData = trim($data);

  return $tidyData;
}
?>

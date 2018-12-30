<?php
// Link to DB
require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");

// Start Session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

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
    '$_SESSION[session]',
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
    '$icon')"
  );

  if($itemSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Type Saved</p>";
    header('location: type_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: type_crud.php');
  }
}

// Edit
if (isset($_POST['type_update'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $icon = dataTidy($_POST['icon']);

  $itemUpdateSQL = mysqli_query($link, "UPDATE types SET
    type_name='$name',
    type_icon='$icon'
    WHERE
    type_id='$id'"
  );

  if($itemUpdateSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Type Updated</p>";
    header('location: type_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: type_crud.php');
  }
}

// Delete
if (isset($_GET['type_del'])) {
	$id = $_GET['type_del'];

  $itemDelSQL = mysqli_query($link, "DELETE FROM types WHERE type_id='$id'");

  if($itemDelSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Type Deleted</p>";
    header('location: type_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: type_crud.php');
  }
}

// LOCATIONS
// Add
if (isset($_POST['location_save'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $description = dataTidy($_POST['description']);

  $itemSQL = mysqli_query($link, "INSERT INTO locations (
    `location_name`,
    `location_description`
  ) VALUES (
    '$name',
    '$description')"
  );

  if($itemSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Location Saved</p>";
    header('location: location_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: location_crud.php');
  }
}

// Edit
if (isset($_POST['location_update'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $description = dataTidy($_POST['description']);

  $itemUpdateSQL = mysqli_query($link, "UPDATE locations SET
    location_name='$name',
    location_icon='$description'
    WHERE
    location_id='$id'"
  );

  if($itemUpdateSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Location Updated</p>";
    header('location: location_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: location_crud.php');
  }
}

// Delete
if (isset($_GET['location_del'])) {
	$id = $_GET['location_del'];

  $itemDelSQL = mysqli_query($link, "DELETE FROM locations WHERE location_id='$id'");

  if($itemDelSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Location Deleted</p>";
    header('location: location_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: location_crud.php');
  }
}

// FIELD SCHEMAS
// Add
if (isset($_POST['schema_save'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $f1 = dataTidy($_POST['f1']);
  $f2 = dataTidy($_POST['f2']);
  $f3 = dataTidy($_POST['f3']);

  $itemSQL = mysqli_query($link, "INSERT INTO field_schema (
    `schema_name`,
    `schema_f1`,
    `schema_f2`,
    `schema_f3`
  ) VALUES (
    '$name',
    '$f1',
    '$f2',
    '$f3')"
  );

  if($itemSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Schema Saved</p>";
    header('location: fields_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: fields_crud.php');
  }
}

// Edit
if (isset($_POST['schema_update'])) {
  $id = dataTidy($_POST['id']);
  $name = dataTidy($_POST['name']);
  $f1 = dataTidy($_POST['f1']);
  $f2 = dataTidy($_POST['f2']);
  $f3 = dataTidy($_POST['f3']);

  $schemaUpdateSQL = mysqli_query($link, "UPDATE field_schema SET
    schema_name='$name',
    schema_f1='$f1'
    schema_f2='$f2'
    schema_f3='$f3'
    WHERE
    schema_id='$id'"
  );

  if($schemaUpdateSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Schema Updated</p>";
    header('location: fields_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: fields_crud.php');
  }
}

// Delete
if (isset($_GET['schema_del'])) {
	$id = $_GET['location_del'];

  $schemaDelSQL = mysqli_query($link, "DELETE FROM field_schema WHERE schema_id='$id'");

  if($schemaDelSQL) {
    $_SESSION['message'] = "<p class='alert alert-success'>Schema Deleted</p>";
    header('location: fields_crud.php');
  } else {
    $_SESSION['message'] = "<p class='alert alert-danger'>" . mysqli_error($link) . "</p>";
    header('location: fields_crud.php');
  }
}

// Data Tidy
function dataTidy($data) {
  $tidyData = trim($data);

  return $tidyData;
}
?>

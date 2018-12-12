<?php
// Link to DB
include '../config/db_config.php';

// Start Session
session_start();

// initialise variables
$name = $type = "";
$update = false;
$id = 0;

// Add
if (isset($_POST['save'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $imagePath = $_POST['imagePath'];
  $notes = htmlspecialchars($_POST['notes'], ENT_QUOTES);
  $active = $_POST['active'];
  $field1 = $_POST['field1'];
  $field2 = $_POST['field2'];
  $field3 = $_POST['field3'];

  if(mysqli_query($link, "INSERT INTO items (`item_name`, `item_type`, `item_image`, `item_active`, `item_notes`, `item_f1`, `item_f2`, item_f3) VALUES ('$name', '$type', '$imagePath', '$active', '$notes', '$field1', '$field2', '$field3'")) {
    $_SESSION['message'] = "<p class='alert alert-success'>Item Saved</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}

// Edit
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $type = $_POST['type'];
  $imagePath = $_POST['imagePath'];
  $notes = htmlspecialchars($_POST['notes'], ENT_QUOTES);
  $active = $_POST['active'];
  $field1 = $_POST['field1'];
  $field2 = $_POST['field2'];
  $field3 = $_POST['field3'];

  if(mysqli_query($link, "UPDATE items SET item_name='$name', item_type='$type', item_image='$imagePath', item_active='$active', item_notes='$notes', item_f1='$field1', item_f2='$field2', item_f3='$field3' WHERE item_id='$id'")) {
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

  if(mysqli_query($link, "DELETE FROM items WHERE item_id='$id'")) {
    $_SESSION['message'] = "<p class='alert alert-success'>Item Deleted</p>";
    header('location: index.php');
  } else {
    $_SESSION['message'] = mysqli_error($link);
    header('location: index.php');
  }
}
?>

<?php include_once '../partials/_header.php' ?>
<br>
<div id='bodyContainer' class='container'>
<?php
  // Variables
  $id = $_GET["id"];

  // Get SQL
  $activesql = "SELECT * FROM items
  INNER JOIN types ON items.item_type=types.type_id
  INNER JOIN field_schema ON items.item_schema=field_schema.schema_id
  WHERE item_id = $id";
  $result = mysqli_query($link, $activesql);
  $item = mysqli_fetch_array($result);

  // Map fields
  $imagePath = $item['item_image'];
  $name = $item['item_name'];
  $itemSchema = $item['item_schema'];
  $type = $item['type_name'];
  $notes = $item['item_notes'];

  // Field Mapping
  $fieldLabel1 = $item['schema_f1'];
  $fieldLabel2 = $item['schema_f2'];
  $fieldLabel3 = $item['schema_f3'];

  if ($itemSchema == '') {
    $fieldLabel1 = 'Field 1';
    $fieldLabel2 = 'Field 2';
    $fieldLabel3 = 'Field 3';
  }

  $field1 = $item['item_f1'];
  $field2 = $item['item_f2'];
  $field3 = $item['item_f3'];

 ?>

 <!-- Header -->
<div class='row'>
  <div class="col-md-3 border">
    <div class="col-md-12 py-2">
      <div class="">
        <h1 class='text-center'><?php echo $name ?></h1>
        <h3 class='text-center'><?php echo $type ?></h3>
      </div>
      <div id='viewImageContainer' class="text-center">
        <img class='img-thumbnail rounded mx-auto d-block' src="../images/<?php echo $imagePath ?>" width=100% alt="<?php echo $name ?>">
      </div>
    </div>
   </div>
    <div class='col-md-9'>
      <div class="jumbotron">

      </div>

      <h3>Notes:</h3>
      <div class="border border-primary">
        <div class='col-md-12 p-3'>
          <?php
          if ($notes == '') {
            echo "<span class='text-center'>There is currently no description.</span>";
          } else {
            echo "<span>{$notes}</span>";
          }
          ?>
        </div>
      </div>

      <br>

      <!-- Details -->
      <table class='table table-bordered'>
        <tbody>
          <tr>
            <td><strong><?php echo $fieldLabel1 ?></strong></td>
            <td><?php echo $field1 ?></td>
          </tr>
          <tr>
            <td><strong><?php echo $fieldLabel2 ?></strong></td>
            <td><?php echo $field2 ?></td>
          </tr>
          <tr>
            <td><strong><?php echo $fieldLabel3 ?></strong></td>
            <td><?php echo $field3 ?></td>
          </tr>
        </tbody>
      </table>

      <br>

    </div>
  </div>
  <br>

  <!-- Back Button -->
  <p><a href="index.php"><i class="fas fa-arrow-circle-left fa-2x"></i></a></p></div>
  <?php include '../partials/_footer.php'; ?>

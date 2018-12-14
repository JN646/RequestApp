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
    <div class='col-md-12'>
      <h1><?php echo $name ?></h1>

      <!-- Details -->
      <table class='table table-bordered'>
        <tbody>
          <tr>
            <td></td>
            <td>
              <img src="../images/<?php echo $imagePath ?>" width=100px alt="<?php echo $name ?>">
            </td>
          </tr>
          <tr>
            <td><strong>Type:</strong></td>
            <td><?php echo $type ?></td>
          </tr>
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

      <h3>Notes:</h3>
      <div class="border border-primary">
        <?php
        if ($notes == '') {
          echo "<p class='text-center'>There is currently no description.</p>";
        } else {
          echo "<p>" . $notes . "</p>";
        }
        ?>
      </div>
    </div>
    <br>

    <!-- Back Button -->
    <p><a href="index.php"><i class="fas fa-arrow-circle-left fa-2x"></i></a></p></div>
    <?php include '../partials/_footer.php'; ?>

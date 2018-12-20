<!-- Header Partial -->
<?php include_once '../partials/_header.php' ?>

<?php
// Start Session
session_start();

// initialise variables
$name = $type = $imagePath = '';
$active = 0;
$price = '0.00';
$update = false;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($link, "SELECT * FROM items WHERE item_id=$id");

    if (count($record) == 1) {
        $n = mysqli_fetch_array($record);
        $id = $n['item_id'];
        $name = $n['item_name'];
        $type = $n['item_type'];
        $schema = $n['item_schema'];
        $notes = $n['item_notes'];
        $imagePath = $n['item_image'];
        $active = $n['item_active'];
        $price = $n['item_price'];
        $field1 = $n['item_f1'];
        $field2 = $n['item_f2'];
        $field3 = $n['item_f3'];
    }
}
?>

<!-- Container -->
  <div id='bodyContainer' class='container'>
    <br>
    <div class='col-md-12'>
      <!-- Notification Block -->
          <?php if (isset($_SESSION['message'])): ?>
              <div class="msg">
                <?php
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
                ?>
              </div>
            <?php endif ?>

            <!-- Header -->
            <h1>Item Database</h1>
            <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>
            <p>This is the item management pane. Use this system to manage and remove items from the system.</p>

            <!-- Form -->
            <div class='border border-primary'>
              <div class='col-md-12'>
                <button id='showHide' type="button" class="close" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>

              <!-- Control Form -->
                <?php if ($update == true): ?>
                  <h2>Update</h2>
                <?php else: ?>
                  <h2>Add</h2>
                <?php endif ?>

                <form id='addUpdateForm' class='' method="post" action="server.php" >
                	<input type="hidden" name="id" value="<?php echo $id; ?>">

                <!-- First Row -->
                <div class='form-row'>
                  <legend>Primary Details</legend>
                  <!-- Name -->
                  <div class='col'>
                    <div class="form-group">
                      <label class="">Name</label><br>
                      <input class='form-control' type="text" name="name" placeholder="Item Name" value="<?php echo $name; ?>">
                    </div>
                  </div>

                  <!-- Type -->
                  <div class='col'>
                    <div class="form-group">
                  		<label class="">Type</label><br>
                      <?php
                      // Type Drowndown Menu
                      $typeResult = mysqli_query($link,"SELECT * FROM types ORDER BY type_name ASC");

                      // Generate Select box with AJAX link.
                      echo "<select id='typeSelect' class='form-control' name='type'>";

                        // Default option.
                        echo "<option class='form-control' value='0'>Please select...</option>";

                        // Generate options from database.
                        while($row = mysqli_fetch_array($typeResult)) {
                          echo "<option class='form-control' value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
                        }

                        echo "</select>";

                        // Close connection.
                        // mysqli_close($link);
                        ?>
                    </div>
                  </div>

                  <!-- Image Path -->
                  <div class='col'>
                    <div class="form-group">
                      <label class="">Image Path</label><br>
                      <input class='form-control' type="text" name="imagePath" placeholder="Image Path" value="<?php echo $imagePath; ?>">
                    </div>
                  </div>

                  <!-- Price -->
                  <div class="col">
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input class='form-control' type="text" name="price" placeholder="Price" value="<?php echo $price; ?>">
                    </div>
                  </div>

                  <!-- Item Active-->
                  <div class='col'>
                    <div class="form-group">
                      <label class="">Active</label><br>
                      <input type="hidden" name="active" value="0">
                      <input id='activeCheckbox' type="checkbox" name="active" value="1">
                    </div>
                  </div>
                </div>

                <!-- Second Row -->
                <div class="form-row">
                  <legend>Fields</legend>

                  <!-- Schema -->
                  <div class='col'>
                    <div class="form-group">
                      <label class="">Field Schema</label><br>
                      <?php
                      // Type Drowndown Menu
                      $schemaResult = mysqli_query($link,"SELECT * FROM field_schema ORDER BY schema_name ASC");

                      // Generate Select box with AJAX link.
                      echo "<select id='schemaSelect' class='form-control' name='schema'>";

                        // Default option.
                        echo "<option class='form-control' value='0'>Please select...</option>";

                        // Generate options from database.
                        while($row = mysqli_fetch_array($schemaResult)) {
                          echo "<option class='form-control' value='" . $row['schema_id'] . "'>" . $row['schema_name'] . "</option>";
                        }

                        echo "</select>";
                        ?>
                    </div>
                  </div>

                  <!-- Field 1 -->
                  <div class="col">
                    <div class="form-group">
                      <label for="field1">Field 1</label>
                      <input class='form-control' type="text" name="field1" placeholder="Field 1" value="<?php echo $field1; ?>">
                    </div>
                  </div>

                  <!-- Field 2 -->
                  <div class="col">
                    <div class="form-group">
                      <label for="field2">Field 2</label>
                      <input class='form-control' type="text" name="field2" placeholder="Field 2" value="<?php echo $field2; ?>">
                    </div>
                  </div>

                  <!-- Field 3 -->
                  <div class="col">
                    <div class="form-group">
                      <label for="field3">Field 3</label>
                      <input class='form-control' type="text" name="field3" placeholder="Field 3" value="<?php echo $field3; ?>">
                    </div>
                  </div>
                </div>

                <!-- Third Row -->
                <div class="form-row">

                  <!-- Notes -->
                  <div class="col">
                    <div class="form-group">
                      <label for="notes">Notes</label>
                      <textarea class='form-control' name="notes"><?php echo $notes; ?></textarea>
                    </div>
                  </div>
                </div>

                  <!-- Submit Buttons -->
                	<div class="form-group">
                		<?php if ($update == true): ?>
                			<button class="btn btn-primary" type="submit" name="update">Update</button>
                		<?php else: ?>
                			<button class="btn btn-success" type="submit" name="save">Add</button>
                		<?php endif ?>
                	</div>
                </form>
              </div>
            </div>

            <br>

            <input class='form-control' id='searchTable' type="text" name="" placeholder='Search...' value="">

            <br>

            <?php
            // SQL
            $activesql = "SELECT * FROM items
            INNER JOIN types ON items.item_type=types.type_id
            ORDER BY item_type, item_name ASC";

            // Run SQL
            if ($result = mysqli_query($link, $activesql)) {
                if (mysqli_num_rows($result) > 0) {
            ?>
            <table id='resultTable' class='table table-sm table-bordered'>
              <thead class="thead-light">
                <tr>
                  <th class='text-center'>ID</th>
                  <th class='text-center'>Item Name</th>
                  <th class='text-center'>Item Type</th>
                  <th class='text-center' colspan="3">Action</th>
                </tr>
              </thead>
                <tbody>
              <?php
                  while ($row = mysqli_fetch_array($result)) {
                    $itemID = $row['item_id'];
                    $itemName = $row['item_name'];
                    $itemType = $row['type_name'];
                    $itemTypeIcon = $row['type_icon'];

                    // Set the active table row class.
                    if ($row['item_active'] == 0) {
                      $itemActiveFlag = "table-active";
                    } else {
                      $itemActiveFlag = "";
                    }

                      // Draw Table.
                        echo "<tr class='" . $itemActiveFlag . "'>";
                          echo "<td class='text-center'>" . $itemID . "</td>";
                          echo "<td>" . $itemName . "</td>";
                          echo "<td>" . $itemTypeIcon . " " . $itemType . "</td>";
                          echo "<td class='text-center'><a href='view.php?id=" . $itemID . "' class='view_btn'><i class='fas fa-eye'></i></a></td>";
                          echo "<td class='text-center'><a href='index.php?edit=" . $itemID . "' class='edit_btn'><i class='fas fa-edit'></i></a></td>";
                          echo "<td class='text-center'><a href='server.php?del=" . $itemID . "' class='del_btn'><i class='far fa-trash-alt'></i></a></td>";
                        echo "</tr>";
                  }
                      echo "</tbody>";
                    echo "</table>";

                    // Free result set
                    mysqli_free_result($result);
                } else {
                    echo "<p class='alert alert-info'>No items were found.</p>";
                }
            } else {
                SQLError($link);
            } ?>

            <script>
            // Search Table JQuery
            $(document).ready(function(){
              // Get active checkbox.
              var activeCheckbox = document.getElementById('activeCheckbox');

              // Set Active Checkbox Value
              if (<?php echo $active; ?> == 1) {
                // Check the box.
                activeCheckbox.checked = true;
              } else {
                // Uncheck the box.
                activeCheckbox.checked = false;
              }

              // Set the type value box.
              $('#typeSelect').val('<?php echo $type; ?>');
              $('#schemaSelect').val('<?php echo $schema; ?>');

              // Hide form by default.
              $("#addUpdateForm").hide();

              // Toggle Update Form.
              $("#showHide").click(function(){
                console.log('Pressed.');
                $("#addUpdateForm").toggle();
              });

              // Filter Search
              $("#searchTable").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#resultTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
              });
            });
            </script>
          </div>
    </div>
    <?php include_once '../partials/_footer.php'; ?>

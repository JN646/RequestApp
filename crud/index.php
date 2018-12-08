<!-- Header Partial -->
<?php include_once '../partials/_header.php' ?>

<?php
// Start Session
session_start();

// initialise variables
$name = $type = $imagePath  = "";
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
        $imagePath = $n['item_image'];
    }
}
?>

<!-- Container -->
  <div id='bodyContainer' class='fluid-container'>
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
            <p>Items you can choose from.</p>

            <!-- Form -->
            <div class='border border-primary'>
              <div class='col-md-12'>
              <!-- Control Form -->
                <?php if ($update == true): ?>
                  <h2>Update</h2>
                <?php else: ?>
                  <h2>Add</h2>
                <?php endif ?>
                <form class='' method="post" action="server.php" >
                	<input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class='form-row'>
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
                  		<input class='form-control' type="text" name="type" placeholder="Item Type" value="<?php echo $type; ?>">
                    </div>
                  </div>

                  <!-- Image Path -->
                  <div class='col'>
                    <div class="form-group">
                      <label class="">Image Path</label><br>
                      <input class='form-control' type="text" name="imagePath" placeholder="Image Path" value="<?php echo $imagePath; ?>">
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

            <?php
            // ACTIVE RESULTS
            $activesql = "SELECT * FROM items ORDER BY item_type, item_name ASC";
            if ($result = mysqli_query($link, $activesql)) {
                if (mysqli_num_rows($result) > 0) {
                    ?>
            <table id='resultTable' class='table table-bordered'>
              <thead class="thead-dark">
                <tr>
                  <th class='text-center'>ID</th>
                  <th class='text-center'>Item Name</th>
                  <th class='text-center'>Item Type</th>
                  <th class='text-center' colspan="3">Action</th>
                </tr>
              </thead>
              <?php
                  while ($row = mysqli_fetch_array($result)) {
                      // Draw Table.
                      echo "<tbody>";
                        echo "<tr>";
                          echo "<td>" . $row['item_id'] . "</td>";
                          echo "<td>" . $row['item_name'] . "</td>";
                          echo "<td>" . $row['item_type'] . "</td>";
                          echo "<td class='text-center'><a href='view.php?id=" . $row['item_id'] . "' class='view_btn'><i class='fas fa-eye'></i></a></td>";
                          echo "<td class='text-center'><a href='index.php?edit=" . $row['item_id'] . "' class='edit_btn'><i class='fas fa-edit'></i></a></td>";
                          echo "<td class='text-center'><a href='server.php?del=" . $row['item_id'] . "' class='del_btn'><i class='far fa-trash-alt'></i></a></td>";
                        echo "</tr>";
                      echo "</tbody>";
                  }
                    echo "</table>";

                    // Free result set
                    mysqli_free_result($result);
                } else {
                    echo "<p class='alert alert-info'>No items were found.</p>";
                }
            } else {
                SQLError($link);
            } ?>
            <p><a href='../index.php'>Back</a></p>
          </div>
    </div>
    <?php include '../partials/_footer.php'; ?>
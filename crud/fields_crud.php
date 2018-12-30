<!-- Header Partial -->
<?php include_once '../partials/_header.php' ?>

<?php
// Start Session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// initialise variables
$name = $f1 = $f2 = $f3 = "";
$update = false;

if (isset($_GET['schema_edit'])) {
    $id = $_GET['schema_edit'];
    $update = true;
    $record = mysqli_query($link, "SELECT * FROM field_schema
      WHERE schema_id=$id");

    if (count($record) == 1) {
        $n = mysqli_fetch_array($record);
        $id = $n['schema_id'];
        $name = $n['schema_name'];
        $f1 = $n['schema_f1'];
        $f2 = $n['schema_f2'];
        $f3 = $n['schema_f3'];
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
          <?php echo $_SESSION['message']; ?>
          <?php unset($_SESSION['message']); ?>
        </div>
      <?php endif ?>

        <!-- Header -->
        <h1>Field Schema Database</h1>
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>
        <p>This is the field schema management pane. Use this system to manage and remove fieldsets from the system.</p>

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

              <div class='form-row'>
                <!-- Name -->
                <div class='col'>
                  <div class="form-group">
                    <label class="">Name</label><br>
                    <input class='form-control' type="text" name="name" placeholder="Schema Name" value="<?php echo $name; ?>">
                  </div>
                </div>
              </div>

              <div class='form-row'>
                <!-- F1 -->
                <div class='col'>
                  <div class="form-group">
                    <label class="">F1</label><br>
                    <input class='form-control' type="text" name="name" placeholder="Field 1" value="<?php echo $f1; ?>">
                  </div>
                </div>

                <!-- F2 -->
                <div class='col'>
                  <div class="form-group">
                    <label class="">F2</label><br>
                    <input class='form-control' type="text" name="name" placeholder="Field 2" value="<?php echo $f2; ?>">
                  </div>
                </div>

                <!-- F3 -->
                <div class='col'>
                  <div class="form-group">
                    <label class="">F3</label><br>
                    <input class='form-control' type="text" name="name" placeholder="Field 3" value="<?php echo $f3; ?>">
                  </div>
                </div>
              </div>

              <!-- Submit Buttons -->
            	<div class="form-group">
            		<?php if ($update == true): ?>
            			<button class="btn btn-primary" type="submit" name="type_update">Update</button>
            		<?php else: ?>
            			<button class="btn btn-success" type="submit" name="type_save">Add</button>
            		<?php endif ?>
            	</div>
            </form>
          </div>
        </div>

        <br>

        <?php
        // ACTIVE RESULTS
        $activesql = "SELECT * FROM field_schema ORDER BY schema_name ASC";
        if ($result = mysqli_query($link, $activesql)) {
            if (mysqli_num_rows($result) > 0) {
                ?>
        <table id='resultTable' class='table table-sm table-bordered'>
          <thead class="thead-dark">
            <tr>
              <th class='text-center'>ID</th>
              <th class='text-center'>Name</th>
              <th class='text-center'>F1</th>
              <th class='text-center'>F2</th>
              <th class='text-center'>F3</th>
              <th class='text-center' colspan="2">Action</th>
            </tr>
          </thead>
          <?php
              while ($row = mysqli_fetch_array($result)) {
                $schemaID = $row['schema_id'];
                $schemaName = $row['schema_name'];
                $schemaF1 = $row['schema_f1'];
                $schemaF2 = $row['schema_f2'];
                $schemaF3 = $row['schema_f3'];

                  // Draw Table.
                  echo "<tbody>";
                    echo "<tr>";
                      echo "<td class='text-center'>" . $schemaID . "</td>";
                      echo "<td>" . $schemaName . "</td>";
                      echo "<td class='text-center'>" . $schemaF1 . "</td>";
                      echo "<td class='text-center'>" . $schemaF2 . "</td>";
                      echo "<td class='text-center'>" . $schemaF3 . "</td>";
                      echo "<td class='text-center'><a href='fields_crud.php?schema_edit=" . $schemaID . "' class='edit_btn'><i class='fas fa-edit'></i></a></td>";
                      echo "<td class='text-center'><a href='server.php?schema_del=" . $schemaID . "' class='del_btn' onclick='return confirm('Are you sure?');'><i class='far fa-trash-alt'></i></a></td>";
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
            echo "<p class='alert alert-info'>" . SQLError($link) . "</p>";
        } ?>
        <script type="text/javascript">
        // Hide form by default.
        $("#addUpdateForm").hide();

        // Toggle Update Form.
        $("#showHide").click(function(){
          $("#addUpdateForm").toggle();
        });
        </script>
      </div>
    </div>
    <?php include '../partials/_footer.php'; ?>

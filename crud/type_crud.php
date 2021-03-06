<!-- Header Partial -->
<?php include_once '../partials/_header.php' ?>

<?php
// Start Session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// initialise variables
$name = $icon = "";
$active = 0;
$update = false;

if (isset($_GET['type_edit'])) {
    $id = $_GET['type_edit'];
    $update = true;
    $record = mysqli_query($link, "SELECT * FROM types
      WHERE type_id=$id");

    if (count($record) == 1) {
        $n = mysqli_fetch_array($record);
        $id = $n['type_id'];
        $name = $n['type_name'];
        $icon = $n['type_icon'];
        $active = $n['type_active'];
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
        <h1>Type Database</h1>
        <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>
        <p>This is the type management pane. The system supports many different items and each item is part of a type, this acts as a group and applies certain properties. Use this system to manage and remove types from the system.</p>

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
                    <input class='form-control' type="text" name="name" placeholder="Type Name" value="<?php echo $name; ?>">
                  </div>
                </div>

                <!-- Icon -->
                <div class='col'>
                  <div class="form-group">
                    <label class="">Icon (font awesome)</label><br>
                    <input class='form-control' type="text" name="icon" placeholder="Icon HTML" value="<?php echo htmlspecialchars($icon); ?>">
                  </div>
                </div>

                <!-- Active? -->
                <div class='col-1'>
                  <div class="form-group">
                    <label class="">Active</label><br>
                    <input type="hidden" name="active" value="0">
                    <input id='activeCheckbox' type="checkbox" name="active" value="1">
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
        if ($result = mysqli_query($link, "SELECT * FROM types ORDER BY type_name ASC")) {
            if (mysqli_num_rows($result) > 0) {
                ?>
        <table id='resultTable' class='table table-sm table-bordered'>
          <thead class="thead-dark">
            <tr>
              <th class='text-center'>ID</th>
              <th class='text-center'>Type Name</th>
              <th class='text-center'>Type Icon</th>
              <th class='text-center'>Type Active</th>
              <th class='text-center'>Count</th>
              <th class='text-center' colspan="2">Action</th>
            </tr>
          </thead>
          <?php
              while ($row = mysqli_fetch_array($result)) {
                $typeID = $row['type_id'];
                $typeName = $row['type_name'];
                $typeIcon = $row['type_icon'];
                $typeActive = $row['type_active'];
                $typeCount = countThings($link, $typeName, 0);
                $typeActiveFlag = ($typeActive == 0 ? "table-active" : "");

                  // Draw Table.
                  echo "<tbody>";
                    echo "<tr class='{$typeActiveFlag}'>";
                      echo "<td class='text-center'>{$typeID}</td>";
                      echo "<td>{$typeName}</td>";
                      echo "<td class='text-center'>{$typeIcon}</td>";
                      echo "<td class='text-center'>{$typeActive}</td>";
                      if ($typeCount != 0) {
                        echo "<td class='text-center'>{$typeCount}</td>";
                      } else {
                        echo "<td class='text-center' style='color:red;'>{$typeCount}</td>";
                      }
                      echo "<td class='text-center'><a href='type_crud.php?type_edit={$typeID}' class='edit_btn'><i class='fas fa-edit'></i></a></td>";
                      echo "<td class='text-center'><a href='server.php?type_del={$typeID}' class='del_btn' onclick='return confirm('Are you sure?');'><i class='far fa-trash-alt'></i></a></td>";
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
        // Get active checkbox.
        var activeCheckbox = document.getElementById('activeCheckbox');
        if (<?php echo $typeActive; ?> == 1) {
          activeCheckbox.checked = true;
        } else {
          activeCheckbox.checked = false;
        }

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

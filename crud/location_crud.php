<!-- Header Partial -->
<?php include_once '../partials/_header.php' ?>

<?php
// Start Session
session_start();

// initialise variables
$name = $description = "";
$update = false;

if (isset($_GET['location_edit'])) {
    $id = $_GET['location_edit'];
    $update = true;
    $record = mysqli_query($link, "SELECT * FROM locations
      WHERE location_id=$id");

    if (count($record) == 1) {
        $n = mysqli_fetch_array($record);
        $id = $n['location_id'];
        $name = $n['location_name'];
        $description = $n['location_description'];
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
          <h1>Location Database</h1>
          <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>
          <p>This is the location management pane. A location is a place that items can be ordered and possibly delivered to. Use this system to manage and remove locations from the system.</p>

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
                      <input class='form-control' type="text" name="name" placeholder="Location Name" value="<?php echo $name; ?>">
                    </div>
                  </div>

                  <!-- Icon -->
                  <div class='col'>
                    <div class="form-group">
                      <label class="">Description</label><br>
                      <input class='form-control' type="text" name="description" placeholder="Description" value="<?php echo htmlspecialchars($description); ?>">
                    </div>
                  </div>
                </div>

                <!-- Submit Buttons -->
              	<div class="form-group">
              		<?php if ($update == true): ?>
              			<button class="btn btn-primary" type="submit" name="location_update">Update</button>
              		<?php else: ?>
              			<button class="btn btn-success" type="submit" name="location_save">Add</button>
              		<?php endif ?>
              	</div>
              </form>
            </div>
          </div>

          <br>

          <?php
          // ACTIVE RESULTS
          $activesql = "SELECT * FROM locations ORDER BY location_name ASC";
          if ($result = mysqli_query($link, $activesql)) {
              if (mysqli_num_rows($result) > 0) {
                  ?>
          <table id='resultTable' class='table table-sm table-bordered'>
            <thead class="thead-dark">
              <tr>
                <th class='text-center'>ID</th>
                <th class='text-center'>Location Name</th>
                <th class='text-center' width=600px>Location Description</th>
                <th class='text-center' colspan="2">Action</th>
              </tr>
            </thead>
            <?php
                while ($row = mysqli_fetch_array($result)) {
                  $locationID = $row['location_id'];
                  $locationName = $row['location_name'];
                  $locationDescription = $row['location_description'];

                    // Draw Table.
                    echo "<tbody>";
                      echo "<tr>";
                        echo "<td class='text-center align-middle'>{$locationID}</td>";
                        echo "<td class='align-middle'>{$locationName}</td>";
                        echo "<td class=''>{$locationDescription}</td>";
                        echo "<td class='text-center align-middle'><a href='location_crud.php?location_edit={$locationID}' class='edit_btn'><i class='fas fa-edit'></i></a></td>";
                        echo "<td class='text-center align-middle'><a href='server.php?location_del={$locationID}' class='del_btn'><i class='far fa-trash-alt'></i></a></td>";
                      echo "</tr>";
                    echo "</tbody>";
                }
                  echo "</table>";

                  // Free result set
                  mysqli_free_result($result);
              } else {
                  echo "<p class='alert alert-info'>No locations were found.</p>";
              }
          } else {
              echo "<p class='alert alert-info'>" . SQLError($link) . "</p>";
          } ?>
          <script type="text/javascript">
          // Hide form by default.
          $("#addUpdateForm").hide();

          // Toggle Update Form.
          $("#showHide").click(function(){
            console.log('Pressed.');
            $("#addUpdateForm").toggle();
          });
          </script>
        </div>
    </div>
    <?php include '../partials/_footer.php'; ?>

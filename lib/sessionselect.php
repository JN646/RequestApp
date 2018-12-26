<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/session_server.php");?>

<?php session_start(); ?>

<body>
  <div class="container">
    <div id='sessionSelectBox' class=''>
      <div id='sessionSelectForm' class='col-md-12 text-center border p-3'>
        <?php echo $_SESSION['session']; ?>
        <h1 class='display-4'>Select Your Location</h1>
        <form class="form-group" action="session_server.php" method="post">
          <div class="form-group">
            <div class='col'>
              <?php
              // Locations Drowndown Menu
              $result = mysqli_query($link,"SELECT * FROM locations ORDER BY location_name ASC");
              echo "<select class='form-control' name='session'>";
                echo "<option class='form-control' value='0'>Please select...</option>";
                while($row = mysqli_fetch_array($result)) {
                  echo "<option class='form-control' value='" . $row['location_id'] . "'>" . $row['location_name'] . "</option>";
                }
                mysqli_close($link);
                ?>
              </select>
            </div>
            <br>
            <div class='col'>
              <button class='btn btn-primary' type="submit" name="startSession">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

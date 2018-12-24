<head>
  <title>Session Test</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo $environment; ?>css/master.css">
</head>

<?php require 'config/db_config.php'; ?>

<?php session_start(); ?>

<br>

<div class="container">
  <div id='sessionSelectBox' class=''>
    <div id='sessionSelectForm' class='col-md-12 text-center border p-3'>
      <?php echo $_SESSION['session']; ?>
      <h1 class='display-4'>Select Your Table</h1>
      <form class="form-group" action="session_server.php" method="post">
        <div class="form-group">
          <div class='col'>
            <?php
            // Type Drowndown Menu
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

<?php

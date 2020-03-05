<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/session_server.php");?>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<?php isSessionSet('is', 'index.php'); ?>

<body>
  <div class="container">
    <!-- Notification Block -->
    <?php if (isset($_SESSION['message'])): ?>
      <div class="msg">
        <?php echo $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?>
      </div>
    <?php endif ?>
    <div id='sessionSelectBox' class=''>
      <div id='sessionSelectForm' class='col-md-12 text-center border p-3'>
        <?php
        if (isset($_SESSION['session'])) {
          echo $_SESSION['session'];
        }
        ?>
        <h1 class='display-4'>Select Your Location</h1>
        <form class="form-group" action="session_server.php" method="post">
          <div class="form-group">
            <div class='col'>
              <?php
              // Locations Drowndown Menu
              $result = mysqli_query($link,"SELECT * FROM locations ORDER BY location_name ASC");
              echo "<select class='form-control' name='table'>";
                echo "<option class='form-control' value='0'>Please select...</option>";
                while($row = mysqli_fetch_array($result)) {
                  $locationID = $row['location_id'];
                  $locationName = $row['location_name'];
                  $locationDescription= $row['location_description'];
                  echo "<option class='form-control' value='{$locationID}'>{$locationName} - " . capCharacters($locationDescription,25) . checkRunningSession($locationID,$link) . "</option>";
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
        <!-- Show Session Number -->
        <?php if (isset($_SESSION['session'])): ?>
          <h3>You session Number is: <?php echo $_SESSION['session'] ?></h3>
        <?php else: ?>
          <h3>You session Number is: N/A</h3>
        <?php endif; ?>

        <!-- Display Debug Logout Button -->
        <?php if (isset($_SESSION['session'])): ?>
          <form id='jumboForm' class="" action="session_server.php" method="post">
            <button class='btn btn-success btn-lg' type="submit" name="sessionOut">Logout</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

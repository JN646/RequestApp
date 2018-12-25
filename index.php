<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/session_server.php");?>

<?php session_start(); ?>

<body>
  <?php
  if ($_SESSION['session']) {
  ?>
  <div class="fluid-container">
    <br>
    <div class="col-md-12">
      <div id='homeJumboOuter'>
        <!-- Hide Jumbo -->
        <button id='showHideJumboHome' type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <!-- Jumbo -->
        <div id='homeJumbo' class="jumbotron jumbotron-fluid">
          <div id='homeJumboContainer' class="container">
            <h1 class="display-4">Request the things.</h1>
            <h3>You session Number is: <?php echo $_SESSION['session'] ?></h3>
            <form id='jumboForm' class="" action="lib/session_server.php" method="post">
              <button class='btn btn-success btn-lg' type="submit" name="sessionOut">Logout</button>
            </form>
            <p class="lead">System to request items.</p>
          </div>
        </div>
      </div>

      <!-- Debug Nav -->
      <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>

      <br>

      <script>
      function showUser(str) {
          if (str == "") {
              document.getElementById("txtHint").innerHTML = "";
              return;
          } else {
              if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp = new XMLHttpRequest();
              } else {
                  // code for IE6, IE5
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              }
              xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("txtHint").innerHTML = this.responseText;
                  }
              };
              xmlhttp.open("GET","getitems.php?q="+str,true);
              xmlhttp.send();
          }
      }
      </script>
      <form>

      <?php
      // Type Drowndown Menu
      $result = mysqli_query($link,"SELECT * FROM types ORDER BY type_name ASC");
      echo "<select class='form-control' name='users' onchange='showUser(this.value)'>";
        echo "<option class='form-control' value='0'>Please select...</option>";
        while($row = mysqli_fetch_array($result)) {
          echo "<option class='form-control' value='" . $row['type_id'] . "'>" . $row['type_name'] . " - (" . countThings($link, $row['type_name']) . ")" . "</option>";
        }
        mysqli_close($link);
        ?>
      </select>
      </form>
      <br>
      <!-- Display results -->
      <div id="txtHint" class='text-center'><b>Item info will be listed here...</b></div>
    </div>
  </div>
  <?php
} else {
  ?>
  <div class="container">
    <div id='sessionSelectBox' class=''>
      <div id='sessionSelectForm' class='col-md-12 text-center border p-3'>
        <?php echo $_SESSION['session']; ?>
        <h1 class='display-4'>Select Your Location</h1>
        <form class="form-group" action="lib/session_server.php" method="post">
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
  <?php
}
  ?>
  <script type="text/javascript">
  // Hide Jumbo.
  $("#showHideJumboHome").click(function(){
    console.log('Pressed.');
    $("#homeJumboOuter").hide();
  });
  </script>
</body>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

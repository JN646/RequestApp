<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_header.php");?>
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/session_server.php");?>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<?php isSessionSet('not','lib/sessionselect.php'); ?>

<body>
  <div class="fluid-container">
    <br>
    <div class="col-md-12">
      <!-- Notification Block -->
      <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
          <?php echo $_SESSION['message']; ?>
          <?php unset($_SESSION['message']); ?>
        </div>
      <?php endif ?>
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

      <form>
        <?php
        // Type Drowndown Menu
        $result = mysqli_query($link,"SELECT * FROM types ORDER BY type_name ASC");
        echo "<select class='form-control' name='users' onchange='showUser(this.value)'>";
          echo "<option class='form-control' value='0'>Please select...</option>";
          while($row = mysqli_fetch_array($result)) {
            $typeID = $row['type_id'];
            $typeName = $row['type_name'];

            // requre at least 1 item in category to be displayed.
            if (countThings($link, $typeName) != 0) {
              echo "<option class='form-control' value='{$typeID}'>{$typeName} - (" . countThings($link, $typeName) . ")" . "</option>";
            }
          }
          mysqli_close($link);
          ?>
        </select>
      </form>
      <br>
      <!-- Display results -->
      <div id="txtHint" class='text-center'>
        <div id='nothingSelected'>Use the dropdown above to select your category.</div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $( document ).ready(function() {
    // Hide Jumbo.
    $("#showHideJumboHome").click(function(){
      $("#homeJumboOuter").hide();
    });
  });

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
<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_footer.php");?>

<?php include 'partials/_header.php' ?>

<?php
// Start Session
session_start();
?>

<body>
<div class="fluid-container">
  <br>
  <div class="col-md-12">
    <h2>Request Home</h2>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href='crud/index.php'>CRUD</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href='config/admin.php'>Admin</a>
      </li>
    </ul>

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

    // Generate Select box with AJAX link.
    echo "<select class='form-control' name='users' onchange='showUser(this.value)'>";

      // Default option.
      echo "<option class='form-control' value='0'>Please select...</option>";

      // Generate options from database.
      while($row = mysqli_fetch_array($result)) {
        echo "<option class='form-control' value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
      }

      // Close connection.
      mysqli_close($link);
      ?>
    </select>
    </form>
    <br>
    <!-- Display results -->
    <div id="txtHint"><b>Item info will be listed here...</b></div>
  </div>
</div>
</body>
<?php include 'partials/_footer.php' ?>

<?php include 'partials/_header.php' ?>
<body>
<div class="fluid-container">
  <br>
  <div class="col-md-12">
    <h2>Request Home</h2>
    <p><a href='crud/index.php'>CRUD</a></p>
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
    <select name="users" onchange="showUser(this.value)">
      <option value="">Select a type:</option>
      <option value="1">Food</option>
      <option value="2">Animal</option>
      <option value="3">Music</option>
      <option value="4">Lights</option>
      </select>
    </form>
    <br>
    <div id="txtHint"><b>Item info will be listed here...</b></div>

  </div>
</div>
</body>
<?php include 'partials/_footer.php' ?>

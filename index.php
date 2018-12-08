
<?php include 'partials/_header.php' ?>
<body>
<div class="fluid-container">
  <br>
  <div class="col-md-12">
    <h2>Request Home</h2>
    <?php
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Attempt select query execution
    $sql = "SELECT * FROM items";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
            echo "<table class='table table-bordered'>";
                echo "<tr>";
                    echo "<th class='text-center'>ID</th>";
                    echo "<th class='text-center'>Name</th>";
                    echo "<th class='text-center'>Requests</th>";
                echo "</tr>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td class='text-center'>" . $row['item_id'] . "</td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td class='text-center'><a href='#'>Request</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records matching your query were found.";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);
    ?>
  </div>
</div>
</body>
<?php include 'partials/_footer.php' ?>

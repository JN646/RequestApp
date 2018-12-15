<!-- Header Partial -->
<?php include_once '../partials/_header.php' ?>

<?php
// Start Session
session_start();
?>

<!-- Container -->
<div id='bodyContainer' class='container'>
  <br>
  <div class='col-md-12'>
    <!-- Header -->
    <h1>Admin</h1>
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/partials/_nav.php");?>
    <p>Admin configuration page.</p>

    <?php
    $_SESSION['viewMode'] = 1;
    ?>

    <!-- Form -->
    <div class='border'>
      <div class='col-md-12'>
        <form class="" action="index.html" method="post">
          <fieldset>
            <legend>View</legend>
            <div class="form-row">
              <div class="col">
                <div class="form-group">
                  <label for="viewMode">View Mode</label>
                  <select class="form-control" name="viewMode">
                    <option value="0">Please Select</option>
                    <option value="1">Table</option>
                    <option value="2">Grid</option>
                  </select>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="viewHide">Hide Inactive</label>
                  <input type="hidden" name="viewHide" value="0">
                  <input class="form-control" type="checkbox" name="viewHide" value="1">
                </div>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>

    <br>

    <p><a href='../index.php'>Back</a></p>
  </div>
</div>
<?php include '../partials/_footer.php'; ?>

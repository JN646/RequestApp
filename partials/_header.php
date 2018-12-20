<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Request Application</title>

    <?php
    // DB Config
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php")) {
      require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");
    } else {
      die('FATAL: Config file is missing.');
    }

    // Function File
    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/functions.php")) {
      require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/lib/functions.php");;
    } else {
      die('FATAL: Functions file is missing.');
    }
    ?>

    <!-- CSS -->
    <?php
    // Darkmode Template
    if (true) {
      if ($darkMode == 0 || $darkMode == 1) {
        if ($darkMode == 1) {
          echo "<link rel='stylesheet' href='" . $environment . "css/darkmode.min.css'>";
        } else {
          echo "<link rel='stylesheet' href='" . $environment . "css/lightmode.css'>";
        }
      } else {
        die('FATAL: Incorrect Theme Value');
      }
    }
    ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $environment; ?>css/master.css">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=x9qd1yadiyni5k2ewcrz7bblh4na43kf2jux0mp6334m7ult"></script>
    <script>tinymce.init({ selector:'textarea' });</script> -->
  </head>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo $environment; ?>index.php">Request App</a>
  </nav>

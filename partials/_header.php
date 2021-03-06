<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $environment; ?>css/master.css">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo $environment; ?>lib/main.js"></script>
    <!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=x9qd1yadiyni5k2ewcrz7bblh4na43kf2jux0mp6334m7ult"></script>
    <script>tinymce.init({ selector:'textarea' });</script> -->
  </head>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo $environment; ?>index.php"><i class="fas fa-concierge-bell"></i> RequestApp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $environment; ?>index.php"><i class='fas fa-home'></i></a>
      </li>
      <li class="nav-item">
        <a class='nav-link' href='<?php echo $environment; ?>request/basket.php'><i class='fas fa-shopping-basket'></i></a>
      </li>
    </ul>
  </div>
</nav>

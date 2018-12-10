<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Request Application</title>

    <!-- DB File -->
    <?php require_once($_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php");?>

    <!-- CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $environment; ?>css/master.css">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=x9qd1yadiyni5k2ewcrz7bblh4na43kf2jux0mp6334m7ult"></script>    <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">Request App</a>
  </nav>

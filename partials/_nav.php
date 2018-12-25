<?php
if ($adminMode == 1) {
  if ($darkMode == 1) {
    echo "<nav id='debugNav' class='navbar navbar-light bg-light'>";
  } else {
    echo "<nav id='debugNav' class='navbar navbar-dark bg-dark'>";
  }
?>
    <a class='navbar-brand' href='#'>DEBUG</a>
    <ul class='nav'>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>crud/index.php'>Item</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>crud/type_crud.php'>Type</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>crud/location_crud.php'>Locations</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>config/admin.php'><i class='fas fa-unlock-alt'></i></a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>request/request.php'>Request Home</a>
      </li>
    </ul>
  </nav>
<?php
}
?>

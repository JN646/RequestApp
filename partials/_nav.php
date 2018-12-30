<?php if ($adminMode == 1): ?>
  <?php if ($darkMode == 1): ?>
    <nav id='debugNav' class='navbar navbar-light bg-light'>
  <?php else: ?>
    <nav id='debugNav' class='navbar navbar-dark bg-dark'>
  <?php endif; ?>
    <a class='navbar-brand' href='#'>DEBUG</a>
    <ul class='nav'>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>crud/index.php'>I</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>crud/type_crud.php'>T</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>crud/location_crud.php'>L</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>crud/fields_crud.php'>F</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>crud/sessions_crud.php'>S</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link disabled' disabled href='<?php echo $environment; ?>config/admin.php'><i class='fas fa-unlock-alt'></i></a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='<?php echo $environment; ?>request/request.php'>Req</a>
      </li>
    </ul>
  </nav>
<?php endif; ?>

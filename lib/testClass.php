<head>
  <meta charset="utf-8">
  <title>Class Test</title>
  <style media="screen">
    body {
      font-family: sans-serif;
    }
  </style>
</head>
<?php
include 'items_class.php';

// $f = new item;
// $f->itemName = "Donald Trump";
// $f->itemType = "President";
// $f->itemPrice = 6.75;
// $f->itemActive = 1;

$ThePeople = ['Bill Clinton','George HW Bush','George W Bush','Jimmy Carter'];

$president41 = new item("George HW Bush","President","2.50","0");
$president42 = new item("Bill Clinton","President","4.50","1");
$president43 = new item("George W Bush","President","6.50","1");

// echo $f->customize_print();
echo $president41->getName();
echo $president42->getName();
echo $president43->getName();

echo $president42->setName("This is a name change.");
?>

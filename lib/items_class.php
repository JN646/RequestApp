<?php
/**
 * Items
 */
class item {
  private $itemName;
  private $itemType;
  private $itemPrice;
  private $itemActive;

  function __construct($itemName, $itemType, $itemPrice, $itemActive) {
    $this->itemName = $itemName;
    $this->itemType = $itemType;
    $this->itemPrice = $itemPrice;
    $this->itemActive = $itemActive;
  }

  function __destruct() {
   echo "Destroying " . $this->itemName . "<br>";
  }

  function getName() {
    echo $this->itemName . "</br>";
  }

  function setName($itemName) {
    $this->itemName = $itemName;
    echo $this->itemName . "</br>";
  }
}
?>

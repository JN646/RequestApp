<?php
/**
 * Items
 */
class item {
  private $itemID;
  private $itemName;
  private $itemType;
  private $itemPrice;
  private $itemActive;
  public static $allItems = array();

  // Constructor
  function __construct($itemID, $itemName, $itemType, $itemPrice, $itemActive) {
    $this->itemID = $itemID;
    $this->itemName = $itemName;
    $this->itemType = $itemType;
    $this->itemPrice = $itemPrice;
    $this->itemActive = $itemActive;
    $this->getName();
    $this->getType();
  }

  // Destructor
  function __destruct() {
   echo "<span style='color: red;'>Destroying " . $this->itemName . "</span><br>";
  }

  // Get the Name
  function getName() {
    echo "<span style='color: green;'>" . $this->itemName . "</span></br>";
  }

  function getType() {
    $thisItemType = $this->itemType;
    if ($thisItemType == 5) {
      $thisItemType = "President";
    } else {
      $thisItemType = "Not a President";
    }
    echo "<span style='color: green;'>" . $thisItemType . "</span></br>";
  }

  // Set the Name
  function setName($itemName) {
    if ($itemName != '') {
      $this->itemName = $itemName;
      echo $this->itemName . "</br>";
    } else {
      echo "ERROR: Name is blank</br>";
    }
  }

  // Set the Type
  function setType($itemType) {
    if ($itemType != '') {
      $this->itemType = $itemType;
      echo $this->itemType . "</br>";
    } else {
      echo "ERROR: Type is blank</br>";
    }
  }

  function isActive() {
    if ($this->itemActive == 1) {
      echo $this->itemName . " is Active " . $this->$itemActive . "</br>";
    } else {
      echo $this->itemName . " is not Active " . $this->$itemActive . "</br>";
    }
  }
}
?>

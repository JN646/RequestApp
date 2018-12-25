<?php
/**
 * Sessions
 */
class Session
{
  private $sessionID;
  private $sessionActive;

  function __construct($sessionID,$sessionActive)
  {
    $this->sessionID = $sessionID;
    $this->sessionActive = $sessionActive;
  }

  function createSession() {

  }
}

?>

<?php
class HabitacionCollection{
  private $Habitaciones = array();    

  private $_onload;               

  private $_isLoaded = false;     

  public function addItem($obj, $key = null) {
    $this->_checkCallback();
        
    if($key) {
      //Si ahi alguna llave igual
      if(isset($this->_Habitaciones[$key])) {
        throw new KeyInUseException("Key \"$key\" already in use!");
      } else {
        $this->_Habitaciones[$key] = $obj;
      }
    } else {
      $this->_Habitaciones[] = $obj;
    }
  }

  public function removeItem($key) {
    $this->_checkCallback();
    
    if(isset($this->_Habitaciones[$key])) {
      unset($this->_Habitaciones[$key]);
    } else {
      throw new KeyInvalidException("Invalid key \"$key\"!");
    }  
  }
  
  public function getItem($key) {
    $this->_checkCallback();
    
    if(isset($this->_Habitaciones[$key])) {
      return $this->_Habitaciones[$key];
    } else {
      throw new KeyInvalidException("Invalid key \"$key\"!");
    }
  }

  public function keys() {
    $this->_checkCallback();
    return array_keys($this->_Habitaciones);
  }

  public function length() {
    $this->_checkCallback();
    return sizeof($this->_Habitaciones);
  }

  public function exists($key) {
    $this->_checkCallback();
    return (isset($this->_Habitaciones[$key]));
  }

  public function setLoadCallback($functionName, $objOrClass = null) {
    if($objOrClass) {
      $callback = array($objOrClass, $functionName);
    } else {
      $callback = $functionName;
    }
    
    //make sure the function/method is valid
    if(!is_callable($callback, false, $callableName)) {
      throw new Exception("$callableName is not callable " . 
                          "as a parameter to onload");
      return false;
    }
    
    $this->_onload = $callback;
  }

  private function _checkCallback() {
    if(isset($this->_onload) && !$this->_isLoaded) {
      $this->_isLoaded = true;
      call_user_func($this->_onload, $this);
    }
  }  
}


?>

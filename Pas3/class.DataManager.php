<?php
require_once('class.Entity.php');  
require_once('class.Individual.php');
require_once('class.Organization.php');

class DataManager 
{
   private static function _getConnection() {
      static $hDB;
   
      if(isset($hDB)) {
         return $hDB;
      }
   
      $hDB = pg_connect("host=localhost port=5432 dbname=zeusDb user=postgres  
                         password=Zpoke2001!")
         or die("Failure connecting to the database!");
      return $hDB;
  }
 
  public static function getEntityData($entityID) {
    $sql = "SELECT * FROM entities WHERE entityid  = $entityID";
    $res = pg_query(DataManager::_getConnection(),$sql);
    if(! ($res && pg_num_rows($res))) {
      die("Failed getting entity $entityID");
    }
    return pg_fetch_assoc($res);
 }

 public static function getAllEntitiesAsObjects() {
    $sql = "SELECT entityid, type from entities ";
    $res = pg_query(DataManager::_getConnection(), $sql);
   
    if(!$res) {
      die("Failed getting all entities");
    }
   
    if(pg_num_rows($res)) {
      $objs = array();
      while($row = pg_fetch_assoc($res)) {
        if($row['type'] == 'I') {
          $objs[] = new Individual($row['entityid']);
        } elseif ($row['type'] == 'O') {
          $objs[] = new Organization($row['entityid']);
        } else {
          die("Unknown entity type {$row['type']} encountered!");
        }
      }
      return $objs;
    } else {
      return array();
    }
  } 

   
}
?>

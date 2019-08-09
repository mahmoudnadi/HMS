<?php
require_once 'functions.php';

if(isset($_POST['submit']) && isset($_POST['addRoom'])){
  if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['adults']) && isset($_POST['children'])
  && isset($_POST['extra'])  && isset($_POST['price']) && isset($_POST['roomStatus']) && isset($_POST['amenities'])){
    $name = sanitizeString($_POST['name']);
    $description = sanitizeString($_POST['description']);
    $price = (double) sanitizeString($_POST['price']);
    $adults = (int) sanitizeString($_POST['adults']);
    $children = (int) sanitizeString($_POST['children']);
    $extra = (int) sanitizeString($_POST['extra']);
    $active = (int) sanitizeString($_POST['roomStatus']);
    $amenities = $_POST['amenities'];

/* Check if room type already exists */
    $stmt = $conn ->prepare("SELECT COUNT(*) FROM roomTypes WHERE name=?");
    $stmt -> bind_param("s", $name);
    $stmt -> execute();
    $stmt -> bind_result($count);
    $stmt ->fetch();
    $stmt -> close();
    //echo "<script>alert($count)</script>";
    if($count == 0){
      $stmt = $conn -> prepare("INSERT INTO roomTypes(name, description, active, price, max_adults, max_children, extra) VALUES(?,?,?,?,?,?,?)");
      $stmt -> bind_param("ssidiii",$name,$description,$active,$price,$adults,$children,$extra);
      $stmt -> execute();
      if(!$stmt ->error) echo "<script>alert('Room Type Successfully Added!')</script>";
      else
      $stmt ->close();
      /* Creates table to hold each room types included amenities*/
      $tableName = strtolower(sanitizeString($name."amenities"));
      $tableName = str_replace(' ','',$tableName);
      $amenitiyTableSql="
      CREATE TABLE IF NOT EXISTS " . $tableName ."(
      id TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
      amenity_ID TINYINT(3) UNSIGNED ZEROFILL NOT NULL,
      FOREIGN KEY (amenity_ID) REFERENCES includedAmenities(amenity_ID) ON DELETE CASCADE ON UPDATE CASCADE
      )ENGINE INNODB";

      $rows = count($amenities);
      $query = "INSERT INTO " . $tableName . "(amenity_ID) VALUES";
      for($j = 0; $j < $rows; $j++){
        $amenity_ID = $amenities[$j];
        if($j == $rows - 1) $query = $query . "(" . $amenity_ID . ")";
        else $query = $query . "(" . $amenity_ID . "),";
      }

      $query = sanitizeString($query);
      $result = $conn ->query($amenitiyTableSql);
      if(!$result){
        echo "<script>alert('$tableName failed to be created. Already exits')</script>";
        $result = $conn ->query($query);
      }
      else{
         echo "<script>alert('$tableName successfully created.')</script>";
         $result = $conn ->query($query);
      }
    }
    else echo "<script>alert('$name already exists.')</script>";

  }
}
?>

<?php
require_once 'functions.php';

if(isset($_POST['update']) && isset($_POST['editRoom'])){

  if(isset($_POST['roomType_ID']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['adults'])
  && isset($_POST['children']) && isset($_POST['extra']) && isset($_POST['price']) && isset($_POST['roomStatus']) && isset($_POST['amenities'])){
    $roomType_ID = sanitizeString($_POST['roomType_ID']);
    $name = sanitizeString($_POST['name']);
		$description = sanitizeString($_POST['description']);
    $price = (double) sanitizeString($_POST['price']);
		$adults = (int) sanitizeString($_POST['adults']);
		$children = (int) sanitizeString($_POST['children']);
		$extra = (int) sanitizeString($_POST['extra']);
    $active = (int) sanitizeString($_POST['roomStatus']);
    $amenities = $_POST['amenities'];
//Update the roomTypes table
    $stmt = $conn ->prepare("UPDATE roomtypes SET name=?, description=?, active=?, price=?, max_adults=?, max_children=?, extra=? WHERE roomType_ID=?");
    $stmt ->bind_param("ssidiiii",$name,$description,$active,$price,$adults,$children,$extra,$roomType_ID);
    $stmt ->execute();
    $stmt ->fetch();
    $stmt -> close();
//Empty out the amenities table assocaited with the room type
    $tableName = strtolower(sanitizeString($name."amenities"));
    $tableName = str_replace(' ','',$tableName);
    $emptyTable = $conn->query("TRUNCATE TABLE $tableName");
  //  $emptyTable ->close();
//Insert the amenities into the table
    $rows = count($amenities);
    $query = "INSERT INTO " . $tableName . "(amenity_ID) VALUES";
    for($j = 0; $j < $rows; $j++){
      $amenity_ID = $amenities[$j];
      if($j == $rows - 1) $query = $query . "(" . $amenity_ID . ")";
      else $query = $query . "(" . $amenity_ID . "),";
    }

    $query = sanitizeString($query);
    $result = $conn ->query($query);
    //$result ->close();

  }
}

if(isset($_POST['delete']) && isset($_POST['editRoom'])){
  if (isset($_POST['roomType_ID']) && isset($_POST['name'])){
    $roomType_ID = $_POST['roomType_ID'];
    /*-- Delete room type from database table --*/
    $query = $conn->prepare("UPDATE rooms SET roomType_ID=0 WHERE roomType_ID=?");
    $query->bind_param("i",$roomType_ID);
    $query->execute();

    $stmt = $conn ->prepare("DELETE FROM roomTypes WHERE roomType_ID=?");
    $stmt -> bind_param("i", $roomType_ID);
    $stmt -> execute();
    if(!$stmt ->error) echo "<script>alert('Room Type Deleted!')</script>";
    else echo "<script>alert('--ERROR: Room Type Unsuccessfully Deleted.')</script>";
    //$stmt ->close();

    /*-- Delete the amenities table associated with the deleted entry --*/
    $name = sanitizeString($_POST['name']);
    $tableName = strtolower(sanitizeString($name ."amenities"));
    $tableName = str_replace(' ','',$tableName);
    $stmt = $conn ->query("DROP TABLE " . $tableName);
    //$stmt ->close();
  }
}
?>

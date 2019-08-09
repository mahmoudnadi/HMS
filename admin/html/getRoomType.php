<?php
  require_once 'functions.php';
  $roomType_ID = $_POST["roomType_ID"];

  $stmt = $conn->prepare("SELECT name, description,max_adults,max_children,extra,price,active FROM roomTypes WHERE roomType_ID=?");
  $stmt->bind_param("i", $roomType_ID);
  $stmt->execute();
  $stmt->bind_result($name, $description,$max_adults,$max_children,$extra,$price,$active);
  $stmt->fetch();
  $stmt->close();

  $amenityTable = strtolower(sanitizeString($name."amenities"));
  $amenityTable = str_replace(' ','',$amenityTable);

  $result = $conn->query("SELECT amenity_ID FROM ".$amenityTable);
  if(!$result) die("SELECT amenity_ID FROM ".$amenityTable);
  $rows=$result->num_rows;
  $amenityArray =array();
  if ($rows > 0){
    for($j = 0; $j < $rows; ++$j){
      $val = $result->fetch_array(MYSQLI_ASSOC);
      array_push($amenityArray,$val['amenity_ID']);
    }
  }
  echo json_encode(array("rm_ID"=>$roomType_ID, "name" => $name, "description" => $description, "adults" => $max_adults, "children" => $max_children, "extra" => $extra, "price" =>$price, "active"=>$active,"amenityArray"=>$amenityArray));
  ?>

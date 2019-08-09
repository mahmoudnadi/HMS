<?php
  require_once 'functions.php';
  $roomNum = $_POST["room_id"];

  $stmt = $conn->prepare("SELECT roomType_ID,active,access,status_ID FROM rooms WHERE room_id=?");
  $stmt->bind_param("i", $roomNum);
  $stmt->execute();
  $stmt->bind_result($roomType_ID, $active, $access, $status_ID);
  $stmt->fetch();
  $stmt->close();

  echo json_encode(array("roomType_ID" => $roomType_ID, "active" => $active, "access" => $access, "status_ID"=> $status_ID));
?>

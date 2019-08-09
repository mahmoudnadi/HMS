<?php
  require_once 'functions.php';
  $roomType_ID = $_POST["roomType_ID"];
  $stmt = $conn->prepare("SELECT name FROM roomTypes WHERE roomType_ID=?");
  $stmt->bind_param("i", $roomType_ID);
  $stmt->execute();
  $stmt->bind_result($name);
  $stmt->fetch();
  $stmt->close();

  echo json_encode(array("name" => $name));
  ?>

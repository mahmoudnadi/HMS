<?php
  $hn = 'localhost';
  $db = "hotel";
  $un = "username";
  $pw = "password";

  $conn = new mysqli($hn, $un, $pw, $db);
  if($conn ->connect_error) die("Fatal Database Error");
  /*if(!($conn -> connect_error)) echo "<script>alert('Connected successfully to databse.')</script>'";*/

  function queryMysql($query){
    global $conn;

    $result = $conn -> query($query);
    if(!$result) die("Fatal Error");
    return $result;
  }

  function destroySession(){
    $_SESSION = array();
    if(session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(),'', time() - 2592000, '/');
    session_destroy();
  }

  function sanitizeString($var){
    global $conn;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if(get_magic_quotes_gpc()) $var = stripslashes($var);
    $var = $conn -> real_escape_string($var);
    return $var;
  }
?>

<?php
if(!isset($_GET["username"])){
  return http_response_code(403);
}
$username = $_GET["username"];
$login = query("DELETE FROM login WHERE username = '$username'");

?>
<?php
if(!isset($_GET["kode_menu"])){
  return http_response_code(403);
}
$kode_menu = $_GET["kode_menu"];
$login = query("DELETE FROM menu WHERE kode_menu = '$kode_menu'");

?>
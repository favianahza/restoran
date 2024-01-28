<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet">
    <link href="assets/css/fonts.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <script src="assets/js/index.js"></script>
    <title>Nikmatnyoo Food | Checkout</title>
  </head>
<body>
  
</body>
<?php 
require('functions.php');
if(isset($_POST["submit"])){
  $username = $_SESSION["username"];
  $tipe_makan = $_POST["tipe_makan"];
  $total = $_POST["total"];
  $tanggal = date('Y-m-d H:i:s');
  if($tipe_makan == "Takeaway"){
    $nomor_meja = 0;
  } else {
    $nomor_meja = $_POST["nomor_meja"];
  }
  $values = json_decode($_POST["values"], true);
  // $values = $_POST["values"];
  foreach($values as $value){
    foreach($value as $key => $val){
      // echo "$key as key and $val as value ";
    }
  }
  // var_dump($_POST["values"]);
  $value = $_POST["values"];
  $query = "INSERT INTO transaksi VALUE('', '$username', '$value', '$total', '$tipe_makan', '$tanggal')";
  if(mysqli_query($connection, $query)){
    echo "<script>success('Berhasil Checkout', 'order.php')</script>";
  } else {
    echo "Gagal";
  }
} else {
  header("Location: menu.php");
}
?>
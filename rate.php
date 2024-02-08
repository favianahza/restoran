<?php 
require('functions.php');

if(isset($_POST["submit"]) && isset($_SESSION["logged_in"])){
  $rating = $_POST["rating"];
  $ulasan = mysqli_real_escape_string($connection ,$_POST["ulasan"]);
  $kode_menu = $_POST["kode_menu"];
  $username = $_SESSION["username"];
  $currentRating = fetchAll(query("SELECT * FROM rating WHERE username = '$username' AND kode_menu = '$kode_menu'"));
  if(count($currentRating) > 0){
    // var_dump($kode_menu, $rating, $ulasan, $username, $currentRating);
    $id = $currentRating[0]["id"];
    $query = "UPDATE rating SET rating = '$rating', ulasan = '$ulasan' WHERE id = '$id'";
    if(query($query)){
      echo "UPDATED";
    }
  } else {
    $query = "INSERT INTO rating VALUES('', '$username', '$kode_menu', '$rating', '$ulasan')";
    if(query($query)){
      echo "CREATED";
    } else {
      echo "FAILED";
      die();
    }
  }

}
?>
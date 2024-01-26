<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet">
    <link href="assets/css/fonts.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="assets/css/daftar.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <script src="assets/js/index.js"></script>
    <title>Bootstrap demo</title>
  </head>

  <body class="bg-light" style="overflow: hidden">

<?php
require("functions.php");
if(isset($_SESSION["logged_in"])){
  return header("Location: index.php");
}
if(isset($_POST["submit"])){
  
  $username = $_POST["username"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $nama_lengkap = $_POST["nama_lengkap"];
  $no_telp = $_POST["no_telp"];
  $email = $_POST["email"];
  $register = register($username, $password, $nama_lengkap, $no_telp, $email);
  $url = "http://".$_SERVER['HTTP_HOST'].'/restoran/daftar.php';
  if(strpos($register,"telah digunakan!")){
    echo"
    <script>failed('$register', '$url')</script>
    ";
  } else {
    $url = "http://".$_SERVER['HTTP_HOST'].'/restoran/login.php';
    echo "<script>success('Berhasil Mendaftar!', '$url')</script>";
  }
}
?>
    <div id="daftar" class="row g-0 d-flex bg-warning text-left justify-content-center">
      <div class="col-5 col-lg-4 col-xl-4 align-self-center">

        <div id="card" class="card shadow p-1 d-flex">
          <div class="card-body">
            <h3 class="card-title vegan mb-3 text-center">Mantapnyoo Food</h3>
            <h3 class="card-title bebas my-2 text-center">DAFTAR</h3>
            <form method="POST" autocomplete="off">
              <p class="m-0"><label for="username">Username</label></p>
              <input class="mb-3" id="username" type="text" placeholder="Masukan Username" name="username" required>
              <p class="m-0"><label for="password">Password</label></p>
              <input class="mb-3" id="password" type="password" placeholder="Masukan Password" name="password" required>
              <p class="m-0"><label for="nama">Nama Lengkap</label></p>
              <input class="mb-3" id="nama" type="text" placeholder="Masukan Nama Lengkap" name="nama_lengkap" required>              
              <p class="m-0"><label for="no_telp">No. Telephone</label></p>
              <input class="mb-3" id="no_telp" type="number" placeholder="Masukan No. Telephone (Dengan format 08XX)" name="no_telp" required>
              <p class="m-0"><label for="email">Email</label></p>
              <input class="mb-3" id="email" type="email" placeholder="Masukan Email" name="email" required>          
              <input class="btn btn-dark my-2" type="submit" name="submit" value="DAFTAR">
            </form>
              <a href="login.php"><input class="btn btn-warning mb-2" type="submit" name="login" value="LOGIN"></a>
              <a href="index.php"><input class="btn btn-secondary" type="submit" name="kembali" value="Kembali"></a>
          </div>
        </div>          

      </div>
    </div>
  </body>
</html>
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
    <title>Bootstrap demo</title>
  </head>

  <body class="bg-light" style="overflow: hidden">

<?php
require("functions.php");
if(isset($_SESSION["privilege"])){
  return header("Location: index.php");
}
if(isset($_POST["submit"])){
  $username = $_POST["username"];
  $password = $_POST["password"];
  $login = login($username, $password);
  $url = "http://".$_SERVER['HTTP_HOST'].'/restoran/login.php';
  // var_dump(strpos($login, "tidak ditemukan!")); die();
  if(strpos($login, "tidak ditemukan!") || strpos($login, "salah!") ){
    echo "<script>failed('$login', '$url')</script>";
  } else {
    echo "<script> success('Berhasil login', '$url') </script>";
  }
}
?>

<div id="login" class="row g-0 d-flex bg-warning text-left justify-content-center">
      <div class="col-5 col-lg-4 col-xl-4 align-self-center">

        <div class="card shadow p-1 d-flex">
          <div class="card-body">
            <h3 class="card-title vegan mb-3 text-center">Mantapnyoo Food</h3>
            <h3 class="card-title bebas my-2 text-center">LOGIN</h3>
            <form method="POST" autocomplete="off">
              <p class="m-0"><label for="username">Username/Email</label></p>
              <input class="mb-3" id="username" type="text" placeholder="Masukan Username" name="username" required>
              <p class="m-0"><label for="password">Password</label></p>
              <input class="mb-3" id="password" type="password" placeholder="Masukan Password" name="password" required>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="cookie">
                <label class="form-check-label" for="cookie">
                  Ingat Saya
                </label>
              </div>              
              <input class="btn btn-dark my-2" type="submit" name="submit" value="LOGIN">
            </form>
              <a href="daftar.php"><input class="btn btn-warning mb-2" type="submit" name="daftar" value="DAFTAR"></a>
              <a href="index.php"><input class="btn btn-secondary" type="submit" name="kembali" value="Kembali"></a>
          </div>
        </div>          

      </div>
    </div>
  </body>
</html>
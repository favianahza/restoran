<?php
require('functions.php');
if(!isset($_SESSION["privilege"]) && $_SESSION["privilege"] != "admin" ){
  return header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet">
    <link href="assets/css/fonts.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <title>Nikmatnyoo Food | Pengaturan</title>
  </head>

  <section id="loading" class="top-0 bg-light position-sticky">
    <div class="wrapper d-flex justify-content-center" style="height: 100%">
      <div class="spinner-grow align-self-center" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </section>

  <body class="bg-light" style="overflow: hidden">

  <nav id="navbar" class="navbar navbar-expand-lg bg-light shadow position-relative" style="z-index: 9999">
      <div class="container-fluid px-3 py-2">
        <img src="assets/img/logo.png" alt="logo" class="img-fluid logo logo-sm logo-md logo-lg">
        <h1 class="vegan mt-2" id="brand">Nikmatnyoo Food</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <h2><a class="nav-link active bebas" aria-current="page" href="index.php">HOME</a></h2>
        <?php if(isset($_SESSION["privilege"]) && $_SESSION["privilege"] == "admin") : ?>
            <h2><a class="nav-link active bebas" aria-current="page" href="admin/index.php">ADMIN</a></h2>
        <?php endif; ?>
            <h2><a class="nav-link active bebas" aria-current="page" href="menu.php">MENU</a></h2>
        <?php if(!isset($_SESSION["logged_in"])) : ?>
            <h2><a class="nav-link active bebas" href="daftar.php">DAFTAR</a></h2>
        <?php else: ?>
          <?php if(isset($_SESSION["privilege"]) && $_SESSION["privilege"] != "admin") : ?>          
            <h2><a class="nav-link active bebas" href="order.php">ORDER</a></h2>
            <h2><a class="nav-link active bebas" href="pengaturan.php">PENGATURAN</a></h2>
          <?php endif; ?>
        <?php endif; ?>
        <?php if(!isset($_SESSION["privilege"])) : ?>
            <h2><a class="nav-link active bebas" href="login.php">LOGIN</a></h2>
        <?php else: ?>
            <h2><a class="nav-link active bebas" href="logout.php">LOGOUT</a></h2>
        <?php endif; ?>
          </div>
        </div>
      </div>
  </nav>  

  <section id="main" class="container-fluid p-2 position-absolute" style="height: 75%; ">
    <div class="row d-flex text-center g-0 mt-3" style="height: 100%">
      <div class="col-12 my-3 align-self-center">
        <h3 id="form_title">GANTI PASSWORD</h3>

        <form method="POST" autocomplete="off" id="password_form">
              <p class="m-0"><label for="password">Password Saat Ini</label></p>
              <input class="mb-3" id="password" type="password" placeholder="Masukan Password Lama" name="password" required maxlength="32">
              <p class="m-0"><label for="new_password">Password Baru</label></p>
              <input class="mb-3" id="new_password" type="password" placeholder="Masukan Password Baru" name="new_password" required maxlength="32">
              <p class="m-0"><label for="confirm_password">Konfirmasi Password Baru</label></p>
              <input class="mb-3" id="confirm_password" type="password" placeholder="Masukan Konfirmasi Password Baru" name="confirm_password" required maxlength="32"><br>
              <small style="text-secondary">Pastikan Password yang dimasukan telah sesuai</small><br>
              <br><input class="btn btn-dark my-2" type="submit" name="submitPassword" value="GANTI PASSWORD">
        </form>
        
        <form method="POST" autocomplete="off" style="display: none" id="name_form">
              <p class="m-0"><label for="name">Nama Anda</label></p>
              <input class="mb-3" id="name" type="text" placeholder="Masukan Password Baru" name="name" required value="<?=  $_SESSION["name"] ?>">
              <p class="m-0"><label for="notelp">No. Telp</label></p>
              <input class="mb-3" id="notelp" type="number" placeholder="Masukan Password Baru" name="notelp" required value="<?=  $_SESSION['no_telp'] ?>" placeholder="<?=  $_SESSION['no_telp'] ?>">  
              <p class="m-0"><label forcurrent_="password">Password Saat Ini</label></p>
              <input class="mb-3" id="current_password" type="password" placeholder="Masukan Password" name="current_password" required><br>
              <small style="text-secondary">Nama yang diubah adalah nama tampilan. Bukan username</small><br>
              <br><input class="btn btn-dark my-2" type="submit" name="submitData" value="UPDATE DATA">
        </form>        
        <button class="btn btn-secondary" id="switchForm" onclick="switchForm('#name_form', '#password_form', 'PERBAHARUI DATA')">UBAH DATA PRIBADI</button>
      </div>
    </div>
  </section>

  
  <footer id="footer" class="container-fluid text-center bg-dark position-absolute text-white bottom-0" style="z-index: 1000">
    <div class="col py-3">
      <p class="montserrat">Nikmatnyoo Food ©</p>
    </div>
  </footer>

  </body>
</html>
<?php 
if(isset($_POST["submitPassword"])){
  
  $password = $_POST["password"];
  $new_password = $_POST["new_password"];
  $confirm_password = $_POST["confirm_password"];
  $username = $_SESSION["username"];
  $real_password = fetchAll(query("SELECT password FROM login WHERE username = '$username'"))[0]["password"];
  if(!password_verify($password, $real_password)){
    echo "<script> failed ('Password lama yang dimasukan salah', './pengaturan.php') </script>";
    die();
  }
  
  if($new_password != $confirm_password){
    echo "<script> failed ('Konfirmasi Password yang dimasukan tidak sama!', './pengaturan.php') </script>";
    die();
  }
  $pass = password_hash($new_password, PASSWORD_DEFAULT);
  if( mysqli_query($connection, "UPDATE login SET password = '$pass' WHERE username = '$username'") ){
    echo "<script> success ('Password berhasil diubah!', './pengaturan.php') </script>";
  }
} else if (isset($_POST["submitData"])) {
  $password = $_POST["current_password"];
  $name = $_POST["name"];
  $notelp = $_POST["notelp"];
  $username = $_SESSION["username"];
  $real_password = fetchAll(query("SELECT password FROM login WHERE username = '$username'"))[0]["password"];
  if(!password_verify($password, $real_password)){
    echo "<script> failed ('Password yang dimasukan salah', './pengaturan.php') </script>";
    die();
  }
  
  if( query("UPDATE login SET description = '$name' WHERE username = '$username'") && query("UPDATE customer SET nama = '$name', no_telp = '$notelp' WHERE username = '$username'") ){
    echo "<script> success ('Data berhasil diubah!', './pengaturan.php') </script>";
    $_SESSION["name"] = $name;
    $_SESSION["no_telp"] = $notelp;
  }  

}
?>
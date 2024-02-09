<?php 
require('functions.php');
if(isset($_COOKIE["logged_in"])){
  $_SESSION["logged_in"] = true;
  $_SESSION["username"] = base64_decode($_COOKIE["username"]);
  $_SESSION["privilege"] = base64_decode($_COOKIE["privilege"]);
  $_SESSION["name"] = base64_decode($_COOKIE["name"]);
  $_SESSION["notelp"] = base64_decode($_COOKIE["notelp"]);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/fonts.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/index.js"></script>
    <title>Nikmatnyoo Food | Main</title>
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

    <section id="top" class="container-fluid p-0 text-center text-white position-relative z-1">
      <div id="overlay" class="row d-flex g-0 position-absolute top-0 bottom-0 z-5" style="width: 100%">
        <div class="col align-self-center">
          <h1 class="bebas">Temukan masakan favorit hanya di</h1>
          <h1 class="vegan display-2 my-4 my-md-5" >Nikmatnyoo Food</h1>
          <h4 class="bebas">Menyediakan berbagai macam hidangan dan masakan dari berbagai tempat</h4>
        </div>
      </div>      
      <div class="row g-0 z-1">
        <div class="col">
          <img src="assets/img/lily-banse--YHSwy6uqvk-unsplash.jpg" alt="Nikmatnyoo" class="img-fluid shadow">
        </div>
      </div>
    </section>

    <section id="main" class="container-fluid text-center bg-light g-0 py-3 b-5">
      <div class="row d-flex g-0">
        <div class="col-lg-6 align-self-center p-5">
          <h2 class="bebas">Dibuat dengan menggunakan bahan organik</h2>
          <p class="montserrat">Hanya bahan-bahan terpilih yang akan digunakan untuk memasak hidangan kami dengan jaminan <b>100% FRESH</b> setiap hari.</p>
        </div> 
        <div class="col-lg-6">
          <img src="assets/img/jacopo-maia--gOUx23DNks-unsplash.jpg" class="img-fluid rounded shadow-sm">
        </div>
      </div>
    </section>

    <footer id="footer" class="container-fluid text-center bg-dark position-relative text-white">
      <div class="col py-3">
        <p class="montserrat">Nikmatnyoo Food ©</p>
      </div>
    </footer>
  </body>
</html>

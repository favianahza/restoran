<?php
require('functions.php');

if(!isset($_GET["id"])){
  return header("Location: index.php");
}

$id = base64_decode(base64_decode($_GET["id"]));

$dataMenu = fetchAll(query("SELECT *, IFNULL((SELECT AVG(rating.rating) FROM rating WHERE rating.kode_menu = menu.kode_menu), 0) AS rating FROM menu WHERE kode_menu = '$id'"))[0];
$fetchRating = fetchAll(query("SELECT rating.*, customer.nama FROM rating LEFT JOIN customer ON rating.username = customer.username WHERE kode_menu = '$id'"));

if(count($fetchRating) == 0) return header("Location: index.php");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <title>Nikmatnyoo Food | Ulasan</title>
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

  <section id="main" class="container-fluid p-2 position-relative" style="height: 75%; ">
    <div class="row d-flex text-center g-0 mt-3 mx-3" style="height: 100%">
      <div class="col-12 my-2">
        <h2><?= $dataMenu["nama_menu"];?></h2>
        <a href="menu.php"><button type="button" class="btn btn-secondary mt-3">KEMBALI</button></a>
      </div>
      <div class="col-12 col-md-6 my-3  montserrat align-self-center">
        <img src="assets/img/menu/<?= $dataMenu['foto']; ?>" class="img-thumbnail">
      </div>      
      <div class="col-12 col-md-6 my-3 px-5 montserrat align-self-center">
        <h3>NAMA MENU</h3><p><?=  htmlspecialchars($dataMenu["nama_menu"]) ?></p>
        <h3>DESKRIPSI</h3><p><?=  htmlspecialchars($dataMenu["deskripsi"]) ?></p>
        <h3>HARGA</h3><p><?=  htmlspecialchars(rupiah($dataMenu["harga"])) ?></p>
        <h3>RATING</h3>
        <div class="star_rating" style="font-size:1em; color: gold;">
            <?php printRating($dataMenu["rating"]); ?>
        </div>
      </div>
    </div>
  </section>

  <section id="review" class="container-fluid p-2 position-relative mb-5">
    <div class="row d-flex text-center g-0 mt-3 p-0 justify-content-center flex-wrap">
      <h3>Ulasan</h3>
    <?php foreach($fetchRating as $rating) : ?>
      <div class="col-10 col-sm-6 col-md-4 col-lg-3 mx-3 my-2">
        <div class="card border-light mb-3 shadow" style="height: 100%">
          <div class="card-header bg-secondary text-white"><?= $rating["nama"] ?></div>
          <div class="card-body bg-light">
              <h5 class="card-title"></h5>
              <b>Rating <?= number_format($rating["rating"], 1, '.', '') ." / 5.0"; ?></b>
              <div class="star_rating" style="font-size:1em; color: gold;">
                <p><?php printRating($rating["rating"]); ?></p>
              </div>
              <p><?= htmlspecialchars($rating["ulasan"]) ?></p>
          </div>
        </div>    
      </div>
    <?php endforeach; ?>
    </div>
  </section>

  <footer id="footer" class="container-fluid text-center bg-dark position-absolute text-white">
    <div class="col py-3">
      <p class="montserrat">Nikmatnyoo Food ©</p>
    </div>
  </footer>

  </body>
</html>
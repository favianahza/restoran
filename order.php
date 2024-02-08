<?php
require('functions.php');
$num = 0;
$username = $_SESSION["username"];
$query = query("SELECT * FROM transaksi WHERE username = '$username'");
$fetch = fetchAll($query);
?>
<!DOCTYPE html>
<html lang="en" style="position: relative; min-height: 100%;">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/fonts.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/datatables.min.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/order.js"></script>
    <title>Nikmatnyoo Food | Order</title>
  </head>

  <section id="loading" class="top-0 bg-light position-sticky">
    <div class="wrapper d-flex justify-content-center" style="height: 100%">
      <div class="spinner-grow align-self-center" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </section>

  <body class="bg-light">

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

  <section id="main" class="container-fluid p-2 bg-light">
    <div class="row d-flex text-center g-0">
      <div class="col-12 my-3">
        <h3>RIWAYAT ORDER</h3>
      </div>
      <div class="col-12 px-3 table-responsive">
        <table class="cell-border shadow display" id="order_table">
          <thead>
          <tr class="montserrat">
            <th style="width: 1%" class="text-center"><h5>NO.</h5></th>
            <th style="width: 5%" class="text-center"><h5>TANGGAL</h5></th>
            <th style="width: 5%" class="text-center"><h5>TOTAL</h5></th>
            <th style="width: 5%" class="text-center"><h5>TIPE</h5></th>
            <th style="width: 40%" class="text-center"><h5>MENU</h5></th>
          </tr>
          </thead>
          <tbody>
        <?php foreach($fetch as $data) : ?>
          <tr>
            <td><?= $num=$num+1; ?></td>
            <td><?= htmlspecialchars(date("D, d-m-Y H:m:s", strtotime($data["tanggal"]))) ?></td>
            <td><?= htmlspecialchars(rupiah($data["total"])) ?></td>
            <td><?= htmlspecialchars($data["tipe"]) ?></td>
            <td>
              <?php
                $lists = json_decode($data["list_item"], true);
                foreach($lists as $list){
                  foreach($list as $key => $val){
                    $nama_menu = explode('_', $key)[1];
                    $jumlah = $val;
                    echo "<small>$nama_menu $jumlah"."X</small><br>";
                  }
                }
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
          </tbody>
        </table>
        <?php if(mysqli_affected_rows($connection) == 0) : ?>
          <h4></h4>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <br><br><br>
  <footer id="footer" class="container-fluid text-center bg-dark position-absolute text-white bottom-0">
    <div class="col py-3">
      <p class="montserrat">Nikmatnyoo Food ©</p>
    </div>
  </footer>
  </body>
</html>
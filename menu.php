<?php 
require("functions.php");
$foods = fetchAll(query("SELECT * FROM menu WHERE tipe = 'Makanan'"));
$drinks = fetchAll(query("SELECT * FROM menu WHERE tipe = 'Minuman'"));
$desserts = fetchAll(query("SELECT * FROM menu WHERE tipe = 'Dessert'"));
$countFood = 1;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/fonts.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/index.js"></script>
    <title>Nikmatnyoo Food | Menu</title>
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
        <h1 class="vegan" id="brand">Nikmatnyoo Food</h1>
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
            <h2><a class="nav-link active bebas" href="order.php">ORDER</a></h2>
            <h2><a class="nav-link active bebas" href="pengaturan.php">PENGATURAN</a></h2>
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

  <div class="row text-center mt-3 container-fluid">
    <h2 class="montserrat" style="text-shadow: 1px 1px 3px grey">Makanan</h2>
  </div>
  <?php if(count($foods) == 0) : ?>
    <section id="makanan" class="container-fluid text-center bg-dark g-5 position-relative shadow">
        <div class="row d-flex py-3 justify-content-center">
          <div class="col-lg-4 my-3 m-lg-0">
            <h1>Makanan tidak tersedia</h1>
          </div>
        </div>
      </section>  
  <?php else: ?>  
      <section id="makanan" class="container-fluid text-center bg-dark px-5 px-lg-4 position-relative shadow">
        <div class="row d-flex py-3 flex-wrap justify-content-center">
        <?php foreach($foods as $food) : ?>
          <div class="col-sm-6 col-md-4 col-lg-4 p-1">
            <div class="card" style="height: 100%">
              <img src="assets/img/menu/<?= htmlspecialchars($food["foto"])  ?>" alt="<?= htmlspecialchars($food["foto"]) ?>" class="img-fluid img-thumbnail card-img-top" style="height: 250px">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($food["nama_menu"]) ?></h5>
                <p class="card-text"><?= htmlspecialchars($food["deskripsi"]) ?></p>
              </div>
              <div class="card-footer">
              <?php if(isset($_SESSION["logged_in"])) : ?>                
                <input type="button" value="-" class="d-inline fs-5" onclick="decrement(<?= $food['kode_menu']?>)" style="width: 7%; background: rgba(0,0,0,0); border: none;">
                <input class="mb-2 text-center order" min="0" id="ID_<?= $food['kode_menu']?>" value="0" style="width: 7%;" disabled aria-data="<?= $food['nama_menu'] . '_' . $food['harga'] ?>"></input>
                <input type="button" value="+" class="d-inline fs-5" onclick="increment(<?= $food['kode_menu']?>)" style="width: 7%; background: rgba(0,0,0,0); border: none;"><br>
              <?php endif; ?>
                <button class="btn btn-success"><?= rupiah($food["harga"]) ?></button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </section>
  <?php endif; ?>


  <div class="row text-center mt-5 container-fluid">
    <h2 class="montserrat" style="text-shadow: 1px 1px 3px grey">Minuman</h2>
  </div>
  <?php if(count($drinks) == 0) : ?>
    <section id="minuman" class="container-fluid text-center bg-dark g-5 position-relative shadow">
        <div class="row d-flex py-3 justify-content-center">
          <div class="col-lg-4 my-3 m-lg-0">
            <h3 class="text-white">Minuman tidak tersedia</h3>
          </div>
        </div>
      </section>  
  <?php else: ?>  
      <section id="minuman" class="container-fluid text-center bg-dark px-5 px-lg-4 position-relative shadow">
        <div class="row d-flex py-3 flex-wrap justify-content-center">
        <?php foreach($drinks as $drink) : ?>
          <div class="col-sm-6 col-md-4 col-lg-4 p-1">
            <div class="card" style="height: 100%">
              <img src="assets/img/menu/<?= htmlspecialchars($drink["foto"])  ?>" alt="<?= htmlspecialchars($drink["foto"]) ?>" class="img-fluid img-thumbnail card-img-top" style="height: 250px">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($drink["nama_menu"]) ?></h5>
                <p class="card-text"><?= htmlspecialchars($drink["deskripsi"]) ?></p>
              </div>
              <div class="card-footer">
              <?php if(isset($_SESSION["logged_in"])) : ?>
                <input type="button" value="-" class="d-inline fs-5" onclick="decrement(<?= $drink['kode_menu']?>)" style="width: 7%; background: rgba(0,0,0,0); border: none;">
                  <input class="mb-2 text-center order" min="0" id="ID_<?= $drink['kode_menu']?>" value="0" style="width: 7%;" disabled aria-data="<?= $drink['nama_menu'] . '_' . $drink['harga'] ?>"></input>
                  <input type="button" value="+" class="d-inline fs-5" onclick="increment(<?= $drink['kode_menu']?>)" style="width: 7%; background: rgba(0,0,0,0); border: none;"><br>
              <?php endif; ?>                
                <button class="btn btn-success"><?= rupiah($drink["harga"]) ?></button>
              </div>              
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </section>
  <?php endif; ?>


  <div class="row text-center mt-5 container-fluid">
  <h2 class="montserrat" style="text-shadow: 1px 1px 3px grey">Dessert</h2>
  </div>
  <?php if(count($desserts) == 0) : ?>
    <section id="dessert" class="container-fluid text-center bg-dark g-5 position-relative shadow">
        <div class="row d-flex py-3 justify-content-center">
          <div class="col-lg-4 my-3 m-lg-0">
            <h3 class="text-white">Dessert tidak tersedia</h3>
          </div>
        </div>
      </section>  
  <?php else: ?>  
      <section id="Desert" class="container-fluid text-center bg-dark px-5 px-lg-4 position-relative shadow">
        <div class="row d-flex py-3 flex-wrap justify-content-center">
        <?php foreach($desserts as $dessert) : ?>
          <div class="col-sm-6 col-md-4 col-lg-4 p-1">
            <div class="card" style="height: 100%">
              <img src="assets/img/menu/<?= htmlspecialchars($dessert["foto"])  ?>" alt="<?= htmlspecialchars($dessert["foto"]) ?>" class="img-fluid img-thumbnail card-img-top" style="height: 250px">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($dessert["nama_menu"]) ?></h5>
                <p class="card-text"><?= htmlspecialchars($dessert["deskripsi"]) ?></p>
              </div>
              <div class="card-footer">
                <?php if(isset($_SESSION["logged_in"])) : ?>
                  <input type="button" value="-" class="d-inline fs-5" onclick="decrement(<?= $dessert['kode_menu']?>)" style="width: 7%; background: rgba(0,0,0,0); border: none;">
                  <input class="mb-2 text-center order" min="0" id="ID_<?= $dessert['kode_menu']?>" value="0" style="width: 7%;" disabled aria-data="<?= $dessert['nama_menu'] . '_' . $dessert['harga']  ?>"></input>
                  <input type="button" value="+" class="d-inline fs-5" onclick="increment(<?= $dessert['kode_menu']?>)" style="width: 7%; background: rgba(0,0,0,0); border: none;"><br>
                <?php endif; ?>
                  <button class="btn btn-success"><?= rupiah($dessert["harga"]) ?></button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>
      </section>
  <?php endif; ?>


  <button class="btn btn-primary" id="checkout" onclick="checkout()"><h4>PESAN</h4></button>


  <div id="underlay" class="top-0 row g-0 d-flex text-left justify-content-center position-fixed">
      <div class="col-9 col-sm-7 col-md-6 col-lg-4 col-xl-4 align-self-center">
        <div class="card shadow d-flex text-center">
          <div class="card-body px-3 px-sm-3">
            <h4 class="card-title bebas my-2 text-center" id="pesanan">Pesanan Anda</h4>
            <table class="table table-hover table-bordered" id="table_order">
            </table>            
            <form method="POST" autocomplete="off" id="order_form" action="checkout.php">
              <input class="form-check-input" type="radio" name="tipe_makan" value="Takeaway" checked id="tipe_makan1" onclick="$('#nomor').css('display','none')">
              <label class="form-check-label" for="tipe_makan1">
                  Takeaway
              </label>
              <input class="form-check-input" type="radio" name="tipe_makan" value="Dine In" id="tipe_makan2" onclick="$('#nomor').css('display','block')">
              <label class="form-check-label" for="tipe_makan2">
                  Dine In
              </label><br>
              <div style="display: none" id="nomor">
              <label for="nomor_meja">Nomor Meja: </label>
              <select name="nomor_meja" id="nomor_meja">
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
              </select>
              </div>
              <input class="btn btn-success my-2" type="submit" name="submit" id="submit" value="CHECKOUT">
            </form>
            <button class="btn btn-secondary" id="close_underlay" onclick="$(this).parents('div#underlay').css('visibility','hidden'); $('.dynamic').remove() ">Kembali</button>
          </div>
        </div>          
      </div>
  </div>

  <footer id="footer" class="container-fluid text-center bg-light my-3 position-relative">
    <p class="montserrat fw-bold">Mantapnyoo Food ©</p>
  </footer>

  </body>
</html>
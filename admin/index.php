<?php
require("../functions.php");
if(!isset($_SESSION) || $_SESSION["privilege"] != "admin"){
  return http_response_code(403);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/sweetalert2.min.css" rel="stylesheet">
    <link href="../assets/css/datatables.min.css" rel="stylesheet">
    <link href="../assets/css/fonts.css" rel="stylesheet">
    <link href="../assets/css/index.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>    
    <script src="../assets/js/sweetalert2.min.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/index.js"></script>
    <script src="../assets/js/admin.js"></script>
    <title>Nikmatnyoo Food | Admin Page</title>
  </head>
  <body>

  <section id="loading" class="top-0 bg-light position-sticky">
    <div class="wrapper d-flex justify-content-center" style="height: 100%">
      <div class="spinner-grow align-self-center" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </section>

  <nav id="navbar" class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container-fluid px-3 py-2">
        <h1 class="vegan" id="brand">Nikmatnyoo Food</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
          <div class="navbar-nav">
          <h4><a class="nav-link active bebas" href="../index.php">HOME</a></h4>
          <h4><a class="nav-link active bebas" href="./?page=customers">LIST PELANGGAN</a></h4>            
          <h4><a class="nav-link active bebas" href="./?page=menu">LIST MENU</a></h4>
          <h4><a class="nav-link active bebas" href="./?page=transactions">TRANSAKSI</a></h4>
          <h4><a class="nav-link active bebas" href="./?page=settings">PENGATURAN</a></h4>
          <?php if(!isset($_SESSION["privilege"])) : ?>
            <h4><a class="nav-link active bebas" href="login.php">LOGIN</a></h4>
          <?php else: ?>
            <h4><a class="nav-link active bebas" href="../logout.php">LOGOUT</a></h4>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>    

    <?php
      if(empty($_GET)){
        include ("customers.php");
      } else {
        switch($_GET["page"]) {
          case "customers":
            include ("customers.php");
            break;
          case "customerDetail":
            include ("customerDetail.php");
            break;
          case "customerDelete":
            include ("customerDelete.php");
            break;
          case "menu":
              include ("menu.php");
              break;
          case "addMenu":
                include ("addMenu.php");
                break;
          case "detailMenu":
                include ("detailMenu.php");
                break;
          case "deleteMenu":
            include ("deleteMenu.php");
            break;
          case "editMenu":
            include ("editMenu.php");
            break;
          case "transactions":
            include ("transactions.php");
            break;
          case "settings":
            include ("settings.php");
            break;
          default:
            include ("customers.php");
            break;
        }
      }
    ?>
  </body>
</html>
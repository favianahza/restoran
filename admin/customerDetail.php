<?php
if(!isset($_GET["username"])){
  return http_response_code(403);
}
$username = $_GET["username"];
$query = query("SELECT * FROM customer WHERE username = '$username'");
$fetch = fetchAll($query);
$data = array_shift($fetch);

$fetch = fetchAll(query("SELECT COUNT(username) as transaksi FROM transaksi WHERE username = '$username'"));
$count = array_shift($fetch);

$fetch = fetchAll(query("SELECT SUM(total) as total FROM transaksi WHERE username = '$username'"));
$total = array_shift($fetch);
?>
<section id="main" class="container-fluid p-2">
    <div class="row d-flex text-center g-0 justify-content-center">
      <div class="col-12 my-3">
        <h1>DETAIL PELANGGAN</h1>
        <p class="fs-5">Username : <?= $data["username"] ?></p>
      </div>
      <div class="col-12 col-md-6 my-3 montserrat">
        <h3>NAMA PELANGGAN</h3>
        <p class="fs-4"><?=  $data["nama"] ?></p>
      </div>
      <div class="col-12 col-md-6 my-3 montserrat">
        <h3>EMAIL PELANGGAN</h3>
        <p class="fs-4"><?=  $data["email"] ?></p>
      </div>
      <div class="col-12 col-md-6 my-3 montserrat">
        <h3>JUMLAH TRANSAKSI</h3>
        <p class="fs-4"><?=  $count["transaksi"] ?></p>
      </div>
      <div class="col-12 col-md-6 my-3 montserrat">
        <h3>TOTAL TRANSAKSI</h3>
        <p class="fs-4"><?=  rupiah($total["total"]) ?></p>
      </div>
      <a href="./?page=customers"><button type="button" class="btn btn-secondary mt-5">KEMBALI</button></a>
    </div>
</section>
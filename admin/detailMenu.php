<?php
if(!isset($_GET["kode_menu"])){
  return http_response_code(403);
}
$kode_menu = mysqli_real_escape_string($connection, $_GET["kode_menu"]);
$query = query("SELECT * FROM menu WHERE kode_menu = '$kode_menu'");
$fetch = fetchAll($query);
$data = array_shift($fetch);
?>
<section id="main" class="container-fluid p-2">
    <div class="row d-flex text-center g-0">
      <div class="col-12 my-3">
        <h1>DETAIL MENU</h1>       
      </div>
      <div class="col-12 col-md-6 my-3 montserrat align-self-center">
        <img src="../assets/img/menu/<?= $data['foto']; ?>" class="img-thumbnail">
      </div>      
      <div class="col-12 col-md-6 my-3 px-5 montserrat align-self-center">
        <h3>NAMA MENU</h3><p><?=  htmlspecialchars($data["nama_menu"]) ?></p>
        <h3>DESKRIPSI</h3><p><?=  htmlspecialchars($data["deskripsi"]) ?></p>
        <h3>HARGA</h3><p><?=  htmlspecialchars(rupiah($data["harga"])) ?></p>
        <h3>TIPE</h3><p><?=  htmlspecialchars($data["tipe"]) ?></p>
        <h3>TERJUAL</h3><p><?=  htmlspecialchars($data["terjual"]) ?></p>
      </div>
      <a href="./?page=menu"><button type="button" class="btn btn-secondary mt-3 mb-5">KEMBALI</button></a>
    </div>
</section>
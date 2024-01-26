<?php
if(!isset($_GET["kode_menu"])){
  return http_response_code(403);
}
$kode_menu = $_GET["kode_menu"];
$query = query("SELECT * FROM menu WHERE kode_menu = '$kode_menu'");
$fetch = fetchAll($query);
$data = array_shift($fetch);

if(isset($_POST["submit"])){
  $nama = $_POST["nama_menu"];
  $harga = $_POST["harga"];
  $deskripsi = $_POST["deskripsi"];
  $tipe = $_POST["tipe"];
  if($_FILES["foto"]["error"] === 4){
    $foto = $data["foto"];
  } else {
    $foto = $_FILES["foto"]["name"];
  }
  if(editMenu($nama, $harga, $deskripsi, $foto, $tipe, $kode_menu)){
    echo "<script>success('Berhasil diperbaharui!', './?page=menu')</script>";
  }
}


?>
<section id="main" class="container-fluid p-2">
    <div class="row d-flex text-center">
      <div class="col-12 my-3">
        <h3 class="mb-4">EDIT MENU</h3>
            <form method="POST" autocomplete="off" enctype="multipart/form-data">
              <p class="m-0"><label for="nama_menu">Nama Menu</label></p>
              <input class="mb-3" id="nama_menu" type="text" placeholder="Masukan Nama Menu" name="nama_menu" value="<?= $data['nama_menu'] ?>" required>
              <p class="m-0"><label for="harga">Harga</label></p>
              <input class="mb-3" id="harga" type="number" placeholder="Masukan harga" name="harga" value="<?= $data['harga'] ?>" required><br>
              <p class="m-0"><label for="tipe">Tipe</label></p>
              <select class="mb-3" name="tipe" id="tipe">
                <option value="Makanan" <?php echo ($data["tipe"]) == "Makanan" ? "selected" : ''; ?>>Makanan</option>
                <option value="Minuman" <?php echo ($data["tipe"]) == "Minuman" ? "selected" : ''; ?>>Minuman</option>
                <option value="Dessert" <?php echo ($data["tipe"]) == "Dessert" ? "selected" : ''; ?>>Dessert</option>
              </select>
              <p class="m-0"><label for="deskripsi">Deskripsi</label></p>
              <textarea name="deskripsi" id="deskripsi" cols="35" placeholder="Masukan deskripsi menu" required><?= $data["deskripsi"] ?></textarea><br>
              <label for="foto">Foto Menu</label><br>
              <input type="file" name="foto" id="foto" style="border: solid 1px grey; padding: 2px;"><br>
              <small style="text-secondary">Tidak usah upload gambar jika tidak ingin memperbaharuinya</small><br>
              <small style="text-secondary">Ukuran gambar maksimal 2MB</small><br>
              <br><input class="btn btn-dark my-2" type="submit" name="submit" value="PERBAHARUI">
            </form>
            <a href=".?page=menu"><input class="btn btn-secondary" type="submit" name="kembali" value="KEMBALI"></a>
        </div> 
      </div>
    </div>
</section>
<?php
if(isset($_POST["submit"])){
  $nama = $_POST["nama_menu"];
  $harga = $_POST["harga"];
  $deskripsi = $_POST["deskripsi"];
  $tipe = $_POST["tipe"];
  $foto = $_FILES["foto"]["name"];
  if(addMenu($nama, $harga, $deskripsi, $foto, $tipe)){
    echo "<script>success('Berhasil ditambahkan!', './?page=menu')</script>";
  }
}


?>
<section id="main" class="container-fluid p-2">
    <div class="row d-flex text-center container-fluid">
      <div class="col-12 my-3">
        <h3 class="mb-4">TAMBAH MENU</h3>
            <form method="POST" autocomplete="off" enctype="multipart/form-data">
              <p class="m-0"><label for="nama_menu">Nama Menu</label></p>
              <input class="mb-3" id="nama_menu" type="text" placeholder="Masukan Nama Menu" name="nama_menu" required>
              <p class="m-0"><label for="harga">Harga</label></p>
              <input class="mb-3" id="harga" type="number" placeholder="Masukan harga" name="harga" required><br>
              <p class="m-0"><label for="tipe">Tipe</label></p>
              <select class="mb-3" name="tipe" id="tipe">
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Dessert">Dessert</option>
              </select>
              <p class="m-0"><label for="deskripsi">Deskripsi</label></p>
              <textarea name="deskripsi" id="deskripsi" cols="35" placeholder="Masukan deskripsi menu"></textarea><br>
              <label for="foto">Foto Menu</label><br>
              <input type="file" name="foto" id="foto" required style="border: solid 1px grey; padding: 2px;"><br>
              <small style="text-secondary">Ukuran gambar maksimal 2MB</small><br>
              <br><input class="btn btn-dark my-2" type="submit" name="submit" value="TAMBAH">
            </form>
            <a href="./?page=menu"><input class="btn btn-secondary" type="submit" name="kembali" value="KEMBALI"></a>
        </div> 
      </div>
    </div>
</section>
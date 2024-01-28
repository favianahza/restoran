<?php 
$query = query("SELECT * FROM menu");
$fetch = fetchAll($query);
$num = 0;
?>
<section id="main" class="container-fluid p-2">
    <div class="row d-flex text-center g-0">
      <div class="col-12 my-3">
        <h3>DATA MENU</h3>
        <a href="./?page=addMenu"><button class="btn btn-primary">Tambah Menu</button></a>
      </div>
      <div class="col-12 px-3 table-responsive">
        <table class="table table-hover table-bordered align-middle">
          <tr class="montserrat">
            <td style="width: 1%"><h5>NO.</h5></td>
            <td style="width: 10%"><h5>NAMA MENU</h5></td>
            <td style="width: 5%"><h5>HARGA</h5></td>
            <td style="width: 25%"><h5>DESKRIPSI</h5></td>
            <td style="width: 5%"><h5>TIPE</h5></td>
            <td style="width: 14%"><h5>AKSI</h5></td>
          </tr>
        <?php foreach($fetch as $data) : ?>
          <tr id="ID_<?=  $data["kode_menu"] ?>">
            <td><?= $num=$num+1; ?></td>
            <td><?= htmlspecialchars($data["nama_menu"]) ?></td>
            <td><?= htmlspecialchars(rupiah($data["harga"])) ?></td>
            <td><?= htmlspecialchars($data["deskripsi"]) ?></td>
            <td><?= htmlspecialchars($data["tipe"]) ?></td>
            <td>
              <a href="./?page=detailMenu&kode_menu=<?= $data['kode_menu'] ?>"><button type="button" class="btn btn-primary">DETAIL</button></a>
              <a href="./?page=editMenu&kode_menu=<?= $data['kode_menu'] ?>"><button type="button" class="btn btn-warning">EDIT</button></a>
              <a href="./?page=detailMenu&kode_menu=<?= $data['kode_menu'] ?>" onclick="return confirm(event, './?page=deleteMenu&kode_menu=<?= $data['kode_menu'] ?>', '<?= $data['kode_menu'] ?>')"><button type="button" class="btn btn-danger">HAPUS</button></a>
            </td>
          </tr>
        <?php endforeach; ?>
        </table>
      </div>
    </div>
</section>
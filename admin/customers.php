<?php 
$query = query("SELECT * FROM customer");
$fetch = fetchAll($query);

?>
<section id="main" class="container-fluid p-2">
    <div class="row d-flex text-center g-0">
      <div class="col-12 my-3">
        <h3>DATA PELANGGAN</h3>
      </div>
      <div class="col-12 table-responsive">
        <table class="cell-border shadow display" id="data_table">
          <thead>
          <tr class="montserrat">
            <th class="text-center"><h5>NAMA PELANGGAN</h5></th>
            <th class="text-center"><h5>EMAIL</h5></th>
            <th class="text-center"><h5>NO. TELEPHONE</h5></th>
            <th class="text-center"><h5>AKSI</h5></th>
          </tr>
          </thead>
          <tbody>
        <?php foreach($fetch as $data) : ?>
          <tr id="ID_<?=  $data["username"] ?>">
            <td><?= $data["nama"] ?></td>
            <td><?= $data["email"] ?></td>
            <td><?= $data["no_telp"] ?></td>
            <td>
              <a href="./?page=customerDetail&username=<?= $data['username'] ?>"><button type="button" class="btn btn-primary">DETAIL</button></a>
              <a href="./?page=customerDelete&username=<?= $data['username'] ?>" onclick="return confirm(event, './?page=customerDelete&username=<?= $data['username'] ?>', '<?= $data['username'] ?>')"><button type="button" class="btn btn-danger">HAPUS</button></a>
            </td>
          </tr>
        <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
</section>
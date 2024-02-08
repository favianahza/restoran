<?php 
$query = query("SELECT *, nama FROM transaksi LEFT JOIN customer ON transaksi.username = customer.username");
$fetch = fetchAll($query);
$total = 0;
foreach($fetch as $data){
  $total += $data["total"];
}
$num = 0;
?>
<section id="main" class="container-fluid p-2">
    <div class="row d-flex text-center g-0">
      <div class="col-12 mt-3">
        <h3>LIST RIWAYAT TRANSAKSI</h3>
        <p>Total Penghasilan: <?= rupiah($total);  ?></p>
      </div>
      <div class="col-12 px-3 table-responsive">
        <table class="cell-border shadow display align-middle" id="data_table">
          <thead>
          <tr class="montserrat">
            <th style="width: 1%" class="text-center"><h5>NO.</h5></th>
            <th style="width: 15%" class="text-center"><h5>NAMA PELANGGAN</h5></th>
            <th style="width: 60%" class="text-center"><h5>MENU</h5></th>
            <th style="width: 15" class="text-center"><h5>TOTAL</h5></th>
            <th style="width: 5%" class="text-center"><h5>TIPE</h5></th>
          </tr>
          </thead>
          <tbody>
        <?php foreach($fetch as $data) : ?>
          <tr>
            <td><?= $num=$num+1; ?></td>
            <td><?= htmlspecialchars($data["nama"]) ?></td>
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
            <td><?= htmlspecialchars(rupiah($data["total"])) ?></td>
            <td><?= htmlspecialchars($data["tipe"]) ?></td>
          </tr>
        <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
</section>
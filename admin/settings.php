<?php
if(!isset($_SESSION["privilege"])){
  return header("Location: ../index.php");
}
if(isset($_POST["submit"])){
  $password = $_POST["password"];
  $new_password = $_POST["new_password"];
  $confirm_password = $_POST["confirm_password"];

  $real_password = fetchAll(query("SELECT password FROM login WHERE username = 'admin'"))[0]["password"];
  if(!password_verify($password, $real_password)){
    echo "<script> failed ('Password lama yang dimasukan salah', './?page=settings') </script>";
    die();
  }
  
  if($new_password != $confirm_password){
    echo "<script> failed ('Konfirmasi Password yang dimasukan tidak sama!', './?page=settings') </script>";
    die();
  }
  $pass = password_hash($new_password, PASSWORD_DEFAULT);
  if( mysqli_query($connection, "UPDATE login SET password = '$pass' WHERE username = 'admin'") ){
    echo "<script> success ('Password berhasil diubah!', './?page=customers') </script>";
  }

}
?>
<section id="main" class="container-fluid p-2">
    <div class="row d-flex text-center">
      <div class="col-12 my-3">
        <h3>GANTI ADMIN PASSWORD</h3>
        <form method="POST" autocomplete="off">
              <p class="m-0"><label for="password">Password Saat Ini</label></p>
              <input class="mb-3" id="password" type="password" placeholder="Masukan Password Lama" name="password" required>
              <p class="m-0"><label for="new_password">Password Baru</label></p>
              <input class="mb-3" id="new_password" type="password" placeholder="Masukan Password Baru" name="new_password" required>
              <p class="m-0"><label for="confirm_password">Konfirmasi Password Baru</label></p>
              <input class="mb-3" id="confirm_password" type="password" placeholder="Masukan Konfirmasi Password Baru" name="confirm_password" required><br>
              <small style="text-secondary">Pastikan Password yang dimasukan telah sesuai</small><br>
              <br><input class="btn btn-dark my-2" type="submit" name="submit" value="GANTI">
        </form>
        <a href="./?page=menu"><input class="btn btn-secondary" type="submit" name="kembali" value="KEMBALI"></a>        
      </div>
    </div>
</section>
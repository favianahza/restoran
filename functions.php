<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'restoran';
$connection = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error());


function rupiah($number){
  $hasil = 'Rp. ' . number_format($number, 2, ",", ".");
  return $hasil;  
}


function query($query){
  global $connection;
  return mysqli_query($connection, $query);
}


function fetchAll($query){
  if(mysqli_num_rows($query) == 0){
    $records = [];
    return $records;
  }
  while($row = mysqli_fetch_assoc($query)){
    $records[] = $row;
  }
  return $records;
}


function register($username, $password, $nama, $no_telp, $email){
  global $connection;
  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);
  $nama = mysqli_real_escape_string($connection, $nama);
  $no_telp = mysqli_real_escape_string($connection, $no_telp);
  $email = mysqli_real_escape_string($connection, $email);

  $query = query("SELECT customer.username FROM customer LEFT JOIN login ON customer.username = login.username;");
  $records = fetchAll($query);

  // Checking username
  foreach($records as $data){
    $users[] = $data["username"];
  }

  if(in_array($username, $users) || $username == "admin" ){
    return "Username telah digunakan!";
  } else {
    $query = query("INSERT INTO login VALUES('$username', '$password', '$nama')");
    if($query){
      query("INSERT INTO customer VALUES('$username', '$email', '$nama', '$no_telp')");
    }
  }
  return 0;
}

function login($username, $password){
  global $connection;

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  // Login using username or password
  if(!strpos($username, '@')) {
    $query = query("SELECT * FROM login WHERE username = '$username'");
    $data = mysqli_fetch_assoc($query);
  } else {
    $query = query("SELECT customer.*, login.password FROM customer LEFT JOIN login ON customer.username = login.username WHERE email = '$username';");
    $data = mysqli_fetch_assoc($query);
  }
  if(mysqli_num_rows($query) == 0){
    return "Username tidak ditemukan!";
  }

  $validate = password_verify($password, $data["password"]);
  if($validate && $username == "admin"){
    $_SESSION["logged_in"] = true;
    $_SESSION["privilege"] = "admin";
    $_SESSION["username"] = $data["username"];
  } else if($validate) {
    $_SESSION["logged_in"] = true;
    $_SESSION["privilege"] = "user";
    $_SESSION["username"] = $data["username"];
  } else {
    return "Password yang dimasukan salah!";
  }
  if(isset($_POST["cookie"])) {
    setcookie("logged_in", true, time() + (86400 * 30), "/");
    setcookie("privilege", base64_encode($_SESSION["privilege"]), time() + (86400 * 30), "/");
    setcookie("username", base64_encode($_SESSION["username"]), time() + (86400 * 30), "/");
  }
  return 0;
}

function addMenu($nama, $harga, $deskripsi, $foto, $tipe){
	global $connection;

  $nama = mysqli_real_escape_string($connection, $nama);
  $harga = mysqli_real_escape_string($connection, $harga);
  $deskripsi = mysqli_real_escape_string($connection, $deskripsi);
  $foto = mysqli_real_escape_string($connection, $foto);
  $tipe = mysqli_real_escape_string($connection, $tipe);

	$file_name = $_FILES["foto"]["name"];
	$tmp_name = $_FILES["foto"]["tmp_name"];
	$error = $_FILES["foto"]["error"];
	$file_size = $_FILES["foto"]["size"];

  if( $error === 4 ){
    echo "<script>failed('Anda tidak mengupload apapun!', './?page=addMenu')</script>";
    return false;
  }

  $valid_ext = ["jpg", "png", "gif", "jpeg"];
  $ext = explode(".", $file_name);
  $ext = strtolower(end($ext));

  if( !in_array($ext, $valid_ext) ){
    echo "<script>failed('Yang anda upload bukan gambar!', './?page=addMenu')</script>";
    return false;
  }

  if( $file_size > 2000000 ){
    echo "<script>failed('Ukuran gambar yang diupload terlalu besar!', './?page=addMenu')</script>";
    return false;
  }

  $newfilename = $file_name;
  move_uploaded_file($tmp_name, "../assets/img/menu/".$newfilename);

	$query = "INSERT INTO menu VALUES('', '$nama', $harga, '$deskripsi', '$foto', '$tipe', 0)";
	mysqli_query($connection, $query);

	return mysqli_affected_rows($connection);
}


function editMenu($nama, $harga, $deskripsi, $foto, $tipe, $id){
	global $connection;

  $nama = mysqli_real_escape_string($connection, $nama);
  $harga = mysqli_real_escape_string($connection, $harga);
  $deskripsi = mysqli_real_escape_string($connection, $deskripsi);
  $foto = mysqli_real_escape_string($connection, $foto);
  $tipe = mysqli_real_escape_string($connection, $tipe);
  $id = mysqli_real_escape_string($connection, $id);

	$file_name = $_FILES["foto"]["name"];
	$tmp_name = $_FILES["foto"]["tmp_name"];
	$error = $_FILES["foto"]["error"];
	$file_size = $_FILES["foto"]["size"];

  if( $error === 4 ){
    $foto = $foto;
  } else {
    $valid_ext = ["jpg", "png", "gif", "jpeg"];
    $ext = explode(".", $file_name);
    $ext = strtolower(end($ext));
  
    if( !in_array($ext, $valid_ext) ){
      echo "<script>failed('Yang anda upload bukan gambar!', './?page=editMenu&kode_menu=$id')</script>";
      return false;
    }
  
    if( $file_size > 2000000 ){
      echo "<script>failed('Ukuran gambar yang diupload terlalu besar!', './?page=editMenu&kode_menu=$id')</script>";
      return false;
    }
  
    $newfilename = strtolower(str_replace(" ", "_", $nama)) . "." .$ext;
    // var_dump($newfilename); die();
    move_uploaded_file($tmp_name, "../assets/img/menu/".$newfilename);
    $foto = $newfilename;
  }


	$query = "UPDATE menu SET nama_menu = '$nama', harga = $harga, deskripsi = '$deskripsi', foto = '$foto', tipe = '$tipe' WHERE kode_menu = $id";
	mysqli_query($connection, $query);

	return mysqli_affected_rows($connection);
}


function printRating($rating){
  if($rating == 0){
     for($i=1; $i <= 5; $i++) echo '<span class="fa fa-star-o"></span> ';
  } else if($rating < 1) {
    echo '<span class="fa fa-star-half-o"></span> ';
    for($i=1; $i <= 4; $i++) echo '<span class="fa fa-star-o"></span> ';
  } else if($rating < 1.49) {
    echo '<span class="fa fa-star"></span> ';
    for($i=1; $i <= 4; $i++) echo '<span class="fa fa-star-o"></span> ';
  } else if($rating < 1.99 ) {
    echo '<span class="fa fa-star"></span> ';
    echo '<span class="fa fa-star-half-o"></span> ';
    for($i=1; $i <= 3; $i++) echo '<span class="fa fa-star-o"></span> ';
  } else if($rating < 2.49 ) {
    for($i=1; $i <= 2; $i++) echo '<span class="fa fa-star"></span> ';
    for($i=1; $i <= 3; $i++) echo '<span class="fa fa-star-o"></span> ';
  } else if($rating < 2.99) {
    for($i=1; $i <= 2; $i++) echo '<span class="fa fa-star"></span> ';
    echo '<span class="fa fa-star-half-o"></span> ';
    for($i=1; $i <= 2; $i++) echo '<span class="fa fa-star-o"></span> ';
  } else if($rating < 3.49 ) {
    for($i=1; $i <= 3; $i++) echo '<span class="fa fa-star"></span> ';
    for($i=1; $i <= 2; $i++) echo '<span class="fa fa-star-o"></span> ';
  } else if($rating < 3.99) {
    for($i=1; $i <= 3; $i++) echo '<span class="fa fa-star"></span> ';
    echo '<span class="fa fa-star-half-o"></span> ';
    echo '<span class="fa fa-star-o"></span> ';     
  } else if($rating < 4.49) {
    for($i=1; $i <= 4; $i++) echo '<span class="fa fa-star"></span> ';
    echo '<span class="fa fa-star-o"></span> ';
  } else if($rating < 4.99){
    for($i=1; $i <= 4; $i++) echo '<span class="fa fa-star"></span> ';
    echo '<span class="fa fa-star-half-o"></span> ';     
  } else {
    for($i=1; $i <= 5; $i++) echo '<span class="fa fa-star"></span> ';
  }
}
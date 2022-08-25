<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';
include 'firebaseRDB.php';

// menangkap data yang dikirim dari form login
// $username = $_POST['username'];
// $password = md5($_POST['password']);


// // menyeleksi data user dengan username dan password yang sesuai
// $login = mysqli_query($conn,"SELECT * FROM tb_user WHERE username='$username' and password='$password'");
// // menghitung jumlah data yang ditemukan
// $cek = mysqli_num_rows($login);

// // cek apakah username dan password di temukan pada database
// if($cek > 0){

//      $data = mysqli_fetch_assoc($login);

//      // cek jika user login sebagai admin
//      if($data['level']=="admin"){

//       // buat session login dan username
//       $_SESSION['username'] = $username;
//       $_SESSION['level'] = "admin";
//       $_SESSION['id_user'] = $data["id_user"];
//       $_SESSION['nama'] = $data["nama"];
//       // alihkan ke halaman dashboard admin
//       header("location:index.php");

//  // cek jika user login sebagai pegawai
//  }else if($data['level']=="user"){
//       // buat session login dan username
//       $_SESSION['username'] = $username;
//       $_SESSION['level'] = "user";
//       $_SESSION['id_user'] = $data["id_user"];
//       $_SESSION['nama'] = $data["nama"];
//       // alihkan ke halaman dashboard pegawai
//       header("location:index.php");

//  }else{

//       // alihkan ke halaman login kembali
//       header("location:login.php?pesan=gagal");
//  } 
// }else{
//     header("location:login.php?pesan=gagal");
// }

$_SESSION['username'] = $_GET["email"];
$_SESSION['level'] = "user";
$_SESSION['id_user'] = $_GET["uid"];
$_SESSION['nama'] = $_GET["email"];
header("location:index.php");
?>
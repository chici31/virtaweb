<?php 
session_start();
include 'koneksi.php';

if ($_SESSION["id_user"] != NULL) {
    if ($_SESSION['level'] == "admin") {
        $login = '<li class="nav-item">
        <a class="nav-link" href="admin/transaksi.php">Halaman Admin</a></li>
        <li class="nav-item">
        <a class="nav-link" href="chatting/pesan_admin.php">Live Chatting</a></li>
        <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a></li>';
    } else if ($_SESSION['level'] == "user") {
        $login = '<li class="nav-item">
        <a class="nav-link" href="shop.php">Galeri</a></li>
        <li class="nav-item">
        <a class="nav-link" href="riwayat-pembelian.php">Riwayat Pembelian</a></li>
        <li class="nav-item">
        <a class="nav-link" href="monitor_jahit.php">Monitoring Jahitan</a></li>
        <li class="nav-item">
        <a class="nav-link" href="monitor_kirim.php">Monitoring Pengiriman</a></li>
        <li class="nav-item">
        <a onclick="logout()" class="nav-link" href="logout.php">Logout</a></li>';
    }
} else {
    $login = '<li class="nav-item">
    <a class="nav-link" href="login.php">Login</a>
</li>';
}

// $id_pemesanan = "";

if($_POST["submit"]) {
    $id_product = $_POST["id_product"];
    $id_ukuran = $_POST["id_ukuran"];
    $id_kain = $_POST["id_kain"];
    $id_warna = $_POST["id_warna"];
    $qty = $_POST["qty"];
    $nama_pemesan = $_POST["nama_pemesan"];
    $no_telp = $_POST["no_telp"];
    $provinsi = $_POST["provinsi"];
    $kota = $_POST["kota"];
    $kecamatan = $_POST["kecamatan"];
    $alamat_lengkap = $_POST["alamat_lengkap"];
    $zip_code = $_POST["zip_code"];
    $no_pesanan = $_POST["no_pesanan"];
    $id_user = $_SESSION["id_user"];
    $tgl_pemesanan = date("Y-m-d H:i:s");
    $status = $_POST["status"];
    $ongkos = $_POST["ongkos"];
    $kain_harga = $_POST["kain_harga"];
    $total_harga = $_POST["total_harga"];
    $hasil_pengukuran = $_POST["hasil_pengukuran"];
    
    // var_dump($_POST);
    // die();


    $q = mysqli_query($conn, "INSERT INTO tb_pemesanan VALUES (NULL, '$no_pesanan', '$id_user', '$no_telp','$id_product', '$id_ukuran', '$id_kain', '$id_warna', '$qty', '$tgl_pemesanan', '$status', '$ongkos', '$kain_harga', '$total_harga', '$nama_pemesan', '$provinsi', '$kota', '$kecamatan', '$alamat_lengkap', '$zip_code', '$hasil_pengukuran')");
    
    if($q) {
        $g = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE id_product = '".$id_product."' AND id_ukuran = '".$id_ukuran."' AND id_kain = '".$id_kain."' AND id_user = '".$id_user."' ORDER BY id_pemesanan DESC LIMIT 1");
        // $g = mysqli_query($conn, "SELECT * FROM tb_pemesanan ORDER BY id_pemesanan DESC LIMIT 1");
        $p = mysqli_fetch_assoc($g);
        $id_pemesanan = $p["no_pesanan"];
        header("location:pembayaran.php?id_pemesanan=$id_pemesanan");
    } else {
        print_r($id_product);
        echo $q."----".mysqli_error($conn);
        die();
    }
    
    // if(isset($_SESSION["foto_ukuran"]) && $_

    
} else if ($_GET["id_pemesanan"]) {
    $g = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE no_pesanan = '".$_GET["id_pemesanan"]."'");
    $p = mysqli_fetch_assoc($g);
    $id_pemesanan = $p["id_pemesanan"];
} else {
    echo "halaman tidak ada";
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charshet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Tailor | Pembayaran</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="style.css">

    <style>
        .small-img-group {
            display: flex;
            justify-content: space-between;
        }
        
        .small-img-col {
            flex-basis: 24%;
            cursor: pointer;
        }
        
        .sproduct select {
            display: block;
            padding: 5px 10px;
        }
        
        .sproduct input {
            width: 50px;
            height: 40px;
            padding-left: 10px;
            font-size: 16px;
            margin-right: 10px;
        }
        
        .sproduct input:focus {
            outline: none;
        }
        
        .buy-btn {
            background: #fb774b;
            opacity: 1;
            transition: 0.3s all;
        }
    </style>
</head>

<body>

    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"> <span>VIR</span>TA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <?= $login ?>

            </div>
        </div>
    </nav>

    <section id="featured" class="my-5 py-5">
        <div class="container mt-5 py-5">
            <h2 class="font-weight-bold">Pembayaran</h2>
            <hr>
        </div>
        <form action="selesai.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id_pemesanan" value="<?= $id_pemesanan ?>">
                    <label for="">Asal Bank</label>
                    <select class="form-control my-1" name="asal_bank">
                        <option>Pilih Bank</option>
                        <option value="BNI">BNI</option>
                        <option value="MANDIRI">Mandiri</option>
                        <option value="BCA">BCA</option>
                    </select>
                    <label for="">Nama Pengirim</label>
                    <input type="text" class="form-control w-100" name="nama_pengirim">
                    <label for="">Bukti Transfer</label>
                    <input type="file" class="form-control w-100" name="bukti_transfer" >
                    <P></P>
                    <input type="submit" name="submit" class="btn buy-btn" value="Konfirmasi Pembayaran">
                </div>

                <div class="col-md-6">
                    <div class="col-md-12 alert alert-success">
                        <p>
                            <b>Pembayaran melalui transfer ke rekening berikut:</b>
                        </p>
                        <p>
                            BANK MANDIRI
                        </p>
                        <p>
                            1234567890 
                        </p>
                        <p>
                            a/n CHICI NURIL HIDAYAH
                        </p>
                        <p>
                            Total Pembayaran: Rp.<?= number_format($p["total_harga"],0,',','.'); ?>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>

    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <a class="navbar-brand" href="#" style="color: white;"> <span>VIR</span>TA</a>
                <p class="pt-3">Website implementasi e-tailor dengan pengukuran, pemesanan dan monitoring penjahitan secara online dan mudah.</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h5 class="pb-2">Kontak Kami</h5>
                <div>
                    <h6 class="text-uppercase">Alamat</h6>
                    <p>RAYA ITS, SUB, ID</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Telepon</h6>
                    <p>(+62) 123-4567</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>admin@mail.com</p>
                </div>
            </div>
            <!--<div class="footer-one col-lg-3 col-md-6 col-12">-->
            <!--    <h5 class="pb-2">Instagram</h5>-->
            <!--    <div class="row">-->
            <!--        <img class="img-fluid w-25 h-100 m-2" src="img/insta/1.jpg" alt="">-->
            <!--        <img class="img-fluid w-25 h-100 m-2" src="img/insta/2.jpg" alt="">-->
            <!--        <img class="img-fluid w-25 h-100 m-2" src="img/insta/3.jpg" alt="">-->
            <!--        <img class="img-fluid w-25 h-100 m-2" src="img/insta/4.jpg" alt="">-->
            <!--        <img class="img-fluid w-25 h-100 m-2" src="img/insta/5.jpg" alt="">-->
            <!--    </div>-->
            <!--</div>-->
        </div>

        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <!--<div class="col-lg-3 col-md-6 col-12 mb-4">-->
                <!--    <img src="img/payment.png" alt="">-->
                <!--</div>-->
                <div class="col-lg-4 col-md-6 col-12 text-nowrap mb-2">
                    <p>Virtual Tailor © 2022. All Rights Reserved</p>
                </div>
                <!--  <div class="col-lg-4 col-md-6 col-12">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                </div> -->
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        var MainImg = document.getElementById('MainImg');
        var smallimg = document.getElementsByClassName('small-img');

        smallimg[0].onclick = function() {
            MainImg.src = smallimg[0].src;
        }
        smallimg[1].onclick = function() {
            MainImg.src = smallimg[1].src;
        }
        smallimg[2].onclick = function() {
            MainImg.src = smallimg[2].src;
        }
        smallimg[3].onclick = function() {
            MainImg.src = smallimg[3].src;
        }
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>

</html>
<?php 
session_start();
include 'koneksi.php';

if ($_SESSION["id_user"] != NULL) {
    if ($_SESSION['level'] == "admin") {
        $login = '<li class="nav-item">
        <a class="nav-link" href="admin/transaksi.php">Halaman Admin</a></li>
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

if (isset($_POST["terimaPaket"])) {

    $id_pemesanan = $_POST["id_pemesanan"];
  
    $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 13 where id_pemesanan = '$id_pemesanan'");
    if (!$insert) {
      echo mysqli_error($conn);
    }
  } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charshet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Tailor | Monitoring Pengiriman</title>

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
    <!-- Modal -->
    <?php
    include 'koneksi.php';
    $no = 1;
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product where tb_pemesanan.id_user = '".$_SESSION["id_user"]."'");

    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {
        
    ?>
    <div class="modal fade" id="<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <label><h3><b>Product</b></h3></label>
                    <hr>
                </div>

                <div class="col-md-6">
                    <label><b>Nama Model</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["nama"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Ukuran</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["nama_ukuran"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Jenis Kain</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["nama_kain"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Penggunaan Kain</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["prediksi"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Jumlah</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["qty"] ?></p>
                </div>

                <!-- Alamat -->

                <div class="col-md-12">
                    <label><h3><b>Alamat</b></h3></label>
                    <hr>
                </div>
                
                <div class="col-md-6">
                    <label><b>Nama Pemesan</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["nama_penerima"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Alamat Lengkap</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["alamat_lengkap"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Kecamatan</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["kecamatan"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Kota</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["kota"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Kode Pos</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["zip_code"] ?></p>
                </div>

                <!-- Rincian Harga -->

                <div class="col-md-12">
                    <label><h3><b>Rincian Harga</b></h3></label>
                    <hr>
                </div>
                
                <div class="col-md-6">
                    <label><b>Harga Kain</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p>Rp.<?= $riwayatModal["kain_harga"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Biaya Jahit</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p>Rp.<?= $riwayatModal["ongkos"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Total Harga</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p>Rp.<?= $riwayatModal["total_harga"] ?></p>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <?php
    }
    ?>

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

    <section id="blog-home" class="pt-5 mt-5 container">
        <h2 class="font-weight-bold pt-5">Monitoring Pengiriman</h2>
        <hr>
    </section>

    <section id="cart-container" class="container my-5">
        <table width="100%">
            <thead>
                <tr>
                    <td>No</td>
                    <td>No Pesanan</td>
                    <td>Tgl Pemesanan</td>
                    <td>Total Harga</td>
                    <td>Status</td>
                    <td>Detail</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $no = 1;
                $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status where tb_pemesanan.id_user = '".$_SESSION["id_user"]."'");

                while ($riwayat = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {
                    
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $riwayat["no_pesanan"] ?></td>
                        <td>
                            <h5><?= $riwayat["tgl_pemesanan"] ?></h5>
                        </td>
                        <td>
                            <h5>Rp.<?= number_format($riwayat["total_harga"],0,',','.'); ?></h5>
                        </td>
                        <td>
                            <?php
                                $status = $riwayat["id_status"];
                                if($status < 8) {
                                    echo '<h6>Menunggu Proses Jahitan</h6>';
                                } else if ($status == 8) {
                                    echo '<h6 style="color: black;">Paket Pickup</h6>';
                                } else if ($status == 9) {
                                    echo '<h6 style="color: black;">Paket In Transit</h6>';
                                } else if ($status == 10) {
                                    echo '<h6 style="color: black;">Paket Receive In Destination</h6>';
                                } else if ($status == 11) {
                                    echo '<h6 style="color: black;">Paket Delivered</h6>';
                                } else if ($status == 12) {
                                    echo '<button type="submit" name="terimaPaket" class="btn btn-danger"><i class="fa fa-check"></i> Paket Sudah Sampai </button>';
                                } else if ($status == 13) {
                                    echo '<h6 style="color: black;">Pesanan Selesai</h6>';
                                }
                            ?>
                        </td>
                        <td>
                            <h5><button type="button" data-toggle="modal" data-target="#<?= $riwayat["no_pesanan"] ?>" class="buy-btn" style="background-color: black;">Detail</button></h5>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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
    <script>
    function belumLogin() {
        return alert("anda harus masuk terlebih dahulu");
    }
    </script>
</body>

</html>
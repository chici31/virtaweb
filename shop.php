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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charshet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Tailor | Galeri</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="style.css">

    <style>
        .product img {
            width: 100%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        }
        
        #featured>div.row.mx-auto.container>nav>ul>li.page-item.active>span {
            background-color: coral;
        }
        
        #featured>div.row.mx-auto.container>nav>ul>li:nth-child(n):hover>a {
            background-color: gray;
            color: #fff;
        }
        
        .pagination a {
            color: black;
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
            <h2 class="font-weight-bold">Galeri Model</h2>
            <hr>
            <p>Model pilihan dari Virtual Tailor.</p>
        </div>
        <div class="row mx-auto container">

        <?php
        include 'koneksi.php';
        $q = "select * from tb_product";
        $cek = mysqli_query($conn, $q);
        // $results = mysqli_fetch_assoc($cek);
        while ($row = mysqli_fetch_array($cek, MYSQLI_ASSOC)) {
        ?>
            <div class="product text-center col-lg-3 mb-5 col-md-3 col-sm-3 col-xs-3">
                <img src="img/katalog/<?= $row["foto"] ?>" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?= $row["nama"] ?></h5>
                <!-- <h4 class="p-price"></h4> -->
                <button onclick="window.location.href='product.php?id=<?= $row['id_product'] ?>';" class="buy-btn">Beli</button>
            </div>
        <?php
        }
        ?>
            
            <div class="container mt-5 py-5">
                <h2 class="font-weight-bold">Galeri Kain</h2>
                <hr>
                <p>Katalog kain Virtual Tailor.</p>
            </div>
            <div class="row mx-auto container">
                <?php
                include 'koneksi.php';
                $k = "select * from tb_kain";
                $cek = mysqli_query($conn, $k);
                // $results = mysqli_fetch_assoc($cek);
                while ($row = mysqli_fetch_array($cek, MYSQLI_ASSOC)) {
                ?>
                <div class="product text-center col-lg-3 mb-5 col-md-3 col-sm-3 col-xs-3">
                    <img src="img/kain/<?= $row["foto_kain"] ?>" alt="">
                    <h5 class="p-name"><?= $row["nama_kain"] ?></h5>
                    <h4 class="p-price">Rp.<?= number_format($row["harga"],0,',','.'); ?>/meter</h4>
                </div>
                <?php
                }
                ?>
            </div>
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
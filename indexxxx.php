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
        <a class="nav-link" href="logout.php">Logout</a></li>';
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
    <title>Virtual Tailor</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"> <span>VIR</span>TA</a>
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

    <section id="home">
        <div class="container">
            <h5>WELCOME TO</h5>
            <h1><span>Virtual</span> Tailor</h1>
            <p>Lakukan pengukuran dan jahitin sesukamu!</p>
            <button onclick="window.location.href='shop.php';">Jahit Sekarang</button>
        </div>
    </section>

    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img class="img-fluid" src="img/jahit.jpg" alt="">
                <div class="details">
                    <h2>Sudah dapat ukuran? <br>Yuk jahit!</h2>
                    <button onclick="window.location.href='shop.php';" class="text-uppercase">disini</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img class="img-fluid" src="img/ukur.jpg" alt="">
                <div class="details">
                    <h2>Belum dapat ukuran? <br>Yuk ukur!</h2>
                    <button class="text-uppercase">disini</button>
                </div>
            </div>
            <div class="one col-lg-4 col-md-12 col-12 p-0">
                <img class="img-fluid" src="img/bag.jpg" alt="">
                <div class="details">
                    <h2>Bingung cara belanja?<br>Yuk baca!</h2>
                    <button class="text-uppercase">disini</button>
                </div>
            </div>
        </div>
    </section>

    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Model Terbaik</h3>
            <hr class="mx-auto">
            <p>Rekomendasi model gamis unggulan dari Virtual Tailor.</p>
        </div>

        <div class="row mx-auto containter-fluid">
        <?php
        include 'koneksi.php';
        $q = "select * from tb_product";
        $cek = mysqli_query($conn, $q);
        // $results = mysqli_fetch_assoc($cek);
        while ($row = mysqli_fetch_array($cek, MYSQLI_ASSOC)) {
        ?>
            <!--<div class="product text-center col-lg-3 mb-5 col-md-3 col-sm-3 col-xs-3 mx-auto" >-->
            <div class="product text-center col-lg-6 mb-5 col-md-6 col-sm-6 col-xs-6 mx-auto">
                <img src="<?= $row["foto"] ?>" alt="">
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
        </div>
        
    </section>

    <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <a class="navbar-brand" href="#" style="color: white;"> <span>VIR</span>TA</a>
                <p class="pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-12 mb-3">
                <h5 class="pb-2">Kontak Kami</h5>
                <div>
                    <h6 class="text-uppercase">Alamat</h6>
                    <p>STREET NAME 123, CITY, ID</p>
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
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/1.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/2.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/3.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/4.jpg" alt="">
                    <img class="img-fluid w-25 h-100 m-2" src="img/insta/5.jpg" alt="">
                </div>
            </div>
        </div>

        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <img src="img/payment.png" alt="">
                </div>
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


    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

</body>

</html>
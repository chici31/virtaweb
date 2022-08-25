<?php
session_start();
include 'koneksi.php';

if($_POST["submit"]) {
    $id_product = $_POST["id_product"];
    $id_ukuran = $_POST["id_ukuran"];
    $id_kain = $_POST["id_kain"];
    $qty = $_POST["qty"];
    $nama_product = $_POST["nama_product"];
    $foto = $_POST["foto"];
    $nama_pemesan = $_POST["nama_pemesan"];
    $no_telp = $_POST["no_telp"];
    $provinsi = $_POST["provinsi"];
    $kota = $_POST["kota"];
    $kecamatan = $_POST["kecamatan"];
    $alamat_lengkap = $_POST["alamat_lengkap"];
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
    <title>Virtual Tailor | Cart</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

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
                    <li class="nav-item">
                        <a class="nav-link" href="shop.html">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="riwayat-pembelian.php">Riwayat Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="monitor_jahit.php">Monitoring Jahitan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="monitor_kirim.php">Monitoring Pengiriman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>

            </div>
        </div>
    </nav>

    <section id="blog-home" class="container">
        <h2 class="font-weight-bold pt-5">Shopping Cart</h2>
        <hr>
    </section>

    <section id="cart-container" class="container my-5">
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Model</td>
                    <td>Detail</td>
                    <td>Quantity</td>
                    <td>Alamat</td>
                    <td>Price</td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><img src="<?= $foto ?>" width="70%" class="p-2"></td>
                    <td>
                        <h5><?= $nama_product ?></h5>
                    </td>

                    <td>
                        <?php
                            $u = mysqli_query($conn, "select * from tb_ukuran where id_ukuran = '".$id_ukuran."'");
                            $ukr = mysqli_fetch_assoc($u);
                            $k = mysqli_query($conn, "select * from tb_kain where id_kain = '".$id_kain."'");
                            $kain = mysqli_fetch_assoc($k);
                        ?>
                        <h5>Ukuran: <?= $ukr["nama_ukuran"] ?></h5>
                        <h5>Jenis Kain: <?= $kain["nama_kain"] ?></h5>
                        <h5>Penggunaan Kain: 3 Meter</h5>
                    </td>
                    <td><?= $qty ?></td>
                    <td><?= $alamat_lengkap ?></td>
                    <td>RP 200.000 </td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: right;">
            <button class="buy-btn">Lanjutkan ke Pembayaran</button>
        </p>

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
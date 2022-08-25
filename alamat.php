<?php 
session_start();
include 'koneksi.php';
header("Cache-Control: max-age=300, must-revalidate"); 

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


if(isset($_POST["submit"])) {
    $id_product = $_POST["id_product"];
    $id_ukuran = $_POST["id_ukuran"];
    $id_kain = $_POST["id_kain"];
    if ($_POST["id_warna"] != "") {
        $id_warna = $_POST["id_warna"];
    } else if ($_POST["id_warna_motif"] != "") {
        $id_warna = $_POST["id_warna_motif"];
    }
    $qty = $_POST["qty"];
    $nama_product = $_POST["nama_product"];
    $foto = $_POST["foto"];
    $hasil_pengukuran = $_POST["hasil_pengukuran"];

    include 'vendor/autoload.php';
    
    $client = new GuzzleHttp\Client(['http_errors' => false]);

    $link = "https://firestore.googleapis.com/v1/projects/virta-apps/databases/(default)/documents/users/".$_SESSION['id_user']."/histories/".$hasil_pengukuran;

    // echo $link;
    // die();
    
    $response = $client->get($link);
    $statuscode = $response->getStatusCode();

    if ($statuscode == 404) {
        // header("product.php?id=".$id_product);
        header("Location: product.php?id=$id_product&error=true");
        die();
        // echo "<script>window.location.href='product.php</script>";
    }
    
    $body = $response->getBody();
    
    $result = json_decode($body->getContents(), TRUE);

    // var_dump($result);
    // die();

    
} else if (isset($_POST["belum_login"])) {
    echo "anda harus login terlebih dahulu";
    die();
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
    <title>Virtual Tailor | Product Details</title>

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

    <section class="container sproduct my-5 pt-5">
        <div class="row mt-5">
            <!--<div class="col-lg-5 col-md-12 col-12">-->
            <!--    <img class="img-fluid w-100 pb-2" src="/img/katalog/<?= $foto ?>" id="MainImg">-->

            <!--</div>-->
            <!-- <form action="" class="form"> -->
            <div class="col-lg-6 col-md-12 col-12">
                <form action="details.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_product" value="<?= $id_product ?>">
                    <input type="hidden" name="id_ukuran" value="<?= $id_ukuran ?>">
                    <input type="hidden" name="id_kain" value="<?= $id_kain ?>">
                    <input type="hidden" name="id_warna" value="<?= $id_warna ?>">
                    <input type="hidden" name="qty" value="<?= $qty ?>">
                    <input type="hidden" name="foto" value="<?= $foto ?>">
                    <input type="hidden" name="nama_product" value="<?= $nama_product ?>">
                    <input type="hidden" name="hasil_pengukuran" value="<?= $hasil_pengukuran ?>">

                    <!-- <h6>Home / Gamis</h6> -->
                    <h3>Data Alamat</h3>
                    <p class="pb-4">Lengkapi data alamat untuk pengiriman </p>
                    <!--<label for="">Nama Penerima</label>-->
                    <!--<input type="text" class="form-control w-50" name="nama_pemesan">-->

                    <label for=""><b>No. Telepon</b></label>
                    <input type="text" class="form-control w-50" name="no_telp">

                    <label for=""><b>Alamat Lengkap</b></label>
                    <textarea class="form-control rounded-0" rows="3" name="alamat_lengkap"></textarea>
                    
                    <label for=""><b>Provinsi</b></label>
                    <input type="text" class="form-control w-50" name="provinsi">
                    
                    <label for=""><b>Kota</b></label>
                    <input style="display:none" type="text" class="form-control w-50" name="kota" value="<?= $result['fields']['address']['stringValue'] ?>">
                    <input type="text" class="form-control w-50" value="<?= $result['fields']['address']['stringValue'] ?>" disabled>
                    
                    <label for=""><b>Kecamatan</b></label>
                    <input type="text" class="form-control w-50" name="kecamatan">

                    <label for=""><b>Kode Pos</b></label>
                    <input type="text" class="form-control w-50" name="zip_code">
                    <p></p>
                    <!-- <button class="buy-btn">Lanjutkan ke Pemesanan</button> -->

                    <input type="submit" name="submit" value="LANJUTKAN KE CART" class="btn buy-btn w-50">
 
                    <a href="javascript:history.go(-1)" class="btn buy-btn w-50" style="background-color: #333;">Kembali</a>

                    </div>
                    
                </form>
            </div>
            <!-- </form> -->
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
</body>

</html>
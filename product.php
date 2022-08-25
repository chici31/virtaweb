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

if ($_GET["id"] == NULL) {
    echo "barang tidak ditemukan";
    die();
} else {
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "true") {
            echo "<script>alert('ID Pengukuran Salah')</script>";
        }
    }
    
    include 'vendor/autoload.php';
    
    $client = new GuzzleHttp\Client(['http_errors' => false]);

    $link = "https://firestore.googleapis.com/v1/projects/virta-apps/databases/(default)/documents/users/".$_SESSION['id_user']."/histories";

    // echo $link;
    // die();
    
    $response = $client->get($link);
    $body = $response->getBody();
    $result = json_decode($body->getContents(), TRUE);

    // echo count($result["documents"]);
    // die();

    $id_product = $_GET["id"];
    $q = mysqli_query($conn, "select * from tb_product where id_product = '$id_product'");
    while($row = mysqli_fetch_assoc($q)) {

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
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
            <div class="col-lg-5 col-md-12 col-12">
                <img class="img-fluid w-100 pb-2" src="/img/katalog/<?= $row["foto"] ?>" id="MainImg">

            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="row">
                    <h6 class="col-md-12">Home / Gamis</h6>
                </div>
                <form action="alamat.php" method="post" class="col-md-12" enctype="multipart/form-data">
                    <h3 class="py-4"><?= $row["nama"] ?></h3>
                    <input type="hidden" name="id_product" value="<?= $row["id_product"] ?>">
                    <input type="hidden" name="nama_product" value="<?= $row["nama"] ?>">
                    <input type="hidden" name="foto" value="<?= $row["foto"] ?>">

                    <div class="row">
                    <select class="col-md-5 mb-3" name="hasil_pengukuran">
                        <option>Pilih Riwayat Pengukuran</option>
                        <?php
                        $no = 1;
                        foreach ($result["documents"] as $hasilPengukuran) {
                        $id_hasil_pengukuran = substr($hasilPengukuran["name"],-20);
                        ?>
                        <!-- <option value="<?= $id_hasil_pengukuran ?>"><?= $hasilPengukuran["fields"]["name"]["stringValue"] ?> - <?= $hasilPengukuran["fields"]["ukuran"]["stringValue"] ?> - <?= $id_hasil_pengukuran ?></option> -->

                        <option value="<?= $id_hasil_pengukuran ?>">Badan: <?= $hasilPengukuran["fields"]["badan"]["stringValue"] ?> - Bahu: <?= $hasilPengukuran["fields"]["bahu"]["stringValue"] ?> - Tangan: <?= $hasilPengukuran["fields"]["tangan"]["stringValue"] ?> - <?= $hasilPengukuran["fields"]["name"]["stringValue"] ?> - <?= $hasilPengukuran["fields"]["ukuran"]["stringValue"] ?> - <?= $hasilPengukuran["fields"]["type"]["stringValue"] ?></option>
                        <?php } ?>
                    </select>
                    <!-- <input type="text" name="hasil_pengukuran" class="my-3 col-md-5" placeholder="Masukkan ID Pengukuran"> -->

                    <select class="my-3 col-md-5" name="id_ukuran" style="display:none">
                        <option>Pilih Ukuran</option>
                        <?php
                        $ukr = mysqli_query($conn, "select * from tb_ukuran");
                        while($ukuran = mysqli_fetch_array($ukr, MYSQLI_ASSOC)) {
                        ?>
                        <option value="<?= $ukuran["id_ukuran"] ?>"><?= $ukuran["nama_ukuran"] ?></option>
                        <?php } ?>
                    </select>
                    </div>

                    <div class="row">
                    <select class="col-md-5 mb-3" name="id_kain" id="kain">
                        <option>Pilih Kain</option>
                        <?php
                        $kains = mysqli_query($conn, "select * from tb_list join tb_kain on tb_kain.id_kain=tb_list.id_kain where id_product = '".$id_product."'");
                        while($kain = mysqli_fetch_array($kains, MYSQLI_ASSOC)) {
                        ?>
                        <option value="<?= $kain["id_kain"] ?>"><?= $kain["nama_kain"] ?></option>
                        <?php } ?>
                    </select>

                    <!-- <div class="custom-file col-md-6 mb-3 mx-1">
                        <input type="file" class="form-control" style="width: 100%;" name="foto_ukuran">
                    </div> -->
                    </div>
                    <div class="row">
                    <select class="col-md-5 mb-3" name="id_warna" id="warna">
                        <option value="">Pilih Warna</option>
                        <?php
                        $warnas = mysqli_query($conn, "select * from tb_warna where jenis = 0");
                        while($warna = mysqli_fetch_array($warnas, MYSQLI_ASSOC)) {
                        ?>
                        <option value="<?= $warna["id_warna"] ?>"><?= $warna["warna"] ?></option>
                        <?php } ?>
                    </select>
                    <select class="col-md-5 mb-3" name="id_warna_motif" id="warna-motif">
                        <option value="">Pilih Motif</option>
                        <?php
                        $warnas = mysqli_query($conn, "select * from tb_warna where jenis = 1");
                        while($warna = mysqli_fetch_array($warnas, MYSQLI_ASSOC)) {
                        ?>
                        <option value="<?= $warna["id_warna"] ?>"><?= $warna["warna"] ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="row">
                    <input type="number" value="1" name="qty" class="col-md-2 mt-1">
                    <!-- <a href="alamat.php"><button class="buy-btn">Pesan</button></a> -->

                    <?php if(isset($_SESSION["id_user"])){ ?>
                        <input type="submit" name="submit" value="PESAN" class="btn buy-btn col-md-6">
                    <?php } else { ?>
                        <a href="javascript:belumLogin()" class="button btn btn-buy col-md-6">PESAN</a>
                    <?php } ?>
                    </div>
                    <h4 class="mt-5 mb-5">Deskripsi Produk</h4>
                    <span><?= $row["deskripsi"] ?></span>
                </form>
            </div>
        </div>
    </section>

    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Pilihan Kain</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto containter-fluid">
            <?php
            // $kainn = mysqli_query($conn, "select * from tb_kain");
            $kainn = mysqli_query($conn, "select * from tb_list join tb_kain on tb_kain.id_kain=tb_list.id_kain where id_product = '".$id_product."'");
            while($kainz = mysqli_fetch_array($kainn, MYSQLI_ASSOC)) {
            ?>
            <div class="product text-center col-lg-3 mb-5 col-md-3 col-sm-3 col-xs-3">
                <img src="/img/kain/<?= $kainz["foto_kain"]?>" alt="">
                <h5 class="p-name"><?= $kainz["nama_kain"]?></h5>
                <h5 class="p-name">Rp.<?= number_format($kainz["harga"],0,',','.'); ?>/meter</h5>
            </div>
            <?php
            }
            ?>
            </div>
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

    <script type="text/javascript">
        $("#warna").hide();
        $("#warna-motif").hide();
        $(document).ready(function() {
            $("#kain").change(function() {
                // console.log("asu");
                var kain = $("#kain").val();
                if(kain != 2) {
                    $("#warna").show();
                    $("#warna-motif").hide();
                } else {
                    $("#warna").hide();
                    $("#warna-motif").show();
                }
            });
        })
    </script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script>
    function belumLogin() {
        return alert("anda harus masuk terlebih dahulu");
    }
    </script>

    
</body>

</html>
<?php
    }
}
?>
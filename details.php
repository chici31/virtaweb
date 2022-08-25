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
// print_r($_POST["id_warna"]);
    // die();
    


if($_POST["submit"]) {

    $id_product = $_POST["id_product"];
    
    $id_kain = $_POST["id_kain"];
    $id_warna = $_POST["id_warna"];
    $qty = $_POST["qty"];
    $nama_product = $_POST["nama_product"];
    $foto = $_POST["foto"];
    $nama_pemesan = $_SESSION['nama'];
    $no_telp = $_POST["no_telp"];
    $provinsi = $_POST["provinsi"];
    $kota = $_POST["kota"];
    $kecamatan = $_POST["kecamatan"];
    $alamat_lengkap = $_POST["alamat_lengkap"];
    $zip_code = $_POST["zip_code"];
    $hasil_pengukuran = $_POST["hasil_pengukuran"];
    
    
    
    
    // echo $hasil_pengukuran;
    // die();
    

    // $foto_ukuran = $_FILES["foto_ukuran"];

    // var_dump($_SESSION["foto_ukuran"]);
    // die();
    include 'vendor/autoload.php';
    
    $client = new GuzzleHttp\Client(['http_errors' => false]);

    $users = "https://firestore.googleapis.com/v1/projects/virta-apps/databases/(default)/documents/users/".$_SESSION['id_user'];
    $response_user = $client->get($users);

    
    $body_user = $response_user->getBody();
    
    $result_user = json_decode($body_user->getContents(), TRUE);

    $link = "https://firestore.googleapis.com/v1/projects/virta-apps/databases/(default)/documents/users/".$_SESSION['id_user']."/histories/".$hasil_pengukuran;

    // echo $link;
    // die();
    
    $response = $client->get($link);
    $statuscode = $response->getStatusCode();

    if ($statuscode == 404) {
        echo "ID pengukuran anda salah";
        die();
    }
    
    $body = $response->getBody();
    
    $result = json_decode($body->getContents(), TRUE);

    
    
    // var_dump($result);
    // echo $result;
    // die();
    
    $ukurans = mysqli_query($conn, "select * from tb_ukuran where nama_ukuran = '".$result["fields"]["ukuran"]["stringValue"]."'");
    $ukuran = mysqli_fetch_assoc($ukurans);
    
    // echo $id_ukuran["id_ukuran"];
    // die();

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
            <h2 class="font-weight-bold">Detail Pesanan</h2>
            <hr>
        </div>
        <form action="pembayaran.php" method="post" enctype="multipart/form-data">
        <?php
            $no_pesanan = "VT".date("Ymd").rand(10,100);
        ?>
        <input type="hidden" name="no_pesanan" value="<?= $no_pesanan ?>">
        <input type="hidden" name="id_user" value="<?= $id_user ?>">
        <input type="hidden" name="no_telp" value="<?= $no_telp ?>">
        <input type="hidden" name="id_product" value="<?= $id_product ?>">
        <input type="hidden" name="id_ukuran" value="<?= $ukuran["id_ukuran"] ?>">
        <input type="hidden" name="id_kain" value="<?= $id_kain ?>">
        <input type="hidden" name="id_warna" value="<?= $id_warna ?>">
        <input type="hidden" name="qty" value="<?= $qty ?>">
        <input type="hidden" name="tgl_pemesanan" value="<?= $tgl_pemesanan ?>">
        <input type="hidden" name="status" value="1"><!-- menunggu konfirmasi -->
        <input type="hidden" name="provinsi" value="<?= $provinsi ?>">
        <input type="hidden" name="kota" value="<?= $kota ?>">
        <input type="hidden" name="kecamatan" value="<?= $kecamatan ?>">
        <input type="hidden" name="alamat_lengkap" value="<?= $alamat_lengkap ?>">
        <input type="hidden" name="zip_code" value="<?= $zip_code ?>">
        <input type="hidden" name="nama_pemesan" value="<?= $result_user["fields"]["name"]["stringValue"] ?>">
        <input type="hidden" name="hasil_pengukuran" value="<?= $hasil_pengukuran ?>">
        <div class="container">
            <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <p>
                                    <img src="../img/katalog/<?= $foto ?>" width="90%" class="p-2">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $u = mysqli_query($conn, "select * from tb_ukuran where id_ukuran = '".$ukuran["id_ukuran"]."'");
                                $ukr = mysqli_fetch_assoc($u);
                                $k = mysqli_query($conn, "select * from tb_kain where id_kain = '".$id_kain."'");
                                $kain = mysqli_fetch_assoc($k);
                                $w = mysqli_query($conn, "select * from tb_warna where id_warna = '".$id_warna."'");
                                $warna = mysqli_fetch_assoc($w);
                                $pk = mysqli_query($conn, "select * from tb_prediksi where id_product = '".$id_product."' and id_ukuran = '".$ukuran["id_ukuran"]."'");
                                $predik = mysqli_fetch_assoc($pk);
                                ?>

                                <h4><b>Detail Pesanan</b></h4>

                                <label for=""><b>Model:</b></label>
                                <?= $nama_product  ?><br>

                                <!--<label for=""><b>Ukuran:</b></label>-->
                                <!--<?= $ukr["nama_ukuran"] ?><br>-->

                                <label for=""><b>Jenis Kain:</b></label>
                                <?= $kain["nama_kain"] ?><br>

                                <label for=""><b>Warna/Motif:</b></label>
                                <?= $warna["warna"] ?><br>

                                <!--<label for=""><b>Penggunaan Kain:</b></label>-->
                                <!--<?= $predik["pl"] ?><br>-->

                                <label for=""><b>Jumlah:</b></label>
                                <?= $qty ?><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-bottom: 20px;">
                        
                        <h4><b>Alamat</b></h4>

                        <label for=""><b>Nama Pemesan:</b></label>
                        <?= $result_user["fields"]["name"]["stringValue"] ?><br>

                        <label for=""><b>Alamat Lengkap:</b></label>
                        <?= $alamat_lengkap ?><br>

                        <label for=""><b>Kecamatan:</b></label>
                        <?= $kecamatan ?><br>

                        <label for=""><b>Kota:</b></label>
                        <?= $kota ?><br>

                        <label for=""><b>Kode Pos:</b></label>
                        <?= $zip_code ?><br>

                    </div>
                    <div class="col-md-6" style="padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-md-4">
                                <?php
                                $gambar_kains = mysqli_query($conn, "select * from tb_gambarkain where id_kain = '".$id_kain."' and id_warna = '".$id_warna."'");
                                $gambar_kain = mysqli_fetch_assoc($gambar_kains);

                                ?>
                                <p>
                                    <img src="<?= $gambar_kain["gambar"] ?>" width="90%" class="p-2">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h4><b>Detail Ukuran</b></h4>

                                <label for=""><b>Ukuran:</b></label>
                                <?= $result["fields"]["ukuran"]["stringValue"] ?><br>
        
                                <label for=""><b>Panjang Tangan:</b></label>
                                <?= $result["fields"]["tangan"]["stringValue"] ?> cm<br>
        
                                <label for=""><b>Lebar Bahu:</b></label>
                                <?= $result["fields"]["bahu"]["stringValue"] ?> cm<br>
        
                                <label for=""><b>Tinggi Badan:</b></label>
                                <?= $result["fields"]["badan"]["stringValue"] ?> cm<br>
        
                                <label for=""><b>Penggunaan Kain:</b></label>
                                <?php 
                                $panjang = 0;
                                if ($id_product==1) {
                                    if ($result["fields"]["ukuran"]["stringValue"] == "S") {
                                        $panjangResult = ($result["fields"]["badan"]["stringValue"]+34)/100;
                                    } else if ($result["fields"]["ukuran"]["stringValue"] == "M") {
                                        $panjangResult = ($result["fields"]["badan"]["stringValue"]+36)/100;
                                    } else if ($result["fields"]["ukuran"]["stringValue"] == "L") {
                                        $panjangResult = ($result["fields"]["badan"]["stringValue"]+38)/100;
                                    } else if ($result["fields"]["ukuran"]["stringValue"] == "XL") {
                                        $panjangResult = ($result["fields"]["badan"]["stringValue"]+40)/100;
                                    }
                                } else {
                                     if ($result["fields"]["ukuran"]["stringValue"] == "S") {
                                        $panjangResult = ($result["fields"]["badan"]["stringValue"]+34+13)/100;
                                    } else if ($result["fields"]["ukuran"]["stringValue"] == "M") {
                                        $panjangResult = ($result["fields"]["badan"]["stringValue"]+36+13)/100;
                                    } else if ($result["fields"]["ukuran"]["stringValue"] == "L") {
                                        $panjangResult = ($result["fields"]["badan"]["stringValue"]+34+30)/100;
                                    } else if ($result["fields"]["ukuran"]["stringValue"] == "XL") {
                                        $panjangResult = ($result["fields"]["badan"]["stringValue"]+34+30)/100;
                                    }
                                }

                                if ($panjangResult > 1 && $panjangResult <= 1.5) {
                                    $panjang = 1.5;
                                } else if ($panjangResult > 1.5 && $panjangResult <= 2) {
                                    $panjang = 2;
                                } else if ($panjangResult > 2 && $panjangResult <= 2.5) {
                                    $panjang = 2.5;
                                } else if ($panjangResult > 2.5 && $panjangResult <= 3) {
                                    $panjang = 3;
                                } else if ($panjangResult > 3 && $panjangResult <= 3.5) {
                                    $panjang = 3.5;
                                } else if ($panjangResult > 3.5 && $panjangResult <= 4) {
                                    $panjang = 4;
                                }

                                $lebar = 150;
                                echo $panjang." m x ".$lebar." cm"; 

                                ?><br>
                            </div>
                        </div>
                        

                    </div>
                    
                    <div class="col-md-6">
                        <?php
                            $hk = mysqli_query($conn, "select * from tb_kain where id_kain = '".$id_kain."'");
                            $harga_kain = mysqli_fetch_assoc($hk);
                            $j = mysqli_query($conn, "select * from tb_product where id_product = '".$id_product."'");
                            $ongkos = mysqli_fetch_assoc($j);
                        ?>

                        <h4><b>Rincian Harga</b></h4>

                        <?php $total_harga_kain = $harga_kain["harga"]*ceil(($result["fields"]["badan"]["stringValue"]+6)*2/100) ?>
                        <label for=""><b>Harga Kain: </b>Rp.<?= number_format($total_harga_kain,0,',','.'); ?></label><br>
                        <input type="hidden" name="kain_harga" value="<?= $total_harga_kain ?>">
                        
                        <?php $biaya_jahit = $ongkos["ongkos"] ?>
                        <label for=""><b>Biaya Jahit: </b>Rp.<?= number_format($biaya_jahit,0,',','.'); ?></label><br>
                        <input type="hidden" name="ongkos" value="<?= $biaya_jahit ?>">

                        <label for=""><b>Total Harga: </b>Rp.<?= number_format($total_harga_kain+$biaya_jahit,0,',','.'); ?></label><br>
                        <input type="hidden" name="total_harga" value="<?= $total_harga_kain+$biaya_jahit ?>">
                    </div>
                    <div class="col-md-12" style="text-align: right;">
                        <a href="javascript:history.go(-1)" class="btn buy-btn" style="background-color: #333;">Kembali</a>
                        <input type="submit" name="submit" value="LANJUTKAN KE PEMBAYARAN" class="btn buy-btn">
                       
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
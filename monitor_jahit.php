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

if (isset($_POST["validasiUkuran"])) {

    $id_pemesanan = $_POST["id_pemesanan"];
  
    $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 4 where id_pemesanan = '$id_pemesanan'");
    if (!$insert) {
      echo mysqli_error($conn);
    }
  } else if (isset($_POST["validasiModel"])) {
    $id_pemesanan = $_POST["id_pemesanan"];
  
    $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 6 where id_pemesanan = '$id_pemesanan'");
    if (!$insert) {
      echo mysqli_error($conn);
    }
  } else if (isset($_POST["ajukanPengiriman"])) {
    $id_pemesanan = $_POST["id_pemesanan"];
  
    $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 8 where id_pemesanan = '$id_pemesanan'");
    if (!$insert) {
      echo mysqli_error($conn);
    }
  } else if (isset($_POST["pesananSelesai"])) {
    $id_pemesanan = $_POST["id_pemesanan"];
  
    $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 5 where id_pemesanan = '$id_pemesanan'");
    if (!$insert) {
      echo mysqli_error($conn);
    }
  }

  if(isset($_POST["submit_pengukuran"])) {
    // var_dump($_POST);
    // var_dump($_FILES);
  
    require 'proses_input_ukuran.php';
    if(tambah($_POST) > 0) {
        echo "<script>
                alert('data berhasil ditambahkan!');
                document.location.href='monitor_jahit.php';
              </script>
        ";
    } else{
        echo "<script>
                alert('data gagal ditambahkan!');
                document.location.href='monitor_jahit.php';
            </script>
        ";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charshet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Tailor | Monitoring Jahitan</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">

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

<body class="hold-transition sidebar-mini">
<?php
    $no = 1;
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan");

    // var_dump(mysqli_fetch_array($riwayats, MYSQLI_ASSOC));
    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {
      // var_dump($riwayatModal);
    ?>
    <?php
      // var_dump();
    ?>
    <div class="modal fade" id="pengukuran<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hasil Pengukuran Aplikasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="pengukuran" class="modal-body">
          <form action="" id="form_pengukuran" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pemesanan" value="<?= $riwayatModal["id_pemesanan"] ?>">
            <label for="foto_pengukuran" class="col-md-6">Gambar</label>
            <input type="file" name="foto_pengukuran" id="foto_pengukuran">
            <br><br>
            <input type="submit" name="submit_pengukuran" value="SUBMIT HASIL PENGUKURAN">
            <br><br>
          </form>
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
    <!-- Modal -->
    <?php
    include 'koneksi.php';
    $no = 1;
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_jahit_ukur on tb_jahit_ukur.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_hasil_ukur on tb_hasil_ukur.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_model on tb_jahit_model.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_finishing on tb_jahit_finishing.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product");

    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {
        
    ?>
    <div class="modal fade" id="ukur<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label><h3><b>Ukuran Pesanan</b></h3></label>
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
                    <label><b>Lebar Bahu</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["l_bahu"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Tinggi Badan</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["l_badan"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Panjang Tangan</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["p_tangan"] ?></p>
                </div>

                <div class="col-md-6">
                    <label><b>Panjang Gamis</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["p_gamis"] ?></p>
                </div>

                <div class="col-md-6">
                  <label for="foto_pengukuran">Hasil Pengukuran Apps</label>
                </div>
                <div class="col-md-12">
                    <img src="upload/hasil_pengukuran/<?= $riwayatModal["foto_pengukuran"] ?>" alt="" style="width: 100%">
                </div>

                <div class="col-md-12">
                    <label><h3><b>Progres Cek Ukuran Pola</b></h3></label>
                    <hr>
                </div>

                <div class="col-md-6">
                  <label for="keterangan_ukur">Keterangan Foto</label>
                </div>
                <div class="col-md-6 text-left">
                  <p><?= $riwayatModal["keterangan_ukur"] ?></p>
                </div>

                <div class="col-md-6">
                  <label for="foto_ukur">Foto</label>
                </div>
                <div class="col-md-12">
                    <img src="upload/ukur/<?= $riwayatModal["foto_ukur"] ?>" alt="" style="width: 100%">
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

<?php
    include 'koneksi.php';
    $no = 1;
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_jahit_ukur on tb_jahit_ukur.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_model on tb_jahit_model.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_finishing on tb_jahit_finishing.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product");

    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {
        
    ?>
    <div class="modal fade" id="model<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label><b>Gambar Model</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><img src="img/katalog/<?= $riwayatModal["foto"] ?>" alt="" style="width: 100%"></p>
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
                    <label><b>Gambar Kain</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><p><img src="img/kain/<?= $riwayatModal["foto_kain"] ?>" alt="" style="width: 75%"></p></p>
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

                <div class="col-md-12">
                    <label><h3><b>Progres Cek Model</b></h3></label>
                    <hr>
                </div>

                <div class="col-md-6">
                  <label for="keterangan_model">Keterangan Foto</label>
                </div>
                <div class="col-md-6 text-left">
                  <p><?= $riwayatModal["keterangan_model"] ?></p>
                </div>

                <div class="col-md-6">
                  <label for="foto_model">Foto</label>
                </div>
                <div class="col-md-12">
                    <img src="upload/model/<?= $riwayatModal["foto_model"] ?>" alt="" style="width: 100%">
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

<?php
    include 'koneksi.php';
    $no = 1;
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_jahit_ukur on tb_jahit_ukur.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_model on tb_jahit_model.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_finishing on tb_jahit_finishing.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product");

    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {
        
    ?>
    <div class="modal fade" id="finish<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                <div class="col-md-12">
                    <label><h3><b>Progres Finishing</b></h3></label>
                    <hr>
                </div>

                <div class="col-md-6">
                  <label for="keterangan_finishing">Keterangan Foto</label>
                </div>
                <div class="col-md-6 text-left">
                  <p><?= $riwayatModal["keterangan_finishing"] ?></p>
                </div>

                <div class="col-md-6">
                  <label for="foto_finishing">Foto</label>
                </div>
                <div class="col-md-12">
                    <img src="upload/finishing/<?= $riwayatModal["foto_finishing"] ?>" alt="" style="width: 100%">
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
        <h2 class="font-weight-bold pt-5">Monitoring Jahitan</h2>
        <hr>
    </section>

    <section id="blog-home" class="container">
        <a href="chatting/pesan_user.php">
        <button>Monitoring by Chatting</button>
        </a><br>
    </section>
    <section id="blog-home" class="pt-6 mt-4 container">
        <a href="https://web.telegram.org/z/#5340324779">
            <button>Bot Telegram VIRTA to Monitor</button>
        </a>
    </section>

    <section id="cart-container" class="ml-4 mr-4 my-5">
        <table width="90%">
            <thead>
                <tr>
                    <td>No</td>
                    <td>No Pesanan</td>
                    <td>Tgl Pemesanan</td>
                    <td>Input Pengukuran</td>
                    <td>Cek Ukuran Pola</td>
                    <td>Cek Kesesuaian Model</td>
                    <td>Finishing</td>
                    <td>Status</td>
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
                            <h5><button type="button" data-toggle="modal" data-target="#pengukuran<?= $riwayat["no_pesanan"] ?>" class="buy-btn" style="background-color: black;">Detail</button></h5>
                        </td>
                        <td>
                            <h5><button type="button" data-toggle="modal" data-target="#ukur<?= $riwayat["no_pesanan"] ?>" class="buy-btn" style="background-color: black;">Detail</button></h5>
                        </td>
                        <td>
                            <h5><button type="button" data-toggle="modal" data-target="#model<?= $riwayat["no_pesanan"] ?>" class="buy-btn" style="background-color: black;">Detail</button></h5>
                        </td>
                        <td>
                            <h5><button type="button" data-toggle="modal" data-target="#finish<?= $riwayat["no_pesanan"] ?>" class="buy-btn" style="background-color: black;">Detail</button></h5>
                        </td>
                        <td>
                            <form action="" method="post">
                                <span class="tag tag-success">
                                    <input type="hidden" name="id_pemesanan" value="<?= $riwayat["id_pemesanan"] ?>">
                                    <?php
                                    $status = $riwayat["id_status"];
                                    if($status == 1) {
                                        echo '<h6>Selesaikan Transaksi</h6>';
                                    } else if ($status == 2) {
                                        echo '<h6>Proses Pembuatan Pola</h6>';
                                    } else if ($status == 3) {
                                        echo '<button type="submit" name="validasiUkuran" class="btn btn-danger"><i class="fa fa-check"></i> Validasi Kesesuaian Ukuran dengan Pola </button>';
                                    } else if ($status == 4) {
                                        echo '<h6 style="color: green;">Proses Penjahitan</h6>';
                                    } else if ($status == 5) {
                                        echo '<button type="submit" name="validasiModel" class="btn btn-danger"><i class="fa fa-check"></i> Validasi Kesesuaian Model dengan Jahitan </button>';
                                    } else if ($status == 6) {
                                        echo '<h6 style="color: green;">Proses Penjahitan Finishing</h6>';
                                    } else if ($status == 7) {
                                        echo '<button type="submit" name="ajukanPengiriman" class="btn btn-danger"><i class="fa fa-check"></i> Proses Pengecekan Ukuran </button>';
                                    } else if ($status == 13) {
                                        echo '<h6 style="color: black;">Selesai</h6>';
                                    } else if ($status >= 8) {
                                        echo '<h6 style="color: black;">Lakukan Monitoring Pengiriman</h6>';
                                    } 
                                    else {
                                        echo $status;
                                    }
                                ?>
                                </span>
                            </form>
                        
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
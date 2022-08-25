<?php
session_start();
include '../koneksi.php';

if (isset($_POST["pengecekanUkuran"])) {

  $id_pemesanan = $_POST["id_pemesanan"];

  $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 3 where id_pemesanan = '$id_pemesanan'");
  if (!$insert) {
    echo mysqli_error($conn);
  }
} else if (isset($_POST["pengecekanModel"])) {
  $id_pemesanan = $_POST["id_pemesanan"];

  $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 5 where id_pemesanan = '$id_pemesanan'");
  if (!$insert) {
    echo mysqli_error($conn);
  }
} else if (isset($_POST["prosesFinishing"])) {
  $id_pemesanan = $_POST["id_pemesanan"];

  $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 7 where id_pemesanan = '$id_pemesanan'");
  if (!$insert) {
    echo mysqli_error($conn);
  }
} 

if(isset($_POST["submit_cek_ukur"])) {
  // var_dump($_POST);
  // var_dump($_FILES);

  require 'proses_cek_ukur.php';
  if(tambah($_POST) > 0) {
      echo "<script>
              alert('data berhasil ditambahkan!');
              document.location.href='monitoring-jahitan.php';
            </script>
      ";
  } else{
      echo "<script>
              alert('data gagal ditambahkan!');
              document.location.href='monitoring-jahitan.php';
          </script>
      ";
  }
}

if(isset($_POST["submit_cek_model"])) {
  // var_dump($_POST);
  // var_dump($_FILES);

  require 'proses_cek_model.php';
  if(tambah($_POST) > 0) {
      echo "<script>
              alert('data berhasil ditambahkan!');
              document.location.href='monitoring-jahitan.php';
            </script>
      ";
  } else{
      echo "<script>
              alert('data gagal ditambahkan!');
              document.location.href='monitoring-jahitan.php';
          </script>
      ";
  }
}

if(isset($_POST["submit_cek_finishing"])) {
  // var_dump($_POST);
  // var_dump($_FILES);

  require 'proses_finishing.php';
  if(tambah($_POST) > 0) {
      echo "<script>
              alert('data berhasil ditambahkan!');
              document.location.href='monitoring-jahitan.php';
            </script>
      ";
  } else{
      echo "<script>
              alert('data gagal ditambahkan!');
              document.location.href='monitoring-jahitan.php';
          </script>
      ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Virta | Monitoring Jahitan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
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
    <div class="modal fade" id="ukur<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hasil Ukur Pola</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="cek_ukur" class="modal-body">
          <form action="" id="form_cek_ukur" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pemesanan" value="<?= $riwayatModal["id_pemesanan"] ?>">
            <label for="keterangan_ukur" class="col-md-6">Keterangan Gambar</label>
            <select name="keterangan_ukur" id="keterangan_ukur" class="col-md-12">
                <option>- Pilih Keterangan Ukur -</option>
    			<option>Pembuatan Ukuran Pola</option>
			</select>
            <label for="foto_ukur" class="col-md-6">Gambar</label>
            <input type="file" name="foto_ukur" id="foto_ukur">
            <br><br>
            <input type="submit" name="submit_cek_ukur" value="SUBMIT HASIL CEK UKUR">
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
    <div class="modal fade" id="model<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hasil Model Jahitan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="cek_model" class="modal-body">
          <form action="" id="form_cek_model" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pemesanan" value="<?= $riwayatModal["id_pemesanan"] ?>">
            <label for="keterangan_model" class="col-md-6">Keterangan Gambar</label>
            <select name="keterangan_model" id="keterangan_model" class="col-md-12">
                <option>- Pilih Keterangan Model -</option>
    			<option>Penjahitan model selesai 50%</option>
    			<option>Penjahitan model selesai 60%</option>
    			<option>Penjahitan model selesai 70%</option>
    			<option>Penjahitan model selesai 80%</option>
			</select>
            <label for="foto_model" class="col-md-6">Gambar</label>
            <input type="file" name="foto_model" id="foto_model">
            <br><br>
            <input type="submit" name="submit_cek_model" value="SUBMIT HASIL CEK MODEL">
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
    <div class="modal fade" id="finishing<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hasil Finishing</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="cek_finishing" class="modal-body">
          <form action="" id="form_cek_finishing" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pemesanan" value="<?= $riwayatModal["id_pemesanan"] ?>">
            <label for="keterangan_finishing" class="col-md-6">Keterangan Gambar</label>
            <select name="keterangan_finishing" id="keterangan_finishing" class="col-md-12">
                <option>- Pilih Keterangan Finishing -</option>
    			<option>Penjahitan model selesai 90%</option>
    			<option>Penjahitan model selesai 100% siap packing</option>
			</select>
            <label for="foto_finishing" class="col-md-6">Gambar</label>
            <input type="file" name="foto_finishing" id="foto_finishing">
            <br><br>
            <input type="submit" name="submit_cek_finishing" value="SUBMIT HASIL FINISHING">
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


    <?php
    $no = 1;
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_jahit_ukur on tb_jahit_ukur.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_model on tb_jahit_model.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_finishing on tb_jahit_finishing.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product");

    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {

    ?>
    <div class="modal fade" id="validukur<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label><h3><b>Ukuran</b></h3></label>
                    <hr>
                </div>

                <div class="col-md-6">
                    <label><b>Ukuran Standart</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["nama_ukuran"] ?></p>
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
                <br><br>

                <div class="col-md-12">
                    <label>Progres Ukuran Pola</label>
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
                    <img src="../upload/ukur/<?= $riwayatModal["foto_ukur"] ?>" alt="" style="width: 100%">
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
    $no = 1;
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_jahit_ukur on tb_jahit_ukur.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_model on tb_jahit_model.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_finishing on tb_jahit_finishing.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product");

    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {

    ?>
    <div class="modal fade" id="validmodel<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <p><img src="../img/katalog/<?= $riwayatModal["foto"] ?>" alt="" style="width: 75%"></p>
                </div>

                <div class="col-md-6">
                    <label><b>Nama Model</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["nama"] ?></p>
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
                    <p><p><img src="../img/kain/<?= $riwayatModal["foto_kain"] ?>" alt="" style="width: 75%"></p></p>
                </div>

                <div class="col-md-6">
                    <label><b>Penggunaan Kain</b></label>
                </div>
                <div class="col-md-6 text-left">
                    <p><?= $riwayatModal["prediksi"] ?></p>
                </div>

                <div class="col-md-12">
                    <label>Progres Cek Model</label>
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
                    <img src="../upload/model/<?= $riwayatModal["foto_model"] ?>" alt="" style="width: 100%">
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
    $no = 1;
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_jahit_ukur on tb_jahit_ukur.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_model on tb_jahit_model.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_jahit_finishing on tb_jahit_finishing.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product");

    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {

    ?>
    <div class="modal fade" id="validfinish<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <p><img src="<?= $riwayatModal["foto"] ?>" alt="" style="width: 75%"></p>
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
                    <p><p><img src="../img/kain/<?= $riwayatModal["foto_kain"] ?>" alt="" style="width: 75%"></p></p>
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
                    <label>Progres Finishing Jahitan</label>
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
                    <img src="../upload/finishing/<?= $riwayatModal["foto_finishing"] ?>" alt="" style="width: 100%">
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

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <span class="brand-text font-weight-light">VIRTA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->


      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./produk.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Data Produk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./riwayat_ukur.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Riwayat Pengukuran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./transaksi.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Riwayat Transaksi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./monitoring-jahitan.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Monitoring Jahitan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./monitoring-pengiriman.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Monitoring Pengiriman
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Monitoring Jahitan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Monitoring Jahitan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Monitoring Jahitan</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">

                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>No. Transaksi</th>
                      <th>Tanggal Pemesanan</th>
                      <th>Nama Pemesan</th>
                      <th>Validasi Ukuran</th>
                      <th>Pengecekan Ukuran</th>
                      <th>Validasi Model</th>
                      <th>Pengecekan Model</th>
                      <th>Validasi Finishing</th>
                      <th>Finishing</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $q = "select * from tb_pemesanan join tb_user on tb_user.id_user = tb_pemesanan.id_user left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan join tb_status on tb_status.id_status = tb_pemesanan.id_status order by tgl_pemesanan desc";
                    $cek = mysqli_query($conn, $q);
                    $no = 1;
                    // var_dump(mysqli_fetch_array($cek, MYSQLI_ASSOC));
                    while ($row = mysqli_fetch_array($cek, MYSQLI_ASSOC)) {
                      
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row["no_pesanan"] ?></td>
                      <td><?= $row["tgl_pemesanan"] ?></td>
                      <td><?= $row["nama"] ?></td>
                      <td><h5><button type="button" data-toggle="modal" data-target="#validukur<?= $row["no_pesanan"] ?>" class="btn" style="background-color: black; color: white;">Detail</button></h5></td>
                      <td><h5><button type="button" data-toggle="modal" data-target="#ukur<?= $row["no_pesanan"] ?>" class="btn" style="background-color: black; color: white;">Hasil Ukur Pola</button></h5></td>
                      <td><h5><button type="button" data-toggle="modal" data-target="#validmodel<?= $row["no_pesanan"] ?>" class="btn" style="background-color: black; color: white;">Detail</button></h5></td>
                      <td><h5><button type="button" data-toggle="modal" data-target="#model<?= $row["no_pesanan"] ?>" class="btn" style="background-color: black; color: white;">Hasil Model Jahitan</button></h5></td>
                      <td><h5><button type="button" data-toggle="modal" data-target="#validfinish<?= $row["no_pesanan"] ?>" class="btn" style="background-color: black; color: white;">Detail Keseluruhan</button></h5></td>
                      <td><h5><button type="button" data-toggle="modal" data-target="#finishing<?= $row["no_pesanan"] ?>" class="btn" style="background-color: black; color: white;">Hasil Finishing Jahitan</button></h5></td>
                      <td>
                      <form action="" method="post">
                        <span class="tag tag-success">
                          <input type="hidden" name="id_pemesanan" value="<?= $row["id_pemesanan"] ?>">
                        <?php
                          if ($row["id_status"] < 2) {
                            echo '<h6>Menunggu Pembayaran  Dikonfirmasi</h6>';
                          } else if ($row["id_status"] == 2) {
                            echo '<button type="submit" name="pengecekanUkuran" class="btn btn-danger"><i class="fa fa-check"></i> Proses Pengecekan Ukuran </button>';
                          } else if ($row["id_status"] == 3) {
                            echo '<h6 style="color: green;">Menunggu Validasi Cek Ukuran Pemesan</h6>';
                          } else if ($row["id_status"] == 4) {
                            echo '<button type="submit" name="pengecekanModel" class="btn btn-danger"><i class="fa fa-check"></i> Proses Pengecekan Model </button>';
                          } else if ($row["id_status"] == 5) {
                            echo '<h6 style="color: green;">Menunggu Validasi Cek Model Pemesan</h6>';
                          } else if ($row["id_status"] == 6) {
                            echo '<button type="submit" name="prosesFinishing" class="btn btn-danger"><i class="fa fa-check"></i> Finishing </button>';
                          } else if ($row["id_status"] == 7) {
                            echo '<h6 style="color: green;">Menunggu Pengajuan Pengiriman Pemesan</h6>';
                          } else if ($row["id_status"] == 13) {
                            echo '<h6 style="color: black;">Selesai</h6>';
                          } else if ($row["id_status"] >= 8) {
                            echo '<h6 style="color: black;">Lakukan Monitoring Pengiriman</h6>';
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



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="./dist/js/demo.js"></script> -->
</body>
</html>

<?php

include '../koneksi.php';

if (isset($_POST["paketPickup"])) {

  $id_pemesanan = $_POST["id_pemesanan"];

  $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 9 where id_pemesanan = '$id_pemesanan'");
  if (!$insert) {
    echo mysqli_error($conn);
  }
} else if (isset($_POST["paketInTransit"])) {
  $id_pemesanan = $_POST["id_pemesanan"];

  $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 10 where id_pemesanan = '$id_pemesanan'");
  if (!$insert) {
    echo mysqli_error($conn);
  }
} else if (isset($_POST["receiveInDestination"])) {
  $id_pemesanan = $_POST["id_pemesanan"];

  $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 11 where id_pemesanan = '$id_pemesanan'");
  if (!$insert) {
    echo mysqli_error($conn);
  }
} else if (isset($_POST["paketDelivered"])) {
  $id_pemesanan = $_POST["id_pemesanan"];

  $insert = mysqli_query($conn, "update tb_pemesanan set id_status = 12 where id_pemesanan = '$id_pemesanan'");
  if (!$insert) {
    echo mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Virta | Monitoring Pengiriman</title>

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
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product");

    while ($riwayatModal = mysqli_fetch_array($riwayats, MYSQLI_ASSOC)) {

    ?>
    <div class="modal fade" id="bukti<?= $riwayatModal["no_pesanan"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <img src="../upload/<?= $riwayatModal["file_bukti"] ?>" alt="" style="width: 100%">
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
    $riwayats = mysqli_query($conn, "select * from tb_pemesanan left join tb_product on tb_product.id_product = tb_pemesanan.id_product left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan left join tb_status on tb_status.id_status = tb_pemesanan.id_status left join tb_ukuran on tb_ukuran.id_ukuran = tb_pemesanan.id_ukuran left join tb_kain on tb_kain.id_kain = tb_pemesanan.id_kain left join tb_prediksi on tb_prediksi.id_product = tb_pemesanan.id_product");

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
            <h1>Monitoring Pengiriman</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Monitoring Pengiriman</li>
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
                <h3 class="card-title">Monitoring Pengiriman</h3>

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
                      <th>Alamat Lengkap</th>
                      <th>Kecamatan</th>
                      <th>Kota</th>
                      <th>Kode Pos</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $q = "select * from tb_pemesanan join tb_user on tb_user.id_user = tb_pemesanan.id_user left join tb_pembayaran on tb_pembayaran.id_pemesanan = tb_pemesanan.id_pemesanan join tb_status on tb_status.id_status = tb_pemesanan.id_status order by tgl_pemesanan desc";
                    $cek = mysqli_query($conn, $q);
                    $no = 1;
                    while ($row = mysqli_fetch_array($cek, MYSQLI_ASSOC)) {

                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row["no_pesanan"] ?></td>
                      <td><?= $row["tgl_pemesanan"] ?></td>
                      <td><?= $row["nama"] ?></td>
                      <td><?= $row["alamat_lengkap"] ?></td>
                      <td><?= $row["kecamatan"] ?></td>
                      <td><?= $row["kota"] ?></td>
                      <td><?= $row["zip_code"] ?></td>
                      <td>
                      <form action="" method="post">
                        <span class="tag tag-success">
                          <input type="hidden" name="id_pemesanan" value="<?= $row["id_pemesanan"] ?>">
                        <?php
                          if ($row["id_status"] < 8) {
                            echo '<h6>Menunggu Proses Jahitan</h6>';
                          } else if ($row["id_status"] == 8) {
                            echo '<button type="submit" name="paketPickup" class="btn btn-danger"><i class="fa fa-check"></i> Paket Pickup </button>';
                          } else if ($row["id_status"] == 9) {
                            echo '<button type="submit" name="paketInTransit" class="btn btn-danger"><i class="fa fa-check"></i> Paket In Transit </button>';
                          } else if ($row["id_status"] == 10) {
                            echo '<button type="submit" name="receiveInDestination" class="btn btn-danger"><i class="fa fa-check"></i> Paket Receive in Destination </button>';
                          } else if ($row["id_status"] == 11) {
                            echo '<button type="submit" name="paketDelivered" class="btn btn-danger"><i class="fa fa-check"></i> Paket Delivered </button>';
                          } else if ($row["id_status"] == 12) {
                            echo '<h6>Menunggu Konfrmasi Pemesan</h6>';
                          } else if ($row["id_status"] == 13) {
                            echo '<h6>Pemesan Sudah di Pemesan</h6>';
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

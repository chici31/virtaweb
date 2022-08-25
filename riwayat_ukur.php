<?php

require '../vendor/autoload.php';


use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'https://firestore.googleapis.com/v1/projects/virta-apps/databases/(default)/documents/users/TkZbhYD1sQaBXOtBi7fPzC2rr1p1/histories?key=AIzaSyAksNsN1iTCbWeb-dZswaicMN7v8u-uOpc');

$body = $response->getBody();

$result = json_decode($body->getContents(), TRUE)['documents'];

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
    <a href="../index.php" class="brand-link">
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
                <h3 class="card-title">Riwayat Ukuran Aplikasi</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                  <form action="hasilcari.php" method="get">
                    <input type="text" name="id" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" value="Cari" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">

                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Tangan</th>
                      <th>Bahu</th>
                      <th>Type</th>
                      <th>Ukuran</th>
                      <th>Badan</th>
                      <th>Alamat</th>
                      <th>Gambar</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; ?>
                    <?php foreach ($result as $key => $value) : ?>
                    <?php $no++; ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?= $value['fields']['name']['stringValue'] ?></td>
                        <td><?= $value['fields']['tangan']['stringValue'] ?></td>
                        <td><?= $value['fields']['bahu']['stringValue'] ?></td>
                        <td><?= $value['fields']['type']['stringValue'] ?></td>
                        <td><?= $value['fields']['ukuran']['stringValue'] ?></td>
                        <td><?= $value['fields']['badan']['stringValue'] ?></td>
                        <td><?= $value['fields']['address']['stringValue'] ?></td>
                        <td><?= $value['fields']['gambar']['stringValue'] ?></td>
                    </tr>
                    <?php endforeach; ?>
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

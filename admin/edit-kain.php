<?php

include '../koneksi.php';

if (isset($_GET["id_kain"])) {

  $id_kain = $_GET["id_kain"];

  $select = mysqli_query($conn, "select * from tb_kain where id_kain = '$id_kain'");
  $kains = mysqli_fetch_assoc($select);
  if (!$select) {
    echo mysqli_error($conn);
  }

  if (isset($_POST["submit"])) {
    $id_kain = $_POST["id_kain"];
    $nama_kain = $_POST["nama_kain"];
    $harga = $_POST["harga"];
    if(isset($_FILES["foto_kain"]) && $_FILES["foto_kain"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["foto_kain"]["name"];
        $filetype = $_FILES["foto_kain"]["type"];
        $filesize = $_FILES["foto_kain"]["size"];

        // Validate file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        // Validate file size - 10MB maximum
        $maxsize = 10 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Validate type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it

            if(move_uploaded_file($_FILES["foto_kain"]["tmp_name"], "../img/kain/" . $filename)){
                $foto_kain = $filename;
            }else{
              echo "File is not uploaded";
              die();
            }

        } else{
            echo "Error: There was a problem uploading your file. Please try again.";
            die();
        }
    } else{
        echo "Error: " . $_FILES["foto_kain"]["error"];
        $foto_kain = $kains["foto_kain"];
    }

    $update_kain = mysqli_query($conn, "update tb_kain set nama_kain = '$nama_kain', harga = '$harga', foto_kain = '$foto_kain' where id_kain = '$id_kain'");
    if (!$update_kain) {
      echo mysqli_error($conn);
    } else {
      echo "<script>alert('Data Berhasil Diubah')</script>";
      header("Refresh:0");
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Virta | Riwayat Transaksi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
        <a href="../admin/index.html" class="nav-link">Home</a>
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
            <h1>Data Kain</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../admin/index.html">Home</a></li>
              <li class="breadcrumb-item active">Data Kain</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Kain</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" action="">
                <div class="card-body">
                  <input type="hidden" name="id_kain" value="<?= $kains["id_kain"] ?>">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Kain</label>
                    <input type="text" class="form-control" placeholder="Nama Kain" value="<?= $kains["nama_kain"] ?>" name="nama_kain">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Harga</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Harga" value="<?= $kains["harga"] ?>" name="harga">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Foto Kain</label>
                    <input type="file" class="form-control" id="exampleInputPassword1" placeholder="Harga" name="foto_kain">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            <div class="form-group">
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <!-- <b>Version</b> 3.2.0 -->
    </div>
    <strong>Copyright &copy; 2022 VIRTA.</strong> All rights reserved.
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

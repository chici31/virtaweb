<?php 
session_start();
error_reporting(0);
include_once '../koneksi.php';
/*include_once '../setting/status_session.php';*/
$id_user = $_SESSION['id_user'];

if ($_SESSION["id_user"] != NULL) {
    if ($_SESSION['level'] == "admin") {
        $login = '<li class="nav-item">
        <a class="nav-link" href="admin/transaksi.php">Halaman Admin</a></li>
        <li class="nav-item">
        <a class="nav-link" href="../chatting/pesan_admin.php">Live Chatting</a></li>
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
<html>
<head>
<meta charshet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="stylesheet" href="../style_pesan.css" />
	<title>Pesan</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="../js/pesan.js"></script>
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
	<div class="container pt-5 mt-5">
		<a href="../pesan_telegram/index.php">
			<button>Bot Telegram VIRTA to Monitor</button>
		</a>
	</div>
	
	<h1>Inbox Pesan</h1>
	<div id="kirim_pesan">
	<form id="form_kirim_pesan" method="post">
		<input type="hidden" id="pengirim_kirim_pesan" name="pengirim_kirim_pesan" value="<?php echo $id_user; ?>">
		Penerima
		<br>
		<select id="penerima_kirim_pesan" name="penerima_kirim_pesan">
		<option value="0">- Pilih Penerima Pesan -</option>
		<?php 
			$query_penerima = mysqli_query ($conn, "SELECT id_user, nama FROM tb_user WHERE tb_user.level LIKE 'user' AND id_user != $id_user");
			while ($daftar_penerima=mysqli_fetch_array($query_penerima)) {
		?>
			<option value="<?php echo $daftar_penerima['id_user']; ?>"><?php echo $daftar_penerima['nama']; ?></option>
		<?php } ?>
		</select>
				<br>
				Subyek (No Pesanan)
				<br>
				<input type="text" id="subyek_kirim_pesan" name="subyek_kirim_pesan">
				<br>
				Isi Pesan
				<br>
				<textarea class="form-control form-control-lg" id="isi_kirim_pesan" name="isi_kirim_pesan" cols="30" rows="5"></textarea>
				<br><br>
				<input type="submit" name="submit_kirim_pesan" value="KIRIM PESAN">
				<br>
				<div id="loading_kirim_pesan">Mengirim Pesan...</div>
				<div id="keterangan"></div>
				<?php
				?>
		</form>
	</div>

	<table width="600" class="tabel_pesan pt-5 mt-5" cellpadding="5" cellspacing="0">
		<thead>
		<tr class="top_inbox">
			<th>
				Pengirim
			</th>
			<th>
				Subyek Pesan
			</th>
			<th>
				Tanggal
			</th>
		</tr>
		</thead>
		<tbody>
<?php
	$query_daftar_pesan = mysqli_query($conn, "SELECT pesan.*, tb_user.id_user, tb_user.nama FROM pesan, tb_user WHERE pesan.id_pengirim = tb_user.id_user AND pesan.id_penerima = '$id_user' ORDER BY pesan.id_pesan DESC");
	while ($daftar_pesan=mysqli_fetch_array($query_daftar_pesan)) {
		if($daftar_pesan['sudah_dibaca']=="belum"){
?>
		<tr class="pesan pesan_belum">
			<td>
				<?php echo $daftar_pesan['nama']; ?>
			</td>
			<td>
				<a href="buka_pesan_user.php?id_user=<?php echo $id_user; ?>&id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>"><?php echo $daftar_pesan['subyek_pesan']; ?></a>
			</td>
			<td>
				<?php echo $daftar_pesan['tanggal']; ?>
			</td>
		</tr>
<?php } 
		else if($daftar_pesan['sudah_dibaca']=="sudah"){
?>
		<tr class="pesan">
			<td>
				<?php echo $daftar_pesan['nama']; ?>
			</td>
			<td>
				<a href="buka_pesan_user.php?id_user=<?php echo $id_user; ?>&id_pesan=<?php echo $daftar_pesan['id_pesan']; ?>"><?php echo $daftar_pesan['subyek_pesan']; ?></a>
			</td>
			<td>
				<?php echo $daftar_pesan['tanggal']; ?>
			</td>
		</tr>

<?php 
		} 
	}
?>

		</tbody>

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

	</table>
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
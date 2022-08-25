<?php
session_start();
error_reporting(0);
include_once '../koneksi.php';
$id_user=$_SESSION['id_user'];
$id_pesan = $_GET['id_pesan'];

$query_buka_pesan = mysqli_query($conn, "SELECT pesan.*, tb_user.id_member, tb_user.nama FROM pesan, tb_user WHERE id_pesan = $id_pesan AND pesan.id_pengirim=tb_user.id_user");
$buka_pesan=mysqli_fetch_array($query_buka_pesan);
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Buka Pesan dari : <?php echo $buka_pesan['nama']; ?></title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="../js/pesan.js"></script>
</head>
<body>

<p class="mt-5 py-5"> <a href="pesan_user.php">
	<button>&laquo; Kembali ke Inbox</button>
</a></p>

<table>
	<tr>
		<td>Subyek Pesan</td>
		<td>:</td>
		<td><strong><?php echo $buka_pesan['subyek_pesan']; ?></strong></td>
	</tr>
	<tr>
		<td>Pengirim</td>
		<td>:</td>
		<td><strong><?php echo $buka_pesan['nama']; ?></strong></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><strong><?php echo $buka_pesan['tanggal']; ?></strong></td>
	</tr>
	<tr>
		<td>Isi Pesan</td>
		<td>:</td>
		<td><strong> " <?php echo $buka_pesan['isi_pesan']; ?> " </strong></td>
	</tr>
</table>

<p><a id="ke_balas_pesan" href="#">Balas Pesan</a></p>

<div id="balas_pesan">
	<form id="form_balas_pesan" method="post">
		<input type="hidden" id="pengirim_balas_pesan" name="pengirim_balas_pesan" value="<?php echo $id_member; ?>">		
		Penerima : <?php echo $buka_pesan['nama']; ?>
		<input type="hidden" id="penerima_balas_pesan" name="penerima_balas_pesan" value="<?php echo $buka_pesan['id_pengirim']; ?>">
		<br><br>
		Subyek Pesan (Re: )
		<br>
		<input type="text" id="subyek_balas_pesan" name="subyek_balas_pesan">
		<br>
		Isi Pesan
		<br>
		<textarea id="isi_balas_pesan" name="isi_balas_pesan" cols="30" rows="5"></textarea>
		<br><br>
		<input type="submit" name="submit_balas_pesan" value="BALAS PESAN">
		<br>
		<div id="loading_balas_pesan">Mengirim Pesan...</div>
		<div id="keterangan"></div>
		</form>
	</div>
<?php $sudah_dibaca = mysqli_query($koneksi, "UPDATE pesan SET sudah_dibaca='sudah' WHERE id_pesan=$id_pesan"); ?>
</body>
</html>
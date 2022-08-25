<?php 
session_start();
error_reporting(0);
include_once '../koneksi.php';
/*include_once '../setting/status_session.php';*/
$id_user = $_SESSION['id_user'];


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
	<a href="../index.php">
		<button>Home</button>
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="../monitor_jahit.php">
		<button>Monitoring Jahitan</button>
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="https://web.telegram.org/z/#5340324779">
		<button>Bot Telegram VIRTA to Monitor</button>
	</a>
	<h1>Inbox Pesan</h1>
	<div id="kirim_pesan">
	<form id="form_kirim_pesan" method="post">
		<input type="hidden" id="pengirim_kirim_pesan" name="pengirim_kirim_pesan" value="<?php echo $id_user; ?>">
		Penerima
		<br>
		<select id="penerima_kirim_pesan" name="penerima_kirim_pesan">
		<option value="0">- Pilih Penerima Pesan -</option>
		<?php 
			$query_penerima = mysqli_query ($conn, "SELECT id_user, nama FROM tb_user WHERE tb_user.level LIKE 'admin' AND id_user != $id_user");
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
	</table>
</body>
</html>
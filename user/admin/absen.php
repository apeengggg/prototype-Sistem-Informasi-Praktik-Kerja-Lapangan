<?php 
session_start();
require '../../koneksi.php';
if (!isset($_SESSION["login_admin"])) {
	header("location:../../index.php");
	exit();
}
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Page Title</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="" crossorigin="anonymous">
	</head>
	<body>
		<a href="index.php">Beranda</a><br>
		<a href="../../logout.php">Logout</a>	<br>
		<a href="datapeserta.php">Data Peserta</a><br>
		<a href="absen.php">Data Absen</a><br>
		<a href="kegiatan.php">Data Kegiatan</a><br>
		<a href="pemohon.php">Data Pemohon</a><br>
		<a href="daftartolak.php">Daftar Peserta Ditolak</a><br>
		<a href="datalaporan.php">Daftar Laporan Peserta</a><br><br>
		<h1>Daftar Absensi Peserta PKL</h1>
		<form action="" method="post">
			<input type="date" name="tanggal" id="tanggal">
			<button type="submit" name="filter" id="filter">Filter</button>
			<input type="text" name="caripeserta" placeholder="Cari ...">
			<button type="submit" name="cari" id="Cari"> Cari</button>
			<button onclick="absen.php">Reset</button><br>
		</form>
		<table border="1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Absen Masuk</th>
						<th>Absen Pulang</th>
						<th>Tanggal</th>
					</tr>
				</thead>
				<tbody>
	<?php 

	$batas = 5;
	$halaman = @$_GET['halaman'];
	if (empty($halaman)) {
		$posisi = 0;
		$halaman = 1;
	}else {
		$posisi = ($halaman-1) * $batas;
	}

if (!isset($_POST["filter"])) {
	if (!isset($_POST["cari"])) {
	$datakegiatan = mysqli_query($conn, "SELECT tbl_absen.tanggal, tbl_absen.absen_masuk, tbl_absen.absen_pulang, tbl_peserta.nama_peserta FROM tbl_absen INNER JOIN tbl_peserta ON tbl_absen.no_induk_peserta = tbl_peserta.no_induk_peserta") or die (mysqli_erorr($conn));
	if (mysqli_num_rows($datakegiatan)>0)  {
		$no=1;
		while ($data = mysqli_fetch_assoc($datakegiatan)) {
		   echo '
				   <tr>
				   		<td>'.$no.'</td>
				   		<td>'.$data['nama_peserta'].'</td>
				   		<td>'.$data['absen_masuk'].'</td>				   		
						<td>'.$data['absen_pulang'].'</td>
						<td>'.$data['tanggal'].'</td>					   		
					</tr>
				   		';
				  $no++;
		}
	}		$hitungdata = mysqli_query($conn, "SELECT tbl_absen.tanggal, tbl_absen.absen_masuk, tbl_absen.absen_pulang, tbl_peserta.nama_peserta FROM tbl_absen INNER JOIN tbl_peserta ON tbl_absen.no_induk_peserta = tbl_peserta.no_induk_peserta ORDER BY tanggal ASC") or die (mysqli_erorr($hitungdata));
			$jmldata = mysqli_num_rows($hitungdata);
			$jmlhalaman = ceil($jmldata/$batas);

			echo '<br> Halaman : ';

			for ($i=1; $i<=$jmlhalaman; $i++) {
				if ($i != $halaman) {
					echo "<a href=\"?halaman=$i\">$i<a>";
				}else {
					echo " <b>$i</b>";
				}			
			 }
			 	echo "<p> Total Absensi : <b>$jmldata</b> Absen</p>";
}
}
	 ?>

 <?php
			if (isset($_POST["cari"])) {
			$cari = $_POST["caripeserta"];
			$search = mysqli_query($conn, "SELECT * FROM tbl_absen WHERE nama LIKE '%$cari%'") or die (mysqli_error($conn)); 	
			if (mysqli_num_rows($search) > 0) {
				$no=1;
				while ($data = mysqli_fetch_array($search)) {
				    echo '
				   <tr>
				   <br>
				   		<td>'.$no.'</td>
				   		<td>'.$data['nama'].'</td>
				   		<td>'.$data['absen_masuk'].'</td>				   		
						<td>'.$data['absen_pulang'].'</td>					   		
						<td>'.$data['tanggal'].'</td>					   		

				   		';
				   		$no++;
				}
			}else {
			echo '
			<td colspan="8" align="center">TIDAK MENEMUKAN DATA YANG DICARI</td>
			</tr>
			';
		}	
	}	?>
	<?php	
		if (isset($_POST["filter"])) {
			$cari = $_POST["tanggal"];
			$search = mysqli_query($conn, "SELECT * FROM tbl_absen WHERE tanggal LIKE '%$cari%'") or die (mysqli_error($conn)); 	
			if (mysqli_num_rows($search) > 0) {
				$no=1;
				while ($data = mysqli_fetch_array($search)) {
				    echo '
				   <tr>
				   <br>
				   		<td>'.$no.'</td>
				   		<td>'.$data['nama'].'</td>
				   		<td>'.$data['absen_masuk'].'</td>				   		
						<td>'.$data['absen_pulang'].'</td>					   		
						<td>'.$data['tanggal'].'</td>					   		

				   		';
				   		$no++;
				}
			}else {
			echo '
			<td colspan="8" align="center">TIDAK MENEMUKAN DATA YANG DICARI</td>
			</tr>
			';
		}	
	}	 ?>
</tbody>
</table>
	</body>
</html>	
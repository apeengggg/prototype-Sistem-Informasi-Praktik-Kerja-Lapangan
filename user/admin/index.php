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
		<a href="daftartolak.php">Daftar Peserta Ditolak</a>
		<a href="datalaporan.php">Daftar Laporan Peserta</a><br><br>
		
		<?php 
		$status = "Menunggu";
		$hitungpmh = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE status_permohonan='$status'") or die (mysqli_erorr($conn));
		$jmlpmh = mysqli_num_rows($hitungpmh);
		if ($jmlpmh > 0) {
			echo "
			<h2>Ada $jmlpmh Pemohon PKL, Lihat <a href='pemohon.php'>Disini</a></h2>
			";
		}else {
			echo '';
		}
		 ?>

		 <?php 
		 $status_pst = "Aktif"; 
		 $hitungpst = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE status_peserta='$status_pst'") or die (mysqli_erorr($conn));
		 $jmlpst = mysqli_num_rows($hitungpst);
		 if ($jmlpst > 0) {
		 	echo "<h2> Ada $jmlpst Peserta Yang Aktif </h2>";
		 }else {
		 	echo '';
		 }

		 ?>

		 <h1>Absen Hari Ini</h1>
			<table border="1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Tanggal</th>
						<th>Absen Masuk</th>
						<th>Absen Pulang</th>
					</tr>
				</thead>
			
				<?php 	
				$batas = 3;
				$halaman = @$_GET['halaman'];
				if (empty($halaman)) {
					$posisi = 0;
					$halaman = 1;
				}else {
					$posisi = ($halaman-1) * $batas;
				}


				$tanggal = date("Y-m-d");
				$viewabsen = mysqli_query($conn, "SELECT tbl_absen.date , tbl_absen.absen_masuk, tbl_absen.absen_pulang, tbl_peserta.nama_peserta FROM tbl_absen INNER JOIN tbl_peserta ON tbl_absen.no_induk_peserta = tbl_peserta.no_induk_peserta WHERE date = '$tanggal' ORDER BY absen_masuk ASC") or die (mysqli_erorr($absen));
				if (mysqli_num_rows($viewabsen) > 0) {
					$no=1;
					while ($data = mysqli_fetch_assoc($viewabsen)) {
					echo '
					<tr>
					<td>'.$no.'</td>
					<td>'.$data['nama_peserta'].'</td>
					<td>'.$data['date'].'</td>
					<td>'.$data['absen_masuk'].'</td>
					<td>'.$data['absen_pulang'].'</td>
					';
					$no++;
						}
				} else {
						echo '<tr>
						<td colspan="5">BELUM ADA ABSEN</td>
						</tr>';
				}

				
				 ?>
			</table> 
		<?php 
			$hitungdata = mysqli_query($conn, "SELECT * FROM tbl_absen WHERE date='$tanggal'") or die (mysqli_error($conn));
			$jmldata = mysqli_num_rows($hitungdata);
			$jmlhalaman = ceil($jmldata/$batas);

			for ($i=1; $i<=$jmlhalaman; $i++) {
				if ($i != $halaman) {
					echo "<a href=\"?halaman=$i\">$i<a>";
				}else {
					echo " <br><b>$i</b>";
				}			
			 }
			?>
	
			<br>
	 <h1>Kegiatan Hari Ini</h1>
			<table border="1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Tanggal</th>
						<th>Kegiatan</th>
					</tr>
				</thead>
				<tbody>
	<?php 
				$batas = 3;
				$halaman = @$_GET['halaman'];
				if (empty($halaman)) {
					$posisi = 0;
					$halaman = 1;
				}else {
					$posisi = ($halaman-1) * $batas;
				}

				$tanggal = date("Y-m-d");
				$viewabsen = mysqli_query($conn, "SELECT * FROM tbl_kegiatan WHERE tanggal='$tanggal' LIMIT $posisi,$batas") or die (mysqli_error($conn));
				if (mysqli_num_rows($viewabsen) > 0) {
					$no=1;
					while ($data = mysqli_fetch_assoc($viewabsen)) {
					echo '
					<tr>
					<td>'.$no.'</td>
					<td>'.$data['nama'].'</td>	
					<td>'.$data['tanggal'].'</td>
					<td>'.$data['kegiatan'].'</td>';
					$no++;
			}
		}else {
			echo '
					<td colspan="4" align="center"> TIDAK ADA KEGIATAN HARI INI</td>';	
		}

 ?>
</tbody>
</table>
		<?php 
			$hitungdata = mysqli_query($conn, "SELECT * FROM tbl_kegiatan WHERE tanggal='$tanggal'") or die (mysqli_error($conn));
			$jmldata = mysqli_num_rows($hitungdata);
			$jmlhalaman = ceil($jmldata/$batas);

			for ($i=1; $i<=$jmlhalaman; $i++) {
				if ($i != $halaman) {
					echo "<a href=\"?halaman=$i\">$i<a>";
				}else {
					echo " <b>$i</b>";
				}			
			 }
			 if ($jmldata < 1) {
			 	echo '';
			 }else {
					echo "<p> Ada <b>$jmldata</b> Kegiatan Peserta Hari Ini</p>";			 	
			 }


			 ?>
	</body>
</html>
<?php 
error_reporting(0);
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

		<h1>Daftar Peserta PKL</h1>
		<form action="" method="post">
			<input type="text" name="caripeserta" placeholder="Cari ...">
			<button type="submit" name="cari" id="Cari"> Cari</button>
			<button onclick="datapeserta.php">Reset</button>
		</form>
		<br>

		<table border="1">
				<thead>
					<tr>
						<th>No</th>
						<th>No Induk</th>
						<th>Nama</th>
						<th>Instansi</th>
						<th>Jurusan</th>
						<th>No Hp</th>
						<th>Status Peserta</th>
						<th colspan="5">Aksi</th>
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

		$setuju = "Terima";
		$aktif = "Aktif";
		if (!isset($_POST["cari"])) {
		$sqlview = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE status_permohonan='$setuju' LIMIT $posisi,$batas") or die (mysqli_error($conn));
		
			if (mysqli_num_rows($sqlview) > 0) {
				$no=1;
				while ($data = mysqli_fetch_assoc($sqlview)) {
				   echo '
				   <tr>
				   		<td>'.$no.'</td>
				   		<td>'.$data['no_induk_peserta'].'</td>
				   		<td>'.$data['nama_peserta'].'</td>				   		
						<td>'.$data['instansi_asal'].'</td>					   		
						<td>'.$data['jurusan'].'</td>					   		
				   		<td>'.$data['no_hp'].'</td>
				   		<td>'.$data['status_peserta'].'</td>
						<td>	
							<a href="update.php?no_induk_peserta='.$data['no_induk_peserta'].'">Detail Data</a>
						</td>
						<td>	
							<a href="aktif.php?no_induk_peserta='.$data['no_induk_peserta'].'">Aktifkan</a>
						</td>
						<td>	
							<a href="nonaktif.php?no_induk_peserta='.$data['no_induk_peserta'].'">Nonaktifkan</a>
						</td>
								<td>	
							<a href="delete.php?no_induk_peserta='.$data['no_induk_peserta'].'">Hapus</a>
						</td>
						</tr>
				   		';
				   		$no++;
				}
			}else {
				echo '
				<td colspan="11">Tidak Ada Data</td>
				</tr>';	
			}
			$hitungdata = mysqli_query($conn, "SELECT no_induk_peserta, nama_peserta, instansi_asal, jurusan, no_hp, status_peserta FROM tbl_peserta WHERE status_permohonan='$setuju'") or die (mysqli_error($conn));
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
			 	echo "<p> Total Peserta : <b>$jmldata</b> Orang</p>";

}
			 ?>
		
		
			
	
		<?php 
				if (isset($_POST["cari"])) {
			$cari = $_POST["caripeserta"];
			$search = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE nama_peserta LIKE '%$cari%'") or die (mysqli_error($conn)); 	
			if (mysqli_num_rows($search) > 0) {
				$no=1;
				while ($data = mysqli_fetch_array($search)) {
				    echo '
				   <tr>
				   		<td>'.$no.'</td>
				   		<td>'.$data['no_induk_peserta'].'</td>
				   		<td>'.$data['nama_peserta'].'</td>				   		
						<td>'.$data['instansi_asal'].'</td>					   		
						<td>'.$data['jurusan'].'</td>					   		
				   		<td>'.$data['no_hp'].'</td>
				   		<td>'.$data['status_peserta'].'</td>
						<td>	
							<a href="update.php?no_induk_peserta='.$data['no_induk_peserta'].'">Detail Data</a>
						</td>
						<td>	
							<a href="aktif.php?no_induk_peserta='.$data['no_induk_peserta'].'">Aktifkan</a>
						</td>
						<td>	
							<a href="nonaktif.php?no_induk_peserta='.$data['no_induk_peserta'].'">Nonaktifkan</a>
						</td>
								<td>	
							<a href="delete.php?no_induk_peserta='.$data['no_induk_peserta'].'">Hapus</a>
						</td>
				   		';
				   		$no++;
				}
			}else {
			echo '
			<td colspan="8" align="center">TIDAK MENEMUKAN DATA YANG DICARI</td>
			</tr>
			';
		}	
	}
		?>
	
</tbody>
</table>
	</body>
</html>
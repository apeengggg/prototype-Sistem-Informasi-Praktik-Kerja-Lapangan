<?php 
session_start();
if (!isset($_SESSION["login_admin"])) {
	header("location:../../index.php");
	exit();
}
require '../../koneksi.php';
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
		<h1> DATA PEMOHON PKL ATAU PRAKERIN</h1>
			<table border="1">
				<thead>
					<tr>
						<th>No</th>
						<th>Foto</th>
						<th>No Induk</th>
						<th>Nama</th>
						<th>Instansi</th>
						<th>Jurusan</th>
						<th>Alamat</th>
						<th>No Hp</th>
						<th>CV</th>
						<th>Surat</th>
						<th>Tanggal Permohonan</th>
						<th>Status Permohonan</th>
						<th colspan="3">Aksi</th>
					</tr>
				</thead>
				<tbody>
	<?php 
	// error_reporting(0);
	$batas = 4;
	$halaman = @$_GET['halaman'];
	if (empty($halaman)) {
		$posisi = 0;
		$halaman = 1;
	}else {
		$posisi = ($halaman-1) * $batas;
	}

	$menunggu = "Menunggu";
	$tidak = "Tidak Aktif";
		$sqlview = mysqli_query($conn, "SELECT no_induk_peserta, nama_peserta, instansi_asal, jurusan, alamat_peserta, no_hp, foto, cv, surat, tgl_permohonan, status_permohonan FROM tbl_peserta WHERE status_permohonan='$menunggu' AND status_peserta='$tidak' LIMIT $posisi,$batas")	or die (mysqli_error($conn));
		
			if (mysqli_num_rows($sqlview) > 0) {
				$noposisi = $posisi+1;
				$no=1;
				while ($data = mysqli_fetch_assoc($sqlview)) {
				   echo '
				   <tr align="center">
				   		<td>'.$no.'</td>
				   		<td>
				 		<img src="../../media/Foto/'.$data["foto"].'" width="70px">
				   		</td>
				   		<td>'.$data['no_induk_peserta'].'</td>
				   		<td>'.$data['nama_peserta'].'</td>				   		
						<td>'.$data['instansi_asal'].'</td>
						<td>'.$data['jurusan'].'</td>
				   		<td>'.$data['alamat_peserta'].'</td>
				   		<td>'.$data['no_hp'].'</td>
				   		<td>
				   		<a href="../../media/CV/'.$data["cv"].'"target="_blank">Lihat CV</a>
				   		</td>
				   		<td>
				   		<a href="../../media/Surat/'.$data["surat"].'"target="_blank">Lihat Surat</a>
				   		</td>
				   		<td>'.$data['tgl_permohonan'].'</td>
				   		<td>'.$data['status_permohonan'].'</td>
				   		<td>
							<a href="setujui.php?no_induk_peserta='.$data['no_induk_peserta'].'">Terima</a>
						</td>
						<td>	
							<a href="tolak.php?no_induk_peserta='.$data['no_induk_peserta'].'">Tolak</a>
						</td>
						</tr>
				   		';
				   		$no++;
				}
				
			}else {
				echo '<tr>
				<td colspan="14" align="center">TIDAK ADA PEMOHON</td>
				</tr>';
			}
					 ?>
				</tbody>
			</table>
			<?php 
			$status = "Menunggu";
			$status1 = "Tidak Aktif";
			$hitungdata = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE status_permohonan='$status' AND status_peserta='$status1' ") or die (mysqli_erorr($conn));
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
			 	echo "<p> Total Pemohon : <b>$jmldata</b> Orang</p>";

			 ?>
	</body>
</html>
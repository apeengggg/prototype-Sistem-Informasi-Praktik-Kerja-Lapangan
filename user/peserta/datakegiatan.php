<?php 

session_start();
require '../../koneksi.php';
	$aktif = "Tidak Aktif";
	$menunggu = "Menunggu";
	$status_pmh = $_SESSION["status_pmh"];
	$status_pst = $_SESSION["status_pst"];
	if ($status_pst ==  $aktif || $status_pmh == $menunggu ) {
	header("location:permohonan.php");
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
	<a href="index.php">Kembali</a>
	<body>
		<h1>Data Kegiatan PKL</h1>
			<table border="1">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Kegiatan</th>
						<th colspan="2">Aksi</th>
					</tr>
				</thead>
			<tbody>		
				<?php 
				$batas = 4;
					$halaman = @$_GET['halaman'];
					if (empty($halaman)) {
						$posisi = 0;
						$halaman = 1;
						$no=1;
					}else {
						$posisi = ($halaman-1) * $batas;
					}
				$noinduk=$_SESSION["no_induk"];
				$tanggal = date("d-m-Y");

				$viewabsen = mysqli_query($conn, "SELECT * FROM tbl_kegiatan WHERE no_induk_peserta='$noinduk' LIMIT $posisi, $batas") or die (mysqli_error($conn));
				if (mysqli_num_rows($viewabsen) > 0) {
				
					while ($data = mysqli_fetch_assoc($viewabsen)) {
					echo '
					<tr>
				
					<td>'.$data['tanggal'].'</td>
					<td>'.$data['kegiatan'].'</td>
					<td>
						<a href="ubahkegiatan.php?id_kegiatan='.$data['id_kegiatan'].'">Ubah</a>
					</td>
					<td>
						<a href="hapuskegiatan.php?id_kegiatan='.$data['id_kegiatan'].'">Hapus</a>
					</td>
					';
					
				
}} ?></tbody>
</table>
<?php 
			$status = "Menunggu";
			$status1 = "Tidak Aktif";
			$hitungdata =  mysqli_query($conn, "SELECT * FROM tbl_kegiatan WHERE no_induk_peserta='$noinduk'") or die (mysqli_error($conn));
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
			 	echo "<p> Total Kegiatan : <b>$jmldata</b> Kegiatan</p>";
			 ?>
	</body>
</html>
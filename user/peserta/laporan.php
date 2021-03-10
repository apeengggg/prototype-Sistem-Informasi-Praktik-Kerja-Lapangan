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
 	<body>
 		<?php 
 		require '../../koneksi.php';

 		$noinduk = $_SESSION["no_induk"];
 		$nama = $_SESSION["nama_pst"];
 		if (isset($_POST["upload"])) {
 			$judul = $_POST["judul_laporan"];
 			
 			$file = $_FILES["laporan"]["name"];
 			$tmpfile = $_FILES["laporan"]["tmp_name"];
 			$filebaru = date('dmYHis').$file;
			$pathfile = "../../media/Laporan/".$filebaru;

			if (move_uploaded_file($tmpfile, $pathfile)) {
				$sqlinsert = mysqli_query($conn, "INSERT INTO tbl_laporan (id_laporan, judul_laporan, laporan, no_induk_peserta, nama_peserta) VALUES ('', '$judul', '$filebaru', '$noinduk', '$nama')") or die (mysqli_error($conn));
				if ($sqlinsert) {
					echo '<script>alert("Berhasil Upload Laporan") document.location="laporan.php"</script>';
				}else {
					echo '<script>alert("Gagal Upload Laporan") document.location="laporan.php";</script>';
				}

			}else {
				echo '<script>alert("Gagal Upload Laporan") document.location="laporan.php";</script>';
			}
 		}

 		 ?>
 		 <a href="index.php">Kembali</a>
 		 <br>
 		<h1>Data Laporan Akhir</h1><br>
 		<form action="laporan.php" method="post" enctype="multipart/form-data">
 			<table>
 				<tr>
 					<td>Judul Laporan :</td>
 					<td><input type="text" name="judul_laporan" id="judul_laporan"></td>
 				</tr>
 				<tr>
 					<td>File :</td>
 					<td><input type="file" name="laporan" id="laporan"></td>
 				</tr>
 				<tr>
 					<td><button type="submit" name="upload" id="upload">Upload</button></td>
 				</tr>
 			</table>
 		</form>
		<br><br>
 		<table border="1">
 			<thead>
 				<th>Nama</th>
 				<th>Judul Laporan</th>
 				<th colspan="2">Aksi</th>
 			</thead>
 			<tbody>
 				<?php 
 				require '../../koneksi.php';
 				$no_induk = $_SESSION["no_induk"];
 				$viewlaporan = mysqli_query($conn, "SELECT id_laporan, judul_laporan, laporan, nama_peserta FROM tbl_laporan WHERE no_induk_peserta='$noinduk'" ) or die (mysqli_erorr($conn));
 				if (mysqli_num_rows($viewlaporan) > 0) {
 					while ($data = mysqli_fetch_assoc($viewlaporan)) {
 					    echo '
						<tr align="center">
						<td>'.$data['nama_peserta'].'</td>
						<td><a href="../../media/Laporan/'.$data["laporan"].'" target="_blank">'.$data['judul_laporan'].'</a></td>
						<td>	
							<a href="ubahlaporan.php?id_laporan='.$data['id_laporan'].'">Ubah</a>
						</td>
						<td>	
							<a href="hapuslaporan.php?id_laporan='.$data['id_laporan'].'">Hapus</a>
						</td>
						</tr>
						';
 						
 					}
 				}else {
 					echo '<tr>
						<td colspan="3" align="center">ANDA BELUM MENGUNGGAH LAPORAN</td>';
 				}
 				 ?>
 			</tbody>
 		</table>
 	</body>
 </html>
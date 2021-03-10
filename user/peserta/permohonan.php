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
					session_start();
					require '../../koneksi.php';
					if (!isset($_SESSION["login"])) {
						header("location:../../index.php");
						exit();
					}

					$noinduk = $_SESSION["no_induk"];

						if (isset($_POST["submit"])) {
							$nama = $_POST["nama_peserta"];
							$instansi = $_POST["instansi_asal"];
							$jurusan = $_POST["jurusan"];
							$alamat = $_POST["alamat_peserta"];
							$nohp = $_POST["no_hp"];
							$tgl = date("Y-m-d");
							$status_pmh = "Menunggu";
							$status_pst = "Tidak Aktif";

							$foto = $_FILES["foto"]["name"];
							$tmp_foto = $_FILES["foto"]["tmp_name"];

							$cv = $_FILES["cv"]["name"];
							$tmp_cv = $_FILES["cv"]["tmp_name"];
							
							$surat = $_FILES["surat"]["name"];
							$tmp_surat = $_FILES["surat"]["tmp_name"];	

							$fotobaru = date('dmYHis').$foto;
							$pathfoto = "../../media/Foto/".$fotobaru;
							
							$cvbaru = date('dmYHis').$cv;
							$pathcv = "../../media/CV/".$cvbaru;
							
							$suratbaru = date('dmYHis').$surat;
							$pathsurat = "../../media/Surat/".$suratbaru;

							if (move_uploaded_file($tmp_foto, $pathfoto)) {
								if (move_uploaded_file($tmp_cv, $pathcv)) {
									if (move_uploaded_file($tmp_surat, $pathsurat)) {
									
							$sqlinsert = mysqli_query($conn,"UPDATE tbl_peserta SET 
								nama_peserta='$nama',
								instansi_asal='$instansi',
								jurusan= '$jurusan',
								alamat_peserta='$alamat',
								no_hp='$nohp',
								foto='$fotobaru',
								cv='$cvbaru',
								surat='$suratbaru',
								tgl_permohonan='$tgl',
								status_permohonan='$status_pmh',
								status_peserta='$status_pst'
								WHERE no_induk_peserta='$noinduk'
								") or die (mysqli_error($conn));

							if ($sqlinsert) {
								echo "<script>
											alert('data berhasil ditambahkan!!')		
										</script>";
							}else {
								echo "<script>
											alert('data gagal ditambahkan!!')		
										</script>";
						}	}
					}
				}
			}
?>
				<h1>
					Form Permohonan Praktek Kerja Lapangan <br>
					Dinas Komunikasi Informatika dan Statistik <br>
					Kota Cirebon
				</h1>
				<a href="../../logout.php">Logout</a><br>
				<a href="index.php">Beranda</a><br>

		<form action="permohonan.php" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td>Nama Pemohon :</td>
					<td><input type="text" name="nama_peserta" id="nama_peserta"></td>
				</tr>
				<tr>
					<td>Instansi Asal :</td>
					<td><input type="text" name="instansi_asal" id="instansi_asal"></td>
				</tr>
				<tr>
					<td>Jurusan :</td>
					<td><input type="text" name="jurusan" id="jurusan"></td>
				</tr>
				<tr>
					<td>Alamat Pemohon :</td>
					<td><textarea name="alamat_peserta" id="alamat_peserta"></textarea></td>
				</tr>
				<tr>
					<td>No Hp :</td>
					<td><input type="text" name="no_hp" id="no_hp" placeholder="62"></td>
				</tr>
				<tr>
					<td>Foto :</td>
					<td><input type="file" name="foto" id="foto"></td>
				</tr>
				<tr>
					<td>CV :</td>
					<td><input type="file" name="cv" id="cv"></td>
				</tr>
				<tr>
					<td>Surat Permohonan :</td>
					<td><input type="file" name="surat" id="surat"></td>
				</tr>								
				<tr>
					<p>
					<td></td>
					<td><br/><button type="submit" name="submit" value="submit">Submit</button></td>
				</tr>
			</table>
	<br><br>
				<table border="1">
				<thead>
					<tr>
						<th>No Induk</th>
						<th>Nama</th>
						<th>Instansi</th>
						<th>Jurusan</th>
						<th>Tanggal Permohonan</th>
						<th>Status Permohonan</th>
						<th>Status Akun</th>
						<th colspan="2">Aksi</th>
					</tr>
				</thead>
	<?php
	require '../../koneksi.php';
	$noinduk = $_SESSION["no_induk"];

	$sqlview = mysqli_query($conn, "SELECT no_induk_peserta, nama_peserta, instansi_asal, jurusan, tgl_permohonan, status_permohonan, status_peserta FROM tbl_peserta WHERE no_induk_peserta='$noinduk'")	or die (mysqli_error($conn));

			if (mysqli_num_rows($sqlview) > 0) {
				while ($data = mysqli_fetch_assoc($sqlview)) {
				   echo '
				   <tr>
				   		<td>'.$data['no_induk_peserta'].'</td>
				   		<td>'.$data['nama_peserta'].'</td>				   		
						<td>'.$data['instansi_asal'].'</td>
						<td>'.$data['jurusan'].'</td>					   		
				   		<td>'.$data['tgl_permohonan'].'</td>
				   		<td>'.$data['status_permohonan'].'</td>
				   		<td>'.$data['status_peserta'].'</td>
				   		<td>
							<a href="update_peserta.php?no_induk_peserta='.$data['no_induk_peserta'].'">Edit Data</a>
						</td>
				   		';

				}
				echo "
				</table>";
			}
					 ?>
	</table>
</table>
</form>
</body>
</html>
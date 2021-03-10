<?php 
session_start();
require '../../koneksi.php';
	$aktif = "Tidak Aktif";
	$menunggu = "Menunggu";
	$status_pmh = $_SESSION["status_pmh"];
	$status_pst = $_SESSION["status_pst"];
	if ($status_pst == $aktif ) {
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
		<a href="permohonan.php">Cek Status Permohonan</a><br>
		<a href="dataabsen.php">Data Absen</a><br>
		<a href="datakegiatan.php">Data Kegiatan</a><br>
		<a href="laporan.php">Laporan Akhir</a><br>
		<a href="../../logout.php">Logout</a>
		
		<?php 
		if (!isset($_SESSION["login"])) {
			header("location:login.php");
			exit();
		}

		// // date_default_timezone_set('Asia/Jakarta');
		// $waktu = date("H:i");
		// echo $waktu.$wib;
		if (isset($_POST["absenmasuk"])) {
			$waktu = date("H.i");
			$absenmasuk = $waktu.$wib;
			date_default_timezone_set('Asia/Jakarta');
			$tanggal = date("Y-m-d");
			$noinduk = $_SESSION["no_induk"];
			$nama = $_SESSION["nama_pst"];
			$count = mysqli_num_rows(mysqli_query($conn, "SELECT absen_masuk, tanggal, no_induk_peserta FROM tbl_absen WHERE no_induk_peserta='$noinduk' AND tanggal='$tanggal' AND absen_masuk IS NOT NULL"));
			if ($count > 0 ) {
				echo "<script>;
						 alert('Kamu Sudah Melakukan Absen Masuk')
					echo </script>";
				}else {
			$querymasuk = mysqli_query($conn, "INSERT INTO tbl_absen (tanggal, absen_masuk, no_induk_peserta) 
				VALUES (
				'$tanggal',
				'$absenmasuk',
				'$noinduk')") or die (mysqli_erorr($conn));
			if ($querymasuk) {
				echo '<script>';
				echo 'alert("Anda Berhasil Melakukan Absen Masuk")';
				echo '</script>';
			}
					
			} 
				echo '<script>';
				echo 'alert("Gagal Melakukan Absen Masuk")';
				echo '</script>';
			}
		if (isset($_POST["absenpulang"])) {
			$waktu = date("H.i");
			$absenmasuk = $waktu.$wib;
			date_default_timezone_set('Asia/Jakarta');
			$tanggal = date("Y-m-d");
			$noinduk=$_SESSION["no_induk"];
			$cek = mysqli_num_rows(mysqli_query($conn, "SELECT absen_pulang, tanggal, no_induk_pesertaF FROM tbl_absen WHERE absen_pulang IS NOT NULL AND tanggal='$tanggal' AND no_induk_peserta='$noinduk' "))
			if ($cek > 0) {
				echo "<script>;
						 alert('Kamu Sudah Melakukan Absen Pulang')
					echo </script>";
				}else {
			$querypulang = mysqli_query($conn, "UPDATE tbl_absen SET
				absen_pulang='$absenmasuk' WHERE tanggal='$tanggal' AND no_induk_peserta='$noinduk'") or die (mysqli_erorr($conn));
			if ($querypulang) {
				echo "<script>;
					 alert('Kamu Berhasil Melakukan Absen Pulang')
					echo </script>";
			}else {
				echo '<script>';
				echo 'alert("Gagal melakukan absen")';
				echo 'window.location.href = permohonan.php?gagal';
				echo '</script>';
			}
		  }
		}


		 ?>
		 <h1>Absen Hari Ini</h1>
			<table border="1">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Absen Masuk</th>
						<th>Absen Pulang</th>
						<th colspan="4">Absen</th>
					</tr>
				</thead>
			
				<?php 

				$noinduk=$_SESSION["no_induk"];
				$tanggal = date("Y-m-d");

				$viewabsen = mysqli_query($conn, "SELECT * FROM tbl_absen WHERE tanggal='$tanggal' AND no_induk_peserta='$noinduk'") or die (mysqli_error($conn));
				if (mysqli_num_rows($viewabsen) > 0) {
					while ($data = mysqli_fetch_assoc($viewabsen)) {
					echo '
					<tr>
					<td>'.$data['tanggal'].'</td>
					<td>'.$data['absen_masuk'].'</td>
					<td>'.$data['absen_pulang'].'</td>
					<td>
						<form action="" method="post">
							<button type="submit" name="absenmasuk" id="absenmasuk">Absen Masuk
						</button>
						</form>
					</td>
					<td>
						<form action="" method="post">
							<button type="submit" name="absenpulang" id="absenpulang">Absen Pulang
						</button>
						</form>
					</td>
					';
						}
				} else {
						echo '<tr>
						<td colspan="3" align="center">ANDA BELUM ABSEN HARI INI</td>
						<td>
						<form action="" method="post">
							<button type="submit" name="absenmasuk" id="absenmasuk">Absen Masuk
						</button>
						</form>
					</td>
					<td>
						<form action="" method="post">
							<button type="submit" name="absenpulang" id="absenpulang">Absen Pulang
						</button>
						</form>
					</td>
						</tr>';
				}

				
				 ?>
			</table> 
	<?php 
		$noinduk=$_SESSION["no_induk"];
		$nama = $_SESSION["nama_pst"];
		if (isset($_POST["kegiatan"])) {
			$tanggal = date("Y-m-d");
			$kegiatan = $_POST["kegiatan_peserta"];
			$no_induk = $noinduk;

		$querykegiatan = mysqli_query($conn, "INSERT INTO tbl_kegiatan (
						 tanggal,
						 kegiatan,
						 no_induk_peserta,
						 nama)
						 VALUES (
						 '$tanggal',
						 '$kegiatan',
						 '$no_induk',
						 '$nama')") or die (mysqli_error($conn));	
		if ($querykegiatan) {
			echo '
			<script>
			alert("kegiatan berhasil ditambahkan!")
			</script>';
		}else {
			echo '
			<script>
			alert("kegiatan gagal ditambahkan!")
			</script>';
		}
		}
	 ?>	
	 <h1>Kegiatan Hari Ini</h1>
			<table border="1">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Kegiatan</th>
					</tr>
				</thead>
			
				<?php 

				$noinduk=$_SESSION["no_induk"];
				$tanggal = date("Y-m-d");

				$viewabsen = mysqli_query($conn, "SELECT * FROM tbl_kegiatan WHERE tanggal='$tanggal' AND no_induk_peserta='$noinduk'") or die (mysqli_error($conn));
				if (mysqli_num_rows($viewabsen) > 0) {
					$no=1;
					while ($data = mysqli_fetch_assoc($viewabsen)) {
					echo '
					<tr>
					<td>'.$no.'</td>
					<td>'.$data['tanggal'].'</td>
					<td>'.$data['kegiatan'].'</td>';
					$no++;
		}
	}else {
		echo '<tr>
						<td colspan="3" align="center">ANDA BELUM MENGISI KEGIATAN HARI INI</td>';
	}
 ?>
	 <form action="" method="post">
	 	<table>
	 		<tr>
	 			<td>Kegiatan :</td><br>
	 		</tr>
	 		<tr>
	 			<td>
	 				<textarea name="kegiatan_peserta" id="kegiatan_peserta" cols="40" rows="10"></textarea>
	 			</td>
	 		</tr>
	 		<tr>
	 			<td>
	 				<button type="submit" name="kegiatan" id="kegiatan">
	 					Tambah
	 				</button>
	 			</td>
	 		</tr>
	 	</table>
	 </form>
	</body>
	</body>
</html>
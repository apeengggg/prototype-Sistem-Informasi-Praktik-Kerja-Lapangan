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
		include "../../koneksi.php";
		
		if (isset($_GET["id_laporan"])) {
			$laporan = $_GET["id_laporan"];
			$view = mysqli_query($conn, "SELECT * FROM tbl_laporan WHERE id_laporan='$laporan'") or die (mysqli_error($conn));	
			if (mysqli_num_rows($view) == 0) {
				echo "
				<script>
					alert('data tidak ada dalam database !')
				</script";
				exit();
			}else {
				$data = mysqli_fetch_array($view);
			}
		}
	?>
	<?php 
	if (isset($_POST["ubahlaporan"])) {
		$judul = $_POST["judul_laporan"];
        
        $laporan = $_FILES["laporan"]["name"];
        $tmp_laporan = $_FILES["laporan"]["tmp_name"];
        
        $laporanbaru = date('dmYHis').$laporan;
        $pathlaporan = "../../media/Laporan/".$laporanbaru;
        
        if (move_uploaded_file($tmp_laporan, $pathlaporan)) {
        
        $induk = $_SESSION["no_induk"];
		$update = mysqli_query($conn, "UPDATE tbl_laporan SET
        judul_laporan='$judul',
        laporan='$laporanbaru'
        WHERE no_induk_peserta='$induk'") or die (mysqli_eror($update));
		if ($update) {
			header("location:laporan.php");
			echo "
			<script>
				alert('berhasil mengubah laporan!')
			</script>";
		}else {
			echo "
			<script>
				alert('gagal mengubah laporan!')
			</script>";			
		}
	}
}
	 ?>
<a href="index.php">Kembali</a><br>
<h2>Data Peserta</h2>
<form action="" method="post" enctype="multipart/form-data">
	
	<table>
    <tr>
        <td>Judul Laporan</td><td>:</td>
        <td>
        	<input type="text" name="judul_laporan" id="judul_laporan" value="<?php echo $data["judul_laporan"] ?>" required>
        </td>
    </tr>
        <td>CV</td><td>:</td>
        <td>
        <a href="../../media/CV/<?php echo $data["laporan"] ?>" target="_blank">Lihat Laporan</a>
        <br>
        <input type="file" name="laporan" id="laporan">
    </tr>
    <tr>
    	<td colspan="3"><button type="submit" name="ubahlaporan" id="ubahlaporan" value="ubahlaporan">Ubah Laporan</button>
    </td>
    </tr>
</form>
</table>
	</body>
</html>
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
        <a href="../../logout.php">Logout</a>   <br>
        <a href="datapeserta.php">Data Peserta</a><br>
        <a href="absen.php">Data Absen</a><br>
        <a href="kegiatan.php">Data Kegiatan</a><br>
        <a href="pemohon.php">Data Pemohon</a><br>
        <a href="daftartolak.php">Daftar Peserta Ditolak</a>
        <a href="datalaporan.php">Daftar Laporan Peserta</a><br><br>
		<?php 
		session_start();
		include "../../koneksi.php";
		
		if (isset($_GET["no_induk_peserta"])) {
			$noinduk = $_GET["no_induk_peserta"];
			$view = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE no_induk_peserta='$noinduk'") or die (mysqli_error($conn));	
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
	if (isset($_POST["ubahstatus"])) {
		$induk = $_POST["no_induk_peserta"];
		$status_pmh = $_POST["status_permohonan"];
        $bidang     = $_POST["Bidang"];
		$status_pst = $_POST["status_peserta"];

		$update = mysqli_query($conn, "UPDATE tbl_peserta SET 
            status_permohonan='$status_pmh',
            Bidang='$bidang',
            status_peserta='$status_pst'
            WHERE no_induk_peserta='$induk'") or die (mysqli_eror($update));
		if ($update) {
			header("location:datapeserta.php");
			echo "
			<script>
				alert('gagal mengubah status pemohon!')
			</script>";
		}else {
			echo "
			<script>
				alert('gagal mengubah status pemohon!')
			</script>";			
		}
	}
	 ?>
<h2>Data Pemohon</h2>
<form action="update.php" method="post">
	
	<table>
    <tr>
        <td rowspan=12>
        <img src="../../media/Foto/<?php echo $data["foto"] ?>" height="180" width="140">
        </td>
        <td>
        	NO INDUK
        </td>
        <td>
        	:
        </td>
        <td>
        	<input type="text" name="no_induk_peserta" id="no_induk_peserta" value="<?php echo $data["no_induk_peserta"] ?>" size="29" required readonly>
        </td>
    </tr>
    <tr>
        <td>
        	NAMA
        </td>
        <td>
        	:
        </td>
        <td>
        	<input type="text" name="nama_peserta" id="nama_peserta" value="<?php echo $data["nama_peserta"] ?>" size="29" required readonly>
        </td>        
    </tr>
    <tr>
        <td>
        	INSTANSI ASAL
        </td>
        <td>
        	:
        </td>
        <td>
        	<input type="text" name="instansi_asal" id="instansi_asal" value="<?php echo $data["instansi_asal"] ?>" size="29" required readonly>
        </td>
    </tr>
        <tr>
        <td>
            JURUSAN
        </td>
        <td>
            :
        </td>
        <td>
            <input type="text" name="jurusan" id="jurusan" value="<?php echo $data["jurusan"] ?>" required readonly size="29">
        </td>
    </tr>
    <tr>
        <td>
        	ALAMAT
        </td>
        <td>
        	:
        </td>
        <td>
        	<input type="text" name="alamat_peserta" id="alamat_peserta" value="<?php echo $data["alamat_peserta"] ?>" size="29" required readonly>
        </td>
    </tr>
    <tr>
        <td>
        	NO HP
        </td>
        <td>
        	:
        </td>
        <td>
        	<input type="text" name="no_hp" id="no_hp" value="<?php echo $data["no_hp"] ?>" size="29" required readonly>
        </td>
    </tr>
    <tr>
        <td>
        	CV
        </td>
        <td>
        	:
        </td>
        <td>
            <a href="../../media/CV/<?php echo $data["cv"] ?>" target="_blank">Lihat CV</a>
        </td>
    </tr>
    <tr>
        <td>
            SURAT PERMOHONAN
        </td>
        <td>
            :
        </td>
        <td>
            <a href="../../media/Surat/<?php echo $data["surat"] ?>" target="_blank">Lihat Surat</a>
        </td>
    </tr>
    <tr>
        <td>
        	TANGGAL PERMOHONAN
        </td>
        <td>
        	:
        </td>
        <td>
			<input type="text" name="tgl_permohonan" id="tgl_permohonan" value="<?php echo $data["tgl_permohonan"] ?> " size="29" required readonly>
        </td>
    </tr>
    <tr>
        <td>
        	STATUS PERMOHONAN
        </td>
        <td>
        	:
        </td>
        <td>
        	<select name="status_permohonan" required>
						<option value="">-Ubah Status-</option>
                        <option value="Menunggu" <?php if($data['status_permohonan'] == 'Menunggu'){ echo 'selected'; } ?>>Menunggu</option>
						<option value="Terima" <?php if($data['status_permohonan'] == 'Terima'){ echo 'selected'; } ?>>Disetujui</option>
						<option value="Tolak" <?php if($data['status_permohonan'] == 'Tolak'){ echo 'selected'; } ?>>Ditolak</option>
			</select>
        </td>
    </tr>
        <tr>
        <td>
            BIDANG
        </td>
        <td>
            :
        </td>
        <td>
            <select name="Bidang" required>
                        <option value="">-Pilih Bidang-</option>
                        <option value="Layanan E-Government" <?php if($data['Bidang'] == 'Layanan E-Government'){ echo 'selected'; } ?>>Layanan E-Government</option>
                        <option value="Pengelolaan Informasi Publik" <?php if($data['Bidang'] == 'Pengelolaan Informasi Publik'){ echo 'selected'; } ?>>Pengelolaan Informasi Publik</option>
                        <option value="Pengelolaan Komunikasi Publik" <?php if($data['Bidang'] == 'Pengelolaan Komunikasi Publik'){ echo 'selected'; } ?>>Pengelolaan Komunikasi Publik</option>
                        <option value="Statistik Sektoral dan Persandian" <?php if($data['Bidang'] == 'Statistik Sektoral dan Persandian'){ echo 'selected'; } ?>>Statistik Sektoral dan Persandian</option>
                        <option value="Teknologi Informasi dan Komunikasi" <?php if($data['Bidang'] == 'Teknologi Informasi dan Komunikasi'){ echo 'selected'; } ?>>Teknologi Informasi dan Komunikasi</option>
                        <option value="UPT LPSE" <?php if($data['Bidang'] == 'UPT LPSE'){ echo 'selected'; } ?>>UPT LPSE</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            STATUS PESERTA
        </td>
        <td>
            :
        </td>
        <td>
            <input type="text" name="status_peserta" id="status_peserta" value="<?php echo $data["status_peserta"]; ?>" size="29" readonly>
        </td>
    </tr>
    <tr>
    	<td colspan="4" align="right"><button type="submit" name="ubahstatus" id="ubahstatus" value="ubahstatus">Ubah Status</button>
    </td>
    </tr>
</form>
</table>
	</body>
</html>
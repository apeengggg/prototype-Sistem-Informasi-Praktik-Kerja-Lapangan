<?php 

session_start();
require '../../koneksi.php';
if (!isset($_SESSION["login_admin"])) {
	header("location:../../index.php");
	exit();
}
	if (isset($_GET["no_induk_peserta"])) {
			$noinduk = $_GET["no_induk_peserta"];
			$view = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE no_induk_peserta='$noinduk'") or die (mysqli_error($conn));	
			if (mysqli_num_rows($view) > 0) {
				$setuju = "Tidak Aktif";
				$ubahstatus = mysqli_query($conn, "UPDATE tbl_peserta SET status_peserta='$setuju' WHERE no_induk_peserta='$noinduk'");
				header("location:datapeserta.php");
			}else {
				echo "
				<script>
					alert('data tidak ada dalam database !')
				</script";
			}
		}
	?>
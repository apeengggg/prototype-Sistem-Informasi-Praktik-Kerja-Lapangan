<?php
session_start();
include('../../koneksi.php');

if(isset($_GET['no_induk_peserta'])){
	$id = $_GET['no_induk_peserta'];
	
	$cek = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE no_induk_peserta='$id'") or die(mysqli_error($conn));
	
	if(mysqli_num_rows($cek) > 0){
		$del = mysqli_query($conn, "DELETE FROM tbl_peserta WHERE no_induk_peserta='$id'") or die(mysqli_error($conn));
		if($del){
			echo '<script>alert("Berhasil menghapus data."); document.location="datapeserta.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="datapeserta.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="datapeserta.php";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="datapeserta.php";</script>';
}

?>
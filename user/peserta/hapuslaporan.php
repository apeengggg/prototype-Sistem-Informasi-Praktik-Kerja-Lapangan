<?php
session_start();
include('../../koneksi.php');

if(isset($_GET['id_laporan'])){
	$id = $_GET['id_laporan'];
	
	$cek = mysqli_query($conn, "SELECT * FROM tbl_laporan WHERE id_laporan='$id'") or die(mysqli_error($conn));
	
	if(mysqli_num_rows($cek) > 0){
		$del = mysqli_query($conn, "DELETE FROM tbl_laporan WHERE id_laporan='$id'") or die(mysqli_error($conn));
		if($del){
			echo '<script>alert("Berhasil menghapus data."); document.location="laporan.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="laporan.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="laporan.php";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="laporan.php";</script>';
}

?>
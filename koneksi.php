<?php 
$conn = mysqli_connect("localhost","root","","sipm_pkl_dkis");

if (mysqli_connect_errno()) {
	echo "Koneksi ke database tidak tersedia".mysqli_connect_errno();
}

date_default_timezone_set('Asia/Jakarta');
$wib = " WIB";

?>
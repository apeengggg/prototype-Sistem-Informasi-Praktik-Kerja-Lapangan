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
	if (isset($_SESSION["login"])) {
		header("location:user/peserta/index.php");
		exit();
	}
	
	require 'koneksi.php';

	if (isset($_POST["login"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$admin    = 'Admin';
		$pjl	  = 'pjl';

		$sql_login = mysqli_query($conn, "SELECT * FROM tbl_peserta WHERE username='$username' AND password='$password'") or die (mysqli_error($sql_login));
		$sql_admin = mysqli_query($conn, "SELECT * FROM tbl_userr WHERE username='$username' AND password='$password' AND level_user='$admin'") or die (mysqli_error($sql_admin));
		if (mysqli_num_rows($sql_login) > 0) {
			$row_peserta =mysqli_fetch_array($sql_login);
			$_SESSION["login"] = true;
			$_SESSION["no_induk"] = $row_peserta["no_induk_peserta"];
			$_SESSION["status_pst"] = $row_peserta["status_peserta"];
			$_SESSION["status_pmh"] = $row_peserta["status_pemohon"];
			$_SESSION["nama_pst"] = $row_peserta["nama_peserta"];
			header("location:user/peserta/");
		}if (mysqli_num_rows($sql_admin) > 0 ) {
			$row_admin = mysqli_fetch_array($sql_admin);
			$_SESSION["login_admin"] = true;
			$_SESSION["admin"] = $row_admin["level_user"];
			$_SESSION["status_user"] = $row_admin["status_user"];				
			header("location:user/admin/");
		}else {
			header("location:index.php?logingagal");
		}
	} 
	?>
	<form action="index.php" method="post">
		<h1>Login</h1>
		<table>	
			<tr>	
				<td>Username :</td>
				<td>
					<input type="text" name="username" id="username">
				</td>
			</tr>
			<tr>
				<td>Password :</td>
				<td>
					<input type="password" name="password" id="password">
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Belum Punya Akun? Silahkan <a href="registrasi.php">Daftar Disini</a></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" name="login" id="login" value="login">Login</button></td>
			</tr>
		</table>
	</form>
</body>
</html>	
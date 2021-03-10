<!DOCTYPE html>
<html lang="en">
<head>
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
		include "koneksi.php";
		if (isset($_POST["submit"])) {
			$noinduk = $_POST["no_induk_peserta"];
			$username = $_POST["username"];
			$password = $_POST["password"];
			$status_pst = "Tidak Aktif";
			$sqlinsert = mysqli_query($conn,"INSERT INTO tbl_peserta (no_induk_peserta, username, password, status_peserta) VALUES('$noinduk','$username','$password', '$status_pst')") or die (mysqli_error($conn));

			if ($sqlinsert) {
				echo "<script>
				alert('Kamu Berhasil Mendaftar Akun, Silahkan isi Formulir Permohonan dan Login Terlebih dahulu!!')	
				</script>";
			}else {
				echo "<script>
				alert('Gagal Mendaftar akun!')		
				</script>";
			}	}
			?>			
			<h2>Daftar Akun</h2>

			<form action="registrasi.php" method="post">
				<table>
					<tr>
						<td>No Induk (NIM/NIS) :</td>
						<td><input type="text" name="no_induk_peserta" id="no_induk_peserta"></td>
					</tr>
					<tr>
						<td>Username :</td>
						<td><input type="text" name="username" id="username"></td>
					</tr>
					<tr>
						<td>Password :</td>
						<td><input type="password" name="password" id="password"></td>
					</tr>
					<tr>
						<td></td>
						<td>Sudah Punya Akun?<a href="index.php">Login Disini</a></td>
					</tr>
					<tr>	
						<td></td>
						<td><br/><button type="submit" name="submit" value="submit">Submit</button></td>
					</tr>
				</table>
				<br><br>
			</tr>
		</table>
	</form>
</body>
</html>
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
        include "../../koneksi.php";
        
        if (isset($_GET["id_kegiatan"])) {
            $idkeg = $_GET["id_kegiatan"];
            $view = mysqli_query($conn, "SELECT * FROM tbl_kegiatan WHERE id_kegiatan='$idkeg'") or die (mysqli_error($conn));    
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
    require '../../koneksi.php';

	if (isset($_POST["ubahkegiatan"])) {
		$id = $_POST["id_kegiatan"];
        $kegiatan = $_POST["kegiatan"];
        
		$update = mysqli_query($conn, "UPDATE tbl_kegiatan SET
        id_kegiatan='$id',
        kegiatan='$kegiatan'
        WHERE id_kegiatan='$id'") or die (mysqli_eror($update));
		if ($update) {
			header("location:index.php");
			echo "
			<script>
				alert('berhasil mengubah data peserta!')
			</script>";
		}else {
			echo "
			<script>
				alert('gagal mengubah status peserta!')
			</script>";			
		}
	}
	 ?>
     
<a href="index.php">Kembali</a><br>
<h2>Ubah Kegiatan</h2>
<form action="" method="post">
	<table border="1">
    <tr>
        <td>Id</td>
        <td>
            <input type="text" name="id_kegiatan" id="id_kegiatan" value="<?php echo $data["id_kegiatan"] ?>" required>
        </td>
    </tr>
    <tr>
        <td>Kegiatan</td>
        <td>
            <textarea name="kegiatan" id="kegiatan" cols="30" rows="10" value="<?php echo $data["kegiatan"] ?>" required></textarea>
        </td>
    </tr>
    <tr>
    	<td colspan="3"><button type="submit" name="ubahkegiatan" id="ubahkegiatan" value="ubahkegiatan">Ubah Kegiatan</button>
    </td>
    </tr>
</table>
</form>
</body>
</html>
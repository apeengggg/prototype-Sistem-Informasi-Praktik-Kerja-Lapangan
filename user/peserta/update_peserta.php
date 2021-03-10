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

<a href="index.php">Kembali</a><br>
<h2>Data Peserta</h2>
<form action="" method="post" enctype="multipart/form-data">
	
	<table>
    <tr>
        <td>
        	NO INDUK
        </td>
        <td>
        	:
        </td>
        <td>
        	<input type="text" name="no_induk_peserta" id="no_induk_peserta" value="<?php echo $data["no_induk_peserta"] ?>" required>
        </td>
    </tr>
    <tr>
        <td>
            USERNAME
        </td>
        <td>
            :
        </td>
        <td>
            <input type="text" name="username" id="username" value="<?php echo $data["username"] ?>" required>
        </td>
    </tr>
    <tr>
        <td>
            NO INDUK
        </td>
        <td>
            :
        </td>
        <td>
            <input type="text" name="password" id="password" value="<?php echo $data["password"] ?>" required>
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
        	<input type="text" name="nama_peserta" id="nama_peserta" value="<?php echo $data["nama_peserta"] ?>" required>
        </td>        
    </tr>
    <tr>
        <td>
        	INSTANSI ASAL
        </td>
        <td>
        	:
        </td>
        <td colspan="">
        	<input type="text" name="instansi_asal" id="instansi_asal" value="<?php echo $data["instansi_asal"] ?>" required>
        </td>
    </tr>
        <tr>
        <td>
            JURUSAN
        </td>
        <td>
            :
        </td>
        <td colspan="">
            <input type="text" name="jurusan" id="jurusan" value="<?php echo $data["jurusan"] ?>" required>
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
        	<input type="text" name="alamat_peserta" id="alamat_peserta" value="<?php echo $data["alamat_peserta"] ?>" required>
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
        	<input type="text" name="no_hp" id="no_hp" value="<?php echo $data["no_hp"] ?>" required>
        </td>
    </tr>
    <tr>
        <td>
        	FOTO
        </td>
        <td>
        	:
        </td>
        <td>
            <img src="../../media/Foto/<?php echo $data["foto"] ?>" height="200" width="160">
            <br>
            <input type="file" name="foto" id="foto">
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
        <a href="../../media/CV/<?php echo $data["cv"] ?>"target="_blank">Lihat CV</a>
        <br>
        <input type="file" name="cv" id="cv">
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
            <br>
            <input type="file" name="surat" id="surat">
        </td>
    </tr>
    <tr>
    	<td colspan="3"><button type="submit" name="ubahstatus" id="ubahstatus" value="ubahstatus">Ubah Status</button>
    </td>
    </tr>
</form>
</table>
	</body>
</html>
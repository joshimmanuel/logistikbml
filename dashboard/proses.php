<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (isset($_POST['add'])) {

	$uuid = Uuid::uuid4()->toString();
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));
	$password = trim(mysqli_real_escape_string($con, $_POST['password']));
	$level = trim(mysqli_real_escape_string($con, $_POST['level']));
	$lokasi = trim(mysqli_real_escape_string($con, $_POST['lokasi']));
	$sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE nama_user LIKE '%$nama%' AND lokasi_user = '$lokasi' OR username LIKE '%$username%'") or die (mysqli_error($con));

	if (mysqli_num_rows($sql_user) > 0){
		echo "<script>alert('Data $nama Sudah Ada, Cek Kembali'); window.location='add.php';</script>";
	} else {
	mysqli_query($con, "INSERT INTO tb_user (id_user, nama_user, username, password, level, lokasi_user) VALUES ('$uuid', '$nama', '$username', '$password', '$level', '$lokasi')") or die (mysqli_error($con));
	echo "<script>window.location='data_user.php';</script>";
}
} else if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));
	$lokasi = trim(mysqli_real_escape_string($con, $_POST['lokasi']));
	mysqli_query($con, "UPDATE tb_user SET nama_user = '$nama', username = '$username', lokasi_user = '$lokasi' WHERE id_user='$id'") or die (mysqli_error($con));
	echo "<script>window.location='index.php';</script>";
} else if (isset($_POST['import'])) {
	$file = $_FILES['file']['name'];
	$ekstensi = explode(".", $file);
	$file_name = "file-".round(microtime(true)).".".end($ekstensi);
	$sumber = $_FILES['file']['tmp_name'];
	$target_dir = "../_file/";
	$target_file = $target_dir.$target_file;
	$upload = move_uploaded_file($sumber, $target_file);
	if ($upload) {
		echo "upload sukses";
	} else {
		echo "upload gagal";
	}
}

?>
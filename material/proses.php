<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (isset($_POST['add'])) {

	$uuid = Uuid::uuid4()->toString();
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$jumlah = trim(mysqli_real_escape_string($con, $_POST['jumlah']));
	$satuan = trim(mysqli_real_escape_string($con, $_POST['satuan']));
	$lokasi = trim(mysqli_real_escape_string($con, $_POST['lokasi']));
	$sql_material = mysqli_query($con, "SELECT * FROM tb_material WHERE nama_material LIKE '%$nama%' AND lokasi_material = '$lokasi'") or die (mysqli_error($con));

	if (mysqli_num_rows($sql_material) > 0){
		echo "<script>alert('Data $nama di $lokasi Sudah Ada, Cek Kembali'); window.location='add.php';</script>";
	} else {
	mysqli_query($con, "INSERT INTO tb_material (id_material, nama_material, jumlah_material, satuan_material, lokasi_material) VALUES ('$uuid', '$nama', '$jumlah', '$satuan', '$lokasi')") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
} else if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$jumlah = trim(mysqli_real_escape_string($con, $_POST['jumlah']));
	$satuan = trim(mysqli_real_escape_string($con, $_POST['satuan']));
	mysqli_query($con, "UPDATE tb_material SET nama_material = '$nama', jumlah_material = '$jumlah', satuan_material = '$satuan' WHERE id_material='$id'") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
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
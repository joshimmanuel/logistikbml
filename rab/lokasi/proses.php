<?php
require_once "../../_config/config.php";
require "../../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (isset($_POST['add'])) {

	$uuid = Uuid::uuid4()->toString();
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi WHERE nama_lokasi LIKE '%$nama%'") or die (mysqli_error($con));

	if (mysqli_num_rows($sql_lokasi) > 0){
		echo "<script>alert('Data $nama Sudah Ada, Cek Kembali'); window.location='data.php';</script>";
	} else {
	mysqli_query($con, "INSERT INTO tb_lokasi (id_lokasi, nama_lokasi) VALUES ('$uuid', '$nama')") or die (mysqli_error($con));
	echo "<script>alert('Data $nama Berhasil di Tambah');window.location='data.php';</script>";
}
} else if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	mysqli_query($con, "UPDATE tb_lokasi SET nama_lokasi = '$nama' WHERE id_lokasi='$id'") or die (mysqli_error($con));
	echo "<script>alert('Data berhasil diubah'); window.location='data.php';</script>";
}

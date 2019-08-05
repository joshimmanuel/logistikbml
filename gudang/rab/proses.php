<?php
require_once "../../_config/config.php";
require "../../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (isset($_POST['add'])) {

	$uuid = Uuid::uuid4()->toString();
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$lokasi = trim(mysqli_real_escape_string($con, $_POST['lokasi']));
	$sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi where id_lokasi = '$lokasi'") or die (mysqli_error($con));
	$data_lokasi = mysqli_fetch_assoc($sql_lokasi);
	$nama_lokasi = $data_lokasi['nama_lokasi'];
	$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab WHERE nama_rab LIKE '%$nama%' and lokasi_rab LIKE '%$lokasi%'") or die (mysqli_error($con));

	if (mysqli_num_rows($sql_rab) > 0){
		echo "<script>alert('Data $nama di $nama_lokasi Sudah Ada, Cek Kembali'); window.location='data.php';</script>";
	} else {
	mysqli_query($con, "INSERT INTO tb_rab (id_rab, nama_rab, lokasi_rab) VALUES ('$uuid', '$nama', '$lokasi')") or die (mysqli_error($con));
	echo "<script>alert('Data $nama Berhasil di Tambah');window.location='data.php';</script>";
}
} else if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$lokasi = trim(mysqli_real_escape_string($con, $_POST['lokasi']));
	$sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi where id_lokasi = '$lokasi'") or die (mysqli_error($con));
	$data_lokasi = mysqli_fetch_assoc($sql_lokasi);
	$nama_lokasi = $data_lokasi['nama_lokasi'];
	$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab WHERE nama_rab LIKE '%$nama%' and lokasi_rab LIKE '%$lokasi%'") or die (mysqli_error($con));

	if (mysqli_num_rows($sql_rab) > 0){
		echo "<script>alert('Data $nama di $nama_lokasi Sudah Ada, Cek Kembali'); window.location='data.php';</script>";
	} else {

	mysqli_query($con, "UPDATE tb_rab SET nama_rab = '$nama', lokasi_rab = '$lokasi' WHERE id_rab='$id'") or die (mysqli_error($con));
	echo "<script>alert('Data berhasil diubah'); window.location='data.php';</script>";
}
}

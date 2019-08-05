<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (isset($_POST['add'])) {

	$uuid = Uuid::uuid4()->toString();
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$no_telp = trim(mysqli_real_escape_string($con, $_POST['no_telp']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$sql_supplier = mysqli_query($con, "SELECT * FROM tb_supplier WHERE nama_supplier LIKE '%$nama%' AND alamat_supplier LIKE '%$alamat%'") or die (mysqli_error($con));

	if (mysqli_num_rows($sql_supplier) > 0){
		echo "<script>alert('Data $nama Sudah Ada, Cek Kembali'); window.location='add.php';</script>";
	} else {
	mysqli_query($con, "INSERT INTO tb_supplier (id_supplier, nama_supplier, no_telp_supplier, alamat_supplier) 
						VALUES ('$uuid', '$nama', '$no_telp', '$alamat')") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";

	}
} else if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$no_telp = trim(mysqli_real_escape_string($con, $_POST['no_telp']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	mysqli_query($con, "UPDATE tb_supplier SET nama_supplier='$nama', no_telp_supplier = '$no_telp', alamat_supplier = '$alamat' WHERE id_supplier = '$id'") or die (mysqli_error($con));
	echo "<script>window.location='data.php';</script>";
}
?>
<?php
require_once "../../../_config/config.php";
require "../../../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (isset($_POST['add'])) {
	$total = $_POST['total'];
	for ($i=1; $i<=$total; $i++) { 
		$uuid = Uuid::uuid4()->toString();
		$id_rab = trim(mysqli_real_escape_string($con, $_POST['id_rab-'.$i]));
		$id_material = trim(mysqli_real_escape_string($con, $_POST['id_material-'.$i]));	
		$rab_unit = trim(mysqli_real_escape_string($con, $_POST['rab_unit-'.$i]));

		$sql = mysqli_query($con, "INSERT INTO tb_rab_unit (id_rab_unit, id_rab, id_material, rab_unit) VALUES ('$uuid', '$id_rab', '$id_material', '$rab_unit')") or die (mysqli_error($con));
		if ($sql) {
		echo "<script>alert('data berhasil ditambahkan'); window.location='data.php?id=$id_rab';</script>";
		} else {
		echo "<script>alert('Gagal tambah data, coba lagi'); window.location='add.php?id=$id_rab';</script>";	
		}
}
} else if (isset($_POST['edit'])) {
	for ($i=0; $i<count($_POST['id_rab_unit']); $i++) { 
		$id = $_POST['id_rab_unit'][$i];
		$id_rab = $_POST['id_rab'];
		$rab_unit = $_POST['rab_unit'][$i];
		$sql = mysqli_query($con, "UPDATE tb_rab_unit SET rab_unit = '$rab_unit' WHERE id_rab_unit = '$id'") or die (mysqli_error($con));
		}
		echo "<script>alert('Data Berhasil Diubah'); window.location='data.php?id=$id_rab';</script>";
}
?>
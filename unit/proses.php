<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (isset($_POST['add'])) {
	$total = $_POST['total'];
	for ($i=1; $i<=$total; $i++) { 
		$uuid = Uuid::uuid4()->toString();
		$nama = trim(mysqli_real_escape_string($con, $_POST['nama-'.$i]));	
		$subkon = trim(mysqli_real_escape_string($con, $_POST['subkon-'.$i]));
		$lokasi = trim(mysqli_real_escape_string($con, $_POST['lokasi-'.$i]));
		$namarab = trim(mysqli_real_escape_string($con, $_POST['rab-'.$i]));
		$sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi WHERE id_lokasi = '$lokasi'") or die (mysqli_error($con));
		$data_lokasi = mysqli_fetch_assoc($sql_lokasi);
		$nama_lokasi = $data_lokasi['nama_lokasi'];
		$sql_unit = mysqli_query($con, "SELECT * FROM tb_unit WHERE nama_unit LIKE '%$nama%' AND lokasi_unit LIKE '%$lokasi%'") or die (mysqli_error($con));
		
	if (mysqli_num_rows($sql_unit) > 0){
		echo "<script>alert('Ada Data Yang Sudah Ada, Cek kembali'); window.location='data.php';</script>";
	}
	else {

		$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab WHERE nama_rab = '$namarab' and lokasi_rab = '$lokasi'") or die (mysql_error($con));
		if (mysqli_num_rows($sql_rab) > 0){
			$data = mysqli_fetch_assoc($sql_rab);
			$rab = $data['id_rab'];

		$sql = mysqli_query($con, "INSERT INTO tb_unit (id_unit, nama_unit, subkon_unit, lokasi_unit, rab_unit) VALUES ('$uuid', '$nama', '$subkon', '$lokasi', '$rab')") or die (mysqli_error($con));
		if ($sql) {
		echo "<script>alert('".$total." data berhasil ditambahkan'); window.location='data.php';</script>";
		} else {
		echo "<script>alert('Gagal tambah data, coba lagi'); window.location='generate.php';</script>";	
		}
	} else
	echo "<script>alert('tidak Data RAB $namarab di $nama_lokasi, silahkan masukkan Data RAB terlebih dahulu'); window.location='".base_url('rab/add.php')."';</script>'";
}
}
} else if (isset($_POST['edit'])) {
	for ($i=0; $i<count($_POST['id']); $i++) { 
		$id = $_POST['id'][$i];
		$nama = $_POST['nama'][$i];
		$subkon = $_POST['subkon'][$i];
		$lokasi = $_POST['lokasi'][$i];
		$sql = mysqli_query($con, "UPDATE tb_unit SET nama_unit = '$nama', subkon_unit = '$subkon', lokasi_unit = '$lokasi' WHERE id_unit = '$id'") or die (mysqli_error($con));
		}
		echo "<script>alert('Data Berhasil Diubah'); window.location='data.php';</script>";
}
?>
<?php
require_once "../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

if (isset($_POST['keluarkan'])) {
	for ($i=0; $i<count($_POST['id']); $i++) {
		$uuid = Uuid::uuid4()->toString(); 
		$id_material = $_POST['id'][$i];
		$jumlah_material = $_POST['jumlah'][$i];
		$unit = $_POST['unit'][$i];
		$user = $_POST['user'][$i];
		$lokasi = $_POST['lokasi'][$i];
		$sql_masuk = mysqli_query($con, "INSERT INTO `tb_keluar` (`id_keluar`, `id_material`, `jumlah_material`, `id_unit`, `lokasi_keluar`, `id_user`, `tanggal_keluar`) VALUES ('$uuid', '$id_material', '$jumlah_material', '$unit', '$lokasi', '$user', CURRENT_TIMESTAMP)") or die (mysqli_error($con));
		if ($sql_masuk) {
			mysqli_query($con, "UPDATE tb_material SET jumlah_material=jumlah_material - '$jumlah_material' where id_material='$id_material'") or die (mysqli_error($con));
		} else {
			echo "<script>alert('Data material gagal di Keluarkan'); window.location='data_keluar.php';</script>";
		}
		}
		echo "<script>alert('Data Berhasil Dikeluarkan'); window.location='data_keluar.php';</script>";
} else if (isset($_POST['masukkan'])) {
	for ($i=0; $i<count($_POST['id']); $i++) {
		$uuid = Uuid::uuid4()->toString(); 
		$id_material = $_POST['id'][$i];
		$jumlah_material = $_POST['jumlah'][$i];
		$supplier = $_POST['supplier'][$i];
		$user = $_POST['user'][$i];
		$lokasi = $_POST['lokasi'][$i];
		$sql_masuk = mysqli_query($con, "INSERT INTO `tb_masuk` (`id_masuk`, `id_material`, `jumlah_material`, `id_supplier`, `lokasi_masuk`, `id_user`, `tanggal_masuk`) VALUES ('$uuid', '$id_material', '$jumlah_material', '$supplier', '$lokasi', '$user', CURRENT_TIMESTAMP)") or die (mysqli_error($con));
		if ($sql_masuk) {
			mysqli_query($con, "UPDATE tb_material SET jumlah_material=jumlah_material + '$jumlah_material' where id_material='$id_material'") or die (mysqli_error($con));
		} else {
			echo "<script>alert('Data material gagal dimasukkan'); window.location='data_masuk.php';</script>";
		}
		}
		echo "<script>alert('Data Berhasil Dimasukkan'); window.location='data_masuk.php';</script>";
} else if (isset($_POST['edit_masuk'])) {
	for ($i=0; $i<count($_POST['id']); $i++) { 
		$user = $_POST['user'][$i];
		$tanggal_masuk = $_POST['tanggal'][$i];
		$id = $_POST['id'][$i];
		$material = $_POST['material'][$i];
		$jumlah_awal = $_POST['jumlah_awal'][$i];
		$jumlah_material = $_POST['jumlah'][$i];
		$supplier = $_POST['supplier'][$i];
		$lokasi = $_POST['lokasi'][$i];

		$sql_pengurangan = mysqli_query($con, "UPDATE tb_material SET jumlah_material=jumlah_material - '$jumlah_awal' where id_material='$material'") or die (mysqli_error($con));

		if ($sql_pengurangan) {
			$sql_edit = mysqli_query($con, "UPDATE tb_masuk SET tanggal_masuk = '$tanggal_masuk', id_material = '$material', jumlah_material = '$jumlah_material', id_supplier = '$supplier', lokasi_masuk = '$lokasi', id_user = '$user' WHERE id_masuk = '$id'") or die (mysqli_error($con));
			if ($sql_edit) {
				mysqli_query($con, "UPDATE tb_material SET jumlah_material=jumlah_material + '$jumlah_material' where id_material='$material'") or die (mysqli_error($con));
			}
		}
		}
		echo "<script>alert('Data Berhasil Diubah'); window.location='data_masuk.php';</script>";
} else if (isset($_POST['edit_keluar'])) {
	for ($i=0; $i<count($_POST['id']); $i++) { 
		$user = $_POST['user'][$i];
		$tanggal_keluar = $_POST['tanggal'][$i];
		$id = $_POST['id'][$i];
		$material = $_POST['material'][$i];
		$jumlah_awal = $_POST['jumlah_awal'][$i];
		$jumlah_material = $_POST['jumlah'][$i];
		$unit = $_POST['unit'][$i];
		$lokasi = $_POST['lokasi'][$i];

		$sql_penambahan = mysqli_query($con, "UPDATE tb_material SET jumlah_material=jumlah_material + '$jumlah_awal' where id_material='$material'") or die (mysqli_error($con));

		if ($sql_penambahan) {
			$sql_edit = mysqli_query($con, "UPDATE tb_keluar SET tanggal_keluar = '$tanggal_keluar', id_material = '$material', jumlah_material = '$jumlah_material', id_unit = '$unit', lokasi_keluar = '$lokasi', id_user = '$user' WHERE id_keluar = '$id'") or die (mysqli_error($con));
			if ($sql_edit) {
				mysqli_query($con, "UPDATE tb_material SET jumlah_material=jumlah_material - '$jumlah_material' where id_material='$material'") or die (mysqli_error($con));
			}
		}
		}
		echo "<script>alert('Data Berhasil Diubah'); window.location='data_keluar.php';</script>";
}

?>
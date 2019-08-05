<?php
	include_once('../../../_header.php');
	$id = $_GET['id'];
	$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab, tb_lokasi where tb_rab.lokasi_rab = tb_lokasi.id_lokasi and id_rab = '$id'") or die (mysqli_error($con));
	$data_rab = mysqli_fetch_assoc($sql_rab);
	$namarab = $data_rab['nama_rab'];
	$lokasirab = $data_rab['nama_lokasi'];
	$id_lokasi =  $data_rab['id_lokasi'];

	$sql_material = mysqli_query($con, "SELECT * FROM tb_material where lokasi_material = '$id_lokasi'") or die (mysqli_error($con));
	$rows = mysqli_num_rows($sql_material);
	if ($rows == 0){
		echo "<script>alert('Tidak Ada Data Material di $lokasirab, Silahkan masukkan Data material dulu'); window.location='../data.php';</script>";
	}
?>

<div class="box">
		<h1>Unit</h1>
		<h4>
			<small>Tambah Data RAB Unit</small>
			<div class="pull-right">
				<a href="../data.php" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-chevron-left"> Kembali</i></a>
			</div>
			</h4>
			<p>Nama RAB : <?=$namarab?></p><p>Lokasi : <?=$lokasirab?></p>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form action="proses.php" method="post">
					<input type="hidden" name="total" value="<?=$rows?>">
					<table class="table">
						<tr>
							<th>Nama Material</th>
							<th>RAB unit</th>
						</tr>
						<?php for ($i=0; $i <= $rows ; $i++) { 
								while ($data_material = mysqli_fetch_array($sql_material)) { ?> 
							<tr>
								<td><?php $i++; ?>
									<input type="hidden" name="id_rab-<?=$i?>" value="<?=$id?>">
									<input type="hidden" name="id_material-<?=$i?>" value="<?=$data_material['id_material']?>">
									<label><?=$data_material['nama_material']?></label>
								</td>
								<td>
									<input type="text" name="rab_unit-<?=$i?>" placeholder="masukkan jumlah RAB unit" class="form-control" required autofocus>
								</td>
							</tr>
						<?php	
						} 
					}
						?>
					</table>
					<div class="form-group pull-right">
						<input type="submit" name="add" value="Simpan Semua" class="btn btn-success">

					</div>
				</form>
			</div>
		</div>
</div>

<?php
	include_once('../../../_footer.php');
?>
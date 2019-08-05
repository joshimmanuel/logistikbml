<?php

	$chk = @$_POST['checked'];
	if (!isset($chk)) {
		echo "<script>alert('Tidak Ada Data Yang Dipilih!'); window.location='data_keluar.php';</script>";
	} else {

	include_once('../_header.php');
?>

<div class="box">
		<h1>Laporan</h1>
		<h4>
			<small>Lapor Data Material keluar</small>
			<div class="pull-right">
				<a href="data_keluar.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
			</div>
		</h4>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<form action="proses.php" method="post">
					<input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
					<table class="table">
						<tr>
							<th>tanggal</th>
							<th>Nama Material</th>
							<th>Jumlah Material</th>
							<th>Nama Unit</th>
						</tr>
						<?php
						foreach ($chk as $id ) {
							$sql_keluar = mysqli_query($con, "SELECT *, tb_keluar.jumlah_material as jumlah FROM tb_keluar, tb_material, tb_unit WHERE tb_material.id_material = tb_keluar.id_material and tb_keluar.id_unit = tb_unit.id_unit and id_keluar= '$id'") or die (mysqli_error($con));
							while($data = mysqli_fetch_array($sql_keluar)){
								$lokasi_keluar = $data['lokasi_keluar'];
						?> 
							<tr>
								<td><input type="date" name="tanggal[]" class="form-control" value="<?=$data['tanggal_keluar']?>"></td>
								<td>
									<input type="hidden" name="id[]" value="<?=$data['id_keluar']?>">
									<select name="material[]" class="form-control" required>
										<option value="">Pilih Material</option>
										<?php
										$sql_material = mysqli_query($con, "SELECT * FROM tb_material") or die (mysqli_error($con));
										while ($data_material = mysqli_fetch_array($sql_material)) { ?>
											<option value="<?=$data_material['id_material']?>"
												<?php
												if ($data['id_material'] == $data_material['id_material'])
												{

													echo "selected";
												}
												?>
												><?=$data_material['nama_material']?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<input type="hidden" name="user[]" value="<?=$id_user?>">
									<input type="hidden" name="jumlah_awal[]" value="<?=$data['jumlah']?>">
									<input type="text" name="jumlah[]" value="<?=$data['jumlah']?>" class="form-control" required autofocus>
								</td>
								<td>
									<select name="unit[]" class="form-control" required>
										<option value="">Pilih Unit</option>
										<?php
										$sql_unit = mysqli_query($con, "SELECT * FROM `tb_unit` where lokasi_unit = '$lokasi_keluar'") or die (mysqli_error($con));
										while ($data_unit = mysqli_fetch_array($sql_unit)) { ?>
											<option value="<?=$data_unit['id_unit']?>"
												<?php
												if ($data['id_unit'] == $data_unit['id_unit'])
												{

													echo "selected";
												}
												?>
												><?=$data_unit['nama_unit']?></option>
										<?php }
										?>
									</select>
									<input type="hidden" name="lokasi[]" value="<?=$data['lokasi_keluar']?>">
								</td>
							</tr>
						<?php
							}	
						}
						?>
					</table>
					<div class="form-group pull-right">
						<input type="submit" name="edit_keluar" value="Simpan" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
</div>

<?php
	include_once('../_footer.php');

} ?>

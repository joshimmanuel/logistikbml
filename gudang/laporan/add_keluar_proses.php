<?php

	$chk = @$_POST['checked'];
	if (!isset($chk)) {
		echo "<script>alert('Tidak Ada Data Yang Dipilih!'); window.location='add_keluar.php';</script>";
	} else {

	include_once('../_header.php');
?>

<div class="box">
		<h1>Laporan</h1>
		<h4>
			<small>Lapor Data Material Keluar</small>
			<div class="pull-right">
				<a href="add_masuk.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
			</div>
		</h4>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form action="proses.php" method="post">
					<input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
					<table class="table">
						<tr>
							<th>#</th>
							<th>Nama Material</th>
							<th>Jumlah Material</th>
							<th>Nama Unit</th>
						</tr>
						<?php
						$no = 1;
						foreach ($chk as $id ) {
							$sql_material = mysqli_query($con, "SELECT * FROM tb_material WHERE id_material= '$id'") or die (mysqli_error($con));
							while($data = mysqli_fetch_array($sql_material)){
						?> 
							<tr>
								<td><?=$no++?></td>
								<td>
									<input type="hidden" name="id[]" value="<?=$data['id_material']?>">
									<p><b><?=$data['nama_material']?></b></p>
								</td>
								<td>
									<input type="hidden" name="user[]" value="<?=$id_user?>">
									<input type="text" name="jumlah[]" class="form-control" required autofocus>
								</td>
								<td>
									<select name="unit[]" class="form-control" required>
										<option value="">Pilih Unit</option>
										<?php
										$sql_unit = mysqli_query($con, "SELECT * FROM tb_unit where lokasi_unit = '$lokasi'") or die (mysqli_error($con));
										while ($data_unit = mysqli_fetch_array($sql_unit)) {
											echo '<option value="'.$data_unit['id_unit'].'">'.$data_unit['nama_unit'].'</option>';
										}
										?>
									</select>
									<input type="hidden" name="lokasi[]" value="<?=$lokasi?>">
								</td>
							</tr>
						<?php
							}	
						}
						?>
					</table>
					<div class="form-group pull-right">
						<input type="submit" name="keluarkan" value="Simpan" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
</div>

<?php
	include_once('../_footer.php');

} ?>
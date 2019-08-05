<?php

	$chk = @$_POST['checked'];
	if (!isset($chk)) {
		echo "<script>alert('Tidak Ada Data Yang Dipilih!'); window.location='data.php';</script>";
	} else {

	include_once('../_header.php');
?>

<div class="box">
		<h1>Unit</h1>
		<h4>
			<small>Edit Data Unit</small>
			<div class="pull-right">
				<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i>Kembali</a>
			</div>
		</h4>
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form action="proses.php" method="post">
					<input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
					<table class="table">
						<tr>
							<th>#</th>
							<th>Nama Unit</th>
							<th>Subkon</th>
							<th>Lokasi Unit</th>
						</tr>
						<?php
						$no = 1;
						foreach ($chk as $id ) {
							$sql_unit = mysqli_query($con, "SELECT * FROM tb_unit WHERE id_unit= '$id'") or die (mysqli_error($con));
							while($data = mysqli_fetch_array($sql_unit)){
						?> 
							<tr>
								<td><?=$no++?></td>
								<td>
									<input type="hidden" name="id[]" value="<?=$data['id_unit']?>">
									<input type="text" name="nama[]" value="<?=$data['nama_unit']?>" class="form-control" required>
								</td>
								<td>
									<input type="text" name="subkon[]" value="<?=$data['subkon_unit']?>" class="form-control" required>
								</td>
								<td>
									<select name="lokasi[]" class="form-control" required>
										<option value="">Pilih Lokasi</option>
										<?php
										$sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi") or die (mysqli_error($con));
										while ($data_lokasi = mysqli_fetch_array($sql_lokasi)) { ?>
											<option value="<?=$data_lokasi['id_lokasi']?>"

											<?php
											if ($data['lokasi_unit'] == $data_lokasi['id_lokasi'])
												{
													echo " selected";
												}
											?>

											><?=$data_lokasi['nama_lokasi']?></option>';
										<?php
									}
										?>
									</select>
								</td>
							</tr>
						<?php
							}	
						}
						?>
					</table>
					<div class="form-group pull-right">
						<input type="submit" name="edit" value="Simpan Semua" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
</div>

<?php
	include_once('../_footer.php');

} ?>

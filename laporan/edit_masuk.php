<?php

	$chk = @$_POST['checked'];
	if (!isset($chk)) {
		echo "<script>alert('Tidak Ada Data Yang Dipilih!'); window.location='data_masuk.php';</script>";
	} else {

	include_once('../_header.php');
?>

<div class="box">
		<h1>Laporan</h1>
		<h4>
			<small>Lapor Data Material Masuk</small>
			<div class="pull-right">
				<a href="data_masuk.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
			</div>
		</h4>
		<div class="row">
			<div class="col-lg-11 col-lg-offset-1">
				<form action="proses.php" method="post">
					<input type="hidden" name="total" value="<?=@$_POST['count_add']?>">
					<table class="table">
						<tr>
							<th>tanggal</th>
							<th>Nama Material</th>
							<th>Jumlah Material</th>
							<th>Nama Supplier</th>
							<th>Lokasi Masuk</th>
						</tr>
						<?php
						$no = 1;
						foreach ($chk as $id ) {
							$sql_masuk = mysqli_query($con, "SELECT *, tb_masuk.jumlah_material as jumlah FROM tb_masuk, tb_material, tb_supplier WHERE tb_material.id_material = tb_masuk.id_material and tb_masuk.id_supplier = tb_supplier.id_supplier and id_masuk= '$id'") or die (mysqli_error($con));
							while($data = mysqli_fetch_array($sql_masuk)){
						?> 
							<tr>
								<td><input type="date" name="tanggal[]" class="form-control" value="<?=$data['tanggal_masuk']?>"></td>
								<td>
									<input type="hidden" name="id[]" value="<?=$data['id_masuk']?>">
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
									<select name="supplier[]" class="form-control" required>
										<option value="">Pilih Supplier</option>
										<?php
										$sql_supplier = mysqli_query($con, "SELECT * FROM tb_supplier") or die (mysqli_error($con));
										while ($data_supplier = mysqli_fetch_array($sql_supplier)) { ?>
											<option value="<?=$data_supplier['id_supplier']?>"
												<?php
												if ($data['id_supplier'] == $data_supplier['id_supplier'])
												{

													echo "selected";
												}
												?>
												><?=$data_supplier['nama_supplier']?></option>
										<?php }
										?>
									</select>
								</td>
								<td>
									<select name="lokasi[]" class="form-control" required>
										<option value="">Pilih Lokasi</option>
										<?php
										$sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi") or die (mysqli_error($con));
										while ($data_lokasi = mysqli_fetch_array($sql_lokasi)) { ?>
											<option value="<?=$data_lokasi['id_lokasi']?>"

											<?php
											if ($data['lokasi_masuk'] == $data_lokasi['id_lokasi'])
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
						<input type="submit" name="edit_masuk" value="Simpan" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
</div>

<?php
	include_once('../_footer.php');

} ?>

<?php
	include_once('../_header.php');
?>

<div class="box">
		<h1>Unit</h1>
		<h4>
			<small>Tambah Data Unit</small>
			<div class="pull-right">
				<a href="data.php" class="btn btn-info btn-xs">Data</a>
				<a href="generate.php" class="btn btn-primary btn-xs">Tambah Data Lagi</a>
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
							<th>RAB</th>
						</tr>
						<?php
						for ($i=1; $i<=$_POST['count_add'] ; $i++) { ?> 
							<tr>
								<td><?=$i ?></td>
								<td>
									<input type="text" name="nama-<?=$i?>" class="form-control" required>
								</td>
								<td>
									<input type="text" name="subkon-<?=$i?>" class="form-control" required>
								</td>
								<td>
									 <select name="lokasi-<?=$i?>" class="form-control" required>
                                        <option value="">Pilih Lokasi</option>
                                        <?php
                                        $sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi") or die (mysqli_error($con));
                                        while ($data_lokasi = mysqli_fetch_array($sql_lokasi)) {
                                            echo '<option value="'.$data_lokasi['id_lokasi'].'">'.$data_lokasi['nama_lokasi'].'</option>';
                                        }
                                        ?>
                       			 </select>
								</td>
								<td>
								 <select name="rab-<?=$i?>" class="form-control" required>
                                        <option value="">Pilih Rab</option>
                                        <?php
                                        $sql_rab = mysqli_query($con, "SELECT distinct nama_rab FROM tb_rab") or die (mysqli_error($con));
                                        while ($data_rab = mysqli_fetch_array($sql_rab)) {
                                            echo '<option value="'.$data_rab['nama_rab'].'">'.$data_rab['nama_rab'].'</option>';
                                        }
                                        ?>
                        </select>
                    </td>
							</tr>
						<?php	
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
	include_once('../_footer.php');
?>
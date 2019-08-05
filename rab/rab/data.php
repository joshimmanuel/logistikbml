<?php
	include_once('../../_header.php');
?>

	<div class="box">
		<h1>RAB</h1>
		<h4>
			<small>Data RAB</small>
			<div class="pull-right">
				<a href="data.php" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="<?=base_url('rab/lokasi/data.php')?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pushpin"></i> Data Lokasi</a>
			</div>
		</h4>
		<?php
		if (@$_GET['id'] > 0) {
			$btnname = 'edit';
			$btnclass = 'warning';
			$btnvalue = 'Simpan';
			$id = $_GET['id'];
			$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab where id_rab = '$id'") or die (mysqli_error($con));
			$data_rab = mysqli_fetch_assoc($sql_rab);
			$nama_rab = $data_rab['nama_rab'];
			$id_rab = $id;
		} else {
			$btnname = 'add';
			$btnclass = 'success';
			$btnvalue = 'Tambah';
		}
		?>
		 <div class="row">
            <div class="pull-left" style="margin-left: 1.5%">
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <label for="nama">Nama RAB</label>
                        <input type="hidden" name="id" value="<?=@$id?>">
                        <input type="text" name="nama" class="form-control" value="<?=@$nama_rab?>" placeholder="masukkan nama RAB" required autofocus>
                    	<label for="lokasi">Lokasi Rab</label>
                    	<select name="lokasi" class="form-control" required>
                                        <option value="">Pilih Lokasi</option>
                                        <?php
                                        $sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi") or die (mysqli_error($con));
                                       while ($data_lokasi = mysqli_fetch_array($sql_lokasi)) { ?>
											<option value="<?=$data_lokasi['id_lokasi']?>"

											<?php
											if (@$data_rab['lokasi_rab'] == $data_lokasi['id_lokasi'])
												{
													echo " selected";
												}
											?>

											><?=$data_lokasi['nama_lokasi']?></option>';
										<?php
									}
										?>
                        </select>
                    </div>
                    <div class="form-group pull-left">
                        <input type="submit" name="<?=$btnname?>" value="<?=$btnvalue?>" class="btn btn-<?=$btnclass?>">
                    </div>
                </form>
            </div>
        </div>
		<form method="post" name="proses">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="material">
				<thead>
					<tr style="background-color: #90EE90">
						<th>Nama RAB</th>
						<th>Lokasi RAB</th>
						<th><i class="glyphicon glyphicon-cog"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab, tb_lokasi where tb_rab.lokasi_rab = tb_lokasi.id_lokasi") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_rab)) { ?>
					<tr>
						<td><?=$data['nama_rab']?></td>
						<td><?=$data['nama_lokasi']?></td>
						<td align="center">
							<a href="rab_unit/validasi_data.php?id=<?=$data['id_rab']?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-info-sign"></i></a>
							<a href="data.php?id=<?=$data['id_rab']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
						</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</form>
</div>
<script>
		$(document).ready(function() {

			$('#material').DataTable({
				dom : 'Bfrtip',
				buttons : [
					'pdf', 'excel', 'print', 'copy'
				],
				columnDefs: [
					{
						searchable: false,
						orderable: false,
						targets: [0,2]
					}
				],
				order: [0, "asc"]
			});

			$('#select_all').on('click', function() {
				if (this.checked) {
					$('.check').each(function() {
						this.checked = true;
					})
				} else {
					$('.check').each(function() {
						this.checked = false;
					})
				}
			});
			$('.check').on('click', function() {
				if($('.check:checked').length == $('.check').length) {
					$('#select_all').prop('checked', true)
				} else {
					$('#select_all').prop('checked', false)	
				}
			})
		})

	</script>
	
<?php
	include_once('../../_footer.php');
?>

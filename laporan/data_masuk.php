<?php
	include_once('../_header.php');
?>
<div class="row">
	<div class="col-lg-12">
		<h1>Laporan</h1>
		<a href="data_masuk.php" class="btn btn-primary" id="material_masuk">Material Masuk</a>
		<a href="data_keluar.php" class="btn btn-default" id="material_keluar">Material Keluar</a>
	</div>
	<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a> 	
				<a href="add_masuk.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Barang Masuk</a>
</div>
</div>
<br>
			<form method="post" name="proses">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="laporan">
				<thead>
					<tr style="background-color: #90EE90">
						<th>
							<center>
								<input type="checkbox" id="select_all" value="">
							</center>
						</th>
						<th>Tanggal Masuk</th>
						<th>Nama material</th>
						<th>Jumlah material</th>
						<th>Nama Supplier</th>
						<th>Nama Penerima</th>
						<th>Lokasi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql_material = mysqli_query($con, "SELECT *, tb_masuk.jumlah_material as jumlah_masuk FROM tb_masuk, tb_supplier, tb_material, tb_user, tb_lokasi WHERE tb_masuk.id_material=tb_material.id_material and tb_masuk.id_user = tb_user.id_user and tb_supplier.id_supplier = tb_masuk.id_supplier and tb_masuk.lokasi_masuk = tb_lokasi.id_lokasi ORDER BY tb_masuk.tanggal_masuk DESC") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_material)) { ?>
					<tr>
						<td align="center">
							<input type="checkbox" name="checked[]" class="check" value="<?=$data['id_masuk']?>">
						</td>
						<td><?=$data['tanggal_masuk']?></td>
						<td><?=$data['nama_material']?></td>
						<td><?=$data['jumlah_masuk']?> <?=$data['satuan_material']?></td>
						<td><?=$data['nama_supplier']?></td>
						<td><?=$data['nama_user']?></td>
						<td><?=$data['nama_lokasi']?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</form>

	<div class="box pull-right">
		<button class="btn btn-warning btn-sm" onclick="edit()"><i class="glyphicon glyphicon-edit"></i> Edit</button>
	</div>

		<script>
			$(document).ready( function () {
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
    		$('#laporan').DataTable({
    			dom : 'Bfrtip',
				buttons : [
						'pdf', 'excel', 'print', 'copy'
						],
				columnDefs: [
					{
						searchable: false,
						orderable: false,
						targets: [0]
					}
				],
						order: [1, "desc"]
					});
			});

			function edit() {
			document.proses.action = "edit_masuk.php";	
			document.proses.submit();
		}

		</script>
<?php
	include_once('../_footer.php');
?>
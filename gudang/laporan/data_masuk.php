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
	<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="laporan">
				<thead>
					<tr style="background-color: #90EE90">
						<th>Tanggal Masuk</th>
						<th>Nama material</th>
						<th>Jumlah material</th>
						<th>Nama Supplier</th>
						<th>Nama Penerima</th>
						</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql_material = mysqli_query($con, "SELECT *, tb_masuk.jumlah_material as jumlah_masuk FROM tb_masuk, tb_supplier, tb_material, tb_user WHERE tb_masuk.id_material=tb_material.id_material and tb_masuk.id_user = tb_user.id_user and tb_supplier.id_supplier = tb_masuk.id_supplier and tb_masuk.lokasi_masuk = '$lokasi' ORDER BY tb_masuk.tanggal_masuk DESC") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_material)) { ?>
					<tr>
						<td><?=$data['tanggal_masuk']?></td>
						<td><?=$data['nama_material']?></td>
						<td><?=$data['jumlah_masuk']?> <?=$data['satuan_material']?></td>
						<td><?=$data['nama_supplier']?></td>
						<td><?=$data['nama_user']?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
		<script>
			$(document).ready( function () {
    		$('#laporan').DataTable({
    			dom : 'Bfrtip',
				buttons : [
						'pdf', 'excel', 'print', 'copy'
						],
						order: [0, "desc"]
					});
			});
		</script>
<?php
	include_once('../_footer.php');
?>
<?php
	include_once('../_header.php');
?>
<div class="row">
	<div class="col-lg-12">
		<h1>Laporan</h1>
		<a href="data_masuk.php" class="btn btn-default" id="material_masuk">Material Masuk</a>
		<a href="data_keluar.php" class="btn btn-primary" id="material_keluar">Material Keluar</a>
	</div>
	<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="add_keluar.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Material Keluar</a>
</div>
</div>
<br>
	<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="laporan">
				<thead>
					<tr style="background-color: #90EE90">
						<th>Tanggal Keluar</th>
						<th>Nama Material</th>
						<th>Jumlah Material</th>
						<th>Nama Unit</th>
						<th>Nama Pengijin</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql_material = mysqli_query($con, "SELECT *, tb_keluar.jumlah_material as jumlah_keluar FROM tb_keluar, tb_material, tb_user, tb_unit WHERE tb_keluar.id_material=tb_material.id_material and tb_unit.id_unit = tb_keluar.id_unit and tb_keluar.id_user = tb_user.id_user and tb_keluar.lokasi_keluar = '$lokasi' ORDER BY tb_keluar.tanggal_keluar DESC") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_material)) { ?>
					<tr>
						<td><?=$data['tanggal_keluar']?></td>
						<td><?=$data['nama_material']?></td>
						<td><?=$data['jumlah_keluar']?> <?=$data['satuan_material']?></td>
						<td><?=$data['nama_unit']?></td>
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
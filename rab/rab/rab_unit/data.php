<?php
	include_once('../../../_header.php');
?>
	<?php
		$id_rab = $_GET['id'];
		$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab, tb_lokasi where tb_rab.lokasi_rab = tb_lokasi.id_lokasi and id_rab = '$id_rab'") or die (mysqli_error($con));
		$data_rab = mysqli_fetch_assoc($sql_rab);
		$namarab = $data_rab['nama_rab'];
		$lokasirab = $data_rab['nama_lokasi'];
		?>
	<div class="box">
		<h1>RAB</h1>
		<h4>
			<a href="data.php?id=<?=$id_rab?>" class="btn btn-primary" id="material_masuk">RAB Unit</a>
			<a href="data_cek_rab.php?id=<?=$id_rab?>" class="btn btn-default" id="material_keluar">Cek RAB</a>
			<div class="pull-right">
				<a href="data.php" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="../data.php" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
				<a href="add_sisa.php?id=<?=$id_rab?>" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah RAB Unit</a>
				<a href="edit.php?id=<?=$id_rab?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit RAB Unit</a>
			</div>
		</h4>

            </div>
		<form method="post" name="proses">
		<input type="hidden" name="id_rab" value="<?=$id_rab?>">
		<p>Nama RAB : <?=$namarab?></p><p>Lokasi : <?=$lokasirab?></p>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="material">
				<thead>
					<tr style="background-color: #90EE90">
						<th>Nama Material</th>
						<th>RAB Unit</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql_rab_unit = mysqli_query($con, "SELECT * FROM tb_material left join tb_rab_unit on tb_material.id_material = tb_rab_unit.id_material join tb_rab on tb_rab_unit.id_rab = tb_rab.id_rab where tb_rab_unit.id_rab = '$id_rab'") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_rab_unit)) { ?>
					<tr>
						<td><?=$data['nama_material']?></td>
						<td><?=$data['rab_unit']?></td>
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
						targets: [1	]
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
	include_once('../../../_footer.php');
?>

<?php
	include_once('../_header.php');

		$id_rab = $_GET['id'];
		$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab, tb_lokasi where tb_rab.lokasi_rab = tb_lokasi.id_lokasi and id_rab = '$id_rab'") or die (mysqli_error($con));
		$data_rab = mysqli_fetch_assoc($sql_rab);
		$namarab = $data_rab['nama_rab'];
		$lokasirab = $data_rab['nama_lokasi'];
		$sql_jmlh_unit = mysqli_query($con, "SELECT * from tb_unit where rab_unit = '$id_rab'") or die (mysql_error($con));
		$jmlh_unit = mysqli_num_rows($sql_jmlh_unit);
		?>
	<div class="box">
		<h1>RAB</h1>
		<h4>
			<a href="data_rab_unit.php?id=<?=$id_rab?>" class="btn btn-default" id="material_masuk">RAB Unit</a>
			<a href="data_cek_rab.php?id=<?=$id_rab?>" class="btn btn-primary" id="material_keluar">Cek RAB</a>
			<div class="pull-right">
				<a href="data_cek_rab.php" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
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
						<th>RAB per Unit</th>
						<th>Jumlah Unit</th>
						<th>RAB Total</th>
						<th>Material di Lokasi</th>
						<th>Sisa Material</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql_rab_unit = mysqli_query($con, "SELECT tb_material.nama_material, tb_rab_unit.rab_unit as rab_per_unit, (SELECT count(*) from tb_unit where rab_unit = '$id_rab' ) as jumlah_unit, tb_rab_unit.rab_unit*$jmlh_unit as rab_total, tb_material.jumlah_material+SUM(IF(tb_unit.rab_unit = '$id_rab', tb_keluar.jumlah_material, 0)) as jumlah_material_di_lokasi, tb_rab_unit.rab_unit*$jmlh_unit-tb_material.jumlah_material as sisa from tb_material join tb_rab_unit on tb_rab_unit.id_material = tb_material.id_material join tb_lokasi on tb_lokasi.id_lokasi = tb_material.lokasi_material left join tb_keluar on tb_keluar.id_material = tb_material.id_material left join tb_unit on tb_keluar.id_unit = tb_unit.id_unit join tb_rab on tb_rab.id_rab = tb_rab_unit.id_rab where tb_rab.id_rab = '$id_rab' group by tb_material.id_material") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_rab_unit)) { ?>
					<tr>
						<td><?=$data['nama_material']?></td>
						<td><?=$data['rab_per_unit']?></td>
						<td><?=$data['jumlah_unit']?></td>
						<td><?=$data['rab_total']?></td>
						<td><?=$data['jumlah_material_di_lokasi']?></td>
						<td><?=$data['sisa']?></td>
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
						targets: [2]
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
	include_once('../_footer.php');
?>

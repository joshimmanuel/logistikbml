<?php
	include_once('../_header.php');
?>
	<?php
		$id_unit = $_GET['id'];
		$sql_unit = mysqli_query($con, "SELECT * FROM tb_rab, tb_lokasi, tb_unit where tb_unit.rab_unit = tb_rab.id_rab and tb_rab.lokasi_rab = tb_lokasi.id_lokasi and id_unit = '$id_unit'") or die (mysqli_error($con));
		$data_unit = mysqli_fetch_assoc($sql_unit);
		$namaunit = $data_unit['nama_unit'];
		$namarab = $data_unit['nama_rab'];
		$lokasiunit = $data_unit['nama_lokasi'];
		$subkon = $data_unit['subkon_unit'];
		?>
	<div class="box">
		<h1>RAB UNIT</h1>
		<h4>
			<div class="pull-right">
				<a href="data.php" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
			</div>
		</h4>

            </div>
		<form method="post" name="proses">
		<input type="hidden" name="id_rab" value="<?=$id_rab?>">
		<p>Nama unit : <?=$namaunit?></p><p>Subkon : <?=$subkon?></p><p>Nama rab : <?=$namarab?></p><p>Lokasi : <?=$lokasiunit?></p>
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
				$sql_rab_unit = mysqli_query($con, "SELECT *, tb_rab_unit.rab_unit as rab_u, sum(tb_keluar.jumlah_material) as jumlah_keluar FROM tb_material left join tb_rab_unit on tb_material.id_material = tb_rab_unit.id_material join tb_rab on tb_rab_unit.id_rab = tb_rab.id_rab join tb_unit on tb_unit.rab_unit = tb_rab.id_rab left join tb_keluar on tb_keluar.id_material = tb_material.id_material and tb_keluar.id_unit = tb_unit.id_unit where tb_unit.id_unit = '$id_unit' group by tb_material.id_material") or die(mysqli_error($con));

				while($data = mysqli_fetch_array($sql_rab_unit)) { ?>
					<tr class="<?php if ($data['jumlah_keluar'] == $data['rab_u']){echo "success";}?>
							<?php if ($data['jumlah_keluar'] > $data['rab_u']){echo "danger";}?>
							<?php if ($data['jumlah_keluar'] < $data['rab_u']){echo "warning";}?>">
						<td><?=$data['nama_material']?></td>
						<td><?=$data['jumlah_keluar']?>/<?=$data['rab_u']?> <?=$data['satuan_material']?></td>
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
	include_once('../_footer.php');
?>

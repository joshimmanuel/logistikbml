<?php
	include_once('../_header.php');
?>

	<div class="box">
		<h1>Material</h1>
		<h4>
			<small>Data Material</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Material</a>
			</div>
		</h4>
		<form method="post" name="proses">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="material">
				<thead>
					<tr style="background-color: #90EE90">
						<th>Nama Material</th>
						<th>Jumlah Material</th>
						<th>Lokasi Material</th>
						<th><i class="glyphicon glyphicon-cog"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql_material = mysqli_query($con, "SELECT * FROM tb_material, tb_lokasi where tb_material.lokasi_material = tb_lokasi.id_lokasi") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_material)) { ?>
					<tr>
						<td><?=$data['nama_material']?></td>
						<td><?=$data['jumlah_material']?> <?=$data['satuan_material']?></td>
						<td><?=$data['nama_lokasi']?></td>
						<td align="center">
							<a href="edit.php?id=<?=$data['id_material']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
						targets: [2,3]
					}
				],
				order: [1, "asc"]
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

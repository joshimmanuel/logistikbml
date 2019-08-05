<?php
	include_once('../_header.php');
?>

	<div class="box">
		<h1>RAB</h1>
		<h4>
			<small>Data RAB</small>
			<div class="pull-right">
				<a href="data.php" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			</div>
		</h4>
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
				$sql_rab = mysqli_query($con, "SELECT * FROM tb_rab, tb_lokasi where tb_rab.lokasi_rab = tb_lokasi.id_lokasi and lokasi_rab = '$lokasi'") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_rab)) { ?>
					<tr>
						<td><?=$data['nama_rab']?></td>
						<td><?=$data['nama_lokasi']?></td>
						<td align="center">
							<a href="data_rab_unit.php?id=<?=$data['id_rab']?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-info-sign"></i></a>
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
	include_once('../_footer.php');
?>

<?php
	include_once('../_header.php');
?>

	<div class="box">
		<h1>Material</h1>
		<h4>
			<small>Data Material</small>
		</h4>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="material">
				<thead>
					<tr>
						<th>Nama material</th>
						<th>Jumlah material</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql_material = mysqli_query($con, "SELECT * FROM tb_material where lokasi_material = '$lokasi'") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_material)) { ?>
					<tr>
						<td><?=$data['nama_material']?></td>
						<td><?=$data['jumlah_material']?> <?=$data['satuan_material']?></td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
<script>
	$(document).ready( function () {
    $('#material').DataTable();
	});
	</script>
	
<?php
	include_once('../_footer.php');
?>

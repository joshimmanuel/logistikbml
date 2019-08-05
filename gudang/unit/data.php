<?php
	include_once('../_header.php');
?>

	<div class="box">
		<h1>Unit</h1>
		<h4>
			<small>Data Unit</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			</div>
		</h4>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="unit">
				<thead>
					<tr>
						<th>Nama Unit</th>
						<th>Subkon</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql_unit = mysqli_query($con, "SELECT * FROM tb_unit WHERE lokasi_unit LIKE '%$lokasi%'") or die(mysqli_error($con));
				if(mysqli_num_rows($sql_unit) > 0) { 
					while($data = mysqli_fetch_array($sql_unit)) { ?>
					<tr>
						<td><a href="data_unit.php?id=<?=$data['id_unit']?>"><?=$data['nama_unit']?></a></td>
						<td><?=$data['subkon_unit']?></td>
					</tr>
				<?php
				}
				} else {
					echo "<tr><td colspan=\"4\" align=\"center\">Data Tidak Ditemukan</td></tr>";
				}
				?>
				</tbody>
			</table>
		</div>


	</div>
	<script>
		$(document).ready(function() {
   			 $('#unit').DataTable();
			});

	</script>
<?php
	include_once('../_footer.php');
?>
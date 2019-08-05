<?php
	include_once('../_header.php');
?>

	<div class="box">
		<h1>Unit</h1>
		<h4>
			<small>Data Unit</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="generate.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Unit</a>
			</div>
		</h4>
		<form method="post" name="proses">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="unit">
				<thead>
					<tr style="background-color: #90EE90">
						<th>Nama Unit</th>
						<th>Subkon</th>
						<th>Lokasi Unit</th>
						<th>RAB</th>
						<th>
							<center>
								<input type="checkbox" id="select_all" value="">
							</center>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql_unit = mysqli_query($con, "SELECT * FROM tb_unit, tb_lokasi, tb_rab where tb_unit.lokasi_unit = tb_lokasi.id_lokasi and tb_unit.rab_unit = tb_rab.id_rab") or die(mysqli_error($con));
				if(mysqli_num_rows($sql_unit) > 0) { 
					while($data = mysqli_fetch_array($sql_unit)) { ?>
					<tr>
						<td><a href="data_unit.php?id=<?=$data['id_unit']?>"><?=$data['nama_unit']?></a></td>
						<td><?=$data['subkon_unit']?></td>
						<td><?=$data['nama_lokasi']?></td>
						<td><?=$data['nama_rab']?></td>
						<td align="center">
							<input type="checkbox" name="checked[]" class="check" value="<?=$data['id_unit']?>">
						</td>
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
	</form>

	<div class="box pull-right">
		<button class="btn btn-warning btn-sm" onclick="edit()"><i class="glyphicon glyphicon-edit"></i> Edit</button>
		<button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
	</div>

	</div>
	<script>
		$(document).ready(function() {
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

			$('#unit').DataTable({
				dom : 'Bfrtip',
				buttons : [
					'pdf', 'excel', 'print', 'copy'
				],
				columnDefs: [
					{
						searchable: false,
						orderable: false,
						targets: [4]
					}
				],
				order: [0, "asc"]
			});
		})
		function edit() {
			document.proses.action = "edit.php";	
			document.proses.submit();
		}
		
		function hapus() {
			var conf = confirm('Yakin akan hapus data?');
			if(conf){
				document.proses.action = "del.php";	
				document.proses.submit();
			}
		}

	</script>
<?php
	include_once('../_footer.php');
?>
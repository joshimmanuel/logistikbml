<?php
	include_once('../_header.php');
?>

	<div class="box">
		<h1>Supplier</h1>
		<h4>
			<small>Data Supplier</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Supplier</a>
			</div>
		</h4>
		<form method="post" name="proses">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="supplier">
				<thead>
					<tr style="background-color: #90EE90">
						<th>
							<center>
								<input type="checkbox" id="select_all" value="">
							</center>
						</th>
						<th>No.</th>
						<th>Nama Supplier</th>
						<th>No Telp Supplier</th>
						<th>Alamat</th>
						<th><i class="glyphicon glyphicon-cog"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$sql_supplier = mysqli_query($con, "SELECT * FROM tb_supplier") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_supplier)) { ?>
					<tr>
						<td align="center">
							<input type="checkbox" name="checked[]" class="check" value="<?=$data['id_supplier']?>">
						</td>
						<td><?=$no++;?>.</td>
						<td><?=$data['nama_supplier']?></td>
						<td><?=$data['no_telp_supplier']?></td>
						<td><?=$data['alamat_supplier']?></td>
						<td align="center">
							<a href="edit.php?id=<?=$data['id_supplier']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
						</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</form>
	<div class="box pull-right">
		<button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
	</div>
</div>
<script>
		$(document).ready(function() {

			$('#supplier').DataTable({
				dom : 'Bfrtip',
				buttons : [
					'pdf', 'excel', 'print', 'copy'
				],
				columnDefs: [
					{
						searchable: false,
						orderable: false,
						targets: [0,5]
					}
				],
				order: [2, "asc"]
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
<?php
	include_once('../_header.php');
?>

	<div class="box">
		<h1>User</h1>
		<h4>
			<small>Data User</small>
			<div class="pull-right">
				<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="index.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
				<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah User</a>
			</div>
		</h4>
		<form method="post" name="proses">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="user">
				<thead>
					<tr style="background-color: #90EE90">
						<th>Nama User</th>
						<th>Username</th>
						<th>Password</th>
						<th>Tipe User</th>
						<th>Lokasi User</th>
						<th><i class="glyphicon glyphicon-cog"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql_user = mysqli_query($con, "SELECT * FROM tb_user, tb_lokasi where tb_user.lokasi_user = tb_lokasi.id_lokasi") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_user)) { ?>
					<tr>
						<td><?=$data['nama_user']?></td>
						<td><?=$data['username']?></td>
						<td> <?=$data['password']?></td>
						<td><?=$data['level']?></td>
						<td><?=$data['nama_lokasi']?></td>
						<td align="center">
							<a href="edit.php?id=<?=$data['id_user']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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

			$('#user').DataTable({
				dom : 'Bfrtip',
				buttons : [
					'pdf', 'excel', 'print', 'copy'
				],
				columnDefs: [
					{
						searchable: false,
						orderable: false,
						targets: [3,4,5]
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

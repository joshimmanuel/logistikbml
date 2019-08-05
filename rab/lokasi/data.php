<?php
	include_once('../../_header.php');
?>

	<div class="box">
		<h1>RAB</h1>
		<h4>
			<small>Data Lokasi</small>
			<div class="pull-right">
				<a href="data.php" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="<?=base_url('rab/rab/data.php')?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-info-sign"></i> Data RAB</a>
			</div>
		</h4>
		<?php
		if (@$_GET['id'] > 0) {
			$btnname = 'edit';
			$btnclass = 'warning';
			$btnvalue = 'Simpan';
			$id = $_GET['id'];
			$sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi where id_lokasi = '$id'") or die (mysqli_error($con));
			$data_lokasi = mysqli_fetch_assoc($sql_lokasi);
			$nama_lokasi = $data_lokasi['nama_lokasi'];
			$id_lokasi = $id;
		} else {
			$btnname = 'add';
			$btnclass = 'success';
			$btnvalue = 'Tambah';
		}
		?>
		 <div class="row">
            <div class="pull-left" style="margin-left: 1.5%">
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <label for="nama">Nama Lokasi</label>
                        <input type="hidden" name="id" value="<?=@$id?>">
                        <input type="text" name="nama" class="form-control" value="<?=@$nama_lokasi?>" placeholder="masukkan nama lokasi" required autofocus>
                    </div>
                    <div class="form-group pull-right">
                        <input type="submit" name="<?=$btnname?>" value="<?=$btnvalue?>" class="btn btn-<?=$btnclass?>">
                    </div>
                </form>
            </div>
        </div>

		<form method="post" name="proses">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="lokasi">
				<thead>
					<tr style="background-color: #90EE90">
						<th>Nama Lokasi</th>
						<th><i class="glyphicon glyphicon-cog"></i></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sql_lokasi2 = mysqli_query($con, "SELECT * FROM tb_lokasi") or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_lokasi2)) { ?>
					<tr>
						<td><?=$data['nama_lokasi']?></td>
						<td align="center">
							<a href="data.php?id=<?=$data['id_lokasi']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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
		$('#lokasi').DataTable({
				dom : 'Bfrtip',
				buttons : [
					'pdf', 'excel', 'print', 'copy'
				],
				columnDefs: [
					{
						searchable: false,
						orderable: false,
						targets: [1]
					}
				],
				order: [0, "asc"]
			});
		})

	</script>
	
<?php
	include_once('../../_footer.php');



?>

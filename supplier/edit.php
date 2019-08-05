<?php
include_once('../_header.php');
?>

<div class="box">
   <h1>Supplier</h1>
        <h4>
            <small>Edit Data Supplier</small>
            <div class="pull-right">
               <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
            </div>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
            	<?php
            	$id = @$_GET['id'];
            	$sql_supplier = mysqli_query($con, "SELECT * FROM tb_supplier WHERE id_supplier='$id'") or die (mysqli_error($con));
            	$data = mysqli_fetch_array($sql_supplier);
            	?>
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <label for="nama">Nama Supplier</label>
                        <input type="hidden" name="id" value="<?=$data['id_supplier']?>">
                        <input type="text" name="nama" id="nama" value="<?=$data['nama_supplier']?>" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telp Supplier</label>
                        <input type="text" name="no_telp" id="no_telp" value="<?=$data['no_telp_supplier']?>" pattern="[0-9]+" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Supplier</label>
                        <textarea name="alamat" id="alamat" class="form-control" required><?=$data['alamat_supplier']?></textarea>
                    </div>
                    <div class="form-group pull-right">
                        <input type="submit" name="edit" value="Simpan" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
</div>

<?php
include_once('../_footer.php'); ?>
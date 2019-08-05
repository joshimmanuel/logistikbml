<?php
include_once('../_header.php');
?>

<div class="box">
   <h1>Material</h1>
        <h4>
            <small>Edit Data Material</small>
            <div class="pull-right">
               <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
            </div>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
                $id = @$_GET['id'];
                $sql_material = mysqli_query($con, "SELECT * FROM tb_material WHERE id_material = '$id'") or die (mysqli_error($con));
                $data = mysqli_fetch_array($sql_material);
                ?>
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <label for="nama">Nama Material</label>
                        <input type="hidden" name="id" value="<?=$data['id_material']?>">
                        <input type="text" name="nama" value="<?=$data['nama_material']?>" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="nama">Jumlah Material</label>
                        <input type="number" name="jumlah" value="<?=$data['jumlah_material']?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Satuan Material</label>
                        <input type="text" name="satuan" value="<?=$data['satuan_material']?>" class="form-control" required>
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
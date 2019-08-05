<?php
include_once('../_header.php');
?>

<div class="box">
   <h1>User</h1>
        <h4>
            <small>Tambah Data User</small>
            <div class="pull-right">
               <a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
            </div>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="text" name="nama" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="nama">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Password</label>
                        <input type="text" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Tipe User</label>
                        <select name="level" class="form-control" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Gudang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Lokasi User</label>
                        <select name="lokasi" class="form-control" required>
                                        <option value="">Pilih Lokasi</option>
                                        <?php
                                        $sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi") or die (mysqli_error($con));
                                        while ($data_lokasi = mysqli_fetch_array($sql_lokasi)) {
                                            echo '<option value="'.$data_lokasi['id_lokasi'].'">'.$data_lokasi['nama_lokasi'].'</option>';
                                        }
                                        ?>
                        </select>
                    </div>
                    <div class="form-group pull-right">
                        <input type="submit" name="add" value="Simpan" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
</div>

<?php
include_once('../_footer.php'); ?>
<?php
include_once('../_header.php');
?>

<div class="box">
   <h1>User</h1>
        <h4>
            <small>Edit Data User</small>
            <div class="pull-right">
               <a href="index.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
            </div>
        </h4>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <?php
                $id = @$_GET['id'];
                $sql_user = mysqli_query($con, "SELECT * FROM tb_user join tb_lokasi on tb_user.lokasi_user = tb_lokasi.id_lokasi WHERE id_user = '$id'") or die (mysqli_error($con));
                $data = mysqli_fetch_array($sql_user);
                ?>
                <form action="proses.php" method="post">
                    <div class="form-group">
                        <label for="nama">Nama User</label>
                        <input type="hidden" name="id" value="<?=$data['id_user']?>">
                        <input type="text" name="nama" value="<?=$data['nama_user']?>" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="nama">Username</label>
                        <input type="text" name="username" value="<?=$data['username']?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Password</label>
                        <input type="text" name="password" value="<?=$data['password']?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <select name="lokasi" class="form-control" required>
                            <option value="">Pilih Lokasi</option>
                            <?php
                            $sql_lokasi = mysqli_query($con, "SELECT * FROM tb_lokasi") or die (mysqli_error($con));
                                while ($data_lokasi = mysqli_fetch_array($sql_lokasi)) { ?>
                                    <option value="<?=$data_lokasi['id_lokasi']?>"
                                <?php
                                    if ($data['lokasi_user'] == $data_lokasi['id_lokasi'])
                                        {
                                            echo " selected";
                                        }
                                ?>
                                ><?=$data_lokasi['nama_lokasi']?></option>';
                                <?php
                                }
                                ?>
                        </select>
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
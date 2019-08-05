<?php
include_once('../_header.php');
?>

<div class="box">
   <h1>Laporan Material Masuk</h1>
        <h4>
            <small>Pilih Material Masuk</small>
            <div class="pull-right">
               <a href="data_masuk.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
            </div>
        </h4>
       <form method="post" name="proses">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="pilih">
                <thead>
                    <tr style="background-color: #90EE90">
                        <th>Nama Material</th>
                           <th> <center>
                                <input type="checkbox" id="select_all" value="">
                            </center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql_material = mysqli_query($con, "SELECT * FROM tb_material") or die(mysqli_error($con));
                if(mysqli_num_rows($sql_material) > 0) { 
                    while($data = mysqli_fetch_array($sql_material)) { ?>
                    <tr>
                        <td><?=$data['nama_material']?></td>
                        <td align="center">
                            <input type="checkbox" name="checked[]" class="check" value="<?=$data['id_material']?>">
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
        <button class="btn btn-success btn-sm" onclick="pilih()"><i class="glyphicon glyphicon-chevron-right"></i> Pilih Material</button>
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

            $('#pilih').DataTable({
                columnDefs: [
                    {
                        searchable: false,
                        orderable: false,
                        targets: [1]
                    }
                ]
            });
        })
        function pilih() {
            document.proses.action = "add_masuk_proses.php";    
            document.proses.submit();
        }

    </script>

<?php
include_once('../_footer.php'); ?>
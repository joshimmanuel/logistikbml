<?php
		
require_once "../../../_config/config.php";
require "../../../_assets/libs/vendor/autoload.php";

		$id_rab = $_GET['id'];
		$sql_validasi_rab = mysqli_query($con, "SELECT * FROM tb_rab_unit where  id_rab='$id_rab'") or die (mysqli_error($con));
		if(mysqli_num_rows($sql_validasi_rab) == 0){
			echo "<script>window.location='add.php?id=$id_rab';</script>";
		} else {
			echo "<script>window.location='data.php?id=$id_rab';</script>";	
		}

		?>
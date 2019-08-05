<?php
	include_once('../_header.php');
?>
<div class="row">
	<div class="col-lg-12">
		<h1>Dashboard</h1>
		<p>Selamat Datang <mark><?=$data_user['nama_user']?></mark></p>
		<a href="data_user.php" class="btn btn-info">Data User</a>
		<a href="edit_diri.php?id=<?=$id_user?>" class="btn btn-warning">Ubah Data Diri</a>
		<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	</div>
</div>

<?php
	include_once('../_footer.php');
?>
<?php
require_once "../../_config/config.php";
require "../../_assets/libs/vendor/autoload.php";

$user = $_SESSION['user'];
                $sql_user = mysqli_query($con, "SELECT * FROM tb_user, tb_lokasi WHERE tb_user.lokasi_user = tb_lokasi.id_lokasi and username = '$user'") or die (mysqli_error($con));
                $data = mysqli_fetch_assoc($sql_user);
                $lokasi_user = $data['nama_lokasi'];
                $lokasi = $data['id_lokasi'];
                $id_user = $data['id_user'];

if(!isset($_SESSION['user'])) {
	echo "<script>window.location='".base_url('auth/login')."'</script>";
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
   	<meta charset="utf-8">
   	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	<meta name="viewport" content="width=device-width, initial-scale=1">
   	<meta name="description" content="">
   	<meta name="author" content="">
   	<title>Logistik Gudang <?=$lokasi_user?></title>
    <link rel="icon" href="<?=base_url()?>/_assets/logo.png">
    <link href="<?=base_url()?>/_assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/_assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="<?=base_url()?>/_assets/libs/DataTables/datatables.min.css" rel="stylesheet">
</head>
<body>
	<script src="<?=base_url('_assets/js/jquery.js')?>"></script>
    <script src="<?=base_url('_assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('_assets/libs/DataTables/datatables.min.js')?>"></script>
   <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#"><span class="text-primary"><b>Logistik <?=$lokasi_user?></b></span></a>
                </li>
                <li>
                    <a href="<?=base_url('gudang/index.php')?>">Dashboard</a>
                </li>
                <li>
                    <a href="<?=base_url('gudang/material/data.php')?>">Data Material</a>
                </li>
                <li>
                    <a href="<?=base_url('gudang/rab/data.php')?>">Data RAB</a>
                </li>
                <li>
                    <a href="<?=base_url('gudang/unit/data.php')?>">Data Unit</a>
                </li>
                <li>
                    <a href="<?=base_url('gudang/laporan/data_masuk.php')?>">Laporan</a>
                </li>
                <li>
                    <a href="<?=base_url('auth/logout.php')?>"><span class="text-danger">Logout</span></a>
                </li>
            </ul>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid">
              
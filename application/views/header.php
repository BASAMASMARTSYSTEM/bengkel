<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href=<?php echo asset_images()."/favicon.ico"?>>
	<title><?php echo $page_title.$bss; ?></title>

	<!-- Bootstrap core CSS -->
    <link type="text/css" href=<?php echo asset_css()."bootstrap.min.css"?> rel="stylesheet">
    <link type="text/css" href=<?php echo asset_css()."style.css"?> rel="stylesheet">
    <link type="text/css" href=<?php echo base_url()."assets/datatables/css/dataTables.bootstrap.css"?> rel="stylesheet">  
	<link type="text/css" href=<?php echo asset_css()."bootcomplete.css"?> rel="stylesheet">  

    	<!-- Bootstrap core JS -->
	<script type="text/javascript" src=<?php echo asset_js()."jquery-2.1.4.min.js"?>></script>
    <script type="text/javascript" src=<?php echo asset_js()."bootstrap.min.js"?>></script>
    <script type="text/javascript" src=<?php echo asset_js()."validator.js"?>></script>
    <script type="text/javascript" src=<?php echo asset_js()."validator.min.js"?>></script>
    <script type="text/javascript" src=<?php echo base_url()."assets/datatables/js/jquery.dataTables.min.js"?>></script>
    <script type="text/javascript" src=<?php echo base_url()."assets/datatables/js/dataTables.bootstrap.js"?>></script>
	<script type="text/javascript" src=<?php echo asset_js()."jquery.bootcomplete.js"?>></script>

    <div class="container-fluid">
		<a href=<?php echo base_url();?>><img src=<?php echo asset_images()."bss.jpg"?> class="img-responsive center-block" alt="BASAMA.CO.ID" href="#"></a>
	</div>
   
</head>
<body>
	
	<div class="container-fluid">
		<div class="panel-body">
			<ul class="nav nav-tabs">
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> Master <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href=<?php echo base_url('bahan_baku'); ?>>Data Bahan Baku</a></li>
				    <li><a href=<?php echo base_url('toko'); ?>>Data Toko Bahan</a></li>
				    <li><a href=<?php echo base_url('supplier'); ?>>Data Supplier</a></li>
				    <li role="separator" class="divider"></li>
				    <li><a href=<?php echo base_url('pengguna'); ?>>Data Pengguna</a></li>
					</ul>  	
				</li>
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Transaksi <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href=<?php echo base_url('pembelian_bahan'); ?>>Pembelian Bahan Baku</a></li>
				    <li><a href=<?php echo base_url('pengambilan_bahan'); ?>>Pengambilan Bahan Baku</a></li>				    
					</ul>  	
				</li>

				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> Laporan <span class="caret"></span></a>
					<ul class="dropdown-menu">
					<li><a href=<?php echo sbase_url('laporan/bahan_baku'); ?>>Informasi Bahan Baku</a></li>
				    <li><a href=<?php echo sbase_url('laporan/pengambilan_pembelian'); ?>>Informasi Pembelian dan Pengambilan Bahan Baku</a></li>	    
					</ul>  	
				</li>
			</ul>
		</div>
	</div>
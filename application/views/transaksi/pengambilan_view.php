<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<?php 
$data['page_title'] = 'Pengambilan Bahan Baku';
$data['bss'] = ' - BSS';
$this->load->view('header', $data); 
?>

<div class="container-fluid text-center">
	<p class="text-center"><h2>PENGAMBILAN BAHAN BAKU</h2></p>		
</div>

<?php $this->load->view('footer'); ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<?php 
$data['page_title'] = 'Basama';
$data['bss'] = ' Smart System';
$this->load->view('header', $data); 
?>

<div class="container-fluid text-center">
	<p class="text-center"><h2>MENU UTAMA</h2></p>			
</div>

<?php $this->load->view('footer'); ?>
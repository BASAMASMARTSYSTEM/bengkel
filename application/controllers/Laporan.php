<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function bahan_baku()
	{
		$this->load->view('laporan/informasi_bahan_baku_view');
	}

	public function pengambilan_pembelian()
	{
		$this->load->view('laporan/pembelian_dan_pengambilan_view');
	}
	
}
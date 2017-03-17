<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_bahan extends CI_Controller {

	public function index()
	{
		$this->load->view('transaksi/pembelian_view');
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengambilan_bahan extends CI_Controller {

	public function index()
	{
		$this->load->view('transaksi/pengambilan_view');
	}
}
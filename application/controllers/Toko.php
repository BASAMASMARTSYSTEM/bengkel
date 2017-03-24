<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('toko_model'));
    }

	public function index()
	{
		$this->load->view('master/toko_view');
	}

	public function tampil()
	{
		$list = $this->toko_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $toko) {
			$no++;
			$row = array();
			$row[] = $toko->Nama;
			$row[] = $toko->Alamat;
			$row[] = $toko->NoTelp;						

			//add html for action
			$row[] = '<a class="btn btn-sm btn-warning btn-xs" href="javascript:void(0)" title="Ubah" onclick="ubah('."'".$toko->KodeToko."'".')"><i class="glyphicon glyphicon-pencil"></i> </a> 					
				  <a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$toko->KodeToko."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->toko_model->count_all(),
						"recordsFiltered" => $this->toko_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}


	public function tambah()
	{
		$this->_validate();
		$data = array(
				'Nama' => $this->input->post('Nama'),
				'Alamat' => $this->input->post('Alamat'),
				'NoTelp' => $this->input->post('NoTelp'),				
			);
		$insert = $this->toko_model->save($data);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('Nama') == '')
		{
			$data['inputerror'][] = 'Nama';
			$data['error_string'][] = 'Nama harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('Alamat') == '')
		{
			$data['inputerror'][] = 'Alamat';
			$data['error_string'][] = 'Alamat harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}


	public function perbaharui()
	{
		$this->_validate();
		$data = array(
				'Nama' => $this->input->post('Nama'),
				'Alamat' => $this->input->post('Alamat'),
				'NoTelp' => $this->input->post('NoTelp'),
				
			);
		$this->toko_model->update(array('KodeToko' => $this->input->post('KodeToko')), $data);
		echo json_encode(array("status" => TRUE));
	}


	public function ubah($KodeToko)
	{
		$data = $this->toko_model->get_by_kode($KodeToko);		
		echo json_encode($data);
	}


	public function hapus($kode)
	{
		$this->toko_model->delete_by_kode($kode);
		echo json_encode(array("status" => TRUE));
	}


}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('pengguna_model'));
    }

	public function index()
	{
		$this->load->view('master/pengguna_view');
	}


	public function tampil()
	{
		$list = $this->pengguna_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pengguna) {
			$no++;
			$row = array();
			$row[] = $pengguna->Nama;
			$row[] = $pengguna->Username;
			$row[] = $pengguna->NoTelp;						
			$row[] = $pengguna->Status;

			//add html for action
			$row[] = '<a href="javascript:void(0)" title="Ubah" onclick="ubah('."'".$pengguna->KodePengguna."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<span role="separator" class="divider">  |  </span> 
				  <a href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$pengguna->KodePengguna."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pengguna_model->count_all(),
						"recordsFiltered" => $this->pengguna_model->count_filtered(),
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
				'Username' => $this->input->post('Username'),
				'Password' => $this->input->post('Password'),				
				'NoTelp' => $this->input->post('NoTelp'),
				'Status' => $this->input->post('Status'),
			);
		$insert = $this->pengguna_model->save($data);
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
			$data['error_string'][] = 'Nama lengkap harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('Username') == '')
		{
			$data['inputerror'][] = 'Username';
			$data['error_string'][] = 'Nama pengguna harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('Password') == '')
		{
			$data['inputerror'][] = 'Password';
			$data['error_string'][] = 'Password harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('NoTelp') == '')
		{
			$data['inputerror'][] = 'NoTelp';
			$data['error_string'][] = 'Nomor telepon harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('Status') == '')
		{
			$data['inputerror'][] = 'Status';
			$data['error_string'][] = 'Status pengguna harus diisi';
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
				'Username' => $this->input->post('Username'),
				'Password' => $this->input->post('Password'),				
				'NoTelp' => $this->input->post('NoTelp'),
				'Status' => $this->input->post('Status'),
				
			);
		$this->pengguna_model->update(array('KodePengguna' => $this->input->post('KodePengguna')), $data);
		echo json_encode(array("status" => TRUE));
	}


	public function ubah($KodePengguna)
	{
		$data = $this->pengguna_model->get_by_kode($KodePengguna);		
		echo json_encode($data);
	}


	public function hapus($KodePengguna)
	{
		$this->pengguna_model->delete_by_kode($KodePengguna);
		echo json_encode(array("status" => TRUE));
	}



}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model(array('supplier_model'));
    }

    public function tampil()
	{
		$list = $this->supplier_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $supplier) {
			$no++;
			$row = array();
			$row[] = $supplier->Nama;
			$row[] = $supplier->Alamat;
			$row[] = $supplier->NoTelp1;
			$row[] = $supplier->NoTelp2;			

			//add html for action
			$row[] = '<a href="javascript:void(0)" title="Ubah" onclick="ubah('."'".$supplier->KodeSupplier."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<span role="separator" class="divider">  |  </span> 
				  <a href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$supplier->KodeSupplier."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->supplier_model->count_all(),
						"recordsFiltered" => $this->supplier_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function index()
	{
		$data['suppliers']=$this->supplier_model->getAll();
		$this->load->view('master/supplier_view',$data);
	}

	public function tambah()
	{
		$this->_validate();
		$data = array(
				'Nama' => $this->input->post('inputNama'),
				'Alamat' => $this->input->post('inputAlamat'),
				'NoTelp1' => $this->input->post('inputTelepon1'),
				'NoTelp2' => $this->input->post('inputTelepon2'),
			);
		$insert = $this->supplier_model->save($data);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('inputNama') == '')
		{
			$data['inputerror'][] = 'inputNama';
			$data['error_string'][] = 'Nama harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('inputAlamat') == '')
		{
			$data['inputerror'][] = 'inputAlamat';
			$data['error_string'][] = 'Alamat harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('inputTelepon1') == '')
		{
			$data['inputerror'][] = 'inputTelepon1';
			$data['error_string'][] = 'Telepon harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function hapus($kode)
	{
		$this->supplier_model->delete_by_kode($kode);
		echo json_encode(array("status" => TRUE));
	}

	public function ubah($KodeSupplier)
	{
		$data = $this->supplier_model->get_by_kode($KodeSupplier);		
		echo json_encode($data);
	}

	public function perbaharui()
	{
		$this->_validate();
		$data = array(
				'Nama' => $this->input->post('inputNama'),
				'Alamat' => $this->input->post('inputAlamat'),
				'NoTelp1' => $this->input->post('inputTelepon1'),
				'NoTelp2' => $this->input->post('inputTelepon2'),
			);
		$this->supplier_model->update(array('KodeSupplier' => $this->input->post('KodeSupplier')), $data);
		echo json_encode(array("status" => TRUE));
	}

}
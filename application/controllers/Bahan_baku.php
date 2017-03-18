<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan_baku extends CI_Controller {


	function __construct() {
        parent::__construct();
        $this->load->model(array('bahan_model'));
    }

	public function index()
	{
		$this->load->view('master/bahan_baku_view');
	}


	public function tampil()
	{
		$list = $this->bahan_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $bahan) {
			$no++;
			$row = array();			
			$row[] = $bahan->Nama;			
			$row[] = $bahan->HargaBeli;						
			$row[] = $bahan->HargaJual;
			$row[] = $bahan->Stok;			
			$row[] = $bahan->Satuan;			
			$row[] = $bahan->KelompokAktiva;			

			//add html for action
			$row[] = '<a class="btn btn-sm btn-warning btn-xs" href="javascript:void(0)" title="Ubah" onclick="ubah('."'".$bahan->KodeBarang."'".')"><i class="glyphicon glyphicon-pencil"></i></a> 
					<a class="btn btn-sm btn-danger btn-xs" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$bahan->KodeBarang."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->bahan_model->count_all(),
						"recordsFiltered" => $this->bahan_model->count_filtered(),
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
				'HargaBeli' => $this->input->post('HargaBeli'),
				'HargaJual' => $this->input->post('HargaJual'),				
				'Stok' => $this->input->post('Stok'),
				'Satuan' => $this->input->post('Satuan'),
				'KelompokAktiva' => $this->input->post('KelompokAktiva'),				
			);

		$insert = $this->bahan_model->save($data);
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
			$data['error_string'][] = 'Nama bahan harus diisi';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('HargaBeli') == '')
		{
			$data['inputerror'][] = 'HargaBeli';
			$data['error_string'][] = 'Harga beli harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('HargaJual') == '')
		{
			$data['inputerror'][] = 'HargaJual';
			$data['error_string'][] = 'Harga Jual harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('Stok') == '')
		{
			$data['inputerror'][] = 'Stok';
			$data['error_string'][] = 'Stok harus harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('Satuan') == '')
		{
			$data['inputerror'][] = 'Satuan';
			$data['error_string'][] = 'Satuan bahan harus diisi';
			$data['status'] = FALSE;
		}

		if($this->input->post('KelompokAktiva') == '')
		{
			$data['inputerror'][] = 'KelompokAktiva';
			$data['error_string'][] = 'Kelompok Aktiva harus diisi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}


	public function ubah($KodeBarang)
	{
		$data = $this->bahan_model->get_by_kode($KodeBarang);		
		echo json_encode($data);
	}


	public function perbaharui()
	{
		$this->_validate();
		$data = array(
				'Nama' => $this->input->post('Nama'),
				'HargaBeli' => $this->input->post('HargaBeli'),
				'HargaJual' => $this->input->post('HargaJual'),				
				'Stok' => $this->input->post('Stok'),
				'Satuan' => $this->input->post('Satuan'),
				'KelompokAktiva' => $this->input->post('KelompokAktiva'),
				
			);		

		$this->bahan_model->update(array('KodeBarang' => $this->input->post('KodeBarang')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function hapus($KodeBarang)
	{        
		$this->bahan_model->delete_by_kode($KodeBarang);
		echo json_encode(array("status" => TRUE));
	}

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dok_hukum extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('dok_hukum_model');
		$this->load->model('bentuk_dok_hukum_model');
		$this->load->model('kategori_dok_hukum_model');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->dok_hukum_model->get_count_records($search_phrase);
		$data['total_unpublish'] = $this->dok_hukum_model->get_records_by_status(0);
		$data['total_publish'] = $this->dok_hukum_model->get_records_by_status(1);
		
		$this->load->view('/admin/dok_hukum/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$dok_hukum_list = $this->dok_hukum_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->dok_hukum_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $dok_hukum_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$data['bentuk_dok_hukum_list'] = $this->bentuk_dok_hukum_model->populate_combo();
		$data['kategori_dok_hukum_list'] = $this->kategori_dok_hukum_model->populate_combo();
		$this->load->view('/admin/dok_hukum/add', $data);
	}
	
	public function edit($id) {
		$data['bentuk_dok_hukum_list'] = $this->bentuk_dok_hukum_model->populate_combo();
		$data['kategori_dok_hukum_list'] = $this->kategori_dok_hukum_model->populate_combo();
		$data['dok_hukum'] = $this->dok_hukum_model->get_record_by_id($this->uri->segment(5));
	
		$this->load->view('/admin/dok_hukum/edit', $data);
	}
	
	public function do_insert() {
		$upload_path = './uploads/dok_hukum';
				
		if ($_FILES) {
			$file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$file_name = md5($_FILES['file']['name']) . '.' . $file_ext;
			
			if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . '/' . $file_name)) {
				echo 'error uploading file';				
			}	
		} else {
			$file_name = '';
		}
		
		$result = $this->dok_hukum_model->insert(array(
			'bentuk_dok_hukum_id' => $this->input->post('bentuk_dok_hukum_id'),
			'file' => $file_name,
			'is_publish' => $this->input->post('is_publish'),
			'kategori_dok_hukum_id' => $this->input->post('kategori_dok_hukum_id'),
			'nomor' => $this->input->post('nomor'),
			'perihal' => $this->input->post('perihal'),
			'tahun' => $this->input->post('tahun'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$upload_path = './uploads/dok_hukum';
				
		if ($_FILES) {
			$file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$file_name = md5($_FILES['file']['name']) . '.' . $file_ext;
			
			if ($this->input->post('old_file') != $file_name && $this->input->post('old_file') != '') {
				if (file_exists($upload_path . '/' . $this->input->post('old_file')))
					unlink($upload_path . '/' . $this->input->post('old_file'));
				
			}
			
			if ($file_name != '') {
				if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . '/' . $file_name)) {
					echo 'error uploading file';				
				}
			}		
		} else {
			$file_name = $this->input->post('old_file');
		}
		
		$result = $this->dok_hukum_model->update(
			$this->input->post('id'), array(
				'bentuk_dok_hukum_id' => $this->input->post('bentuk_dok_hukum_id'),
				'file' => $file_name,
				'is_publish' => $this->input->post('is_publish'),
				'kategori_dok_hukum_id' => $this->input->post('kategori_dok_hukum_id'),
				'nomor' => $this->input->post('nomor'),
				'perihal' => $this->input->post('perihal'),
				'tahun' => $this->input->post('tahun'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_delete() {
		$id = $this->input->post('id');
		
		if ($this->dok_hukum_model->delete($id))
			echo 'success';
	}
	
}
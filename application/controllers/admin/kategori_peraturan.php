<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_peraturan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('kategori_dok_hukum_model');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->kategori_dok_hukum_model->get_count_records($search_phrase);
		
		$this->load->view('/admin/kategori_peraturan/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$kategori_peraturan_list = $this->kategori_dok_hukum_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->kategori_dok_hukum_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $kategori_peraturan_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$this->load->view('/admin/kategori_peraturan/add');
	}
	
	public function edit($id) {
		$data['kategori_peraturan'] = $this->kategori_dok_hukum_model->get_record_by_id( $this->uri->segment(5));
	
		$this->load->view('/admin/kategori_peraturan/edit', $data);
	}
	
	public function do_insert() {
		$result = $this->kategori_dok_hukum_model->insert(array(
			'judul' => $this->input->post('judul'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->kategori_dok_hukum_model->update(
			$this->input->post('id'), array(
				'judul' => $this->input->post('judul'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_delete() {
		$id = $this->input->post('id');
		
		if ($this->kategori_dok_hukum_model->delete($id))
			echo 'success';
	}
	
}
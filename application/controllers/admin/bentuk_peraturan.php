<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bentuk_peraturan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('bentuk_dok_hukum_model');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->bentuk_dok_hukum_model->get_count_records($search_phrase);
		
		$this->load->view('/admin/bentuk_peraturan/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$bentuk_peraturan_list = $this->bentuk_dok_hukum_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->bentuk_dok_hukum_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $bentuk_peraturan_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$this->load->view('/admin/bentuk_peraturan/add');
	}
	
	public function edit($id) {
		$data['bentuk_peraturan'] = $this->bentuk_dok_hukum_model->get_record_by_id( $this->uri->segment(5));
	
		$this->load->view('/admin/bentuk_peraturan/edit', $data);
	}
	
	public function do_insert() {
		$result = $this->bentuk_dok_hukum_model->insert(array(
			'judul' => $this->input->post('judul'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->bentuk_dok_hukum_model->update(
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
		
		if ($this->bentuk_dok_hukum_model->delete($id))
			echo 'success';
	}
	
}
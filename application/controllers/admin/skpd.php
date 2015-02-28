<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skpd extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('skpd_model');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->skpd_model->get_count_records($search_phrase);
		
		$this->load->view('/admin/skpd/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$skpd_list = $this->skpd_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->skpd_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $skpd_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$this->load->view('/admin/skpd/add');
	}
	
	public function edit($id) {
		$data['skpd'] = $this->skpd_model->get_record_by_id( $this->uri->segment(5));
	
		$this->load->view('/admin/skpd/edit', $data);
	}
	
	public function do_insert() {
		$result = $this->skpd_model->insert(array(
			'nama' => $this->input->post('nama'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->skpd_model->update(
			$this->input->post('id'), array(
				'nama' => $this->input->post('nama'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_delete() {
		$id = $this->input->post('id');
		
		if ($this->skpd_model->delete($id))
			echo 'success';
	}
	
}
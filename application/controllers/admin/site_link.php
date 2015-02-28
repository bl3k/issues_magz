<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_link extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('site_link_model');
		$this->load->library('pagination');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->site_link_model->get_count_records($search_phrase);
		$data['total_unpublish'] = $this->site_link_model->get_records_by_status(0);
		$data['total_publish'] = $this->site_link_model->get_records_by_status(1);
		
		$this->load->view('/admin/site_link/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$site_link_list = $this->site_link_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->site_link_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $site_link_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$this->load->view('/admin/site_link/add');
	}
	
	public function edit($id) {
		$data['site_link'] = $this->site_link_model->get_record_by_id( $this->uri->segment(5));
	
		$this->load->view('/admin/site_link/edit', $data);
	}
	
	public function do_insert() {
		$result = $this->site_link_model->insert(array(
			'title' => $this->input->post('title'),
			'url' => $this->input->post('url'),
			'is_publish' => $this->input->post('is_publish'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->site_link_model->update(
			$this->input->post('id'), array(
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
				'is_publish' => $this->input->post('is_publish'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_delete() {
		$id = $this->input->post('id');
		
		if ($this->site_link_model->delete($id))
			echo 'success';
	}
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('news_model');
		$this->load->library('pagination');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->news_model->get_count_records($search_phrase);
		$data['total_unpublish'] = $this->news_model->get_records_by_status(0);
		$data['total_publish'] = $this->news_model->get_records_by_status(1);
		
		$this->load->view('/admin/news/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$news_list = $this->news_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->news_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $news_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$this->load->view('/admin/news/add');
	}
	
	public function edit($id) {
		$data['news'] = $this->news_model->get_record_by_id( $this->uri->segment(5));
	
		$this->load->view('/admin/news/edit', $data);
	}
	
	public function do_insert() {
		$result = $this->news_model->insert(array(
			'news_title' => $this->input->post('news_title'),
			'news_content' => $this->input->post('news_content'),
			'is_publish' => $this->input->post('is_publish'),
			'published_at' => $this->input->post('published_at'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->news_model->update(
			$this->input->post('id'), array(
				'news_title' => $this->input->post('news_title'),
				'news_content' => $this->input->post('news_content'),
				'is_publish' => $this->input->post('is_publish'),
				'published_at' => $this->input->post('published_at'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_delete() {
		$id = $this->input->post('id');
		
		if ($this->news_model->delete($id))
			echo 'success';
	}
	
}
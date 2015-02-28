<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('news_model');
	}
	
	public function index()	{
		/*$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->news_model->get_count_records($search_phrase);
		$data['total_unpublish'] = $this->news_model->get_records_by_status(0);
		$data['total_publish'] = $this->news_model->get_records_by_status(1);
		
		$this->load->view('/admin/news/index', $data);*/
		
		$this->load->view('/portal/news/index');
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
	
	public function edit($id) {
		$data['news'] = $this->news_model->get_record_by_id( $this->uri->segment(5));
	
		$this->load->view('/portal/news/detail', $data);
	}
	
}
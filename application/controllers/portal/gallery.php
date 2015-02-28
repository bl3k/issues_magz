<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('gallery_model');
	}
	
	public function index()	{
		/*$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->gallery_model->get_count_records($search_phrase);
		$data['total_unpublish'] = $this->gallery_model->get_records_by_status(0);
		$data['total_publish'] = $this->gallery_model->get_records_by_status(1);
		
		$this->load->view('/admin/gallery/index', $data);*/
		
		$data['gallery_list'] = $this->gallery_model->get_records_for_fp(1);
		
		$this->load->view('portal/gallery/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$gallery_list = $this->gallery_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->gallery_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $gallery_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
}
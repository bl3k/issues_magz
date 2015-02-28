<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranham extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('ranham_model');
		$this->load->model('ranham_detail_model');
		$this->load->model('skpd_model');
		$this->load->library('xlsxwriter');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->ranham_model->get_count_records($search_phrase);
		
		$this->load->view('/admin/ranham/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$ranham_list = $this->ranham_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->ranham_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $ranham_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$data['skpd_list'] = $this->skpd_model->populate_combo();
		
		$this->load->view('/admin/ranham/add', $data);
	}
	
	public function edit($id) {
		$data['ranham'] = $this->ranham_model->get_record_by_id( $this->uri->segment(5));
		$data['skpd_list'] = $this->skpd_model->populate_combo();
		
		$this->load->view('/admin/ranham/edit', $data);
	}
	
	public function do_insert() {
		$result = $this->ranham_model->insert(array(
			'skpd_id' => $this->input->post('skpd_id'),
			'semester' => $this->input->post('semester'),
			'tahun' => $this->input->post('tahun'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->ranham_model->update(
			$this->input->post('id'), array(
				'skpd_id' => $this->input->post('skpd_id'),
				'semester' => $this->input->post('semester'),
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
		
		if ($this->ranham_model->delete($id))
			echo 'success';
	}
	
	public function xlsx_export() {
		$result = $this->ranham_model->get_records_by_params(array('tahun' => $this->uri->segment(5)));
		
		$header = array(
			'NO' => 'number',
			'PERMASALAHAN' => 'string',
			'PROGRAM' => 'string',
			'KEGIATAN' => 'string',
			'SASARAN' => 'string',
		);

		if ($result) {
			foreach ($result as $key => $r) {
				$arr[] = array($key + 1, $r->permasalahan, $r->program, $r->kegiatan, $r->sasaran);
			}
		}
		
		$data['result'] = $arr;
	
		$this->load->view('/admin/ranham/excel', $data);
	}
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
class Ranham_detail extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('ranham_detail_model');
		$this->load->model('ranham_model');
		$this->load->model('skpd_model');
	}
	
	public function index()	{
		$data['ranham'] = $this->ranham_model->get_record_by_id($this->uri->segment(5));
		$data['ranham_detail_list'] = $this->ranham_detail_model->get_all_records($this->uri->segment(5));
		$data['total_records'] = $this->ranham_detail_model->get_count_records($this->uri->segment(5));
		$data['ranham_id'] = $this->uri->segment(5);
		
		$this->load->view('/admin/ranham_detail/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$ranham_detail_list = $this->ranham_detail_model->get_all_records($this->input->post('id'), $current, $row_count, $sort, $search_phrase);
		$total = $this->ranham_detail_model->get_count_records($this->input->post('id'), $search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $ranham_detail_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$data['ranham'] = $this->ranham_model->get_record_by_id($this->uri->segment(5));
		$data['skpd'] = $this->skpd_model->get_record_by_id($data['ranham']['skpd_id']);
		
		$this->load->view('/admin/ranham_detail/add', $data);
	}
	
	public function edit($id) {
		$data['ranham_detail'] = $this->ranham_detail_model->get_record_by_id( $this->uri->segment(5));
		$data['skpd_list'] = $this->skpd_model->populate_combo();
		
		$this->load->view('/admin/ranham_detail/edit', $data);
	}
	
	public function do_insert() {
		$result = $this->ranham_detail_model->insert(array(
			'skpd_id' => $this->input->post('skpd_id'),
			'semester' => $this->input->post('semester'),
			'tahun' => $this->input->post('tahun'),
			'permasalahan' => $this->input->post('permasalahan'),
			'program' => $this->input->post('program'),
			'kegiatan' => $this->input->post('kegiatan'),
			'sasaran' => $this->input->post('sasaran'),
			'target_jumlah' => $this->input->post('target_jumlah'),
			'outcome' => $this->input->post('outcome'),
			'hambatan' => $this->input->post('hambatan'),
			'tindak_lanjut' => $this->input->post('tindak_lanjut'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->ranham_detail_model->update(
			$this->input->post('id'), array(
				'skpd_id' => $this->input->post('skpd_id'),
				'semester' => $this->input->post('semester'),
				'tahun' => $this->input->post('tahun'),
				'permasalahan' => $this->input->post('permasalahan'),
				'program' => $this->input->post('program'),
				'kegiatan' => $this->input->post('kegiatan'),
				'sasaran' => $this->input->post('sasaran'),
				'hambatan' => $this->input->post('hambatan'),
				'outcome' => $this->input->post('outcome'),
				'tindak_lanjut' => $this->input->post('tindak_lanjut'),
				'target_jumlah' => $this->input->post('target_jumlah'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_delete() {
		$id = $this->input->post('id');
		
		if ($this->ranham_detail_model->delete($id))
			echo 'success';
	}
	
}
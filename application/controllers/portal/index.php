<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('publication');
	}
	
	public function index()	{
		$data['publication_list'] = $this->publication->get_all_records();
		
		$this->load->view('portal/home', $data);
	}
	
	public function show() {
		$id = 2;
		
		print_r($this->publication->get_record_by_id($id));
	}
	
	public function do_insert() {
		$data = array(
			'name' => '<script>alert("Publication #1");</script>'
		);
		
		echo $this->publication->insert($data);
	}
	
	public function do_update() {
		$id = 2;
		$data = array(
			'name' => '<script>alert("Publication #1 (edited)");</script>'
		);
		
		echo $this->publication->update($id, $data);
	}
	
	public function do_delete() {
		$id = 2;
		
		echo $this->publication->delete($id);
	}
}
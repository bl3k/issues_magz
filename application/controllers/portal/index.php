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
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_page extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('static_page_model');
	}
	
	public function index()	{
		$data['static_page'] = $this->static_page_model->get_record_by_params(array('slug' => $this->uri->segment(5)));
		
		switch ($this->uri->segment(5)) {
			case 'visi-misi' : {
				$title = 'Visi &amp; Misi';
			} break;
			
			case 'profil' : {
				$title = 'Profil';
			} break;
			
			case 'jdih' : {
				$title = 'Tentang JDIH';
			} break;
		}
		
		$data['title'] = $title;
		$data['slug'] = $this->uri->segment(5);
		
		$this->load->view('/portal/static_page/index', $data);
	}
	
}
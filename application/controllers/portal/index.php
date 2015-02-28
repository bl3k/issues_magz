<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('news_model');
		$this->load->model('site_link_model');
		$this->load->model('slider_model');
		$this->load->model('social_media_model');
		$this->load->helper('text_helper');
	}
	
	public function index()	{
		$data['news_list'] = $this->news_model->get_records_for_fp(1);
		$data['site_link_list'] = $this->site_link_model->get_records_for_fp(1);
		$data['slider_list'] = $this->slider_model->get_records_for_fp(1);
		$data['social_media'] = $this->social_media_model->get_records_for_fp();
		
		$this->load->view('portal/_layout/default', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
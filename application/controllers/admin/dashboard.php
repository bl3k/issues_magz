<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index()	{
		$data['username'] = $this->session->userdata('username');
		
		$this->load->view('admin/_layout/default', $data);
	}
	
	public function chart() {
		$this->load->view('admin/dashboard/index');
	}
}
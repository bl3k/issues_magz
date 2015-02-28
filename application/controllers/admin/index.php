<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('user_model');
	}
	
	public function index()	{
		$this->load->view('admin/index');
	}
	
	public function do_login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$result = $this->user_model->get_record_by_params([
			'username' => $username, 
			'password' => $password
		]);
		
		if (count($result) > 0) {
			$data = array(
				'username' => $result->username,
				'user_id' => $result->user_id,
				'login' => TRUE
			);
			
			$this->session->set_userdata($data);
			redirect('admin/dashboard');
		} else {
			$data['error_msg'] = 'Username dan Password tidak valid!';
			redirect('admin/index');
		}
	}
	
	public function do_logout() {
		$this->user_model->update_single_col($this->session->userdata('user_id'), 'last_logged_in', date('Y-m-d H:i:s'));
			
		$this->session->sess_destroy();
		redirect('admin/index');
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('user_model');
		$this->load->model('skpd_model');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->user_model->get_count_records($search_phrase);
		$data['total_non_active'] = $this->user_model->get_records_by_status(0);
		$data['total_active'] = $this->user_model->get_records_by_status(1);
		
		$this->load->view('/admin/user/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$news_list = $this->user_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->user_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $news_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$data['skpd_list'] = $this->skpd_model->populate_combo();
		
		$this->load->view('/admin/user/add', $data);
	}
	
	public function edit($id) {
		$data['user'] = $this->user_model->get_record_by_id( $this->uri->segment(5));
		$data['skpd_list'] = $this->skpd_model->populate_combo();
		
		$this->load->view('/admin/user/edit', $data);
	}
	
	public function edit_current_user($id) {
		$data['user'] = $this->user_model->get_record_by_id( $this->uri->segment(5));
		$data['skpd_list'] = $this->skpd_model->populate_combo();
		
		$this->load->view('/admin/user/edit_current_user', $data);
	}
	
	public function edit_password($id) {
		$data['user'] = $this->user_model->get_record_by_id( $this->uri->segment(5));
	
		$this->load->view('/admin/user/edit_password', $data);
	}
	
	public function do_insert() {
		$result = $this->user_model->insert(array(
			'name' => $this->input->post('name'),
			'username' => $this->input->post('username'),
			'is_active' => $this->input->post('is_active'),
			'skpd_id' => $this->input->post('skpd_id'),
			'level' => $this->input->post('level'),
			'password' => md5($this->input->post('password')),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$new_password = $this->input->post('password');
		$old_password = $this->input->post('old_password');
		
		if ($new_password == '' && $old_password != '') {
			$password = $old_password;
		} else {
			$password = md5($new_password);
		}
		
		$result = $this->user_model->update(
			$this->input->post('id'), array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'is_active' => $this->input->post('is_active'),
				'password' => $password,
				'skpd_id' => $this->input->post('skpd_id'),
				'level' => $this->input->post('level'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_update_current_user() {
		$new_password = $this->input->post('password');
		$old_password = $this->input->post('old_password');
		
		if ($new_password == '' && $old_password != '') {
			$password = $old_password;
		} else {
			$password = md5($new_password);
		}
		
		$result = $this->user_model->update_current_user(
			$this->input->post('id'), array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => $password,
				'skpd_id' => $this->input->post('skpd_id'),
				'level' => $this->input->post('level'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_update_password() {
		$new_password = $this->input->post('password');
		$old_password = $this->input->post('old_password');
		
		if ($new_password == '' && $old_password != '') {
			$password = $old_password;
		} else {
			$password = md5($new_password);
		}
		
		$result = $this->user_model->update(
			$this->input->post('id'), array(
				'password' => $password,
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
	public function do_delete() {
		$id = $this->input->post('id');
		
		if ($this->user_model->delete($id))
			echo 'success';
	}
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_page extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('static_page_model');
		$this->load->library('pagination');
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
			
			default : {
				$title = 'Tentang JDIH';
			}
		}
		
		$data['title'] = $title;
		$data['slug'] = $this->uri->segment(5);
		
		$this->load->view('/admin/static_page/' . ($data['static_page'] ? 'edit' : 'add'), $data);
	}
	
	public function do_insert() {
		$result = $this->static_page_model->insert(array(
			'static_page_title' => $this->input->post('static_page_title'),
			'static_page_content' => $this->input->post('static_page_content'),
			'slug' => $this->input->post('slug'),
			'category' => $this->input->post('category'),
			'is_publish' => $this->input->post('is_publish'),
			'published_at' => $this->input->post('published_at'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->static_page_model->update(
			$this->input->post('id'), array(
				'static_page_title' => $this->input->post('static_page_title'),
				'static_page_content' => $this->input->post('static_page_content'),
				'slug' => $this->input->post('slug'),
				'category' => $this->input->post('category'),
				'is_publish' => $this->input->post('is_publish'),
				'published_at' => $this->input->post('published_at'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
}
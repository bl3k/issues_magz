<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social_media extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('social_media_model');
		$this->load->library('pagination');
	}
	
	public function index()	{
		$data['social_media'] = $this->social_media_model->get_single_record();
		
		$this->load->view('/admin/social_media/' . ($data['social_media'] ? 'edit' : 'add'), $data);
	}
	
	public function do_insert() {
		$result = $this->social_media_model->insert(array(
			'facebook_url' => $this->input->post('facebook_url'),
			'google_plus_url' => $this->input->post('google_plus_url'),
			'instagram_url' => $this->input->post('instagram_url'),
			'linkedin_url' => $this->input->post('linkedin_url'),
			'picasa_url' => $this->input->post('picasa_url'),
			'twitter_url' => $this->input->post('twitter_url'),
			'youtube_url' => $this->input->post('youtube_url'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$result = $this->social_media_model->update(
			$this->input->post('id'), array(
				'facebook_url' => $this->input->post('facebook_url'),
				'google_plus_url' => $this->input->post('google_plus_url'),
				'instagram_url' => $this->input->post('instagram_url'),
				'linkedin_url' => $this->input->post('linkedin_url'),
				'picasa_url' => $this->input->post('picasa_url'),
				'twitter_url' => $this->input->post('twitter_url'),
				'youtube_url' => $this->input->post('youtube_url'),
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username')
			)
		);
		
		if ($result)
			echo 'success';
	}
	
}
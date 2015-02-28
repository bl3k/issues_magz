<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('gallery_model');
		$this->load->library('simpleimage');
	}
	
	public function index()	{
		$search_phrase = $this->input->post('searchPhrase');
		$data['total_records'] = $this->gallery_model->get_count_records($search_phrase);
		$data['total_unpublish'] = $this->gallery_model->get_records_by_status(0);
		$data['total_publish'] = $this->gallery_model->get_records_by_status(1);
		
		$this->load->view('/admin/gallery/index', $data);
	}
	
	public function list_() {
		$current = (int) $this->input->post('current');
		$search_phrase = $this->input->post('searchPhrase');
		$row_count = $this->input->post('rowCount');
		$sort = $this->input->post('sort');
		$gallery_list = $this->gallery_model->get_all_records($current, $row_count, $sort, $search_phrase);
		$total = $this->gallery_model->get_count_records($search_phrase);
		
		$json = array(
			'current' => $current,
			'rowCount' => $row_count,
			'rows' => $gallery_list,
			'total' => $total
		);
		
		echo json_encode($json);
	}
	
	public function add() {
		$this->load->view('/admin/gallery/add');
	}
	
	public function edit($id) {
		$data['gallery'] = $this->gallery_model->get_record_by_id($this->uri->segment(5));
	
		$this->load->view('/admin/gallery/edit', $data);
	}
	
	public function do_insert() {
		$upload_path = './uploads/gallery';
		
		if ($_FILES) {
			$file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$file_name = md5($_FILES['file']['name']) . '.' . $file_ext;
			$file_thumb = md5($_FILES['file']['name']) . '_thumb.' . $file_ext;
			
			if ($_FILES['file']['type'] == 'image/png' || $_FILES['file']['type'] == 'image/jpg' || $_FILES['file']['type'] == 'image/jpeg') {
				if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . '/' . $file_name)) {
					echo 'error uploading file';				
				} else {
					$this->simpleimage->load($upload_path . '/' . $file_name)->thumbnail(640, 480)->save($upload_path . '/' . $file_name);
					$this->simpleimage->load($upload_path . '/' . $file_name)->thumbnail(180, 90)->save($upload_path . '/' . $file_thumb);
				}
			}
		} else {
			$file_name = '';
		}
		
		$result = $this->gallery_model->insert(array(
			'gallery_title' => $this->input->post('gallery_title'),
			'description' => $this->input->post('description'),
			'thumb_file' => $file_thumb,
			'file' => $file_name,
			'is_publish' => $this->input->post('is_publish'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username')
		));
			
		if ($result)
			echo 'success';
	}
	
	public function do_update() {
		$upload_path = './uploads/gallery';
		
		if ($_FILES) {
			$file_ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$file_name = md5($_FILES['file']['name']) . '.' . $file_ext;
			$file_thumb = md5($_FILES['file']['name']) . '_thumb.' . $file_ext;
			
			if ($this->input->post('old_file') != $file_name && $this->input->post('old_file') != '') {
				if (file_exists($upload_path . '/' . $this->input->post('old_file')))
					unlink($upload_path . '/' . $this->input->post('old_file'));
				
				if (file_exists($upload_path . '/' . $this->input->post('old_thumb_file')))
					unlink($upload_path . '/' . $this->input->post('old_thumb_file'));
			}
			
			if ($file_name != '') {
				if ($_FILES['file']['type'] == 'image/png' || $_FILES['file']['type'] == 'image/jpg' || $_FILES['file']['type'] == 'image/jpeg') {
					if (!move_uploaded_file($_FILES['file']['tmp_name'], $upload_path . '/' . $file_name)) {
						echo 'error uploading file';				
					} else {
						$this->simpleimage->load($upload_path . '/' . $file_name)->thumbnail(640, 480)->save($upload_path . '/' . $file_name);
						$this->simpleimage->load($upload_path . '/' . $file_name)->thumbnail(180, 90)->save($upload_path . '/' . $file_thumb);
					}
				}	
			}		
		} else {
			$file_name = $this->input->post('old_file');
			$file_thumb= $this->input->post('old_thumb_file');
		}
		
		$result = $this->gallery_model->update($this->input->post('id'), array(
			'gallery_title' => $this->input->post('gallery_title'),
			'description' => $this->input->post('description'),
			'thumb_file' => $file_thumb,
			'file' => $file_name,
			'is_publish' => $this->input->post('is_publish'),
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $this->session->userdata('username')
		));
		
		if ($result)
			echo 'success';
	}
	
	public function do_delete() {
		$upload_path = './uploads/gallery';
		$id = $this->input->post('id');
		
		$gallery = $this->gallery_model->get_record_by_id($id);
		
		if ($this->gallery_model->delete($id)) {
			unlink($upload_path . '/' . $gallery['file']);
			unlink($upload_path . '/' . $slider['thumb_file']);
			
			echo 'success';
		}
	}
	
}
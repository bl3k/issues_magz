<?php

class Social_media_model extends CI_Model {

	private $table_name = 'm_social_media';
	private $primary_key = 'social_media_id';

	/*
	 * constructor
	 * 
	 * @return void
	 *
	 */ 
	public function __construct() {
		parent::__construct();
	}

	/*
	 * get all records
	 * 
	 * @param int $per_page
	 * @param int $page
	 * @return array $result
	 * 
	 */
	public function get_all_records($per_page=0, $page=0) {
		if ($per_page > 0)
			$result = $this->db->limit($per_page, $page)->order_by('created_at', 'DESC')->get($this->table_name);
		else
			$result = $this->db->order_by('created_at', 'DESC')->get($this->table_name);
			
		return $result->result();
	}
	
	public function get_records_by_status($status) {
		$this->db->where('is_publish', $status);
		$this->db->from($this->table_name);
		
		$result = $this->db->count_all_results();

		return $result;
	}
	
	/*
	 * insert data
	 * 
	 * @param array $data
	 * @return int $result
	 * 
	 */
	public function insert(array $data) {
		$this->db->insert($this->table_name, $data);

		$result = $this->db->affected_rows();

		return $result;
	}

	/*
	 * update data
	 * 
	 * @param array $data
	 * @return int $result
	 * 
	 */
	public function update($id, array $data) {
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $data);

		$result = $this->db->affected_rows();

		return $result;
	}

	/*
	 * delete data
	 * 
	 * @param int $id
	 * @return int $result
	 * 
	 */
	public function delete($id) {
		$this->db->where($this->primary_key, $id);
		$this->db->delete($this->table_name);

		$result = $this->db->affected_rows();

		return $result;
	}

	/*
	 * get data by id
	 * 
	 * @param int $id
	 * @return array $result
	 * 
	 */
	public function get_record_by_id($id) {
		$this->db->where($this->primary_key, $id);

		$result = $this->db->get($this->table_name);

		return $result->row_array();
	}
	
	/*
	 * get single record
	 * 
	 * @return array $result
	 * 
	 */
	public function get_single_record() {
		$result = $this->db->get($this->table_name);

		return $result->row_array();
	}
	
	/*
	 * get data by custom parameter(s)
	 * 
	 * @param array $params
	 * @return array $result
	 * 
	 */
	public function get_record_by_params(array $data) {
		$this->db->where(key($data), $data[key($data)]);

		$result = $this->db->get($this->table_name);

		return $result->row_array();
	}
	
	/*
	 * updated record's view counter
	 * 
	 * @param int $id
	 * @return void
	 * 
	 */
	public function update_counter($id) {
		$this->db->where($this->primary_key, $id);
		$hit_counter = $this->db->get($this->table_name)->row()->hit_counter;
		
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, array('hit_counter' => $hit_counter + 1));
	}

	public function get_records_for_fp() {
		$result = $this->db->get($this->table_name);

		return $result->row_array();
	}
}

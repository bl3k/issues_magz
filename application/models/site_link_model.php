<?php

class Site_link_model extends CI_Model {

	private $table_name = 'm_site_link';
	private $primary_key = 'site_link_id';

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
	 * @param int $current
	 * @param int $row_count
	 * @param array $sort
	 * @params string $search_phrase
	 * @return mixed $result
	 * 
	 */
	public function get_all_records($current=0, $row_count=0, $sort=array(), $search_phrase='') {
		$offset = ($current == 1) ? $current - 1 : ($current - 1) * $row_count;
		
		$where = 'OR news_title LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR url LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR is_publish=' . (($search_phrase == '' || !is_int($search_phrase)) ? -1 : $search_phrase);
		
		$result = $this->db->limit($row_count, $offset);
			
		if ($sort) {
			$result = $result->order_by(key($sort), $sort[key($sort)]);
		} else {
			$result = $result->order_by('created_at', 'desc');
		}
		
		if ($search_phrase != '') {
			$result = $result->where($where, null, false);
		}
		
		$result = $result->get($this->table_name);
		
		return $result->result();
	}
	
	/*
	 * get total records
	 * 
	 * @param string $search_phrase
	 * @return int $result
	 * 
	 */
	public function get_count_records($search_phrase='') {
		$where = 'OR title LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR url LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR is_publish=' . (($search_phrase == '' || !is_int($search_phrase)) ? -1 : $search_phrase);
		
		if ($search_phrase != '') {
			$result = $this->db->where($where, null, false)->count_all_results($this->table_name);
		} else {
			$result = $this->db->count_all_results($this->table_name);	
		}
		
		return $result;
	}
	
	/*
	 * get records by status criteria
	 * 
	 * @param string $statis
	 * @return mixed $result
	 * 
	 */
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
	 * get data by custom parameter(s)
	 * 
	 * @param array $params
	 * @return array $result
	 * 
	 */
	public function get_record_by_params(array $data) {
		$this->db->where('is_publish', $data['is_publish']);
		$this->db->order_by('created_at', 'desc')->limit(5);

		$result = $this->db->get($this->table_name);

		return $result->result();
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
	
	public function get_records_for_fp($is_publish) {
		$this->db->where('is_publish', $is_publish);
		$this->db->order_by('created_at', 'desc')->limit(5);

		$result = $this->db->get($this->table_name);

		return $result->result();
	}

}

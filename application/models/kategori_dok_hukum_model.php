<?php

class Kategori_dok_hukum_model extends CI_Model {

	private $table_name = 'm_kategori_dok_hukum';
	private $primary_key = 'kategori_dok_hukum_id';

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
		
		$where = 'judul LIKE \'%' . $search_phrase . '%\' ';
		
		$result = $this->db->limit($row_count, $offset);
			
		if ($sort) {
			$result = $result->order_by(key($sort), $sort[key($sort)]);
		} else {
			$result = $result->order_by('created_at', 'asc');
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
		$where = 'judul LIKE \'%' . $search_phrase . '%\' ';
		
		if ($search_phrase != '') {
			$result = $this->db->where($where, null, false)->count_all_results($this->table_name);
		} else {
			$result = $this->db->count_all_results($this->table_name);	
		}
		
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
	
	public function populate_combo() {
		$result = $this->db->get($this->table_name);
		
		return $result->result();
	}

}

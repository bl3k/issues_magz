<?php

class Publication extends CI_Model {
	
	private $table_name = 'publications';
	private $primary_key = 'id';
	
	public function get_all_records() {
		$result = $this->db->get($this->table_name);
		
		return $result;
	}
	
	public function get_record_by_id($id) {
		$this->db->where($this->primary_key, $id);
		
		$result = $this->db->get($this->table_name);
		
		return $result->row_array();
	}
	
	public function get_records_by_params(array $params) {
		for ($i=0; $i < count($params); $i++) {
			$this->db->where(key($params[$i]), $params[key($params[$i])]);
		}
		
		$result = $this->db->get($this->table_name);
		
		return $result->result();
	}
	
	public function insert(array $data) {
		$this->db->insert_string($this->table_name, $data);
		
		$result = $this->db->affected_rows();
		
		return $result;
	}
	
	public function update($id, array $data) {
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, $data);
		
		$result = $this->db->affected_rows();
		
		return $result;
		
	}
	
	public function delete($id) {
		$this->db->where($this->primary_key, $id);
		$this->db->delete($this->table_name);
		
		$result = $this->db->affected_rows();
		
		return $result;
	}
}

<?php

class Publication extends CI_Model {
	
	private $table_name = 'publications';
	private $primary_key = 'id';
	
	public function get_all_records() {
		$result = $this->db->get($this->table_name);
		
		return $result;
	}
}

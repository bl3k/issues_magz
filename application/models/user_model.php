<?php

class User_model extends CI_Model {

	private $table_name = 'm_user';
	private $primary_key = 'user_id';

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
		
		$where = 'name LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR username LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR is_active=' . (($search_phrase == '' || !is_int($search_phrase)) ? -1 : $search_phrase);
		
		$result = $this->db->limit($row_count, $offset);
			
		if ($sort) {
			$result = $result->order_by(key($sort), $sort[key($sort)]);
		} else {
			$result = $result->order_by($this->table_name . '.created_at', 'desc');
		}
		
		if ($search_phrase != '') {
			$result = $result->where($where, null, false);
		}
		
		$this->db->join('m_skpd_user', 'm_skpd_user.user_id=' . $this->table_name . '.user_id', 'left');
		$this->db->join('m_skpd', 'm_skpd.skpd_id=' . 'm_skpd_user.skpd_id', 'left');
		$this->db->where($this->table_name . '.' . $this->primary_key . ' !=', $this->session->userdata('user_id'));
		
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
		$where = 'name LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR username LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR is_active=' . (($search_phrase == '' || !is_int($search_phrase)) ? -1 : $search_phrase);
		
		if ($search_phrase != '') {
			$result = $this->db
				->where($where, null, false)
				->where($this->primary_key . ' !=', $this->session->userdata('user_id'))
				->count_all_results($this->table_name);
		} else {
			$result = $this->db
				->where($this->primary_key . ' !=', $this->session->userdata('user_id'))
				->count_all_results($this->table_name);	
		}
		
		return $result;
	}
	
	/*
	 * get record's count by criteria status
	 * 
	 * @param int $status
	 * @return int $result
	 * 
	 */
	public function get_records_by_status($status) {
		$this->db->where('is_active', $status);
		$this->db->where($this->primary_key . ' !=', $this->session->userdata('user_id'));
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
		$this->db->trans_start();
		$this->db->insert($this->table_name, array(
			'name' => $data['name'],
			'is_active' => $data['is_active'],
			'password' => $data['password'],
			'username' => $data['username'],
			'created_at' => $data['created_at'],
			'created_by' => $data['created_by']
		));
		
		$last_id = $this->db->insert_id();
		
		$this->db->insert('m_skpd_user', array(
			'level' => $data['level'],
			'skpd_id' => $data['skpd_id'],
			'user_id' => $last_id,
			'created_at' => $data['created_at'],
			'created_by' => $data['created_by']
		));
		
		$result = $this->db->trans_complete();

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
		$this->db->trans_start();
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, array(
			'name' => $data['name'],
			'is_active' => $data['is_active'],
			'password' => $data['password'],
			'username' => $data['username'],
			'updated_at' => $data['updated_at'],
			'updated_by' => $data['updated_by']
		));
	
		$this->db->where($this->primary_key, $id);
		$this->db->update('m_skpd_user', array(
			'level' => $data['level'],
			'skpd_id' => $data['skpd_id'],
			'user_id' => $id,
			'updated_at' => $data['updated_at'],
			'updated_by' => $data['updated_by']
		));

		$result = $this->db->trans_complete();
		
		return $result;
	}

	/*
	 * update current user data
	 * 
	 * @param array $data
	 * @return int $result
	 * 
	 */
	public function update_current_user($id, array $data) {
		$this->db->trans_start();
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, array(
			'name' => $data['name'],
			'password' => $data['password'],
			'username' => $data['username'],
			'updated_at' => $data['updated_at'],
			'updated_by' => $data['updated_by']
		));
	
		$this->db->where($this->primary_key, $id);
		$this->db->update('m_skpd_user', array(
			'level' => $data['level'],
			'skpd_id' => $data['skpd_id'],
			'user_id' => $id,
			'updated_at' => $data['updated_at'],
			'updated_by' => $data['updated_by']
		));

		$result = $this->db->trans_complete();
		
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
		$this->db->trans_start();
		$this->db->where($this->primary_key, $id);
		$this->db->delete($this->table_name);
		$this->db->where($this->primary_key, $id);
		$this->db->delete('m_skpd_user');
		
		$result = $this->db->trans_complete();

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
		$this->db->where($this->table_name . '.' . $this->primary_key, $id);
		$this->db->join('m_skpd_user', 'm_skpd_user.user_id=' . $this->table_name . '.user_id', 'left');
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
		$this->db->where('username', $data['username']);
		$this->db->where('password', md5($data['password']));
		$this->db->where('is_active', 1);

		$result = $this->db->get($this->table_name);

		return $result->row();
	}
	
	/*
	 * update single column value
	 *
	 * @param int $id
	 * @param string $col_name
	 * @param mixed $val
	 * @return int $result
	 * 
	 */
	public function update_single_col($id, $col_name, $val) {
		$this->db->where($this->primary_key, $id);
		$this->db->update($this->table_name, array($col_name => $val));

		$result = $this->db->affected_rows();

		return $result;
	}
}

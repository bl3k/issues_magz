<?php

class Ranham_model extends CI_Model {

	private $table_name = 'm_ranham';
	private $primary_key = 'ranham_id';

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
		
		$where = 'tahun LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR semester LIKE \'%' . $search_phrase . '%\' ';
		
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
		$where = 'tahun LIKE \'%' . $search_phrase . '%\' ';
		$where .= 'OR semester LIKE \'%' . $search_phrase . '%\' ';
		
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
		$this->db->trans_start();
		$this->db->insert($this->table_name, array(
			'semester' => $data['semester'],
			'skpd_id' => $data['skpd_id'],
			'tahun' => $data['tahun'],
			'created_at' => $data['created_at'],
			'created_by' => $data['created_by']
		));
		
		$last_id = $this->db->insert_id();
		
		$this->db->insert('m_ranham_detail', array(
			'kegiatan' => $data['kegiatan'],
			'permasalahan' => $data['permasalahan'],
			'program' => $data['program'],
			'sasaran' => $data['sasaran'],
			'ranham_id' => $last_id
		));
		
		$last_id = $this->db->insert_id();
		
		$this->db->insert('m_capaian', array(
			'target_jumlah' => $data['target_jumlah'],
			'outcome' => $data['outcome'],
			'hambatan' => $data['hambatan'],
			'tindak_lanjut' => $data['tindak_lanjut'],
			'ranham_detail_id' => $last_id
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
			'semester' => $data['semester'],
			'skpd_id' => $data['skpd_id'],
			'tahun' => $data['tahun'],
			'updated_at' => $data['updated_at'],
			'updated_by' => $data['updated_by']
		));
		
		$this->db->where($this->primary_key, $id);
		$this->db->update('m_capaian', array(
			'target_jumlah' => $data['target_jumlah'],
			'outcome' => $data['outcome'],
			'hambatan' => $data['hambatan'],
			'tindak_lanjut' => $data['tindak_lanjut'],
			'ranham_id' => $id
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
		$this->db->delete('m_capaian');

		$result = $this->db->trans_complete();

		return $result;
	}

	/*
	 * get data by custom parameter(s)
	 * 
	 * @param array $params
	 * @return mixed $result
	 * 
	 */
	public function get_records_by_params(array $data) {
		$this->db->where(key($data), $data[key($data)]);
		$this->db->join('m_ranham_detail', 'm_ranham_detail.ranham_id=' . $this->table_name . '.' . $this->primary_key, 'left');
		
		$result = $this->db->get($this->table_name);

		return $result->result();
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
		$result = $this->db->get($this->table_name);

		return $result->row_array();
	}
	
}

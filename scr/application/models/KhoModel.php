<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class KhoModel extends CI_Model {
	
		public function getData()
		{
			$this->db->select('*');
			$data = $this->db->get('kho');
			$data = $data->result_array();
			return $data;
		}
		public function XemKho()
		{
			$this->db->select('*');
			return $this->db->get('kho');
		}
		public function ThemKho($tenkho, $vitri)
		{
			$data = array(
				'makho' => "",
				'tenkho' => $tenkho,
				'vitri' => $vitri
			);
			$this->db->insert('kho', $data);
			return $this->db->insert_id();
		}
		public function XoaKho($table, $makho)
		{
			return $this->db->delete($table, array('makho' => $makho));
		}
		public function SuaKho($makho, $tenkho, $vitri)
		{
			$data = array(
				'tenkho' => $tenkho,
				'vitri' => $vitri
			);
			$this->db->where('makho', $makho);
			$this->db->update('kho', $data);
		}
	
	}
	
	/* End of file KhoModel.php */
	

?>
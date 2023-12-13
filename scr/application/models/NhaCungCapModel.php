<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NhaCungCapModel extends CI_Model {
	
		public function getData()
		{
			$this->db->select('*');
			$data = $this->db->get('nhacc');
			$data = $data->result_array();
			return $data;
		}
		public function getDataByMaNCC($mancc)
		{
			$this->db->select('*');
			$this->db->where('MaNCC',$mancc);
			$data = $this->db->get('nhacc');
			$data = $data->result_array();
			return $data;
		}
		public function ThemNCC($tenncc, $emailncc, $sdtncc, $diachincc, $wsncc)
		{
			$data = array(
				'TenNCC' => $tenncc,
				'Email' => $emailncc,
				'SDT' => $sdtncc,
				'DiaChi' => $diachincc,
				'Website' => $wsncc
			);

			$this->db->insert('nhacc', $data);
		}

		public function SuaNCC($mancc, $tenncc, $email, $sdt, $diachi, $website)
		{
			$data = array(
					'TenNCC' => $tenncc,
					'Email' => $email,
					'SDT' => $sdt,
					'DiaChi' => $diachi,
					'Website' => $website
			);
			$this->db->where('MaNCC', $mancc);
			$this->db->update('nhacc', $data);
		}
		public function XoaNCC($mancc)
		{
			$this->db->where('MaNCC', $mancc);
			$this->db->delete('nhacc');
		}
	}
	
	/* End of file NhaCungCapModel.php */
	

?>
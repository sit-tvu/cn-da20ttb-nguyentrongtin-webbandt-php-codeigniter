<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class KhachHangModel extends CI_Model {
	
		public function getData()
		{
			$this->db->select('*');
			$data = $this->db->get('khachhang');
			$data = $data->result_array();
			return $data;
		}

		public function getDataByMaKH($makh)
		{
			$this->db->select('*');
			$this->db->where('MaKH', $makh);
			$data = $this->db->get('khachhang');
			$data = $data->result_array();
			return $data;
		}
		public function XoaKH($makh)
		{
			$this->db->where('MaKH', $makh);
			$this->db->delete('khachhang');
		}
	}
	
	/* End of file KhachHangModel.php */
	

?>

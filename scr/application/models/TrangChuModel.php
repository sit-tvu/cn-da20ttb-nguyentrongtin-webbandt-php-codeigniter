<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class TrangChuModel extends CI_Model {
	
		public function getData()
		{
			$this->db->limit(8);
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$this->db->order_by('sanpham.masp', 'desc');
			$data = $this->db->get('sanpham');
			$data = $data->result_array();
			return $data;
		}
	
	}
	
	/* End of file TrangChuModel.php */
	

?>

<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class HoTroModel extends CI_Model {
	
		public function getData()
		{
			// get data binhluan
			$this->db->select('*');
			$this->db->join('sanpham', 'binhluan.MaSP = sanpham.masp');
			$this->db->join('thongtinsp', 'binhluan.MaTTSP = thongtinsp.mattsp');
			$this->db->join('khachhang', 'binhluan.MaKH = khachhang.makh');
			$this->db->order_by('MaBL', 'desc');
			$data = $this->db->get('binhluan');
			return $data->result_array();
		}
		public function XoaBL($mabl)
		{
			$this->db->where('MaBL', $mabl);
			$this->db->delete('binhluan');	
		}
	
	}
	
	/* End of file HoTroModel.php */
	

?>
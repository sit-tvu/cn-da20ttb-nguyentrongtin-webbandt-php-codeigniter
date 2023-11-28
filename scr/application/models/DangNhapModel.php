<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class DangNhapModel extends CI_Model {
	
		function validateNV($email,$password){
			$this->db->where('Email',$email);
			$this->db->where('MatKhau',$password);
			$result = $this->db->get('nhanvien');
			return $result;
		}
		function validateKH($email,$password){
			$this->db->where('Email',$email);
			$this->db->where('MatKhau',$password);
			$result = $this->db->get('khachhang');
			return $result;
		}
		// các data cần lưu vào session
		// đếm đơn hàng chưa giao
		public function countDonHang0()
		{
			$this->db->where('TinhTrangGH',0);
			$result = $this->db->get('giaohang');
			$result = $result->num_rows();
			return $result;
		}
		// đếm hóa đơn chưa duyệt
		public function countHoaDon0()
		{
			$this->db->where('TinhTrangTT',0);
			$result = $this->db->get('hoadon');
			$result = $result->num_rows();
			return $result;
		}
		public function countSPTrongGio($makh)
		{
			$this->db->where('MaKH',$makh);
			$result = $this->db->get('giohang');
			$result = $result->num_rows();
			return $result;
		}
	}
	
	/* End of file DangNhapModel.php */
	

?>
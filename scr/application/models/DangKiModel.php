<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class DangKiModel extends CI_Model {
	
		function validateNV($email){
			$this->db->where('Email',$email);
			$result = $this->db->get('nhanvien');
			return $result;
		}
		function validateKH($email){
			$this->db->where('Email',$email);
			$result = $this->db->get('khachhang');
			return $result;
		}
		public function DangKi($hoten, $gioitinh, $sdt, $email, $matkhau, $cmnd, $diachi)
		{
			$data = array(
				'TenKH' => $hoten,
				'GioiTinh' => $gioitinh,
				'SDT' => $sdt,
				'Email' => $email,
				'MatKhau' => $matkhau,
				'CMND' => $cmnd,
				'DiaChi' => $diachi,
				'LoaiKH' => 'Bình thường'
			);
			$this->db->insert('khachhang', $data);
		}
	
	}
	
	/* End of file DangKiModel.php */
	

?>

<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class TTTKModel extends CI_Model {
	
		public function getDataNV($manv)
		{
			$this->db->select('*');
			$this->db->where('MaNV', $manv);
			$data = $this->db->get('nhanvien');
			$data =  $data->result_array();
			return $data;
		}
		public function getDataKH($makh)
		{
			$this->db->select('*');
			$this->db->where('MaKH', $makh);
			$data = $this->db->get('khachhang');
			$data =  $data->result_array();
			return $data;
		}
		public function SuaNV($manv, $matkhau)
		{
			$data = array(
				'MatKhau' => $matkhau
			);
			$this->db->where('MaNV', $manv);
			$this->db->update('nhanvien', $data);
		}
		public function SuaKH($makh, $tenkh, $gioitinh, $sdt, $email, $matkhau, $cmnd, $diachi, $loaikh)
		{
			$data = array(
				'TenKH' => $tenkh,
				'GioiTinh' => $gioitinh,
				'SDT' => $sdt,
				'Email' => $email,
				'MatKhau' => $matkhau,
				'CMND' => $cmnd,
				'DiaChi' => $diachi,
				'LoaiKH' => $loaikh
			);
			$this->db->where('MaKH', $makh);
			$this->db->update('khachhang', $data);
		}
	
	}
	
	/* End of file TTTKModel.php */
	

?>
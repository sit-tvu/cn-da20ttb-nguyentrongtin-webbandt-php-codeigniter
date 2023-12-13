<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NhanVienModel extends CI_Model {
	
		public function getData()
		{
			$this->db->select('*');
			$data = $this->db->get('nhanvien');
			$data = $data->result_array();
			return $data;
		}
		public function getDataByMaNV($manv)
		{
			$this->db->select('*');
			$this->db->where('MaNV', $manv);
			$data = $this->db->get('nhanvien');
			$data = $data->result_array();
			return $data;
		}
		public function ThemNV($tennv, $ngayvl, $luong, $sdt, $email, $cmnd, $loainv, $diachi)
		{
			$data = array(
				'TenNV' => $tennv,
				'NgayVL' => $ngayvl,
				'Luong' => $luong,
				'SDT' => $sdt,
				'Email' => $email,
				'CMND' => $cmnd,
				'MatKhau' => "11111111",
				'DiaChi' => $diachi,
				'LoaiNV' => $loainv,
			);
			$this->db->insert('nhanvien', $data);
		}
		public function SuaNV($manv, $tennv, $ngayvl, $luong, $sdt, $email, $cmnd, $loainv, $diachi)
		{
			$data = array(
				'TenNV' => $tennv,
				'NgayVL' => $ngayvl,
				'Luong' => $luong,
				'SDT' => $sdt,
				'Email' => $email,
				'CMND' => $cmnd,
				'DiaChi' => $diachi,
				'LoaiNV' => $loainv,
			);
			$this->db->where('MaNV', $manv);
			$this->db->update('nhanvien', $data);
		}
		public function XoaNV($manv)
		{
			$this->db->where('MaNV', $manv);
			$this->db->delete('nhanvien');
		}
		
	}
	
	/* End of file NhanVienModel.php */
	

?>

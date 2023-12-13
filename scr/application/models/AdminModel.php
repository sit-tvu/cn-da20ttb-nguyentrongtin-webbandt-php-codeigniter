<?php 


	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminModel extends CI_Model {
	
		// public function getData()
		// {
		// 	$this->db->select('*');
		// 	// $this->db->from('sanpham');
		// 	$this->db->join('khachhang', 'khachhang.MaKH = hoadon.MaKH');
		// 	$this->db->where('hoadon.TinhTrangTT', 0);
		// 	$this->db->order_by('hoadon.MaHD', 'desc');
		// 	$data = $this->db->get('hoadon');
		// 	$data = $data->result_array();
		// 	return $data;
		// }
		public function getData($trang)
		{
			$SoSPTrongTrang = 10;
			if($trang == 0) {
				$trang = 1;
			}
			$offset = ($trang - 1) * $SoSPTrongTrang;
			$this->db->select('*');
			// $this->db->from('sanpham');
			$this->db->join('khachhang', 'khachhang.MaKH = hoadon.MaKH');
			$this->db->join('giaohang', 'giaohang.MaHD = hoadon.MaHD');
			$this->db->where('hoadon.TinhTrangTT', 0);
			$this->db->order_by('hoadon.MaHD', 'desc');
			$data = $this->db->get('hoadon', $SoSPTrongTrang, $offset);
			$data = $data->result_array();
			return $data;
		}
		public function getSoTrang()
		{
			$SoSPTrongTrang = 10;
			$this->db->select('*');
			$res = $this->db->get('hoadon');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function countSP()
		{
			$this->db->select('count(*) as total');
			$data = $this->db->get('thongtinsp');
			$data = $data->result_array();
			return $data;
		}
		public function countTT()
		{
			$this->db->select('count(*) as total');
			$data = $this->db->get('tintuc');
			$data = $data->result_array();
			return $data;
		}
		public function countNV()
		{
			$this->db->select('count(*) as total');
			$data = $this->db->get('nhanvien');
			$data = $data->result_array();
			return $data;
		}
		public function countGH()
		{
			$this->db->select('count(*) as total');
			$data = $this->db->get('giaohang');
			$data = $data->result_array();
			return $data;
		}
		public function ThanhToan($mahd, $sotiennhan)
		{
			$data = array(
				"SoTienNhan" => $sotiennhan
			);
			$this->db->where('MaHD', $mahd);
			$this->db->update('hoadon', $data);
		}
	
	}
	
	/* End of file AdminModel.php */
	


?>

<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class HoaDonModel extends CI_Model {
	
		// public function getData()
		// {
		// 	$this->db->select('*');
		// 	$this->db->join('khachhang', 'khachhang.MaKH = hoadon.MaKH');
		// 	$this->db->join('khuyenmai', 'khuyenmai.MaKM = hoadon.MaKM');
		// 	$this->db->join('giaohang', 'giaohang.MaHD = hoadon.MaHD');
		// 	$this->db->where('hoadon.TinhTrangTT', 1);
		// 	// $this->db->join('cthd', 'cthd.MaHD = hoadon.MaHD');
		// 	// $this->db->join('sanpham', 'sanpham.masp = cthd.MaSP');
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
			$this->db->join('khuyenmai', 'khuyenmai.MaKM = hoadon.MaKM');
			$this->db->join('giaohang', 'giaohang.MaHD = hoadon.MaHD');
			$this->db->where('hoadon.TinhTrangTT', 1);
			$this->db->order_by('hoadon.MaHD', 'desc');
			$data = $this->db->get('hoadon', $SoSPTrongTrang, $offset);
			$data = $data->result_array();
			return $data;
		}
		public function getSoTrang()
		{
			$SoSPTrongTrang = 9;
			$this->db->select('*');
			$res = $this->db->get('hoadon');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		// public function getDataGiaoHang()
		// {
		// 	$this->db->select('*');
		// 	$this->db->join('giaohang', 'giaohang.MaHD = hoadon.MaHD');
		// 	$this->db->join('cthd', 'cthd.MaHD = hoadon.MaHD');
		// 	$data = $this->db->get('hoadon');
		// 	$data = $data->result_array();
		// 	return $data;
		// }
		public function getDataByMaHD($mahd)
		{
			$this->db->select('*');
			$this->db->join('khachhang', 'khachhang.MaKH = hoadon.MaKH');
			$this->db->join('khuyenmai', 'khuyenmai.MaKM = hoadon.MaKM');
			$this->db->join('giaohang', 'giaohang.MaHD = hoadon.MaHD');
			$this->db->join('cthd', 'cthd.MaHD = hoadon.MaHD');
			$this->db->join('sanpham', 'sanpham.masp = cthd.MaSP');
			$this->db->where('hoadon.MaHD', $mahd);
			$data = $this->db->get('hoadon');
			$data = $data->result_array();
			return $data;
		}
		public function XoaHD($mahd)
		{
			$this->db->where('MaHD', $mahd);
			$this->db->delete('hoadon');
		}
		public function XoaCTHD($mahd)
		{
			$this->db->where('MaHD', $mahd);
			$this->db->delete('cthd');
		}
		public function HoaDonKhachHang($makh)
		{
			$this->db->select('*');
			$this->db->join('cthd', 'cthd.MaHD = hoadon.MaHD');
			$this->db->join('sanpham', 'sanpham.masp = cthd.MaSP');
			$this->db->join('giaohang', 'giaohang.MaHD = hoadon.MaHD');
			$this->db->where('hoadon.MaKH', $makh);
			$this->db->order_by('hoadon.MaHD', 'desc');
			$data = $this->db->get('hoadon');
			$data = $data->result_array();
			return $data;
		}
		public function CTHD($mahd)
		{
			$this->db->select('*');
			$this->db->join('sanpham', 'sanpham.masp = cthd.MaSP');
			$this->db->where('cthd.MaHD', $mahd);
			$data = $this->db->get('cthd');
			$data = $data->result_array();
			return $data;
		}
	
	}
	
	/* End of file HoaDonModel.php */
	

?>
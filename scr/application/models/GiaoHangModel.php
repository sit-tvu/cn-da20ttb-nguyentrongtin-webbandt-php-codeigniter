<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class GiaoHangModel extends CI_Model {
	
		// public function getData()
		// {
		// 	$this->db->select('*');
		// 	$this->db->join('hoadon', 'hoadon.MaHD = giaohang.MaHD');
		// 	$this->db->join('nhanvien', 'nhanvien.MaNV = giaohang.MaNV');
		// 	$data = $this->db->get('giaohang');
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
			$this->db->select('giaohang.MaHD, nhanvien.TenNV, nhanvien.SDT, khachhang.TenKH, khachhang.DiaChi as DiaChiKH, khachhang.SDT as SDTKH, giaohang.TinhTrangGH');
			// $this->db->from('sanpham');
			$this->db->join('hoadon', 'hoadon.MaHD = giaohang.MaHD');
			$this->db->join('khachhang', 'khachhang.MaKH = hoadon.MaKH');
			$this->db->join('nhanvien', 'nhanvien.MaNV = giaohang.MaNV');
			$this->db->order_by('giaohang.MaHD', 'desc');
			$data = $this->db->get('giaohang', $SoSPTrongTrang, $offset);
			$data = $data->result_array();
			return $data;
		}
		public function getSoTrang()
		{
			$SoSPTrongTrang = 10;
			$this->db->select('*');
			$res = $this->db->get('giaohang');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function XacNhanGH($mahd)
		{
			$data = array(
				"TinhTrangGH" => 1
			);
			$this->db->where('MaHD', $mahd);
			$this->db->update('giaohang', $data);
		}
		public function XoaGH($mahd)
		{
			$this->db->where('MaHD', $mahd);
			$this->db->delete('giaohang');
		}
	}
	
	/* End of file GiaoHangModel.php */
	

?>
<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class GioHangModel extends CI_Model {
	
		public function getData($makh)
		{
			$this->db->select('*');
			// $this->db->distinct();
			$this->db->join('sanpham', 'sanpham.masp = giohang.MaSP');
			$this->db->join('thongtinsp', 'giohang.MaTTSP = thongtinsp.mattsp');
			// $this->db->join('sanpham', 'giohang.MaTTSP = thongtinsp.mattsp');
			$this->db->where('giohang.MaKH', $makh);
			// $this->db->where('thongtinsp.mattsp', $mattsp);
			$data = $this->db->get('giohang');
			$data = $data->result_array();
			return $data;
		}
		public function TongTienSP($makh)
		{
			$this->db->select('SUM(thongtinsp.GiaKM * giohang.SoLuongMua) as tongtien');
			$this->db->join('thongtinsp', 'thongtinsp.mattsp = giohang.MaTTSP');
			// $this->db->where('giohang.MaHD', $mahd);
			$this->db->where('giohang.MaKH', $makh);
			$data = $this->db->get('giohang');
			$data = $data->result_array();
			return $data;
		}
		public function getNVGiaoHang()
		{
			$this->db->select('*');
			$this->db->where('LoaiNV', 'Giao Hàng');
			$data = $this->db->get('nhanvien');
			$data = $data->result_array();
			return $data;
		}
		public function XoaSPTrongGio($masp, $mattsp, $makh)
		{
			$this->db->where('MaSP', $masp);
			$this->db->where('MaTTSP', $mattsp);
			$this->db->where('MaKH', $makh);
			$this->db->delete('giohang');
		}
		public function DemSoLuongSP($mattsp)
		{
			$this->db->select('SUM(SoLuong) as total');
			$this->db->where('mattsp', $mattsp);
			$data = $this->db->get('thongtinsp');
			$data = $data->result_array();
			return $data;
		}
		public function TaoHoaDon($makh, $makm, $tongtientt, $ngaylaphd, $tinhtrangtt, $sotiennhan, $sotientra)
		{
			$data = array(
				'MaKH' => $makh,
				'MaKM' => $makm,
				'TongTienTT' => $tongtientt,
				'NgayLapHD' => $ngaylaphd,
				'TinhTrangTT' => $tinhtrangtt,
				'SoTienNhan' => $sotiennhan,
				'SoTienTra' => $sotientra
			);
			$this->db->insert('hoadon', $data);
		}
		public function TaoCTHD($idhoadon, $masp, $mattsp, $soluong, $thanhtien)
		{
			$data = array(
				'MaHD' => $idhoadon,
				'MaSP' => $masp,
				'mattsp' => $mattsp,
				'SoLuong' => $soluong,
				'ThanhTien' => $thanhtien
			);
			$this->db->insert('cthd', $data);
		}
		public function TaoGiaoHang($mahd, $manv, $tinhtranggh)
		{
			$data = array(
				'MaHD' => $mahd,
				'MaNV' => $manv,
				'TinhTrangGH' => $tinhtranggh
			);
			$this->db->insert('giaohang', $data);
		}
	}
	/* End of file GioHangModel extends.php */
	

?>
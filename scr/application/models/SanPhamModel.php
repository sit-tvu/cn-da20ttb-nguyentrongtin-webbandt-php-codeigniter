<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SanPhamModel extends CI_Model {
	
		// get all SP
		public function getDataAllSP()
		{
			$this->db->join('loaisp', 'loaisp.MaLoaiSP = sanpham.maloaisp');
			$this->db->join('thuonghieu', 'thuonghieu.MaTH = sanpham.math');
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$data = $this->db->get('sanpham');
			$data = $data->result_array();
			return $data;
		}
		public function getDataOnlySP()
		{
			$this->db->select('*');
			$data = $this->db->get('sanpham');
			$data = $data->result_array();
			return $data;
		}
		public function getDataAllTTSP($masp)
		{
			$this->db->select('*');
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$this->db->where('sanpham.masp', $masp);
			$data = $this->db->get('sanpham');
			$data = $data->result_array();
			return $data;
		}
		// get data
		public function getDataSP($masp)
		{
			$this->db->join('loaisp', 'loaisp.MaLoaiSP = sanpham.maloaisp');
			$this->db->join('thuonghieu', 'thuonghieu.MaTH = sanpham.math');
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$this->db->where('sanpham.masp', $masp);
			$data = $this->db->get('sanpham');
			$data = $data->result_array();
			return $data;
		}
		public function getDataSP_TTSP($masp, $mattsp)
		{
			$this->db->join('loaisp', 'loaisp.MaLoaiSP = sanpham.maloaisp');
			$this->db->join('thuonghieu', 'thuonghieu.MaTH = sanpham.math');
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$this->db->where('sanpham.masp', $masp);
			$this->db->where('thongtinsp.mattsp', $mattsp);
			$data = $this->db->get('sanpham');
			$data = $data->result_array();
			return $data;
		}
		// get data by $trang
		public function getData($trang)
		{
			$SoSPTrongTrang = 7;
			if($trang == 0) {
				$trang = 1;
			}
			$offset = ($trang - 1) * $SoSPTrongTrang;
			$this->db->select('*');
			// $this->db->from('sanpham');
			$this->db->join('loaisp', 'loaisp.MaLoaiSP = sanpham.maloaisp');
			$this->db->join('thuonghieu', 'thuonghieu.MaTH = sanpham.math');
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$this->db->order_by('sanpham.masp', 'asc');
			$data = $this->db->get('sanpham', $SoSPTrongTrang, $offset);
			$data = $data->result_array();
			return $data;
		}
		// lấy số trang theo số sản phẩm trong trang
		public function getSoTrang()
		{
			$SoSPTrongTrang = 7;
			$this->db->select('*');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		// xóa thông tin sản phẩm
		public function XoaTTSP($ttsp)
		{
			$this->db->where('mattsp', $ttsp);
			$this->db->delete('thongtinsp');
		}
		// xóa sản phẩm
		public function XoaSP($table, $masp)
		{
			return $this->db->delete($table, array('masp' => $masp));
		}
		// cập nhật sản phẩm
		public function CapNhatSP($table, $masp, $tensp, $hinhanh, $mota, $maloaisp, $math)
		{
			$data = array(
				'masp' => $masp,
				'tensp' => $tensp,
				'hinhanh' => $hinhanh,
				'mota' => $mota,
				'maloaisp' => $maloaisp,
				'math' => $math
			);
			$this->db->set($data);
			$this->db->where('masp', $masp);
			return $this->db->update($table, $data);
		}
		public function CapNhatSPKhongHinhAnh($table, $masp, $tensp, $mota, $maloaisp, $math)
		{
			$data = array(
				'masp' => $masp,
				'tensp' => $tensp,
				'mota' => $mota,
				'maloaisp' => $maloaisp,
				'math' => $math
			);
			$this->db->set($data);
			$this->db->where('masp', $masp);
			return $this->db->update($table, $data);
		}
		// cập nhật thông tin sản phẩm
		public function CapNhatTTSP($table, $mattsp, $masp, $kho, $gia, $giakm, $soluong, $mausac, $ram, $bonhotrong, $pin, $kichthuocmanhinh, $cameratruoc, $camerasau, $cpu)
		{
			$data = array(
				'mattsp' => $mattsp,
				'masp' => $masp,
				'MaKho' => $kho,
				'Gia' => $gia,
				'GiaKM' => $giakm,
				'SoLuong' => $soluong,
				'mausac' => $mausac,
				'ram' => $ram,
				'bonhotrong' => $bonhotrong,
				'pin' => $pin,
				'kichthuongmanhinh' => $kichthuocmanhinh,
				'cameratruoc' => $cameratruoc,
				'camerasau' => $camerasau,
				'cpu' => $cpu
			);
			$this->db->where('mattsp', $mattsp);
			return $this->db->update($table, $data);
		}
	
	}
	
	/* End of file SanPhamModel.php */
	

?>
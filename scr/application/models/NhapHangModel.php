<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NhapHangModel extends CI_Model {
	
		public function getData()
		{
			$this->db->select('*');
			$this->db->join('nhanvien', 'phieunhap.MaNV = nhanvien.manv');
			$this->db->join('nhacc', 'nhacc.MaNCC = phieunhap.MaNCC');
			$this->db->join('ctpn', 'ctpn.MaPN = phieunhap.MaPN');
			$this->db->join('sanpham', 'ctpn.masp = sanpham.masp');
			$this->db->order_by('phieunhap.MaPN', 'asc');
			$data = $this->db->get('phieunhap');
			$data = $data->result_array();
			return $data;
		}
		public function getDataByMaPN($mapn)
		{
			$this->db->select('*');
			$this->db->join('nhanvien', 'phieunhap.MaNV = nhanvien.manv');
			$this->db->join('nhacc', 'nhacc.MaNCC = phieunhap.MaNCC');
			$this->db->join('ctpn', 'ctpn.MaPN = phieunhap.MaPN');
			$this->db->where('phieunhap.MaPN', $mapn);
			$data = $this->db->get('phieunhap');
			$data = $data->result_array();
			return $data;
		}
		public function ThemPN($tongtientt, $ngaylappn, $tinhtrangtt, $mancc, $manv)
		{
			$data = array(
				'TongTienTT' => $tongtientt,
				'NgayLapPN' => "$ngaylappn",
				'TinhTrangTT' => "$tinhtrangtt",
				'MaNCC' => "$mancc",
				'MaNV' => "$manv"
			);
			$this->db->insert('phieunhap', $data);
			return $this->db->insert_id();
		}
		public function XemPNCuoiCung()
		{
			$this->db->select('*');
			$this->db->from('phieunhap');
			$id=$this->db->insert_id(); //its return last insert item on table   
     		echo $id;
		}
		public function ThemCTPN($mapn, $masp, $mattsp, $gianhap, $soluong, $thanhtien)
		{
			$data = array(
				'MaPN' => 	"$mapn",
				'MaSP' => "$masp",
				'mattsp' => "$mattsp",
				'GiaNhap' => "$gianhap",
				'SoLuong' => "$soluong",
				'ThanhTien' => "$thanhtien"
			);
			$this->db->insert('ctpn', $data);
		}
		public function SuaPN($mapn, $tongtientt, $ngaylappn, $tinhtrangtt, $mancc, $manv)
		{
			$data = array(
				'TongTienTT' => $tongtientt,
				'NgayLapPN' => "$ngaylappn",
				'TinhTrangTT' => "$tinhtrangtt",
				'MaNCC' => "$mancc",
				'MaNV' => "$manv"
			);
			$this->db->where('MaPN', $mapn);
			$this->db->update('phieunhap', $data);
		}
		public function SuaCTPN($mapn, $masp, $mattsp, $gianhap, $soluong, $thanhtien)
		{
			$data = array(
				'MaPN' => 	"$mapn",
				'MaSP' => "$masp",
				'mattsp' => "$mattsp",
				'GiaNhap' => "$gianhap",
				'SoLuong' => "$soluong",
				'ThanhTien' => "$thanhtien"
			);
			$this->db->where('MaPN', $mapn);
			$this->db->update('ctpn', $data);
		}
		public function XoaPN($table, $mapn)
		{
			$this->db->where('MaPN', $mapn);
			$this->db->delete($table);
		}
		public function XoaCTPN($table, $mapn)
		{
			$this->db->where('MaPN', $mapn);
			$this->db->delete($table);
		}
	}
	
	/* End of file NhapHangModel.php */
	

?>
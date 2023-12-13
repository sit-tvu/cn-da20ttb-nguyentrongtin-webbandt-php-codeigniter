<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ThemMoiSPModel extends CI_Model {
		
		// Begin: Thêm xóa sửa loại sản phẩm
		public function ThemMoiLoaiSP($tenloaisp)
		{
			$data = array(
				'MaLoaiSP' => "",
				'TenLoaiSP' => $tenloaisp
			);
			$this->db->insert('loaisp', $data);
			return $this->db->insert_id();
		}
		public function XemLoaiSP()
		{
			$this->db->select('*');
			return $this->db->get('loaisp');
		}
		public function XoaLoaiSP($table, $maloaisp)
		{
			return $this->db->delete($table, array('MaLoaiSP' => $maloaisp));
		}
		// end: Thêm xóa sửa loại sản phẩm

		// begin: Thêm xóa sửa thương hiệu
		public function ThemMoiTH($tenth)
		{
			$data = array(
				'MaTH' => "",
				'TenTH' => $tenth
			);
			$this->db->insert('thuonghieu', $data);
			return $this->db->insert_id();
		}
		public function XemTH()
		{
			$this->db->select('*');
			return $this->db->get('thuonghieu');
		}
		public function XoaTH($table, $math)
		{
			return $this->db->delete($table, array('MaTH' => $math));
		}
		// end: Thêm xóa sửa thương hiệu
		
		// begin: Thêm sản phẩm
		// load loại sản phẩm
		public function XemLoaiSP_inThemSP()
		{
			$this->db->select('*');
			return $this->db->get('loaisp');
		}
		// load thương hiệu
		public function XemTH_inThemSP()
		{
			$this->db->select('*');
			return $this->db->get('thuonghieu');
		}
		// tiến hành thêm sản phẩm
		public function ThemMoiSP($tensp, $hinhanh, $mota, $maloaisp, $math)
		{
			$data = array(
				'masp' => "",
				'tensp' => $tensp,
				'hinhanh' => $hinhanh,
				'mota' => $mota,
				'maloaisp' => $maloaisp,
				'math' => $math
			);
			$this->db->insert('sanpham', $data);
			return $this->db->insert_id();
		}
		// sản phẩm được truyền đến cuối cùng
		public function XemSPCuoiCung()
		{
			$this->db->select('*');
			$this->db->from('sanpham');
			$id=$this->db->insert_id(); //its return last insert item on table   
     		echo $id;
		}
		// thông tin sản phẩm
		public function ThemThongTinSP($masp, $kho, $gia, $giakm, $soluong, $mausac, $ram, $bonhotrong, $pin, $kichthuongmanhinh, $cameratruoc, $camerasau, $cpu)
		{
			$data = array(
				'masp' => $masp,
				'MaKho' => $kho,
				'Gia' => $gia,
				'GiaKM' => $giakm,
				'SoLuong' => $soluong,
				'mausac' => $mausac,
				'ram' => $ram,
				'bonhotrong' => $bonhotrong,
				'pin' => $pin,
				'kichthuongmanhinh' => $kichthuongmanhinh,
				'cameratruoc' => $cameratruoc,
				'camerasau' => $camerasau,
				'cpu' => $cpu
			);
			$this->db->insert('thongtinsp', $data);
			return $this->db->insert_id();
		}
		// end: Thêm sản phẩm
	
	}
	
	/* End of file ThemMoiSPModel.php */
	

?>

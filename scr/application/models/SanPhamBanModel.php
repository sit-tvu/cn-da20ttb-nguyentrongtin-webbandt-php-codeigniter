<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SanPhamBanModel extends CI_Model {
		
		public function TimKiem($timkiem)
		{
			$this->db->select('*');
			$this->db->like('sanpham.tensp', $timkiem);
			$this->db->or_like('thongtinsp.mausac', $timkiem);
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$result = $this->db->get('sanpham');
			return $result->result();
		}
		public function getSoTrangtimkiem($timkiem)
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$this->db->like('sanpham.tensp', $timkiem);
			$this->db->or_like('thongtinsp.mausac', $timkiem);
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$res = $this->db->get('sanpham');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		// get data by $trang
		public function getData($trang)
		{
			$SoSPTrongTrang = 12;
			if($trang == 0) {
				$trang = 1;
			}
			$offset = ($trang - 1) * $SoSPTrongTrang;
			$this->db->select('*');
			// $this->db->from('sanpham');
			// $this->db->join('loaisp', 'loaisp.MaLoaiSP = sanpham.maloaisp');
			// $this->db->join('thuonghieu', 'thuonghieu.MaTH = sanpham.math');
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$this->db->order_by('sanpham.masp', 'asc');
			$data = $this->db->get('sanpham', $SoSPTrongTrang, $offset);
			// $data = $data->result_array();
			return $data->result();
		}
		// lấy số trang theo số sản phẩm trong trang
		public function getSoTrang()
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		function getproduct()
        {
			return $this->db->select('*')
			->join('thongtinsp','thongtinsp.masp = sanpham.masp')
			->from('sanpham')
			->get()->result();
        }
		
        function getcategory()
        {
			return $this->db->select('*')
			->from('loaisp')
			->get()->result();
        }
		public function getproductgia($giabd, $giakt)
		{
			return $this->db->select('*')
			->join('thongtinsp','thongtinsp.masp = sanpham.masp')
			->from('sanpham')
			->where('Gia >=', $giabd)
			->where('Gia <=', $giakt)
			->get()->result();
		}
		public function getSoTrangGia($giabd, $giakt)
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$this->db->where('thongtinsp.Gia >=', $giabd);
			$this->db->where('thongtinsp.Gia <=', $giakt);
			$this->db->join('sanpham', 'thongtinsp.masp = sanpham.masp');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function getproductloaisp($maloaisp)
		{
			return $this->db->select('*')
			->join('thongtinsp','thongtinsp.masp = sanpham.masp')
			->from('sanpham')
			->where('maloaisp', $maloaisp)
			->get()->result();
		}
		public function getSoTrangloaisp($maloaisp)
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$this->db->where('maloaisp', $maloaisp);
			$this->db->join('sanpham', 'thongtinsp.masp = sanpham.masp');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function getproductcamera($camera)
		{
			return $this->db->select('*')
			->join('thongtinsp','thongtinsp.masp = sanpham.masp')
			->from('sanpham')
			->where('cameratruoc', $camera)
			->or_where('camerasau',  $camera)
			->get()->result();
		}
		public function getSoTrangcamera($camera)
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$this->db->where('cameratruoc', $camera);
			$this->db->or_where('camerasau', $camera);
			$this->db->join('sanpham', 'thongtinsp.masp = sanpham.masp');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function getproductram($ram)
		{
			return $this->db->select('*')
			->join('thongtinsp','thongtinsp.masp = sanpham.masp')
			->from('sanpham')
			->where('ram', $ram)
			->get()->result();
		}
		public function getSoTrangram($ram)
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$this->db->where('ram', $ram);
			$this->db->join('sanpham', 'thongtinsp.masp = sanpham.masp');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function getproductbonhotrong($bonhotrong)
		{
			return $this->db->select('*')
			->join('thongtinsp','thongtinsp.masp = sanpham.masp')
			->from('sanpham')
			->where('bonhotrong', $bonhotrong)
			->get()->result();
		}
		public function getSoTrangbonhotrong($bonhotrong)
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$this->db->where('bonhotrong', $bonhotrong);
			$this->db->join('sanpham', 'thongtinsp.masp = sanpham.masp');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function getproductkichthuocmanhinh($kichthuocmanhinh)
		{
			return $this->db->select('*')
			->join('thongtinsp','thongtinsp.masp = sanpham.masp')
			->from('sanpham')
			->where('kichthuongmanhinh', $kichthuocmanhinh)
			->get()->result();
		}
		public function getSoTrangkichthuongmanhinh($kichthuongmanhinh)
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$this->db->where('kichthuongmanhinh', $kichthuongmanhinh);
			$this->db->join('sanpham', 'thongtinsp.masp = sanpham.masp');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function getprotuctthuonghieu($thuonghieu)
		{
			return $this->db->select('*')
			->join('thongtinsp','thongtinsp.masp = sanpham.masp')	
			->join('thuonghieu','thuonghieu.MaTH = sanpham.math')
			->from('sanpham')
			->where('thuonghieu.MaTH', $thuonghieu)
			->get()->result();
		}
		public function getSoTrangthuonghieu($thuonghieu)
		{
			$SoSPTrongTrang = 12;
			$this->db->select('*');
			$this->db->where('thuonghieu.MaTH', $thuonghieu);
			// $this->db->where('thuonghieu', $thuonghieu);
			$this->db->join('sanpham', 'thongtinsp.masp = sanpham.masp');
			$this->db->join('thuonghieu', 'sanpham.math = thuonghieu.MaTH');
			$res = $this->db->get('thongtinsp');
			$res = $res->result_array();
			$TongSoSanPham = count($res);
			$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
			return $SoTrang;
		}
		public function getDataByMaSPMaTTSP($masp, $mattsp)
		{
			$this->db->select('*');
			$this->db->join('thongtinsp', 'thongtinsp.masp = sanpham.masp');
			$this->db->join('loaisp', 'loaisp.MaLoaiSP = sanpham.maloaisp');
			$this->db->join('thuonghieu', 'thuonghieu.MaTH = sanpham.math');
			// $this->db->order_by('sanpham.masp', 'desc');
			$this->db->where('sanpham.masp', $masp);
			$this->db->where('thongtinsp.mattsp', $mattsp);
			$data = $this->db->get('sanpham');
			$data = $data->result_array();
			return $data;
		}
		public function getBinhLuan($masp, $mattsp)
		{
			$this->db->select('*');
			$this->db->join('khachhang', 'khachhang.MaKH = binhluan.MaKH');
			$this->db->where('MaSP', $masp);
			$this->db->where('MaTTSP', $mattsp);
			$data = $this->db->get('binhluan');
			$data = $data->result_array();
			return $data;
		}
		public function CountBinhLuan($masp, $mattsp)
		{
			$this->db->select('*');
			$this->db->join('khachhang', 'khachhang.MaKH = binhluan.MaKH');
			$this->db->where('MaSP', $masp);
			$this->db->where('MaTTSP', $mattsp);
			$data = $this->db->get('binhluan');
			$data = $data->num_rows();
			return $data;
		}
		public function ThemBinhLuan($masp, $mattsp, $makh, $noidung)
		{
			$data = array(
				'MaSP' => $masp,
				'MaKH' => $makh,
				'MaTTSP' => $mattsp,
				'NoiDung' => $noidung
			);
			$this->db->insert('binhluan', $data);
		}
		public function ThemVaoGio($masp, $mattsp, $soluong, $makh)
		{
			$data = array(
				'MaSP' => $masp,
				'MaTTSP' => $mattsp,
				'SoLuongMua' => $soluong,
				'MaKH' => $makh
			);
			$this->db->insert('giohang', $data);
		}
		public function ValidateGioHang($masp, $mattsp, $makh)
		{
			$this->db->where('MaSP', $masp);
			$this->db->where('MaTTSP', $mattsp);
			$this->db->where('MaKH', $makh);
			$data = $this->db->get('giohang');
			return $data;
		}
	}
	
	/* End of file SanPhamBanModel.php */
	

?>
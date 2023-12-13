<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class TinTucModel extends CI_Model {

	// public function getData()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tintuc');
	// 	$this->db->order_by('id', 'ASC');
	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }
	// get data by $trang
	public function getData($trang)
	{
		$SoSPTrongTrang = 7;
		if($trang == 0) {
			$trang = 1;
		}
		$offset = ($trang - 1) * $SoSPTrongTrang;
		// $this->db->select('*');
		// $this->db->from('sanpham');
		$this->db->select('*');
		// $this->db->from('tintuc');
		$this->db->order_by('id', 'ASC');
		$data = $this->db->get('tintuc', $SoSPTrongTrang, $offset);
		$data = $data->result_array();
		return $data;
	}
	public function getSoTrang()
	{
		$SoSPTrongTrang = 5;
		$this->db->select('*');
		$res = $this->db->get('tintuc');
		$res = $res->result_array();
		$TongSoSanPham = count($res);
		$SoTrang = ceil($TongSoSanPham/$SoSPTrongTrang);
		return $SoTrang;
	}
	public function getDataByID($id)
	{
		$this->db->select('*');
		$this->db->from('tintuc');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function XoaTinTuc($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tintuc');
	}
	public function SuaTinTuc($id, $noidung, $tieude, $mota, $hinhanh, $nguoidang, $ngaydang)
	{
		$data = array(
			'noidung' => $noidung,
			'tieude' => $tieude,
			'mota' => $mota,
			'hinhanh' => $hinhanh,
			'nguoidang' => $nguoidang,
			'ngaydang' => $ngaydang
		);
		$this->db->where('id', $id);
		$this->db->update('tintuc', $data);
	}
	public function SuaTinTucKhongHinhAnh($id, $noidung, $tieude, $mota, $nguoidang, $ngaydang)
	{
		$data = array(
			'noidung' => $noidung,
			'tieude' => $tieude,
			'mota' => $mota,
			'nguoidang' => $nguoidang,
			'ngaydang' => $ngaydang
		);
		$this->db->where('id', $id);
		$this->db->update('tintuc', $data);
	}
	public function ThemTinTuc($noidung, $tieude, $mota, $hinhanh, $nguoidang, $ngaydang)
	{
		$data = array(
			'noidung' => $noidung,
			'tieude' => $tieude,
			'mota' => $mota,
			'hinhanh' => $hinhanh,
			'nguoidang' => $nguoidang,
			'ngaydang' => $ngaydang
		);
		$this->db->insert('tintuc', $data);
	}

}

/* End of file TinTucModel.php */


?>

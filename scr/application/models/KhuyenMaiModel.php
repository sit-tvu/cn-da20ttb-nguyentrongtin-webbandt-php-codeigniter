<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class KhuyenMaiModel extends CI_Model {
	
		public function getData()
		{
			$this->db->select('*');
			$data = $this->db->get('khuyenmai');
			$data = $data->result_array();
			return $data;
		}
		public function ThemKM($soptkm, $ngaybd, $ngaykt, $sotientoithieu)
		{
			$data = array(
				'SoPTKM' => $soptkm,
				'TuNgay' => $ngaybd,
				'DenNgay' => $ngaykt,
				'TTienToiThieu' => $sotientoithieu
			);
			return $this->db->insert('khuyenmai', $data);
		}
		public function SuaKM($makm, $soptkm, $ngaybd, $ngaykt, $sotientoithieu)
		{
			$data = array(
				'SoPTKM' => $soptkm,
				'TuNgay' => $ngaybd,
				'DenNgay' => $ngaykt,
				'TTienToiThieu' => $sotientoithieu
			);
			$this->db->where('MaKM', $makm);
			return $this->db->update('khuyenmai', $data);
		}
		public function getDataByMaKM($makm)
		{
			$this->db->select('*');
			$this->db->where('MaKM', $makm);
			$data = $this->db->get('khuyenmai');
			$data = $data->result_array();
			return $data;
		}
		public function XoaKM($makm)
		{
			$this->db->where('MaKM', $makm);
			$this->db->delete('khuyenmai');
		}
	
	}
	
	/* End of file KhuyenMaiModel.php */
	

?>

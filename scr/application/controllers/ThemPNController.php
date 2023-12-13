<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ThemPNController extends CI_Controller {
	
		public function __construct()
		{
			parent::__construct();
			if(!$this->session->userdata('logged_in') === TRUE){
				redirect('TrangChuController', 'refresh');
			}
			else {
				if($this->session->userdata('is_NV') === FALSE){
					redirect('TrangChuController', 'refresh');
				}
			}
		}
		
		public function index()
		{
			if($this->session->userdata('level') === 'Quản lý'){
				// data nhà cung cấp
				$this->load->model('NhaCungCapModel');
				$dataNCC = $this->NhaCungCapModel->getData();
				// data nhân viên
				$this->load->model('NhanVienModel');
				$dataNV = $this->NhanVienModel->getData();
				// data sản phẩm
				$this->load->model('SanPhamModel');
				$dataSP = $this->SanPhamModel->getDataAllSP();
				// $dataTTSP = $this->SanPhamModel->getDataAllTTSP($masp);
				$this->load->model('NhapHangModel');
				$data = $this->NhapHangModel->getData();
				$data = array(
					'arrResultPN' => $data,
					'arrResultNCC' => $dataNCC,
					'arrResultNV' => $dataNV,
					'arrResultSP' => $dataSP,
				);
				// var_dump($dataSP);
				$this->load->view('ThemPNView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
			
			
		}
		public function ThemPN()
		{
			$ngaylappn = $this->input->post('ngaylap');
			$tinhtrangtt = $this->input->post('tinhtrangtt');
			$mancc = $this->input->post('mancc');
			$manv = $this->input->post('manv');
			$this->load->model('NhapHangModel');
			$thanhtien = $this->input->post('tongtientt');
			$tongtientt = $thanhtien;
			$query = $this->NhapHangModel->ThemPN($tongtientt , $ngaylappn, $tinhtrangtt, $mancc, $manv);
			if($query)
			{
				$mapn = $this->db->insert_id();
				// echo $mapn;
				$masp = $this->input->post('masp');
				$mattsp = $this->input->post('mattsp');
				$gianhap = $this->input->post('gianhap');
				$soluong = $this->input->post('soluong');
				$thanhtien = $this->input->post('tongtientt');
				$query2 = $this->NhapHangModel->ThemCTPN($mapn, $masp, $mattsp, $gianhap, $soluong, $thanhtien);
				if(!$query2)
				{
					echo "<pre>";
					print_r ("Thêm thành công");
					echo "</pre>";
					header("Location:". base_url(). "index.php/NhapHangController");
				}
				else
				{
					
					echo "<pre>";
					print_r ("Thêm thất bại");
					echo "</pre>";
					header("Location:". base_url(). "index.php/NhapHangController");
					
				}
			}
			else
			{
				
				echo "<pre>";
				print_r ("Thêm thất bại");
				echo "</pre>";
				
			}
			
		}
	
	}
	
	/* End of file ThemPNController.php */
	
?>
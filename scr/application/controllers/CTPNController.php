<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class CTPNController extends CI_Controller {
	
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
				
				$mapn = $this->input->get('mapn');
				$this->load->model('NhapHangModel');
				$data = $this->NhapHangModel->getDataByMaPN($mapn);
				$data = array(
					'arrResultPN' => $data,
					'arrResultNCC' => $dataNCC,
					'arrResultNV' => $dataNV,
					'arrResultSP' => $dataSP,
				);
				// var_dump($dataSP);
				$this->load->view('CTPNView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
			
		}
		public function SuaPN()
		{
			$mapn = $this->input->get('mapn');
			$nhacc = $this->input->post('nhacc');
			$tinhtrangtt = $this->input->post('tinhtrangtt');
			$ngaylappn = $this->input->post('ngaylappn');
			$manv = $this->input->post('manv');
			$tongtientt = $this->input->post('thanhtien');
			echo $mapn;
			echo "....";
			echo $nhacc;
			echo "....";
			echo $tinhtrangtt;
			echo "....";
			echo $ngaylappn;
			echo "....";
			echo $manv;
			echo "....";
			echo $tongtientt;
			echo "....";
			$this->load->model('NhapHangModel');
			$querySuaPN = $this->NhapHangModel->SuaPN($mapn, $tongtientt, $ngaylappn, $tinhtrangtt, $nhacc, $manv);
			if (!$querySuaPN) 
			{
				$masp = $this->input->post('masp');
				$gianhap = $this->input->post('gianhap');
				$soluong = $this->input->post('soluong');
				$thanhtien = $tongtientt;
				echo "....";
				echo $masp;
				echo "....";
				echo $gianhap;
				echo "....";
				echo $soluong;
				echo "....";
				echo $thanhtien;
				$querySuaCTPN = $this->NhapHangModel->SuaCTPN($mapn, $masp, 1, $gianhap, $soluong, $thanhtien);
				if (!$querySuaCTPN)
				{
					echo "success";
					header("Location:". base_url() . "index.php/NhapHangController");
				}
				else
				{
					echo "fail";
				}
			}
			else
			{
				echo "fail";
			}
		}
	
	}
	
	/* End of file CTPNController.php */
	
?>
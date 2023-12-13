<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ThongKeController extends CI_Controller {
	
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
			$this->load->model('ThongKeModel');
			$countHD = $this->ThongKeModel->countHD();
			$countSP = $this->ThongKeModel->countSP();
			$countNCC = $this->ThongKeModel->countNCC();
			$countKH = $this->ThongKeModel->countKH();
			$data = array("countHD" => $countHD, "countSP" => $countSP, "countNCC" => $countNCC, "countKH" => $countKH);
			$this->load->view('ThongKeView', $data);
			
		}
		public function DoanhThu()
		{
			$chooseyear = $this->input->post('chooseyear');
			$this->load->model('ThongKeModel');
			$countHD = $this->ThongKeModel->countHD();
			$countSP = $this->ThongKeModel->countSP();
			$countNCC = $this->ThongKeModel->countNCC();
			$countKH = $this->ThongKeModel->countKH();
			$data1 = $this->ThongKeModel->DoanhThu(1,$chooseyear);
			$data2 = $this->ThongKeModel->DoanhThu(2,$chooseyear);
			$data3 = $this->ThongKeModel->DoanhThu(3,$chooseyear);
			$data4 = $this->ThongKeModel->DoanhThu(4,$chooseyear);
			$data5 = $this->ThongKeModel->DoanhThu(5,$chooseyear);
			$data6 = $this->ThongKeModel->DoanhThu(6,$chooseyear);
			$data7 = $this->ThongKeModel->DoanhThu(7,$chooseyear);
			$data8 = $this->ThongKeModel->DoanhThu(8,$chooseyear);
			$data9 = $this->ThongKeModel->DoanhThu(9,$chooseyear);
			$data10 = $this->ThongKeModel->DoanhThu(10,$chooseyear);
			$data11 = $this->ThongKeModel->DoanhThu(11,$chooseyear);
			$data12 = $this->ThongKeModel->DoanhThu(12,$chooseyear);
			$tongdoanhthu = $this->ThongKeModel->TongDoanhThu($chooseyear);
			$data = array("countHD" => $countHD, "countSP" => $countSP, "countNCC" => $countNCC, "countKH" => $countKH, "data1" => $data1, "data2" => $data2, "data3" => $data3, "data4" => $data4, "data5" => $data5, "data6" => $data6, "data7" => $data7, "data8" => $data8, "data9" => $data9, "data10" => $data10, "data11" => $data11, "data12" => $data12, "tongdoanhthu" => $tongdoanhthu);
			$this->load->view('ThongKeDoanhThuView', $data);
		}
		public function SPBanChay()
		{
			$this->load->model('ThongKeModel');
			$countHD = $this->ThongKeModel->countHD();
			$countSP = $this->ThongKeModel->countSP();
			$countNCC = $this->ThongKeModel->countNCC();
			$countKH = $this->ThongKeModel->countKH();
			$SPBanChay = $this->ThongKeModel->SPBanChay();
			// var_dump($SPBanChay);
			$data = array("countHD" => $countHD, "countSP" => $countSP, "countNCC" => $countNCC, "countKH" => $countKH, "SPBanChay" => $SPBanChay);
			$this->load->view('ThongKeSPBanChayView', $data);
		}
		public function KHMuaNhieu()
		{
			$this->load->model('ThongKeModel');
			$countHD = $this->ThongKeModel->countHD();
			$countSP = $this->ThongKeModel->countSP();
			$countNCC = $this->ThongKeModel->countNCC();
			$countKH = $this->ThongKeModel->countKH();
			$KHMuaNhieu = $this->ThongKeModel->KHMuaNhieu();
			// var_dump($KHMuaNhieu);
			$data = array("countHD" => $countHD, "countSP" => $countSP, "countNCC" => $countNCC, "countKH" => $countKH, "KHMuaNhieu" => $KHMuaNhieu);
			$this->load->view('ThongKeKHMuaNhieuView', $data);
		}
	
	}
	
	/* End of file ThongKeController.php */
	
?>
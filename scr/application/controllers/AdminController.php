<?php 
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class AdminController extends CI_Controller {
	
		
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
		
		public function index($trang=0)
		{
			if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Bán hàng'){
				$this->load->model('AdminModel');
				$countSP = $this->AdminModel->countSP();
				$countTT = $this->AdminModel->countTT();
				$countNV = $this->AdminModel->countNV();
				$countGH = $this->AdminModel->countGH();
				// var_dump($countSP);
				$data = $this->AdminModel->getData($trang);
				$datasotrang = $this->AdminModel->getSoTrang();
				$data = array(
					"arrResult" => $data,
					"SoTrang" => $datasotrang,
					"countSP" => $countSP,
					"countTT" => $countTT,
					"countNV" => $countNV,
					"countGH" => $countGH
				);
				// var_dump($this->session->userdata);
				// truyền data sang view
				$this->load->view('AdminView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
			
		}
		public function ThanhToan()
		{
			$this->load->model('AdminModel');
			$mahd = $this->input->get('mahd');
			$sotiennhan = $this->input->post('tiennhan');
			$query = $this->AdminModel->ThanhToan($mahd, $sotiennhan);
			if(!$query)
			{
				redirect('AdminController', 'refresh');
			}
			else
			{
				echo "Thanh toán thất bại";
			}
		}
	
	}
	
	/* End of file Controllername.php */
	
?>
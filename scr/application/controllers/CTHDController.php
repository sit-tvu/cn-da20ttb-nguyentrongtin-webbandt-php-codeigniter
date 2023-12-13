<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class CTHDController extends CI_Controller {
	
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
		
			if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Bán hàng'){
				$mahd = $this->input->get('mahd');
				$this->load->model('HoaDonModel');
				$data = $this->HoaDonModel->getDataByMaHD($mahd);
				// var_dump($data);
				$dataCTHD = $this->HoaDonModel->CTHD($mahd);
				$data = array("arrResult" => $data, "arrCTHD" => $dataCTHD);
				$this->load->view('CTHDView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
	
	}
	
	/* End of file CTHDController.php */
	
?>
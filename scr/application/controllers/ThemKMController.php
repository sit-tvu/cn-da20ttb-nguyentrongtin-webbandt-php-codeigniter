<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ThemKMController extends CI_Controller {
	
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
				$this->load->view('ThemKMView');
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function ThemKM()
		{
			$soptkm = $this->input->post('soptkm');
			$sottt = $this->input->post('sottt');
			$ngaybd = $this->input->post('ngaybd');
			$ngaykt = $this->input->post('ngaykt');
			// echo $soptkm;
			// echo $sottt;
			// echo $ngaybd;
			// echo $ngaykt;
			$this->load->model('KhuyenMaiModel');
			$this->KhuyenMaiModel->ThemKM($soptkm,$ngaybd,$ngaykt,$sottt);
			header("Location:".base_url()."index.php/KhuyenMaiController");
		}
	
	}
	
	/* End of file ThemKMController.php */
	
?>

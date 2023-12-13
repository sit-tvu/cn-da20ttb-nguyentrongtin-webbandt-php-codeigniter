<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ThemNVController extends CI_Controller {
	
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
				$this->load->view('ThemNVView');
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function ThemNV()
		{
			$tennv = $this->input->post('tennv');
			$ngayvl = $this->input->post('ngayvl');
			$luong = $this->input->post('luong');
			$sdt = $this->input->post('sdt');
			$email = $this->input->post('email');
			$cmnd = $this->input->post('cmnd');
			$loainv = $this->input->post('loainv');
			$diachi = $this->input->post('diachi');
			$this->load->model('NhanVienModel');
			if(!$this->NhanVienModel->ThemNV($tennv, $ngayvl, $luong, $sdt, $email, $cmnd, $loainv, $diachi))
			{
				echo "Thêm thành công";
				header("Location:". base_url() . "index.php/NhanVienController");
			}
			else
			{
				echo "Thêm thất bại";
			}
		}
	
	}
	
	/* End of file ThemNVController.php */
	
?>
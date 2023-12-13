<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SanPhamController extends CI_Controller {
		
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
			if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Bán hàng' || $this->session->userdata('level') === 'Tiếp tân'){
				$this->load->model('SanPhamModel');
				$data = $this->SanPhamModel->getData($trang);
				// lấy ra tổng số trang
				$SoTrang = $this->SanPhamModel->getSoTrang();
				// truyền data sang view
				$data = array(
					'arrResult' => $data,
					'SoTrang' => $SoTrang
				);
				$this->load->view('SanPhamView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function XoaSP()
		{
			// $masp = $this->input->get('masp');
			$mattsp = $this->input->get('mattsp');
			// echo $masp;
			$this->load->model('SanPhamModel');
			
			// print_r ($this->SanPhamModel->XoaTTSP('thongtinsp', $masp));

			if(!$this->SanPhamModel->XoaTTSP($mattsp) == true)
			{	
				header("Location: /do_an_web_thu_2/index.php/SanPhamController");
			}
			else
			{
				echo "Xóa thất bại";
			}
			
		}
	
	}
	
	/* End of file SanPhamController.php */
	
?>
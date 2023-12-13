<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NhanVienController extends CI_Controller {
	
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
				$this->load->model('NhanVienModel');
				$data = $this->NhanVienModel->getData();
				$data = array("arrResult" => $data);

				// truyền data sang view
				$this->load->view('NhanVienView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function XoaNV()
		{
			$manv = $this->input->get('manv');
			$this->load->model('NhanVienModel');
			if (!$this->NhanVienModel->XoaNV($manv))
			{
				echo "Xóa thành công";
				header("Location:". base_url() . "index.php/NhanVienController");
			}
			else
			{
				echo "Xóa thất bại";
			}
		}
	
	}
	
	/* End of file NhanVienController.php */
	
?>
<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SuaNVController extends CI_Controller {
	
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
				$manv = $this->input->get('manv');
				// echo $manv;
				$this->load->model('NhanVienModel');
				$data = $this->NhanVienModel->getDataByMaNV($manv);
				$data = array("arrResult" => $data);
				$this->load->view('SuaNVView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function SuaNV()
		{
			$manv = $this->input->get('manv');
			$tennv = $this->input->post('tennv');
			$ngayvl = $this->input->post('ngayvl');
			$luong = $this->input->post('luong');
			$sdt = $this->input->post('sdt');
			$email = $this->input->post('email');
			$cmnd = $this->input->post('cmnd');
			$loainv = $this->input->post('loainv');
			$diachi = $this->input->post('diachi');
			$this->load->model('NhanVienModel');
			if (!$this->NhanVienModel->SuaNV($manv, $tennv, $ngayvl, $luong, $sdt, $email, $cmnd, $loainv, $diachi))
			{
				echo "Sửa thành công";
				header("Location:". base_url() . "index.php/NhanVienController");
			}
			else
			{
				echo "Sửa thất bại";
			}
		}
	
	}
	
	/* End of file SuaNVController.php */
	
?>
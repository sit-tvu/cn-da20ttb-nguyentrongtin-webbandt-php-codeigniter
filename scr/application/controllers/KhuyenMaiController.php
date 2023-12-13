<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class KhuyenMaiController extends CI_Controller {
	
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
				$this->load->model('KhuyenMaiModel');
				$data = $this->KhuyenMaiModel->getData();
				$data = array("arrResult" => $data);
				// truyền data sang view
				$this->load->view('KhuyenMaiView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
			
		}
		public function XoaKM()
		{
			$makm = $this->input->get('makm');
			$this->load->model('KhuyenMaiModel');
			$query = $this->KhuyenMaiModel->XoaKM($makm);
			if(!$query)
			{
				echo "Xóa thành công";
				header("Location:". base_url() . "index.php/KhuyenMaiController");
			}
			else
			{
				echo "Xóa thất bại";
			}
		}
	
	}
	
	/* End of file KhuyenMaiController.php */
	
?>
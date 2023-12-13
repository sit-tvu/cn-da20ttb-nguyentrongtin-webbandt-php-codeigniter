<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class KhachHangController extends CI_Controller {
		
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
			$this->load->model('KhachHangModel');
			$data = $this->KhachHangModel->getData();
			$data = array("arrResult" => $data);

			// truyền data sang view
			$this->load->view('KhachHangView', $data);
		}
		public function XoaKH()
		{
			$this->load->model('KhachHangModel');
			$makh = $this->input->get('makh');
			if(!$this->KhachHangModel->XoaKH($makh))
			{
				echo "Xóa thành công";
				header("Location:". base_url() . "index.php/KhachHangController");
			}
			else
			{
				echo "Xóa thất bại";
			}
		}
	
	}
	
	/* End of file KhachHangController.php */
	
?>
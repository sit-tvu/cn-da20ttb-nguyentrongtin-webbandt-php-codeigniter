<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class XemKHController extends CI_Controller {
	
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
				$makh = $this->input->get('makh');
				// echo $makh;
				$this->load->model('KhachHangModel');
				$data = $this->KhachHangModel->getDataByMaKH($makh);
				$data = array("arrResult" => $data);
				$this->load->view('XemKHView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
	
	}
	
	/* End of file XemKHController.php */
	
?>

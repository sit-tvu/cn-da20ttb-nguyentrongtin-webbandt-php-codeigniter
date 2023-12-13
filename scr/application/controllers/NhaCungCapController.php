<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NhaCungCapController extends CI_Controller {
		
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
			if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Tiếp tân'){
				$this->load->model('NhaCungCapModel');
				$data = $this->NhaCungCapModel->getData();
				$data = array("arrResult" => $data);

				// truyền data sang view
				$this->load->view('NhaCungCapView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function XoaNCC()
		{
			$this->load->model('NhaCungCapModel');
			$mancc = $this->input->get('mancc');
			// echo $mancc;
			$query = $this->NhaCungCapModel->XoaNCC($mancc);
			if(!$query)
			{
				echo "Xóa thành công";
				header("Location:". base_url() ."index.php/NhaCungCapController/");
			}
			else
			{
				echo "Xóa thất bại";
			}
		}
	
	}
	
	/* End of file NhaCungCapController.php */
	
?>

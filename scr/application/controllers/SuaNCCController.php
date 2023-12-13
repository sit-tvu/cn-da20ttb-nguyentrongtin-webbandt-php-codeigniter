<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SuaNCCController extends CI_Controller {
	
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
				$mancc = $this->input->get('mancc');
				$this->load->model('NhaCungCapModel');
				$data = $this->NhaCungCapModel->getDataByMaNCC($mancc);
				$data = array(
						'arrResult' => $data
				);
				$this->load->view('SuaNCCView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function SuaNCC()
		{
			$mancc = $this->input->get('mancc');
			$tenncc = $this->input->post('tenncc');
			$emailncc =  $this->input->post('emailncc');
			$sdtncc = $this->input->post('sdtncc');
			$diachincc = $this->input->post('dcncc');
			$wsncc = $this->input->post('wsncc');
			$this->load->model('NhaCungCapModel');
			$query = $this->NhaCungCapModel->SuaNCC($mancc, $tenncc, $emailncc, $sdtncc, $diachincc, $wsncc);
			if(!$query)
			{
				echo "OK";
				header("Location:". base_url() ."index.php/NhaCungCapController/");
			}
			else
			{
				echo "FAIL";
			}
			
		}
	
	}
	
	/* End of file SuaNCCController.php */
	
?>
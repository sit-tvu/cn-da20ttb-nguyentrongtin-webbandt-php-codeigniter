<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class TrangChuController extends CI_Controller {
	
		public function index()
		{
			$this->load->model('TrangChuModel');
			$data = $this->TrangChuModel->getData();
			$data = array(
				'arrResult' => $data,
			);
			$this->load->view('TrangChu', $data);
			
		}
	
	}
	
	/* End of file TrangChuController.php */
	

?>

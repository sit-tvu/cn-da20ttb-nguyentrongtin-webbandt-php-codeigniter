<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class TinTucController extends CI_Controller {
	
		public function index($trang=0)
		{
			$this->load->model('TinTucModel');
			$data = $this->TinTucModel->getData($trang);
			$datasotrang = $this->TinTucModel->getSoTrang();
			$data = array(
				'arrResult' => $data,
				'SoTrang' => $datasotrang
			);
			$this->load->view('TinTucView', $data);
		}
	
		public function XoaTinTuc()
		{
			$id = $this->input->get('id');
			$this->load->model('TinTucModel');
			$this->TinTucModel->XoaTinTuc($id);
			header("Location:". base_url() . "index.php/TinTucController");
		}
	}
	
	/* End of file TinTucController.php */
	
?>

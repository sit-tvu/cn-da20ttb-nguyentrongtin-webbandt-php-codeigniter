<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class TinTucBanController extends CI_Controller {

	public function index($trang=0)
	{
		$this->load->model('TinTucModel');
		$data = $this->TinTucModel->getData($trang);
		$datasotrang = $this->TinTucModel->getSoTrang();
		$data = array(
			'arrResult' => $data,
			'SoTrang' => $datasotrang
		);
		$this->load->view('TinTucBan', $data);
		
	}

}

/* End of file TinTucBanController.php */


?>
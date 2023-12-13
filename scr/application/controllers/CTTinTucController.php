<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class CTTinTucController extends CI_Controller {

	public function index()
	{
		$id = $this->input->get('id');
		$this->load->model('TinTucModel');
		$data = $this->TinTucModel->getDataByID($id);
		$data = array(
			'arrResult' => $data
		);
		$this->load->view('CTTinTuc', $data);
	}

}

/* End of file CTTinTucController.php */


?>
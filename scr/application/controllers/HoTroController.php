<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class HoTroController extends CI_Controller {
	
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
			$this->load->model('HoTroModel');
			$data = $this->HoTroModel->getData();
			$data = array(
					'arrResult' => $data
			);
			$this->load->view('HoTroView', $data);
			
		}
		public function XoaBL()
		{
			$mabl = $this->input->get('mabl');
			$this->load->model('HoTroModel');
			$this->HoTroModel->XoaBL($mabl);
			header('Location: '.base_url().'index.php/HoTroController');
		}
	
	}
	
	/* End of file HoTroController.php */
	
?>
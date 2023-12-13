<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class HoaDonKhachHang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in') === TRUE){
			redirect('DangNhapController', 'refresh');
		}
		else {
			if($this->session->userdata('is_NV') === TRUE){
				redirect('TrangChuController', 'refresh');
			}
		}
	}
		
	public function index()
	{
		$this->load->model('HoaDonModel');
		$data = $this->HoaDonModel->HoaDonKhachHang($this->session->userdata('makh'));
		// var_dump($data);
		$data = array(
			'arrResult' => $data,
		);
		$this->load->view('HoaDonKhachHang', $data);
	}

}

/* End of file HoaDonKhachHang.php */


?>
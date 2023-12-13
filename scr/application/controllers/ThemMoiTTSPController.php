<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class ThemMoiTTSPController extends CI_Controller {

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
		if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Bán hàng' || $this->session->userdata('level') === 'Tiếp tân'){
			$this->load->model('SanPhamModel');
			$data = $this->SanPhamModel->getDataOnlySP();
			$this->load->model('KhoModel');
			$datakho = $this->KhoModel->getData();
			$data = array(
				'arrResult' => $data,
				'arrResultKho' => $datakho
			);
			$this->load->view('ThemMoiTTSPView', $data);
		}
		else {
			$this->load->view('view_error/tuchoitruycap');
		}
	}
	public function ThemTTSP()
	{
		echo 1;
		$masp = $this->input->post('masp');
		$makho = $this->input->post('makho');
		$gia = $this->input->post('gia');
		$giakm = $this->input->post('giakm');
		$soluong = $this->input->post('soluong');
		$mausac = $this->input->post('mausac');
		$ram = $this->input->post('ram');
		$bonhotrong = $this->input->post('rom');
		$pin = $this->input->post('pin');
		$kichthuocmh = $this->input->post('kichthuocmh');
		$camtruoc = $this->input->post('camtruoc');
		$camsau = $this->input->post('camsau');
		$cpu = $this->input->post('cpu');
		$this->load->model('ThemMoiSPModel');
		$queryThemThongTinSP = $this->ThemMoiSPModel->ThemThongTinSP($masp, $makho, $gia, $giakm, $soluong, $mausac, $ram, $bonhotrong, $pin, $kichthuocmh, $camtruoc, $camsau, $cpu);
		if($queryThemThongTinSP == true)
		{
			header("Location: /do_an_web_thu_2/index.php/SanPhamController");
		}
		else
		{
			echo "Thêm thất bại";
		}
	}

}

/* End of file ThemMoiTTSPController.php */


?>
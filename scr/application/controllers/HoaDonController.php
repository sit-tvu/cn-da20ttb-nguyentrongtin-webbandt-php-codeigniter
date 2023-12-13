<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class HoaDonController extends CI_Controller {
	
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
		
		public function index($trang=0)
		{
			
			if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Bán hàng'){
				$this->load->model('HoaDonModel');
				$data = $this->HoaDonModel->getData($trang);
				// $dataGH = $this->HoaDonModel->getDataGiaoHang();
				$SoTrang = $this->HoaDonModel->getSoTrang();
				$data = array(
					"arrResult" => $data, 
					// "arrResultGH" => $dataGH
					"SoTrang" => $SoTrang
				);
				// truyền data sang view
				$this->load->view('HoaDonView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function XoaHD()
		{
			$mahd = $this->input->get('mahd');
			$tttt = $this->input->get('tttt');
			$ttgh = $this->input->get('ttgh');
			$this->load->model('HoaDonModel');
			$this->load->model('GiaoHangModel');
			if($ttgh == 1 && $tttt == 1)
			{
				$this->GiaoHangModel->XoaGH($mahd);
				if(!$this->HoaDonModel->XoaCTHD($mahd))
				{
					$this->HoaDonModel->XoaHD($mahd);
					header('Location: '.base_url().'index.php/HoaDonController');
				}
			}
			else if($ttgh == 0 && $tttt == 1)
			{
				echo "Đơn hàng chưa được giao, chưa thể xóa.";
			}
			else
			{
				echo "Vui lòng thanh toán trước khi xóa";
			}
			
		}
	}
	
	/* End of file HoaDonController.php */
	
?>

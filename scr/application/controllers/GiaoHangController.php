<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class GiaoHangController extends CI_Controller {
		
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
			if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Giao hàng'){
				$this->load->model('GiaoHangModel');
				$data = $this->GiaoHangModel->getData($trang);
				$SoTrang = $this->GiaoHangModel->getSoTrang();
				$data = array("arrResult" => $data, "SoTrang" => $SoTrang);

				// truyền data sang view
				$this->load->view('GiaoHangView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function XacNhanGH()
		{
			$mahd = $this->input->get('mahd');
			$this->load->model('GiaoHangModel');
			if(!$this->GiaoHangModel->XacNhanGH($mahd))
			{
				echo "Xác nhận thành công";
				header("Location:". base_url() . "index.php/GiaoHangController");
			}
			else
			{
				echo "Xác nhận thất bại";
			}
		}
		public function XoaGH()
		{
			$mahd = $this->input->get('mahd');
			$tinhtranggh = $this->input->get('tinhtranggh');
			$this->load->model('GiaoHangModel');
			if($tinhtranggh == 1)
			{
				if(!$this->GiaoHangModel->XoaGH($mahd))
				{
					echo "Xóa thành công";
					header("Location:". base_url() . "index.php/GiaoHangController");
				}
				else
				{
					echo "Xóa thất bại";
				}
			}
			else
			{
				echo "Không thể xóa đơn hàng chưa được giao!";
			}
		}
	
	}
	
	/* End of file GiaoHangController.php */
	
?>
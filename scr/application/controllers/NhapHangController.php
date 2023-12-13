<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class NhapHangController extends CI_Controller {
		
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
			if($this->session->userdata('level') === 'Quản lý'){
				$this->load->model('NhapHangModel');
				$data = $this->NhapHangModel->getData();
				$data = array("arrResult" => $data);

				// truyền data sang view
				$this->load->view('NhapHangView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function XoaPN()
		{
			$mapn = $this->input->get('mapn');
			// echo $mapn;
			$tinhtrangtt = $this->input->get('tttt');
			// echo $tinhtrangtt;
			$this->load->model('NhapHangModel');
			if ($tinhtrangtt == 1)
			{
				$queryXoaCTPN = $this->NhapHangModel->XoaCTPN("ctpn", $mapn);
				if(!$queryXoaCTPN)
				{
					$queryXoaPN = $this->NhapHangModel->XoaPN("phieunhap", $mapn);
					if(!$queryXoaPN)
					{
						echo "Xóa thành công";
						header("Location:". base_url() . "index.php/NhapHangController");
					}
					else
					{
						echo "Xóa không thành công";
					}
				}
				else
				{
					echo "Xóa không thành công";
				}
			}
			else
			{
				echo "Vui lòng thanh toán trước khi xóa";
			}
			
		}
	
	}
	
	/* End of file NhapHangController.php */
	
?>
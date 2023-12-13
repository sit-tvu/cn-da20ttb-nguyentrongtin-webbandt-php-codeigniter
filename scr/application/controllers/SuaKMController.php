<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SuaKMController extends CI_Controller {
	
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
			
			if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Bán hàng'){
				$this->load->model('KhuyenMaiModel');
				$makm = $this->input->get('makm');
				$data = $this->KhuyenMaiModel->getDataByMaKM($makm);
				$data = array("arrResult" => $data);
				$this->load->view('SuaKMView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
		public function SuaKM()
		{
			$makm = $this->input->get('makm');
			$soptkm = $this->input->post('soptkm');
			$sottt = $this->input->post('sottt');
			$ngaybd = $this->input->post('ngaybd');
			$ngaykt = $this->input->post('ngaykt');
			$this->load->model('KhuyenMaiModel');
			$query = $this->KhuyenMaiModel->SuaKM($makm, $soptkm, $ngaybd, $ngaykt, $sottt);
			if($query)
			{
				echo "Sửa thành công";
				header("Location:". base_url() . "index.php/KhuyenMaiController");
			}
			else
			{
				echo "Lỗi";
			}
		}
	}
	
	/* End of file SuaKMController.php */
	
?>
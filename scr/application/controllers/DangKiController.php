<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class DangKiController extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('logged_in') === TRUE){
			redirect('TrangChuController', 'refresh');
		}
		else {
			$this->load->view('DangKi');
		}
		
	}
	public function DangKi()
	{
		$hoten = $this->input->post('hoten');
		$gioitinh = $this->input->post('gioitinh');
		$sdt = $this->input->post('sdt');
		$email = $this->input->post('email');
		$matkhau1 = $this->input->post('password1');
		$matkhau2 = $this->input->post('password2');
		$cmnd = $this->input->post('cmnd');
		$diachi = $this->input->post('diachi');
		$this->load->model('DangKiModel');
		$validateNV = $this->DangKiModel->validateNV($email);
		$validateKH = $this->DangKiModel->validateKH($email);
		if($validateKH->num_rows() == 0 && $validateNV->num_rows() == 0)
		{
			if($matkhau1 == $matkhau2)
			{
				$query = $this->DangKiModel->DangKi($hoten, $gioitinh, $sdt, $email, $matkhau1, $cmnd, $diachi);
				if(!$query)
				{
					redirect('DangNhapController', 'refresh');
				}
				else
				{
					echo "Đăng kí thất bại";
				}
			}
			else {
				echo "Mật khẩu không khớp";
			}
		}
		else
		{
			echo "Email đã tồn tại";
		}
	}

}

/* End of file DangKiController.php */


?>

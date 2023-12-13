<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class TTTKController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in') === TRUE){
			redirect('DangNhapController', 'refresh');
		}
	}
	public function index()
	{
		$this->load->model('TTTKModel');
		if($this->session->userdata('is_NV') === TRUE)
		{
			$data = $this->TTTKModel->getDataNV($this->session->userdata('manv'));
		}
		else
		{
			$data = $this->TTTKModel->getDataKH($this->session->userdata('makh'));
		}
		$data = array("arrResult" => $data);
		$this->load->view('TTTK', $data);
	}
	public function SuaNV()
	{
		$manv = $this->input->get('manv');
		$matkhau = $this->input->post('password');
		$repassword1 = $this->input->post('repassword1');
		$repassword2 = $this->input->post('repassword2');
		$this->load->model('TTTKModel');
		if(strcmp($matkhau, $this->session->userdata('matkhau')) == 0)
		{
			if($matkhau != $repassword1 && $matkhau != $repassword2)
			{
				if($repassword1 == $repassword2)
				{
					$this->TTTKModel->SuaNV($manv, $repassword1);
					echo "Đổi mật khẩu thành công";
					$_SESSION['matkhau'] = $repassword1;
					header("Location:". base_url() . "index.php/TTTKController");
				}
				else
				{
					echo "Mật khẩu mới nhập lại không khớp";
				}		
			}
			else
			{
				echo "Mật khẩu giống mật khẩu ban đầu";
			}
		}
		else
		{
			echo "Mật khẩu cũ không đúng";
		}
	}
	public function SuaKH()
	{
		$manv = $this->input->get('makh');
		$tenkh = $this->input->post('tenkh');
		$gioitinh = $this->input->post('gioitinh');
		$sdt = $this->input->post('sdt');
		$email = $this->input->post('email');
		$matkhau = $this->input->post('password');
		$cmnd = $this->input->post('cmnd');
		$diachi = $this->input->post('diachi');
		$loaikh = $this->input->post('loaikh');
		$repassword1 = $this->input->post('repassword1');
		$repassword2 = $this->input->post('repassword2');
		if($tenkh != '' && $gioitinh != '' && $sdt != '' && $email != '' && $cmnd != '' && $diachi != '' && $loaikh != '')
		{
			$this->load->model('TTTKModel');
			if($matkhau != '')
			{
				if(strcmp($matkhau, $this->session->userdata('matkhau')) == 0)
				{
					if($matkhau != $repassword1 && $matkhau != $repassword2)
					{
						if($repassword1 == $repassword2)
						{
							$this->TTTKModel->SuaKH($manv, $tenkh, $gioitinh, $sdt, $email, $repassword1, $cmnd, $diachi, $loaikh);
							echo "Đổi mật khẩu thành công";
							$_SESSION['matkhau'] = $repassword1;
							header("Location:". base_url() . "index.php/TTTKController");
						}
						else
						{
							echo "Mật khẩu mới nhập lại không khớp";
						}		
					}
					else
					{
						echo "Mật khẩu giống mật khẩu ban đầu";
					}
				}
				else
				{
					echo "Mật khẩu cũ không đúng";
				}
			}
			else 
			{
				$this->TTTKModel->SuaKH($manv, $tenkh, $gioitinh, $sdt, $email, $this->session->userdata('matkhau'), $cmnd, $diachi, $loaikh);
				header("Location:". base_url() . "index.php/TTTKController");
			}
		}
		else
		{
			echo "Vui lòng nhập đầy đủ thông tin";
		}
		
	}

}

/* End of file TTTKController.php */


?>

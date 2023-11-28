<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class DangNhapController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('DangNhapModel');
	}
	public function index()
	{
		if($this->session->userdata('logged_in') === TRUE){
			redirect('TrangChuController', 'refresh');
		}
		else {
			$this->load->view('DangNhap');
		}
	}
	function auth(){
		// data cần lưu vào session
		// đếm đơn hàng chưa giao
		$countDonHang0 = $this->DangNhapModel->countDonHang0();
		// đếm hóa đơn chưa duyệt
		$countHoaDon0 = $this->DangNhapModel->countHoaDon0();
		// hết
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$validateNV = $this->DangNhapModel->validateNV($email,$password);
		$validateKH = $this->DangNhapModel->validateKH($email,$password);
		if($validateNV->num_rows() > 0){
			$data  = $validateNV->row_array();
			$manv = $data['MaNV'];
			$name  = $data['TenNV'];
			$ngayvl  = $data['NgayVL'];
			$luong  = $data['Luong'];
			$sdt  = $data['SDT'];
			$email = $data['Email'];
			$matkhau = $data['MatKhau'];
			$cmnd  = $data['CMND'];
			$diachi = $data['DiaChi'];
			$level = $data['LoaiNV'];
			$sesdata = array(
				'is_NV' => TRUE,
				'manv' => $manv,
				'username'  => $name,
				'ngayvl'  => $ngayvl,
				'luong'  => $luong,
				'sdt'  => $sdt,
				'email'     => $email,
				'matkhau'  => $matkhau,
				'cmnd'  => $cmnd,
				'diachi'  => $diachi,
				'level'     => $level,
				'countDonHang0' => $countDonHang0,
				'countHoaDon0' => $countHoaDon0,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($sesdata);
			// access login for QL
			if($level === 'Quản lý'){
				redirect(base_url()."index.php/AdminController");
	
			// access login for Bán hàng
			}
			elseif($level === 'Bán hàng'){
				redirect(base_url()."index.php/SanPhamController");
	
			// access login for Tiếp tân
			}
			elseif($level === 'Tiếp tân'){
				redirect(base_url()."index.php/TinTucController");
	
			// access login for Giao hàng
			}
			elseif($level === 'Giao hàng'){
				redirect(base_url()."index.php/GiaoHangController");
	
			}
			else{
				redirect(base_url()."index.php/TrangChuController");
			}
		}
		else if($validateKH->num_rows() > 0){
			$data  = $validateKH->row_array();
			$makh = $data['MaKH'];
			$name  = $data['TenKH'];
			$gioitinh  = $data['GioiTinh'];
			$sdt  = $data['SDT'];
			$email = $data['Email'];
			$matkhau = $data['MatKhau'];
			$cmnd  = $data['CMND'];
			$diachi = $data['DiaChi'];
			$level = $data['LoaiKH'];
			$sesdata = array(
				'is_NV' => FALSE,
				'makh' => $makh,
				'username'  => $name,
				'gioitinh'  => $gioitinh,
				'sdt'  => $sdt,
				'email'     => $email,
				'matkhau'  => $matkhau,
				'cmnd'  => $cmnd,
				'diachi'  => $diachi,
				'level'     => $level,
				'soluongmua' => 2,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($sesdata);
			// access login for admin
			if($level === 'Thân thiết'){
				redirect(base_url()."index.php/TrangChuController");
				// $_SESSION['soluongmua'] = $this->DangNhapModel->countSPTrongGio($this->session->userdata('makh'));
	
			// access login for staff
			}
			elseif($level === 'Bình thường'){
				redirect(base_url()."index.php/SanPhamBanController");
				// $_SESSION['soluongmua'] = $this->DangNhapModel->countSPTrongGio($this->session->userdata('makh'));
			}
			else{
				redirect(base_url()."index.php/SanPhamBanController");
			}
		}
		else{
			echo $this->session->set_flashdata('msg','Username or Password is Wrong');
			redirect(base_url()."index.php/DangNhapController");
		}
	}
	
	function DangXuat(){
		$this->session->sess_destroy();
		redirect('TrangChuController', 'refresh');	
	}

}

/* End of file DangNhapController.php */


?>

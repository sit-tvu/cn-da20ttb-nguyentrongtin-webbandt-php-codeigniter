<?php 



defined('BASEPATH') OR exit('No direct script access allowed');

class CTSPController extends CI_Controller {

	public function index()
	{
		$masp = $this->input->get('masp');
		$mattsp = $this->input->get('mattsp');
		$this->load->model('SanPhamBanModel');
		$data = $this->SanPhamBanModel->getDataByMaSPMaTTSP($masp, $mattsp);
		$databinhluan = $this->SanPhamBanModel->getBinhLuan($masp, $mattsp);
		// var_dump($databinhluan);
		$countBL = $this->SanPhamBanModel->CountBinhLuan($masp, $mattsp);
		$_SESSION['countDonHang0'] = $countBL;
		$data = array(
			'arrResult' => $data,
			'arrBinhLuan' => $databinhluan,
			'countBL'	=> $countBL
		);
		// var_dump($data);
		$this->load->view('CTSP', $data);
		
	}
	public function ThemVaoGio()
	{
		$masp = $this->input->get('masp');
		$mattsp = $this->input->get('mattsp');
		$soluong = $this->input->post('soluong');
		$this->load->model('SanPhamBanModel');
		$ValidateGioHang = $this->SanPhamBanModel->ValidateGioHang($masp, $mattsp, $this->session->userdata('makh'));
		// var_dump($this->session->userdata);
		if($ValidateGioHang->num_rows() == 0)
		{
			if($this->session->userdata('is_NV') === FALSE)
			{
				$this->SanPhamBanModel->ThemVaoGio($masp, $mattsp, $soluong, $this->session->userdata('makh'));
				$_SESSION['soluongmua'] = $this->session->userdata('soluongmua') + 1;
				header('Location: '.base_url(). 'index.php/GioHangController');
			}
			else
			{
				echo "Chỉ có khách hàng mới được mua.";
			}
		}
		else
		{
			echo "Sản phẩm đã có trong giỏ hàng";
		}
	}
	public function ThemBinhLuan()
	{
		$masp = $this->input->get('masp');
		$mattsp = $this->input->get('mattsp');
		$noidung = $this->input->post('noidung');
		$this->load->model('SanPhamBanModel');
		if($this->session->userdata('is_NV') === TRUE)
		{
			$this->SanPhamBanModel->ThemBinhLuan($masp, $mattsp, $this->session->userdata('manv'), $noidung);
			header('Location: '.base_url(). 'index.php/CTSPController?masp='.$masp.'&mattsp='.$mattsp);
		}
		else
		{
			$this->SanPhamBanModel->ThemBinhLuan($masp, $mattsp, $this->session->userdata('makh'),$noidung);
			header('Location: '.base_url(). 'index.php/CTSPController?masp='.$masp.'&mattsp='.$mattsp);
		}
		
	}

}

/* End of file CTSPController.php */


?>
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class GioHangController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in') === TRUE){
			redirect('DangNhapController', 'refresh');
		}
	}
	public function index()
	{
		// var_dump($this->session->userdata('soluongmua'));
		// echo $this->session->userdata('makh');
		// $this->load->model('DangNhapModel');
		// $countSPTrongGio = $this->DangNhapModel->countSPTrongGio($this->session->userdata('makh'));
		// echo $countSPTrongGio;
		$this->load->model('GioHangModel');
		$data = $this->GioHangModel->getData($this->session->userdata('makh'));
		$tongtiensp = $this->GioHangModel->TongTienSP($this->session->userdata('makh'));
		// var_dump($tongtiensp);
		$this->load->model('KhuyenMaiModel');
		$dataKM = $this->KhuyenMaiModel->getData();
		$data = array(
			'arrResult' => $data,
			'arrResultKM' => $dataKM,
			'arrTongTienSP' => $tongtiensp
		);
		// var_dump($data);
		$this->load->view('GioHang', $data);
		
	}
	public function XoaSPTrongGio()
	{
		$masp = $this->input->get('masp');
		$mattsp = $this->input->get('mattsp');
		$makh = $this->session->userdata('makh');
		$this->load->model('GioHangModel');
		$this->GioHangModel->XoaSPTrongGio($masp, $mattsp, $makh);
		$_SESSION['soluongmua'] = $this->session->userdata('soluongmua') - 1;
		header('Location: '.base_url(). 'index.php/GioHangController');
	}
	public function TaoHoaDon()
	{
		$idsp = $this->input->post('idsp');
		$idttsp = $this->input->post('idttsp');
		$soluong = $this->input->post('soluong');
		$makm = $this->input->post('makm');
		$makh = $this->session->userdata('makh');
		$ngaylaphd = date("Y-m-d");
		$this->load->model('GioHangModel');
		$this->GioHangModel->TaoHoaDon($makh, $makm, 0, $ngaylaphd, 0, 0, 0);
		$idhoadon = $this->db->insert_id();

		for($i = 0; $i < count($idsp); $i++){
			$demsoluongsp = $this->GioHangModel->DemSoLuongSP($idttsp[$i]);
			// echo $demsoluongsp[0]['total'];
			$data = array(
						'idsp' => $idsp[$i],
						'idttsp' => $idttsp[$i],
						'soluong' => $soluong[$i],
					);
			if($demsoluongsp[0]['total'] >= $soluong[$i])
			{
				$query = $this->GioHangModel->TaoCTHD($idhoadon, $idsp[$i], $idttsp[$i], $soluong[$i], 0);
				
				if(!$query)
				{
					
					$this->load->view('view_success/thongbaotaohdthanhcong', $data);
					$this->GioHangModel->XoaSPTrongGio($idsp[$i], $idttsp[$i], $makh);
				}
				else
				{
					$this->load->view('view_error/thongbaotaohdthatbai', $data);
				}
			}
			else {
				$this->load->view('view_error/thongbaohethang', $data);
			}
		}
		// for($i = 0; $i < count($idsp); $i++) {
			
		// }

		$dataNVGiaoHang = $this->GioHangModel->getNVGiaoHang();
		// var_dump($dataNVGiaoHang);
		$manv = $dataNVGiaoHang[array_rand($dataNVGiaoHang)]['MaNV'];
		// var_dump($manv['MaNV']);
		$this->GioHangModel->TaoGiaoHang($idhoadon, $manv, 0);
	}
}

/* End of file GioHangController.php */




?>
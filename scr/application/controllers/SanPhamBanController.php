<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class SanPhamBanController extends CI_Controller {

	public function __construct(){
         parent::__construct();
         $this->load->model('SanPhamBanModel');
         $this->load->helper(array('form', 'url'));
         $this->load->library('form_validation');
         $this->load->library("pagination");
         $this->load->helper('security');
    }
	public function TimKiem()
	{
		$timkiem = $this->input->post('timkiem');
		$data = $this->SanPhamBanModel->TimKiem($timkiem);
		$datasotrang = $this->SanPhamBanModel->getSoTrangtimkiem($timkiem);
		// var_dump($data);
		$data = array(
			'product' => $data,
			// 'timkiem' => $timkiem
			'datasotrang' => $datasotrang,
		);
		$this->load->view('SanPhamBan', $data);
		
	}
	public function index($trang=0)
	{
		// $this->load->model('SanPhamBanModel');
		$datasp = $this->SanPhamBanModel->getData($trang);
		$datasotrang = $this->SanPhamBanModel->getSoTrang();
        // $data['product'] = $this->SanPhamBanModel->getproduct();
        // $data['category'] = $this->SanPhamBanModel->getcategory();
		$data = array(
			'product' => $datasp,
			'datasotrang' => $datasotrang,
		);
		$this->load->view('SanPhamBan', $data);
		// var_dump($data);
	}
	public function gia($giabd, $giakt)
	{
		$data['product'] = $this->SanPhamBanModel->getproductgia($giabd, $giakt);
		$data['datasotrang'] = $this->SanPhamBanModel->getSoTrangGia($giabd, $giakt);
		$this->load->view('SanPhamBan', $data);
	}
	public function loaisp($maloaisp)
	{
		$data['product'] = $this->SanPhamBanModel->getproductloaisp($maloaisp);
		$data['datasotrang'] = $this->SanPhamBanModel->getSoTrangloaisp($maloaisp);
		$this->load->view('SanPhamBan', $data);
	}
	public function camera($camera)
	{
		$data['product'] = $this->SanPhamBanModel->getproductcamera($camera);
		$data['datasotrang'] = $this->SanPhamBanModel->getSoTrangcamera($camera);
		$this->load->view('SanPhamBan', $data);
	}
	public function ram($ram)
	{
		$data['product'] = $this->SanPhamBanModel->getproductram($ram);
		$data['datasotrang'] = $this->SanPhamBanModel->getSoTrangram($ram);
		$this->load->view('SanPhamBan', $data);
	}
	public function bonhotrong($bonhotrong)
	{
		$data['product'] = $this->SanPhamBanModel->getproductbonhotrong($bonhotrong);
		$data['datasotrang'] = $this->SanPhamBanModel->getSoTrangbonhotrong($bonhotrong);
		$this->load->view('SanPhamBan', $data);
	}
	public function kichthuocmanhinh($kichthuocmanhinh)
	{
		$data['product'] = $this->SanPhamBanModel->getproductkichthuocmanhinh($kichthuocmanhinh);
		$data['datasotrang'] = $this->SanPhamBanModel->getSoTrangkichthuongmanhinh($kichthuocmanhinh);
		$this->load->view('SanPhamBan', $data);
	}
	public function thuonghieu($thuonghieu)
	{
		$data['product'] = $this->SanPhamBanModel->getprotuctthuonghieu($thuonghieu);
		$data['datasotrang'] = $this->SanPhamBanModel->getSoTrangthuonghieu($thuonghieu);
		$this->load->view('SanPhamBan', $data);
	}

}

/* End of file SanPhamBanController.php */


?>
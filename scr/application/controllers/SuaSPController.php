<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SuaSPController extends CI_Controller {
	
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
			if($this->session->userdata('level') === 'Quản lý' || $this->session->userdata('level') === 'Bán hàng' || $this->session->userdata('level') === 'Tiếp tân'){
				// tiện lấy data kho qua đây luôn
				$this->load->model('KhoModel');
				$dataKho = $this->KhoModel->getData();
				$dataKho = array("arrResultKho" => $dataKho);
				// tiện lấy khuyến mãi kho qua đây luôn
				$this->load->model('KhuyenMaiModel');
				$dataKM = $this->KhuyenMaiModel->getData();
				$dataKM = array("arrResultKM" => $dataKM);
				// tiện lấy loại sản phẩm loại sp qua đây luôn
				$this->load->model('ThemMoiSPModel');
				$dataLoaiSP = $this->ThemMoiSPModel->XemLoaiSP();
				$dataLoaiSP = $dataLoaiSP->result_array();
				$dataLoaiSP = array("arrResultLoaiSP" => $dataLoaiSP);
				// tiện lấy thương hiệu qua đây luôn
				$this->load->model('ThemMoiSPModel');
				$dataThuongHieu = $this->ThemMoiSPModel->XemTH();
				$dataThuongHieu = $dataThuongHieu->result_array();
				$dataThuongHieu = array("arrResultThuongHieu" => $dataThuongHieu);
				// mã sản phẩm lấy từ url
				$masp = $this->input->get('masp');
				$mattsp = $this->input->get('mattsp');
				// tiện lấy thông tin sản phẩm qua đây luôn
				$this->load->model('SanPhamModel');
				$dataSP = $this->SanPhamModel->getDataSP_TTSP($masp, $mattsp);
				$dataSP = array("arrResultSP" => $dataSP);
				// var_dump($dataSP);
				// var_dump($dataSP['arrResultSP'][0]);
				// megre mảng để truyền qua view :D
				$data = array_merge($dataKho, $dataKM, $dataLoaiSP, $dataThuongHieu, $dataSP);
				// truyền data qua view
				$this->load->view('SuaSPView', $data);
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}
	
		// thêm sản phẩm
		public function SuaSP()
		{
			// data để insert vào bảng sản phẩm
			$tensp = $this->input->post('tensp');
			$maloaisp = $this->input->post('loaisp');
			$math = $this->input->post('thuonghieu');
			$mota = $this->input->post('mota');
			// không lấy hình ảnh được bằng cách này ($hinhanh = $this->input->post('hinhanh');), nên ta sẽ lấy ảnh bằng hàm ở dưới (phần xử lí ảnh upload)
			// data để insert vào bảng thông tin sản phẩm
			$gia = $this->input->post('gia');
			$giakm = $this->input->post('giakm');
			$kho = $this->input->post('kho');
			$soluong = $this->input->post('soluong');
			$ram = $this->input->post('ram');
			$bonhotrong = $this->input->post('rom');
			$pin = $this->input->post('pin');
			$kichthuocmh = $this->input->post('kichthuocmh');
			$camtruoc = $this->input->post('camtruoc');
			$camsau = $this->input->post('camsau');
			$mausac = $this->input->post('mausac');
			$cpu = $this->input->post('cpu');
			// data lấy từ url
			$masp = $this->input->get('masp');
			$mattsp = $this->input->get('mattsp');
			echo $tensp; echo "\n";
			echo $maloaisp;echo "\n";
			echo $math;echo "\n";
			echo $mota;echo "\n";
			echo $gia;echo "\n";
			echo $giakm;echo "\n";
			echo $kho;echo "\n";
			echo $soluong;echo "\n";
			echo $ram;echo "\n";
			echo $bonhotrong;echo "\n";
			echo $pin;echo "\n";
			echo $kichthuocmh;echo "\n";
			echo $camtruoc;echo "\n";
			echo $camsau;echo "\n";
			echo $mausac;echo "\n";
			echo $cpu;echo "\n";
			if($tensp == '' || $maloaisp == '' || $math == '' || $mota == '' || $gia == '' || $giakm == '' || $kho == '' || $soluong == '' || $ram == '' || $bonhotrong == '' || $pin == '' || $kichthuocmh == '' || $camtruoc == '' || $camsau == '' || $mausac == '' || $cpu == '')
			{
				echo "Vui lòng nhập đầy đủ thông tin";
			}
			else
			{
				// xử lý ảnh
				$target_dir = "fileupload/";
				$target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["hinhanh"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
				}

				// Check if file already exists
				if (file_exists($target_file)) {
				echo "Đã có 1 file trùng tên trong ổ cứng.";
				$uploadOk = 0;
				}

				// Check file size: giới hạn 50MB (quá to)
				if ($_FILES["hinhanh"]["size"] > 50000000) {
				echo "Dung lượng file quá lớn.";
				$uploadOk = 0;
				}

				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				echo "Chỉ chấp nhận file ảnh(JPG, JPEG, PNG & GIF files).";
				$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				echo "Lỗi! File chưa được upload.";
				// if everything is ok, try to upload file
				} else {
				if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
					echo "The file ". htmlspecialchars( basename( $_FILES["hinhanh"]["name"])). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
				}
				$hinhanh =  base_url(). "fileupload/" . basename( $_FILES["hinhanh"]["name"]);
				
				
				if($hinhanh != base_url(). "fileupload/")
				{
					echo "<pre>";
						print_r ($hinhanh);
					echo "</pre>";
					// $masp = 28;
					// $mattsp = 22;
					
					echo "<pre>";
					if($masp == null) print_r('không lấy được rồi Thắng ơi');
					else print_r('vẫn lấy đc nè!');
					echo "</pre>";
					
					
					echo "<pre>";
					print_r ($mattsp);
					echo "</pre>";

					// cập nhật sản phẩm bảng sản phẩm
					$this->load->model('SanPhamModel');
					$queryCapNhatTTSP = $this->SanPhamModel->CapNhatTTSP('thongtinsp', $mattsp, $masp, $kho, $gia, $giakm, $soluong, $mausac, $ram, $bonhotrong, $pin, $kichthuocmh, $camtruoc, $camsau, $cpu);
					$queryCapNhatSP = $this->SanPhamModel->CapNhatSP('sanpham', $masp, $tensp, $hinhanh, $mota, $maloaisp, $math);
					echo "<pre>";
					print_r ($queryCapNhatTTSP);
					echo "</pre>";
					
					echo "<pre>";
					print_r ($queryCapNhatSP);
					echo "</pre>";
					
					
					if ($queryCapNhatTTSP) {
						$queryCapNhatSP = $this->SanPhamModel->CapNhatSP('sanpham', $masp, $tensp, $hinhanh, $mota, $maloaisp, $math);
						if ($queryCapNhatSP)
						{
							echo "Cập nhật thông tin sản phẩm thành công";
							// chuyển hướng về trang sản phẩm
							$linkChuyenHuong = base_url() . "index.php/SanPhamController";
							header("Location: $linkChuyenHuong");
						}
						else
						{
							echo "<pre>";
							print_r ("Cập nhật thông tin sản phẩm thất bại");
							echo "</pre>";
							
						}
					}
					else
					{
						echo "<pre>";
						print_r ("Thêm sản phẩm thất bại");
						echo "</pre>";	
					}
				}
				else
				{
					echo "<pre>";
						print_r ("Không có hình ảnh nên không cập nhật được hình ảnh ở đây nha");
					echo "</pre>";
					// $masp = 28;
					// $mattsp = 22;
					
					echo "<pre>";
					if($masp == null) print_r('không lấy được rồi Thắng ơi');
					else print_r($masp);
					echo "</pre>";
					
					
					echo "<pre>";
					print_r ($mattsp);
					echo "</pre>";

					// cập nhật sản phẩm bảng sản phẩm
					$this->load->model('SanPhamModel');
					$queryCapNhatTTSP = $this->SanPhamModel->CapNhatTTSP('thongtinsp', $mattsp, $masp, $kho, $gia, $giakm, $soluong, $mausac, $ram, $bonhotrong, $pin, $kichthuocmh, $camtruoc, $camsau, $cpu);
					$queryCapNhatSP = $this->SanPhamModel->CapNhatSPKhongHinhAnh('sanpham', $masp, $tensp, $mota, $maloaisp, $math);
					echo "<pre>";
					print_r ($queryCapNhatTTSP);
					echo "</pre>";
					
					echo "<pre>";
					print_r ($queryCapNhatSP);
					echo "</pre>";
					
					
					if ($queryCapNhatTTSP) {
						if ($queryCapNhatSP)
						{
							echo "Cập nhật thông tin sản phẩm thành công";
							//chuyển hướng về trang sản phẩm
							$linkChuyenHuong = base_url() . "index.php/SanPhamController";
							header("Location: $linkChuyenHuong");
						}
						else
						{
							echo "<pre>";
							print_r ("Cập nhật thông tin sản phẩm thất bại");
							echo "</pre>";
							
						}
					}
					else
					{
						echo "<pre>";
						print_r ("Thêm sản phẩm thất bại");
						echo "</pre>";	
					}
				}
			}
		}
		// end: Thêm sản phẩm
	}
	
	/* End of file SuaSPController.php */
	
?>
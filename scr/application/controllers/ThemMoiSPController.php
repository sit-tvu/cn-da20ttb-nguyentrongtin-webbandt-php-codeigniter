<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class ThemMoiSPController extends CI_Controller {
	
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
				// megre 2 mảng để truyền qua view :D
				$data = array_merge($dataKho, $dataKM);
				// truyền data qua view
				$this->load->view('ThemMoiSPView', $data);
			
			}
			else {
				$this->load->view('view_error/tuchoitruycap');
			}
		}

		// begin: Thêm xóa sửa loại sản phẩm
		public function ThemLoaiSP()
		{
			$data = $this->input->post('data');
			$this->load->model('ThemMoiSPModel');
			$this->ThemMoiSPModel->ThemMoiLoaiSP($data);
			// var_dump($data);
		}
		public function XemLoaiSP()
		{
			$this->load->model('ThemMoiSPModel');
			$data = $this->ThemMoiSPModel->XemLoaiSP();
			// var_dump($data->num_rows());
			$output = '';
			if($data->num_rows() > 0)
			{
				foreach ($data->result() as $row) :
					$output .= '<tr>
									<th class="text-center" style="font-weight: 300;">'.$row->MaLoaiSP.'</th>
									<th style="font-weight: 300;">'.$row->TenLoaiSP.'</th>
									<th class="text-center">
										<div class="btn btn-danger btn-xs"
											id="XoaLoaiSP"
											onclick="XoaLoaiSP('.$row->MaLoaiSP.')"
											role="button">
											<span
												class="glyphicon glyphicon-trash"></span>Xóa
										</div>
									</th>
								</tr>';
				endforeach;
				echo $output;
			}
			else
			{
				echo "Không có dữ liệu";
			}
		}
		public function XoaLoaiSP()
		{
			$maloaisp = $this->input->post('maloaisp');
			$this->load->model('ThemMoiSPModel');
			if($this->ThemMoiSPModel->XoaLoaiSP('loaisp', $maloaisp) == true)
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
			
		}
		// end: Thêm xóa sửa loại sản phẩm
	
		// begin: Thêm xóa sửa thương hiệu
		// thêm thương hiệu
		public function ThemTH()
		{
			$data = $this->input->post('data');
			$this->load->model('ThemMoiSPModel');
			$this->ThemMoiSPModel->ThemMoiTH($data);
		}
		// xem thương hiệu
		public function XemTH()
		{
			$this->load->model('ThemMoiSPModel');
			$data = $this->ThemMoiSPModel->XemTH();
			// var_dump($data->num_rows());
			$output = '';
			if($data->num_rows() > 0)
			{
				foreach ($data->result() as $row) :
					$output .= '<tr>
									<th class="text-center" style="font-weight: 300;">'.$row->MaTH.'</th>
									<th style="font-weight: 300;">'.$row->TenTH.'</th>
									<th class="text-center">
										<div class="btn btn-danger btn-xs"
											id="XoaTH"
											onclick="XoaTH('.$row->MaTH.')"
											role="button">
											<span
												class="glyphicon glyphicon-trash"></span>Xóa
										</div>
									</th>
								</tr>';
				endforeach;
				echo $output;
			}
			else
			{
				echo "Không có dữ liệu";
			}
		}
		//xóa thương hiệu
		public function XoaTH()
		{
			$math = $this->input->post('math');
			$this->load->model('ThemMoiSPModel');
			if($this->ThemMoiSPModel->XoaTH('thuonghieu', $math) == true)
			{	
				echo 1;
			}
			else
			{
				echo 0;
			}
			
		}
		// end: Thêm xóa sửa thương hiệu

		// begin: Thêm sản phẩm
		// load loại sản phẩm
		public function XemLoaiSP_inThemSP()
		{
			$this->load->model('ThemMoiSPModel');
			$data = $this->ThemMoiSPModel->XemLoaiSP_inThemSP();
			// var_dump($data->num_rows());
			$output = '';
			if($data->num_rows() > 0)
			{
				foreach ($data->result() as $row) :
					$output .= '<option value="'.$row->MaLoaiSP.'">'.$row->TenLoaiSP.'</option>';
				endforeach;
				echo $output;
			}
			else
			{
				echo "Không có dữ liệu";
			}
		}

		// load thương hiệu
		public function XemTH_inThemSP()
		{
			$this->load->model('ThemMoiSPModel');
			$data = $this->ThemMoiSPModel->XemTH_inThemSP();
			// var_dump($data->num_rows());
			$output = '';
			if($data->num_rows() > 0)
			{
				foreach ($data->result() as $row) :
					$output .= '<option value="'.$row->MaTH.'">'.$row->TenTH.'</option>';
				endforeach;
				echo $output;
			}
			else
			{
				echo "Không có dữ liệu";
			}
		}
		// thêm sản phẩm
		public function ThemSP()
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
			
			// thêm sản phẩm vào bảng sản phẩm
			$this->load->model('ThemMoiSPModel');
			$queryThemSP = $this->ThemMoiSPModel->ThemMoiSP($tensp, $hinhanh, $mota, $maloaisp, $math);
			if ($queryThemSP) {
				// lấy mã sản phẩm vừa thêm xong
				$masp=$this->db->insert_id(); //its return last insert item on table   
				// echo $masp;
				$queryThemThongTinSP = $this->ThemMoiSPModel->ThemThongTinSP($masp, $kho, $gia, $giakm, $soluong, $mausac, $ram, $bonhotrong, $pin, $kichthuocmh, $camtruoc, $camsau, $cpu);
				if ($queryThemThongTinSP)
				{
					echo "Thêm thông tin sản phẩm thành công";
					// chuyển hướng về trang sản phẩm
					$linkChuyenHuong = base_url() . "index.php/SanPhamController";
					header("Location: $linkChuyenHuong");
				}
				else
				{
					echo "<pre>";
					print_r ("Thêm thông tin sản phẩm thất bại");
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
		// end: Thêm sản phẩm
		
	}
	
	/* End of file ThemMoiSPController.php */
	
?>
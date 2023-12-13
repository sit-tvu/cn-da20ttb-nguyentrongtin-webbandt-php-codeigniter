<?php 

	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class SuaTTController extends CI_Controller {
	
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
			$this->load->model('TinTucModel');
			$id = $this->input->get('id');
			$data = $this->TinTucModel->getDataByID($id);
			$data = array(
				'arrResult' => $data
			);
			$this->load->view('SuaTTView', $data);
		}
		public function SuaTinTuc()
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
			$id = $this->input->get('id');
			$tieude = $this->input->post('tieude');
			$mota = $this->input->post('mota');
			$noidung = $this->input->post('noidung');
			$ngaydang = date("Y-m-d H:i:s");
			$nguoidang = $this->session->userdata('username');
			$this->load->model('TinTucModel');
			if($hinhanh != base_url(). "fileupload/")
			{
				$this->TinTucModel->SuaTinTuc($id, $noidung, $tieude, $mota, $hinhanh, $nguoidang, $ngaydang);
			}
			else
			{
				$this->TinTucModel->SuaTinTucKhongHinhAnh($id, $noidung, $tieude, $mota, $nguoidang, $ngaydang, $nguoidang);
			}
			header("Location:". base_url() . "index.php/TinTucController");
		}
	
	}
	
	/* End of file SuaTTController.php */
	
?>

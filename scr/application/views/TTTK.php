<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trang chủ</title>

    <!-- Google Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600" rel="stylesheet"
        type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,100" rel="stylesheet" type="text/css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>CSS/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>CSS/font-awesome.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>CSS/owl.carousel.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>CSS/style.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>CSS/responsive.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
</head>

<body>
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="logo">
                        <h1>
                            <a href="<?php echo base_url(); ?>index.php/TrangChuController"
                                style="color: #ba0000; font-family: 'Ubuntu', sans-serif;"><img
                                    src="<?php echo base_url(); ?>img/nttshop.png" alt=""
                                    style="width: 100px; height: 60px;border-radius: 100%"> NTTShop</a>
                        </h1>
                    </div>
                </div>

                <div class="col-sm-4">
                    <?php 
						if($this->session->userdata('logged_in') === TRUE){
							echo "
											<div class='shopping-item' style='margin-left: 20px'>
												<a href=".site_url('DangNhapController/DangXuat') .">Đăng xuất</a></div>
							";
							echo "
								<div class='shopping-item' style='margin-left: 20px'>
									<a href=". base_url() ."index.php/TTTKController".">".$this->session->userdata('username')."</a></div>
                			";
						}
						else {
							echo "
								<div class='shopping-item' style='margin-left: 20px'>
									<a href=". base_url() ."index.php/DangNhapController".">Đăng nhập</a></div>
							";
							echo "
								<div class='shopping-item' style='margin-left: 20px'>
									<a href=". base_url() ."index.php/DangKiController".">Đăng ký</a></div>
							";
						}
					?>
                </div>
                <?php 
					if($this->session->userdata('logged_in') === TRUE) {
						echo "
							<div class='col-sm-1'>
								<div class='shopping-item'>
									<a href='".base_url()."index.php/GioHangController'>
                <i class='fa fa-shopping-cart'></i>
                </a>
            </div>
        </div>
        ";
        }
        ?>
            </div>
        </div>
    </div>
    <!-- End site branding area -->

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/TrangChuController">Trang chủ</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/SanPhamBanController">Sản phẩm</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>index.php/TinTucBanController">Tin tức</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/HoaDonKhachHang">Hóa đơn đã
                                mua</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End mainmenu area -->

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Thông tin tài khoản</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page title area -->

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">
                            Chi tiết thông tin của bạn
                        </h2>
                        <hr />
                        <?php 
							// var_dump($this->session->userdata);
							if($this->session->userdata('is_NV') === TRUE)
							{
								echo 
								"
								<form action='".base_url() ."index.php/TTTKController/SuaNV/?manv=".$arrResult[0]['MaNV']."' class='dangki' method='post' enctype='multipart/form-data'>
									<div class='form-group'>
										<label for='ten'>Mã nhân viên:</label>
										<input name='manv' type='text' class='form-control' id='manv' value='".$arrResult[0]['MaNV']."' placeholder='Mã nhân viên'/>
									</div>
									<div class='form-group'>
										<label for='ten'>Họ tên nhân viên:</label>
										<input name='tennv' type='text' class='form-control' id='tennv' value='".$arrResult[0]['TenNV']."' placeholder='Tên nhân viên'/>
									</div>
									<div class='form-group'>
										<label for='ten'>Ngày vào làm:</label>
										<input name='ngayvl' type='date' class='form-control' id='ngayvl' value='".$arrResult[0]['NgayVL']."' placeholder='Ngày VL nhân viên'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>Lương :</label>
										<input name='luong' type='text' class='form-control' id='luong' value='".$arrResult[0]['Luong']."' placeholder='Lương nhân viên'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>SDT :</label>
										<input name='sdt' type='text' class='form-control' id='sdt' value='".$arrResult[0]['SDT']."' placeholder='SDT nhân viên'/>
									</div>
									<div class='form-group'>
										<label for='email'>Email:</label>
										<input name='email' type='email' class='form-control' id='email' value='".$arrResult[0]['Email']."' placeholder='Email nhân viên'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>CMND :</label>
										<input name='cmnd' type='text' class='form-control' id='cmnd' value='".$arrResult[0]['CMND']."' placeholder='CMND nhân viên'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>Địa chỉ :</label>
										<input name='diachi' type='text' class='form-control' id='diachi' value='".$arrResult[0]['DiaChi']."' placeholder='Địa chỉ nhân viên'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>Loại nhân viên :</label>
										<input name='loainv' type='text' class='form-control' id='loainv' value='".$arrResult[0]['LoaiNV']."' placeholder='Loại nhân viên'/>
									</div>
									<p><b>Lưu ý</b>: Bạn muốn đổi mật khẩu? Hãy nhập các trường mật khẩu.</p>
									<div class='form-group'>
										<label for='pwd'>Mật khẩu:</label>
										<input name='password' type='password' class='form-control' id='pwd' />
									</div>
									<div class='form-group'>
										<label for='repassword1'>Nhập mật khẩu mới:</label>
										<input name='repassword1' type='password' class='form-control' id='repassword' />
									</div>
									<div class='form-group'>
										<label for='repassword'>Nhập lại mật khẩu mới:</label>
										<input name='repassword2' type='password' class='form-control' id='repassword' />
									</div>
									<input type='submit' value='Cập nhật' class='btn btn-default' />
								</form>
								";
							}
							else
							{
								echo 
								"
								<form action='".base_url() ."index.php/TTTKController/SuaKH/?makh=".$arrResult[0]['MaKH']."' class='dangki' method='post' enctype='multipart/form-data'>
									<div class='form-group'>
										<label for='ten'>Mã khách hàng:</label>
										<input name='makh' type='text' class='form-control' id='makh' value='".$arrResult[0]['MaKH']."' placeholder='Mã khách hàng'/>
									</div>
									<div class='form-group'>
										<label for='ten'>Họ tên khách hàng:</label>
										<input name='tenkh' type='text' class='form-control' id='tenkh' value='".$arrResult[0]['TenKH']."' placeholder='Tên khách hàng'/>
									</div>
									<div class='form-group'>
										<label for='ten'>Giói tính:</label>
										<input name='gioitinh' type='text' class='form-control' id='gioitinh' value='".$arrResult[0]['GioiTinh']."' placeholder='Giói tính khách hàng'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>SDT :</label>
										<input name='sdt' type='text' class='form-control' id='sdt' value='".$arrResult[0]['SDT']."' placeholder='SDT khách hàng'/>
									</div>
									<div class='form-group'>
										<label for='email'>Email:</label>
										<input name='email' type='email' class='form-control' id='email' value='".$arrResult[0]['Email']."' placeholder='Email khách hàng'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>CMND :</label>
										<input name='cmnd' type='text' class='form-control' id='cmnd' value='".$arrResult[0]['CMND']."' placeholder='CMND khách hàng'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>Địa chỉ :</label>
										<input name='diachi' type='text' class='form-control' id='diachi' value='".$arrResult[0]['DiaChi']."' placeholder='Địa chỉ khách hàng'/>
									</div>
									<div class='form-group'>
										<label for='sdt'>Loại khách hàng :</label>
										<input name='loaikh' type='text' class='form-control' id='loaikh' value='".$arrResult[0]['LoaiKH']."' placeholder='Loại khách hàng'/>
									</div>
									<p><b>Lưu ý</b>: Bạn muốn đổi mật khẩu? Hãy nhập các trường mật khẩu.</p>
									<div class='form-group'>
										<label for='pwd'>Mật khẩu:</label>
										<input name='password' type='password' class='form-control' id='pwd' />
									</div>
									<div class='form-group'>
										<label for='repassword1'>Nhập mật khẩu mới:</label>
										<input name='repassword1' type='password' class='form-control' id='repassword' />
									</div>
									<div class='form-group'>
										<label for='repassword'>Nhập lại mật khẩu mới:</label>
										<input name='repassword2' type='password' class='form-control' id='repassword' />
									</div>
									<input type='submit' value='Cập nhật' class='btn btn-default' />
								</form>
								";
							}
						?>
                        <hr />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">
                            Tư vấn mua hàng miễn phí
                        </h2>
                        <ul>
                            <li><a href="#">Tổng đài: 0823 770 071</a></li>
                            <li><a href="#">SĐT: 0817 052 342</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">NTTShop</h2>
                        <p>
                            NTTShop hệ thống bán lẻ khắp ba miền, trải khắp
                            63 tỉnh thành luôn luôn mở rộng để phục vụ Khách
                            hàng trên toàn quốc. NTTShop cung cấp dịch vụ
                            bán hàng và phục vụ hàng đầu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


    <!-- jQuery sticky menu -->
    <script src="<?php echo base_url(); ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.sticky.js"></script>

    <!-- jQuery easing -->
    <script src="<?php echo base_url(); ?>js/jquery.easing.1.3.min.js"></script>

    <!-- Main Script -->
    <script src="<?php echo base_url(); ?>js/main.js"></script>

    <!-- Slider -->
    <script type="text/javascript" src="<?php echo base_url(); ?>js/bxslider.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/script.slider.js"></script>
</body>

</html>

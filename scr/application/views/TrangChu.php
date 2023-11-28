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
                                    src="<?php echo base_url(); ?>img/logontt.png" alt=""
                                    style="width: 100px; height: 60px;border-radius: 100%"> NTTShop</a>
                        </h1>
                    </div>
                </div>

                <div class="col-sm-4">
                    <?php 
						// var_dump($this->session->userdata);
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
                        <li class="active">
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
                        <h2>Trang chủ</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-area">
        <!-- Slider -->
        <div class="block-slider block-slider4">
            <ul class="" id="bxslider-home4">
                <li>
                    <img src="<?php echo base_url(); ?>img/h4-slide.png" alt="Slide" />
                    <div class="caption-group">
                        <h2 class="caption title">
                            iPhone
                            <span class="primary">6 <strong>Plus</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Dual SIM</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li>
                    <img src="<?php echo base_url(); ?>img/h4-slide2.png" alt="Slide" />
                    <div class="caption-group">
                        <h2 class="caption title">
                            by one, get one
                            <span class="primary">50% <strong>off</strong></span>
                        </h2>
                        <h4 class="caption subtitle">
                            school supplies & backpacks.*
                        </h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li>
                    <img src="<?php echo base_url(); ?>img/h4-slide3.png" alt="Slide" />
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple
                            <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">Select Item</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
                <li>
                    <img src="<?php echo base_url(); ?>img/h4-slide4.png" alt="Slide" />
                    <div class="caption-group">
                        <h2 class="caption title">
                            Apple
                            <span class="primary">Store <strong>Ipod</strong></span>
                        </h2>
                        <h4 class="caption subtitle">& Phone</h4>
                        <a class="caption button-radius" href="#"><span class="icon"></span>Shop now</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- End slider area -->
    
    <!-- End main content area -->

    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title" style="color: black">
                        Danh sách các hãng
                    </h2>
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="<?php echo base_url(); ?>img/brand1.png" alt="" />
                            <img src="<?php echo base_url(); ?>img/brand2.png" alt="" />
                            <img src="<?php echo base_url(); ?>img/brand3.png" alt="" />
                            <img src="<?php echo base_url(); ?>img/brand4.png" alt="" />
                            <img src="<?php echo base_url(); ?>img/brand5.png" alt="" />
                            <img src="<?php echo base_url(); ?>img/brand6.png" alt="" />
                            <img src="<?php echo base_url(); ?>img/brand1.png" alt="" />
                            <img src="<?php echo base_url(); ?>img/brand2.png" alt="" />
                        </div>
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

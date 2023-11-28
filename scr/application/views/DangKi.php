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
                    <div class="shopping-item">
                        <a href="<?php echo base_url(); ?>index.php/DangNhapController"> Đăng nhập </a>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="shopping-item">
                        <a href="<?php echo base_url(); ?>index.php/GioHangController">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </div>
                </div>
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
                        <h2>Đăng kí</h2>
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
                        <h2 class="sidebar-title">Nhập thông tin</h2>
                        <hr />
                        <form action="<?php echo base_url(); ?>index.php/DangKiController/DangKi" class="dangki"
                            method="post">
                            <div class="form-group">
                                <label for="email">Họ tên:</label>
                                <input name="hoten" type="text" class="form-control" id="hoten" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Giới tính:</label>
                                <select name="gioitinh" id="" class="form-control" required>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">SDT :</label>
                                <input name="sdt" type="text" class="form-control" id="sdt" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" type="email" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="pwd">Mật khẩu:</label>
                                <input name="password1" type="password" class="form-control" id="pwd" />
                            </div>
                            <div class="form-group">
                                <label for="pwd">Nhập lại mật khẩu:</label>
                                <input name="password2" type="password" class="form-control" id="pwd" />
                            </div>
                            <div class="form-group">
                                <label for="email">CMDN :</label>
                                <input name="cmnd" type="text" class="form-control" id="sdt" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Địa chỉ :</label>
                                <input name="diachi" type="text" class="form-control" id="sdt" required />
                            </div>

                            <input type="submit" value="Đăng kí" class="btn btn-default" />
                        </form>
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

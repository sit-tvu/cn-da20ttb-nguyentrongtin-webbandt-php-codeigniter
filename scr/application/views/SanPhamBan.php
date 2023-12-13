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
                        <li class="active">
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
                        <h2>Danh sách sản phẩm</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <form class="search" action="<?php echo base_url(); ?>index.php/SanPhamBanController/TimKiem"
                        method="post">
                        <h2>Tìm kiếm</h2>
                        <input type="text" style="width:73%; margin-bottom: 20px;" name="timkiem">
                        <input type="submit" value="Tìm">
                    </form>
                    <div class="left-sidebar">
                        <h2>Bộ lọc</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Loại sản phẩm
                                        </a>
                                    </h4>
                                </div>
                                <div id="sportswear" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul style="list-style:none">
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/loaisp/1">Điện
                                                    thoại</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/loaisp/2">Máy
                                                    tính bảng</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Giá
                                        </a>
                                    </h4>
                                </div>
                                <div id="mens" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul style="list-style: none;">
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/gia/0/5000000">Thấp
                                                    hơn 5 triệu</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/gia/5000000/10000000">5
                                                    đến 10
                                                    triệu</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/gia/10000000/15000000">10
                                                    đến 15 triệu</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/gia/15000000/150000000">Trên
                                                    15 triệu</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#camera">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Camera
                                        </a>
                                    </h4>
                                </div>
                                <div id="camera" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul style="list-style:none">
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/camera/8">8MP</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/camera/12">12MP</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/camera/24">24MP</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/camera/48">48MP</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#ram">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Ram
                                        </a>
                                    </h4>
                                </div>
                                <div id="ram" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul style="list-style:none">
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/ram/2">2GB</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/ram/3">3GB</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/ram/4">4GB</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/ram/6">6GB</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/ram/8">8GB</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/ram/16">16GB</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#bonhotrong">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Bộ nhớ trong
                                        </a>
                                    </h4>
                                </div>
                                <div id="bonhotrong" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul style="list-style:none">
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/bonhotrong/64">64GB</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/bonhotrong/127">128GB</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/bonhotrong/256">256GB</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/bonhotrong/512">512GB</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#manhinh">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Màn hình
                                        </a>
                                    </h4>
                                </div>
                                <div id="manhinh" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul style="list-style:none">
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/kichthuocmanhinh/16">5'</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/kichthuocmanhinh/5.2">5.2'</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/kichthuocmanhinh/6">6'</a>
                                            </li>
                                            <li><a
                                                    href="<?php echo base_url(); ?>index.php/SanPhamBanController/kichthuocmanhinh/6.1">6.1'</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/category-productsr-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>Hãng</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/1">
                                            <span class="pull-right"></span>Apple</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/2">
                                            <span class="pull-right"></span>Samsung</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/3">
                                            <span class="pull-right"></span>Xiaomi</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/4">
                                            <span class="pull-right"></span>Huawei</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/5">
                                            <span class="pull-right"></span>Oppo</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/6">
                                            <span class="pull-right"></span>LG</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/7">
                                            <span class="pull-right"></span>Vivo</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/8">
                                            <span class="pull-right"></span>Sony</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/9">
                                            <span class="pull-right"></span>Nokia</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php/SanPhamBanController/thuonghieu/10">
                                            <span class="pull-right"></span>Realme</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="shipping text-center">
                            <img src="<?php echo base_url();?>img/shipping.jpg" alt="" />
                        </div> -->
                    </div>
                </div>
                <!-- <?php echo $datasp[0]->masp ?> -->
                <div class="col-sm-9 padding-right">
                    <?php foreach ($product as $item) : ?>
                    <div class="result">
                        <div class="col-md-3 col-sm-6">
                            <div class="single-shop-product">
                                <div class="product-upper">

                                    <a
                                        href="<?php echo base_url(); ?>index.php/CTSPController/?masp=<?php echo $item->masp  ?>&mattsp=<?php echo $item->mattsp  ?>"><img
                                            src="<?php echo $item->hinhanh ?>" alt="123" /></a>
                                </div>
                                <h2>
                                    <a
                                        href="<?php echo base_url(); ?>index.php/CTSPController/?masp=<?php echo $item->masp  ?>&mattsp=<?php echo $item->mattsp  ?>"><?php echo $item->tensp ?></a>
                                </h2>
                                <h6 class="tensp-sanphamban"><?php echo $item->mausac ?> -
                                    <?php echo $item->bonhotrong ?> GB</h6>
                                <div class="product-carousel-price">
                                    <ins><?php echo $item->GiaKM; ?> đ</ins> <del><?php echo $item->Gia ?> đ</del>
                                </div>

                                <div class="product-option-shop">
                                    <a class="add_to_cart_button" data-quantity="1" data-product_sku=""
                                        data-product_id="70" rel="nofollow"
                                        href="<?php echo base_url(); ?>index.php/CTSPController/?masp=<?php echo $item->masp  ?>&mattsp=<?php echo $item->mattsp  ?>">Xem
                                        chi
                                        tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                            <ul class="pagination">
                                <?php for ($i=0 ; $i < $datasotrang ; $i++ ) : ?>
                                <li class=""><a
                                        href="<?php echo base_url() ?>index.php/SanPhamBanController/index/<?php echo $i+1 ?>"><?php echo $i+1 ?></a>
                                </li>
                                <?php endfor?>
                            </ul>
                        </nav>
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
    <script>
    $(document).ready(function() {
        // console.log(2);
        $('.filter').change(function() {
            //on each click, refresh visible / hidden for each product
            // console.log(1);
            $('div.result').each(function(i, item) {
                var category = $(this).data('category');
                // console.log(category);
                var visible = $('input.filter[data-category="' +
                    category +
                    '"]:checked').length > 0;
                // console.log(visible);
                visible ? $(this).show() : $(this).hide();
            });
            //if no checkboxes are checked, show all products
            if ($('input.filter:checked').length === 0) $('div.result')
                .show();
        });
        $('.filter-gia').change(function() {
            //on each click, refresh visible / hidden for each product
            // console.log(1);
            $('div.result').each(function(i, item) {
                var gia = $(this).data('gia');
                // console.log(gia);
                // var visible = $('input.filter-gia[data-gia="' +
                //     gia +
                //     '"]:checked');
                var giaInput = $("input.filter-gia[data-gia]:checked").data('gia');
                // console.log(giaInput);
                (gia > giaInput) ? $(this).show(): $(this).hide();
            });
            //if no checkboxes are checked, show all products
            if ($('input.filter:checked').length === 0) $('div.result')
                .show();
        });
    });
    </script>
</body>












</html>
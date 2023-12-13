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
                        <h2>Chi tiết sản phẩm <?php echo $arrResult[0]['tensp'] ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="">Home</a>
                            <a href=""><?php echo $arrResult[0]['TenLoaiSP'] ?></a>
                            <a href=""><?php echo $arrResult[0]['tensp'] ?></a>
                        </div>

                        <div class="row">
                            <div class="col-sm-5">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="<?php echo $arrResult[0]['hinhanh']?>" />
                                    </div>

                                    <!-- <div class="product-gallery">
                                        <img src="<?php echo base_url(); ?>img/product-thumb-1.jpg" alt="" />
                                        <img src="<?php echo base_url(); ?>img/product-thumb-2.jpg" alt="" />
                                        <img src="<?php echo base_url(); ?>img/product-thumb-3.jpg" alt="" />
                                    </div> -->
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">
                                        <?php echo $arrResult[0]['tensp'] ?>
                                    </h2>
                                    <div class="product-inner-price">
                                        <ins><?php echo $arrResult[0]['GiaKM'] ?> đ</ins>
                                        <del><?php echo $arrResult[0]['Gia'] ?> đ</del>
                                    </div>
                                    <form
                                        action="<?php echo base_url(); ?>index.php/CTSPController/ThemVaoGio/?masp=<?php echo $arrResult[0]['masp']?>&mattsp=<?php echo $arrResult[0]['mattsp']?>"
                                        method="post" class="cart">
                                        <div class="quantity">
                                            <label for="">Số lượng</label>
                                            <input type="number" class="input-text qty text" value="1" name="soluong"
                                                min="1" step="1" />
                                        </div>
                                        <!-- <button class="add_to_cart_button" type="submit" style="margin-left: 14px;">
                                            Thêm vào giỏ
                                        </button> -->
                                        <?php if($arrResult[0]['SoLuong'] != 0)
											echo "<input class='add_to_cart_button' type='submit' value='Thêm vào giỏ'>";
										
											else echo "<button type='button' class='add_to_cart_button' data-toggle='modal'
														data-target='#myModal' style='width:153px; height:43px;font-size: 14px;'>
														THÊM VÀO GIỎ
													</button>";
										?>
                                        <!-- The Modal -->
                                        <div class="modal" id="myModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Thông báo</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        Sản phẩm này đã hết, vui lòng quay lại của hàng sau.
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông
                                                    tin chi tiết</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#profile" aria-controls="profile" role="tab"
                                                    data-toggle="tab">Đánh giá</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="
                                                        tab-pane
                                                        fade
                                                        in
                                                        active
                                                    " id="home">
                                                <h2>Thông số kĩ thuật</h2>
                                                <table class="table table-striped">
                                                    <tr>
                                                        <td>Loại sản phẩm</td>
                                                        <td><?php echo $arrResult[0]['TenLoaiSP'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thương hiệu</td>
                                                        <td><?php echo $arrResult[0]['TenTH'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mô tả</td>
                                                        <td><?php echo $arrResult[0]['mota'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Số lượng</td>
                                                        <td><?php echo $arrResult[0]['SoLuong'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Màu sắc</td>
                                                        <td><?php echo $arrResult[0]['mausac'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ram</td>
                                                        <td><?php echo $arrResult[0]['ram'] ?> GB</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bộ nhớ trong</td>
                                                        <td><?php echo $arrResult[0]['bonhotrong'] ?> GB</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pin</td>
                                                        <td><?php echo $arrResult[0]['pin'] ?> mAh</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kích thước màn hình</td>
                                                        <td><?php echo $arrResult[0]['kichthuongmanhinh'] ?> '</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Camera trước</td>
                                                        <td><?php echo $arrResult[0]['cameratruoc'] ?> MP</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Camera sau</td>
                                                        <td><?php echo $arrResult[0]['camerasau'] ?> MP</td>
                                                    </tr>
                                                    <tr>
                                                        <td>CPU</td>
                                                        <td><?php echo $arrResult[0]['cpu'] ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>
                                                    Bình luận - Đánh giá
                                                </h2>
                                                <form class="submit-review"
                                                    action="<?php echo base_url(); ?>index.php/CTSPController/ThemBinhLuan/?masp=<?php echo $arrResult[0]['masp'] ?>&mattsp=<?php echo $arrResult[0]['mattsp'] ?>"
                                                    method="post">
                                                    <p>
                                                        <label for="review">Bình luận - Đánh giá của bạn về sản
                                                            phẩm</label>
                                                        <textarea name="noidung" id="" cols="30" rows="10"></textarea>
                                                        <i>Phần đánh giá sẽ hiển thị ở cuối trang.</i>
                                                    </p>
                                                    </br>
                                                    <p>
                                                        <input type="submit" value="Gửi đánh giá" />
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">
                                Sản Phẩm Khác
                            </h2>
                            <div class="related-products-carousel">
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="<?php echo base_url(); ?>img/iphone11.jpg" alt="" />
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="
                                                            fa fa-shopping-cart
                                                        "></i>
                                                Thêm vào giỏ</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i>
                                                Xem chi tiết</a>
                                        </div>
                                    </div>

                                    <h2>
                                        <a href="">Iphone 11</a>
                                    </h2>

                                    <div class="product-carousel-price">
                                        <ins>10390000đ</ins>
                                        <del>11900000đ</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="<?php echo base_url(); ?>img/samsung-galaxy-a34-thumb-den-600x600.jpg" alt="" />
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="
                                                            fa fa-shopping-cart
                                                        "></i>
                                                Thêm vào giỏ</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i>
                                                Xem chi tiết</a>
                                        </div>
                                    </div>

                                    <h2>
                                        <a href="">Samsung A34</a>
                                            
                                    </h2>
                                    <div class="product-carousel-price">
                                        <ins>7490000đ</ins>
                                        <del>8499000đ</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="<?php echo base_url(); ?>img/ip13.jpeg" alt="" />
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="
                                                            fa fa-shopping-cart
                                                        "></i>
                                                Thêm vào giỏ</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i>
                                                Xem chi tiết</a>
                                        </div>
                                    </div>

                                    <h2>
                                        <a href="">Iphone 13</a>
                                    </h2>

                                    <div class="product-carousel-price">
                                        <ins>17990000đ</ins>
                                        <del>15790000đ</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="<?php echo base_url(); ?>img/iphone-14-128gb.jpg" alt="" />
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="
                                                            fa fa-shopping-cart
                                                        "></i>
                                                Thêm vào giỏ</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i>
                                                Xem chi tiết</a>
                                        </div>
                                    </div>

                                    <h2>
                                        <a href="">Iphone 14</a>
                                    </h2>

                                    <div class="product-carousel-price">
                                        <ins>18490000đ</ins>
                                        <del>22990000đ</del>
                                    </div>
                                </div>
            
                            </div>
                        </div>
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">
                                Bình luận - Đánh giá
                            </h2>
                            <?php 
								if($countBL == 0)
									{
										echo "<i>Sản phẩm này chưa có bình luận - đánh giá nào.</i>";
									}
							?>
                            <div>
                                <?php foreach ($arrBinhLuan as $item) : ?>
                                <div class="well">
                                    <div class="media" style="width: 150px;">
                                        <a href="#">
                                            <img class="media-object" src="<?php echo base_url(); ?>/img/profile.png"
                                                alt="..." style="margin-left: 15px;" />
                                            <h6 style="margin-top: 10px;"><?php echo $item['TenKH'] ?></h6>
                                        </a>
                                    </div>
                                    <p class="binhluantext"><?php echo $item['NoiDung'] ?></p>
                                </div>
                                <?php endforeach ?>
                            </div>
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

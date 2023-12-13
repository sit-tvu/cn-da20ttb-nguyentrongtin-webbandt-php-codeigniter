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
                        <h2>Giỏ hàng</h2>
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
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="<?php echo base_url() ?>index.php/GioHangController/TaoHoaDon">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px">Mã SP</th>
                                            <th style="width: 100px">Mã TTSP</th>
                                            <th class="product-thumbnail">
                                                Hình ảnh
                                            </th>
                                            <th class="product-name">
                                                Sản phẩm
                                            </th>
                                            <th class="text-center">Màu sắc</th>
                                            <th class="product-price">
                                                Giá
                                            </th>
                                            <th class="product-quantity">
                                                Số lượng
                                            </th>
                                            <th class="product-remove">
                                                Xóa
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($arrResult as $item) : ?>
                                        <tr class="cart_item">
                                            <td class="text-center"><input type="text" name="idsp[]"
                                                    value="<?php echo $item['masp'] ?>"
                                                    style="width: 50px; background-color: #fff; border: none;outline:none;"
                                                    class="text-center">
                                            </td>
                                            <td class="text-center"><input type="text" name="idttsp[]"
                                                    value="<?php echo $item['mattsp'] ?>"
                                                    style="width: 50px; background-color: #fff; border: none;outline:none;"
                                                    class="text-center">
                                            </td>
                                            <td class="product-thumbnail">
                                                <a
                                                    href="<?php echo base_url() ?>index.php/CTSPController/?masp=<?php echo $item['masp'] ?>&mattsp=<?php echo $item['mattsp'] ?>"><img
                                                        width="145" height="145" alt="poster_1_up"
                                                        class="shop_thumbnail"
                                                        src="<?php echo $item['hinhanh'] ?>" /></a>
                                            </td>

                                            <td class="product-name">
                                                <a
                                                    href="<?php echo base_url() ?>index.php/CTSPController/?masp=<?php echo $item['masp'] ?>&mattsp=<?php echo $item['mattsp'] ?>"><?php echo $item['tensp'] ?></a>
                                            </td>
                                            <td><?php echo $item['mausac'] ?></td>
                                            <td class="product-price-ct">
                                                <span class="amount"><?php echo $item['GiaKM'] ?> đ</span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" size="4" class="input-text qty text"
                                                        title="Số lượng sản phẩm" name="soluong[]"
                                                        value="<?php echo $item['SoLuongMua'] ?>" min="0" step="1" />
                                                </div>
                                            </td>
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove"
                                                    href="<?php echo base_url() ?>index.php/GioHangController/XoaSPTrongGio?masp=<?php echo $item['masp'] ?>&mattsp=<?php echo $item['mattsp'] ?>">×</a>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                        </br>
                                        <tr>
                                            <td class="actions" colspan="8">
                                                <div class="coupon">
                                                    <label for="coupon_code" style="
                                                                margin-right: 20px; ;
                                                            ">Khuyến mãi:</label>
                                                    <select name="makm" id="makm">
                                                        <?php 
															foreach ($arrResultKM as $item) : 
																echo "<option value='".$item['MaKM']."'>".$item['SoPTKM']." % Từ ngày ".$item['TuNgay']." đền ngày ".$item['DenNgay']."</option>";
															endforeach;
														?>
                                                    </select>
                                                </div>
                                                <div class="cart-collaterals">
                                                    <div class="cart_totals">
                                                        <!-- <h2>Tổng</h2> -->

                                                        <table cellspacing="0">
                                                            <tbody>
                                                                <tr class="cart-subtotal">
                                                                    <th>Tổng tiền sản phẩm</th>
                                                                    <td>
                                                                        <span
                                                                            class="amount"><?php echo $arrTongTienSP[0]['tongtien']?>
                                                                            đ</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <input type="submit" value="Xác nhận" name="proceed" class="
                                                            checkout-button
                                                            button
                                                            alt
                                                            wc-forward
                                                        " />
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td class="actions" colspan="6">
                                                <div class="coupon">
                                                    <label for="coupon_code" style="
                                                                margin-right: 20px; ;
                                                            ">Nhân viên giao hàng: </label>
                                                    <select name="nvgh" id="makm">
                                                        <?php 
															foreach ($arrResultNVGH as $item) : 
																echo "<option value='".$item['MaNV']."'>".$item['TenNV']."</option>";
															endforeach;
														?>
                                                    </select>
                                                </div>

                                                <input type="submit" value="Xác nhận" name="proceed" class="
                                                            checkout-button
                                                            button
                                                            alt
                                                            wc-forward
                                                        " />
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </form>


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
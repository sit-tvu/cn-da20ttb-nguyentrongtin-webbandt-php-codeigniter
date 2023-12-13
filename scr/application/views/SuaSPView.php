<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản trị hệ thống</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>img/iconu.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="<?php echo base_url() ?>CSS/AdminLTE.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>CSS/admin.css">
    <meta property="fb:app_id" content="659513967881060">
    <link rel="stylesheet" href="<?php echo base_url() ?>CSS/_all-skins.min.css">
    <script src="<?php echo base_url() ?>js/loader.js"></script>
    <script src="<?php echo base_url() ?>ckeditor/ckeditor.js"></script>
</head>

<body class="skin-blue sidebar-mini">
    <script type="text/javascript" src="https://www.gstatic.com/charts/45/loader.js"></script>
    <div class="wrapper">
        <form method="post" enctype="multipart/form-data"
            action="<?php echo base_url();?>index.php/SuaSPController/SuaSP/?masp=<?php echo $arrResultSP[0]['masp']?>&mattsp=<?php echo $arrResultSP[0]['mattsp']?>">
            <header class="main-header">
                <a href="adminController" class="logo">
                    <span class="logo-lg">Quản trị hệ thống</span><img
                        style="width: 50px; height: 50px;transform: translate(-14px,0px);"
                        src="<?php echo base_url()?>img/logodtlt.jpg" alt="">
                </a>
                <nav class="navbar navbar-static-top" style="height: 50px">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>

                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav" style="height: 52px; padding: 1px">
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bells"></i>
                                    <span
                                        class="label label-warning"><?php echo $this->session->userdata('countHoaDon0')+$this->session->userdata('countDonHang0')?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="adminController">
                                                    <i class="fa fa-users text-aqua"></i>
                                                    <?php echo $this->session->userdata('countHoaDon0')?> Đơn hàng chưa
                                                    duyệt
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="GiaoHangController">
                                                    <i class="fa fa-users text-aqua"></i>
                                                    <?php echo $this->session->userdata('countDonHang0')?> Đơn hàng đang
                                                    giao
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li style="height: 52px">
                                <a target="_blank" href="<?php echo base_url() ?>index.php/TrangChuController">
                                    <i class="fas fa-home"></i>
                                    <span>Trang chủ</span>
                                </a>
                            </li>
                            <li class="dropdown user user-menu" style="height: 52px; padding: 0px">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url() ?>img/user-group.png" class="user-image"
                                        alt="User Image">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('username')?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo base_url() ?>img/user-group.png" class="img-circle"
                                            alt="User Image">
                                        <p><?php echo $this->session->userdata('username')?><small><?php echo $this->session->userdata('level')?></small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo site_url('TTTKController');?>"
                                                class="btn btn-default btn-flat">Thông tin chi
                                                tiết</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('DangNhapController/DangXuat');?>"
                                                class="btn btn-default btn-flat">Đăng xuất</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <?php if($this->session->userdata('level')=== 'Quản lý') : ?>
            <aside class='main-sidebar'>
                <section class='sidebar'>
                    <ul class='sidebar-menu'>
                        <li class='treeview'>
                            <a href='ThongKeController'>
                                <i class='fa fa-chart-bar'></i>
                                <span>Thống kê</span>
                            </a>
                        </li>
                        <li class='header'>QUẢN LÝ CỬA HÀNG</li>
                        <li class='treeview'>
                            <a href='TinTucController'>
                                <i class='glyphicon glyphicon-list'></i><span>Tin tức</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='SanPhamController'>
                                <i class='fa fa-archive'></i><span>Sản phẩm</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='KhoController'>
                                <i class='fa fa-store'></i><span>Kho</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='NhaCungCapController'>
                                <i class='fa fa-handshake'></i><span>Nhà cung cấp</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='NhapHangController'>
                                <i class='fa fa-shopping-cart'></i><span>Nhập hàng</span>
                            </a>
                        </li>
                        <li class='header'>QUẢN LÝ BÁN HÀNG</li>
                        <li class='treeview'>
                            <a href='KhuyenMaiController'>
                                <i class='fa fa-newspaper'></i> <span>Khuyến mãi</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='HoTroController'>
                                <i class='fa fa-envelope'></i> <span>Hổ trợ</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='HoaDonController'>
                                <i class='fa fa-calendar-check'></i> <span>Hóa đơn</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='GiaoHangController'>
                                <i class='fas fa-shipping-fast'></i> <span>Giao hàng</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='KhachHangController'>
                                <i class='fa fa-user'></i><span>Khách hàng</span>
                            </a>
                        </li>
                        </li>
                        <li class='header'>CÀI ĐẶT</li>
                        <li class='treeview'>
                            <a href='NhanVienController'>
                                <i class='fa fa-users'></i><span>Nhân viên</span>
                            </a>
                        </li>
                        <li><a href='<?php echo site_url('DangNhapController/DangXuat');?>'><i
                                    class='fa fa-sign-out-alt text-red'></i>
                                <span>Đăng xuất</span></a></li>
                    </ul>
                </section>
            </aside>
            <?php elseif($this->session->userdata('level')=== 'Bán hàng') : ?>
            <aside class='main-sidebar'>
                <section class='sidebar'>
                    <ul class='sidebar-menu'>
                        <li class='treeview'>
                            <a href='ThongKeController'>
                                <i class='fa fa-chart-bar'></i>
                                <span>Thống kê</span>
                            </a>
                        </li>
                        <li class='header'>QUẢN LÝ CỬA HÀNG</li>
                        <li class='treeview'>
                            <a href='TinTucController'>
                                <i class='glyphicon glyphicon-list'></i><span>Tin tức</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='SanPhamController'>
                                <i class='fa fa-archive'></i><span>Sản phẩm</span>
                            </a>
                        </li>
                        <li class='header'>QUẢN LÝ BÁN HÀNG</li>
                        <li class='treeview'>
                            <a href='KhuyenMaiController'>
                                <i class='fa fa-newspaper'></i> <span>Khuyến mãi</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='HoTroController'>
                                <i class='fa fa-envelope'></i> <span>Hổ trợ</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='HoaDonController'>
                                <i class='fa fa-calendar-check'></i> <span>Hóa đơn</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='KhachHangController'>
                                <i class='fa fa-user'></i><span>Khách hàng</span>
                            </a>
                        </li>
                        </li>
                        <li class='header'>CÀI ĐẶT</li>
                        <li><a href='<?php echo site_url('DangNhapController/DangXuat');?>'><i
                                    class='fa fa-sign-out-alt text-red'></i>
                                <span>Đăng xuất</span></a></li>
                    </ul>
                </section>
            </aside>
            <?php elseif($this->session->userdata('level')=== 'Tiếp tân') : ?>
            <aside class='main-sidebar'>
                <section class='sidebar'>
                    <ul class='sidebar-menu'>
                        <li class='treeview'>
                            <a href='ThongKeController'>
                                <i class='fa fa-chart-bar'></i>
                                <span>Thống kê</span>
                            </a>
                        </li>
                        <li class='header'>QUẢN LÝ CỬA HÀNG</li>
                        <li class='treeview'>
                            <a href='TinTucController'>
                                <i class='glyphicon glyphicon-list'></i><span>Tin tức</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='SanPhamController'>
                                <i class='fa fa-archive'></i><span>Sản phẩm</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='KhoController'>
                                <i class='fa fa-store'></i><span>Kho</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='NhaCungCapController'>
                                <i class='fa fa-handshake'></i><span>Nhà cung cấp</span>
                            </a>
                        </li>
                        <li class='header'>QUẢN LÝ BÁN HÀNG</li>
                        <li class='treeview'>
                            <a href='HoTroController'>
                                <i class='fa fa-envelope'></i> <span>Hổ trợ</span>
                            </a>
                        </li>
                        <li class='treeview'>
                            <a href='KhachHangController'>
                                <i class='fa fa-user'></i><span>Khách hàng</span>
                            </a>
                        </li>
                        </li>
                        <li class='header'>CÀI ĐẶT</li>
                        <li><a href='<?php echo site_url('DangNhapController/DangXuat');?>'><i
                                    class='fa fa-sign-out-alt text-red'></i>
                                <span>Đăng xuất</span></a></li>
                    </ul>
                </section>
            </aside>
            <?php endif ?>
            <!----------------  Content  sửa Sản Phẩm  ------------->
            <div class="content-wrapper" style="min-height: 639px;">
                <section class="content-header">
                    <h1>
                        <i class="glyphicon glyphicon-phone"></i>Sửa thông tin sản phẩm
                    </h1>
                    <div class="breadcrumb">
                        <a class="btn btn-primary btn-sm"
                            href="<?php echo base_url()?>index.php/SuaSPController/SuaSP/?=<?php echo $arrResultSP[0]['masp']?>"
                            role="button">
                            <span class="glyphicon glyphicon-floppy-save"></span><input type="submit" value="Lưu">
                        </a>
                        <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>index.php/SanPhamController"
                            role="button">
                            <span class="glyphicon glyphicon-remove do_nos"></span>Thoát
                        </a>
                    </div>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box" id="view">
                                <div class="box-header with-border">
                                    <div class="box-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tên sản phẩm</label>
                                                <input type="text" class="form-control" name="tensp" style="width:100%"
                                                    value="<?php echo $arrResultSP[0]['tensp'] ?>"
                                                    placeholder="Tên sản phẩm">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <Label>Loại sản phẩm</Label>
                                                            <select name="loaisp" class="form-control"
                                                                id="XemLoaiSP_inThemSP">
                                                                <?php foreach ($arrResultLoaiSP as $item) : ?>
                                                                <?php 
																		if($item['MaLoaiSP']==$arrResultSP[0]['maloaisp'])
																		{
																			echo "<option value='".$item['MaLoaiSP']."' selected>".$arrResultSP[0]['TenLoaiSP']."</option>";
																		}
																		else
																		{
																			echo "<option value='".$item['MaLoaiSP']."'>".$item['TenLoaiSP']."</option>";
																		}
																?>
                                                                <?php endforeach?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <Label>Thương hiệu</Label>
                                                            <select name="thuonghieu" class="form-control"
                                                                id="XemTH_inThemSP">
                                                                <?php foreach ($arrResultThuongHieu as $item) : ?>
                                                                <?php
																		if($item['MaTH']==$arrResultSP[0]['math'])
																		{
																			echo "<option value='".$item['MaTH']."' selected>".$arrResultSP[0]['TenTH']."</option>";
																		}
																		else
																		{
																			echo "<option value='".$item['MaTH']."'>".$item['TenTH']."</option>";
																		}
																?>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Hình ảnh sản phẩm</label>
                                                            <?php echo substr($arrResultSP[0]['hinhanh'], 44);?>
                                                            <img style="width: 80px; height: 80px;"
                                                                src="<?php echo $arrResultSP[0]['hinhanh'];?>" alt="">
                                                            <div>
                                                                </br><b>Đổi thành</b>(không đổi, vui lòng không tải ảnh
                                                                lên)
                                                                </br>
                                                                </br>
                                                            </div>
                                                            <input type="file" id="image_list" name="hinhanh"
                                                                multiple="multiple"
                                                                value="<?php echo $arrResultSP[0]['hinhanh']?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>Mô tả</label>
                                                            <textarea name="mota" class="form-control"
                                                                style="height: 85px;" placeholder="Mô tả"
                                                                value="<?php echo $arrResultSP[0]['mota']?>"><?php echo $arrResultSP[0]['mota']?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <span style="color: red; font-weight: 700; font-size: 18;">Thông tin sản
                                                    phẩm</span>
                                                <div class="col-md-12" style="border-top:ridge; padding-top: 10px;">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Giá</label>
                                                            <input name="gia" class="form-control" type="number"
                                                                value="<?php echo $arrResultSP[0]['Gia']?>" min=" 0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <Label>Giá khuyến mãi</Label>
                                                            <input name="giakm" class="form-control" type="number"
                                                                value="<?php echo $arrResultSP[0]['GiaKM']?>" min=" 0">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <Label>Kho</Label>
                                                            <select name="kho" class="form-control">
                                                                <?php foreach ($arrResultKho as $item) : ?>
                                                                <?php 
																		if($item['makho']==$arrResultSP[0]['MaKho'])
																		{
																			echo "<option value='".$item['makho']."' selected>".$item['tenkho']."</option>";
																		}
																		else
																		{
																			echo "<option value='".$item['makho']."'>".$item['tenkho']."</option>";
																		}
																	?>
                                                                <?php endforeach?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <label>Số lượng</label>
                                                        <input name="soluong" class="form-control" type="number"
                                                            value="<?php echo $arrResultSP[0]['SoLuong']?>" min="0"
                                                            step="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Ram</label>
                                                            <input name="ram" class="form-control" type="number"
                                                                value="<?php echo $arrResultSP[0]['ram']?>" min="0"
                                                                max="256" step="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>Bộ nhớ trong</label>
                                                            <input name="rom" class="form-control" type="number"
                                                                value="<?php echo $arrResultSP[0]['bonhotrong']?>"
                                                                min="0" max="512" step="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Dung lượng Pin</label>
                                                            <input name="pin" class="form-control" type="number"
                                                                value="<?php echo $arrResultSP[0]['pin']?>" min="0"
                                                                max="100000" step="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>Kích thước màn hình</label>
                                                            <input name="kichthuocmh" class="form-control" type="number"
                                                                value="<?php echo $arrResultSP[0]['kichthuongmanhinh']?>"
                                                                min="0" max="100" step="0.1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Camera trước</label>
                                                            <input name="camtruoc" class="form-control" type="text"
                                                                placeholder="Camera trước"
                                                                value="<?php echo $arrResultSP[0]['cameratruoc']?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>Camera sau</label>
                                                            <input name="camsau" class="form-control" type="text"
                                                                placeholder="Camera sau"
                                                                value="<?php echo $arrResultSP[0]['camerasau']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Màu sắc</label>
                                                            <input name="mausac" class="form-control" type="text"
                                                                placeholder="Màu sắc"
                                                                value="<?php echo $arrResultSP[0]['mausac']?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>CPU</label>
                                                            <input name="cpu" class="form-control" type="text"
                                                                placeholder="CPU"
                                                                value="<?php echo $arrResultSP[0]['cpu']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() ?>js/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() ?>js/bootstrap.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>js/app.min.js"></script>
</body>



</html>
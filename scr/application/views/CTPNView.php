<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản trị hệ thống</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>img/iconu.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

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
        <header class="main-header">
            <a href="<?php echo base_url(); ?>index.php/adminController" class="logo">
                <span class="logo-lg">Quản trị hệ thống</span><img style="width: 50px; height: 50px;transform: translate(-14px,0px);" src="<?php echo base_url() ?>img/logodtlt.jpg" alt="">
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
                                <span class="label label-warning"><?php echo $this->session->userdata('countHoaDon0') + $this->session->userdata('countDonHang0') ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="<?php echo base_url(); ?>index.php/adminController">
                                                <i class="fa fa-users text-aqua"></i>
                                                <?php echo $this->session->userdata('countHoaDon0') ?> Đơn hàng chưa
                                                duyệt
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="<?php echo base_url(); ?>index.php/GiaoHangController">
                                                <i class="fa fa-users text-aqua"></i>
                                                <?php echo $this->session->userdata('countDonHang0') ?> Đơn hàng đang
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
                                <img src="<?php echo base_url() ?>img/user-group.png" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata('username') ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url() ?>img/user-group.png" class="img-circle" alt="User Image">
                                    <p><?php echo $this->session->userdata('username') ?><small><?php echo $this->session->userdata('level') ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('TTTKController'); ?>" class="btn btn-default btn-flat">Thông tin chi
                                            tiết</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('DangNhapController/DangXuat'); ?>" class="btn btn-default btn-flat">Đăng xuất</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/ThongKeController">
                            <i class="fa fa-chart-bar"></i>
                            <span>Thống kê</span>
                        </a>
                    </li>
                    <li class="header">QUẢN LÝ CỬA HÀNG</li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/TinTucController">
                            <i class="glyphicon glyphicon-list"></i><span>Tin tức</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/SanPhamController">
                            <i class="fa fa-archive"></i><span>Sản phẩm</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/KhoController">
                            <i class="fa fa-store"></i><span>Kho</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/NhaCungCapController">
                            <i class="fa fa-handshake"></i><span>Nhà cung cấp</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/NhapHangController">
                            <i class="fa fa-shopping-cart"></i><span>Nhập hàng</span>
                        </a>
                    </li>
                    <li class="header">QUẢN LÝ BÁN HÀNG</li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/KhuyenMaiController">
                            <i class="fa fa-newspaper"></i> <span>Khuyến mãi</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/HoTroController">
                            <i class="fa fa-envelope"></i> <span>Hổ trợ</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/HoaDonController">
                            <i class="fa fa-calendar-check"></i> <span>Hóa đơn</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/GiaoHangController">
                            <i class="fas fa-shipping-fast"></i> <span>Giao hàng</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url() ?>index.php/KhachHangController">
                            <i class="fa fa-user"></i><span>Khách hàng</span>
                        </a>
                    </li>
                    </li>
                    <li class="header">CÀI ĐẶT</li>
                    <li>
                        <a href="<?php echo base_url() ?>index.php/NhanVienController">
                            <i class="fa fa-users"></i> Nhân viên
                        </a>
                    </li>
                    <li><a href="admin/user/logout.html"><i class="fa fa-sign-out-alt text-red"></i>
                            <span>Thoát</span></a></li>
                </ul>
            </section>
        </aside>
        <!----------------  Content Chi tiết phiếu nhập  ------------->
        <form class="content-wrapper" style="min-height: 639px;" action="<?php echo base_url() ?>index.php/CTPNController/SuaPN/?mapn=<?php echo $arrResultPN[0]['MaPN'] ?>" method="post">
            <section class="content-header">
                <h1><i class="glyphicon glyphicon-ok-sign"></i> Chi tiết phiếu nhập</h1>
                <div class="breadcrumb">
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>index.php/NhapHangController" role="button">
                        <span class="glyphicon glyphicon-floppy-save"></span><input type="submit" value="Lưu">
                    </a>
                    <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>index.php/NhapHangController" role="button">
                        <span class="glyphicon glyphicon-remove do_nos"></span> Thoát
                    </a>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box" id="view">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="col-md-6" style="padding-left: 0px;">
                                        <div class="form-group">
                                            <label>Nhà cung cấp</label>
                                            <select name="nhacc" class="form-group" style="width:100%">
                                                <?php
                                                foreach ($arrResultNCC as $item) :
                                                    if ($item['MaNCC'] == $arrResultPN[0]['MaNCC'])
                                                        echo "<option value='" . $arrResultPN[0]['MaNCC'] . "' selected name='nhacc'>" . $item['TenNCC'] . "</option>";
                                                    else echo "<option value='" . $item['MaNCC'] . "' name='nhacc'>" . $item['TenNCC'] . "</option>";
                                                endforeach
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-right: 0px;">
                                        <div class="form-group">
                                            <label>Tình trạng thanh toán</label>
                                            <select class="form-control" name="tinhtrangtt">
                                                <?php
                                                if ($arrResultPN[0]['TinhTrangTT'] == 0) {
                                                    echo "<option value='0' selected>0. Chưa thanh toán</option>";
                                                    echo "<option value='1'>1. Đã thanh toán</option>";
                                                } else {
                                                    echo "<option value='0'>0. Chưa thanh toán</option>";
                                                    echo "<option value='1' selected>1. Đã thanh toán</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6" style="padding-left: 0px;">
                                        <div class="form-group">
                                            <label>Ngày lập phiếu</label>
                                            <input type="date" class="form-control" name="ngaylappn" min="0" style="width:100%" value="<?php echo $arrResultPN[0]['NgayLapPN'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-right: 0px;">
                                        <div class="form-group">
                                            <label>Nhân viên</label>
                                            <select name="manv" class="form-group" style="width:100%">
                                                <?php
                                                foreach ($arrResultNV as $item) :
                                                    if ($item['MaNV'] == $arrResultPN[0]['MaNV'])
                                                        echo "<option value='" . $arrResultPN[0]['MaNV'] . "' selected>" . $item['TenNV'] . "</option>";
                                                    else echo "<option value='" . $item['MaNV'] . "'>" . $item['TenNV'] . "</option>";
                                                endforeach
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span style="font-size: 16px; font-weight: 700;">Chi tiết phiếu nhập</span>
                        <div class="box" id="view">
                            <div class="box-body">
                                <div class="col-md-6" style="border-right:ridge">
                                    <div class="form-group">
                                        <label>Sản phẩm</label>
                                        <select name="masp" class="form-group" style="width:100%" id="sanpham">
                                            <?php
                                            foreach ($arrResultSP as $item) :
                                                if ($item['masp'] == $arrResultPN[0]['MaSP'])
                                                    echo "<option value='" . $arrResultPN[0]['MaSP'] . "' selected>" . $item['tensp'] . "</option>";
                                                else echo "<option value='" . $item['masp'] . "'>" . $item['tensp'] . "</option>";
                                            endforeach;
                                            ?>
                                        </select>
                                        <label>Giá nhập</label>
                                        <input type="number" class="form-control" id="gianhap" name="gianhap" min="0" style="width:100%" value="<?php echo $arrResultPN[0]['GiaNhap'] ?>">
                                        <label>Số lượng</label>
                                        <input type="number" class="form-control" id="soluong" name="soluong" min="0" step="1" style="width:100%; margin-bottom: 10;" value="<?php echo $arrResultPN[0]['SoLuong'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row" style="padding:0px; margin:0px;">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered" id="tbl_ctpn">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Thành tiền (số lượng x giá nhập)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="onRow">
                                                        <td class="text-center">
                                                            <input type="text" id="thanhtien" name="thanhtien" value="<?php echo $arrResultPN[0]['SoLuong'] * $arrResultPN[0]['GiaNhap'] ?>" class="text-center">
                                                            <script>
                                                                $('#gianhap').keyup(function() {
                                                                    var gianhap = $('#gianhap').val();
                                                                    var soluong = $('#soluong').val();
                                                                    var thanhtien = gianhap * soluong;
                                                                    $('#thanhtien').val(thanhtien);
                                                                });
                                                                $('#soluong').keyup(function() {
                                                                    var gianhap = $('#gianhap').val();
                                                                    var soluong = $('#soluong').val();
                                                                    var thanhtien = gianhap * soluong;
                                                                    $('#thanhtien').val(thanhtien);
                                                                });
                                                            </script>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
    </div>
    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() ?>js/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() ?>js/bootstrap.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>js/app.min.js"></script>
</body>







</html>l>
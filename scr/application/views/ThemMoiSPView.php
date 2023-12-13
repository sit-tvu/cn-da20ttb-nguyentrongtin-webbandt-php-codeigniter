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
            action="<?php echo base_url();?>index.php/ThemMoiSPController/ThemSP">
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
            <!----------------  Content  Thêm Sản Phẩm  ------------->
            <div class="content-wrapper" style="min-height: 639px;">
                <section class="content-header">
                    <h1>
                        <i class="glyphicon glyphicon-phone"></i>Thêm sản phẩm mới
                    </h1>
                    <div class="breadcrumb">
                        <a class="btn btn-primary btn-sm" href="SanPhamController" role="button">
                            <span class="glyphicon glyphicon-floppy-save"></span><input type="submit" value="Lưu">
                        </a>
                        <a class="btn btn-primary btn-sm" href="SanPhamController" role="button">
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
                                        <div class="col-md-8" style="border-right: ridge;">
                                            <div class="form-group">
                                                <label>Tên sản phẩm</label>
                                                <input type="text" class="form-control" name="tensp" style="width:100%"
                                                    placeholder="Tên sản phẩm">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <Label>Loại sản phẩm</Label>
                                                            <select name="loaisp" class="form-control"
                                                                id="XemLoaiSP_inThemSP">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <Label>Thương hiệu</Label>
                                                            <select name="thuonghieu" class="form-control"
                                                                id="XemTH_inThemSP">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <!-- <div class="form-group">
                                                            <label>Hình đại diện</label>
                                                            <input type="file" id="image_list" name="img" multiple
                                                                required style="width: 100%">
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label>Hình ảnh sản phẩm</label>
                                                            <input type="file" id="image_list" name="hinhanh"
                                                                multiple="multiple" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>Mô tả</label>
                                                            <textarea name="mota" class="form-control"
                                                                style="height: 85px;" placeholder="Mô tả"></textarea>
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
                                                                value="0" min="0">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <Label>Giá khuyến mãi</Label>
                                                            <input name="giakm" class="form-control" type="number"
                                                                value="0" min="0">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <Label>Kho</Label>
                                                            <select name="kho" class="form-control">
                                                                <?php foreach ($arrResultKho as $item) : ?>
                                                                <option value="<?php echo $item['makho'] ?>">
                                                                    <?php echo $item['tenkho'] ?></option>
                                                                <?php endforeach?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <label>Số lượng</label>
                                                        <input name="soluong" class="form-control" type="number"
                                                            value="0" min="0" step="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Ram</label>
                                                            <input name="ram" class="form-control" type="number"
                                                                value="0" min="0" max="256" step="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>Bộ nhớ trong</label>
                                                            <input name="rom" class="form-control" type="number"
                                                                value="0" min="0" max="256" step="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Dung lượng Pin</label>
                                                            <input name="pin" class="form-control" type="number"
                                                                value="0" min="0" max="100000" step="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>Kích thước màn hình</label>
                                                            <input name="kichthuocmh" class="form-control" type="number"
                                                                value="0" min="0" max="100" step="0.1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Camera trước</label>
                                                            <input name="camtruoc" class="form-control" type="text"
                                                                placeholder="Camera trước">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>Camera sau</label>
                                                            <input name="camsau" class="form-control" type="text"
                                                                placeholder="Camera sau">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6" style="padding-left: 0px;">
                                                        <div class="form-group">
                                                            <label>Màu sắc</label>
                                                            <input name="mausac" class="form-control" type="text"
                                                                placeholder="Màu sắc">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" style="padding-right: 0px;">
                                                        <div class="form-group">
                                                            <label>CPU</label>
                                                            <input name="cpu" class="form-control" type="text"
                                                                placeholder="CPU">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <span style="color: red; font-weight: 700; font-size: 18;">Loại sản
                                                phẩm</span>
                                            <div class="col-md-12" style="border:ridge; padding-top: 10px;">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered"
                                                        style="font-size: 14;">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">ID</th>
                                                                <th>Tên Loại sản phẩm</th>
                                                                <th class="text-center">Thao tác</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="XemLoaiSP">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="ThemLoaiSP">
                                                    <button id="themloaisp" class="btn btn-primary btn-sm"
                                                        href="ThemMoiSPController" role="button">
                                                        <span class="glyphicon glyphicon-plus"></span>Thêm LSP
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="margin-top: 10;">
                                            <span style="color: red; font-weight: 700; font-size: 18;">Thương
                                                hiệu</span>
                                            <div class="col-md-12" style="border:ridge; padding-top: 10px;">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered"
                                                        style="font-size: 14;">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">ID</th>
                                                                <th>Tên Thương hiệu</th>
                                                                <th class="text-center">Thao tác</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="XemTH">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="ThemTH" class="ThemTH">
                                                    <button id="themthuonghieu" class="btn btn-primary btn-sm"
                                                        href="ThemMoiSPController" role="button">
                                                        <span class="glyphicon glyphicon-plus"></span>Thêm TH
                                                    </button>
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
<script>
$(document).ready(function() {
    //load loại sản phẩm
    XemLoaiSP();
    // load loại sản phẩm trong phần thêm sản phẩm
    XemLoaiSP_inThemSP();
    //load thương hiệu
    XemTH();
    // load thương hiệu trong phần thêm sản phẩm
    XemTH_inThemSP();
});
// begin: Thêm xóa sửa loại sản phẩm
//thêm loại sản phẩm
$('body').on('click', '#themloaisp', function(e) {
    e.preventDefault();
    var data = $('input[name=ThemLoaiSP]').val();
    $.ajax({
        url: '<?=base_url()?>index.php/ThemMoiSPController/ThemLoaiSP',
        type: 'POST',
        async: true,
        cache: false,
        data: {
            data: data
        },
        success: function(data) {
            console.log(data);
        }
    });
    // khi bấm thêm
    // load loại sản phẩm
    XemLoaiSP();
    // load loại sản phẩm trong phần thêm sản phẩm
    XemLoaiSP_inThemSP();
    $('input[name=ThemLoaiSP]').val('');
});
// xem loại sản phẩm
function XemLoaiSP() {
    $.ajax({
        url: '<?=base_url()?>index.php/ThemMoiSPController/XemLoaiSP',
        type: 'POST',
        success: function(data) {
            $("#XemLoaiSP").html(data);
        }
    });
}
//xóa loại sản phẩm
function XoaLoaiSP(maloaisp) {
    if (confirm("Bạn có chắc chắn muốn xóa loại sản phẩm này ? ")) {
        $.ajax({
            url: '<?=base_url()?>index.php/ThemMoiSPController/XoaLoaiSP',
            type: 'POST',
            async: true,
            cache: false,
            data: {
                maloaisp: maloaisp
            },
            success: function(data) {
                if (data == 1) {
                    alert("Xóa thành công");
                } else {
                    alert("Xóa thất bại");
                }
            }
        });
    }
    // khi bấm xóa
    // load loại sản phẩm
    XemLoaiSP();
    // load loại sản phẩm trong phần thêm sản phẩm
    XemLoaiSP_inThemSP();
}
// end: thêm xóa sửa loại sản phẩm

//begin: thêm xóa sửa thương hiệu
//thêm thương hiệu
/**
 * Hữu Thắng 14:40 15/11/2021
 * warning note: keypress Enter not working or work wrong 
 * -> don't use it
 */
$('body').on('click', '#themthuonghieu', function(e) {
    e.preventDefault();
    var data = $('input[name=ThemTH]').val();
    $.ajax({
        url: '<?=base_url()?>index.php/ThemMoiSPController/ThemTH',
        type: 'POST',
        async: true,
        cache: false,
        data: {
            data: data
        },
        success: function(data) {
            console.log(data);
        }
    });
    // khi bấm thêm
    // load thương hiệu
    XemTH();
    // load thương hiệu trong phần thêm sản phẩm
    XemTH_inThemSP();
    $('input[name=ThemTH]').val('');
});

// xem thuong hiệu
function XemTH() {
    $.ajax({
        url: '<?=base_url()?>index.php/ThemMoiSPController/XemTH',
        type: 'POST',
        success: function(data) {
            $("#XemTH").html(data);
        }
    });
}
// xóa thương hiệu
function XoaTH(math) {
    if (confirm("Bạn có chắc chắn muốn xóa tên thương hiệu này ? ")) {
        $.ajax({
            url: '<?=base_url()?>index.php/ThemMoiSPController/XoaTH',
            type: 'POST',
            async: true,
            cache: false,
            data: {
                math: math
            },
            success: function(data) {
                if (data == 1) {
                    alert("Xóa thành công");
                } else {
                    alert("Xóa thất bại");
                }
            }
        });
    }
    // khi bấm xóa
    // load thương hiệu
    XemTH();
    // load thương hiệu trong phần thêm sản phẩm
    XemTH_inThemSP();
}
//end: thêm xóa sửa thương hiệu

// begin: thêm sản phẩm
// load loại sản phẩm
function XemLoaiSP_inThemSP() {
    $.ajax({
        url: '<?=base_url()?>index.php/ThemMoiSPController/XemLoaiSP_inThemSP',
        type: 'POST',
        success: function(data) {
            console.log(123);
            $("#XemLoaiSP_inThemSP").html(data);
        }
    });
}
// load thương hiệu
function XemTH_inThemSP() {
    $.ajax({
        url: '<?=base_url()?>index.php/ThemMoiSPController/XemTH_inThemSP',
        type: 'POST',
        success: function(data) {
            $("#XemTH_inThemSP").html(data);
        }
    });
}
// thêm sản phẩm
// thêm sản phẩm không dùng ajax, khi bấm thêm sẽ chuyển về trang danh sách sản phẩm
// end: thêm sản phẩm
</script>





</html>
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
        <header class="main-header">
            <a href="<?php echo base_url(); ?>index.php/adminController" class="logo">
                <span class="logo-lg">Quản trị hệ thống</span><img
                    style="width: 50px; height: 50px;transform: translate(-14px,0px);"
                    src="<?php echo base_url() ?>img/logodtlt.jpg" alt="">
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
                                    class="label label-warning"><?php echo $this->session->userdata('countHoaDon0') + $this->session->userdata('countDonHang0') ?></span>
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
                                <img src="<?php echo base_url() ?>img/user-group.png" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata('username') ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url() ?>img/user-group.png" class="img-circle"
                                        alt="User Image">
                                    <p><?php echo $this->session->userdata('username') ?><small><?php echo $this->session->userdata('level') ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('TTTKController'); ?>"
                                            class="btn btn-default btn-flat">Thông tin chi
                                            tiết</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('DangNhapController/DangXuat'); ?>"
                                            class="btn btn-default btn-flat">Đăng xuất</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php if ($this->session->userdata('level') === 'Quản lý') : ?>
        <aside class='main-sidebar'>
            <section class='sidebar'>
                <ul class='sidebar-menu'>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/ThongKeController'>
                            <i class='fa fa-chart-bar'></i>
                            <span>Thống kê</span>
                        </a>
                    </li>
                    <li class='header'>QUẢN LÝ CỬA HÀNG</li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/TinTucController'>
                            <i class='glyphicon glyphicon-list'></i><span>Tin tức</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/SanPhamController'>
                            <i class='fa fa-archive'></i><span>Sản phẩm</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/KhoController'>
                            <i class='fa fa-store'></i><span>Kho</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/NhaCungCapController'>
                            <i class='fa fa-handshake'></i><span>Nhà cung cấp</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/NhapHangController'>
                            <i class='fa fa-shopping-cart'></i><span>Nhập hàng</span>
                        </a>
                    </li>
                    <li class='header'>QUẢN LÝ BÁN HÀNG</li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/KhuyenMaiController'>
                            <i class='fa fa-newspaper'></i> <span>Khuyến mãi</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/HoTroController'>
                            <i class='fa fa-envelope'></i> <span>Hổ trợ</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/HoaDonController'>
                            <i class='fa fa-calendar-check'></i> <span>Hóa đơn</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/GiaoHangController'>
                            <i class='fas fa-shipping-fast'></i> <span>Giao hàng</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/KhachHangController'>
                            <i class='fa fa-user'></i><span>Khách hàng</span>
                        </a>
                    </li>
                    </li>
                    <li class='header'>CÀI ĐẶT</li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/NhanVienController'>
                            <i class='fa fa-users'></i><span>Nhân viên</span>
                        </a>
                    </li>
                    <li><a href='<?php echo site_url('DangNhapController/DangXuat'); ?>'><i
                                class='fa fa-sign-out-alt text-red'></i>
                            <span>Đăng xuất</span></a></li>
                </ul>
            </section>
        </aside>
        <?php elseif ($this->session->userdata('level') === 'Bán hàng') : ?>
        <aside class='main-sidebar'>
            <section class='sidebar'>
                <ul class='sidebar-menu'>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/ThongKeController'>
                            <i class='fa fa-chart-bar'></i>
                            <span>Thống kê</span>
                        </a>
                    </li>
                    <li class='header'>QUẢN LÝ CỬA HÀNG</li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/TinTucController'>
                            <i class='glyphicon glyphicon-list'></i><span>Tin tức</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/SanPhamController'>
                            <i class='fa fa-archive'></i><span>Sản phẩm</span>
                        </a>
                    </li>
                    <li class='header'>QUẢN LÝ BÁN HÀNG</li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/KhuyenMaiController'>
                            <i class='fa fa-newspaper'></i> <span>Khuyến mãi</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/HoTroController'>
                            <i class='fa fa-envelope'></i> <span>Hổ trợ</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/HoaDonController'>
                            <i class='fa fa-calendar-check'></i> <span>Hóa đơn</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/KhachHangController'>
                            <i class='fa fa-user'></i><span>Khách hàng</span>
                        </a>
                    </li>
                    </li>
                    <li class='header'>CÀI ĐẶT</li>
                    <li><a href='<?php echo site_url('DangNhapController/DangXuat'); ?>'><i
                                class='fa fa-sign-out-alt text-red'></i>
                            <span>Đăng xuất</span></a></li>
                </ul>
            </section>
        </aside>
        <?php endif ?>
        <!----------------  Content  ------------->
        <div class="content-wrapper" style="min-height: 639px;">
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3><?php echo $countSP['0']['total'] ?></h3>
                                <p>Sản phẩm</p>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                            </div>
                            <a href="<?php echo base_url(); ?>index.php/SanPhamController" class="small-box-footer">Danh
                                sách sản phẩm</a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo $countTT['0']['total'] ?></h3>
                                <p>Bài viết</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-chat "></i>
                            </div>
                            <a href="<?php echo base_url(); ?>index.php/TinTucController" class="small-box-footer">Danh
                                sách bài viết</a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?php echo $countNV['0']['total'] ?></h3>
                                <p>Nhân viên</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-email"></i>
                            </div>
                            <a href="<?php echo base_url(); ?>index.php/NhanVienController"
                                class="small-box-footer">Liên hệ nhân viên</a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?php echo $countGH['0']['total'] ?></h3>
                                <p>Đơn giao Hàng</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-cube"></i>
                            </div>
                            <a href="<?php echo base_url(); ?>index.php/GiaoHangController"
                                class="small-box-footer">Tình trạng giao hàng</a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="fa fa-shopping-basket"> Danh sách đơn hàng</h3>
                                <div class="brcb">
                                    <div class="searchbox">
                                        <input type="text" placeholder="Search here">
                                        <a><i class="fas fa-search-location"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row" style="padding:0px; margin:0px; height: 500px;">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered" style="font-size: 0.9em;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 20px;">MaHD</th>
                                                    <th>MaKH</th>
                                                    <th>Khách Hàng</th>
                                                    <!-- <th>Điện thoại</th> -->
                                                    <th>Tổng tiền</th>
                                                    <th>Ngày lập hóa đơn</th>
                                                    <th>Tình trạng giao hàng</th>
                                                    <th class="text-center">Xử lý đơn</th>
                                                    <th class="text-center">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($arrResult as $item) : ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $item['MaHD'] ?></td>
                                                    <td><?php echo $item['MaKH'] ?></td>
                                                    <td><?php echo $item['TenKH'] ?></td>
                                                    <td><?php echo $item['TongTienTT'] ?> đ</td>
                                                    <td><?php echo $item['NgayLapHD'] ?></td>
                                                    <td><?php 
														if($item['TinhTrangGH'] == 0)
														{
															echo "Chưa giao hàng";
														}
														else
														{
															echo "Đã giao hàng";
														}
													?></td>
                                                    <td style="text-align: center;">
                                                        <!-- <button class="btn btn-default btn-xs" role="button"
                                                            data-toggle="modal" data-target="#myModal">
                                                            <i class="fa fa-check-square"></i> Duyệt đơn
                                                        </button> -->
                                                        <?php 
															if($item['TinhTrangGH'] == 0)
															{
																echo '<button class="btn btn-default btn-xs" role="button"
																		data-toggle="modal" data-target="#myModal1">
																		<i class="fa fa-check-square"></i> Duyệt đơn
																	</button>';
															}
															else
															{
																echo '<button class="btn btn-default btn-xs" role="button"
																		data-toggle="modal" data-target="#myModal">
																		<i class="fa fa-check-square"></i> Duyệt đơn
																	</button>';
															}
														?>
                                                        <!-- The Modal -->
                                                        <form class="modal" id="myModal"
                                                            action="<?= base_url() ?>index.php/AdminController/ThanhToan/?mahd=<?php echo $item['MaHD'] ?>"
                                                            method="post">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Thanh toán</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        Nhập số tiền nhận
                                                                        <input type="text" name="tiennhan">
                                                                    </div>

                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <input type="submit" value="Thanh toán"
                                                                            type="button" class="btn btn-danger">
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- The Modal -->
                                                        <div class="modal" id="myModal1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Đơn này chưa được giao
                                                                        </h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        Hãy giao đơn này cho khách hàng trước khi thanh
                                                                        toán.
                                                                    </div>

                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <a href="<?php echo base_url(); ?>index.php/GiaoHangController"
                                                                            type="button" class="btn btn-danger">Đi đến
                                                                            giao hàng</a>
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-info btn-xs"
                                                            href="<?php echo base_url(); ?>index.php/CTHDController/?mahd=<?php echo $item['MaHD'] ?>"
                                                            role="button">
                                                            <span class="glyphicon glyphicon-eye-open"></span>Xem
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="pagination">
                            <li class="hidden-xs"><a
                                    href="<?php echo base_url() ?>index.php/AdminController/index/1">Trang đầu</a></li>
                            <?php for ($i = 0; $i < $SoTrang; $i++) : ?>
                            <li class=""><a
                                    href="<?php echo base_url() ?>index.php/AdminController/index/<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                            </li>
                            <?php endfor ?>
                            <li class="hidden-xs"><a
                                    href="<?php echo base_url() ?>index.php/AdminController/index/<?php echo $SoTrang ?>">Trang
                                    cuối</a></li>
                        </ul>
                    </div>
                </div>
            </section>

        </div>
    </div>
    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() ?>js/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() ?>js/bootstrap.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>js/app.min.js"></script>
</body>

















</html>

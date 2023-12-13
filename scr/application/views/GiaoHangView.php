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
        <?php elseif ($this->session->userdata('level') === 'Giao hàng') : ?>
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
                        <a href='<?php echo base_url(); ?>index.php/KhoController'>
                            <i class='fa fa-store'></i><span>Kho</span>
                        </a>
                    </li>
                    <li class='header'>QUẢN LÝ BÁN HÀNG</li>
                    <li class='treeview'>
                        <a href='<?php echo base_url(); ?>index.php/HoTroController'>
                            <i class='fa fa-envelope'></i> <span>Hổ trợ</span>
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
                    <li><a href='<?php echo site_url('DangNhapController/DangXuat'); ?>'><i
                                class='fa fa-sign-out-alt text-red'></i>
                            <span>Đăng xuất</span></a></li>
                </ul>
            </section>
        </aside>
        <?php endif ?>
        <!----------------  Content Giao hàng ------------->
        <div class="content-wrapper" style="min-height: 639px;">
            <section class="content-header">
                <h1><i class="glyphicon glyphicon-shopping-cart"></i> Giao hàng</h1>
                <div class="breadcrumb">
                    <div class="searchbox">
                        <input type="text" placeholder="Search here">
                        <a><i class="fas fa-search-location"></i></a>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box" id="view">
                            <div class="box-body">
                                <div class="row" style="padding:0px; margin:0px;">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Mã hóa đơn</th>
                                                    <th>NV giao hàng</th>
                                                    <th class="text-center">SĐT nhân viên</th>
                                                    <th class="text-center">Khách hàng</th>
                                                    <th class="text-center">ĐC Khách hàng</th>
                                                    <th class="text-center">SĐT Khách hàng</th>
                                                    <th class="text-center">Tình trạng GH</th>
                                                    <th class="text-center" colspan="2">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($arrResult as $item) : ?>
                                                <!-- The Modal 1-->
                                                <div class="modal" id="myModal1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Xác nhận giao hàng</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <p>Đơn hàng này đã được giao thành công.</p>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <a href="<?php echo base_url(); ?>index.php/AdminController"
                                                                    class="btn btn-danger">Đến thanh toán</a>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Đóng</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- The Modal 2-->
                                                <div class="modal" id="myModal2">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Xác nhận giao hàng</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <p><b>Xác nhận đã giao đơn hàng này?</b></p>
                                                                <p>Nếu đã giao hàng thành công, nhân viên giao hàng hãy
                                                                    bấm vào nút <b>Xác nhận</b> ở
                                                                    bên dưới.
                                                                </p>
                                                                <p>Nếu chưa giao hàng thành công, <b>bấm Hủy</b>.</p>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <a href="" class="btn-xacnhan">
                                                                    <button type="button" class="btn btn-success "
                                                                        text-align="center">Xác nhận</button></a>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Hủy</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <tr>
                                                    <td class="text-center"><?php echo $item['MaHD'] ?></td>
                                                    <td><?php echo $item['TenNV'] ?></td>
                                                    <td class="text-center"><?php echo $item['SDT'] ?></td>
                                                    <td class="text-center"><?php echo $item['TenKH'] ?></td>
                                                    <td class="text-center"><?php echo $item['DiaChiKH'] ?></td>
                                                    <td class="text-center"><?php echo $item['SDTKH'] ?></td>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url(); ?>index.php/GiaoHangController">
                                                            <?php
                                                                if ($item['TinhTrangGH'] == 1)
                                                                    echo "Đã giao hàng";
                                                                else
                                                                    echo "Chưa giao hàng";
                                                                ?>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            if ($item['TinhTrangGH'] == 1)
                                                                echo "<button type='button' class='btn btn-success btn-xs' data-toggle='modal' data-target='#myModal1'>Xác nhận</button>";
                                                            else
                                                                echo "<button type='button' class='btn btn-success btn-xs edittt' data-toggle='modal' data-target='#myModal2'>Xác nhận</button>";
                                                            ?>
                                                        <!-- <button type="button" class="btn btn-success btn-xs"
                                                            data-toggle="modal" data-target="#myModal">
                                                            Xác nhận
                                                        </button> -->
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-danger btn-xs"
                                                            href="<?php echo base_url() ?>index.php/GiaoHangController/XoaGH/?mahd=<?php echo $item['MaHD'] ?>&tinhtranggh=<?php echo $item['TinhTrangGH'] ?>"
                                                            onclick="return confirm('Xác nhận xóa đơn giao hàng này ?')"
                                                            role="button"
                                                            <?php
                                                                                                                                                                                                                                                                                                                            if ($item['TinhTrangGH'] == 0)
                                                                                                                                                                                                                                                                                                                                echo "disabled";
                                                                                                                                                                                                                                                                                                                            else
                                                                                                                                                                                                                                                                                                                                echo "";
                                                                                                                                                                                                                                                                                                                            ?>>
                                                            <span class="glyphicon glyphicon-trash"></span>Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><b>Lưu ý</b>: Chỉ có thể xóa đơn hàng đã được giao.</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <ul class="pagination">
                                                <li class="hidden-xs"><a
                                                        href="<?php echo base_url() ?>index.php/GiaoHangController/index/<?php echo 1 ?>">Trang
                                                        đầu</a></li>
                                                <?php for ($i = 0; $i < $SoTrang; $i++) : ?>
                                                <li class=""><a
                                                        href="<?php echo base_url() ?>index.php/GiaoHangController/index/<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a>
                                                </li>
                                                <?php endfor ?>
                                                <li class="hidden-xs"><a
                                                        href="<?php echo base_url() ?>index.php/GiaoHangController/index/<?php echo $SoTrang ?>">Trang
                                                        cuối</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box -->
                </div>
                <!-- /.col -->
            </section>
        </div>
    </div>
    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() ?>js/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script ript src="<?php echo base_url() ?>js/bootstrap.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>js/app.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.edittt').on('click', function() {
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(
                function() {
                    return $(this).text();
                }).get();
            console.log(data);
            console.log(data[0]);
            $(".btn-xacnhan").prop("href",
                "<?php echo base_url() ?>index.php/GiaoHangController/XacNhanGH/?mahd=" + data[0]);
        });
    })
    </script>
</body>




</html>

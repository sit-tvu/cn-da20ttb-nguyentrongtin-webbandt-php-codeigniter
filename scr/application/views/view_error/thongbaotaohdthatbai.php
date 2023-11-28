<!DOCTYPE html>
<html>

<head>
    <title>Thông báo tạo hóa đơn</title>
    <meta http-equiv="refresh" content="2; url = <?php echo base_url(); ?>index.php/HoaDonKhachHang" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="alert alert-danger text-center m-4" role="alert">
        <p>Thêm <?php echo $soluong ?> sản phẩm <?php echo "$idsp / $idttsp"?> thất bại.</p>
    </div>
</body>

</html>
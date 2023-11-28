
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `testweb`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Xoa_CTHD` (IN `p_MaHD` INT(10), IN `p_MaSP` INT(10), IN `p_mattsp` INT(10))  BEGIN
	DECLARE v_SoLuong INT;
    SELECT SoLuong INTO v_SoLuong
    FROM cthd
    WHERE MaHD = p_MaHD AND MaSP = p_MaSP AND mattsp = p_mattsp;
    
   	DELETE FROM cthd WHERE MaHD = p_MaHD AND MaSP = p_MaSP AND mattsp = p_mattsp;
    
    UPDATE thongtinsp
    SET SoLuong = SoLuong + v_SoLuong
    WHERE mattsp = p_mattsp;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Xoa_HD` (IN `p_MaHD` INT(10))  BEGIN
	DECLARE p_MaSP INT(10);
    DECLARE p_mattsp INT(10);
    DECLARE v_finished INT DEFAULT 0;
    
	DECLARE cur_ds_cthd CURSOR FOR SELECT MaSP, mattsp FROM cthd WHERE MaHD = p_MaHD;
    
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;
    OPEN cur_ds_cthd;
    	Xoa_HD: LOOP
        	FETCH cur_ds_cthd INTO p_MaSP, p_mattsp;
            IF v_finished = 1 THEN
            	LEAVE Xoa_HD;
            END IF;
            CALL Xoa_CTHD(p_MaHD, p_MaSP, p_mattsp);
        END LOOP Xoa_HD;
    CLOSE cur_ds_cthd;
    DELETE FROM hoadon WHERE MaHD = p_MaHD;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `MaBL` int(10) UNSIGNED NOT NULL,
  `MaSP` int(10) UNSIGNED NOT NULL,
  `MaTTSP` int(10) NOT NULL,
  `MaKH` int(10) UNSIGNED NOT NULL,
  `NoiDung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`MaBL`, `MaSP`, `MaTTSP`, `MaKH`, `NoiDung`) VALUES
(14, 7, 9, 13, 'In this product filter user can filter product details by different filter which we have make by using Checkbox, and even product can be filter'),
(15, 1, 1, 15, 'sản phẩm tốt'),
(16, 2, 3, 15, 'sản phẩm này rất đáng mua'),
(17, 1, 20, 13, 'sản phẩm này rất đáng mua nhé các bạn'),
(18, 2, 3, 13, 'sản phẩm tốt nhưng tiếc là hết hàng mất rồi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cthd`
--

CREATE TABLE `cthd` (
  `MaHD` int(10) UNSIGNED NOT NULL,
  `MaSP` int(10) UNSIGNED NOT NULL,
  `mattsp` int(10) UNSIGNED NOT NULL,
  `SoLuong` int(5) NOT NULL,
  `ThanhTien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cthd`
--

INSERT INTO `cthd` (`MaHD`, `MaSP`, `mattsp`, `SoLuong`, `ThanhTien`) VALUES
(93, 7, 9, 1, 8500000),
(94, 16, 31, 1, 32000000),
(94, 17, 32, 1, 29000000),
(95, 2, 3, 1, 17000000),
(95, 9, 11, 1, 9000000),
(95, 14, 28, 1, 16000000),
(96, 8, 10, 1, 1200000),
(97, 14, 29, 1, 30000000),
(97, 16, 31, 1, 32000000),
(98, 18, 33, 1, 25000000),
(99, 15, 30, 1, 33000000),
(100, 1, 20, 2, 17800000),
(101, 9, 11, 1, 9000000);

--
-- Bẫy `cthd`
--
DELIMITER $$
CREATE TRIGGER `After_Delete_CTHD` AFTER DELETE ON `cthd` FOR EACH ROW BEGIN
	DECLARE v_TongTien INT;
    DECLARE v_TienGiam INT;
    DECLARE v_SoPTKM TinyINT(4);
    DECLARE v_NgayMua Date;
    DECLARE v_TuNgay Date;
    DECLARE v_DenNgay Date;
    DECLARE v_TTienToiThieu INT;
    DECLARE v_MaKM INT;
    
    /*Tinh Tong Tien trong hoa don*/
    /*1. Tinh Tong tien chua ap dung khuyen mai*/
    	SELECT SUM(ThanhTien) INTO v_TongTien
        FROM cthd
        WHERE MaHD = OLD.MaHD;
        UPDATE hoadon
        SET TongTienTT = v_TongTien
        WHERE MaHD = OLD.MaHD;
    /*2. Lay thong tin tu hoa don*/
    	SELECT NgayLapHD, MaKM INTO v_NgayMua, v_MaKM 
        FROM hoadon
        WHERE MaHD = OLD.MAHD;
    /*3. Lay thong tin khuyen mai*/
    IF(v_MaKM IS NOT NULL) THEN
    	SELECT SoPTKM, TuNgay, DenNgay, TTienToiThieu
        INTO v_SoPTKM, v_TuNgay, v_DenNgay, v_TTienToiThieu
        FROM khuyenmai
        WHERE MaKM = v_MaKM;
        IF(v_NgayMua >= v_TuNgay AND v_NgayMua <= v_DenNgay AND v_TongTien >= v_TTienToiThieu) THEN
        	SET v_TienGiam = v_TongTien * (v_SoPTKM/100);
            UPDATE hoadon
            SET TongTienTT = v_TongTien - v_TienGiam
            WHERE MaHD = OLD.MaHD;
        END IF;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `After_Insert_CTHD` AFTER INSERT ON `cthd` FOR EACH ROW BEGIN
    DECLARE v_TongTien INT;
    DECLARE v_TienGiam INT;
    DECLARE v_SoPTKM TinyINT(4);
    DECLARE v_NgayMua Date;
    DECLARE v_TuNgay Date;
    DECLARE v_DenNgay Date;
    DECLARE v_TTienToiThieu INT;
    DECLARE v_MaKM INT;
    /*Tinh Tong Tien trong hoa don*/
    /*1. Tinh Tong tien chua ap dung khuyen mai*/
    	SELECT SUM(ThanhTien) INTO v_TongTien
        FROM cthd
        WHERE MaHD = NEW.MaHD;
        UPDATE hoadon
        SET TongTienTT = v_TongTien
        WHERE MaHD = new.MaHD;
    /*2. Lay thong tin tu hoa don*/
    	SELECT NgayLapHD, MaKM INTO v_NgayMua, v_MaKM 
        FROM hoadon
        WHERE MaHD = NEW.MAHD;
    /*3. Lay thong tin khuyen mai*/
    IF(v_MaKM IS NOT NULL) THEN
    	SELECT SoPTKM, TuNgay, DenNgay, TTienToiThieu
        INTO v_SoPTKM, v_TuNgay, v_DenNgay, v_TTienToiThieu
        FROM khuyenmai
        WHERE MaKM = v_MaKM;
        IF(v_NgayMua >= v_TuNgay AND v_NgayMua <= v_DenNgay AND v_TongTien >= v_TTienToiThieu) THEN
        	SET v_TienGiam = v_TongTien * (v_SoPTKM/100);
            UPDATE hoadon
            SET TongTienTT = v_TongTien - v_TienGiam
            WHERE MaHD = new.MaHD;
        END IF;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `After_Update_CTHD` AFTER UPDATE ON `cthd` FOR EACH ROW BEGIN
	DECLARE v_TongTien INT;
    DECLARE v_TienGiam INT;
    DECLARE v_SoPTKM TinyINT(4);
    DECLARE v_NgayMua Date;
    DECLARE v_TuNgay Date;
    DECLARE v_DenNgay Date;
    DECLARE v_TTienToiThieu INT;
    DECLARE v_MaKM INT;
    /*Tinh Tong Tien trong hoa don*/
    /*1. Tinh Tong tien chua ap dung khuyen mai*/
    	SELECT SUM(ThanhTien) INTO v_TongTien
        FROM cthd
        WHERE MaHD = NEW.MaHD;
        UPDATE hoadon
        SET TongTienTT = v_TongTien
        WHERE MaHD = new.MaHD;
    /*2. Lay thong tin tu hoa don*/
    	SELECT NgayLapHD, MaKM INTO v_NgayMua, v_MaKM 
        FROM hoadon
        WHERE MaHD = NEW.MAHD;
    /*3. Lay thong tin khuyen mai*/
    IF(v_MaKM IS NOT NULL) THEN
    	SELECT SoPTKM, TuNgay, DenNgay, TTienToiThieu
        INTO v_SoPTKM, v_TuNgay, v_DenNgay, v_TTienToiThieu
        FROM khuyenmai
        WHERE MaKM = v_MaKM;
        IF(v_NgayMua >= v_TuNgay AND v_NgayMua <= v_DenNgay AND v_TongTien >= v_TTienToiThieu) THEN
        	SET v_TienGiam = v_TongTien * (v_SoPTKM/100);
            UPDATE hoadon
            SET TongTienTT = v_TongTien - v_TienGiam
            WHERE MaHD = new.MaHD;
        END IF;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Before_Insert_CTHD` BEFORE INSERT ON `cthd` FOR EACH ROW BEGIN 
	DECLARE v_Gia INT; 
    DECLARE v_GiaKM INT; 
    DECLARE v_SoLuong INT; 
    /*Kiem tra so luong co du khong*/ 
    SELECT SoLuong INTO v_SoLuong 
    FROM thongtinsp 
    WHERE thongtinsp.mattsp = NEW.mattsp; 
    IF(v_SoLuong < NEW.SoLuong) THEN
    	 SIGNAL SQLSTATE '04000'
      	 SET MESSAGE_TEXT = 'Số lượng không đủ ', MYSQL_ERRNO = 4000; 
    END IF; 
    /*Cap nhat so luong san pham*/ 
    UPDATE thongtinsp 
    SET thongtinsp.SoLuong = thongtinsp.SoLuong - NEW.SoLuong 
    WHERE thongtinsp.mattsp = NEW.mattsp; 
    /*Lay gia san pham*/ 
    SELECT thongtinsp.Gia, thongtinsp.GiaKM 
    into v_Gia, v_GiaKM 
    FROM thongtinsp 
    WHERE thongtinsp.mattsp = NEW.mattsp AND thongtinsp.masp = NEW.masp; 
    /**/ 
    IF (v_GiaKM IS NOT NULL)THEN 
    	SET NEW.ThanhTien = v_GiaKM * NEW.SoLuong; 
    ELSE SET 
    	NEW.ThanhTien = v_Gia * NEW.SoLuong; 
    END IF; 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Before_Updated_CTHD` BEFORE UPDATE ON `cthd` FOR EACH ROW BEGIN 
	DECLARE v_Gia INT; 
    DECLARE v_GiaKM INT; 
    DECLARE v_SoLuong INT; 
    /*Kiem tra so luong co du khong*/ 
    SELECT SoLuong INTO v_SoLuong 
    FROM thongtinsp 
    WHERE thongtinsp.mattsp = NEW.mattsp; 
    IF((v_SoLuong + OLD.SoLuong) < NEW.SoLuong) THEN
    	 SIGNAL SQLSTATE '04000'
      	 SET MESSAGE_TEXT = 'Số lượng không đủ ', MYSQL_ERRNO = 4000; 
    END IF; 
    /*Cap nhat so luong san pham*/ 
    UPDATE thongtinsp 
    SET thongtinsp.SoLuong = thongtinsp.SoLuong + OLD.SoLuong - NEW.SoLuong 
    WHERE thongtinsp.mattsp = NEW.mattsp; 
    /*Lay gia san pham*/ 
    SELECT thongtinsp.Gia, thongtinsp.GiaKM 
    into v_Gia, v_GiaKM 
    FROM thongtinsp 
    WHERE thongtinsp.mattsp = NEW.mattsp AND thongtinsp.masp = NEW.masp; 
    /**/ 
    IF (v_GiaKM IS NOT NULL)THEN 
    	SET NEW.ThanhTien = v_GiaKM * NEW.SoLuong; 
    ELSE SET 
    	NEW.ThanhTien = v_Gia * NEW.SoLuong; 
    END IF; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctpn`
--

CREATE TABLE `ctpn` (
  `MaPN` int(10) UNSIGNED NOT NULL,
  `MaSP` int(10) UNSIGNED NOT NULL,
  `mattsp` int(10) UNSIGNED NOT NULL,
  `GiaNhap` int(11) NOT NULL,
  `SoLuong` int(10) NOT NULL,
  `ThanhTien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ctpn`
--

INSERT INTO `ctpn` (`MaPN`, `MaSP`, `mattsp`, `GiaNhap`, `SoLuong`, `ThanhTien`) VALUES
(49, 2, 3, 20000000, 3, 60000000),
(50, 2, 3, 20000000, 3, 60000000);

--
-- Bẫy `ctpn`
--
DELIMITER $$
CREATE TRIGGER `Alter_Delete_CTPN` AFTER DELETE ON `ctpn` FOR EACH ROW BEGIN
	DECLARE v_ThanhTien INT DEFAULT 0;
	/*Cap nhat lai so luong san pham*/
    UPDATE thongtinsp
    SET thongtinsp.SoLuong = thongtinsp.SoLuong - OLD.SoLuong
    WHERE thongtinsp.mattsp = OLD.mattsp;
    /*Tinh Tong Tien trong phieu nhap*/
    SELECT SUM(ctpn.ThanhTien) INTO v_ThanhTien
    FROM ctpn
    WHERE ctpn.MaPN = OLD.MaPN;
    
	UPDATE phieunhap
    SET TongTienTT = v_ThanhTien; 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Alter_Insert_CTPN` AFTER INSERT ON `ctpn` FOR EACH ROW BEGIN
	DECLARE v_ThanhTien INT DEFAULT 0;
	/*Cap nhat lai so luong san pham*/
    UPDATE thongtinsp
    SET thongtinsp.SoLuong = thongtinsp.SoLuong + NEW.SoLuong
    WHERE thongtinsp.mattsp = NEW.mattsp;
    /*Tinh Tong Tien trong phieu nhap*/
    SELECT SUM(ctpn.ThanhTien) INTO v_ThanhTien
    FROM ctpn
    WHERE ctpn.MaPN = NEW.MaPN;
    
	UPDATE phieunhap
    SET TongTienTT = v_ThanhTien; 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Alter_Update_CTPN` AFTER UPDATE ON `ctpn` FOR EACH ROW BEGIN
	DECLARE v_ThanhTien INT DEFAULT 0;
	/*Cap nhat lai so luong san pham*/
    UPDATE thongtinsp
    SET thongtinsp.SoLuong = thongtinsp.SoLuong - OLD.SoLuong + NEW.SoLuong
    WHERE thongtinsp.mattsp = NEW.mattsp;
    /*Tinh Tong Tien trong phieu nhap*/
    SELECT SUM(ctpn.ThanhTien) INTO v_ThanhTien
    FROM ctpn
    WHERE ctpn.MaPN = NEW.MaPN;
    
	UPDATE phieunhap
    SET TongTienTT = v_ThanhTien; 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Before_Insert_CTPN` BEFORE INSERT ON `ctpn` FOR EACH ROW BEGIN
	SET NEW.ThanhTien = NEW.GiaNhap * NEW.SoLuong;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Before_Updated_CTPN` BEFORE UPDATE ON `ctpn` FOR EACH ROW BEGIN
	SET NEW.ThanhTien = NEW.GiaNhap * NEW.SoLuong;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dattruoc`
--

CREATE TABLE `dattruoc` (
  `MaSP` int(10) UNSIGNED NOT NULL,
  `MaKH` int(10) UNSIGNED NOT NULL,
  `SoLuong` int(5) NOT NULL,
  `NgayDat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaohang`
--

CREATE TABLE `giaohang` (
  `MaHD` int(10) UNSIGNED NOT NULL,
  `MaNV` int(10) UNSIGNED NOT NULL,
  `TinhTrangGH` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `giaohang`
--

INSERT INTO `giaohang` (`MaHD`, `MaNV`, `TinhTrangGH`) VALUES
(93, 4, 1),
(94, 4, 1),
(95, 5, 1),
(96, 4, 1),
(97, 5, 1),
(98, 4, 1),
(99, 4, 1),
(100, 5, 1),
(101, 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaSP` int(10) UNSIGNED NOT NULL,
  `MaTTSP` int(11) NOT NULL,
  `SoLuongMua` int(5) NOT NULL,
  `MaKH` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhanhlq`
--

CREATE TABLE `hinhanhlq` (
  `MaHALQ` int(10) UNSIGNED NOT NULL,
  `MaSP` int(10) UNSIGNED NOT NULL,
  `Anh` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHD` int(10) UNSIGNED NOT NULL,
  `MaKH` int(10) UNSIGNED NOT NULL,
  `MaKM` int(10) UNSIGNED DEFAULT NULL,
  `TongTienTT` int(11) NOT NULL,
  `NgayLapHD` date NOT NULL,
  `TinhTrangTT` int(1) DEFAULT NULL,
  `SoTienNhan` int(11) DEFAULT NULL,
  `SoTienTra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`MaHD`, `MaKH`, `MaKM`, `TongTienTT`, `NgayLapHD`, `TinhTrangTT`, `SoTienNhan`, `SoTienTra`) VALUES
(93, 1, 8, 7310000, '2023-11-26', 1, 7310000, 0),
(94, 2, 1, 54900000, '2023-11-26', 1, 54900000, 0),
(95, 4, 7, 38220000, '2023-11-26', 1, 38220000, 0),
(96, 4, 1, 1200000, '2023-11-26', 0, 0, 0),
(97, 15, 7, 56420000, '2023-11-26', 0, 0, 0),
(98, 15, 7, 22750000, '2023-11-26', 0, 0, 0),
(99, 13, 7, 30030000, '2023-11-26', 0, 0, 0),
(100, 13, 7, 16198000, '2023-11-26', 1, 16198000, 0),
(101, 13, 1, 8100000, '2023-11-26', 0, 0, 0);

--
-- Bẫy `hoadon`
--
DELIMITER $$
CREATE TRIGGER `Before_Update_HD` BEFORE UPDATE ON `hoadon` FOR EACH ROW BEGIN
	DECLARE v_TongTien INT;
    DECLARE v_TienGiam INT DEFAULT 0 ;
    DECLARE v_SoPTKM TinyINT(4);
    DECLARE v_NgayMua Date;
    DECLARE v_TuNgay Date;
    DECLARE v_DenNgay Date;
    DECLARE v_TTienToiThieu INT;
	IF((NEW.MaKM != OLD.MaKM) OR (NEW.NgayLapHD != OLD.NgayLapHD)) THEN
    	/*1. Tinh Tong tien chua ap dung khuyen mai*/
    	SELECT SUM(ThanhTien) INTO v_TongTien
        FROM cthd
        WHERE MaHD = NEW.MaHD;
        SET NEW.TongTienTT = v_TongTien;
        SET NEW.SoTienTra = NEW.SoTienNhan - NEW.TongTienTT;
		/*2. Lay thong tin khuyen mai*/
    	SELECT SoPTKM, TuNgay, DenNgay, TTienToiThieu
        INTO v_SoPTKM, v_TuNgay, v_DenNgay, v_TTienToiThieu
        FROM khuyenmai
        WHERE MaKM = NEW.MaKM;
        IF(NEW.NgayLapHD >= v_TuNgay AND NEW.NgayLapHD <= v_DenNgay AND v_TongTien >= v_TTienToiThieu) THEN
        	SET v_TienGiam = v_TongTien * (v_SoPTKM/100);
            SET NEW.TongTienTT = v_TongTien - v_TienGiam;
            SET NEW.SoTienTra = NEW.SoTienNhan - NEW.TongTienTT;
        END IF;
    END IF;
    IF(NEW.SoTienNhan != OLD.SoTienNhan) THEN
    	SET NEW.SoTienTra = NEW.SoTienNhan - NEW.TongTienTT;
    END IF;
    IF(NEW.SoTienNhan >= NEW.TongTienTT) THEN
    	SET NEW.TinhTrangTT = 1;
    ELSE
    	SET NEW.TinhTrangTT = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(10) UNSIGNED NOT NULL,
  `TenKH` varchar(50) NOT NULL,
  `GioiTinh` char(10) NOT NULL,
  `SDT` char(12) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `MatKhau` varchar(30) NOT NULL,
  `CMND` char(12) NOT NULL,
  `DiaChi` varchar(50) DEFAULT NULL,
  `LoaiKH` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `GioiTinh`, `SDT`, `Email`, `MatKhau`, `CMND`, `DiaChi`, `LoaiKH`) VALUES
(1, 'Nguyễn Trọng Tín', 'Nam', '000011112222', 'tintv@gmail.com', '123456', '272811122', 'Phường 1, Trà Vinh', 'Thân thiết'),
(2, 'Nguyễn Đăng Khoa', 'Nam', '033112223', 'dangKhoa@gmail.com', '123456', '271829304', 'Phường 4, Vĩnh Long', 'Bình thường'),
(4, 'Lâm Chí Nhân', 'Nam', '09811112223', 'nhan@gmail.com', '123456', '291112233', 'Basi, Trà Vinh', 'Bình thường'),
(13, 'KH01', 'Nam', '01231241231', 'kh01@gmail.com', '123123', '231242134', 'Trà Vinh', 'Bình thường'),
(14, 'KH02', 'Nữ', '0332845981', 'kh02@gmail.com', '123123', '42121321', 'Trà Vinh', 'Bình thường'),
(15, 'KH03', 'Nam', '0123124142', 'kh03@gmail.com', '123', '231242321', 'Trà Vinh', 'Bình thường');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

CREATE TABLE `kho` (
  `makho` int(10) UNSIGNED NOT NULL,
  `tenkho` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vitri` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`makho`, `tenkho`, `vitri`) VALUES
(1, 'Phường 1', 'Trà Vinh, Trà Vinh'),
(2, 'Phường 2', 'Trà Vinh, Trà Vinh'),
(3, 'Phường 3', 'Trà Vinh, Trà Vinh'),
(4, 'Phường 4', 'Trà Vinh, Trà Vinh'),
(5, 'Phường 5', 'Trà Vinh, Trà Vinh'),
(6, 'Phường 6', 'Trà Vinh, Trà Vinh'),
(7, 'Phường 7', 'Trà Vinh, Trà Vinh'),

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKM` int(10) UNSIGNED NOT NULL,
  `SoPTKM` tinyint(4) NOT NULL,
  `TuNgay` date NOT NULL,
  `DenNgay` date NOT NULL,
  `TTienToiThieu` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKM`, `SoPTKM`, `TuNgay`, `DenNgay`, `TTienToiThieu`) VALUES
(1, 10, '2023-11-01', '2024-01-09', 5000000),
(2, 12, '2023-12-10', '2024-12-27', 2000000),
(7, 9, '2023-11-26', '2024-01-01', 10000000),
(8, 14, '2023-11-30', '2023-12-31', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoaiSP` int(10) UNSIGNED NOT NULL,
  `TenLoaiSP` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`MaLoaiSP`, `TenLoaiSP`) VALUES
(1, 'Điện thoại'),
(2, 'Máy tính bảng'),
(3, 'Phụ kiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacc`
--

CREATE TABLE `nhacc` (
  `MaNCC` int(10) UNSIGNED NOT NULL,
  `TenNCC` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `SDT` char(12) NOT NULL,
  `DiaChi` varchar(50) DEFAULT NULL,
  `Website` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhacc`
--

INSERT INTO `nhacc` (`MaNCC`, `TenNCC`, `Email`, `SDT`, `DiaChi`, `Website`) VALUES
(1, 'Apple', 'apple@gmail.com', '123456666', 'Trà Vinh', 'https://www.apple.com/vn/'),
(2, 'Samsung', 'samsung@gmail.com', '0123456777', 'Trà Vinh', 'https://www.samsung.com/vn/'),
(3, 'Xiaomi', 'xiaomi@gmail.com', '123456888', 'Trà Vinh', 'https://www.xiaomi.com/vn/'),
(4, 'OPPO', 'oppo@gmail.com', '0123456999', 'Trà Vinh', 'https://www.oppo.com/vn/'),

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` int(10) UNSIGNED NOT NULL,
  `TenNV` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `NgayVL` date NOT NULL,
  `Luong` int(11) NOT NULL,
  `SDT` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `CMND` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LoaiNV` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNV`, `TenNV`, `NgayVL`, `Luong`, `SDT`, `Email`, `MatKhau`, `CMND`, `DiaChi`, `LoaiNV`) VALUES
(2, 'Nguyễn Trọng Tín', '2023-11-12', 7000000, '0339004003', 'ntt@gmail.com', '22222222', '0455634579', 'Trà Vinh','Quản lý'),
(3, 'Nguyễn Nhất Sang', '2023-11-15', 7000000, '0339004345', 'nns@gmail.com', '33333333', '0345942456', 'Trà Vinh', 'Tiếp tân'),
(4, 'Lâm Chí Nhân', '2023-11-20', 7000000, '0339493345', 'lcn@gmail.com', '44444444', '0445310024', 'Trà Vinh', 'Giao hàng'),
(5, 'Lâm Ngọc Tài', '2023-12-02', 6000000, '0945600342', 'lnt@gmail.com', '55555555', '0542247211', 'Trà Vinh', 'Giao hàng'),
(6, 'NV02', '2023-12-21', 40000000, '0123124123', 'nv02@gm.com', '123', '123124213', 'ABC', 'Bán hàng'),
(7, 'NV01', '2023-12-22', 0, '012749213', 'nv01@gmail.com', '11111111', '214213214', '123214', 'Quản lý');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieunhap`
--

CREATE TABLE `phieunhap` (
  `MaPN` int(10) UNSIGNED NOT NULL,
  `TongTienTT` int(11) NOT NULL,
  `NgayLapPN` date NOT NULL,
  `TinhTrangTT` int(1) NOT NULL,
  `MaNCC` int(10) UNSIGNED NOT NULL,
  `MaNV` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phieunhap`
--

INSERT INTO `phieunhap` (`MaPN`, `TongTienTT`, `NgayLapPN`, `TinhTrangTT`, `MaNCC`, `MaNV`) VALUES
(49, 0, '2023-11-11', 1, 1, 6),
(50, 0, '2023-11-11', 1, 1, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `masp` int(10) UNSIGNED NOT NULL,
  `tensp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hinhanh` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `mota` text COLLATE utf8_unicode_ci NOT NULL,
  `maloaisp` int(10) UNSIGNED NOT NULL,
  `math` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`masp`, `tensp`, `hinhanh`, `mota`, `maloaisp`, `math`) VALUES
(1, '1280a1', 'http://localhost/test/fileupload/3.jpg', 'Thiết kế nhỏ gọn, dùng cực bền', 1, 9),
(2, 'IPhone 13', 'http://localhost/test/fileupload/product6.jpg', 'iPhone 13 256GB Màn hình: OLED 6.71', 1, 1),
(6, 'Oppo A91', 'http://localhost/test/fileupload/2.jpg', 'Gọn nhẹ, tinh tế.', 1, 5),
(7, 'Samsung x3', 'http://localhost/test/fileupload/product8.jpg', 'thiết kế màn hình tràn viền', 1, 2),
(10, 'Realme 4', 'http://localhost/test/fileupload/product3.jpg', 'qesfren', 1, 10),
(11, 'x74', 'http://localhost/test/fileupload/product10.jpg', 'paisre', 1, 4),
(12, 'Galaxy Y', 'http://localhost/test/fileupload/product8.jpg', 'Gọn nhẹ, màn hình tràn viên. Camera giấu tinh tế.', 1, 1),
(13, 'Realme 5', 'http://localhost/test/fileupload/3.jpg', 'Nặng, mỏng', 1, 10),
(14, 'Oppo A15', 'http://localhost/test/fileupload/1.jpg', 'Nặng, dễ vỡ, vui lòng nhẹ tay.', 1, 5),
(15, 'iPad Pro gen 2', 'http://localhost/test/fileupload/ipad-pro-2021-129-inch-gray-thumb-600x600.jpg', 'Sở hữu màn hình Liquid Retina XDR, áp dụng công nghệ mini-LED', 2, 1),
(16, 'iPad Pro M', 'http://localhost/test/fileupload/ipad-pro-m1-129-inch-wifi-sliver-600x600.jpg', 'iPad Pro M1 12.9 inch Wifi Cellular 128GB (2021) trang bị những tính năng ngày càng vượt trội và thời thượng.', 2, 1),
(17, 'Samsung Tab 7', 'http://localhost/test/fileupload/samsung-galaxy-tab-s7-fe-green-600x600.jpg', 'máy trang bị cấu hình mạnh mẽ, màn hình giải trí siêu lớn và điểm ấn tượng nhất là viên pin siêu khủng', 2, 2),
(18, 'Samsung Tab 7', 'http://localhost/test/fileupload/Samsung-Galaxy-Tab-S7-FE-Wifi-green-1-660x600.jpg', 'sở hữu màn hình Liquid Retina XDR, áp dụng công nghệ mini-LED với 10.000 bóng', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtinsp`
--

CREATE TABLE `thongtinsp` (
  `mattsp` int(10) UNSIGNED NOT NULL,
  `masp` int(10) UNSIGNED NOT NULL,
  `MaKho` int(10) UNSIGNED NOT NULL,
  `Gia` int(100) NOT NULL,
  `GiaKM` int(100) DEFAULT NULL,
  `SoLuong` int(5) DEFAULT NULL,
  `mausac` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ram` tinyint(10) DEFAULT NULL,
  `bonhotrong` tinyint(10) DEFAULT NULL,
  `pin` int(10) DEFAULT NULL,
  `kichthuongmanhinh` float DEFAULT NULL,
  `cameratruoc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `camerasau` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpu` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtinsp`
--

INSERT INTO `thongtinsp` (`mattsp`, `masp`, `MaKho`, `Gia`, `GiaKM`, `SoLuong`, `mausac`, `ram`, `bonhotrong`, `pin`, `kichthuongmanhinh`, `cameratruoc`, `camerasau`, `cpu`) VALUES
(3, 2, 1, 20000000, 17000000, 0, 'yellow', 4, 64, 127, 5, '8', '13', 'Krait 400, 2500 MHz'),
(9, 7, 1, 8999999, 8500000, 2, 'Đỏ', 0, 0, 0, 0, '4', '48', '4'),
(10, 8, 1, 5600000, 1200000, 0, 'Bạch kim', 3, 64, 10000, 6, '13', '13', '64'),
(11, 9, 1, 99999999, 9000000, 13, 'Vàng', 2, 32, 8000, 4.5, '24', '24', '512'),
(20, 1, 7, 9000000, 8900000, 18, 'Đỏ', 8, 64, 10000, 5.2, '13', '48', 'Intel core x8'),
(25, 1, 1, 16000000, 16000000, 38, 'Vàng', 16, 127, 12000, 6, '48', '48', 'XH-3'),
(26, 13, 1, 14000000, 14000000, 19, 'Đen', 8, 64, 100000, 6, '13', '48', 'XH-3'),
(27, 14, 1, 12000000, 12000000, 9, 'Đen', 8, 127, 12000, 6, '48', '13', 'XH-3'),
(28, 14, 1, 16000000, 16000000, 10, 'Vàng', 16, 127, 12000, 6, '48', '48', 'XH-3'),
(29, 14, 1, 31000000, 30000000, 1, 'Bạch kim', 16, 127, 12000, 6, '48', '48', 'X-On 2'),
(30, 15, 3, 33500000, 33000000, 11, 'Vàng', 8, 127, 20000, 15, '13', '13', 'Apple M1 8 nhân'),
(31, 16, 1, 32000000, 32000000, 24, 'Đen', 4, 127, 12000, 10, '13', '13', 'Apple M1 8 nhân'),
(32, 17, 1, 30000000, 29000000, 25, 'Đen', 4, 127, 12000, 10, '13', '13', 'Snapdragon 750G'),
(33, 18, 1, 25000000, 25000000, 25, 'Đen', 4, 127, 12000, 10, '13', '13', 'Snapdragon 750G');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thuonghieu`
--

CREATE TABLE `thuonghieu` (
  `MaTH` int(10) UNSIGNED NOT NULL,
  `TenTH` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thuonghieu`
--

INSERT INTO `thuonghieu` (`MaTH`, `TenTH`) VALUES
(1, 'Apple'),
(2, 'SamSung'),
(3, 'Xiaomi'),
(4, 'Huawei'),
(5, 'Oppo'),
(6, 'LG'),
(7, 'Vivo'),
(8, 'Sony'),
(9, 'Nokia'),
(10, 'Realme');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `id` int(10) NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci NOT NULL,
  `tieude` text COLLATE utf8_unicode_ci NOT NULL,
  `mota` text COLLATE utf8_unicode_ci NOT NULL,
  `hinhanh` text COLLATE utf8_unicode_ci NOT NULL,
  `nguoidang` text COLLATE utf8_unicode_ci NOT NULL,
  `ngaydang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`id`, `noidung`, `tieude`, `mota`, `hinhanh`, `nguoidang`, `ngaydang`) VALUES
(1, 'Với nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\n', 'Phải mua sản phẩm nào mới chất lượng trong 2021?Với1', 'Với nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang.', 'http://localhost/test/fileupload/1.jpg', 'Nguyễn Trọng Tín', '2023-11-26 00:25:20'),
(2, 'Hiện tại, RAM 4 GB có thể là \"tiêu chuẩn vàng\", nhưng tương lai không xa sẽ xuất hiện nhiều thêm nữa các smarphone có RAM 6 GB hay thậm chí là 8 GB ngang ngữa với các máy tính để bàn PC hay máy tính xách tay.\r\nTrong bài viết này, mình sẽ tổng hợp top 5 chiếc smartphone có RAM 6 GB tốt nhất năm 2017 theo Topics Blog bình chọn.\r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\n1. OnePlus 5\r\nĐược mệnh danh là \"kẻ hủy diệt flagship\", OnePlus 5 được trang bị cấu hình mạnh mẽ tuyệt đối với vi xử lý Snapdragon 835, RAM 6 GB đi kèm với ROM 64 GB. Được biết, sản phẩm này còn có 1 phiên bản cao cấp khác với bộ nhớ RAM lên tới 8 GB kèm theo đó là bộ nhớ trong 128 GB.\r\nOnePlus 5 sở hữu màn hình AMOLED kích thước 5.5 inch, độ phân giải Full HD. Máy được trang bị máy ảnh kép 16 MP hỗ trợ xóa phông, viên pin 3.000 mAh có hỗ trợ công nghệ sạc nhanh Dash Charge.\r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\n2. Honor 8 Pro\r\nĐối với những thiết bị cao cấp, Huawei luôn trang bị cho chúng dung lượng RAM khủng. Honor 8 Pro là một trong nhiều các smartphone hàng đầu của Huawei có dung lượng RAM lên tới 6 GB.\r\nMáy vận hành bởi vi xử lý \"nhà làm\" Kirin 960, chạy giao diện EMUI 8.0 được tùy biến từ Android 8.0 Oreo mới nhất, viên pin \"khủng\" 4.000 mAh. Camera kép 12 MP hỗ trợ chụp ảnh xóa phông và 8 MP đối với camera \"tự sướng\".\r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\n3. Samsung Galaxy S8 Plus (phiên bản Hàn Quốc)\r\nSamsung Galaxy S8 Plus có thể nói là một flagship Android hoàn hảo trong năm 2017. Ngoài việc trang bị hiệu năng cao với vi xử lý Snapdragon 835 / Exynos 8895, Galaxy S8 Plus còn được Samsung phóng khoáng trang bị RAM 6 GB cho phiên bản cao cấp nhất, đảm bảo cho một hiệu năng sử dụng lâu dài.\r\nGalaxy S8 Plus sở hữu màn hình kích thước 6.2 inch tỉ lệ 18.5:9, độ phân giải 2K+ chạy giao diện Samsung Experience mới nhất được tùy biến từ Android 7.0 Nougat. Ngoài ra máy còn được trang bị công nghệ bảo mật hiện đại bằng mống mắt với độ an toàn gần như tuyệt đối.\r\n', 'Top smartphone có RAM 6 GB tốt nhất năm 2022 theo Topics Blog', 'In this product filter user can filter product details by different filter which we have make by using Checkbox, and even product can be filter', 'https://cdn.tgdd.vn/Products/Images/42/234315/samsung-galaxy-a32-4g-thumb-xanh-600x600-600x600.jpg', 'Nguyễn Trọng Tín', '2023-11-26 00:25:37'),
(7, 'Mới đây, một nhà sáng tạo ý tưởng HoiINDI đã cho chúng ta thấy hình ảnh về chiếc điện thoại cuộn của Xiaomi thông qua video concept của mình. Với video, ta có thể hiểu rõ cách thức hoạt động của chiếc điện thoại cuộn này.\r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\nHầu hết chiếc điện thoại được bao phủ bởi màn hình. Sản phẩm có kích thước như một điện thoại thông minh thông thường, nhưng có màn hình ở cả hai mặt. Nút nguồn và nút chỉnh âm lượng đặt ở phía cạnh trái của điện thoại.\r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\nMới đây, một nhà sáng tạo ý tưởng HoiINDI đã cho chúng ta thấy hình ảnh về chiếc điện thoại cuộn của Xiaomi thông qua video\r\nHầu hết chiếc điện thoại được bao phủ bởi màn hình. Sản phẩm có kích thước như một điện thoại thông minh thông thường, nhưng có màn hình ở cả hai mặt. Nút nguồn và nút chỉnh âm lượng đặt ở phía cạnh trái của điện thoại.\r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\nMới đây, một nhà sáng tạo ý tưởng HoiINDI đã cho chúng ta thấy hình ảnh về chiếc điện thoại cuộn của Xiaomi thông qua video concept của mình. Với video, ta có thể hiểu rõ cách thức hoạt động của chiếc điện thoại cuộn này.\r\n</br>\r\nVới nghị lực phi thường, Nguyễn Thị Oanh (Bắc Giang) đã vượt quá giới hạn của bản thân để vươn tới đỉnh cao vinh quang. Oanh đã thực hiện một điều không tưởng khi xuất thần đoạt cùng lúc 2 HCV các cự ly khắc nghiệt trong cùng một ngày (5.000 m và 3.000 m vượt chướng ngại vật nữ), phá kỷ lục SEA Games. Trước đó một ngày, Oanh đã đoạt chức vô địch cự ly 1.500 m, hoàn tất pha \r\nHầu hết chiếc điện thoại được bao phủ bởi màn hình. Sản phẩm có kích thước như một điện thoại thông minh thông thường, nhưng có màn hình ở cả hai mặt. Nút nguồn và nút chỉnh âm lượng đặt ở phía cạnh trái của điện thoại.', 'Chiêm ngưỡng thiết kế tuyệt vời của chiếc điện thoại Xiaomi màn hình cuộn, đẳng cấp hơn cả Mi MIX Alpha, liệu sẽ thành sự thật?', 'In this product filter user can filter product details by different filter which we have make by using Checkbox, and even product can be filter', 'http://localhost/test/fileupload/product6.jpg', 'Nguyễn Trọng Tín', '2023-11-26 00:25:57'),

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBL`),
  ADD KEY `fk_bl_kh` (`MaKH`);

--
-- Chỉ mục cho bảng `cthd`
--
ALTER TABLE `cthd`
  ADD PRIMARY KEY (`MaHD`,`MaSP`,`mattsp`),
  ADD KEY `fk_cthd_sp` (`MaSP`),
  ADD KEY `fk_cthd_ttsp` (`mattsp`);

--
-- Chỉ mục cho bảng `ctpn`
--
ALTER TABLE `ctpn`
  ADD PRIMARY KEY (`MaPN`,`MaSP`,`mattsp`),
  ADD KEY `fk_ctpn_sp` (`MaSP`),
  ADD KEY `fk_ctpn_ttsp` (`mattsp`);

--
-- Chỉ mục cho bảng `dattruoc`
--
ALTER TABLE `dattruoc`
  ADD PRIMARY KEY (`MaSP`,`MaKH`),
  ADD KEY `fk_dt_kh` (`MaKH`);

--
-- Chỉ mục cho bảng `giaohang`
--
ALTER TABLE `giaohang`
  ADD PRIMARY KEY (`MaHD`,`MaNV`),
  ADD KEY `fk_giaohang_nv` (`MaNV`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD KEY `fk_gh_kh` (`MaKH`),
  ADD KEY `fk_gh_sp` (`MaSP`);

--
-- Chỉ mục cho bảng `hinhanhlq`
--
ALTER TABLE `hinhanhlq`
  ADD PRIMARY KEY (`MaHALQ`),
  ADD KEY `fk_halq_sp` (`MaSP`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `fk_hd_kh` (`MaKH`),
  ADD KEY `fk_hd_km` (`MaKM`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Chỉ mục cho bảng `kho`
--
ALTER TABLE `kho`
  ADD PRIMARY KEY (`makho`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKM`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `nhacc`
--
ALTER TABLE `nhacc`
  ADD PRIMARY KEY (`MaNCC`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`);

--
-- Chỉ mục cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD PRIMARY KEY (`MaPN`),
  ADD KEY `fk_pn_ncc` (`MaNCC`),
  ADD KEY `fk_pn_nv` (`MaNV`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `fk_sp_lsp` (`maloaisp`),
  ADD KEY `fk_sp_th` (`math`);

--
-- Chỉ mục cho bảng `thongtinsp`
--
ALTER TABLE `thongtinsp`
  ADD PRIMARY KEY (`mattsp`),
  ADD KEY `fk_ttsp_sp` (`masp`),
  ADD KEY `fk_ttsp_kho` (`MaKho`);

--
-- Chỉ mục cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  ADD PRIMARY KEY (`MaTH`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBL` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `hinhanhlq`
--
ALTER TABLE `hinhanhlq`
  MODIFY `MaHALQ` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHD` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `kho`
--
ALTER TABLE `kho`
  MODIFY `makho` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKM` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoaiSP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `nhacc`
--
ALTER TABLE `nhacc`
  MODIFY `MaNCC` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `MaPN` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `thongtinsp`
--
ALTER TABLE `thongtinsp`
  MODIFY `mattsp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `MaTH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `fk_bl_kh` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`),
  ADD CONSTRAINT `fk_bl_sp` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`masp`);

--
-- Các ràng buộc cho bảng `cthd`
--
ALTER TABLE `cthd`
  ADD CONSTRAINT `fk_cthd_hd` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHD`),
  ADD CONSTRAINT `fk_cthd_sp` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`masp`),
  ADD CONSTRAINT `fk_cthd_ttsp` FOREIGN KEY (`mattsp`) REFERENCES `thongtinsp` (`mattsp`);

--
-- Các ràng buộc cho bảng `ctpn`
--
ALTER TABLE `ctpn`
  ADD CONSTRAINT `fk_ctpn_sp` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`masp`),
  ADD CONSTRAINT `fk_ctpn_ttsp` FOREIGN KEY (`mattsp`) REFERENCES `thongtinsp` (`mattsp`),
  ADD CONSTRAINT `fk_pn` FOREIGN KEY (`MaPN`) REFERENCES `phieunhap` (`MaPN`),
  ADD CONSTRAINT `fk_pn_ttsp` FOREIGN KEY (`mattsp`) REFERENCES `thongtinsp` (`mattsp`);

--
-- Các ràng buộc cho bảng `dattruoc`
--
ALTER TABLE `dattruoc`
  ADD CONSTRAINT `fk_dt_kh` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`),
  ADD CONSTRAINT `fk_dt_sp` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`masp`);

--
-- Các ràng buộc cho bảng `giaohang`
--
ALTER TABLE `giaohang`
  ADD CONSTRAINT `fk_giaohang_hd` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHD`),
  ADD CONSTRAINT `fk_giaohang_nv` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `fk_gh_kh` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`),
  ADD CONSTRAINT `fk_gh_sp` FOREIGN KEY (`MaSP`) REFERENCES `thongtinsp` (`masp`);

--
-- Các ràng buộc cho bảng `hinhanhlq`
--
ALTER TABLE `hinhanhlq`
  ADD CONSTRAINT `fk_halq_sp` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`masp`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_hd_kh` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`),
  ADD CONSTRAINT `fk_hd_km` FOREIGN KEY (`MaKM`) REFERENCES `khuyenmai` (`MaKM`);

--
-- Các ràng buộc cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  ADD CONSTRAINT `fk_pn_ncc` FOREIGN KEY (`MaNCC`) REFERENCES `nhacc` (`MaNCC`),
  ADD CONSTRAINT `fk_pn_nv` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sp_lsp` FOREIGN KEY (`maloaisp`) REFERENCES `loaisp` (`MaLoaiSP`),
  ADD CONSTRAINT `fk_sp_th` FOREIGN KEY (`math`) REFERENCES `thuonghieu` (`MaTH`);

--
-- Các ràng buộc cho bảng `thongtinsp`
--
ALTER TABLE `thongtinsp`
  ADD CONSTRAINT `fk_ttsp_kho` FOREIGN KEY (`MaKho`) REFERENCES `kho` (`makho`),
  ADD CONSTRAINT `fk_ttsp_sp` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`masp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

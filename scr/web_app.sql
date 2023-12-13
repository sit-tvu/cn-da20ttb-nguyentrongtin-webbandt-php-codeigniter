-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 13, 2023 lúc 09:48 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_app`
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
  `NoiDung` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`MaBL`, `MaSP`, `MaTTSP`, `MaKH`, `NoiDung`) VALUES
(15, 1, 1, 15, 'sản phẩm tốt');

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
(101, 9, 11, 1, 9000000),
(102, 1, 20, 1, 8900000),
(103, 2, 3, 1, 17000000),
(104, 1, 20, 1, 10390000),
(105, 1, 20, 1, 10390000);

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
(51, 2, 3, 2000000, 10, 20000000);

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
(102, 5, 1),
(103, 4, 1),
(104, 5, 1),
(105, 4, 1);

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
(93, 1, 8, 7310000, '2023-12-26', 1, 7310000, 0),
(94, 2, 1, 54900000, '2023-12-26', 1, 54900000, 0),
(95, 4, 7, 38220000, '2023-12-26', 1, 38220000, 0),
(96, 4, 1, 1200000, '2023-12-26', 0, 0, 0),
(97, 15, 7, 56420000, '2023-12-26', 0, 0, 0),
(98, 15, 7, 22750000, '2023-12-26', 0, 0, 0),
(99, 13, 7, 30030000, '2023-12-26', 0, 0, 0),
(100, 13, 7, 16198000, '2023-12-26', 1, 16198000, 0),
(101, 13, 1, 8100000, '2023-12-26', 0, 0, 0),
(102, 16, 1, 8900000, '2023-11-25', 1, 8900000, 0),
(103, 16, 2, 14960000, '2023-11-26', 1, 14960000, 0),
(104, 17, 8, 8935400, '2023-11-30', 1, 8935400, 0),
(105, 16, 1, 10390000, '2023-12-06', 1, 10390000, 0);

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
(1, 'Nguyễn Trọng Tín', 'Nam', '000011112222', 'tin@gmail.com', '123456', '123', 'Trà Vinh', 'Thân thiết'),
(2, 'Nguyễn Đăng Khoa', 'Nam', '033112223', 'dangkhoa@gmail.com', '123456', '123', 'Hòa Minh', 'Bình thường'),
(4, 'Đỗ Thị Mỹ Duyên', 'Nữ', '09811112223', 'myduyen@gmail.com', '123456', '123', 'Cổ Chiên', 'Bình thường'),
(13, 'Lâm Chí Nhân', 'Nam', '01231241231', 'nhan@gmail.com', 'nhan', '231242134', 'Ba Si', 'Bình thường'),
(14, 'Nguyễn Nhất Sang', 'Nam', '0332845981', 'sang@gmail.com', '123123', '42121321', 'Tân An', 'Bình thường'),
(15, 'Lê Dương Nhựt Thoại', 'Nam', '0123124142', 'thoai@gmail.com', '123', '231242321', 'Long Đức', 'Bình thường'),
(16, 'Nguyễn Trọng Tín', 'Nam', '0817052342', 'tintv135@gmail.com', '123', '1234567890', 'Phường 1, Trà Vinh', 'Thân thiết'),
(17, 'sang', 'Nam', '123123', 'sangtv123@gmail.com', '123', '123', 'Tân An', 'Bình thường');

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
(1, 'Chí Nhân', 'Càng Long, Trà Vinh'),
(2, 'Nhất Sang', 'Càng Long, Trà Vinh'),
(3, 'Quận 3', 'Quận 3, Hồ Chí Minh'),
(4, 'Củ Chi', 'Củ Chi, Hồ Chí Minh'),
(5, 'Ngọc Tài', 'Phước Hảo, Trà Vinh'),
(6, 'Đinh Tiên Hoàng', 'Phường 2, Trà Vinh'),
(7, 'Tín Nguyễn', 'Phường 1, Trà Vinh');

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
(1, 10, '2023-11-01', '2022-01-30', 5000000),
(2, 12, '2023-10-20', '2023-12-29', 2000000),
(7, 9, '2023-11-26', '2024-01-01', 10000000),
(8, 14, '2023-11-30', '2024-12-31', 0);

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
(1, 'Apple', 'apple@gmail.com', '1234567890', 'Thành Phố Hồ Chí Minh', 'https://www.apple.com/vn/'),
(2, 'Samsung', 'samsung@gmail.com', '01234567891', 'Trà Vinh', 'https://www.samsung.com/vn/'),
(3, 'Xiaomi', 'xiaomi@gmail.com', '01234567892', 'Vĩnh Long', 'https://www.xiaomi.com/vn/'),
(4, 'OPPO', 'oppo@gmail.com', '01234567893', 'Cần Thơ', 'https://www.oppo.com/vn/');

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
(2, 'Lâm Chí Nhân', '2023-11-12', 7000000, '0339004003', 'lcn@gmail.com', '22222222', '0455634579', 'Trà Vinh', 'Bán hàng'),
(3, 'Nguyễn Nhất Sang', '2023-11-15', 7000000, '0339004345', 'nns@gmail.com', '33333333', '0345942456', 'Huyền Hội', 'Tiếp tân'),
(4, 'La Diễn Kha', '2023-11-20', 7000000, '0339493345', 'lakha@gmail.com', '44444444', '0445310024', 'Phường 1, Trà Vinh', 'Giao hàng'),
(5, 'Lâm Ngọc Tài', '2023-12-02', 6000000, '0945600342', 'lnt@gmail.com', '55555555', '0542247211', 'Phước Hảo', 'Giao hàng'),
(6, 'Nguyễn Hữu Thắng', '2023-12-21', 40000000, '0123124123', 'thang@gm.com', 'thang', '123124213', 'ABC', 'Quản lý'),
(9, 'Tín Nguyễn', '2023-11-23', 10000000, '0817052342', 'tintv135@gmail.com', '11111111', '1234567', 'Trà Vinh', 'Quản lý');

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
(51, 0, '2023-11-26', 1, 1, 9);

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
(1, 'iPhone 11', 'http://localhost/nttshop/fileupload/iphone11.jpg', 'iPhone 11 64GB', 1, 1),
(2, 'iPhone 13', 'http://localhost/nttshop/fileupload/ip13.jpeg', 'iPhone 13 128GB ', 1, 1),
(7, 'Samsung A34 5G ', 'http://localhost/nttshop/fileupload/samsung-galaxy-a34-thumb-den-600x600.jpg', 'Samsung A34 5G', 1, 2),
(8, 'Xiaomi Mi A2 Lite', 'http://localhost/nttshop/fileupload/xiaomimia2lite.jpg', 'Xiaomi Mi A2 Lite', 1, 3),
(9, 'Nokia C20', 'http://localhost/nttshop/fileupload/nokia-c20-vang-1-600x600.jpg', 'Nokia C20 ', 1, 9),
(13, 'Realme 5', 'http://localhost/nttshop/fileupload/uploaded_11ac5c116fb9b0c366937e6cd311b0e7.jpg', 'Realme 5', 1, 10),
(14, 'Samsung S22 Ultra', 'http://localhost/nttshop/fileupload/timthumb.jpg', 'Samsung S22 Ultra', 1, 2),
(15, 'iPhone 14', 'http://localhost/nttshop/fileupload/iphone-14-128gb.jpg', 'iPhone 14', 1, 1),
(16, 'iPad Pro 2022', 'http://localhost/nttshop/fileupload/2xtc_1280x1280-800-resize.jpg', 'iPad Pro 2022', 2, 1),
(17, 'Samsung Tab 7', 'http://localhost/nttshop/fileupload/samsung-galaxy-tab-s7-thumb-xanh-600x600-200x200.jpg', 'Samsung Tab 7', 2, 2),
(18, 'Samsung Tab S9 ', 'http://localhost/nttshop/fileupload/Samsung-Galaxy-Tab-S9-FE-Mint.jpg', 'Samsung Tab S9 ', 2, 2),
(19, 'Sam Sung', 'http://localhost/nttshop/fileupload/1.jpg', 'Samsung test', 1, 2),
(20, 'Tín', 'http://localhost/nttshop/fileupload/ip13.jpeg', '12', 1, 1),
(21, 'Xiaomi 13T Pro', 'http://localhost/nttshop/fileupload/xiaomi-13t-pro-xanh-thumb-600x600.jpg', 'Xiaomi 13T Pro', 1, 3),
(22, 'Xiaomi Redmi 12', 'http://localhost/nttshop/fileupload/xiaomi-redmi-12-xanh-duong-thumb-1-1-600x600.jpg', 'Xiaomi Redmi 12', 1, 3),
(23, 'Huawei P30 Lite', 'http://localhost/nttshop/fileupload/huawei-p30-lite-1-600x600.jpg', 'Huawei P30 Lite', 1, 4),
(24, 'Huawei P30', 'http://localhost/nttshop/fileupload/tải xuống.jpg', 'Huawei P30', 1, 4),
(25, 'OPPO A78', 'http://localhost/nttshop/fileupload/OPPO A78.jpg', 'OPPO A78', 1, 5),
(26, 'OPPO A17K ', 'http://localhost/nttshop/fileupload/OPPO A17K.jpg', 'OPPO A17K ', 1, 5),
(27, 'LG G7 ThinQ', 'http://localhost/nttshop/fileupload/LGg7.jpg', 'LG G7 ThinQ', 1, 6),
(28, 'LG Velvet ', 'http://localhost/nttshop/fileupload/LG Velvet.jpg', 'LG Velvet ', 1, 6);

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
(3, 2, 1, 17990000, 15790000, 10, 'Trắng', 4, 127, 3240, 6, '12', '12', 'A15 Bionic'),
(9, 7, 2, 8499000, 7490000, 20, 'Đen', 8, 127, 5000, 6.1, '13', '48', 'Dimensity 1080 '),
(10, 8, 7, 5690000, 4790000, 30, 'Vàng', 4, 64, 4000, 6, '8', '13', 'Snapdragon 625'),
(11, 9, 3, 5000000, 4500000, 13, 'Đồng', 2, 32, 3250, 4.5, '8', '12', 'Snapdragon 425'),
(20, 1, 1, 11990000, 10390000, 15, 'Trắng', 4, 64, 3110, 6, '12', '12', 'A13 Bionic'),
(26, 13, 2, 7500000, 7000000, 19, 'Xanh', 8, 64, 5000, 6, '13', '12', 'Snapdragon 655'),
(28, 14, 6, 14900000, 16000000, 10, 'Hồng', 8, 127, 4000, 6, '10', '48', 'Exynos 990'),
(29, 14, 4, 30000000, 16990000, 12, 'Xanh', 8, 127, 5000, 6, '40', '108', 'Snapdragon 8 Gen 1'),
(30, 15, 7, 22990000, 18490000, 11, 'Đỏ', 6, 127, 3279, 6, '12', '12', 'A15 Bionic 6 nhân'),
(31, 16, 5, 19890000, 23990000, 24, 'Đen Nhám', 8, 127, 7538, 11, '13', '13', 'Apple M2 '),
(32, 17, 2, 30000000, 29000000, 25, 'Xanh nhám', 6, 127, 8000, 10, '8', '13', 'Snapdragon 865+'),
(33, 18, 7, 13900000, 12900000, 25, 'Bạc', 8, 127, 12000, 12, '12', '8', 'Exynos 1380 8 nhân'),
(36, 21, 6, 15900000, 13900000, 12, 'Xanh xám', 12, 127, 5000, 6, '20', '48', 'MediaTek Dimensity 9200+ 5G 8 nhân'),
(37, 22, 4, 4790000, 4190000, 10, 'Xanh', 8, 127, 5000, 6.7, '8', '48', 'MediaTek Helio G88'),
(38, 23, 2, 8500000, 7490000, 5, 'Xanh', 6, 127, 4300, 6.1, '32', '24', 'Kirin 710'),
(39, 24, 3, 19000000, 17990000, 11, 'Đen', 8, 127, 3650, 6.1, '32', '40', 'HiSilicon Kirin 980'),
(40, 25, 6, 7500000, 6990000, 11, 'Xanh ', 8, 64, 5000, 6, '8', '48', 'Snapdragon 680'),
(41, 26, 2, 3290000, 2990000, 12, 'Vàng ', 3, 64, 5000, 6, '5', '8', 'MediaTek Helio G35'),
(42, 27, 3, 13500000, 11900000, 5, 'Bạc', 4, 64, 3000, 6, '8', '16', 'Snapdragon 845'),
(43, 28, 5, 11990000, 9999000, 10, 'Đen', 8, 127, 4300, 6.8, '16', '48', 'Snapdragon 765G');

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
  `ngaydang` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`id`, `noidung`, `tieude`, `mota`, `hinhanh`, `nguoidang`, `ngaydang`) VALUES
(10, 'iPhone sau một thời gian sử dụng sẽ bị đầy dung lượng, tốc độ xử lý chậm, thường xuyên bị đơ và lag. Thậm chí máy có thể bị đứng im và không thể thực hiện bất kỳ một thao tác nào. Nếu bạn gặp phải trường hợp như vậy thì đừng quá lo lắng, bạn chỉ cần reset lại máy là có thể hoạt động trở lại như bình thường. Nếu bạn chưa biết cách reset iPhone như thế nào thì có thể tham khảo hướng dẫn trong bài viết sau đây của NTTShop nhé. \r\n\r\n</br>Reset iPhone là gì? \r\n</br>Reset iPhone có thể hiểu đơn giản là các thao tác khôi phục lại cài đặt gốc và đưa máy về tính trạng ban đầu như lúc mới mua về. Việc reset lại máy sẽ xóa hết toàn bộ dữ liệu trên điện thoại của bạn, bao gồm: các ứng dụng, hình ảnh, video, tệp tin,... Vì vậy, trước khi thực hiện reset bạn nên sao lưu lại tất thông tin dữ liệu quan trọng để tránh xảy ra những rủi ro không mong muốn. \r\n</br>Reset iPhone có tác dụng gì?\r\nMột trong những lợi ích của việc reset iPhone là giúp dọn dẹp cho máy, loại bỏ những ứng dụng không cần thiết gây chiếm nhiều bộ nhớ, từ đó giúp máy hoạt động nhanh hơn.\r\n\r\n</br>Ngoài ra, việc reset iPhone cũng đóng vai trò quan trọng, đặc biệt đối với những thiết bị đã sử dụng trong thời gian dài kể từ khi mua. Quá trình khôi phục lại cài đặt gốc sẽ giúp máy hoạt động trơn tru hơn, ít xảy ra lỗi và đồng thời hỗ trợ tối ưu hóa hiệu suất làm việc của thiết bị.  \r\n\r\n</br>Sự khác biệt giữa restore và reset iPhone\r\n</br>Bên cạnh “reset iPhone” thì \"restore iPhone\" cũng là một cụm từ không quá xa lạ với những fan hâm mộ của Apple. Tuy nhiên, không ít người vẫn đang bị nhầm giữa hai thuật ngữ này. Vì vậy, FPT Shop sẽ giúp bạn phân biệt reset iPhone và restore iPhone.\r\n\r\n</br>Quá trình reset iPhone được thực hiện bằng cách truy cập trực tiếp vào ứng dụng cài đặt của điện thoại mà không cần phải kết nối điện thoại với iTunes trên máy tính hay laptop. Nhưng ngược lại, nếu muốn restore iPhone bạn cần phải kết nối với iTunes. \r\n\r\n</br>Trong quá trình reset iPhone, người dùng có thể chọn khôi phục lại tất cả cài đặt gốc hay chỉ mạng, bàn phím, vị trí, bố cục màn hình hay quyền riêng tư.\r\n\r\n</br>Trường hợp nếu bạn quyết định restore iPhone, thì sau khi hoàn tất quá trình, tất cả cài đặt trên thiết bị iPhone của bạn sẽ bị xóa hoàn toàn, bao gồm cả hệ điều hành, ứng dụng và dữ liệu cơ bản.  \r\nNhững điều cần lưu ý trước khi thực hiện reset iPhone\r\nĐể tránh gặp sự cố trong quá trình reset iPhone, bạn cần lưu ý những điều sau đây:\r\n\r\n</br>- Thời gian sao lưu dữ liệu lên đám mây có thể thay đổi tùy thuộc vào lượng dữ liệu bạn đang lưu trữ.\r\n</br>-Đảm bảo sao lưu toàn bộ dữ liệu trong điện thoại như hình ảnh, video, tài liệu, danh bạ,... để tránh mất dữ liệu sau khi reset.\r\n</br>-Sử dụng các nền tảng hỗ trợ sao lưu dữ liệu như OneDrive hoặc iCloud Drive để tối ưu hóa dung lượng lưu trữ.\r\n</br>-Toàn bộ dữ liệu và cài đặt trên thiết bị iPhone sẽ bị xóa sau khi bạn thực hiện reset.\r\n</br>-Trường hợp nếu iPhone của bạn đã được jailbreak và cài đặt Cydia, bạn nên cân nhắc kỹ, vì việc reset theo cách truyền thống khiến iphone bị treo hoặc xảy ra lỗi.   \r\n</br>-Nếu điện thoại iPhone của bạn bị khóa mạng, thì sau khi reset xong bạn cần thực hiện mở mạng và sử dụng thiết bị bình thường trên các mạng khác.\r\n\r\n</br>Hướng dẫn cách reset iPhone trên điện thoại di động\r\n</br>Cách reset iPhone trên điện thoại di động cũng khá đơn giản, bạn có thể thực hiện tương tự theo các bước hướng dẫn như sau: \r\n\r\n</br>Bước 1: Đầu tiên, bạn cần truy cập vào ứng dụng cài đặt trên điện thoại của mình. Tiếp theo vào mục “Cài đặt chung”.\r\n</br>Bước 2: Sau đó, bạn lướt xuống dưới chọn mục “Đặt lại”. \r\n</br>Bước 3: Tiếp tục nhấn chọn mục “Xóa tất cả nội dung và cài đặt\".\r\n</br>Bước 4: Cuối cùng, bạn nhấn chọn “Xóa iPhone” để hoàn tất quá trình reset iPhone trên điện thoại.', 'Hướng dẫn cách reset iPhone đơn giản và hiệu quả, giúp máy chạy mượt mà như mới', 'Hiện nay, nhiều người vẫn chưa biết cách reset iPhone sao cho đúng cách và đảm bảo an toàn. Nếu bạn cũng vậy thì đừng vội lướt qua bài viết này. Sau đây, FPT Shop sẽ bật mí cho bạn một số cách reset iPhone hiệu quả và nhanh chóng, giúp máy hoạt động mượt mà như mới.', 'http://localhost/nttshop/fileupload/cach-reset-iphone-didongviet-1.jpg', 'Tín Nguyễn', '2023-11-30 18:53:18'),
(11, '1. Samsung Galaxy A34 5G - Điện thoại tầm trung đáng mua nhất 2023\r\n</br>Là một trong những chiếc điện thoại đang được mong chờ nhất hiện nay, những thông tin về Samsung Galaxy A34 5G được săn đón liên tục trong giới công nghệ. Thiết kế nổi bật, tối giản, phiên bản màu sắc đa dạng, nhằm hướng tới nhóm người dùng là học sinh, sinh viên, ưa thích sự trẻ trung, cá tính.\r\n</br>Về cấu hình, Galaxy A34 được trang bị con chip MediaTek Dimensity 1080 8 nhân, tốc độ CPU 2.2 GHz, xử lí mượt mà các tác vụ từ cơ bản đến phức tạp của người dùng. Có thể nói, ở phân khúc giá này, với mức cấu hình này, quả thật chúng ta đã rất hời khi sở hữu.\r\n</br>2. Điện thoại Samsung Galaxy A54 5G\r\n</br>Ngoài Galaxy A34 thì một phiên bản cao cấp hơn cũng được chú ý không kém chính là Galaxy A54, là chiếc điện thoại cao cấp nhất của dòng Galaxy A trong năm 2023. Được ưu ái với diện mạo mới, có nhiều phiên bản màu sắc trẻ trung, năng động cho người dùng lựa chọn.\r\nĐược trang bị con chip Exynos 1380 mới nhất của Samsung, giúp tăng hiệu suất CPU đáng kể, cân được các tựa game từ nhẹ đến nặng, cực kì ấn tượng đối với một thiết bị ở phân khúc giá tầm trung như này.\r\n</br>Galaxy A54 còn làm hài lòng các tín đồ đam mê chụp ảnh với cụm camera có độ phân giải cao, camera chính lên đến 50 MP, đi kèm là những tính năng hiện đại như chống rung quang học, quay phim 4K,... hứa hẹn sẽ mang đến cho người dùng một thiết bị hỗ trợ ghi lại mọi khoảnh khắc cực kì tiện lợi.\r\n</br>3. Điện thoại OPPO Reno8 T 5G 128GB\r\n</br>Nổi bật với mặt lưng được hoàn thiện tỉ mỉ từ chất liệu thủy tinh hữu cơ, và rực rỡ bởi những sắc màu gradient độc đáo, OPPO Reno8 T, chắc chắn sẽ giúp bạn luôn nổi bật giữa đám đông, thu hút mọi ánh nhìn mỗi khi xuất hiện.\r\n</br>OPPO Reno8 T 5G rực rỡ bởi những sắc màu gradient độc đáo.\r\nMàn hình cũng được OPPO trang bị kĩ lưỡng bởi tấm nền AMOLED, giúp hiển thị màu sắc chân thực, có chiều sâu, mang đến cho người dùng những trải nghiệm hình ảnh tuyệt vời nhất. Ngoài ra, việc thiết kế camera trước theo style \'đục lỗ\' cũng làm cho diện tích hiển thị của màn hình ít bị thu hẹp, giúp người dùng có không gian giải trí rộng hơn, đặc biệt phù hợp khi chơi các tựa game cần góc nhìn rộng như PUBG.\r\n</br>OPPO Reno8 T 5G được thiết kế camera trước theo style \'đục lỗ\' không chiếm quá nhiều diện tích hiển thị của màn hình.\r\n</br>Trên chiếc điện thoại này, OPPO mang đến cho người dùng một hiệu năng ổn định nhờ con chip Snapdragon 695 5G của nhà Qualcomm. Hiệu suất cao, xử lí mượt mà các tác vụ từ nghe nhạc, xem phim, cho đến chơi những tựa game đòi hỏi cao về đồ họa. Ngoài ra, với chiếc RAM 8 GB, người dùng có thể sử dụng cùng lúc 8 - 10 ứng dụng, mà máy vẫn quản lí tốt, không có hiện tượng giật lag xảy ra.\r\n</br>4. Điện thoại Xiaomi 13 Lite 5G\r\n</br>Cùng xuất hiện trong danh sách điện thoại tầm trung này là chiếc Xiaomi 13 Lite, với thiết kế nổi bật, cụm camera trước hình viên thuốc gọn gàng, cùng những gam màu tươi tắn, trẻ trung, chiếc điện thoại này chắc chắn sẽ thu hút bạn ngay từ ánh nhìn đầu tiên.\r\nĐược đánh giá là vô cùng nổi bật trong phân khúc tầm trung, bởi nhà Xiaomi đã trang bị cho chiếc điện thoại này bộ vi xử lí vô cùng hiện đại, con chip Snapdragon 7 Gen 1 thế hệ mới mạnh mẽ, giúp Xiaomi 13 Lite trở thành chiếc điện thoại được săn đón nhất nhì hiện nay, dùng để chiến game một cách lí tưởng.\r\n</br>Ngoài ra, với hệ thống camera chất lượng đến từ nhà Sony, độ phân giải lên đến 50 MP, kèm nhiều tính năng chụp ảnh hiện đại, Xiaomi 13 Lite sẽ mang đến cho bạn những bức ảnh chất lượng, hoàn hảo nhất.\r\n</br>5. Điện thoại Xiaomi Redmi Note 12 8GB\r\n</br>Một sản phẩm nữa cũng của ông lớn Xiaomi, chính là Redmi Note 12, sắp được ra mắt người dùng trong vài tuần tới. Mang phong cách thiết kế mặt lưng phẳng, khung viền cứng cáp, kèm những màu sắc tươi trẻ, khiến cho chiếc điện thoại dường như trở thành một phụ kiện thời trang cực kì trendy.\r\n</br>Màn hình có kích thước lớn, 6.67 inch, kèm với tấm nền AMOLED hiện đại, giúp hiển thị hình ảnh sống động cùng không gian hiển thị rộng lớn, giúp người dùng có những trải nghiệm lí tưởng hơn. Sản phẩm này còn đạt chuẩn kháng nước, kháng bụi IP53, giúp bạn thoải mái sử dụng trong các dịp hoạt động ngoại khóa cùng với nước mà không lo điện thoại bị vào nước gây hư hại.', 'Điện thoại tầm trung - cận cao cấp mới nhất 2023 tại NTTShop, cùng khám phá nào!', 'Điện thoại tầm trung - cận cao cấp mới nhất 2023 tại NTTShop', 'http://localhost/nttshop/fileupload/top-10-dien-thoai-android-dang-mua-nhat-nam-2023_1684837091.png', 'Tín Nguyễn', '2023-11-30 18:54:14'),
(12, 'Hiện nay, đồng hồ thông minh đang ngày càng được nhiều khách hàng tin dùng vì nhiều tiện ích trong việc theo dõi sức khỏe, tích hợp công nghệ hiện đại,.... Bài viết này sẽ giới thiệu cho bạn về tiện ích 4G/LTE trên đồng hồ thông minh trẻ em, cùng xem ngay nhé!\r\n</br>1. Tiện ích 4G/LTE trên đồng hồ thông minh trẻ em là gì?\r\n</br>Tiện ích 4G/LTE trên smartwatch định vị trẻ em giúp các bậc cha mẹ có thể kết nối điện thoại với đồng hồ mà con mình đang đeo và đảm bảo kết nối vẫn được duy trì ở những nơi không có Bluetooth, Wi-Fi hoặc nếu điện thoại thông minh được kết nối không nằm trong vùng phủ sóng.\r\n</br>2. Lợi ích của 4G/LTE trên đồng hồ thông minh\r\n</br>Khi các bậc phụ huynh sử dụng tiện ích 4G/LTE trên smartwatch định vị trẻ em thì họ có thể dễ dàng nắm bắt được vị trí của con mình khi khuất tầm mắt tại những nơi công cộng như công viên, bệnh viện,.... Ngoài ra, phụ huynh cũng có thể gọi điện thoại một cách dễ dàng với con họ mà không lo những đứa trẻ sẽ tiếp xúc với những nội dung không phù hợp như sử dụng smartphone.\r\n</br>3. Đồng hồ có trang bị 4G/LTE bán chạy tại TGDĐ\r\n</br>Kidcare S6 4G 41.5mm dây silicone\r\n</br>- Màn hình: TFT, 1.3 inch\r\n\r\n</br>- Tính năng cho sức khỏe: Đếm số bước chân\r\n\r\n</br>- Kết nối: LBS, AGPS, Wifi Location, Định vị bằng thuật toán AI, Định vị trong nhà (Indoor Positioning)\r\n\r\n</br>Kidcare S6 4G 41.5mm dây silicone được trang bị màn hình TFT với kích thước 1.3 inch giúp các bạn nhỏ có thể nhìn rõ ràng các nội dung và hình ảnh được hiển thị. Thêm nữa, hãng sản xuất còn trang bị tiện ích 4g/lte trên chiếc smartwatch định vị trẻ em này giúp các bậc phụ huynh dễ dàng chăm sóc và liên lạc với con họ hơn.\r\n\r\n</br>Ngoài ra, sản phẩm còn sở hữu chức năng chặn số lạ mang lại sự an toàn cho các bé khi chỉ có những số điện thoại đã được lưu trong danh bạ mới có thể liên lạc được, ngoài ra thì sẽ bị đồng hồ đưa vào danh sách \"người lạ\" và bị chặn để không thể liên lạc gây ảnh hướng cho các bé.\r\nMasstel Smart Hero 10 dây silicone\r\n</br>- Màn hình: TFT, 1.4 inch\r\n\r\n</br>- Tính năng cho sức khỏe: Đếm số bước chân\r\n\r\n</br>- Kết nối: GPS, LBS, AGPS, Wifi, Kết nối 4G\r\n</br>Masstel Smart Hero 10 dây silicone là một trong những chiếc smartwatch định vị trẻ em trang bị 4g/lte sở hữu nhiều tính năng hữu ích như: Chế độ lớp học, khóa bàn phím và tắt nguồn, báo mất máy,.. giúp bậc cha mẹ có thể thuận tiện hơn trong việc theo dõi và quản lý con mình một cách an toàn.\r\n\r\n</br>Bên cạnh đó, sản phẩm còn sở hữu khả năng kháng nước chuẩn IP68 giúp chống bụi và có thể mang khi tắm, đi mưa,.... Ngoài ra, sản phẩm có thời gian sử dụng khoảng 38 giờ và mất khoảng 2 giờ để sạc đầy giúp các bé thoải mái vui chơi mà không lo bị gián đoạn.', 'Tìm hiểu tiện ích 4G/LTE trên đồng hồ thông minh trẻ em', 'Tìm hiểu tiện ích 4G/LTE trên đồng hồ thông minh trẻ em', 'http://localhost/nttshop/fileupload/tim-hieu-tien-ich-4g-lte-tren-dong-ho-thong-minh-1-800x450.jpg', 'Tín Nguyễn', '2023-11-30 19:02:25');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBL`),
  ADD KEY `fk_bl_kh` (`MaKH`),
  ADD KEY `fk_bl_sp` (`MaSP`);

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
  MODIFY `MaBL` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `hinhanhlq`
--
ALTER TABLE `hinhanhlq`
  MODIFY `MaHALQ` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHD` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `kho`
--
ALTER TABLE `kho`
  MODIFY `makho` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKM` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoaiSP` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `nhacc`
--
ALTER TABLE `nhacc`
  MODIFY `MaNCC` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `phieunhap`
--
ALTER TABLE `phieunhap`
  MODIFY `MaPN` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `thongtinsp`
--
ALTER TABLE `thongtinsp`
  MODIFY `mattsp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `thuonghieu`
--
ALTER TABLE `thuonghieu`
  MODIFY `MaTH` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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

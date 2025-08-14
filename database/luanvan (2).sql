-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 08, 2025 lúc 07:08 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `luanvan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo_phan`
--

CREATE TABLE `bo_phan` (
  `BP_MABP` int(11) NOT NULL,
  `BP_TENBP` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `bo_phan`
--

INSERT INTO `bo_phan` (`BP_MABP`, `BP_TENBP`) VALUES
(1, 'Giao Hàng'),
(2, 'Quản trị viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_donhang`
--

CREATE TABLE `chitiet_donhang` (
  `DH_MADH` int(11) NOT NULL,
  `SP_MASP` int(11) NOT NULL,
  `CTDH_SOLUONG` int(11) NOT NULL,
  `CTDH_DONGIA` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiet_donhang`
--

INSERT INTO `chitiet_donhang` (`DH_MADH`, `SP_MASP`, `CTDH_SOLUONG`, `CTDH_DONGIA`) VALUES
(24, 10, 1, 38.000),
(24, 16, 2, 60.000),
(25, 3, 1, 10.000),
(26, 3, 6, 10.000),
(26, 10, 2, 38.000),
(27, 1, 1, 4.000),
(28, 11, 2, 60.000),
(29, 16, 1, 60.000),
(30, 2, 1, 14.000),
(31, 15, 1, 62.000),
(32, 21, 1, 30.000),
(33, 3, 1, 10.000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_gio_hang`
--

CREATE TABLE `chi_tiet_gio_hang` (
  `GH_ID` int(11) NOT NULL,
  `SP_MASP` int(11) NOT NULL,
  `CTGH_SOLUONG` int(11) NOT NULL,
  `CTGH_DONGIA` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_gio_hang`
--

INSERT INTO `chi_tiet_gio_hang` (`GH_ID`, `SP_MASP`, `CTGH_SOLUONG`, `CTGH_DONGIA`) VALUES
(33, 3, 6, 10.000),
(33, 10, 2, 38.000),
(34, 10, 1, 38.000),
(36, 3, 1, 10.000),
(37, 1, 1, 4.000),
(38, 11, 2, 60.000),
(39, 2, 1, 14.000),
(40, 16, 1, 60.000),
(41, 15, 1, 62.000),
(42, 16, 1, 60.000),
(43, 21, 1, 30.000),
(44, 1, 1, 4.000),
(45, 3, 1, 10.000),
(46, 5, 1, 30.000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia_sanpham`
--

CREATE TABLE `danhgia_sanpham` (
  `DGSP_ID` int(11) NOT NULL,
  `DH_MADH` int(11) NOT NULL,
  `SP_MASP` int(11) NOT NULL,
  `DGSP_NOIDUNG` mediumtext NOT NULL,
  `DGSP_SOSAO` int(11) NOT NULL,
  `DGSP_NGAYDANHGIA` datetime NOT NULL DEFAULT current_timestamp(),
  `DGSP_TRANGTHAI` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgia_sanpham`
--

INSERT INTO `danhgia_sanpham` (`DGSP_ID`, `DH_MADH`, `SP_MASP`, `DGSP_NOIDUNG`, `DGSP_SOSAO`, `DGSP_NGAYDANHGIA`, `DGSP_TRANGTHAI`) VALUES
(13, 24, 16, 'Cua biển rất tươi, thịt chắc và ngọt tự nhiên. Mình luộc lên ăn cùng muối tiêu chanh là tuyệt vời luôn! Giao hàng nhanh, đóng gói cẩn thận, cua vẫn còn sống khi nhận hàng. Sẽ tiếp tục ủng hộ trong những lần sau!', 5, '2025-06-21 03:36:27', 'Hiện'),
(16, 24, 10, 'Thịt heo rất tươi và sạch, không có mùi hôi. Gói hàng cẩn thận, giao nhanh. Gia đình mình ăn ai cũng khen ngon. Sẽ ủng hộ tiếp tục!', 4, '2025-06-21 03:55:29', 'Hiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `DM_MADM` int(11) NOT NULL,
  `DM_TENDM` varchar(30) NOT NULL,
  `DM_TRANGTHAI` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`DM_MADM`, `DM_TENDM`, `DM_TRANGTHAI`) VALUES
(1, 'Rau củ quả sạch', 'Còn kinh doanh'),
(2, 'Trái cây', 'Còn kinh doanh'),
(3, 'Thịt tươi sạch', 'Còn kinh doanh'),
(4, 'Cá, hải sản', 'Còn kinh doanh'),
(5, 'Sửa tươi sạch', 'Còn kinh doanh'),
(6, 'Các loại sữa', 'Ngừng kinh doanh'),
(7, 'Trứng gà, vịt, cút', 'Còn kinh doanh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dinh_duong`
--

CREATE TABLE `dinh_duong` (
  `DD_MADD` int(11) NOT NULL,
  `SP_MASP` int(11) NOT NULL,
  `DD_CALO` float DEFAULT 0,
  `DD_DAM` float DEFAULT 0,
  `DD_CHATBEO` float DEFAULT 0,
  `DD_DUONG` float DEFAULT 0,
  `DD_NATRI` float DEFAULT 0,
  `DD_CHATXO` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `dinh_duong`
--

INSERT INTO `dinh_duong` (`DD_MADD`, `SP_MASP`, `DD_CALO`, `DD_DAM`, `DD_CHATBEO`, `DD_DUONG`, `DD_NATRI`, `DD_CHATXO`) VALUES
(1, 1, 25, 2.1, 0.3, 1.2, 20, 3.2),
(2, 20, 70, 1.8, 2.2, 12.2, 20, 0),
(3, 2, 18, 0.9, 0.2, 2.6, 5, 1.2),
(4, 3, 25, 1.3, 0.1, 3.2, 18, 2.5),
(5, 4, 50, 0.5, 0.1, 9.9, 1, 1.4),
(6, 5, 34, 0.8, 0.2, 7.9, 16, 0.9),
(7, 6, 30, 0.6, 0.2, 6.2, 1, 0.4),
(8, 7, 69, 0.7, 0.2, 15.5, 2, 1),
(9, 8, 32, 0.7, 0.3, 4.9, 2, 1),
(10, 9, 165, 31, 3.6, 0, 74, 0),
(11, 10, 242, 27, 14, 0, 62, 0),
(12, 11, 250, 26.1, 15, 0, 72, 0),
(13, 12, 165, 31, 3.6, 0, 74, 0),
(14, 13, 205, 19, 13.9, 0, 90, 0),
(15, 14, 99, 24, 0.3, 0, 111, 0),
(16, 15, 92, 15.6, 1.4, 0, 44, 0),
(17, 16, 97, 19.4, 1.5, 0, 395, 0),
(18, 18, 75, 3, 2.5, 9, 50, 0),
(19, 18, 75, 3, 2.5, 9, 50, 0),
(20, 19, 110, 4.5, 3.5, 12, 80, 0),
(21, 21, 60, 2.5, 3, 6, 45, 0),
(22, 22, 24, 2.6, 0.2, 3.4, 0, 1),
(23, 23, 19, 2.1, 0.3, 3.4, 0, 1.8),
(24, 24, 23, 2.9, 0.4, 3.6, 0, 2.2),
(25, 25, 23, 3.2, 0.6, 2.7, 0, 1.6),
(26, 26, 60, 0.8, 0.4, 14, 0, 1.6),
(27, 27, 160, 2, 15, 8.5, 0, 6.7),
(28, 28, 89, 1.1, 0.3, 23, 0, 2.6),
(29, 29, 53, 0.8, 13, 1.8, 0, 27),
(30, 30, 120, 4, 3.8, 2, 0, 1),
(31, 31, 32, 7, 8.7, 55, 0, 250),
(32, 32, 68, 2.5, 2.8, 9.5, 0, 100),
(33, 33, 139, 0, 5.4, 16.4, 0, 0),
(34, 34, 70, 6.3, 4.8, 0, 65, 0),
(35, 35, 130, 9, 10, 0, 90, 0),
(36, 36, 158, 13, 11, 0, 140, 0),
(37, 37, 873, 43.2, 75.6, 0, 186, 0),
(38, 38, 750, 48, 90, 0, 210, 0),
(39, 39, 540, 45, 39, 0, 210, 0),
(40, 40, 360, 54, 41, 0, 195, 0),
(41, 41, 180, 21, 10, 0, 70, 0),
(42, 42, 203, 17, 15, 0, 82, 0),
(43, 43, 150, 16, 9, 0, 65, 0),
(44, 44, 215, 19, 15, 0, 70, 0),
(45, 45, 13, 1.5, 0.2, 1.2, 65, 1),
(46, 46, 20, 2, 0.3, 1.4, 50, 1.3),
(47, 47, 45, 3.5, 3.5, 1.2, 35, 2),
(48, 48, 40, 2.4, 0.4, 1, 28, 2.7),
(49, 49, 32, 1.8, 0.2, 2.3, 16, 2.6),
(50, 50, 36, 5.7, 0.3, 0.9, 23, 3.6),
(51, 51, 25, 2.4, 0.3, 1, 15, 2),
(52, 52, 40, 3.3, 0.5, 0.5, 20, 3.9),
(53, 53, 46, 0.7, 0.3, 9.9, 1, 1.4),
(54, 54, 52, 0.3, 0.2, 10, 1, 2.4),
(55, 55, 57, 0.4, 0.1, 10, 1, 3.1),
(56, 56, 57, 0.4, 0.1, 10, 1, 3.1),
(57, 57, 130, 17, 7, 0, 40, 0),
(58, 58, 110, 20, 3, 0, 50, 0),
(59, 59, 142, 18, 7, 0, 60, 0),
(60, 60, 97, 18, 2, 0, 40, 0),
(61, 61, 120, 19, 4, 0, 0, 0),
(62, 62, 140, 16, 8, 0, 0, 0),
(63, 63, 125, 20, 5, 0, 0, 0),
(64, 64, 85, 2.3, 2.3, 9, 45, 0),
(65, 65, 85, 2.6, 3, 8.5, 50, 0),
(66, 66, 70, 3.5, 2, 2, 40, 0),
(67, 67, 90, 2, 3, 6, 30, 1.5),
(68, 68, 340, 6.6, 8.5, 55, 100, 0),
(69, 69, 100, 4.8, 3, 2, 0, 0),
(70, 70, 341, 4.8, 11.3, 0, 160, 0),
(71, 71, 127, 0.8, 3.9, 19, 22, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_gia`
--

CREATE TABLE `don_gia` (
  `DG_ID` int(11) NOT NULL,
  `SP_MASP` int(11) NOT NULL,
  `DG_GIAMOI` decimal(10,3) NOT NULL,
  `DG_NGAYAPDUNG` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `don_gia`
--

INSERT INTO `don_gia` (`DG_ID`, `SP_MASP`, `DG_GIAMOI`, `DG_NGAYAPDUNG`) VALUES
(1, 1, 6.000, '2025-05-22'),
(2, 1, 4.000, '2025-05-24'),
(3, 2, 14.000, '2025-05-24'),
(4, 3, 10.000, '2025-05-24'),
(5, 4, 15.000, '2025-05-24'),
(6, 5, 35.000, '2025-05-24'),
(7, 6, 10.000, '2025-05-24'),
(8, 7, 80.000, '2025-05-24'),
(9, 8, 100.000, '2025-05-24'),
(10, 9, 37.000, '2025-05-24'),
(11, 10, 38.000, '2025-05-24'),
(12, 11, 60.000, '2025-05-24'),
(13, 12, 23.000, '2025-05-24'),
(14, 16, 70.000, '2025-05-22'),
(15, 14, 50.000, '2025-05-24'),
(16, 15, 62.000, '2025-05-24'),
(17, 16, 60.000, '2025-05-24'),
(18, 13, 20.000, '2025-05-24'),
(20, 18, 30.000, '2025-06-08'),
(21, 19, 29.000, '2025-06-19'),
(22, 20, 32.000, '2025-06-23'),
(23, 21, 30.000, '2025-06-24'),
(24, 22, 15.000, '2025-07-02'),
(25, 23, 20.000, '2025-07-02'),
(26, 24, 40.000, '2025-07-02'),
(27, 25, 79.000, '2025-07-02'),
(28, 26, 30.000, '2025-07-02'),
(29, 27, 23.000, '2025-07-02'),
(30, 28, 19.000, '2025-07-02'),
(31, 29, 38.000, '2025-07-02'),
(32, 30, 31.000, '2025-07-02'),
(33, 31, 20.000, '2025-07-02'),
(34, 32, 33.000, '2025-07-02'),
(35, 33, 33.000, '2025-07-02'),
(36, 30, 30.000, '2025-07-02'),
(37, 11, 58.000, '2025-07-02'),
(38, 25, 78.000, '2025-07-02'),
(39, 27, 20.000, '2025-07-02'),
(40, 5, 30.000, '2025-07-02'),
(41, 33, 31.000, '2025-07-02'),
(43, 34, 30.000, '2025-07-08'),
(45, 35, 39.000, '2025-07-05'),
(46, 36, 14.000, '2025-07-06'),
(47, 37, 53.000, '2025-07-08'),
(48, 38, 48.000, '2025-07-08'),
(49, 39, 31.000, '2025-07-08'),
(50, 40, 41.000, '2025-07-08'),
(51, 41, 61.000, '2025-07-08'),
(52, 42, 37.000, '2025-07-08'),
(53, 43, 25.000, '2025-07-08'),
(54, 44, 25.000, '2025-07-08'),
(55, 45, 13.000, '2025-07-08'),
(56, 46, 5.000, '2025-07-08'),
(57, 47, 5.000, '2025-07-08'),
(58, 48, 8.000, '2025-07-08'),
(59, 49, 8.000, '2025-07-08'),
(60, 50, 14.000, '2025-07-08'),
(61, 51, 9.000, '2025-07-08'),
(62, 52, 7.000, '2025-07-08'),
(63, 53, 31.000, '2025-07-08'),
(64, 54, 20.000, '2025-07-08'),
(65, 55, 32.000, '2025-07-08'),
(66, 56, 29.000, '2025-07-08'),
(67, 57, 33.000, '2025-07-08'),
(68, 58, 40.000, '2025-07-08'),
(69, 59, 49.000, '2025-07-08'),
(70, 60, 38.000, '2025-07-08'),
(71, 61, 27.000, '2025-07-08'),
(72, 62, 139.000, '2025-07-08'),
(73, 63, 45.000, '2025-07-08'),
(74, 64, 25.000, '2025-07-08'),
(75, 65, 35.000, '2025-07-08'),
(76, 66, 32.000, '2025-07-08'),
(77, 67, 34.000, '2025-07-08'),
(78, 68, 16.000, '2025-07-08'),
(79, 69, 5.000, '2025-07-08'),
(80, 70, 26.000, '2025-07-08'),
(81, 71, 21.000, '2025-07-08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `DH_MADH` int(11) NOT NULL,
  `NV_ID` int(11) DEFAULT NULL,
  `GH_ID` int(11) NOT NULL,
  `KH_ID` int(11) NOT NULL,
  `PTTT_ID` int(11) NOT NULL,
  `DH_TENNGUOINHAN` varchar(50) NOT NULL,
  `DH_SDT` varchar(15) NOT NULL,
  `DH_DIACHINHAN` varchar(100) NOT NULL,
  `DH_TONGTIEN` decimal(10,3) NOT NULL,
  `DH_NGAYDAT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DH_TRANGTHAI` varchar(30) DEFAULT NULL,
  `DH_DIEMDADUNG` float DEFAULT 0,
  `DH_DIEMCONG` float DEFAULT 0,
  `DH_PHIGIAO` decimal(10,0) DEFAULT 0,
  `DH_TICHDIEM` int(11) DEFAULT 0,
  `P_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`DH_MADH`, `NV_ID`, `GH_ID`, `KH_ID`, `PTTT_ID`, `DH_TENNGUOINHAN`, `DH_SDT`, `DH_DIACHINHAN`, `DH_TONGTIEN`, `DH_NGAYDAT`, `DH_TRANGTHAI`, `DH_DIEMDADUNG`, `DH_DIEMCONG`, `DH_PHIGIAO`, `DH_TICHDIEM`, `P_ID`) VALUES
(24, 1, 34, 1, 1, 'Nguyễn Gia Hân', '0444444444', '123A, đường 3/2, Phường Bến Thành, TP Hồ Chí Minh', 158.000, '2025-07-06 09:14:15', 'Chờ xét duyệt', 0, 1580, 0, 1, 3),
(25, 3, 36, 1, 1, 'Nguyễn Gia Hân', '0444444444', '123A, đường 3/2, Phường Bến Thành, TP Hồ Chí Minh', 25.000, '2025-07-06 09:19:05', 'Chờ xét duyệt', 0, 100, 15000, 1, 3),
(26, 3, 33, 2, 1, 'Trần Minh Hiếu', '0123456789', '789B, đường 30/4, Phường Xuân Hòa, TP Hồ Chí Minh', 136.000, '2025-06-30 07:54:49', 'Chờ xét duyệt', 0, 1360, 0, 0, 6),
(27, 1, 37, 1, 1, 'Nguyễn Gia Hân', '0444444444', '123A, đường 3/2, Phường Bến Thành, TP Hồ Chí Minh', 19.000, '2025-06-30 07:54:59', 'Chờ xét duyệt', 0, 40, 15000, 0, 3),
(28, 3, 38, 2, 1, 'Trần Minh Hiếu', '0123456789', '789B, đường 30/4, Phường Xuân Hòa, TP Hồ Chí Minh', 120.000, '2025-06-30 07:55:14', 'Chờ xét duyệt', 0, 1200, 0, 0, 6),
(29, 3, 40, 2, 1, 'Trần Minh Hiếu', '0123456789', '789B, đường 30/4, Phường Xuân Hòa, TP Hồ Chi Minh', 75.000, '2025-06-30 09:18:32', NULL, 0, 600, 15000, 0, 6),
(30, 1, 39, 1, 1, 'Nguyễn Gia Hân', '0444444444', '123A, đường 3/2, Phường Bến Thành, TP Hồ Chí Minh', 29.000, '2025-06-30 07:55:37', NULL, 0, 140, 15000, 0, 3),
(31, 1, 41, 1, 1, 'Nguyễn Gia Hân', '0444444444', '123A, đường 3/2, Phường Bến Thành, TP Hồ Chí Minh', 77.000, '2025-06-30 16:21:17', NULL, 0, 620, 15000, 0, 3),
(32, 3, 43, 2, 1, 'Trần Minh Hiếu', '0123456789', '789B, đường 30/4, Phường Xuân Hòa, TP Hồ Chí Minh', 45.000, '2025-06-30 15:23:21', NULL, 0, 300, 15000, 0, 6),
(33, NULL, 45, 5, 1, 'Lý Bảo Bảo', '0888888888', '56B, đường An Cừ, Phường Xuân Hòa, TP Hồ Chí Minh', 25.000, '2025-07-06 16:29:46', NULL, 0, 100, 15000, 0, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `GH_ID` int(11) NOT NULL,
  `KH_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `gio_hang`
--

INSERT INTO `gio_hang` (`GH_ID`, `KH_ID`) VALUES
(1, 1),
(34, 1),
(36, 1),
(37, 1),
(39, 1),
(41, 1),
(46, 1),
(33, 2),
(38, 2),
(40, 2),
(43, 2),
(44, 2),
(42, 4),
(45, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `KH_ID` int(11) NOT NULL,
  `TK_ID` int(11) NOT NULL,
  `KH_HOTEN` varchar(30) NOT NULL,
  `KH_EMAIL` varchar(30) NOT NULL,
  `KH_SODIENTHOAI` varchar(15) NOT NULL,
  `KH_DIACHI` varchar(50) NOT NULL,
  `KH_NGAYDANGKY` datetime NOT NULL DEFAULT current_timestamp(),
  `KH_DIEMTICHLUY` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`KH_ID`, `TK_ID`, `KH_HOTEN`, `KH_EMAIL`, `KH_SODIENTHOAI`, `KH_DIACHI`, `KH_NGAYDANGKY`, `KH_DIEMTICHLUY`) VALUES
(1, 2, 'Nguyễn Gia Hân', 'han@gmail.com', '0444444444', '99B, Nguyễn Tri Phương, An Hòa, Quận 9, TP HCM', '2025-06-05 17:39:14', 2580),
(2, 3, 'Trần Minh Hiếu', 'hieu@gmail.com', '0123456789', '99A, Số 9, An hòa, Quận 9, TP HCM', '2025-06-05 17:39:14', 3460),
(4, 7, 'Lê Ngọc Duy', 'duy@gmail.com', '0147852369', 'Đường A, Phường B, Quận C, TP HCM', '2025-06-22 20:50:37', 0),
(5, 8, 'Lý Bảo Bảo', 'bao@gmail.com', '0888888888', '88A, Phường 5, TP. Hồ Chí Minh', '2025-07-06 23:15:05', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khu_vuc`
--

CREATE TABLE `khu_vuc` (
  `KV_MAKV` int(11) NOT NULL,
  `NV_ID` int(11) NOT NULL,
  `P_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khu_vuc`
--

INSERT INTO `khu_vuc` (`KV_MAKV`, `NV_ID`, `P_ID`) VALUES
(1, 1, 3),
(2, 3, 6),
(3, 1, 2),
(5, 3, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_don_hang`
--

CREATE TABLE `lich_su_don_hang` (
  `LSDH_ID` int(11) NOT NULL,
  `TT_MATT` int(11) NOT NULL,
  `DH_MADH` int(11) NOT NULL,
  `LSDH_THOIDIEM` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `lich_su_don_hang`
--

INSERT INTO `lich_su_don_hang` (`LSDH_ID`, `TT_MATT`, `DH_MADH`, `LSDH_THOIDIEM`) VALUES
(1, 1, 24, '2025-06-06 01:47:52'),
(2, 1, 25, '2025-06-06 02:03:07'),
(3, 1, 26, '2025-06-06 02:14:15'),
(4, 1, 27, '2025-06-06 17:12:46'),
(5, 1, 28, '2025-06-15 23:37:43'),
(6, 1, 29, '2025-06-20 23:51:26'),
(7, 1, 30, '2025-06-22 20:25:14'),
(8, 2, 24, '2025-06-15 23:01:20'),
(9, 2, 25, '2025-06-15 23:06:43'),
(10, 2, 26, '2025-06-15 23:06:53'),
(11, 2, 27, '2025-06-17 23:19:57'),
(12, 2, 28, '2025-06-20 23:11:13'),
(13, 2, 29, '2025-06-26 21:04:58'),
(14, 2, 30, '2025-06-23 01:42:07'),
(15, 3, 24, '2025-06-17 23:26:20'),
(16, 3, 25, '2025-06-23 02:17:52'),
(17, 3, 26, '2025-06-26 21:23:48'),
(18, 4, 24, '2025-06-19 18:11:06'),
(19, 5, 28, '2025-06-25 16:19:28'),
(20, 5, 29, '2025-06-26 21:05:41'),
(21, 2, 28, '2025-06-26 21:45:15'),
(22, 5, 28, '2025-06-26 21:46:12'),
(23, 1, 31, '2025-06-30 15:08:47'),
(24, 1, 32, '2025-06-30 22:02:15'),
(26, 4, 25, '2025-07-06 16:16:50'),
(27, 1, 33, '2025-07-06 23:29:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `NV_ID` int(11) NOT NULL,
  `BP_MABP` int(11) NOT NULL,
  `NV_HOTEN` varchar(30) NOT NULL,
  `NV_GIOITINH` varchar(10) DEFAULT NULL,
  `NV_SODIENTHOAI` varchar(15) NOT NULL,
  `NV_EMAIL` varchar(30) NOT NULL,
  `NV_DIACHI` varchar(100) NOT NULL,
  `NV_TRANGTHAI` varchar(15) NOT NULL,
  `TK_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhan_vien`
--

INSERT INTO `nhan_vien` (`NV_ID`, `BP_MABP`, `NV_HOTEN`, `NV_GIOITINH`, `NV_SODIENTHOAI`, `NV_EMAIL`, `NV_DIACHI`, `NV_TRANGTHAI`, `TK_ID`) VALUES
(1, 1, 'Nguyễn Hoàng Nam', 'Nam', '0555555555', 'nam@gmail.com', '98A, Đường 30/4, Phường 2, Quận 7, TP. HCM', 'Còn làm', 1),
(2, 2, 'Lê Hoàng Phong', 'Nam', '0859987789', 'phong@gmail.com', '47D, Đường 91B, Phường 6, Quận 10, TP.HCM', 'Còn làm', 4),
(3, 1, 'Trần Hoàn Thiện', 'Nam', '0123457412', 'thien@gmail.com', '36B, Đường CMT8, Phường 7, Quận 9, TP HCM', 'Còn làm', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuhop`
--

CREATE TABLE `phuhop` (
  `SP_MASP` int(11) NOT NULL,
  `TTRANG_MA` int(11) NOT NULL,
  `PH_MOTA` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `phuhop`
--

INSERT INTO `phuhop` (`SP_MASP`, `TTRANG_MA`, `PH_MOTA`) VALUES
(1, 1, 'Giúp hạ huyết áp nhờ hàm lượng kali cao'),
(1, 2, 'Giàu chất xơ, ít calo – phù hợp cho người ăn kiêng'),
(1, 3, 'Giúp kiểm soát mỡ máu nhờ chất xơ hòa tan'),
(2, 2, ' Ít calo, nhiều nước, hỗ trợ ăn kiêng'),
(2, 9, 'Giàu lycopene, tốt cho tim mạch'),
(3, 1, 'Giúp hạ huyết áp nhờ giàu kali và natri thấp'),
(3, 2, 'Hỗ trợ giảm cân nhờ ít calo và nhiều chất xơ'),
(3, 4, 'Không làm tăng đường huyết, GI thấp'),
(4, 2, 'Hỗ trợ kiểm soát khẩu phần ăn nhờ lượng calo vừa phải'),
(5, 7, 'Bổ sung vitamin A, C, tăng thị lực'),
(5, 8, 'Giàu vitamin A và C – tăng đề kháng, đẹp da, tốt cho thị lực'),
(5, 11, 'Lượng calo thấp, phù hợp cho người ăn kiêng'),
(6, 1, 'Giàu Citrulline và Kali, hỗ trợ giãn mạch và ổn định huyết áp.'),
(6, 2, 'Lượng calo thấp, phù hợp cho người ăn kiêng'),
(6, 7, 'Giàu vitamin C – giúp giải nhiệt, tăng miễn dịch.'),
(6, 8, 'Giàu vitamin C – giúp giải nhiệt, tăng miễn dịch và làm đẹp da.'),
(6, 11, 'ít calo, không chất béo'),
(7, 3, 'Hỗ trợ giảm cholesterol'),
(7, 5, 'Cung cấp năng lượng và dưỡng chất dễ hấp thu'),
(7, 8, 'ốt cho trí nhớ và tim mạch'),
(7, 9, 'Chống oxy hoá, bảo vệ mạch máu'),
(8, 1, 'Chứa kali và chất chống oxy hóa'),
(8, 3, 'Chống oxy hoá tốt'),
(8, 6, 'Bổ sung vitamin C'),
(8, 7, 'Bổ sung vitamin và khoáng chất giúp tăng đề kháng'),
(8, 11, ' Ít calo, no lâu'),
(9, 5, 'Bổ sung đạm và calo'),
(9, 8, 'Dễ hấp thu, bổ dưỡng'),
(9, 9, 'Thịt trắng, ít cholesterol'),
(9, 11, 'Giàu đạm, ít béo'),
(10, 6, 'Bổ sung sắt, vitamin B'),
(10, 7, 'Giúp tăng trưởng và phát triển'),
(10, 8, 'Cung cấp protein nhẹ nhàng'),
(11, 5, 'Giàu đạm, sắt, giúp tăng thể lực và khối lượng cơ'),
(11, 6, ' Giàu sắt heme, B12'),
(11, 8, 'Cần protein và khoáng chất, nếu nấu mềm sẽ dễ tiêu'),
(12, 1, 'Ít natri, phù hợp chế độ ăn nhạt'),
(12, 3, 'Ít béo bão hòa, tốt cho tim'),
(12, 4, 'Không đường, an toàn, no lâu'),
(12, 5, ' Cung cấp đạm chất lượng cao'),
(12, 9, 'Ít béo bão hòa, tốt cho tim'),
(12, 11, 'Giàu protein, ít chất béo giúp kiểm soát cân nặng'),
(13, 1, 'Hỗ trợ hạ áp nhờ acid béo không bão hòa'),
(13, 3, 'Giàu Omega-3 giúp giảm cholesterol'),
(13, 4, ' Ít carbohydrate, phù hợp kiểm soát đường huyết'),
(13, 6, 'DHA hỗ trợ phát triển trí não thai nhi'),
(13, 8, 'Tốt cho não, xương, giảm viêm'),
(13, 9, 'Omega-3 bảo vệ tim, chống viêm'),
(14, 1, 'Nếu nấu nhạt, tôm là nguồn đạm tốt, ít béo'),
(14, 4, 'Không chứa đường, giúp kiểm soát lượng đường huyết'),
(14, 5, 'Bổ sung protein và khoáng chất quan trọng'),
(14, 11, 'Ít calo, nhiều đạm giúp giảm cân an toàn'),
(16, 5, ' Giàu đạm và khoáng, giúp cải thiện thể trạng'),
(16, 8, 'Bổ sung canxi, tốt cho xương'),
(16, 11, 'Năng lượng thấp, nhiều đạm, ít béo'),
(18, 7, 'Giúp phát triển chiều cao, xương chắc khỏe'),
(19, 7, 'Giúp hệ tiêu hóa'),
(20, 7, 'Hỗ trợ phát triển chiều cao, cung cấp năng lượng cho học tập và vận động'),
(21, 5, 'Nguồn năng lượng lành mạnh giúp cải thiện thể trạng'),
(21, 6, 'Giúp bổ sung dưỡng chất cho mẹ và bé'),
(21, 7, 'Cung cấp canxi và protein cho xương phát triển'),
(21, 8, 'Hỗ trợ xương khớp, tránh loãng xương'),
(22, 1, 't calo, giàu chất xơ, ăn nhiều mà không sợ tăng cân.'),
(22, 2, 't calo, giàu chất xơ, ăn nhiều mà không sợ tăng cân.'),
(22, 3, 't calo, giàu chất xơ, ăn nhiều mà không sợ tăng cân.'),
(22, 4, 't calo, giàu chất xơ, ăn nhiều mà không sợ tăng cân.'),
(22, 6, 't calo, giàu chất xơ, ăn nhiều mà không sợ tăng cân.'),
(22, 11, 't calo, giàu chất xơ, ăn nhiều mà không sợ tăng cân.'),
(23, 1, ''),
(23, 2, ''),
(23, 3, ''),
(23, 4, ''),
(23, 6, ''),
(23, 9, ''),
(24, 1, 'Nhiều chất xơ, ít năng lượng, giúp kiểm soát cân nặng.'),
(24, 2, 'Nhiều chất xơ, ít năng lượng, giúp kiểm soát cân nặng.'),
(24, 3, 'Nhiều chất xơ, ít năng lượng, giúp kiểm soát cân nặng.'),
(24, 5, 'Nhiều chất xơ, ít năng lượng, giúp kiểm soát cân nặng.'),
(24, 6, 'Nhiều chất xơ, ít năng lượng, giúp kiểm soát cân nặng.'),
(24, 11, 'Nhiều chất xơ, ít năng lượng, giúp kiểm soát cân nặng.'),
(25, 1, 'Không chứa calo đáng kể, hỗ trợ tạo vị thơm hấp dẫn cho món ăn.'),
(25, 2, 'Không chứa calo đáng kể, hỗ trợ tạo vị thơm hấp dẫn cho món ăn.'),
(25, 3, 'Không chứa calo đáng kể, hỗ trợ tạo vị thơm hấp dẫn cho món ăn.'),
(25, 4, 'Không chứa calo đáng kể, hỗ trợ tạo vị thơm hấp dẫn cho món ăn.'),
(26, 1, ''),
(26, 9, ''),
(26, 10, ''),
(27, 1, ''),
(27, 3, ''),
(27, 4, ''),
(27, 5, ''),
(27, 6, ''),
(27, 9, ''),
(28, 1, ''),
(28, 5, ''),
(28, 9, ''),
(29, 1, 'Ít calo, nhiều chất xơ, giúp kiểm soát khẩu phần.'),
(29, 2, 'Ít calo, nhiều chất xơ, giúp kiểm soát khẩu phần.'),
(29, 3, 'Ít calo, nhiều chất xơ, giúp kiểm soát khẩu phần.'),
(29, 5, 'Ít calo, nhiều chất xơ, giúp kiểm soát khẩu phần.'),
(29, 11, 'Ít calo, nhiều chất xơ, giúp kiểm soát khẩu phần.'),
(30, 1, 'Ít calo, no lâu, hỗ trợ giảm cân lành mạnh.'),
(30, 2, 'Ít calo, no lâu, hỗ trợ giảm cân lành mạnh.'),
(30, 3, 'Ít calo, no lâu, hỗ trợ giảm cân lành mạnh.'),
(30, 4, 'Ít calo, no lâu, hỗ trợ giảm cân lành mạnh.'),
(30, 7, 'Ít calo, no lâu, hỗ trợ giảm cân lành mạnh.'),
(30, 11, 'Ít calo, no lâu, hỗ trợ giảm cân lành mạnh.'),
(31, 5, ''),
(31, 7, ''),
(32, 7, ''),
(33, 7, ''),
(34, 6, ''),
(34, 7, ''),
(34, 8, ''),
(35, 6, ''),
(36, 7, ''),
(37, 5, ''),
(38, 5, ''),
(38, 6, ''),
(38, 7, ''),
(39, 5, ''),
(39, 7, ''),
(40, 6, ''),
(40, 7, ''),
(40, 8, ''),
(41, 6, ''),
(41, 7, ''),
(41, 8, ''),
(42, 7, ''),
(43, 7, ''),
(44, 5, ''),
(45, 7, ''),
(45, 8, ''),
(45, 11, ''),
(46, 7, ''),
(46, 8, ''),
(46, 11, ''),
(47, 8, ''),
(50, 6, ''),
(51, 1, ''),
(51, 4, ''),
(51, 11, ''),
(52, 6, ''),
(53, 7, ''),
(53, 8, ''),
(53, 11, ''),
(54, 4, ''),
(54, 6, ''),
(54, 7, ''),
(54, 8, ''),
(54, 11, ''),
(55, 1, ''),
(55, 7, ''),
(55, 8, ''),
(56, 7, ''),
(56, 8, ''),
(56, 11, ''),
(57, 7, ''),
(57, 11, ''),
(58, 7, ''),
(58, 8, ''),
(58, 11, ''),
(59, 7, ''),
(59, 8, ''),
(59, 9, ''),
(60, 7, ''),
(60, 11, ''),
(61, 11, ''),
(62, 7, ''),
(63, 7, ''),
(64, 5, ''),
(64, 7, ''),
(65, 5, ''),
(65, 7, ''),
(66, 5, ''),
(66, 7, ''),
(67, 5, ''),
(67, 7, ''),
(68, 5, ''),
(68, 7, ''),
(69, 7, ''),
(70, 7, ''),
(71, 7, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuongthuc_thanhtoan`
--

CREATE TABLE `phuongthuc_thanhtoan` (
  `PTTT_ID` int(11) NOT NULL,
  `PTTT_TENPT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `phuongthuc_thanhtoan`
--

INSERT INTO `phuongthuc_thanhtoan` (`PTTT_ID`, `PTTT_TENPT`) VALUES
(1, 'Thanh toán khi nhân hàng'),
(2, 'Thanh toán chuyển khoản'),
(3, 'Thanh toán qua ví điện tử Momo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong_xa`
--

CREATE TABLE `phuong_xa` (
  `P_ID` int(11) NOT NULL,
  `P_TENPHUONGXA` varchar(30) NOT NULL,
  `TP_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `phuong_xa`
--

INSERT INTO `phuong_xa` (`P_ID`, `P_TENPHUONGXA`, `TP_ID`) VALUES
(1, 'Phường Sài Gòn', 1),
(2, 'Phường Tân Định', 1),
(3, 'Phường Bến Thành', 1),
(4, 'Phường Cầu Ông Lãnh', 1),
(5, 'Phường Bàn Cờ', 1),
(6, 'Phường Xuân Hòa', 1),
(7, 'Phường Nhiêu Lộc', 1),
(8, 'Phường Xóm Chiếu', 1),
(9, 'Phường Khánh Hội', 1),
(10, 'Phường Vĩnh Hội', 1),
(11, 'Phường Chợ Quán', 1),
(12, 'Phường An Đông', 1),
(13, 'Phường Chợ Lớn', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `SP_MASP` int(11) NOT NULL,
  `SP_TENSP` varchar(30) NOT NULL,
  `SP_HINH` varchar(50) NOT NULL,
  `SP_SLTON` int(11) NOT NULL,
  `SP_MOTA` text NOT NULL,
  `SP_TRANGTHAI` varchar(30) NOT NULL,
  `SP_LUOTXEM` int(11) NOT NULL,
  `SP_PHATHANH` date NOT NULL,
  `DM_MADM` int(11) DEFAULT NULL,
  `SP_DONVI` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`SP_MASP`, `SP_TENSP`, `SP_HINH`, `SP_SLTON`, `SP_MOTA`, `SP_TRANGTHAI`, `SP_LUOTXEM`, `SP_PHATHANH`, `DM_MADM`, `SP_DONVI`) VALUES
(1, 'Rau cải xanh', 'cai-be-xanh.jpg', 4, '<h3><strong>Rau Cải Xanh Tươi - 500g</strong></h3><p>Rau cải xanh là loại rau dân dã quen thuộc trong bữa cơm gia đình Việt, nổi bật với màu xanh tươi mát, lá to, thân giòn và vị hơi cay nhẹ đặc trưng. Được trồng theo quy trình sạch, không sử dụng thuốc trừ sâu độc hại, rau cải xanh không chỉ an toàn mà còn giữ được hương vị tự nhiên và hàm lượng dinh dưỡng cao.</p><p>✅ Giàu vitamin A, C, K và chất xơ</p><p>✅ Hỗ trợ hệ tiêu hóa và tăng cường đề kháng</p><p>✅ Dùng để nấu canh, luộc, xào hoặc ăn kèm thịt kho</p><p>✅ Rau được thu hoạch trong ngày, đảm bảo tươi ngon khi đến tay khách hàng</p><p><strong>Bảo quản:</strong> Ngăn mát tủ lạnh, dùng trong vòng 2–3 ngày để giữ độ tươi ngon.</p>', 'Còn kinh doanh', 63, '2025-05-01', 1, '500g'),
(2, 'Cà chua', 'ca-chua.jpg', 14, '<h4><strong>Cà chua – Ngon, bổ, dễ chế biến</strong></h4><p>&nbsp;</p><p>Cà chua là loại thực phẩm quen thuộc trong gian bếp của mỗi gia đình, nổi bật với màu đỏ tươi tự nhiên, vỏ căng mọng và hương vị ngọt thanh dễ chịu. Được canh tác theo tiêu chuẩn nông nghiệp sạch, không sử dụng chất bảo quản hay thuốc trừ sâu độc hại, cà chua giữ được độ tươi ngon và giá trị dinh dưỡng cao.</p><p>✅ Giàu vitamin A, C, K và lycopene – chất chống oxy hóa mạnh<br>✅ Tốt cho làn da, thị lực và hệ miễn dịch<br>✅ Dễ dàng chế biến: ăn sống, làm salad, nấu canh, sốt cà hay ép nước<br>✅ Thu hoạch trong ngày, đảm bảo tươi ngon và an toàn thực phẩm</p><p><strong>Bảo quản</strong>: Để nơi thoáng mát hoặc trong ngăn mát tủ lạnh, sử dụng trong vòng 3–4 ngày sau khi mua để giữ độ tươi.</p>', 'Còn kinh doanh', 15, '2025-05-01', 1, '1kg'),
(3, 'Bắp cải', 'cai-bap.jpg', 14, '<h4><strong>Bắp cải – Rau xanh thanh mát, tốt cho sức khỏe</strong></h4><p>&nbsp;</p><p>Bắp cải là loại rau củ phổ biến, dễ chế biến và được ưa chuộng trong mọi bữa ăn gia đình. Với lớp lá màu xanh nhạt, cuộn tròn chặt, giòn ngọt và mát, bắp cải không chỉ hấp dẫn về hương vị mà còn cung cấp nhiều dưỡng chất có lợi cho sức khỏe. Rau được thu hoạch trong ngày, canh tác theo quy trình sạch, không hóa chất độc hại.</p><p>✅ Giàu vitamin C, K, B6 và chất chống oxy hóa<br>✅ Hỗ trợ tiêu hóa, tốt cho tim mạch và giảm cholesterol<br>✅ Dùng để luộc, xào, nấu canh, cuốn thịt hoặc muối dưa<br>✅ Rau tươi mới mỗi ngày, đảm bảo độ giòn và vị ngọt tự nhiên</p><p><strong>Bảo quản</strong>: Gói kín và để trong ngăn mát tủ lạnh, dùng trong 3–5 ngày để đảm bảo hương vị và chất lượng.</p>', 'Còn kinh doanh', 7, '2025-05-01', 1, '500g'),
(4, 'Khóm', 'khom.jpg', 15, '<h4><strong>Trái Khóm</strong></h4><p>&nbsp;</p><p>Khóm (hay thơm) là loại trái cây nhiệt đới quen thuộc với vị ngọt đậm, thơm lừng và chút chua nhẹ đặc trưng. Được tuyển chọn từ vườn, khóm chín tự nhiên, không chất bảo quản.</p><p>✅ Giàu vitamin C, hỗ trợ tăng sức đề kháng<br>✅ Chứa enzyme bromelain giúp tiêu hóa tốt<br>✅ Dùng ăn tươi, ép nước, làm sinh tố hoặc nấu canh chua<br>✅ Trái được thu hái chín, tươi ngon – không chất bảo quản</p><p><strong>Bảo quản</strong>: Để nơi thoáng mát hoặc ngăn mát tủ lạnh. Dùng trong 2–3 ngày sau khi gọt vỏ.</p>', 'Còn kinh doanh', 3, '2025-05-01', 1, '1kg'),
(5, 'Dưa lưới', 'dualuoi.jpg', 15, '<h3><strong>Dưa Lưới Ruột Cam – 1 Trái (Khoảng 1.5–2kg)</strong></h3><p>&nbsp;</p><p>Dưa lưới có ruột màu cam, vị ngọt thanh mát, thơm dịu và giòn ngon. Được trồng theo công nghệ hiện đại, không thuốc hóa học, dưa lưới là món tráng miệng lý tưởng cho cả gia đình.</p><p>✅ Giàu vitamin A, C và kali<br>✅ Bổ sung nước, làm đẹp da và tăng đề kháng<br>✅ Dùng ăn tươi, làm salad trái cây hoặc sinh tố<br>✅ Dưa chín cây, chọn lọc kỹ, đảm bảo ngọt và thơm</p><p><strong>Bảo quản</strong>: Dưa nguyên trái để nơi thoáng mát, khi bổ nên để tủ lạnh và dùng trong 2–3 ngày.</p>', 'Còn kinh doanh', 4, '2025-05-01', 2, '1kg'),
(6, 'Dưa hấu', 'duahau.jpg', 15, '<h3><strong>Dưa Hấu Ruột Đỏ Ngọt Mát – 1 Trái (Khoảng 2–3kg)</strong></h3><p>&nbsp;</p><p>Dưa hấu được trồng theo tiêu chuẩn sạch, vỏ mỏng, ruột đỏ mọng nước, hạt nhỏ. Là lựa chọn tuyệt vời để giải nhiệt, bù nước và cung cấp vitamin tự nhiên cho cơ thể.</p><p>✅ Giàu lycopene, vitamin A, C và nước tự nhiên<br>✅ Thanh nhiệt, chống oxy hóa và tốt cho tim mạch<br>✅ Ăn trực tiếp, làm sinh tố, nước ép hoặc đá bào<br>✅ Giao dưa tươi mỗi ngày, vỏ xanh ruột đỏ, vị ngọt thanh</p><p><strong>Bảo quản</strong>: Dưa chưa cắt nên để nơi mát, dưa cắt nên để tủ lạnh và dùng trong 2–3 ngày.</p>', 'Còn kinh doanh', 0, '2025-05-01', 2, '1kg'),
(7, 'Nho', 'nho.jpg', 15, '<h4><strong>Nho Vàng Tươi – 1kg</strong></h4><p>&nbsp;</p><p>Nho vàng có vỏ mỏng, vị ngọt thanh mát và mọng nước. Được thu hoạch từ vườn trồng sạch, không thuốc hóa học độc hại, thích hợp dùng ăn trực tiếp hoặc ép nước.</p><p>✅ Giàu vitamin C và chất chống oxy hóa<br>✅ Vỏ mỏng, ít hạt, vị ngọt dễ ăn<br>✅ Dùng làm món tráng miệng, salad trái cây hoặc nước ép<br>✅ Bảo quản ngăn mát tủ lạnh 2–4 ngày</p>', 'Còn kinh doanh', 0, '2025-05-01', 2, '1kg'),
(8, 'Dâu tây', 'dautay.jpg', 15, '<h3><strong>Dâu Tây Đà Lạt – 250g</strong></h3><p>Dâu tây được trồng tại Đà Lạt có màu đỏ tươi, hương thơm quyến rũ và vị chua ngọt hài hòa. Được thu hoạch trong ngày, không thuốc hóa học.</p><p>✅ Giàu vitamin C, chất chống oxy hóa và chất xơ<br>✅ Làm đẹp da, hỗ trợ tiêu hóa và tốt cho tim mạch<br>✅ Dùng ăn tươi, chấm sữa, làm sinh tố hoặc bánh ngọt<br>✅ Giao hàng tươi mỗi ngày – trái căng mọng, sạch đẹp</p><p><strong>Bảo quản</strong>: Để tủ mát, không rửa trước khi bảo quản để giữ độ tươi.</p>', 'Còn kinh doanh', 13, '2025-05-01', 2, '250 g'),
(9, 'Gà dai', 'ga-dong-lanh.jpg', 15, '<h4><strong>Gà nguyên con – Thịt thơm ngon, giàu dinh dưỡng, chế biến linh hoạt&nbsp;</strong></h4><p>&nbsp;</p><p><strong>1. Giá trị dinh dưỡng:&nbsp;</strong></p><p>Gà nguyên con (gà ta hoặc gà công nghiệp) là nguồn thực phẩm giàu đạm và khoáng chất: Protein cao – hỗ trợ phát triển cơ bắp, phục hồi cơ thể. Vitamin nhóm B (B3, B6, B12) – tốt cho thần kinh, hỗ trợ trao đổi chất. Sắt, kẽm, phốt pho – tăng sức đề kháng, chắc xương. Chất béo tự nhiên – đặc biệt nhiều ở da và nội tạng, giúp bổ sung năng lượng.&nbsp;</p><p><strong>2. Phù hợp với ai?</strong>&nbsp;</p><p>Người lớn, trẻ nhỏ, người cao tuổi. Người tập thể hình, cần tăng cơ – giảm mỡ. Phụ nữ sau sinh, người cần phục hồi sức khỏe. Gia đình đông người – chế biến được nhiều món.&nbsp;</p><p><strong>3. Chế biến món gì?</strong>&nbsp;</p><p>Gà nguyên con rất linh hoạt, có thể làm các món: Luộc cả con – giữ được độ ngọt thịt, thường dùng trong cúng giỗ, tiệc. Nướng nguyên con – thơm lừng, vàng ruộm, thích hợp cho tiệc ngoài trời. Hầm thuốc bắc / hầm nấm / gà tiềm – bổ dưỡng cho người bệnh. Gà kho, gà rô ti, gà xào xả ớt, gà chiên nước mắm – món ăn hằng ngày. Xé phay trộn gỏi hoặc nấu cháo gà.&nbsp;</p><p><strong>4. Ăn chay hay ăn mặn?</strong>&nbsp;</p><p>Chỉ phù hợp cho người ăn mặn. Gà là sản phẩm từ động vật, không dùng trong chế độ ăn chay.&nbsp;</p><p><strong>5. Cách bảo quản:</strong>&nbsp;</p><p>Gà tươi sống hoặc đã làm sạch: Bảo quản trong ngăn mát: dùng trong 1–2 ngày. Trữ đông: có thể để 7–15 ngày (tốt nhất để trong túi hút chân không). Gà đã chế biến: Để ngăn mát và dùng trong vòng 1 ngày.&nbsp;</p><p><strong>6. Lưu ý khi sử dụng:</strong>&nbsp;</p><p>Rửa sạch và sơ chế kỹ (loại bỏ tiết, phổi, tuyến hôi dưới đuôi). Nếu gà nguyên con đã cấp đông, nên rã đông tự nhiên hoặc để trong ngăn mát qua đêm. Nên chọn gà có da vàng nhạt, thịt săn chắc – không nên chọn gà có mùi lạ, thịt mềm nhũn.</p>', 'Còn kinh doanh', 3, '2025-05-01', 3, '1kg'),
(10, 'Thịt heo', 'thit-heo.jpg', 16, '<h3><strong>Thịt Heo Nạc – 1 kg</strong></h3><p>Thịt nạc vai mềm, có chút mỡ xen kẽ giúp không bị khô khi chế biến. Được lấy từ heo sạch, nuôi theo tiêu chuẩn an toàn, không chất tăng trọng.</p><p>✅ Thích hợp kho, xào, nướng hoặc xay làm chả<br>✅ Giàu đạm, sắt và vitamin nhóm B<br>✅ Được làm sạch, hút chân không và giao tươi mỗi ngày<br>✅ Bảo quản ngăn mát 2–3 ngày, đông lạnh lên đến 7 ngày</p>', 'Còn kinh doanh', 50, '2025-05-01', 3, '1kg'),
(11, 'Thịt bò', 'thitbo.jpg', 15, '<h3><strong>Thịt Bò Tươi – 500g</strong></h3><p>&nbsp;</p><p>Thịt bò loại thường (phần đùi hoặc vai) tươi ngon mỗi ngày, thích hợp cho các món xào, kho, nấu canh hoặc nhúng lẩu. Không phẩm màu, không chất bảo quản.</p><p>✅ Thịt chắc, dễ chế biến nhiều món<br>✅ Cung cấp nhiều protein, sắt và kẽm<br>✅ Thích hợp cho cả người lớn và trẻ em<br>✅ Đóng gói hút chân không – bảo quản mát 2–3 ngày, đông lạnh 1 tuần</p>', 'Còn kinh doanh', 35, '2025-05-01', 3, '500g'),
(12, 'Ức gà', 'ucga.jpg', 15, '<h3><strong>Ức Gà Phi Lê Không Da – 500g</strong></h3><p>Ức gà đã lọc xương, bỏ da, giữ lại phần thịt trắng mềm, ít béo. Được lấy từ gà thả vườn, nuôi tự nhiên, không kháng sinh.</p><p>✅ Giàu đạm, ít chất béo – phù hợp người ăn kiêng, tập gym<br>✅ Dùng để luộc, áp chảo, nướng mật ong hoặc làm salad<br>✅ Giao hàng tươi, có thể bảo quản đông trong 5–7 ngày<br>✅ Không tẩm ướp, không chất bảo quản</p>', 'Còn kinh doanh', 6, '2025-05-01', 3, '500g'),
(13, 'Cá biển', 'ca_bien.jpg', 15, '<h3><strong>Cá Biển Tươi – 500g</strong></h3><p>&nbsp;</p><p>Cá biển tươi được đánh bắt và vận chuyển trong ngày, đảm bảo độ tươi ngon, không ướp hóa chất. Thịt cá ngọt, săn chắc, giàu dinh dưỡng và có thể chế biến đa dạng món ăn.</p><p>✅ Giàu omega-3, DHA và vitamin D<br>✅ Hỗ trợ tim mạch và não bộ<br>✅ Thích hợp để kho, nấu canh chua, chiên hoặc hấp<br>✅ Bảo quản lạnh, dùng trong 1–2 ngày</p>', 'Còn kinh doanh', 36, '2025-05-01', 4, '500g'),
(14, 'Tôm', 'tom.jpg', 15, '<h3><strong>Tôm Tươi – 500g</strong></h3><p>&nbsp;</p><p>Tôm biển tươi, thân trong, thịt chắc và ngọt. Không bơm tạp chất hay bảo quản đông lâu. Dễ chế biến các món ăn thơm ngon, giàu dinh dưỡng.</p><p>✅ Nguồn protein chất lượng cao<br>✅ Tốt cho người ăn kiêng, trẻ em và người lớn tuổi<br>✅ Dùng để luộc, hấp, chiên, nướng hoặc nấu lẩu<br>✅ Bảo quản: Ngăn đông -18°C, dùng trong 3–5 ngày</p>', 'Còn kinh doanh', 20, '2025-05-01', 4, '500g'),
(15, 'Râu mực', 'raumuc.jpg', 14, '<h3><strong>Râu Mực Tươi – 500g</strong></h3><p>&nbsp;</p><p>Râu mực giòn dai, vị ngọt tự nhiên, được sơ chế sạch sẽ, tiện lợi cho chế biến. Phù hợp cho các món xào, nướng hoặc lẩu hải sản.</p><p>✅ Chứa nhiều protein và ít béo<br>✅ Tăng cường canxi và khoáng chất<br>✅ Không chất bảo quản – an toàn cho sức khỏe<br>✅ Bảo quản: Ngăn đông, dùng trong 5–7 ngày</p>', 'Còn kinh doanh', 14, '2025-05-01', 4, '500g'),
(16, 'Cua biển', 'cuabien.jpg', 17, '<h3><strong>Cua Biển Sống – 1kg</strong></h3><p>Cua biển sống khỏe, thịt chắc và gạch béo ngậy. Được lựa chọn kỹ càng, phù hợp cho các bữa ăn dinh dưỡng gia đình.</p><p>✅ Giàu kẽm, canxi và omega-3<br>✅ Tăng cường sức đề kháng, tốt cho xương khớp<br>✅ Phù hợp để hấp, rang me, nấu lẩu<br>✅ Bảo quản sống trong thùng lạnh hoặc ngăn mát – dùng trong ngày</p>', 'Còn kinh doanh', 70, '2025-05-01', 4, '1kg'),
(18, 'Lốc sữa Fami', 'sua-fami.jpg', 10, '<h3><strong>Sữa Đậu Nành Fami – Lốc 4 hộp</strong></h3><p>&nbsp;</p><p>Sữa đậu nành Fami thơm ngon, bổ dưỡng, được chế biến từ 100% hạt đậu nành nguyên chất, không chất bảo quản. Phù hợp cho cả gia đình.</p><p>✅ Cung cấp protein thực vật, vitamin B và E<br>✅ Không cholesterol – tốt cho tim mạch<br>✅ Dễ uống, phù hợp cho mọi lứa tuổi<br>✅ Bảo quản nơi khô ráo, tránh ánh nắng – dùng ngon hơn khi uống lạnh</p>', 'Còn kinh doanh', 6, '2025-05-01', 5, '1 lốc'),
(19, 'Lốc sữa trái cây Kun', 'kun-suatraicay.jpg', 5, '<h3><strong>Lốc Sữa Trái Cây Kun – 4 hộp x 180ml</strong></h3><p>Sữa trái cây Kun với hương vị thơm ngon, bổ sung vitamin và khoáng chất cần thiết cho trẻ em. Được làm từ sữa kết hợp nước ép trái cây tự nhiên.</p><p>✅ Giàu canxi, vitamin A, D và C<br>✅ Tăng sức đề kháng, hỗ trợ phát triển chiều cao<br>✅ Hương vị thơm ngon, dễ uống cho bé<br>✅ Bảo quản nơi khô ráo, uống ngon hơn khi để lạnh</p>', 'Còn kinh doanh', 7, '2025-06-19', 5, '1 lốc'),
(20, 'Lốc sữa Milo', 'milo.jpg', 15, '<h3><strong>Lốc Sữa Milo – 4 hộp x 180ml</strong></h3><p>&nbsp;</p><p>Sữa Milo giàu năng lượng với công thức Activ-Go™ từ Nestlé, kết hợp sữa và mạch nha, phù hợp cho trẻ em và người vận động nhiều.</p><p>✅ Tăng cường thể lực và sức bền<br>✅ Giàu canxi, sắt và vitamin nhóm B<br>✅ Thích hợp cho bữa sáng hoặc sau khi chơi thể thao<br>✅ Uống ngon khi để lạnh</p>', 'Còn kinh doanh', 8, '2025-06-23', 5, '1 lốc'),
(21, 'Sữa Vinamilk', 'sua-vinamilk.jpg', 14, '<h4><strong>Sữa Vinamilk Có Đường – 4 hộp x 180ml</strong></h4><p>&nbsp;</p><p>Sữa tươi Vinamilk thanh trùng, vị ngọt nhẹ, được sản xuất từ nguồn sữa bò tươi nguyên chất, đảm bảo chất lượng và an toàn vệ sinh thực phẩm.</p><p>✅ Cung cấp đầy đủ dưỡng chất hàng ngày<br>✅ Bổ sung canxi và vitamin D cho xương chắc khỏe<br>✅ Dùng trực tiếp hoặc pha chế đồ uống<br>✅ Bảo quản lạnh sau khi mở hộp</p>', 'Còn kinh doanh', 0, '2025-06-24', 5, '1 lốc'),
(22, 'Rau muống', 'rau-muong2.jpg', 2, '<h4><strong>Rau Muống Tươi – 500g</strong></h4><p>&nbsp;</p><p>Rau muống là món rau quen thuộc trong bữa ăn Việt với vị ngọt mát, thân giòn, lá mềm. Rau được trồng theo phương pháp sạch, không thuốc trừ sâu, đảm bảo an toàn cho sức khỏe.</p><p>✅ Giàu chất xơ, vitamin A, C và khoáng chất<br>✅ Hỗ trợ thanh nhiệt, giải độc và bổ sung sắt<br>✅ Dùng để luộc, xào tỏi, nấu canh hoặc ăn lẩu<br>✅ Rau thu hoạch trong ngày, giữ được độ giòn tươi</p><p><strong>Bảo quản</strong>: Bọc kín và để trong ngăn mát, dùng trong 2–3 ngày.</p>', 'Còn kinh doanh', 1, '2025-07-02', 1, '1kg'),
(23, 'Rau mồng tơi', 'rau-mong-to.jpg', 2, '<h3><strong>Rau Mồng Tơi – 1kg</strong></h3><p>&nbsp;</p><p>Rau mồng tơi có lá màu xanh đậm, thân nhớt nhẹ đặc trưng, được biết đến là loại rau giúp thanh nhiệt cơ thể. Trồng sạch, không thuốc hóa học, mồng tơi mang đến vị ngọt mát tự nhiên.</p><p>✅ Nhiều vitamin A, C và canxi<br>✅ Tốt cho tiêu hóa, làm mát gan và nhuận tràng<br>✅ Thích hợp nấu canh cua, canh tôm, luộc<br>✅ Tươi xanh mỗi ngày, thu hoạch và giao nhanh</p><p><strong>Bảo quản</strong>: Để nơi thoáng mát hoặc trong ngăn mát tủ lạnh, dùng trong 2–3 ngày.</p>', 'Còn kinh doanh', 2, '2025-07-02', 1, '1kg'),
(24, 'Cải bó xôi', 'cai-bo-xoi.jpg', 2, '<h3><strong>Cải Bó Xôi (Spinach) – 500g</strong></h3><p>&nbsp;</p><p>Cải bó xôi hay còn gọi là rau chân vịt, là “siêu thực phẩm xanh” nổi tiếng nhờ hàm lượng dinh dưỡng cao. Lá cải mềm, màu xanh đậm, được canh tác hữu cơ, đảm bảo sạch và an toàn.</p><p>✅ Giàu sắt, folate, vitamin K và chất chống oxy hóa<br>✅ Tốt cho máu, xương và tăng sức đề kháng<br>✅ Có thể xào, luộc, nấu súp, làm salad hoặc sinh tố<br>✅ Giao hàng trong ngày, giữ trọn dưỡng chất tự nhiên</p><p><strong>Bảo quản</strong>: Giữ lạnh ở ngăn mát và sử dụng trong 2–4 ngày.</p>', 'Còn kinh doanh', 0, '2025-07-02', 1, '500g'),
(25, 'Rau húng quế', 'hung-que.jpg', 2, '<h3><strong>Rau Húng Quế Tươi – 100g</strong></h3><p>&nbsp;</p><p>Húng quế là loại rau thơm phổ biến, có mùi đặc trưng, lá nhỏ, xanh đậm và vị cay nhẹ. Được trồng sạch không thuốc trừ sâu, đảm bảo an toàn khi dùng sống hoặc nấu ăn.</p><p>✅ Giàu vitamin A, K và các chất chống oxy hóa<br>✅ Tốt cho tiêu hóa, kháng khuẩn tự nhiên<br>✅ Ăn kèm phở, bún, làm rau sống, nêm canh hoặc xào<br>✅ Rau tươi mỗi ngày, giữ được mùi thơm và vị đặc trưng</p><p><strong>Bảo quản</strong>: Quấn giấy ẩm và để trong ngăn mát, dùng trong 2–3 ngày.</p>', 'Còn kinh doanh', 0, '2025-07-02', 1, '100 g'),
(26, 'Xoài tứ quý', 'xoai-tu-quy.jpg', 3, '<h3><strong>Xoài Tứ Quý Chín Vàng – 1kg</strong></h3><p>&nbsp;</p><p>Xoài Tứ Quý có vỏ vàng đẹp mắt, thịt dày, hạt nhỏ, vị ngọt thanh. Là loại xoài nổi tiếng với năng suất cao và chất lượng ổn định quanh năm.</p><p>✅ Giàu vitamin A, C và enzyme hỗ trợ tiêu hóa<br>✅ Tốt cho mắt, tăng đề kháng và đẹp da<br>✅ Dùng ăn chín, làm sinh tố, xay đá hoặc tráng miệng<br>✅ Xoài chín cây – không ủ hóa chất</p>', 'Còn kinh doanh', 1, '2025-07-02', 2, '1kg'),
(27, 'Bơ sáp', 'bo-sap.jpg', 3, '<h3><strong>Bơ Sáp – 1kg</strong></h3><p>&nbsp;</p><p>Bơ sáp được tuyển chọn từ vùng Tây Nguyên, vỏ xanh, thịt vàng, béo ngậy và ít xơ. Được trồng theo quy trình sạch, an toàn cho sức khỏe.</p><p>✅ Giàu chất béo tốt, vitamin E và kali<br>✅ Hỗ trợ tim mạch, làm đẹp da và giảm cholesterol<br>✅ Dùng làm sinh tố, salad, ăn kèm bánh mì hoặc sushi<br>✅ Giao hàng bơ chín mềm – dễ tách vỏ, béo ngậy</p>', 'Còn kinh doanh', 1, '2025-07-02', 2, '1kg'),
(28, 'Chuối già', 'chuoi.jpg', 3, '<h3><strong>Chuối Già Chín Tự Nhiên – 1kg</strong></h3><p>&nbsp;</p><p>Chuối già chín cây có vỏ vàng óng, thịt mềm, ngọt tự nhiên, là loại trái cây thân thuộc và giàu năng lượng cho mọi lứa tuổi.</p><p>✅ Cung cấp kali, vitamin B6 và chất xơ<br>✅ Tốt cho tiêu hóa, giúp no lâu và hỗ trợ tim mạch<br>✅ Dùng ăn trực tiếp, làm bánh, nấu chè hoặc sinh tố<br>✅ Không ngâm thuốc, chín tự nhiên, giao hàng tươi</p>', 'Còn kinh doanh', 0, '2025-07-02', 2, '1kg'),
(29, 'Trái quýt', 'trai-quyt.jpg', 3, '<h4><strong>Trái Quýt – 1kg</strong></h4><p>&nbsp;</p><p>Quýt đường có vỏ mỏng, dễ bóc, múi ngọt thanh, ít hạt và mọng nước. Được canh tác theo tiêu chuẩn sạch, an toàn cho cả trẻ nhỏ.</p><p>✅ Giàu vitamin C, hỗ trợ tăng đề kháng và thanh nhiệt<br>✅ Ăn tươi, vắt nước hoặc làm món tráng miệng<br>✅ Giao quýt chín đều, trái đều, không sâu cuống<br>✅ Bảo quản nơi mát hoặc ngăn mát tủ lạnh 2–4 ngày</p>', 'Còn kinh doanh', 0, '2025-07-02', 2, '1kg'),
(30, 'Sữa óc chó', 'sau-oc-cho.jpg', 15, '<h3><strong>Sữa Óc Chó – 4 hộp x 180ml</strong></h3><p>&nbsp;</p><p>Sữa hạt óc chó nhập khẩu, kết hợp óc chó, hạnh nhân và đậu đen, thơm béo tự nhiên, giàu chất béo tốt và chất chống oxy hóa.</p><p>✅ Tốt cho tim mạch và trí não<br>✅ Không chứa lactose – phù hợp người ăn chay<br>✅ Uống ngon khi để lạnh<br>✅ Bảo quản nơi thoáng mát</p>', 'Còn kinh doanh', 2, '2025-07-02', 5, '1 lốc'),
(31, 'Sữa đặc có đường', 'sua-ngoisao.jpg', 15, '<h4><strong>Sữa Đặc Có Đường - 1 hộp</strong></h4><p>&nbsp;</p><p>Sữa đặc có đường béo ngậy, thích hợp pha cà phê, làm bánh hoặc ăn kèm với bánh mì. Được làm từ sữa nguyên kem và đường chất lượng cao.</p><p>✅ Bổ sung năng lượng nhanh<br>✅ Hương vị thơm béo truyền thống<br>✅ Dễ dàng chế biến món ăn và thức uống<br>✅ Bảo quản nơi khô ráo, đậy kín sau khi mở</p>', 'Còn kinh doanh', 0, '2025-07-02', 5, '1 hộp'),
(32, 'Lốc sữa tươi chuối', 'sua-vinamilk-chuoi.jpg', 15, '<h3><strong>Lốc Sữa Tươi Vị Chuối – 4 hộp x 180ml</strong></h3><p>&nbsp;</p><p>Sữa tươi hương chuối thơm ngọt, dễ uống, phù hợp cho cả trẻ em và người lớn. Kết hợp giữa sữa và hương chuối tự nhiên, tạo cảm giác ngon miệng.</p><p>✅ Bổ sung canxi và vitamin D<br>✅ Thơm béo, mát lạnh – ngon hơn khi để tủ lạnh<br>✅ Phù hợp cho bữa phụ của bé<br>✅ Không chứa chất bảo quản độc hại</p>', 'Còn kinh doanh', 1, '2025-07-02', 5, '1 lốc'),
(33, 'Lốc sữa Dutch Lady', 'sua-dutchlaydy.jpg', 15, '<h3><strong>Lốc Sữa Dutch Lady – 4 hộp x 180ml</strong></h3><p>&nbsp;</p><p>Sữa Dutch Lady bổ sung năng lượng, canxi và dưỡng chất thiết yếu. Vị thơm ngon, dễ uống, phù hợp cho mọi thành viên trong gia đình.</p><p>✅ Tăng cường sức khỏe xương và răng<br>✅ Có nhiều hương vị: dâu, socola, vani…<br>✅ Uống liền hoặc dùng chung với ngũ cốc, bánh<br>✅ Bảo quản nơi mát, lạnh hơn khi dùng</p>', 'Còn kinh doanh', 1, '2025-07-02', 5, '1 lốc'),
(34, 'Trứng gà ', 'trung-ga.jpg', 15, '<h3><strong>Trứng Gà Sạch – Vỉ 10 quả</strong></h3><p>Trứng gà sạch được thu hoạch từ những trang trại chăn nuôi theo quy trình khép kín, đảm bảo vệ sinh an toàn thực phẩm và không sử dụng kháng sinh hay chất tăng trưởng. Lòng đỏ trứng đậm màu, lòng trắng dẻo, khi chế biến mang lại hương vị béo bùi, thơm ngon đặc trưng.</p><p>✅ Nguồn protein tự nhiên, giàu vitamin B, D và khoáng chất<br>✅ Giúp bổ sung năng lượng, hỗ trợ phát triển cơ bắp và trí não<br>✅ Thích hợp để luộc, chiên, kho, làm bánh hoặc ăn kèm món salad<br>✅ Trứng được kiểm tra kỹ lưỡng trước khi đóng gói, đảm bảo không nứt, không hư</p><p><strong>Bảo quản</strong>: Nơi thoáng mát, tránh ánh nắng trực tiếp. Dùng tốt nhất trong 10–15 ngày kể từ ngày đóng gói.</p>', 'Còn kinh doanh', 0, '2025-07-06', 7, '1 hộp'),
(35, 'Trứng vịt', 'trung-vit.jpg', 15, '<h3><strong>Trứng Vịt Tươi - 10 quả</strong></h3><p>Trứng vịt là nguồn thực phẩm giàu dưỡng chất, có hương vị đậm đà, lòng đỏ lớn và béo ngậy hơn so với trứng gà. Được thu hoạch từ các trang trại chăn nuôi sạch, trứng vịt đảm bảo không chất tăng trưởng, không kháng sinh độc hại, an toàn cho cả gia đình.</p><p>✅ Giàu protein, vitamin A, D, B12 và các khoáng chất như sắt, kẽm<br>✅ Tốt cho trí não và tăng cường năng lượng<br>✅ Dùng để luộc, chiên, làm bánh, hoặc nấu cháo dinh dưỡng<br>✅ Vỏ dày, dễ bảo quản, lòng đỏ sậm màu tự nhiên</p><p><strong>Bảo quản</strong>: Để nơi khô ráo, thoáng mát. Nếu để tủ lạnh, nên dùng trong vòng 7–10 ngày để đảm bảo độ tươi.</p>', 'Còn kinh doanh', 0, '2025-07-05', 7, '1 hộp'),
(36, 'Trứng cút', 'trung-cut.jpg', 15, '<h3><strong>Trứng Cút Tươi - Hộp 20 quả</strong></h3><p>Trứng cút là loại thực phẩm nhỏ nhưng giàu giá trị dinh dưỡng, rất được ưa chuộng trong các bữa ăn gia đình Việt. Với vỏ lốm đốm đặc trưng, trứng cút chứa nhiều <strong>protein, vitamin B, sắt và khoáng chất</strong>, thích hợp cho cả người lớn và trẻ nhỏ.</p><p>✅ Kích thước nhỏ, dễ chế biến và tiêu hóa<br>✅ Giàu dinh dưỡng: đạm, sắt, vitamin A và B12<br>✅ Dùng để luộc, chiên, kho, nướng hoặc làm món ăn vặt<br>✅ Thu hoạch và đóng gói trong ngày, đảm bảo tươi ngon</p><p><strong>Bảo quản</strong>: Ngăn mát tủ lạnh, dùng trong 5–7 ngày.</p>', 'Còn kinh doanh', 0, '2025-07-06', 7, '1 hộp'),
(37, 'Thịt heo ba rọi', 'thit-heo-3-roi.jpg', 10, '<h3><strong>Thịt Heo Ba Rọi Tươi - 500g</strong></h3><p>Thịt heo ba rọi (ba chỉ) là phần thịt được lấy từ bụng heo, nổi bật với 3 lớp: nạc – mỡ – da xen kẽ tạo nên độ mềm ngậy và thơm ngon đặc trưng. Thịt được tuyển chọn từ heo nuôi theo quy trình sạch, không sử dụng chất tăng trưởng hay kháng sinh, đảm bảo an toàn cho sức khỏe người tiêu dùng.</p><p>✅ Mềm, thơm, béo vừa phải – dễ chế biến nhiều món ngon<br>✅ Thích hợp cho các món: thịt kho trứng, ba rọi nướng, chiên giòn, luộc cuốn bánh tráng,...<br>✅ Thịt được làm sạch và đóng gói trong ngày, đảm bảo tươi ngon khi giao đến tay khách hàng</p><p>? <strong>Bảo quản</strong>: Ngăn mát tủ lạnh 0–4°C, dùng trong vòng 2–3 ngày.<br>Nếu không dùng ngay, có thể bảo quản ngăn đông để giữ độ tươi.</p>', 'Còn kinh doanh', 0, '2025-07-08', 3, '300g'),
(38, 'Thịt heo xay', 'thit-heo-bam.jpg', 10, '<h3><strong>Thịt Heo Xay Tươi – 500g</strong></h3><p>Thịt heo xay được xay nhuyễn từ phần nạc vai hoặc ba rọi tươi, đảm bảo độ mềm, thơm và độ béo vừa phải. Là nguyên liệu quen thuộc trong nhiều món ăn gia đình Việt như chả, thịt viên, canh nhồi, xíu mại,... Thịt được xay trong ngày, không chất bảo quản, đảm bảo an toàn và tươi ngon.</p><p>✅ Được chọn lọc từ thịt sạch, không chất tăng trọng<br>✅ Phù hợp với nhiều món ăn truyền thống và hiện đại<br>✅ Tiện lợi, dễ chế biến và tiết kiệm thời gian</p><p><strong>Bảo quản</strong>: Ngăn mát (0–4°C) trong 1–2 ngày, hoặc ngăn đông (-18°C) trong 7–10 ngày.</p>', 'Còn kinh doanh', 1, '2025-07-08', 3, '300g'),
(39, 'Xương heo', 'xuong-heo.jpg', 10, '<h3><strong>Xương Heo Tươi – 300g</strong></h3><p>Xương heo được tuyển chọn từ những con heo khỏe mạnh, có nguồn gốc rõ ràng, được làm sạch và bảo quản đúng quy trình. Xương còn nhiều thịt bám, thích hợp để nấu nước dùng ngọt thanh hoặc hầm cùng rau củ cho các món canh bổ dưỡng.</p><p>✅ Xương tươi, không tẩm ướp, không chất bảo quản<br>✅ Là nguyên liệu lý tưởng để nấu nước dùng cho phở, hủ tiếu, lẩu…<br>✅ Giúp món ăn thơm ngon, ngọt tự nhiên và giàu dinh dưỡng</p><p><strong>Bảo quản</strong>:</p><p>Ngăn mát: Dùng trong 1–2 ngày</p><p>Ngăn đông: Dùng trong 7–10 ngày để giữ độ tươi ngon</p>', 'Còn kinh doanh', 0, '2025-07-08', 3, '300g'),
(40, 'Sườn heo non', 'suon-heo.jpg', 10, '<h3><strong>Sườn Heo Non Tươi – 500g</strong></h3><p>Sườn heo non được cắt từ phần xương sườn gần ngực của heo, có tỷ lệ thịt và xương hài hòa, thịt mềm, ít mỡ, dễ chế biến nhiều món ngon. Sản phẩm được chọn lọc kỹ lưỡng từ heo khỏe mạnh, đảm bảo tươi ngon và không chứa chất bảo quản độc hại.</p><p>✅ Thịt mềm, ít gân, không quá nhiều mỡ<br>✅ Phù hợp để làm sườn ram, nướng, kho, sốt me hoặc nấu canh chua<br>✅ Được sơ chế sạch sẽ, bảo quản đúng chuẩn vệ sinh an toàn thực phẩm</p><p><strong>Bảo quản:</strong></p><p>Ngăn mát: dùng trong vòng 1–2 ngày</p><p>Ngăn đông: có thể bảo quản 5–7 ngày để giữ độ tươi</p>', 'Còn kinh doanh', 0, '2025-07-08', 3, '300g'),
(41, 'Đùi tỏi gà', 'thit-ga.jpg', 10, '<h3><strong>Đùi Tỏi Gà Tươi – 500g</strong></h3><p>Đùi tỏi gà là phần thịt săn chắc, da mỏng, ít mỡ và cực kỳ thơm ngon sau khi chế biến. Đây là phần thịt được ưa chuộng nhất vì dễ ăn, mềm vừa phải và giàu dinh dưỡng. Gà được nuôi theo quy trình sạch, không sử dụng chất tăng trọng.</p><p>✅ Thịt săn chắc, ít dai, không bở<br>✅ Phù hợp với món chiên nước mắm, nướng mật ong, hấp gừng, kho gừng hoặc nấu cháo<br>✅ Sản phẩm được sơ chế sạch, đóng gói hút chân không đảm bảo vệ sinh</p><p><strong>Bảo quản:</strong></p><p>Ngăn mát: dùng trong 1–2 ngày</p><p>Ngăn đông: dùng trong vòng 5–7 ngày để giữ được hương vị</p>', 'Còn kinh doanh', 0, '2025-07-08', 3, '500g'),
(42, 'Cánh gà', 'canh-ga.jpg', 10, '<h3><strong>Cánh Gà Tươi – 300g</strong></h3><p>Cánh gà là phần thịt mềm, da giòn khi chiên hoặc nướng, là nguyên liệu yêu thích cho nhiều món ăn hấp dẫn. Với tỉ lệ thịt – da – xương cân đối, cánh gà thích hợp từ bữa ăn gia đình đến các món nhậu. Gà được nuôi sạch, không thuốc tăng trọng, được sơ chế kỹ, đảm bảo an toàn thực phẩm.</p><p>✅ Phù hợp chế biến món: cánh gà chiên nước mắm, nướng mật ong, rim tiêu, hấp xả<br>✅ Sơ chế sạch, đóng gói tiện lợi – mua về có thể dùng ngay<br>✅ Da giòn, thịt ngọt, không bở</p><p><strong>Bảo quản:</strong></p><p>Ngăn mát: 1–2 ngày</p><p>Ngăn đông: 5–7 ngày</p>', 'Còn kinh doanh', 0, '2025-07-08', 3, '300g'),
(43, 'Xương gà', 'xuong-ga.jpg', 10, '<h3><strong>Xương Gà Tươi – 500g</strong></h3><p>Xương gà tươi là nguyên liệu lý tưởng để nấu nước dùng ngọt thanh, làm nền cho các món súp, bún, phở, cháo… Được sơ chế sạch sẽ, không còn phần thịt thừa hay máu bầm, đảm bảo an toàn và giữ được vị ngọt tự nhiên đặc trưng từ xương.</p><p>✅ Thích hợp nấu nước dùng, hầm canh, nấu cháo cho bé<br>✅ Xương chắc, không tanh, không mỡ thừa<br>✅ Đóng gói sạch sẽ, tiện lợi sử dụng</p><p><strong>Bảo quản:</strong></p><p>Ngăn mát: 1–2 ngày</p><p>Ngăn đông: 5–7 ngày</p>', 'Còn kinh doanh', 0, '2025-07-08', 3, '500g'),
(44, 'Chân gà', 'chan-ga.jpg', 10, '<h3><strong>Chân Gà Tươi – 500g</strong></h3><p>Chân gà tươi là món ăn khoái khẩu được nhiều người yêu thích nhờ độ giòn sần sật, dễ chế biến và giàu collagen. Chân gà tại cửa hàng được làm sạch, sơ chế kỹ, không còn móng và lớp da bẩn, đảm bảo an toàn vệ sinh thực phẩm.</p><p>✅ Giàu collagen – tốt cho da và xương khớp<br>✅ Có thể chế biến thành nhiều món hấp dẫn như: chân gà ngâm sả tắc, chân gà nướng, hấp hành, hầm thuốc bắc,...<br>✅ Đóng gói kỹ lưỡng, bảo quản lạnh an toàn</p><p><strong>Bảo quản:</strong></p><p>Ngăn mát: 1–2 ngày</p><p>Ngăn đông: 5–7 ngày</p>', 'Còn kinh doanh', 0, '2025-07-08', 3, '300g'),
(45, 'Cải thìa', 'cai-thia.jpg', 5, '<h3><strong>Cải Thìa Tươi – 500g</strong></h3><p>Cải thìa (hay còn gọi là cải bẹ trắng) là loại rau xanh phổ biến, có thân trắng, lá xanh mướt, vị ngọt thanh và giòn nhẹ. Được trồng theo phương pháp an toàn, không hóa chất độc hại, rau cải thìa tại cửa hàng đảm bảo sạch, tươi và đầy đủ dưỡng chất.</p><p>✅ Giàu vitamin A, C, K, canxi và chất xơ<br>✅ Tốt cho hệ tiêu hóa, tăng cường thị lực và giúp xương chắc khỏe<br>✅ Thích hợp chế biến đa dạng: luộc, xào tỏi, nấu canh, ăn kèm lẩu, mì,...</p><p><strong>Bảo quản:</strong></p><p>Ngăn mát tủ lạnh: dùng trong 2–3 ngày để giữ độ tươi ngon</p>', 'Còn kinh doanh', 0, '2025-07-08', 1, '300g'),
(46, 'Cải ngọt', 'cai-ngot.jpg', 5, '<h3><strong>Cải Ngọt Tươi – 500g</strong></h3><p>Cải ngọt là loại rau xanh phổ biến trong ẩm thực Việt, nổi bật với vị ngọt thanh, lá mềm, thân giòn và màu xanh tươi mát. Rau được canh tác theo phương pháp sạch, không sử dụng thuốc trừ sâu độc hại, đảm bảo an toàn cho sức khỏe người dùng.</p><p>✅ Giàu vitamin A, B, C, K và khoáng chất như canxi, sắt<br>✅ Hỗ trợ tiêu hóa, làm đẹp da, ngừa táo bón và tăng cường đề kháng<br>✅ Dùng để nấu canh, xào tỏi, luộc hoặc ăn kèm món kho, món lẩu</p><p><strong>Bảo quản:</strong></p><p>Ngăn mát tủ lạnh, sử dụng trong 2–3 ngày để đảm bảo độ tươi và giá trị dinh dưỡng</p>', 'Còn kinh doanh', 0, '2025-07-08', 1, '300g'),
(47, 'Rau râm', 'rau-ram.jpg', 5, '<h3><strong>Rau Răm Tươi – 100g</strong></h3><p>Rau răm là loại rau thơm quen thuộc trong ẩm thực Việt Nam, có mùi thơm nồng đặc trưng, lá thon dài, màu xanh đậm. Không chỉ làm tăng hương vị cho món ăn, rau răm còn mang lại nhiều lợi ích cho sức khỏe. Rau được trồng theo phương pháp sạch, không sử dụng hóa chất độc hại, đảm bảo an toàn khi sử dụng.</p><p>✅ Giàu tinh dầu, vitamin A, C, sắt và kẽm<br>✅ Hỗ trợ tiêu hóa, làm ấm bụng, kháng khuẩn tự nhiên<br>✅ Thích hợp ăn kèm hột vịt lộn, gỏi gà, cháo, trứng vịt, hải sản…</p><p><strong>Bảo quản:</strong></p><p>Bọc giấy hoặc khăn ẩm, để trong ngăn mát tủ lạnh và dùng trong 2–3 ngày</p>', 'Còn kinh doanh', 0, '2025-07-08', 1, '50g'),
(48, 'Rau diếp cá', 'rau-diep-ca.jpg', 5, '<h3><strong>Rau Diếp Cá Tươi – 100g</strong></h3><p>Rau diếp cá là loại rau thơm có hương vị đặc trưng, hơi tanh nhẹ, được sử dụng phổ biến trong các món ăn và bài thuốc dân gian. Với đặc tính mát, giải độc và kháng khuẩn tự nhiên, rau diếp cá không chỉ là món ăn kèm mà còn mang lại nhiều lợi ích cho sức khỏe. Rau được trồng sạch, không hóa chất, đảm bảo an toàn khi sử dụng.</p><p>✅ Giúp thanh nhiệt, giải độc, lợi tiểu<br>✅ Hỗ trợ điều trị táo bón, trĩ, mụn nhọt<br>✅ Có thể ăn sống, xay lấy nước uống, nấu cháo hoặc giã đắp ngoài da</p><p><strong>Bảo quản:</strong></p><p>Gói bằng khăn ẩm hoặc túi giấy, bảo quản trong ngăn mát tủ lạnh và dùng trong 2–3 ngày.</p>', 'Còn kinh doanh', 0, '2025-07-08', 1, '100g'),
(49, 'Hành lá', 'hanh-la.jpg', 5, '<h3><strong>Hành Lá Tươi – 100g</strong></h3><p>Hành lá là nguyên liệu quen thuộc không thể thiếu trong gian bếp Việt. Với mùi thơm đặc trưng, vị cay nhẹ và màu xanh tươi bắt mắt, hành lá giúp tăng hương vị cho món ăn và mang lại nhiều lợi ích cho sức khỏe. Sản phẩm được trồng theo quy trình sạch, không sử dụng thuốc hóa học, đảm bảo an toàn cho người tiêu dùng.</p><p>✅ Giàu vitamin A, C, K và các chất chống oxy hóa<br>✅ Tăng cường đề kháng, hỗ trợ hô hấp và tiêu hóa<br>✅ Dùng để xào, nấu canh, làm gia vị rắc lên món ăn, ướp thịt cá...</p><p><strong>Bảo quản:</strong></p><p>Bọc bằng khăn giấy khô hoặc túi zip, bảo quản trong ngăn mát tủ lạnh. Dùng trong 3–4 ngày để giữ độ tươi ngon.</p>', 'Còn kinh doanh', 0, '2025-07-08', 1, '100g'),
(50, 'Rau ngót', 'rau-ngot.jpg', 5, '<h3><strong>Rau Ngót Tươi – 300g</strong></h3><p>Rau ngót là loại rau quen thuộc trong mâm cơm Việt, nổi bật với vị ngọt tự nhiên, lá dày và giàu dưỡng chất. Được trồng theo quy trình sạch, rau ngót đảm bảo độ tươi xanh, không thuốc trừ sâu, an toàn cho sức khỏe người tiêu dùng. Đây là nguyên liệu lý tưởng để nấu canh thanh mát cho cả gia đình.</p><p>✅ Giàu vitamin A, C, B1 và chất xơ<br>✅ Thanh nhiệt, giải độc, hỗ trợ lợi tiểu và cải thiện giấc ngủ<br>✅ Phù hợp cho người già, trẻ em và phụ nữ sau sinh</p><p><strong>Cách dùng:</strong></p><p>Rau ngót thường được nấu canh với thịt bằm, tôm hoặc nấu chay.</p><p>Có thể giã lấy nước để uống giúp thanh lọc cơ thể (theo dân gian).</p><p><strong>Bảo quản:</strong></p><p>&nbsp;</p>', 'Còn kinh doanh', 0, '2025-07-08', 1, '250g'),
(51, 'Rau đắng', 'rau-dang.jpg', 5, '<h3><strong>Rau Đắng - 200g</strong></h3><p>Rau đắng là một loại rau dân dã, có vị hơi đắng đặc trưng, thường được dùng trong các món ăn truyền thống Việt Nam như canh chua cá, lẩu mắm, hoặc ăn sống kèm với các món kho. Rau đắng không chỉ làm tăng hương vị món ăn mà còn mang lại nhiều lợi ích cho sức khỏe nhờ hàm lượng dinh dưỡng cao và đặc tính thanh mát.</p><p>✅ Giàu vitamin A, C và các chất chống oxy hóa<br>✅ Hỗ trợ tiêu hóa, giải nhiệt và thanh lọc cơ thể<br>✅ Phù hợp với người ăn uống thanh đạm hoặc đang trong chế độ giảm cân<br>✅ Rau được trồng theo phương pháp tự nhiên, đảm bảo an toàn và tươi sạch</p><p><strong>Bảo quản</strong>: Để trong ngăn mát tủ lạnh, dùng trong vòng 2–3 ngày sau khi mua.</p>', 'Còn kinh doanh', 0, '2025-07-08', 1, '200g'),
(52, 'Tía tô', 'tia-to.jpg', 5, '<h3><strong>Rau Tía Tô Tươi – 100g</strong></h3><p>Tía tô là loại rau gia vị quen thuộc trong ẩm thực Việt, nổi bật với hương thơm đặc trưng, lá có màu xanh tím đẹp mắt và vị cay nhẹ. Ngoài việc được dùng ăn sống, ăn kèm hoặc nấu cháo, tía tô còn là dược liệu quý trong y học cổ truyền nhờ đặc tính kháng khuẩn, giải cảm và tăng cường sức khỏe.</p><p>✅ Giàu vitamin A, C và các hợp chất chống oxy hóa<br>✅ Hỗ trợ giảm cảm lạnh, đau bụng, dị ứng thời tiết<br>✅ Tăng cường hệ miễn dịch, hỗ trợ tiêu hóa<br>✅ Trồng sạch, không thuốc bảo vệ thực vật, đảm bảo an toàn</p><p><strong>Bảo quản</strong>: Đặt trong ngăn mát tủ lạnh, dùng trong vòng 2–3 ngày.</p>', 'Còn kinh doanh', 0, '2025-07-08', 1, '100g'),
(53, 'Trái mận', 'trai-man.jpg', 5, '<h3><strong>Mận Tươi – 1kg</strong></h3><p>Mận là loại trái cây đặc trưng của mùa hè, có vị ngọt chua thanh mát, vỏ đỏ tím hoặc xanh, bên trong thịt giòn, mọng nước. Mận không chỉ giúp giải nhiệt mà còn chứa nhiều dưỡng chất tốt cho sức khỏe, thường được dùng ăn tươi, làm mứt, ngâm chua ngọt hoặc ép lấy nước.</p><p>✅ Giàu vitamin C, A và chất chống oxy hóa<br>✅ Hỗ trợ tiêu hóa, làm đẹp da và tăng cường sức đề kháng<br>✅ Có tác dụng thanh nhiệt, giải độc cơ thể<br>✅ Mận tươi sạch, thu hoạch theo mùa, không thuốc bảo quản</p><p><strong>Bảo quản</strong>: Bảo quản nơi khô ráo, thoáng mát hoặc trong ngăn mát tủ lạnh, dùng trong 2–3 ngày sau khi mua.</p>', 'Còn kinh doanh', 0, '2025-07-08', 2, '1kg'),
(54, 'Táo Ninh Thuận', 'trai-tao.jpg', 5, '<h3><strong>Táo Xanh Tươi – 500g</strong></h3><p>Táo xanh là loại trái cây được ưa chuộng bởi vị giòn, chua nhẹ và thơm mát, thường dùng để ăn trực tiếp, ép nước, làm salad hoặc chế biến món tráng miệng. Với lớp vỏ xanh bóng, thịt trắng, chắc, táo xanh không chỉ hấp dẫn mà còn giàu dinh dưỡng và lợi ích sức khỏe.</p><p>✅ Giàu vitamin C, chất chống oxy hóa và chất xơ<br>✅ Hỗ trợ tiêu hóa, tốt cho da và tim mạch<br>✅ Giúp kiểm soát cân nặng và lượng đường trong máu<br>✅ Táo được tuyển chọn kỹ, tươi ngon, không chất bảo quản</p><p><strong>Bảo quản</strong>: Để nơi thoáng mát hoặc trong ngăn mát tủ lạnh, dùng trong vòng 5–7 ngày để giữ được độ giòn và vị tươi.</p>', 'Còn kinh doanh', 2, '2025-07-08', 2, '500g'),
(55, 'Thanh long', 'thanh-long.jpg', 5, '<h3><strong>Thanh Long – 1kg</strong></h3><p>Thanh long là loại trái cây nhiệt đới nổi bật với vỏ ngoài màu hồng rực rỡ và phần ruột trắng hoặc đỏ điểm những hạt đen nhỏ. Với vị ngọt thanh, thanh long không chỉ giải nhiệt mà còn cung cấp nhiều vitamin và khoáng chất có lợi cho cơ thể.</p><p>✅ Giàu vitamin C, B1, B2 và chất chống oxy hóa<br>✅ Hỗ trợ tiêu hóa, làm đẹp da, tăng cường miễn dịch<br>✅ Thích hợp ăn trực tiếp, làm sinh tố hoặc món tráng miệng<br>✅ Thanh long sạch, chín cây, không hóa chất bảo quản</p><p><strong>Bảo quản</strong>: Nơi thoáng mát, dùng trong 3–5 ngày. Có thể để ngăn mát tủ lạnh để tăng độ giòn ngọt.</p>', 'Còn kinh doanh', 0, '2025-07-08', 2, '1kg'),
(56, 'Trái lê', 'trai-le.jpg', 5, '<h3><strong>Lê Tươi Giòn Ngọt – 1kg</strong></h3><p>Trái lê là loại quả có hương vị ngọt dịu, mọng nước, giòn và mát, rất được yêu thích. Lê giúp thanh nhiệt, bổ phổi và thường được dùng để ăn tươi hoặc nấu nước uống mát.</p><p>✅ Giàu vitamin C, K, kali và chất xơ<br>✅ Tốt cho tiêu hóa, giúp làm mát cơ thể và hỗ trợ hệ miễn dịch<br>✅ Có thể ăn sống, ép nước hoặc nấu món tráng miệng<br>✅ Lê được chọn lọc kỹ, đảm bảo độ giòn ngọt tự nhiên</p><p><strong>Bảo quản</strong>: Ngăn mát tủ lạnh, dùng trong 5–7 ngày.</p>', 'Còn kinh doanh', 0, '2025-07-08', 2, '1kg'),
(57, 'Cá ba sa cắt khúc', 'ca-basa.jpg', 5, '<h3><strong>Cá Basa Phi Lê – 500g</strong></h3><p>Cá basa là loại cá nước ngọt được nuôi nhiều ở miền Tây Nam Bộ, thịt cá trắng mềm, ít xương và béo nhẹ. Phù hợp để kho, chiên giòn hoặc nấu lẩu.</p><p>✅ Thịt mềm, không tanh, dễ chế biến<br>✅ Giàu omega-3, protein và vitamin B12<br>✅ Phù hợp cho mọi độ tuổi</p><p><strong>Bảo quản</strong>: Ngăn đông, dùng trong 2–3 ngày sau khi rã đông.</p>', 'Còn kinh doanh', 0, '2025-07-08', 4, '500g'),
(58, 'cá điều hồng', 'ca-dieu-hong.jpg', 5, '<h3><strong>Cá Diêu Hồng Làm Sạch – 1kg</strong></h3><p>Cá diêu hồng là cá nước ngọt, thịt dai ngọt, ít tanh, thích hợp để chiên xù, hấp gừng, hoặc nấu canh chua.</p><p>✅ Thịt chắc, ít xương dăm<br>✅ Giàu omega-3, vitamin D, tốt cho tim mạch<br>✅ Cá sạch, nuôi trong môi trường kiểm soát</p>', 'Còn kinh doanh', 0, '2025-07-08', 4, '500g'),
(59, 'cá nục', 'ca-nuc.jpg', 5, '<h3><strong>Cá Nục Tươi – 500g</strong></h3><p>Cá nục là loại cá biển phổ biến với thịt mềm, vị đậm đà. Dễ chế biến món cá nục kho cà, nướng giấy bạc hoặc chiên.</p><p>✅ Giàu omega-3, vitamin B12<br>✅ Tốt cho não bộ và tim mạch<br>✅ Cá tươi đánh bắt trong ngày</p>', 'Còn kinh doanh', 0, '2025-07-08', 4, '500g'),
(60, 'Cá Lóc làm sạch', 'ca-loc.jpg', 5, '<h3><strong>Cá Lóc Đồng Làm Sạch – 500g</strong></h3><p>Cá lóc (cá quả) là loại cá đồng quen thuộc, thịt dai và thơm. Thích hợp cho các món kho tộ, hấp, nấu canh chua.</p><p>✅ Thịt trắng, dai, ít tanh<br>✅ Giàu đạm, ít chất béo<br>✅ Dễ tiêu hóa, phù hợp mọi người</p>', 'Còn kinh doanh', 0, '2025-07-08', 4, '500g'),
(61, 'Cá Trác', 'ca-trac.jpg', 5, '<h3><strong>Cá Trác Biển Tươi – 300g</strong></h3><p>Cá trác (hoặc cá sơn) là cá biển, thịt trắng, săn chắc. Thích hợp cho món nướng, hấp xì dầu hoặc kho.</p><p>✅ Tươi sống mỗi ngày<br>✅ Giàu đạm, omega-3<br>✅ Ít mùi tanh, dễ chế biến</p>', 'Còn kinh doanh', 0, '2025-07-08', 4, '300g'),
(62, 'Cá Hú', 'ca-hu.jpg', 5, '<h3><strong>Cá Hú Làm Sạch – 1kg</strong></h3><p>Cá hú thuộc họ cá tra, thịt mềm béo, ngon nhất khi kho tộ hoặc nấu lẩu mắm.</p><p>✅ Thịt béo, thơm, ít xương<br>✅ Giàu omega-3, vitamin D<br>✅ Cá nuôi sạch không chất tăng trọng</p>', 'Còn kinh doanh', 0, '2025-07-08', 4, '1kg'),
(63, 'Cá Cam', 'ca-cam.jpg', 5, '<h3><strong>Cá Cam Biển – 500g</strong></h3><p>Cá cam là loại cá biển cao cấp, thịt trắng, ngọt, mềm và ít xương. Thích hợp cho món sashimi, nướng muối ớt, hoặc áp chảo.</p><p>✅ Tốt cho tim mạch và não bộ<br>✅ Giàu omega-3, vitamin D, sắt<br>✅ Được đánh bắt tự nhiên</p>', 'Còn kinh doanh', 0, '2025-07-08', 4, '500g'),
(64, 'Lốc sữa Ovaltine 110ml', 'sua-ovantin.jpg', 5, '<h3><strong>Lốc Sữa Ovaltine – 110ml x 4 hộp</strong></h3><p>Lốc 4 hộp sữa lúa mạch vị socola Ovaltine bổ sung canxi 110ml&nbsp;với thiết kế hộp giấy cùng ống hút tiện lợi, sử dụng rất dễ dàng và tiện lợi. Sữa lúa mạch Ovaltine&nbsp;bổ sung canxi&nbsp;là dòng sản phẩm&nbsp;sữa lúa mạch&nbsp;chứa gấp đôi canxi so với ly sữa bò tươi 250ml, giúp phát triển xương khớp và chiều cao.</p><p>✅ Bổ sung canxi, sắt, vitamin nhóm B<br>✅ Hương vị cacao thơm ngon, dễ uống<br>✅ Phù hợp cho trẻ em và người lớn cần bổ sung năng lượng nhanh</p><p>&nbsp;</p>', 'Còn kinh doanh', 0, '2025-07-08', 5, '1 lốc'),
(65, 'Lốc sữa lúa mạch Nuvi 170ml', 'sua-nuvi.jpg', 5, '<h3><strong>Lốc Sữa NuVi – 170ml x 4 hộp</strong></h3><p>Sữa NuVi dành cho trẻ nhỏ, bổ sung dưỡng chất thiết yếu như DHA, canxi, lysine giúp phát triển chiều cao, trí não và hệ miễn dịch.</p><p>✅ Giúp phát triển trí não và chiều cao<br>✅ Không chất bảo quản<br>✅ Hương vị thơm ngon, dễ uống</p>', 'Còn kinh doanh', 0, '2025-07-08', 5, '1 lốc'),
(66, 'Lốc sữa lúa mạch Malto 180ml', 'sua-matto.jpg', 5, '<h3><strong>Lốc Sữa Malto – 180ml x 4 hộp</strong></h3><p>Sữa Malto là dòng sữa dinh dưỡng lên men từ đậu nành, giúp tăng cường hệ tiêu hóa và bổ sung protein thực vật.</p><p>✅ Giàu đạm thực vật và canxi<br>✅ Có lợi cho hệ tiêu hóa<br>✅ Ít béo – phù hợp cho người ăn kiêng</p>', 'Còn kinh doanh', 0, '2025-07-08', 5, '1 lốc'),
(67, 'Lốc sữa ngũ cốc dinh dưỡng LOF', 'sua-ngu-coc.jpg', 5, '<h3><strong>Sữa Ngũ Cốc – 180ml</strong></h3><p>Sữa ngũ cốc là sự pha trộn từ sữa và các loại ngũ cốc tự nhiên như yến mạch, gạo lứt, đậu nành,... giúp no lâu và giàu dinh dưỡng.</p><p>✅ Nguồn năng lượng lành mạnh từ ngũ cốc nguyên cám<br>✅ Hỗ trợ tiêu hóa, giữ vóc dáng<br>✅ Phù hợp dùng vào bữa s<strong>Thông tin dinh dưỡng (ước tính / 100ml):</strong><br>&nbsp;</p>', 'Còn kinh doanh', 0, '2025-07-08', 5, '1 lốc'),
(68, 'Kem đặc Vinamilk Tài Lộc lon 3', 'sua-tailoc.jpg', 5, '<h3><strong>Kem Đặc Vinamilk Tài Lộc – Lon 380g</strong></h3><p>Kem đặc Vinamilk Tài Lộc là sản phẩm sữa đặc thơm ngon, béo ngậy được sản xuất từ sữa bò tươi kết hợp với đường tinh luyện, giúp tăng hương vị cho các món ăn và thức uống yêu thích.</p><p>✅ Vị béo ngậy, ngọt dịu – phù hợp pha cà phê, làm bánh, chế biến món tráng miệng<br>✅ Sản phẩm của thương hiệu Vinamilk uy tín, đạt chuẩn an toàn thực phẩm<br>✅ Dễ bảo quản và sử dụng tiện lợi với dạng lon kín</p><p>&nbsp;</p>', 'Còn kinh doanh', 0, '2025-07-08', 5, '380g'),
(69, 'Sữa đặc có đường Ông Thọ Đỏ hộ', 'sua-hop-ongtho.jpg', 15, '<h2><strong>Sữa đặc có đường Ông Thọ Đỏ hộp 40g</strong></h2><p>Sữa đặc&nbsp;Ông Thọ với vị thơm ngon, sánh đặc, là bí quyết giúp mẹ có những món ăn ngon, chăm sóc cho cả gia đình.&nbsp;Sữa đặc có đường Ông Thọ đỏ hộp 40g vị béo ngọt, đậm đà mà ai cũng thích. Sữa đặc&nbsp;dùng chấm bánh mì, pha cà phê đều được, hộp nhỏ gọn vô cùng.</p><p><strong>Hướng dẫn sử dụng:&nbsp;</strong><br>Dùng để pha uống, làm sinh tố, bánh ngọt, đồ tráng miệng hoặc chấm với bánh mì.&nbsp;<br><strong>Bảo quản:&nbsp;</strong></p><ul><li>Đậy kín nắp sau khi khui.</li><li>Bảo quản lạnh sau khi mở nắp, nên sử dụng hết trong vòng 3 ngày.</li><li>Để nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp.</li></ul>', 'Còn kinh doanh', 0, '2025-07-08', 5, '40g'),
(70, 'Sữa đặc có đường Ông Thọ Trắng', 'sua-ongtho-xanh.jpg', 15, '', 'Còn kinh doanh', 0, '2025-07-08', 5, '1 hộp'),
(71, 'Kem đặc có đường Dutch Lady xa', 'kem-dac.jpg', 15, '<h4><strong>Kem đặc có đường Dutch Lady xanh biển túi 280g</strong></h4><p>Kem đặc có đường Dutch Lady Xanh biển túi 280g&nbsp;với dạng túi dễ mở, dễ chiết rót và dễ dàng bảo quản.&nbsp;Sữa đặc&nbsp;Dutch Lady dùng uống cà phê, chấm bánh mì,...&nbsp;sữa đặc&nbsp;Dutch Lady chứa nhiều vitamin B2, B12, canxi, đạm mang đến hương vị hài hòa cho các món ăn, thức uống hằng ngày.</p>', 'Còn kinh doanh', 0, '2025-07-08', 5, '280g');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `TK_ID` int(11) NOT NULL,
  `TK_TENDANGNHAP` varchar(15) NOT NULL,
  `TK_MK` char(8) NOT NULL,
  `TK_VAITRO` int(11) NOT NULL,
  `TK_TRANGTHAI` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`TK_ID`, `TK_TENDANGNHAP`, `TK_MK`, `TK_VAITRO`, `TK_TRANGTHAI`) VALUES
(1, 'hoangnam', 'nam12345', 0, 'Còn hoạt động'),
(2, 'giahan', 'han12345', 1, 'Còn hoạt động'),
(3, 'hiếu', 'hieu1234', 1, 'Còn hoạt động'),
(4, 'admin', 'admin123', 2, 'Còn hoạt động'),
(5, 'hoanthien', 'thien123', 0, 'Còn hoạt động'),
(7, 'duy', 'duy12345', 1, 'Còn hoạt động'),
(8, 'Bao', 'bao12345', 1, 'Còn hoạt động');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `the_trang`
--

CREATE TABLE `the_trang` (
  `TTRANG_MA` int(11) NOT NULL,
  `TTRANG_TEN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `the_trang`
--

INSERT INTO `the_trang` (`TTRANG_MA`, `TTRANG_TEN`) VALUES
(1, 'Cao huyết áp'),
(2, 'Béo phì'),
(3, 'Mỡ máu cao'),
(4, 'Người tiểu đường'),
(5, 'Người suy dinh dưỡng'),
(6, 'Phụ nữ mang thai'),
(7, 'Trẻ em'),
(8, 'Người già'),
(9, 'Người mắc bệnh tim'),
(10, 'Người có bệnh thận'),
(11, 'Người giảm cân');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh_thanhpho`
--

CREATE TABLE `tinh_thanhpho` (
  `TP_ID` int(11) NOT NULL,
  `TP_TENTINHTP` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tinh_thanhpho`
--

INSERT INTO `tinh_thanhpho` (`TP_ID`, `TP_TENTINHTP`) VALUES
(1, 'TP HCM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai`
--

CREATE TABLE `trang_thai` (
  `TT_MATT` int(11) NOT NULL,
  `TT_TENTT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `trang_thai`
--

INSERT INTO `trang_thai` (`TT_MATT`, `TT_TENTT`) VALUES
(1, 'Chờ xét duyệt'),
(2, 'Đang chuẩn bị hàng'),
(3, 'Đang giao'),
(4, 'Giao thành công'),
(5, 'Đã hủy');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bo_phan`
--
ALTER TABLE `bo_phan`
  ADD PRIMARY KEY (`BP_MABP`),
  ADD UNIQUE KEY `BO_PHAN_PK` (`BP_MABP`);

--
-- Chỉ mục cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD PRIMARY KEY (`DH_MADH`,`SP_MASP`),
  ADD KEY `CT_DH_FK` (`DH_MADH`),
  ADD KEY `CT_SP_FK` (`SP_MASP`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD PRIMARY KEY (`GH_ID`,`SP_MASP`),
  ADD KEY `CTGH_GH_FK` (`GH_ID`),
  ADD KEY `CTGH_SP_FK` (`SP_MASP`);

--
-- Chỉ mục cho bảng `danhgia_sanpham`
--
ALTER TABLE `danhgia_sanpham`
  ADD PRIMARY KEY (`DGSP_ID`),
  ADD UNIQUE KEY `DANHGIA_SANPHAM_PK` (`DGSP_ID`),
  ADD UNIQUE KEY `unique_rating` (`DH_MADH`,`SP_MASP`),
  ADD KEY `DG_CTDH_FK` (`DH_MADH`,`SP_MASP`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`DM_MADM`),
  ADD UNIQUE KEY `DANH_MUC_PK` (`DM_MADM`);

--
-- Chỉ mục cho bảng `dinh_duong`
--
ALTER TABLE `dinh_duong`
  ADD PRIMARY KEY (`DD_MADD`),
  ADD KEY `SP_MASP` (`SP_MASP`);

--
-- Chỉ mục cho bảng `don_gia`
--
ALTER TABLE `don_gia`
  ADD PRIMARY KEY (`DG_ID`),
  ADD UNIQUE KEY `DON_GIA_PK` (`DG_ID`),
  ADD KEY `SP_CO_DG_FK` (`SP_MASP`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`DH_MADH`),
  ADD UNIQUE KEY `DON_HANG_PK` (`DH_MADH`),
  ADD KEY `KH_CO_DH_FK` (`KH_ID`),
  ADD KEY `DH_CO_PTTT_FK` (`PTTT_ID`),
  ADD KEY `CHIU_TRACH_NHIEM_FK` (`NV_ID`),
  ADD KEY `GH_CUA_DH_FK` (`GH_ID`),
  ADD KEY `fk_donhang_phuongxa` (`P_ID`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`GH_ID`),
  ADD UNIQUE KEY `GIO_HANG_PK` (`GH_ID`),
  ADD KEY `CUA_KHACH_HANG_FK` (`KH_ID`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`KH_ID`),
  ADD UNIQUE KEY `KHACH_HANG_PK` (`KH_ID`),
  ADD KEY `KH_CO_TK_FK` (`TK_ID`);

--
-- Chỉ mục cho bảng `khu_vuc`
--
ALTER TABLE `khu_vuc`
  ADD PRIMARY KEY (`KV_MAKV`),
  ADD UNIQUE KEY `KHU_VUC_PK` (`KV_MAKV`),
  ADD KEY `PHU_TRACH_FK` (`NV_ID`),
  ADD KEY `fk_khuvuc_phuongxa` (`P_ID`);

--
-- Chỉ mục cho bảng `lich_su_don_hang`
--
ALTER TABLE `lich_su_don_hang`
  ADD PRIMARY KEY (`LSDH_ID`),
  ADD KEY `TT_LSDH_FK` (`TT_MATT`),
  ADD KEY `LSDH_DH_FK` (`DH_MADH`);

--
-- Chỉ mục cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`NV_ID`),
  ADD UNIQUE KEY `NHAN_VIEN_PK` (`NV_ID`),
  ADD KEY `NV_THUOC_BP_FK` (`BP_MABP`),
  ADD KEY `fk_nhanvien_taikhoan` (`TK_ID`);

--
-- Chỉ mục cho bảng `phuhop`
--
ALTER TABLE `phuhop`
  ADD PRIMARY KEY (`SP_MASP`,`TTRANG_MA`),
  ADD KEY `TTRANG_MA` (`TTRANG_MA`);

--
-- Chỉ mục cho bảng `phuongthuc_thanhtoan`
--
ALTER TABLE `phuongthuc_thanhtoan`
  ADD PRIMARY KEY (`PTTT_ID`),
  ADD UNIQUE KEY `PHUONGTHUC_THANHTOAN_PK` (`PTTT_ID`);

--
-- Chỉ mục cho bảng `phuong_xa`
--
ALTER TABLE `phuong_xa`
  ADD PRIMARY KEY (`P_ID`),
  ADD UNIQUE KEY `PHUONG_XA_PK` (`P_ID`),
  ADD KEY `fk_phuong_tp` (`TP_ID`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`SP_MASP`),
  ADD KEY `fk_sanpham_danhmuc` (`DM_MADM`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`TK_ID`);

--
-- Chỉ mục cho bảng `the_trang`
--
ALTER TABLE `the_trang`
  ADD PRIMARY KEY (`TTRANG_MA`);

--
-- Chỉ mục cho bảng `tinh_thanhpho`
--
ALTER TABLE `tinh_thanhpho`
  ADD PRIMARY KEY (`TP_ID`);

--
-- Chỉ mục cho bảng `trang_thai`
--
ALTER TABLE `trang_thai`
  ADD PRIMARY KEY (`TT_MATT`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bo_phan`
--
ALTER TABLE `bo_phan`
  MODIFY `BP_MABP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `danhgia_sanpham`
--
ALTER TABLE `danhgia_sanpham`
  MODIFY `DGSP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `DM_MADM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `dinh_duong`
--
ALTER TABLE `dinh_duong`
  MODIFY `DD_MADD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `don_gia`
--
ALTER TABLE `don_gia`
  MODIFY `DG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `DH_MADH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `GH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `KH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `khu_vuc`
--
ALTER TABLE `khu_vuc`
  MODIFY `KV_MAKV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `lich_su_don_hang`
--
ALTER TABLE `lich_su_don_hang`
  MODIFY `LSDH_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  MODIFY `NV_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `phuongthuc_thanhtoan`
--
ALTER TABLE `phuongthuc_thanhtoan`
  MODIFY `PTTT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `phuong_xa`
--
ALTER TABLE `phuong_xa`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `SP_MASP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `TK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `the_trang`
--
ALTER TABLE `the_trang`
  MODIFY `TTRANG_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tinh_thanhpho`
--
ALTER TABLE `tinh_thanhpho`
  MODIFY `TP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `trang_thai`
--
ALTER TABLE `trang_thai`
  MODIFY `TT_MATT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD CONSTRAINT `chitiet_donhang_ibfk_1` FOREIGN KEY (`SP_MASP`) REFERENCES `san_pham` (`SP_MASP`),
  ADD CONSTRAINT `chitiet_donhang_ibfk_2` FOREIGN KEY (`DH_MADH`) REFERENCES `don_hang` (`DH_MADH`);

--
-- Các ràng buộc cho bảng `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD CONSTRAINT `chi_tiet_gio_hang_ibfk_1` FOREIGN KEY (`SP_MASP`) REFERENCES `san_pham` (`SP_MASP`),
  ADD CONSTRAINT `chi_tiet_gio_hang_ibfk_2` FOREIGN KEY (`GH_ID`) REFERENCES `gio_hang` (`GH_ID`);

--
-- Các ràng buộc cho bảng `danhgia_sanpham`
--
ALTER TABLE `danhgia_sanpham`
  ADD CONSTRAINT `danhgia_sanpham_ibfk_1` FOREIGN KEY (`DH_MADH`) REFERENCES `don_hang` (`DH_MADH`);

--
-- Các ràng buộc cho bảng `dinh_duong`
--
ALTER TABLE `dinh_duong`
  ADD CONSTRAINT `dinh_duong_ibfk_1` FOREIGN KEY (`SP_MASP`) REFERENCES `san_pham` (`SP_MASP`);

--
-- Các ràng buộc cho bảng `don_gia`
--
ALTER TABLE `don_gia`
  ADD CONSTRAINT `don_gia_ibfk_1` FOREIGN KEY (`SP_MASP`) REFERENCES `san_pham` (`SP_MASP`);

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`NV_ID`) REFERENCES `nhan_vien` (`NV_ID`),
  ADD CONSTRAINT `don_hang_ibfk_2` FOREIGN KEY (`KH_ID`) REFERENCES `khach_hang` (`KH_ID`),
  ADD CONSTRAINT `don_hang_ibfk_4` FOREIGN KEY (`PTTT_ID`) REFERENCES `phuongthuc_thanhtoan` (`PTTT_ID`),
  ADD CONSTRAINT `don_hang_ibfk_5` FOREIGN KEY (`GH_ID`) REFERENCES `gio_hang` (`GH_ID`),
  ADD CONSTRAINT `fk_donhang_phuongxa` FOREIGN KEY (`P_ID`) REFERENCES `phuong_xa` (`P_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`KH_ID`) REFERENCES `khach_hang` (`KH_ID`);

--
-- Các ràng buộc cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD CONSTRAINT `khach_hang_ibfk_1` FOREIGN KEY (`TK_ID`) REFERENCES `tai_khoan` (`TK_ID`);

--
-- Các ràng buộc cho bảng `khu_vuc`
--
ALTER TABLE `khu_vuc`
  ADD CONSTRAINT `fk_khuvuc_phuongxa` FOREIGN KEY (`P_ID`) REFERENCES `phuong_xa` (`P_ID`),
  ADD CONSTRAINT `khu_vuc_ibfk_1` FOREIGN KEY (`NV_ID`) REFERENCES `nhan_vien` (`NV_ID`);

--
-- Các ràng buộc cho bảng `lich_su_don_hang`
--
ALTER TABLE `lich_su_don_hang`
  ADD CONSTRAINT `lich_su_don_hang_ibfk_1` FOREIGN KEY (`TT_MATT`) REFERENCES `trang_thai` (`TT_MATT`),
  ADD CONSTRAINT `lich_su_don_hang_ibfk_2` FOREIGN KEY (`DH_MADH`) REFERENCES `don_hang` (`DH_MADH`);

--
-- Các ràng buộc cho bảng `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `fk_nhanvien_taikhoan` FOREIGN KEY (`TK_ID`) REFERENCES `tai_khoan` (`TK_ID`),
  ADD CONSTRAINT `nhan_vien_ibfk_1` FOREIGN KEY (`BP_MABP`) REFERENCES `bo_phan` (`BP_MABP`);

--
-- Các ràng buộc cho bảng `phuhop`
--
ALTER TABLE `phuhop`
  ADD CONSTRAINT `phuhop_ibfk_1` FOREIGN KEY (`SP_MASP`) REFERENCES `san_pham` (`SP_MASP`),
  ADD CONSTRAINT `phuhop_ibfk_2` FOREIGN KEY (`TTRANG_MA`) REFERENCES `the_trang` (`TTRANG_MA`);

--
-- Các ràng buộc cho bảng `phuong_xa`
--
ALTER TABLE `phuong_xa`
  ADD CONSTRAINT `fk_phuong_tp` FOREIGN KEY (`TP_ID`) REFERENCES `tinh_thanhpho` (`TP_ID`);

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`DM_MADM`) REFERENCES `danh_muc` (`DM_MADM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

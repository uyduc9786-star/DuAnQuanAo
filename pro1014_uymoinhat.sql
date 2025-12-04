-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 01, 2025 lúc 11:15 AM
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
-- Cơ sở dữ liệu: `pro1014_uy`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `ho_ten` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `ho_ten`) VALUES
(1, 'admin', '123456', 'Quản Trị Viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
--

CREATE TABLE `binh_luan` (
  `id_binhluan` int(11) NOT NULL,
  `id_taikhoan` int(11) DEFAULT NULL,
  `noi_dung` text DEFAULT NULL,
  `ngay_tao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `id_cthd` int(11) NOT NULL,
  `id_hoadon` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `mau` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_hoa_don`
--

INSERT INTO `chi_tiet_hoa_don` (`id_cthd`, `id_hoadon`, `id_sanpham`, `gia`, `so_luong`, `mau`, `size`) VALUES
(1, 1, 1, 350000.00, 1, 'Đen', 'L'),
(2, 2, 1, 350000.00, 1, 'Trắng', 'M'),
(3, 2, 2, 350000.00, 1, 'Xanh', 'XL'),
(4, 3, 2, 150000.00, 1, 'Đỏ', 'S'),
(5, 4, 1, 250000.00, 2, 'Vàng', 'M'),
(6, 5, 1, 300000.00, 4, 'Đen', 'XXL'),
(7, 6, 2, 250000.00, 1, 'Hồng', 'S'),
(8, 7, 1, 300000.00, 3, 'Xám', 'L'),
(9, 8, 2, 450000.00, 1, 'Xanh rêu', 'M'),
(10, 9, 1, 300000.00, 2, 'Nâu', 'L'),
(11, 10, 1, 1500000.00, 1, 'Đen', 'L'),
(12, 10, 2, 1500000.00, 1, 'Trắng', 'L');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `id_danh_muc` int(10) NOT NULL,
  `name_danh_muc` varchar(255) NOT NULL,
  `Trangthai` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`id_danh_muc`, `name_danh_muc`, `Trangthai`) VALUES
(1, 'Quan dui2', 0),
(2, 'Ao khoac', 1),
(3, 'Thông ăn cứt', 0),
(5, 'Giày dép', 1),
(8, 'Giày to', 0),
(9, 'Máy chạy bộ', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id_giohang` int(11) NOT NULL,
  `id_sp` int(11) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `id_taikhoan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `id_hoadon` int(11) NOT NULL,
  `id_khachhang` int(11) DEFAULT NULL,
  `hinh_thuc_thanh_toan` varchar(50) DEFAULT NULL,
  `trang_thai` varchar(20) DEFAULT NULL,
  `tongtien` decimal(10,2) DEFAULT NULL,
  `ho_ten` varchar(100) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`id_hoadon`, `id_khachhang`, `hinh_thuc_thanh_toan`, `trang_thai`, `tongtien`, `ho_ten`, `dia_chi`, `sdt`) VALUES
(1, 1, 'Tiền mặt (COD)', 'Mới', 350000.00, 'Nguyễn Văn An', '123 Cầu Giấy, Hà Nội', '0901234567'),
(2, 2, 'Chuyển khoản', 'Đang giao hàng', 700000.00, 'Trần Thị Bích', '45 Lê Lợi, Q1, HCM', '0912345678'),
(3, 1, 'Tiền mặt (COD)', 'Hoàn tất', 150000.00, 'Lê Văn Cường', 'Số 5 Ngõ 10, Đống Đa, HN', '0987654321'),
(4, 3, 'Chuyển khoản', 'Đã hủy', 500000.00, 'Phạm Thu Hương', '88 Trần Hưng Đạo, Đà Nẵng', '0977889900'),
(5, 4, 'Tiền mặt (COD)', 'Mới', 1200000.00, 'Hoàng Văn Dũng', 'Khu CN VSIP, Bình Dương', '0966554433'),
(6, 2, 'Chuyển khoản', 'Đang giao hàng', 250000.00, 'Vũ Thị Lan', 'Chung cư EcoHome, Hà Nội', '0911223344'),
(7, 5, 'Tiền mặt (COD)', 'Đã giao', 900000.00, 'Đỗ Minh Tuấn', 'Thành phố Thủ Đức, HCM', '0933445566'),
(8, 1, 'Chuyển khoản', 'Hoàn tất', 450000.00, 'Ngô Kiến Huy', 'Phố Huế, Hai Bà Trưng, HN', '0944556677'),
(9, 3, 'Tiền mặt (COD)', 'Đang giao hàng', 600000.00, 'Bùi Anh Tuấn', 'Đà Lạt, Lâm Đồng', '0955667788'),
(10, 2, 'Chuyển khoản', 'Đã hủy', 3000000.00, 'Sơn Tùng MTP', 'Thái Bình', '0999888777');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id_khachhang` int(11) NOT NULL,
  `ho_ten` varchar(100) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khach_hang`
--

INSERT INTO `khach_hang` (`id_khachhang`, `ho_ten`, `ngay_sinh`, `email`, `sdt`, `dia_chi`, `hinh_anh`) VALUES
(1, 'Nguyễn Văn An', '1990-05-10', 'an@gmail.com', '0901234567', '123 Cầu Giấy, Hà Nội', 'user.png'),
(2, 'Trần Thị Bích', '1995-08-20', 'bich@gmail.com', '0912345678', '45 Lê Lợi, Q1, HCM', 'user.png'),
(3, 'Phạm Thu Hương', '1998-12-12', 'huong@gmail.com', '0977889900', '88 Trần Hưng Đạo, Đà Nẵng', 'user.png'),
(4, 'Hoàng Văn Dũng', '1988-03-25', 'dung@gmail.com', '0966554433', 'Khu CN VSIP, Bình Dương', 'user.png'),
(5, 'Đỗ Minh Tuấn', '2000-11-05', 'tuan@gmail.com', '0933445566', 'Thành phố Thủ Đức, HCM', 'user.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho_anh`
--

CREATE TABLE `kho_anh` (
  `id_hinhanh` int(11) NOT NULL,
  `id_sp` int(11) DEFAULT NULL,
  `ten_hinhanh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kich_co`
--

CREATE TABLE `kich_co` (
  `id_kichco` int(11) NOT NULL,
  `loai_kich_co` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kich_co`
--

INSERT INTO `kich_co` (`id_kichco`, `loai_kich_co`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(500, 'Size Test Cũ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mau_sac`
--

CREATE TABLE `mau_sac` (
  `id_mausac` int(11) NOT NULL,
  `ten_mau` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mau_sac`
--

INSERT INTO `mau_sac` (`id_mausac`, `ten_mau`) VALUES
(1, 'Đỏ'),
(2, 'Xanh'),
(3, 'Đen'),
(212, 'Màu Test Cũ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id_sp` int(11) NOT NULL,
  `id_mau_sac` int(11) DEFAULT NULL,
  `id_kich_co` int(11) DEFAULT NULL,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `ten_sp` varchar(100) DEFAULT NULL,
  `gia_sp` decimal(10,2) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `loai` varchar(50) DEFAULT NULL,
  `id_danh_muc` int(11) DEFAULT NULL,
  `Mo_ta` text NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id_sp`, `id_mau_sac`, `id_kich_co`, `hinh_anh`, `ten_sp`, `gia_sp`, `so_luong`, `loai`, `id_danh_muc`, `Mo_ta`, `trang_thai`) VALUES
(1, 212, 500, 'anh1.png', 'Ao', 18000.00, 3, 'Dat', 1, 'Chat lieu cotton', 0),
(2, 2, 1, '692d45a61f447_anhmaytinh6675.jpg', 'Áo khoác mùa đông', 3000000.00, 10, 'Hot', 2, 'Sản phẩm tốt cực kì', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id_taikhoan` int(11) NOT NULL,
  `id_khachhang` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `matkhau` varchar(100) DEFAULT NULL,
  `ten` varchar(50) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `Field` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`id_binhluan`),
  ADD KEY `id_taikhoan` (`id_taikhoan`);

--
-- Chỉ mục cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`id_cthd`),
  ADD KEY `id_hoadon` (`id_hoadon`),
  ADD KEY `id_sanpham` (`id_sanpham`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`id_danh_muc`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id_giohang`),
  ADD KEY `id_sp` (`id_sp`),
  ADD KEY `id_taikhoan` (`id_taikhoan`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id_hoadon`),
  ADD KEY `id_khachhang` (`id_khachhang`);

--
-- Chỉ mục cho bảng `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id_khachhang`);

--
-- Chỉ mục cho bảng `kho_anh`
--
ALTER TABLE `kho_anh`
  ADD PRIMARY KEY (`id_hinhanh`),
  ADD KEY `id_sp` (`id_sp`);

--
-- Chỉ mục cho bảng `kich_co`
--
ALTER TABLE `kich_co`
  ADD PRIMARY KEY (`id_kichco`);

--
-- Chỉ mục cho bảng `mau_sac`
--
ALTER TABLE `mau_sac`
  ADD PRIMARY KEY (`id_mausac`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_sp`),
  ADD KEY `fk_sanpham_danhmuc` (`id_danh_muc`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id_taikhoan`),
  ADD KEY `id_khachhang` (`id_khachhang`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `id_danh_muc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_ibfk_1` FOREIGN KEY (`id_taikhoan`) REFERENCES `taikhoan` (`id_taikhoan`);

--
-- Các ràng buộc cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD CONSTRAINT `chi_tiet_hoa_don_ibfk_1` FOREIGN KEY (`id_hoadon`) REFERENCES `hoadon` (`id_hoadon`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_hoa_don_ibfk_2` FOREIGN KEY (`id_sanpham`) REFERENCES `san_pham` (`id_sp`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`id_sp`) REFERENCES `san_pham` (`id_sp`),
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`id_taikhoan`) REFERENCES `taikhoan` (`id_taikhoan`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`id_khachhang`) REFERENCES `khach_hang` (`id_khachhang`);

--
-- Các ràng buộc cho bảng `kho_anh`
--
ALTER TABLE `kho_anh`
  ADD CONSTRAINT `kho_anh_ibfk_1` FOREIGN KEY (`id_sp`) REFERENCES `san_pham` (`id_sp`);

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_muc` (`id_danh_muc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`id_khachhang`) REFERENCES `khach_hang` (`id_khachhang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

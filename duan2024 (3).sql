-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 18, 2025 lúc 05:36 AM
-- Phiên bản máy phục vụ: 8.3.0
-- Phiên bản PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan2024`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

DROP TABLE IF EXISTS `binhluan`;
CREATE TABLE IF NOT EXISTS `binhluan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noidung` varchar(255) NOT NULL,
  `iduser` int NOT NULL,
  `idpro` int NOT NULL,
  `ngaybinhluan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

DROP TABLE IF EXISTS `chitiethoadon`;
CREATE TABLE IF NOT EXISTS `chitiethoadon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_hoadon` int NOT NULL,
  `id_sanpham` int NOT NULL,
  `soluong` int NOT NULL,
  `gia` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`id`, `id_hoadon`, `id_sanpham`, `soluong`, `gia`) VALUES
(1, 3, 32, 5, 2000),
(2, 3, 34, 6, 20001),
(3, 3, 33, 3, 2000),
(4, 3, 26, 2, 11111),
(5, 3, 29, 1, 2000),
(6, 4, 32, 5, 2000),
(7, 4, 34, 6, 20001),
(8, 4, 33, 3, 2000),
(9, 4, 26, 2, 11111),
(10, 4, 29, 1, 2000),
(11, 4, 27, 1, 170000),
(12, 5, 32, 5, 2000),
(13, 5, 34, 6, 20001),
(14, 5, 33, 3, 2000),
(15, 5, 26, 2, 11111),
(16, 5, 29, 1, 2000),
(17, 5, 27, 1, 170000),
(18, 5, 31, 1, 2000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

DROP TABLE IF EXISTS `danhmuc`;
CREATE TABLE IF NOT EXISTS `danhmuc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `name`, `deleted`) VALUES
(25, 'Túi sách', 0),
(26, 'Va li đã sửa', 0),
(27, 'Điện thoại', 0),
(28, 'Máy tính để bàn', 0),
(29, 'Đông hồ', 0),
(30, 'Điện thoại', 0),
(31, 'Túi ', 0),
(32, 'Túi  2', 0),
(33, 'Túi 3', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

DROP TABLE IF EXISTS `hoadon`;
CREATE TABLE IF NOT EXISTS `hoadon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tenkhachhang` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdt` varchar(12) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ngaygiodat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tongtien` int NOT NULL,
  `pttt` int NOT NULL,
  `trangthai` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`id`, `tenkhachhang`, `diachi`, `sdt`, `ngaygiodat`, `tongtien`, `pttt`, `trangthai`) VALUES
(3, 'Chiến', 'HP', '123123123', '2024-08-09 11:09:51', 160228, 0, 1),
(4, 'Lượng', 'HP', '0123345655', '2024-08-05 11:11:44', 330228, 1, 1),
(5, 'Hoàng', 'HP', '0123123', '2024-08-05 11:12:22', 332228, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

DROP TABLE IF EXISTS `nguoidung`;
CREATE TABLE IF NOT EXISTS `nguoidung` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `role` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`id`, `user`, `pass`, `email`, `address`, `tel`, `role`) VALUES
(1, 'Nam', '123', 'chiennmpp03120@gmail.com', 'Hai Duong', '0377153845', 0),
(2, 'admin', '321', 'admin@gmail.com', 'Hai Phong', '03939393933', 1),
(7, 'tuan', '123', 'tuan123@gmail.com', 'Hai Phong', '0377253890', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE IF NOT EXISTS `sanpham` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `mota` varchar(255) DEFAULT NULL,
  `luotxem` int NOT NULL,
  `iddm` int NOT NULL,
  `deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lk_sanpham_danhmuc` (`iddm`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `price`, `img`, `mota`, `luotxem`, `iddm`, `deleted`) VALUES
(25, 'giay khen 3', 2000, 'image/691b02f874d7b_', 'mmmmm', 0, 29, 0),
(26, 'Yen2', 11111, 'image/691b01ab3a6e0_', 'xinh', 0, 30, 0),
(27, 'Bongmizz', 170000, 'OIP.jpg', 'tt', 0, 27, 0),
(28, 'Dong ho', 2000, 'dong ho2.jpg', 'rrr', 0, 26, 0),
(29, 'Giay da', 2000, 'Screenshot 2024-07-24 133807.png', 'sds', 0, 30, 0),
(31, 'Giay 7 mau', 2000, 'Screenshot 2024-07-24 133856.png', 'asa', 0, 27, 0),
(32, 'Dong ho', 2000, 'image/691c03af4483d_0d147c411a8ce284e733b4db4294712a.jpg', 'ewqew', 0, 25, 0),
(33, 'Dong ho', 2000, 'Screenshot 2024-07-24 133944.png', '', 0, 25, 0),
(34, 'Dong ho', 20001, 'Screenshot 2024-07-24 133910.png', '', 0, 26, 0),
(35, 'Túi hơ mẹc 3', 2000000000, 'image/691c03a28cde6_9a2dc442-9020-4f3f-84e6-757c91213fed.png', 'Túi rất đẹp. ÔKe', 0, 25, 0);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `lk_sanpham_danhmuc` FOREIGN KEY (`iddm`) REFERENCES `danhmuc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

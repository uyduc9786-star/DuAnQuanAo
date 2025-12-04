-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 04, 2025 lúc 06:19 AM
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
  `trang_thai` tinyint(4) NOT NULL DEFAULT 0,
  `luot_xem` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id_sp`, `id_mau_sac`, `id_kich_co`, `hinh_anh`, `ten_sp`, `gia_sp`, `so_luong`, `loai`, `id_danh_muc`, `Mo_ta`, `trang_thai`, `luot_xem`) VALUES
(1, 212, 500, 'anh1.png', 'Ao', 18000.00, 3, 'Dat', 1, 'Chat lieu cotton', 1, 0),
(2, 2, 1, '692d45a61f447_anhmaytinh6675.jpg', 'Áo khoác mùa đông', 3000000.00, 10, 'Hot', 2, 'Sản phẩm tốt cực kì', 1, 0),
(3, 1, 1, '692fddf562a6a_54034716996_f05587c93a_c_59eb19b7070844199078bad134ac2b18_master.jpg', 'Áo khoác gió', 720000.00, 1000, 'Hot', 9, 'Sản phẩm thiết kế bền bỉ đẹp', 0, 0),
(4, 1, 1, 'quan_au_01.jpg', 'Quần Âu Nam Slimfit', 350000.00, 100, 'Hot', 1, 'Chất liệu vải tuyết mưa cao cấp, không nhăn, giữ form chuẩn.', 1, 50),
(5, 1, 1, '692ffa36b5458_quan-tay-5.jpg', 'Quần Tây Công Sở Đen', 450000.00, 80, 'New', 1, 'Thiết kế sang trọng, lịch lãm, phù hợp môi trường công sở.', 1, 120),
(6, 1, 1, 'quan_au_03.jpg', 'Quần Âu Hàn Quốc Ghi', 320000.00, 150, 'Sale', 1, 'Phong cách trẻ trung, ống côn vừa vặn, dễ phối đồ.', 1, 30),
(7, 1, 1, 'quan_au_04.jpg', 'Quần Âu Co Giãn Nhẹ', 380000.00, 90, 'Hot', 1, 'Vải co giãn 4 chiều, thoải mái vận động cả ngày dài.', 1, 45),
(8, 1, 1, '692ff989b395c_dang-quan-au-ong-com_ec64b335ed9c487b87dace1f62fe5fe5.jpg', 'Quần Tây Ống Đứng', 400000.00, 60, 'New', 1, 'Form ống đứng cổ điển, che khuyết điểm chân tốt.', 1, 10),
(9, 1, 1, 'quan_au_06.jpg', 'Quần Âu Chinos Be', 360000.00, 110, 'Sale', 1, 'Màu be thời thượng, chất vải dày dặn, đứng form.', 1, 75),
(10, 1, 1, 'quan_au_07.jpg', 'Quần Âu Kẻ Caro', 420000.00, 70, 'Hot', 1, 'Họa tiết kẻ caro tinh tế, tạo điểm nhấn nổi bật.', 1, 88),
(11, 1, 1, 'quan_au_08.jpg', 'Quần Tây Lưng Cao', 480000.00, 50, 'New', 1, 'Hack dáng cực đỉnh, giúp chân trông dài hơn.', 1, 92),
(12, 1, 1, '692ffa01994c1_mf6630_3bc47c85fbea47a8aa340e1a376f95bf.jpg', 'Quần Âu Xám Chuột', 340000.00, 130, 'Sale', 1, 'Màu xám nam tính, dễ dàng phối với sơ mi trắng.', 1, 20),
(13, 1, 1, 'quan_au_10.jpg', 'Quần Âu Vải Wool', 550000.00, 40, 'Hot', 1, 'Chất liệu pha len cao cấp, mềm mại và ấm áp.', 1, 150),
(14, 1, 1, 'ao_len_01.jpg', 'Áo Len Cổ Lọ Basic', 250000.00, 200, 'Hot', 2, 'Giữ ấm cực tốt, thiết kế cổ lọ cổ điển không lỗi mốt.', 1, 60),
(15, 1, 1, '692ff8cf4ae80_b48f4a02858b2dc8d6bd882c3c37a24d.jpg', 'Áo Len Thừng Vặn', 320000.00, 100, 'New', 2, 'Họa tiết vặn thừng dày dặn, phong cách vintage.', 1, 40),
(16, 1, 1, 'ao_len_03.jpg', 'Áo Len Cổ Tim Mỏng', 180000.00, 150, 'Sale', 2, 'Chất len mỏng nhẹ, phù hợp tiết trời se lạnh mùa thu.', 1, 90),
(17, 1, 1, 'ao_len_04.jpg', 'Áo Len Oversize', 290000.00, 120, 'Hot', 2, 'Form rộng thoải mái, phong cách Hàn Quốc năng động.', 1, 110),
(18, 1, 1, 'ao_len_05.jpg', 'Áo Len Gile Trơn', 220000.00, 80, 'New', 2, 'Dễ dàng layer cùng áo sơ mi hoặc áo thun.', 1, 35),
(19, 1, 1, '692ffadfc0dcc_vn-11134207-7r98o-m09o66n5lfnz11.jpg', 'Áo Len Lông Cừu', 450000.00, 50, 'Sale', 2, 'Siêu mềm mịn, không gây ngứa, giữ nhiệt hiệu quả.', 1, 15),
(20, 1, 1, 'ao_len_07.jpg', 'Áo Len Cardigan', 350000.00, 90, 'Hot', 2, 'Khoác nhẹ nhàng, thanh lịch cho các chàng trai.', 1, 70),
(21, 1, 1, 'ao_len_08.jpg', 'Áo Len Kẻ Ngang', 270000.00, 110, 'New', 2, 'Họa tiết kẻ ngang trẻ trung, hack dáng người gầy.', 1, 55),
(22, 1, 1, '692ff93611538_sg-11134201-22100-dedn4sxg3vivf1.jpg', 'Áo Len Cổ Tròn Dày', 300000.00, 100, 'Sale', 2, 'Cổ tròn basic, bo tay và gấu áo gọn gàng.', 1, 25),
(23, 1, 1, 'ao_len_10.jpg', 'Áo Len Họa Tiết Bắc Âu', 380000.00, 60, 'Hot', 2, 'Họa tiết nổi bật, phù hợp cho dịp lễ hội cuối năm.', 1, 85),
(24, 1, 1, 'ao_thun_01.jpg', 'Áo Thun Trơn Cotton', 150000.00, 300, 'Hot', 3, '100% Cotton thấm hút mồ hôi, thoáng mát.', 1, 200),
(25, 1, 1, 'ao_thun_02.jpg', 'Áo Thun In Hình Gấu', 180000.00, 200, 'New', 3, 'Hình in sắc nét, công nghệ in decal chuyển nhiệt bền màu.', 1, 150),
(26, 1, 1, 'ao_thun_03.jpg', 'Áo Thun Raglan', 160000.00, 180, 'Sale', 3, 'Phối màu tay áo độc đáo, phong cách thể thao.', 1, 80),
(27, 1, 1, 'ao_thun_04.jpg', 'Áo Thun Cổ V', 140000.00, 250, 'Hot', 3, 'Thiết kế cổ tim quyến rũ, khoe xương quai xanh.', 1, 95),
(28, 1, 1, 'ao_thun_05.jpg', 'Áo Thun Dài Tay', 190000.00, 120, 'New', 3, 'Thích hợp mặc lót hoặc mặc vào ngày trời mát.', 1, 60),
(29, 1, 1, 'ao_thun_06.jpg', 'Áo Thun Unisex', 200000.00, 150, 'Sale', 3, 'Form rộng phù hợp cho cả nam và nữ.', 1, 110),
(30, 1, 1, '692ffb0a30afb_vn-11134207-7r98o-lmqaum1188gvc9.jpg', 'Áo Thun Kẻ Sọc', 170000.00, 200, 'Hot', 3, 'Kẻ sọc ngang nhỏ, tạo cảm giác đầy đặn hơn.', 1, 130),
(31, 1, 1, 'ao_thun_08.jpg', 'Áo Thun Wash Loang', 220000.00, 90, 'New', 3, 'Màu wash loang bụi bặm, cá tính đường phố.', 1, 45),
(32, 1, 1, 'ao_thun_09.jpg', 'Áo Thun Local Brand', 250000.00, 100, 'Sale', 3, 'Thiết kế độc quyền, chất liệu vải dày dặn.', 1, 180),
(33, 1, 1, 'ao_thun_10.jpg', 'Áo Thun Lạnh', 130000.00, 300, 'Hot', 3, 'Vải thun lạnh co giãn 4 chiều, mặc cực mát.', 1, 220),
(34, 1, 1, 'somi_01.jpg', 'Sơ Mi Trắng Oxford', 300000.00, 150, 'Hot', 5, 'Chuẩn soái ca, chất vải Oxford đứng form.', 1, 300),
(35, 1, 1, 'somi_02.jpg', 'Sơ Mi Kẻ Caro Đỏ', 280000.00, 120, 'New', 5, 'Năng động, trẻ trung, phù hợp đi học đi làm.', 1, 100),
(36, 1, 1, 'somi_03.jpg', 'Sơ Mi Lụa Mềm', 350000.00, 80, 'Sale', 5, 'Mềm mại, chống nhăn, thoáng mát.', 1, 50),
(37, 1, 1, 'somi_04.jpg', 'Sơ Mi Ngắn Tay Hoa', 250000.00, 200, 'Hot', 5, 'Họa tiết nhiệt đới, phù hợp đi biển, du lịch.', 1, 150),
(38, 1, 1, 'somi_05.jpg', 'Sơ Mi Denim', 320000.00, 100, 'New', 5, 'Chất bò mềm, bụi bặm và nam tính.', 1, 80),
(39, 1, 1, 'somi_06.jpg', 'Sơ Mi Cổ Tàu', 290000.00, 110, 'Sale', 5, 'Thiết kế cổ trụ lạ mắt, phong cách vintage.', 1, 60),
(40, 1, 1, 'somi_07.jpg', 'Sơ Mi Flanel', 310000.00, 90, 'Hot', 5, 'Vải dạ nỉ giữ ấm, họa tiết caro cổ điển.', 1, 120),
(41, 1, 1, 'somi_08.jpg', 'Sơ Mi Đen Trơn', 270000.00, 130, 'New', 5, 'Huyền bí, sang trọng, dễ phối đồ.', 1, 200),
(42, 1, 1, 'somi_09.jpg', 'Sơ Mi Dài Tay Kẻ Sọc', 330000.00, 70, 'Sale', 5, 'Kẻ sọc dọc giúp người mặc trông cao hơn.', 1, 40),
(43, 1, 1, 'somi_10.jpg', 'Sơ Mi Linen', 380000.00, 60, 'Hot', 5, 'Vải đũi tự nhiên, thấm hút tốt, thân thiện da.', 1, 90),
(44, 1, 1, 'polo_01.jpg', 'Polo Cá Sấu Classic', 280000.00, 200, 'Hot', 8, 'Vải thun cá sấu 4 chiều, co giãn tốt.', 1, 180),
(45, 1, 1, '692ffb50d80bc_vn-11134207-7qukw-lg0l844v0zjr3b.jpg', 'Polo Phối Cổ', 250000.00, 150, 'New', 8, 'Điểm nhấn phối màu ở cổ và tay áo.', 1, 100),
(46, 1, 1, 'polo_03.jpg', 'Polo Thể Thao', 220000.00, 180, 'Sale', 8, 'Chất liệu poly thái, khô thoáng nhanh.', 1, 120),
(47, 1, 1, 'polo_04.jpg', 'Polo Họa Tiết Chìm', 300000.00, 90, 'Hot', 8, 'Họa tiết dệt chìm sang trọng, tinh tế.', 1, 60),
(48, 1, 1, 'polo_05.jpg', 'Polo Dáng Suông', 260000.00, 130, 'New', 8, 'Form regular fit, không quá bó sát.', 1, 85),
(49, 1, 1, 'polo_06.jpg', 'Polo Zip Khóa Kéo', 320000.00, 70, 'Sale', 8, 'Thay cúc bằng khóa zip hiện đại, cá tính.', 1, 40),
(50, 1, 1, 'polo_07.jpg', 'Polo Len Dệt Kim', 350000.00, 50, 'Hot', 8, 'Chất len dệt mỏng, phong cách retro.', 1, 150),
(51, 1, 1, 'polo_08.jpg', 'Polo Sọc Ngang To', 240000.00, 160, 'New', 8, 'Kẻ sọc bản to, trẻ trung năng động.', 1, 95),
(52, 1, 1, 'polo_09.jpg', 'Polo Màu Pastel', 270000.00, 110, 'Sale', 8, 'Màu sắc nhẹ nhàng, tôn da.', 1, 75),
(53, 1, 1, 'polo_10.jpg', 'Polo Logo Thêu', 290000.00, 100, 'Hot', 8, 'Logo thêu nổi bật ngực áo, đẳng cấp.', 1, 210),
(54, 1, 1, 'khoac_01.jpg', 'Áo Khoác Gió 2 Lớp', 450000.00, 100, 'Hot', 9, 'Chống nước nhẹ, cản gió tốt, thích hợp đi phượt.', 1, 250),
(55, 1, 1, 'khoac_02.jpg', 'Áo Bomber Bóng Chày', 550000.00, 80, 'New', 9, 'Phong cách học đường Mỹ, năng động.', 1, 180),
(56, 1, 1, 'khoac_03.jpg', 'Áo Khoác Jeans', 600000.00, 60, 'Sale', 9, 'Bụi bặm, bền bỉ với thời gian.', 1, 120),
(57, 1, 1, '692fe95e859ff_54034716996_f05587c93a_c_59eb19b7070844199078bad134ac2b18_master.jpg', 'Áo Blazer Hàn Quốc', 750000.00, 40, 'Hot', 9, 'Lịch lãm như soái ca phim Hàn.', 1, 300),
(58, 1, 1, 'khoac_05.jpg', 'Áo Khoác Phao Béo', 800000.00, 50, 'New', 9, 'Siêu ấm áp cho những ngày đại hàn.', 1, 90),
(59, 1, 1, 'khoac_06.jpg', 'Áo Khoác Kaki', 480000.00, 90, 'Sale', 9, 'Chất kaki dày dặn, form đứng, nhiều túi tiện lợi.', 1, 70),
(60, 1, 1, 'khoac_07.jpg', 'Áo Hoodie Zip', 350000.00, 150, 'Hot', 9, 'Nỉ bông ấm áp, có mũ trùm đầu và khóa kéo.', 1, 200),
(61, 1, 1, 'khoac_08.jpg', 'Áo Khoác Da PU', 650000.00, 45, 'New', 9, 'Da PU cao cấp, không nổ, phong cách bad boy.', 1, 160),
(62, 1, 1, 'khoac_09.jpg', 'Áo Cardigan Dày', 400000.00, 70, 'Sale', 9, 'Len dày dặn, giữ ấm tốt, phong cách nhẹ nhàng.', 1, 110),
(63, 1, 1, 'khoac_10.jpg', 'Áo Khoác Măng Tô', 900000.00, 30, 'Hot', 9, 'Dáng dài sang trọng, phù hợp người cao ráo.', 1, 140),
(64, 1, 1, 'jeans_01.jpg', 'Jeans Slimfit Xanh', 400000.00, 120, 'Hot', 10, 'Ôm vừa phải, tôn dáng chân.', 1, 190),
(65, 1, 1, 'jeans_02.jpg', 'Jeans Rách Gối', 450000.00, 100, 'New', 10, 'Cá tính, bụi bặm, phong cách đường phố.', 1, 220),
(66, 1, 1, 'jeans_03.jpg', 'Jeans Đen Trơn', 380000.00, 150, 'Sale', 10, 'Màu đen cơ bản, dễ phối với mọi loại áo.', 1, 300),
(67, 1, 1, 'jeans_04.jpg', 'Jeans Baggy', 420000.00, 80, 'Hot', 10, 'Ống rộng thoải mái, che khuyết điểm chân to.', 1, 150),
(68, 1, 1, 'jeans_05.jpg', 'Jeans Ống Suông', 410000.00, 90, 'New', 10, 'Phong cách retro thập niên 90.', 1, 80),
(69, 1, 1, 'jeans_06.jpg', 'Jeans Xám Khói', 430000.00, 70, 'Sale', 10, 'Màu xám khói lạ mắt, thời thượng.', 1, 100),
(70, 1, 1, 'jeans_07.jpg', 'Jeans Short', 300000.00, 200, 'Hot', 10, 'Quần soóc bò năng động mùa hè.', 1, 120),
(71, 1, 1, 'jeans_08.jpg', 'Jeans Mài Bạc', 460000.00, 60, 'New', 10, 'Wash màu bạc ấn tượng ở đùi.', 1, 90),
(72, 1, 1, 'jeans_09.jpg', 'Jeans Skinny', 350000.00, 130, 'Sale', 10, 'Ôm sát chân, co giãn tốt.', 1, 60),
(73, 1, 1, 'jeans_10.jpg', 'Jeans Jogger', 440000.00, 85, 'Hot', 10, 'Bo gấu năng động, lưng chun thoải mái.', 1, 110),
(74, 1, 1, 'gio_01.jpg', 'Quần Gió 3 Sọc', 200000.00, 150, 'Hot', 11, 'Thiết kế kinh điển, phù hợp chơi thể thao.', 1, 180),
(75, 1, 1, 'gio_02.jpg', 'Quần Gió Dù Nhăn', 250000.00, 100, 'New', 11, 'Chất liệu dù nhăn thời trang, không bám bụi.', 1, 90),
(76, 1, 1, 'gio_03.jpg', 'Quần Gió Bo Gấu', 220000.00, 120, 'Sale', 11, 'Gọn gàng, dễ vận động.', 1, 70),
(77, 1, 1, 'gio_04.jpg', 'Quần Gió Ống Rộng', 240000.00, 80, 'Hot', 11, 'Phong cách hiphop, ống rộng thùng thình.', 1, 130),
(78, 1, 1, 'gio_05.jpg', 'Quần Gió Phối Màu', 260000.00, 90, 'New', 11, 'Phối mảng màu color block nổi bật.', 1, 50),
(79, 1, 1, 'gio_06.jpg', 'Quần Gió Lót Lưới', 280000.00, 70, 'Sale', 11, 'Bên trong lót lưới thoáng khí.', 1, 60),
(80, 1, 1, 'gio_07.jpg', 'Quần Gió Túi Hộp', 300000.00, 60, 'Hot', 11, 'Nhiều túi hộp tiện lợi, phong cách Cargo.', 1, 110),
(81, 1, 1, 'gio_08.jpg', 'Quần Gió Chống Nước', 350000.00, 50, 'New', 11, 'Công nghệ trượt nước, đi mưa nhẹ thoải mái.', 1, 40),
(82, 1, 1, '693066f7e1597_vn-11134207-7ras8-m3bilssbjx0s33.jpg', 'Quần Gió Dây Rút', 210000.00, 140, 'Sale', 11, 'Dây rút eo và gấu quần điều chỉnh độ rộng.', 1, 80),
(83, 1, 1, '693066ac1c46d_0ed63db1b29ed9f300075822ca174eaa.jpg', 'Quần Gió Tập Gym', 190000.00, 160, 'Hot', 11, 'Mỏng nhẹ, thấm hút mồ hôi tốt.', 1, 100),
(84, 1, 1, '6930662eb5809_quan-short-kaki-tron-qs009-mau-den-15969-slide-products-6018cc4bdaf87.png', 'Short Kaki Trơn', 200000.00, 200, 'Hot', 12, 'Đơn giản, dễ mặc, nhiều màu sắc.', 1, 250),
(85, 1, 1, '693065f811da9_vn-11134207-7qukw-lf9exw90mgk74d.jpg', 'Short Nỉ Da Cá', 180000.00, 180, 'New', 12, 'Mềm mại, mặc nhà hay đi chơi đều ổn.', 1, 150),
(86, 1, 1, '692ffcf4189f0_vn-11134207-7r98o-lvsgqsmkmlbtcf.jpg', 'Short Gió Thể Thao', 150000.00, 250, 'Sale', 12, 'Mát mẻ, phù hợp đá bóng, chạy bộ.', 1, 200),
(87, 1, 1, '692ffcd3e7cbf_160_short_jean_3m-13_dc30b6d561134509aebe20b20f19c3f0_1024x1024.jpg', 'Short Jeans Rách', 280000.00, 100, 'Hot', 12, 'Bụi bặm, cá tính cho mùa hè.', 1, 120),
(88, 1, 1, '692ffc8fcc8dc_15412-clean-z2593506647181-19dc26a68de3e6d46f3498f0b0badb34.png', 'Short Họa Tiết', 220000.00, 120, 'New', 12, 'Họa tiết hoa lá đi biển rực rỡ.', 1, 90),
(89, 1, 1, '692ffc487ee1c_z4549879349049-4cc2cab1ca993de2767f4fcefb76b802-1690377158963.webp', 'Short Túi Hộp', 250000.00, 80, 'Sale', 12, 'Phong cách quân đội mạnh mẽ.', 1, 70),
(90, 1, 1, '692ffc13c21e9_vn-11134201-23030-8kiqwmh1ncova1.jpg', 'Short Đũi', 230000.00, 140, 'Hot', 12, 'Vải đũi nhẹ, thoáng, không bí mồ hôi.', 1, 130),
(91, 1, 1, '692ffbf3277ba_z4006056682005_78b390cbbb83e70a4e9250700d32fad1_374c61ebf3134eceb2884980824c9007_master.jpg', 'Short Tây', 270000.00, 90, 'New', 12, 'Lịch sự nhưng vẫn thoải mái.', 1, 60),
(92, 1, 1, '692ffbc7ea270_vn-11134201-23030-8kiqwmh1ncova1.jpg', 'Short Thun Lạnh', 160000.00, 220, 'Sale', 12, 'Mặc cực mát, co giãn tốt.', 1, 180),
(93, 1, 1, '692ff2d931595_dockers-khaki-chino-shorts-product-2-3210366-956989973.webp', 'Short Chinos', 260000.00, 110, 'Hot', 12, 'Chất vải Chinos dày dặn, đứng form.', 1, 100);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id_sp`),
  ADD KEY `fk_sanpham_danhmuc` (`id_danh_muc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`id_danh_muc`) REFERENCES `danh_muc` (`id_danh_muc`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

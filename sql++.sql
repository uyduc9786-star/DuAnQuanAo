-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 08, 2025 lúc 06:25 AM
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
-- Cơ sở dữ liệu: `nem_fashion`
--
CREATE DATABASE IF NOT EXISTS `nem_fashion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `nem_fashion`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`) VALUES
(1, 'Áo khoác', 'ao-khoac', 'Các mẫu áo khoác thời trang', '2025-11-18 15:41:01'),
(2, 'Đầm', 'dam', 'Đầm thiết kế sang trọng', '2025-11-18 15:41:01'),
(3, 'Áo', 'ao', 'Áo thun, áo sơ mi thời trang', '2025-11-18 15:41:01'),
(4, 'Quần', 'quan', 'Quần jeans, quần âu', '2025-11-18 15:41:01'),
(5, 'Phụ kiện', 'phu-kien', 'Phụ kiện thời trang', '2025-11-18 15:41:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','shipping','delivered','cancelled') DEFAULT 'pending',
  `shipping_address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment_method` enum('cod','banking') DEFAULT 'cod',
  `payment_status` enum('pending','paid') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `featured` tinyint(1) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `old_price`, `image`, `category_id`, `stock`, `featured`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ÁO KHOÁC THIẾT KẾ AK25712', 'Áo khoác thiết kế cao cấp, chất liệu vải dày dặn, form dáng đẹp. Phù hợp cho nhiều dịp từ công sở đến dạo phố.', 1463800.00, 2252000.00, 'anh1.webp', 1, 50, 1, 'active', '2025-11-18 15:41:01', '2025-11-19 09:53:50'),
(2, 'ĐẦM THIẾT KẾ D21722', 'Đầm thiết kế sang trọng, phù hợp nhiều dịp. Chất liệu lụa cao cấp, đường may tinh tế.', 1177800.00, 1812000.00, 'anh1.webp', 2, 30, 1, 'active', '2025-11-18 15:41:01', '2025-11-19 09:53:59'),
(3, 'ĐẦM THIẾT KẾ D23882', 'Đầm thiết kế hiện đại, trẻ trung. Form dáng ôm body, màu sắc thời thượng.', 1203150.00, 1851000.00, 'anh1.webp', 2, 25, 0, 'active', '2025-11-18 15:41:01', '2025-11-19 09:54:10'),
(4, 'ĐẦM THIẾT KẾ D25752', 'Đầm thiết kế thanh lịch, chất liệu cao cấp. Thiết kế cổ điển kết hợp nét hiện đại.', 1229800.00, 1892000.00, 'anh1.webp', 2, 40, 1, 'active', '2025-11-18 15:41:01', '2025-11-19 09:54:16'),
(5, 'ÁO THUN BASIC AT001', 'Áo thun basic form rộng, chất cotton mềm mại, thoáng mát. Dễ dàng phối đồ.', 350000.00, 500000.00, 'anh1.webp', 3, 100, 0, 'active', '2025-11-18 15:41:01', '2025-11-19 09:54:22'),
(6, 'QUẦN JEANS QJ001', 'Quần jeans slim fit, co giãn tốt. Thiết kế trẻ trung, phù hợp với nhiều phong cách.', 650000.00, 800000.00, 'anh1.webp', 4, 60, 0, 'active', '2025-11-18 15:41:01', '2025-11-19 09:54:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `phone`, `address`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@nemfashion.com', 'Quản trị viên', NULL, NULL, 'admin', '2025-11-18 15:41:01', '2025-11-18 15:41:01');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_cart_item` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
--
-- Cơ sở dữ liệu: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Đang đổ dữ liệu cho bảng `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'table', 'Sql.moinhat', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"allrows\":\"1\",\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@TABLE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Cấu trúc của bảng @TABLE@\",\"latex_structure_continued_caption\":\"Cấu trúc của bảng @TABLE@ (còn nữa)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Nội dung của bảng @TABLE@\",\"latex_data_continued_caption\":\"Nội dung của bảng @TABLE@ (còn nữa)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(2, 'root', 'table', 'sqlmoinhat2027', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"allrows\":\"1\",\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@TABLE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Cấu trúc của bảng @TABLE@\",\"latex_structure_continued_caption\":\"Cấu trúc của bảng @TABLE@ (còn nữa)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Nội dung của bảng @TABLE@\",\"latex_data_continued_caption\":\"Nội dung của bảng @TABLE@ (còn nữa)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(3, 'root', 'database', 'Sqlmoinhat345', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"admin\",\"binh_luan\",\"chi_tiet_hoa_don\",\"danh_muc\",\"gio_hang\",\"hoadon\",\"khach_hang\",\"kho_anh\",\"kich_co\",\"mau_sac\",\"san_pham\",\"taikhoan\"],\"table_structure[]\":[\"admin\",\"binh_luan\",\"chi_tiet_hoa_don\",\"danh_muc\",\"gio_hang\",\"hoadon\",\"khach_hang\",\"kho_anh\",\"kich_co\",\"mau_sac\",\"san_pham\",\"taikhoan\"],\"table_data[]\":[\"admin\",\"binh_luan\",\"chi_tiet_hoa_don\",\"danh_muc\",\"gio_hang\",\"hoadon\",\"khach_hang\",\"kho_anh\",\"kich_co\",\"mau_sac\",\"san_pham\",\"taikhoan\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Cấu trúc của bảng @TABLE@\",\"latex_structure_continued_caption\":\"Cấu trúc của bảng @TABLE@ (còn nữa)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Nội dung của bảng @TABLE@\",\"latex_data_continued_caption\":\"Nội dung của bảng @TABLE@ (còn nữa)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(5, 'root', 'table', 'Sqlfullduan', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"allrows\":\"1\",\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@TABLE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Cấu trúc của bảng @TABLE@\",\"latex_structure_continued_caption\":\"Cấu trúc của bảng @TABLE@ (còn nữa)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Nội dung của bảng @TABLE@\",\"latex_data_continued_caption\":\"Nội dung của bảng @TABLE@ (còn nữa)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Đang đổ dữ liệu cho bảng `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"pro1014_uy\",\"table\":\"san_pham\"},{\"db\":\"pro1014_uy\",\"table\":\"hoadon\"},{\"db\":\"pro1014_uy\",\"table\":\"danh_muc\"},{\"db\":\"pro1014_uy\",\"table\":\"khach_hang\"},{\"db\":\"pro1014_uy\",\"table\":\"chi_tiet_hoa_don\"},{\"db\":\"pro1014_uy\",\"table\":\"mau_sac\"},{\"db\":\"pro1014_uy\",\"table\":\"kich_co\"},{\"db\":\"pro1014_uy\",\"table\":\"gio_hang\"},{\"db\":\"pro1014_uy\",\"table\":\"binh_luan\"},{\"db\":\"pro1014_uy\",\"table\":\"admin\"}]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Đang đổ dữ liệu cho bảng `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'pro1014_uy', 'danh_muc', '{\"sorted_col\":\"`danh_muc`.`Trangthai` ASC\"}', '2025-11-14 11:05:30'),
('root', 'pro1014_uy', 'mau_sac', '[]', '2025-12-01 10:58:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Đang đổ dữ liệu cho bảng `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-12-08 05:24:31', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"vi\"}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Chỉ mục cho bảng `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Chỉ mục cho bảng `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Chỉ mục cho bảng `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Chỉ mục cho bảng `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Chỉ mục cho bảng `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Chỉ mục cho bảng `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Chỉ mục cho bảng `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Chỉ mục cho bảng `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Chỉ mục cho bảng `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Chỉ mục cho bảng `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Chỉ mục cho bảng `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Cơ sở dữ liệu: `pro1014_uy`
--
CREATE DATABASE IF NOT EXISTS `pro1014_uy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pro1014_uy`;

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
(12, 10, 2, 1500000.00, 1, 'Trắng', 'L'),
(13, 1, 15, 350000.00, 50, 'Đen', 'L'),
(14, 2, 22, 280000.00, 45, 'Trắng', 'M'),
(15, 3, 8, 450000.00, 40, 'Xanh', 'XL'),
(16, 1, 12, 150000.00, 38, 'Đỏ', 'S'),
(17, 4, 5, 300000.00, 35, 'Vàng', 'M'),
(18, 5, 19, 250000.00, 30, 'Đen', 'XXL'),
(19, 2, 30, 550000.00, 28, 'Hồng', 'S'),
(20, 6, 45, 180000.00, 25, 'Xám', 'L'),
(21, 7, 3, 220000.00, 20, 'Xanh rêu', 'M'),
(22, 8, 50, 400000.00, 18, 'Nâu', 'L'),
(24, 11, 88, 220000.00, 1, 'Mặc định', 'F'),
(25, 12, 87, 280000.00, 1, 'Mặc định', 'F'),
(26, 13, 93, 260000.00, 1, 'Mặc định', 'F'),
(27, 13, 91, 270000.00, 1, 'Mặc định', 'F'),
(28, 13, 93, 260000.00, 1, 'Đỏ', 'S'),
(29, 14, 93, 260000.00, 1, 'Đỏ', 'S'),
(30, 14, 92, 160000.00, 1, 'Mặc định', 'F'),
(31, 15, 91, 270000.00, 1, 'Mặc định', 'F');

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
(1, 'Quần Âu', 1),
(2, 'Áo len', 1),
(3, 'Áo thun', 1),
(5, 'Áo sơ mi', 1),
(8, 'Áo Polo', 1),
(9, 'Áo khoác', 1),
(10, 'Quần Jeans', 1),
(11, 'Quần gió', 1),
(12, 'Quần Short', 1);

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
  `ngay_dat` datetime NOT NULL DEFAULT current_timestamp(),
  `ho_ten` varchar(100) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`id_hoadon`, `id_khachhang`, `hinh_thuc_thanh_toan`, `trang_thai`, `tongtien`, `ngay_dat`, `ho_ten`, `dia_chi`, `sdt`) VALUES
(1, 1, 'Tiền mặt (COD)', 'Mới', 350000.00, '2025-12-03 22:49:07', 'Nguyễn Văn An', '123 Cầu Giấy, Hà Nội', '0901234567'),
(2, 2, 'Chuyển khoản', 'Đang giao hàng', 700000.00, '2025-12-03 22:49:07', 'Trần Thị Bích', '45 Lê Lợi, Q1, HCM', '0912345678'),
(3, 1, 'Tiền mặt (COD)', 'Hoàn tất', 150000.00, '2025-12-03 22:49:07', 'Lê Văn Cường', 'Số 5 Ngõ 10, Đống Đa, HN', '0987654321'),
(4, 3, 'Chuyển khoản', 'Đã hủy', 500000.00, '2025-12-03 22:49:07', 'Phạm Thu Hương', '88 Trần Hưng Đạo, Đà Nẵng', '0977889900'),
(5, 4, 'Tiền mặt (COD)', 'Mới', 1200000.00, '2025-12-03 22:49:07', 'Hoàng Văn Dũng', 'Khu CN VSIP, Bình Dương', '0966554433'),
(6, 2, 'Chuyển khoản', 'Đang giao hàng', 250000.00, '2025-12-03 22:49:07', 'Vũ Thị Lan', 'Chung cư EcoHome, Hà Nội', '0911223344'),
(7, 5, 'Tiền mặt (COD)', 'Đã giao', 900000.00, '2025-12-03 22:49:07', 'Đỗ Minh Tuấn', 'Thành phố Thủ Đức, HCM', '0933445566'),
(8, 1, 'Chuyển khoản', 'Hoàn tất', 450000.00, '2025-12-03 22:49:07', 'Ngô Kiến Huy', 'Phố Huế, Hai Bà Trưng, HN', '0944556677'),
(9, 3, 'Tiền mặt (COD)', 'Đang giao hàng', 600000.00, '2025-12-03 22:49:07', 'Bùi Anh Tuấn', 'Đà Lạt, Lâm Đồng', '0955667788'),
(10, 2, 'Chuyển khoản', 'Đang giao hàng', 3000000.00, '2025-12-03 22:49:07', 'Sơn Tùng MTP', 'Thái Bình', '0999888777'),
(11, 0, 'Tiền mặt (COD)', 'Mới', 220000.00, '2025-12-03 22:56:59', 'Ôn Dực Uy 2', 'Số nhà 14 , Móng Cái , Quảng Ninh', '0776781111'),
(12, 0, 'Tiền mặt (COD)', 'Mới', 280000.00, '2025-12-03 22:58:01', 'Ôn Dực Uy 3', 'Số nhà 14 , Móng Cái , Quảng Ninh', '0776781111'),
(13, 0, 'Chuyển khoản', 'Đã giao', 790000.00, '2025-12-03 23:50:43', 'Ôn Dực Uy', 'Số nhà 14 , Móng Cái , Quảng Ninh', '0776781111'),
(14, 0, 'Tiền mặt (COD)', 'Đã giao', 420000.00, '2025-12-04 13:28:52', 'Ôn Dực Uy', 'Số nhà 14 , Móng Cái , Quảng Ninh', '0776781111'),
(15, 0, 'Chuyển khoản', 'Mới', 270000.00, '2025-12-04 14:11:22', 'Bùi Gia Hưng', 'Số nhà 14 , Móng Cái , Quảng Ninh', '0123456');

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
(3, 'L');

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
(3, 'Đen');

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
-- AUTO_INCREMENT cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  MODIFY `id_cthd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `id_danh_muc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id_hoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `kich_co`
--
ALTER TABLE `kich_co`
  MODIFY `id_kichco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT cho bảng `mau_sac`
--
ALTER TABLE `mau_sac`
  MODIFY `id_mausac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

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

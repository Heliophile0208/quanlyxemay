-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 27, 2024 lúc 05:23 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlxemay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hangxe`
--

CREATE TABLE `hangxe` (
  `mahang` int(11) NOT NULL,
  `tenhang` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hangxe`
--

INSERT INTO `hangxe` (`mahang`, `tenhang`) VALUES
(1, 'Honda'),
(2, 'Yamaha'),
(3, 'Suzuki'),
(4, 'Kawasaki'),
(5, 'Piaggio');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xe`
--

CREATE TABLE `xe` (
  `maxe` int(11) NOT NULL,
  `tenxe` varchar(100) NOT NULL,
  `mahang` int(11) DEFAULT NULL,
  `namsx` year(4) DEFAULT NULL,
  `dungtich` int(11) NOT NULL,
  `mota` text DEFAULT NULL,
  `hinh` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `xe`
--

INSERT INTO `xe` (`maxe`, `tenxe`, `mahang`, `namsx`, `dungtich`, `mota`, `hinh`) VALUES
(1, 'Honda Winner X', 1, '2023', 160, 'Xe côn tay mạnh mẽ, thiết kế thể thao.', 'Images/honda_winner_x.jpg'),
(2, 'Yamaha NVX', 2, '2023', 200, 'Xe tay ga thể thao với thiết kế hiện đại.', 'Images/yamaha_nvx.jpg'),
(3, 'Suzuki Hayate', 3, '2021', 150, 'Xe ga tiện lợi cho việc di chuyển hàng ngày.', 'Images/suzuki_hayate.jpg'),
(4, 'Kawasaki Z900', 4, '2022', 150, 'Xe thể thao với động cơ mạnh mẽ và thiết kế ấn tượng.', 'Images/kawasaki_z900.jpg'),
(5, 'Piaggio Liberty', 5, '2022', 150, 'Xe ga thanh lịch với nhiều tiện ích.', 'Images/piaggio_liberty.jpg'),
(6, 'Honda CB150R', 1, '2022', 150, 'Xe côn tay phong cách naked bike.', 'Images/honda_cb150r.jpg'),
(7, 'Yamaha FZ-S', 2, '2021', 150, 'Xe côn tay với kiểu dáng thể thao, mạnh mẽ.', 'Images/yamaha_fz_s.jpg'),
(8, 'Suzuki GSX-R150', 3, '2023', 125, 'Xe thể thao cỡ nhỏ, thích hợp cho các tay lái trẻ.', 'Images/suzuki_gsx_r150.jpg'),
(9, 'Kawasaki Versys-X 300', 4, '2022', 150, 'Xe touring đa dụng, phù hợp cho mọi loại địa hình.', 'Images/kawasaki_versys_x300.jpg'),
(10, 'Piaggio Medley', 5, '2023', 125, 'Xe tay ga cao cấp với thiết kế sang trọng.', 'Images/piaggio_medley.jpg'),
(11, 'Honda Air Blade', 1, '2023', 150, 'Xe tay ga phổ biến, tiết kiệm nhiên liệu.', 'Images/honda_air_blade.jpg'),
(12, 'Yamaha Grande', 2, '2023', 140, 'Xe tay ga sang trọng với thiết kế tinh tế.', 'Images/yamaha_grande.jpg'),
(13, 'Suzuki Raider R150', 3, '2022', 150, 'Xe côn tay với động cơ mạnh, phong cách thể thao.', 'Images/suzuki_raider_r150.jpg'),
(14, 'Kawasaki Ninja 250', 4, '2022', 140, 'Xe thể thao với hiệu suất vượt trội.', 'Images/kawasaki_ninja_250.jpg'),
(15, 'Piaggio Fly', 5, '2021', 150, 'Xe tay ga nhỏ gọn, dễ dàng di chuyển trong thành phố.', 'Images/piaggio_fly.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `hangxe`
--
ALTER TABLE `hangxe`
  ADD PRIMARY KEY (`mahang`);

--
-- Chỉ mục cho bảng `xe`
--
ALTER TABLE `xe`
  ADD PRIMARY KEY (`maxe`),
  ADD KEY `mahang` (`mahang`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hangxe`
--
ALTER TABLE `hangxe`
  MODIFY `mahang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `xe`
--
ALTER TABLE `xe`
  MODIFY `maxe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

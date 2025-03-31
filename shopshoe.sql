-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 31, 2025 lúc 11:16 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

CREATE database shopshoe;
use shopshoe;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopshoe`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `aspnetroles`
--

CREATE TABLE `aspnetroles` (
  `Id` char(36) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `NormalizedName` varchar(255) NOT NULL,
  `ConcurrencyStamp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `aspnetroles`
--

INSERT INTO `aspnetroles` (`Id`, `Name`, `NormalizedName`, `ConcurrencyStamp`) VALUES
('67e903c63df84', 'Admin', 'ADMIN', NULL),
('74672c13c70bff953b6710968fe915308289', 'User', 'USER', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `aspnetuserroles`
--

CREATE TABLE `aspnetuserroles` (
  `UserId` char(36) NOT NULL,
  `RoleId` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `aspnetuserroles`
--

INSERT INTO `aspnetuserroles` (`UserId`, `RoleId`) VALUES
('67e90647f1630', '67e903c63df84'),
('badbaecefecedcf7b4ba280d459c822d60b3', '74672c13c70bff953b6710968fe915308289'),
('e0e8ad5fd1a97fd4b365a225f2803ee3f0f7', '67e903c63df84');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `aspnetusers`
--

CREATE TABLE `aspnetusers` (
  `Id` char(36) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `sex` enum('Male','Female','Other') DEFAULT NULL,
  `UserName` varchar(255) NOT NULL,
  `NormalizedUserName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NormalizedEmail` varchar(255) NOT NULL,
  `EmailConfirmed` tinyint(1) DEFAULT 0,
  `PasswordHash` text NOT NULL,
  `SecurityStamp` varchar(255) DEFAULT NULL,
  `ConcurrencyStamp` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `PhoneNumberConfirmed` tinyint(1) DEFAULT 0,
  `TwoFactorEnabled` tinyint(1) DEFAULT 0,
  `LockoutEnd` datetime DEFAULT NULL,
  `LockoutEnabled` tinyint(1) DEFAULT 0,
  `AccessFailedCount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `aspnetusers`
--

INSERT INTO `aspnetusers` (`Id`, `avatar`, `sex`, `UserName`, `NormalizedUserName`, `Email`, `NormalizedEmail`, `EmailConfirmed`, `PasswordHash`, `SecurityStamp`, `ConcurrencyStamp`, `PhoneNumber`, `PhoneNumberConfirmed`, `TwoFactorEnabled`, `LockoutEnd`, `LockoutEnabled`, `AccessFailedCount`) VALUES
('67e901e0a486d', NULL, NULL, 'Hoàng Duy', 'HOÀNG DUY', 'vohoangduy9a4@gmail.com', 'VOHOANGDUY9A4@GMAIL.COM', 0, '$2y$10$4hEpFgu9zEHT8Ka4otWqX.ZHRrhfSHps9V/gtGuaZ7l07AfScvvh6', NULL, NULL, NULL, 0, 0, NULL, 0, 0),
('67e90647f1630', NULL, NULL, 'duyvo', '', 'duyvo@example.com', '', 0, '$2y$10$C.p.QJ5rxEE2noZCM5elYuY27ldFlHj/hIcfFLP2mjrvGBuqtonv.', NULL, NULL, NULL, 0, 0, NULL, 0, 0),
('badbaecefecedcf7b4ba280d459c822d60b3', NULL, NULL, 'thientan', 'THIENTAN', 'thientan@example.com', 'THIENTAN@EXAMPLE.COM', 0, '$2y$10$QBGA1Aqt88I9xgrM0uPMeuXma9x1qJ3wMXfcfyFqVtoQmj3T3tZr2', NULL, NULL, NULL, 0, 0, NULL, 0, 0),
('e0e8ad5fd1a97fd4b365a225f2803ee3f0f7', NULL, NULL, 'minh', 'MINH', 'minh@example.com', 'MINH@EXAMPLE.COM', 0, '$2y$10$VJrNGYaSRvmIcXuq.bA8iuo3n3SLLwUqFcuGGxhX2cp5Uzp05vIqi', NULL, NULL, NULL, 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Converse');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`) VALUES
(1, 'Việt Nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `materials`
--

INSERT INTO `materials` (`id`, `name`) VALUES
(1, 'Textile');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` char(36) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`) VALUES
(3, '67e901e0a486d', 3959000.00, 'pending', '2025-03-31 08:19:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(5, 3, '67E6B6F77AE20', 2, 1104000.00),
(6, 3, '67E6B6F77DCBB', 1, 1751000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shoes`
--

CREATE TABLE `shoes` (
  `id` varchar(20) NOT NULL,
  `path_image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shoes`
--

INSERT INTO `shoes` (`id`, `path_image`, `title`, `price`, `description`, `type_id`, `brand_id`, `manufacturer_id`, `material_id`) VALUES
('67E6B6F77AE20', '/webbangiay/public/images/67E6B6F77AE20.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1104000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 1, 1, 1, 1),
('67E6B6F77DCBB', '/webbangiay/public/images/67E6B6F77DCBB.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1751000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 1, 1, 1, 1),
('67E6B6F7801D4', '/webbangiay/public/images/67E6B6F7801D4.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1042000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 1, 1, 1, 1),
('67E6B6F7825BB', '/webbangiay/public/images/67E6B6F7825BB.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1455000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 1, 1, 1, 1),
('67E6B6F784769', '/webbangiay/public/images/67E6B6F784769.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1804000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 1, 1, 1, 1),
('67E6B6F786AAA', '/webbangiay/public/images/67E6B6F786AAA.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1274000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 1, 1, 1, 1),
('67E6B6F788EE6', '/webbangiay/public/images/67E6B6F788EE6.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1833000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 1, 1, 1, 1),
('67E6B6F78B26F', '/webbangiay/public/images/67E6B6F78B26F.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1119000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 2, 1, 1, 1),
('67E6B6F78D44A', '/webbangiay/public/images/67E6B6F78D44A.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1422000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 2, 1, 1, 1),
('67E6B6F78F781', '/webbangiay/public/images/67E6B6F78F781.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 977000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 2, 1, 1, 1),
('67E6B6F7919D5', '/webbangiay/public/images/67E6B6F7919D5.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1345000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 2, 1, 1, 1),
('67E6B6F793C06', '/webbangiay/public/images/67E6B6F793C06.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1129000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 2, 1, 1, 1),
('67E6B6F795E6B', '/webbangiay/public/images/67E6B6F795E6B.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 836000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 3, 1, 1, 1),
('67E6B6F7980B7', '/webbangiay/public/images/67E6B6F7980B7.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1642000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 3, 1, 1, 1),
('67E6B6F79A43A', '/webbangiay/public/images/67E6B6F79A43A.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1596000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 3, 1, 1, 1),
('67E6B6F79C64A', '/webbangiay/public/images/67E6B6F79C64A.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 853000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 3, 1, 1, 1),
('67E6B6F79E931', '/webbangiay/public/images/67E6B6F79E931.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1653000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 3, 1, 1, 1),
('67E6B6F7A0AAB', '/webbangiay/public/images/67E6B6F7A0AAB.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1610000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 3, 1, 1, 1),
('67E6B6F7A2DF1', '/webbangiay/public/images/67E6B6F7A2DF1.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 833000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7A4F44', '/webbangiay/public/images/67E6B6F7A4F44.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1998000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7A6E8F', '/webbangiay/public/images/67E6B6F7A6E8F.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1777000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7A911A', '/webbangiay/public/images/67E6B6F7A911A.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1832000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7AB169', '/webbangiay/public/images/67E6B6F7AB169.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1018000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7AD734', '/webbangiay/public/images/67E6B6F7AD734.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1418000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7AE102', '/webbangiay/public/images/67E6B6F7AE102.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1852000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7B03D9', '/webbangiay/public/images/67E6B6F7B03D9.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1913000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7B2C89', '/webbangiay/public/images/67E6B6F7B2C89.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1383000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 4, 1, 1, 1),
('67E6B6F7B58F5', '/webbangiay/public/images/67E6B6F7B58F5.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1136000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 5, 1, 1, 1),
('67E6B6F7B84BF', '/webbangiay/public/images/67E6B6F7B84BF.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1214000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 5, 1, 1, 1),
('67E6B6F7BBE10', '/webbangiay/public/images/67E6B6F7BBE10.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1596000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 5, 1, 1, 1),
('67E6B6F7BEE41', '/webbangiay/public/images/67E6B6F7BEE41.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1620000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 5, 1, 1, 1),
('67E6B6F7C2204', '/webbangiay/public/images/67E6B6F7C2204.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1428000, 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân', 5, 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(2, 'chuck_1970s'),
(3, 'chuck_2'),
(1, 'classic'),
(4, 'seasonal'),
(5, 'sneaker');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `aspnetroles`
--
ALTER TABLE `aspnetroles`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD UNIQUE KEY `NormalizedName` (`NormalizedName`);

--
-- Chỉ mục cho bảng `aspnetuserroles`
--
ALTER TABLE `aspnetuserroles`
  ADD PRIMARY KEY (`UserId`,`RoleId`),
  ADD KEY `RoleId` (`RoleId`);

--
-- Chỉ mục cho bảng `aspnetusers`
--
ALTER TABLE `aspnetusers`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `NormalizedUserName` (`NormalizedUserName`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `NormalizedEmail` (`NormalizedEmail`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type` (`type_id`),
  ADD KEY `fk_brand` (`brand_id`),
  ADD KEY `fk_manufacturer` (`manufacturer_id`),
  ADD KEY `fk_material` (`material_id`);

--
-- Chỉ mục cho bảng `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `aspnetuserroles`
--
ALTER TABLE `aspnetuserroles`
  ADD CONSTRAINT `aspnetuserroles_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `aspnetusers` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aspnetuserroles_ibfk_2` FOREIGN KEY (`RoleId`) REFERENCES `aspnetroles` (`Id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `aspnetusers` (`Id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `shoes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `shoes`
--
ALTER TABLE `shoes`
  ADD CONSTRAINT `fk_brand` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `fk_manufacturer` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`),
  ADD CONSTRAINT `fk_material` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

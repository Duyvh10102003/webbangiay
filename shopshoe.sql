-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2025 lúc 11:50 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

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
-- Cấu trúc bảng cho bảng `shoes`
--

CREATE TABLE `shoes` (
  `id` varchar(20) NOT NULL,
  `path_image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `brain` varchar(255) NOT NULL,
  `manufacture` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shoes`
--

INSERT INTO `shoes` (`id`, `path_image`, `title`, `price`, `type`, `brain`, `manufacture`, `material`, `description`) VALUES
('67E6B6F77AE20', '/ShopShoe/public/images/67E6B6F77AE20.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1104000, 'classic', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F77DCBB', '/ShopShoe/public/images/67E6B6F77DCBB.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1751000, 'classic', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7801D4', '/ShopShoe/public/images/67E6B6F7801D4.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1042000, 'classic', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7825BB', '/ShopShoe/public/images/67E6B6F7825BB.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1455000, 'classic', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F784769', '/ShopShoe/public/images/67E6B6F784769.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1804000, 'classic', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F786AAA', '/ShopShoe/public/images/67E6B6F786AAA.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1274000, 'classic', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F788EE6', '/ShopShoe/public/images/67E6B6F788EE6.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1833000, 'classic', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F78B26F', '/ShopShoe/public/images/67E6B6F78B26F.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1119000, 'chuck_1970s', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F78D44A', '/ShopShoe/public/images/67E6B6F78D44A.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1422000, 'chuck_1970s', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F78F781', '/ShopShoe/public/images/67E6B6F78F781.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 977000, 'chuck_1970s', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7919D5', '/ShopShoe/public/images/67E6B6F7919D5.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1345000, 'chuck_1970s', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F793C06', '/ShopShoe/public/images/67E6B6F793C06.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1129000, 'chuck_1970s', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F795E6B', '/ShopShoe/public/images/67E6B6F795E6B.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 836000, 'chuck_2', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7980B7', '/ShopShoe/public/images/67E6B6F7980B7.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1642000, 'chuck_2', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F79A43A', '/ShopShoe/public/images/67E6B6F79A43A.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1596000, 'chuck_2', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F79C64A', '/ShopShoe/public/images/67E6B6F79C64A.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 853000, 'chuck_2', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F79E931', '/ShopShoe/public/images/67E6B6F79E931.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1653000, 'chuck_2', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7A0AAB', '/ShopShoe/public/images/67E6B6F7A0AAB.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1610000, 'chuck_2', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7A2DF1', '/ShopShoe/public/images/67E6B6F7A2DF1.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 833000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7A4F44', '/ShopShoe/public/images/67E6B6F7A4F44.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1998000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7A6E8F', '/ShopShoe/public/images/67E6B6F7A6E8F.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1777000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7A911A', '/ShopShoe/public/images/67E6B6F7A911A.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1832000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7AB169', '/ShopShoe/public/images/67E6B6F7AB169.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1018000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7AD734', '/ShopShoe/public/images/67E6B6F7AD734.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1418000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7AE102', '/ShopShoe/public/images/67E6B6F7AE102.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1852000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7B03D9', '/ShopShoe/public/images/67E6B6F7B03D9.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1913000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7B2C89', '/ShopShoe/public/images/67E6B6F7B2C89.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1383000, 'seasonal', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7B58F5', '/ShopShoe/public/images/67E6B6F7B58F5.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1136000, 'sneaker', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7B84BF', '/ShopShoe/public/images/67E6B6F7B84BF.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1214000, 'sneaker', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7BBE10', '/ShopShoe/public/images/67E6B6F7BBE10.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1596000, 'sneaker', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7BEE41', '/ShopShoe/public/images/67E6B6F7BEE41.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1620000, 'sneaker', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân'),
('67E6B6F7C2204', '/ShopShoe/public/images/67E6B6F7C2204.jpg', 'Converse Chuck Taylor All Star Festival Smoothie', 1428000, 'sneaker', 'Converse', 'Việt Nam', 'Textile', 'Thiết kế cổ cao cá tính giúp bảo vệ an toàn vùng mắt cá chân');

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
-- Chỉ mục cho bảng `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `aspnetuserroles`
--
ALTER TABLE `aspnetuserroles`
  ADD CONSTRAINT `aspnetuserroles_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `aspnetusers` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aspnetuserroles_ibfk_2` FOREIGN KEY (`RoleId`) REFERENCES `aspnetroles` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

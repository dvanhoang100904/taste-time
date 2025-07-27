-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 18, 2024 lúc 02:01 PM
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
-- Cơ sở dữ liệu: `taste_time`
--
CREATE DATABASE IF NOT EXISTS `taste_time` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `taste_time`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `beverages`
--

DROP TABLE IF EXISTS `beverages`;
CREATE TABLE `beverages` (
  `beverage_id` int(11) NOT NULL,
  `beverage_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `beverages`
--

INSERT INTO `beverages` (`beverage_id`, `beverage_name`, `price`, `description`, `image`, `category_id`) VALUES
(1, 'Cà phê đen', 12000.00, 'Hạt cà phê rang xay, nước sôi, đá viên. Có thể kèm theo: sữa, đường, hoặc các phụ gia khác tùy sở thích', 'cà phê đen.jpg', 1),
(2, 'Cà phê sữa đá', 18000.00, 'Cà phê đen pha với sữa đặc hoặc sữa tươi, được phục vụ với đá viên, tạo ra một thức uống ngọt ngào', 'cà phê sữa đá.jpg', 1),
(3, 'Bạc xỉu', 22000.00, 'cà phê pha với sữa đặc, có vị ngọt nhẹ và béo, thường được phục vụ với ít đá.', 'Bạc xỉu.jpg', 1),
(4, 'Cà phê sữa nóng', 20000.00, 'cà phê đen pha với sữa tươi hoặc sữa đặc, được phục vụ nóng, mang lại hương vị đậm đà, ngọt ngào và ', 'cà phê sữa nóng.jpg', 1),
(5, 'Cà phê sữa dừa', 26000.00, 'cà phê đen kết hợp với sữa dừa, tạo ra một thức uống ngọt ngào, béo ngậy và thơm mát, với hương vị đ', 'Cà Phê sữa dừa.jpg', 1),
(6, 'Cà phê sữa chua', 28000.00, 'sự kết hợp giữa cà phê đen đậm đà và sữa chua, tạo nên một thức uống độc đáo, vừa chua nhẹ, vừa ngọt', 'cà phê sữa chua.jpg', 1),
(7, 'Cà phê đá xay', 24000.00, 'cà phê xay nhuyễn kết hợp với đá viên, tạo ra một thức uống mát lạnh, đậm đà và thường được thêm sữa', 'cà phê đá xay.jpg', 1),
(8, 'Cà phê chồn', 32000.00, 'cà phê làm từ hạt đã qua quá trình tiêu hóa trong dạ dày của chồn, mang hương vị đặc biệt, mềm mại v', 'cà phê chồn.jpg', 1),
(9, 'Trà sữa trân châu', 22000.00, 'Trà sữa trân châu là thức uống kết hợp trà, sữa và trân châu dai, ngọt béo', 'tra-sua-tran-chau.jpg', 3),
(10, 'Trà sữa matcha', 26000.00, 'Trà sữa matcha là thức uống kết hợp trà xanh matcha, sữa và thường có thêm trân châu, mang hương vị ', 'trà sữa mátcha.jpg', 3),
(11, 'Trà sữa dâu', 24000.00, 'Trà sữa dâu là thức uống kết hợp trà, sữa và siro dâu, tạo vị ngọt, chua nhẹ và béo ngậy.', 'cach-lam-tra-sua-dau.jpg', 3),
(12, 'Sinh tố dừa', 22000.00, 'Sinh tố dừa là thức uống kết hợp dừa, sữa ngọt béo.', 'sinh tố dừa.jpg', 2),
(13, 'Sinh tố bơ', 26000.00, 'Sinh tố bơ là thức uống kết hợp bơ, sữa mang hương vị đậm đà và béo ngậy.', 'sinh tố bơ.jpg', 2),
(14, 'Sinh tố chuối', 20000.00, 'Sinh tố chuối là thức uống kết hợp chuối, sữa, ngọt béo ngậy.', 'sinh to chuối.jpg', 2),
(15, 'Cà phê Espresso', 15000.00, 'Cà phê Espresso là loại cà phê đậm đặc, được chiết xuất trực tiếp từ hạt cà phê nguyên chất qua máy ', 'caphe-epresso.jpg', 1),
(16, 'Cà phê Mocha', 20000.00, 'Cà phê espresso kết hợp với sữa nóng và siro chocolate, tạo ra vị ngọt và đậm đà.', 'cafe-mocha-nong.jpg', 1),
(17, 'Cappuccino', 18000.00, 'Cà phê espresso với sữa hơi đánh bọt, tạo lớp bọt sữa mềm mịn, vị nhẹ nhàng, thơm ngon.', 'cappuccino-cafe.jpg', 1),
(18, 'Cà phê Latte', 18000.00, 'Cà phê espresso pha cùng sữa nóng và một ít bọt sữa, mang lại vị ngọt nhẹ và thơm mịn.', 'cafe-latte.jpg', 1),
(19, 'Cà phê Americano', 16000.00, 'Cà phê espresso pha loãng với nước nóng, tạo ra một thức uống nhẹ nhàng hơn espresso nhưng vẫn giữ đ', 'coffee-americano.jpg', 1),
(20, 'Cà phê Macchiato', 18000.00, ' Cà phê espresso với một chút sữa tạo bọt, giữ nguyên độ đậm đà nhưng dễ uống hơn.', 'cafe-macchiato.jpg', 1),
(21, 'Cà phê Cold Brew', 22000.00, ' Cà phê được chiết xuất từ hạt cà phê xay thô, ngâm trong nước lạnh trong 12-24 giờ, mang lại vị cà ', 'Cà phê Cold Brew.jpg', 1),
(22, 'Cà phê Irish', 25000.00, 'Cà phê pha với rượu whisky Ireland, tạo ra một thức uống đặc biệt với hương vị cà phê ấm áp và nhẹ n', 'Cà phê Irish.jpg', 1),
(23, 'Trà sữa Hồng Trà', 22000.00, 'Trà sữa pha từ hồng trà, tạo ra một hương vị đậm đà và thơm ngọt, thích hợp cho những ai yêu thích t', 'Trà sữa Hồng Trà.jpg', 3),
(24, 'Trà sữa Taro', 26000.00, 'Trà sữa kết hợp với khoai môn (taro), mang lại hương vị ngọt ngào, béo ngậy, và màu sắc đặc trưng từ', 'tra sua Taro.jpeg', 3),
(25, 'Trà sữa Thái', 24000.00, 'Trà sữa pha từ trà Thái, tạo ra một hương vị đặc trưng, đậm đà và màu sắc vàng tươi nổi bật.', 'tra sua thai.jpg', 3),
(26, 'Trà sữa Oolong', 24000.00, 'Trà sữa pha từ trà Oolong, có hương vị thơm đặc trưng, nhẹ nhàng và ngọt ngào.', 'tra sua o long.jpg', 3),
(27, 'Sinh tố Dâu', 24000.00, ' Sinh tố dâu kết hợp giữa dâu tây tươi và sữa, mang lại hương vị ngọt ngào, thơm mát.', 'sinh to dau.jpg', 2),
(28, 'Sinh tố Xoài', 22000.00, 'Sinh tố xoài được làm từ xoài chín, sữa và đá, mang lại hương vị ngọt ngào và mát lạnh, thích hợp ch', 'sinh to xoai.jpg', 2),
(29, 'Sinh tố Kiwi', 26000.00, 'Sinh tố kiwi với vị chua ngọt đặc trưng, kết hợp với sữa và đá tạo thành một thức uống mát lạnh và b', 'sinh to kiwi.jpg', 2),
(30, 'Sinh tố Dưa Hấu', 22000.00, 'Sinh tố dưa hấu với hương vị ngọt ngào và thanh mát, là lựa chọn lý tưởng cho những ngày hè nóng bức', 'sinh-to-dua-hau.jpg', 2),
(31, 'Sinh tố Dứa', 20000.00, ' Sinh tố dứa kết hợp với sữa và đá, mang lại hương vị tươi mới và chua ngọt.', 'sinh-to-thom.jpg', 2),
(32, 'Sinh tố Nho', 24000.00, 'Sinh tố nho kết hợp nho tươi và sữa, mang lại hương vị ngọt ngào, thơm mát và dễ uống.', 'sinh to nho.jpg', 2),
(33, 'Nước ép Cam', 18000.00, 'Nước ép cam tươi, giàu vitamin C, mang lại vị ngọt tự nhiên và thanh mát, thích hợp cho mọi lứa tuổi', 'nuoc ep cam.jpg', 4),
(34, 'Nước ép Dưa Hấu', 20000.00, 'Nước ép dưa hấu tươi mát, ngọt ngào, giúp giải nhiệt trong những ngày hè oi bức.', 'Nuoc ep dua hau.jpg', 4),
(35, 'Nước ép Lựu', 24000.00, 'Nước ép lựu có vị ngọt, chua nhẹ, giàu chất chống oxy hóa, giúp làm đẹp da và tốt cho sức khỏe', 'nuoc-ep-luu.jpg', 4),
(36, 'Sữa chua truyền thống', 15000.00, 'Sữa chua lên men từ sữa tươi, có vị chua nhẹ và kết cấu mịn màng, giúp hỗ trợ tiêu hóa và cải thiện ', 'sua-chua.jpg', 5),
(37, 'Sữa chua Hy Lạp', 22000.00, 'Sữa chua Hy Lạp có độ đặc hơn và vị chua ít hơn, giàu protein, thích hợp cho những ai đang tìm kiếm ', 'sua chua hy lap.jpg', 5),
(38, 'Sữa chua trái cây', 18000.00, 'Sữa chua lên men kết hợp với các loại trái cây tươi như dâu, xoài, hoặc việt quất, tạo ra hương vị n', 'sua chua trai cay.jpg', 5),
(39, 'Sữa chua uống', 18000.00, 'Sữa chua lên men dạng lỏng, dễ uống, mang lại cảm giác mát lạnh, giúp cải thiện tiêu hóa và cung cấp', 'sua chua uống.jpg', 5),
(40, 'Sữa chua Cacao', 22000.00, 'Sữa chua lên men kết hợp với bột cacao, tạo ra sự kết hợp độc đáo giữa vị chua nhẹ của sữa chua và h', 'sua chua ca cao.jpg', 5),
(41, 'Trà Hoa Cúc', 18000.00, ' Trà hoa cúc với hương thơm dịu nhẹ, giúp thư giãn và giảm căng thẳng, rất tốt cho giấc ngủ.', 'tra hoa cuc.jpg', 6),
(42, 'Trà Gừng', 20000.00, 'Trà gừng ấm áp, có tác dụng làm ấm cơ thể, giúp giảm cảm lạnh và cải thiện tiêu hóa.', 'tra gung.jpg', 6),
(43, 'Trà Chanh', 18000.00, ' Trà chanh kết hợp giữa trà đen hoặc trà xanh và nước chanh tươi, mang lại hương vị chua ngọt, mát l', 'tra tranh.jpg', 6),
(44, 'Trà Nhài', 22000.00, 'Trà nhài thơm nhẹ, giúp thư giãn tinh thần và có tác dụng thanh nhiệt, giải độc.', 'tra nhài.jpg', 6),
(45, 'Trà Mạn', 20000.00, ' Trà mạn với hương vị đậm đà, thường được uống để cung cấp năng lượng và hỗ trợ tiêu hóa.', 'tra mạn.jpg', 6),
(46, 'Trà Dứa', 20000.00, ' Trà dứa mang vị ngọt chua đặc trưng, giúp giải nhiệt và thanh lọc cơ thể.', 'tra dứa.jpg', 6),
(47, 'Trà Mướp Đắng', 22000.00, ' Trà mướp đắng giúp thanh nhiệt, giải độc, tốt cho sức khỏe và làm đẹp da.', 'tra mướp đắng.jpg', 6),
(48, 'Trà Đen', 20000.00, 'Trà đen đậm đà với hương vị mạnh mẽ, có thể uống nóng hoặc lạnh, giúp tăng cường sự tỉnh táo và cung', 'tra den.jpg', 6),
(49, 'Nước Dừa Tươi', 25000.00, 'Nước dừa tươi mát, bổ dưỡng, giúp giải nhiệt, cung cấp nhiều khoáng chất và vitamin.', 'nuoc dua.jpg', 4),
(50, 'Nước Chanh Muối', 15000.00, 'Nước chanh muối thanh mát, có tác dụng giải nhiệt, thanh lọc cơ thể và bổ sung khoáng chất.', 'nuoc chanh muoi.jpg', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `beverages_categories`
--

DROP TABLE IF EXISTS `beverages_categories`;
CREATE TABLE `beverages_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `beverages_categories`
--

INSERT INTO `beverages_categories` (`category_id`, `category_name`, `description`) VALUES
(1, 'Cà phê', 'Cà phê đậm đà, được pha từ hạt cà phê rang xay chất lượng, mang lại hương vị mạnh mẽ, thơm ngon '),
(2, 'Sinh tố', 'Sinh tố được làm từ các loại trái cây tươi, xay nhuyễn với sữa hoặc nước trái cây, tạo ra một thức'),
(3, 'Trà sữa', 'Trà sữa kết hợp giữa trà đen hoặc trà xanh với sữa tươi, tạo ra một thức uống ngọt ngào, mượt mà'),
(4, 'Nước trái cây', 'nước trái cây này là lựa chọn tuyệt vời để giải khát và bổ sung dưỡng chất tự nhiên cho cơ thể'),
(5, 'Sữa chua lên men', 'Sữa chua lên men có vị chua nhẹ, mịn màng, được lên men tự nhiên từ sữa tươi. Thức uống này tốt cho cơ thể'),
(6, 'Trà', 'Trà không chỉ là một thức uống mà còn mang lại nhiều lợi ích sức khỏe. Việc chọn trà phù hợp sẽ giúp cho cơ thể');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL COMMENT '100: admin và 50: user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role_id`, `created_at`) VALUES
(7, 'daovanhoang2004', 'e10adc3949ba59abbe56e057f20f883e', 'daovanhoang2004@gmail.com', 100, '2024-11-18 13:00:06');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `beverages`
--
ALTER TABLE `beverages`
  ADD PRIMARY KEY (`beverage_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `beverages_categories`
--
ALTER TABLE `beverages_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `beverages`
--
ALTER TABLE `beverages`
  MODIFY `beverage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `beverages_categories`
--
ALTER TABLE `beverages_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `beverages`
--
ALTER TABLE `beverages`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `beverages_categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

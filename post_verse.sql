-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 24, 2025 lúc 04:56 AM
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
-- Cơ sở dữ liệu: `post_verse`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` mediumtext DEFAULT NULL,
  `navbar_status` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0 COMMENT '0: visible; 1: hidden; 2:deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `navbar_status`, `status`, `created_at`) VALUES
(1, 'HTML', 'html-slug', '<p>asdas</p>\r\n', 'HTMLMMMMMM', 'asdas', 1, 1, '2025-10-02 08:13:02'),
(2, 'PHP', 'php-subject', '<p>Hahahahha</p>\r\n', 'PHP Languege', 'PHP LanguegePHP LanguegePHP LanguegePHP LanguegePHP Languege', 1, 1, '2025-10-02 08:17:00'),
(5, 'C++', 'c-plus-plus', '<p>&aacute;dasdasdsadsa</p>\r\n', 'C++ Tutorial', 'ádsadasdasdasdasd', 1, 1, '2025-11-24 03:24:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `reply` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `parent_id`, `reply`, `content`, `created_at`) VALUES
(1, 1, 1, NULL, NULL, 'fuk fuk', '2025-10-19 09:22:55'),
(2, 1, 1, 1, 1, 'cmm', '2025-10-19 09:23:11'),
(3, 1, 1, 1, 2, 'con me m nha', '2025-10-19 09:23:26'),
(4, 1, 1, NULL, NULL, 'sadasd', '2025-10-19 09:24:37'),
(5, 1, 1, NULL, NULL, 'ádasd', '2025-10-19 09:24:52'),
(6, 1, 1, NULL, NULL, 'ádasd', '2025-10-19 09:24:54'),
(7, 1, 1, NULL, NULL, 'sadasd', '2025-10-19 09:24:55'),
(8, 1, 1, NULL, NULL, 'ádasd', '2025-10-19 09:24:56'),
(9, 1, 1, NULL, NULL, 'ádasđa', '2025-10-19 09:24:57'),
(10, 1, 1, NULL, NULL, 'ádasd', '2025-10-19 09:24:59'),
(11, 1, 1, NULL, NULL, 'ádasd', '2025-10-19 09:25:00'),
(12, 13, 1, NULL, NULL, 'sadasd', '2025-11-24 01:55:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment_reactions`
--

CREATE TABLE `comment_reactions` (
  `source_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` enum('like','dislike') NOT NULL,
  `reacted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comment_reactions`
--

INSERT INTO `comment_reactions` (`source_id`, `user_id`, `reaction`, `reacted_at`) VALUES
(1, 1, 'like', '2025-11-17 14:09:20'),
(1, 5, 'like', '2025-10-26 07:28:09'),
(4, 1, 'like', '2025-10-26 07:21:47'),
(5, 1, 'like', '2025-10-26 07:21:46'),
(6, 1, 'like', '2025-10-26 07:21:45'),
(6, 5, 'like', '2025-10-26 07:25:57'),
(7, 1, 'like', '2025-10-26 07:21:44'),
(7, 5, 'like', '2025-10-26 07:25:56'),
(8, 1, 'like', '2025-10-26 07:21:43'),
(8, 5, 'dislike', '2025-10-26 07:25:53'),
(9, 1, 'like', '2025-10-26 07:21:27'),
(9, 5, 'dislike', '2025-10-26 07:25:52'),
(10, 1, 'like', '2025-10-26 07:21:35'),
(11, 1, 'like', '2025-10-26 07:21:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `name`, `slug`, `description`, `image`, `meta_title`, `meta_description`, `status`, `created_at`, `category_id`, `user_id`) VALUES
(1, 'Hướng dẫn học PHP cho người mới', 'huong-dan-hoc-php-cho-nguoi-moi', 'Bài viết này sẽ hướng dẫn chi tiết cách bắt đầu học PHP từ cơ bản đến nâng cao.\n', '1759487484.png', 'Học PHP cơ bản cho người mới | Redamancy Blog', 'Khám phá lộ trình học PHP từ A-Z dành cho người mới bắt đầu. Bài viết chi tiết, dễ hiểu, có ví dụ minh họa.\r\n', 1, '2025-10-02 09:35:40', 2, 1),
(13, 'Giới thiệu về trí tuệ nhân tạo', 'gioi-thieu-ve-tri-tue-nhan-tao', '<p>&nbsp;</p>\r\n\r\n<h2><strong>H&agrave;nh tr&igrave;nh bắt đầu</strong></h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><strong>Blog</strong> kh&ocirc;ng chỉ l&agrave; nơi chia sẻ cảm x&uacute;c m&agrave; c&ograve;n l&agrave; h&agrave;nh tr&igrave;nh ghi lại những dấu ấn trong cuộc sống.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote><strong>&quot;Viết để hiểu m&igrave;nh hơn, viết để kết nối với thế giới.&quot;</strong></blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Bắt đầu từ những b&agrave;i viết đầu ti&ecirc;n, t&ocirc;i học được c&aacute;ch <em>ki&ecirc;n nhẫn</em> v&agrave; <em>chia sẻ ch&acirc;n th&agrave;nh</em>.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"Blog journey\" src=\"uploads/blog1.jpg\" /></strong></p>\r\n', '1760402963.png', 'Giới thiệu trí tuệ nhân tạo', 'Tìm hiểu khái niệm AI và ứng dụng trong đời sống.', 1, '2025-10-12 08:22:16', 1, 1),
(16, 'Tác động của mạng xã hội đến giới trẻ', 'tac-dong-cua-mang-xa-hoi-den-gioi-tre', '<p>Mạng x&atilde; hội c&oacute; ảnh hưởng mạnh mẽ đến <em>tư duy v&agrave; h&agrave;nh vi</em> của giới trẻ hiện nay.</p>\r\n', 'social.jpg', 'Tác động của mạng xã hội', 'Phân tích mặt tích cực và tiêu cực của mạng xã hội.', 1, '2025-10-12 08:22:16', 1, 1),
(17, 'Cách tối ưu SEO cho website cá nhân', 'cach-toi-uu-seo-cho-website-ca-nhan', '<p>SEO gi&uacute;p website của bạn hiển thị tr&ecirc;n Google. H&atilde;y bắt đầu với <strong>meta tag, từ kh&oacute;a v&agrave; tốc độ tải trang</strong>.</p>\r\n', '1763661513.jpg', 'Tối ưu SEO website', 'Hướng dẫn SEO cơ bản cho người mới.', 0, '2025-10-12 08:22:16', 1, 1),
(18, 'Top 10 ngôn ngữ lập trình được ưa chuộng', 'top-10-ngon-ngu-lap-trinh-duoc-ua-chuong', '<ul><li>Python</li><li>JavaScript</li><li>Java</li><li>C#</li><li>PHP</li></ul>', 'coding.jpg', 'Top ngôn ngữ lập trình ưa chuộng', 'Danh sách 10 ngôn ngữ lập trình phổ biến nhất năm nay.', 1, '2025-10-12 08:22:16', 1, 1),
(19, 'Tại sao nên học lập trình sớm?', 'tai-sao-nen-hoc-lap-trinh-som', '<p>Học lập trình giúp trẻ phát triển <b>tư duy logic</b> và khả năng giải quyết vấn đề.</p>', 'kidcode.jpg', 'Học lập trình sớm', 'Lợi ích của việc học lập trình từ nhỏ.', 0, '2025-10-12 08:22:16', 1, 1),
(20, 'Cách bảo mật tài khoản mạng xã hội', 'cach-bao-mat-tai-khoan-mang-xa-hoi', '<p>Bạn nên bật <strong>xác thực hai lớp</strong> và tránh dùng mật khẩu trùng nhau.</p>', 'security.jpg', 'Bảo mật tài khoản mạng xã hội', 'Hướng dẫn tăng cường bảo mật cá nhân trên Facebook, Instagram,...', 0, '2025-10-12 08:22:16', 1, 1),
(21, 'Hướng dẫn cài đặt PHP và XAMPP', 'huong-dan-cai-dat-php-va-xampp', '<p>Bài viết giúp bạn <b>cài đặt môi trường PHP</b> để bắt đầu học lập trình web.</p>', 'php.jpg', 'Hướng dẫn cài đặt PHP', 'Cách cài đặt và chạy PHP bằng XAMPP trên máy tính.', 0, '2025-10-12 08:22:16', 1, 1),
(22, 'Tương lai của công việc với AI', 'tuong-lai-cua-cong-viec-voi-ai', '<p>AI đang thay đổi cách chúng ta làm việc, từ tự động hóa đến sáng tạo nội dung.</p>', 'futureai.jpg', 'Tương lai công việc và AI', 'AI sẽ ảnh hưởng thế nào đến công việc trong 10 năm tới?', 0, '2025-10-12 08:22:16', 1, 1);
INSERT INTO `posts` (`id`, `name`, `slug`, `description`, `image`, `meta_title`, `meta_description`, `status`, `created_at`, `category_id`, `user_id`) VALUES
(24, 'Hướng dẫn sử dụng HTML cơ bản', 'huong-dan-su-dung-html-co-ban', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.<br />\r\n<br />\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.<br />\r\n<br />\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>\r\n\r\n<h3>Make better business</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.<br />\r\n<br />\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>\r\n\r\n<blockquote>\r\n<p>&quot;You&rsquo;ve got to get up every morning with determination if you&rsquo;re going to go to bed with satisfaction.&quot;</p>\r\n</blockquote>\r\n\r\n<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.<br />\r\n<br />\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>\r\n\r\n<h3>The Dreamy Factors</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.<br />\r\n<br />\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>\r\n\r\n<p><img src=\"data:image/png;base64,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\" style=\"float:right; height:200px; width:404px\" /></p>\r\n', '1760403004.png', 'Hướng dẫn HTML cơ bản', '', 0, '2025-10-12 08:53:46', 1, 1);
INSERT INTO `posts` (`id`, `name`, `slug`, `description`, `image`, `meta_title`, `meta_description`, `status`, `created_at`, `category_id`, `user_id`) VALUES
(25, 'Trí Tuệ Nhân Tạo', 'tri-tue-nhan-tao', '<p>&nbsp;</p>\r\n\r\n<h1>Tr&iacute; Tuệ Nh&acirc;n Tạo: Cuộc C&aacute;ch Mạng Đang Diễn Ra Trong Thế Giới C&ocirc;ng Nghệ</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Trong những năm gần đ&acirc;y, Tr&iacute; Tuệ Nh&acirc;n Tạo (AI) đ&atilde; chuyển từ một kh&aacute;i niệm khoa học viễn tưởng trở th&agrave;nh một phần kh&ocirc;ng thể thiếu trong cuộc sống h&agrave;ng ng&agrave;y v&agrave; nền kinh tế to&agrave;n cầu. Từ những trợ l&yacute; ảo th&ocirc;ng minh tr&ecirc;n điện thoại đến c&aacute;c hệ thống tự l&aacute;i v&agrave; ph&acirc;n t&iacute;ch dữ liệu phức tạp, AI đang định h&igrave;nh lại c&aacute;ch ch&uacute;ng ta l&agrave;m việc, học tập v&agrave; tương t&aacute;c với thế giới xung quanh.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>AI l&agrave; g&igrave;?</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tr&iacute; Tuệ Nh&acirc;n Tạo (AI) l&agrave; một lĩnh vực của khoa học m&aacute;y t&iacute;nh tập trung v&agrave;o việc tạo ra c&aacute;c m&aacute;y m&oacute;c c&oacute; khả năng thực hiện c&aacute;c t&aacute;c vụ đ&ograve;i hỏi tr&iacute; th&ocirc;ng minh của con người. Điều n&agrave;y bao gồm khả năng học hỏi, giải quyết vấn đề, nhận diện mẫu, hiểu ng&ocirc;n ngữ tự nhi&ecirc;n v&agrave; thậm ch&iacute; l&agrave; s&aacute;ng tạo.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>AI kh&ocirc;ng phải l&agrave; một c&ocirc;ng nghệ đơn lẻ m&agrave; l&agrave; một tập hợp c&aacute;c kỹ thuật v&agrave; phương ph&aacute;p kh&aacute;c nhau, bao gồm:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Học m&aacute;y (Machine Learning - ML):</strong> Cho ph&eacute;p m&aacute;y t&iacute;nh học từ dữ liệu m&agrave; kh&ocirc;ng cần được lập tr&igrave;nh r&otilde; r&agrave;ng.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Học s&acirc;u (Deep Learning - DL):</strong> Một nh&aacute;nh của Học m&aacute;y sử dụng mạng nơ-ron nh&acirc;n tạo với nhiều lớp để m&ocirc; h&igrave;nh h&oacute;a c&aacute;c mẫu phức tạp trong dữ liệu.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Xử l&yacute; ng&ocirc;n ngữ tự nhi&ecirc;n (Natural Language Processing - NLP):</strong> Gi&uacute;p m&aacute;y t&iacute;nh hiểu, giải th&iacute;ch v&agrave; tạo ra ng&ocirc;n ngữ của con người.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Thị gi&aacute;c m&aacute;y t&iacute;nh (Computer Vision):</strong> Cho ph&eacute;p m&aacute;y t&iacute;nh &quot;nh&igrave;n&quot; v&agrave; diễn giải h&igrave;nh ảnh v&agrave; video.</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n&nbsp; &nbsp; <img alt=\"Neural Network\" src=\"https://images.unsplash.com/photo-1596558450254-f57161b9e25d?q=80&amp;w=1770&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\" /><br />\r\n&nbsp; &nbsp;</p>\r\n\r\n<p>Mạng nơ-ron nh&acirc;n tạo l&agrave; nền tảng của nhiều ứng dụng AI.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Ứng dụng Đa dạng của Tr&iacute; Tuệ Nh&acirc;n Tạo</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>AI đang được triển khai trong hầu hết mọi lĩnh vực, mang lại hiệu quả v&agrave; đổi mới đ&aacute;ng kinh ngạc:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Y tế</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Chẩn đo&aacute;n bệnh:</strong> AI gi&uacute;p ph&acirc;n t&iacute;ch h&igrave;nh ảnh y tế (X-quang, MRI) nhanh v&agrave; ch&iacute;nh x&aacute;c hơn, hỗ trợ ph&aacute;t hiện sớm bệnh ung thư, tim mạch.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Ph&aacute;t triển thuốc:</strong> R&uacute;t ngắn thời gian nghi&ecirc;n cứu v&agrave; ph&aacute;t triển thuốc mới bằng c&aacute;ch m&ocirc; phỏng v&agrave; dự đo&aacute;n hiệu quả của c&aacute;c hợp chất.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Y học c&aacute; nh&acirc;n h&oacute;a:</strong> Tạo ra ph&aacute;c đồ điều trị t&ugrave;y chỉnh dựa tr&ecirc;n dữ liệu di truyền v&agrave; t&igrave;nh trạng sức khỏe của từng bệnh nh&acirc;n.</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Giao th&ocirc;ng vận tải</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Xe tự l&aacute;i:</strong> C&aacute;c hệ thống AI xử l&yacute; dữ liệu từ camera, radar v&agrave; cảm biến để xe c&oacute; thể tự điều hướng an to&agrave;n.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Tối ưu h&oacute;a giao th&ocirc;ng:</strong> Giảm tắc nghẽn bằng c&aacute;ch ph&acirc;n t&iacute;ch lưu lượng giao th&ocirc;ng v&agrave; điều chỉnh đ&egrave;n t&iacute;n hiệu.</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n&nbsp; &nbsp; <img alt=\"Self-driving car\" src=\"https://images.unsplash.com/photo-1596001004652-9b2f6f404df2?q=80&amp;w=1770&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\" /><br />\r\n&nbsp; &nbsp;</p>\r\n\r\n<p>Xe tự l&aacute;i l&agrave; một ứng dụng ti&ecirc;u biểu của AI.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Kinh doanh v&agrave; T&agrave;i ch&iacute;nh</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Dịch vụ kh&aacute;ch h&agrave;ng:</strong> Chatbot v&agrave; trợ l&yacute; ảo AI xử l&yacute; y&ecirc;u cầu kh&aacute;ch h&agrave;ng 24/7.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Ph&aacute;t hiện gian lận:</strong> Ph&acirc;n t&iacute;ch giao dịch để nhận diện c&aacute;c hoạt động đ&aacute;ng ngờ v&agrave; ngăn chặn gian lận.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Ph&acirc;n t&iacute;ch thị trường:</strong> Dự đo&aacute;n xu hướng thị trường v&agrave; đưa ra khuyến nghị đầu tư.</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Gi&aacute;o dục</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Học tập c&aacute; nh&acirc;n h&oacute;a:</strong> AI điều chỉnh nội dung v&agrave; tốc độ học tập ph&ugrave; hợp với từng học sinh.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Đ&aacute;nh gi&aacute; tự động:</strong> Chấm điểm b&agrave;i kiểm tra, b&agrave;i luận v&agrave; cung cấp phản hồi.</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Những Th&aacute;ch thức v&agrave; Tương lai của AI</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Mặc d&ugrave; AI mang lại nhiều lợi &iacute;ch, nhưng cũng đặt ra những th&aacute;ch thức đ&aacute;ng kể:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Đạo đức v&agrave; c&ocirc;ng bằng:</strong> Đảm bảo AI kh&ocirc;ng g&acirc;y ra th&agrave;nh kiến, ph&acirc;n biệt đối xử v&agrave; được sử dụng một c&aacute;ch c&oacute; tr&aacute;ch nhiệm.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Bảo mật dữ liệu v&agrave; quyền ri&ecirc;ng tư:</strong> AI cần một lượng lớn dữ liệu, đặt ra vấn đề về c&aacute;ch bảo vệ th&ocirc;ng tin nhạy cảm.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Việc l&agrave;m:</strong> Lo ngại về việc AI c&oacute; thể thay thế một số c&ocirc;ng việc của con người.</li>\r\n	<br />\r\n	<li>&nbsp; &nbsp;</li>\r\n	<li><strong>Kiểm so&aacute;t v&agrave; Giải th&iacute;ch:</strong> L&agrave;m thế n&agrave;o để hiểu v&agrave; kiểm so&aacute;t c&aacute;c quyết định của AI, đặc biệt l&agrave; với c&aacute;c hệ thống học s&acirc;u phức tạp.</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Tuy nhi&ecirc;n, tương lai của AI hứa hẹn nhiều tiềm năng. Ch&uacute;ng ta c&oacute; thể mong đợi những tiến bộ trong AI tổng qu&aacute;t (AGI) &ndash; AI c&oacute; khả năng thực hiện bất kỳ nhiệm vụ tr&iacute; tuệ n&agrave;o m&agrave; con người c&oacute; thể l&agrave;m, c&ugrave;ng với c&aacute;c ứng dụng đột ph&aacute; hơn nữa trong mọi lĩnh vực của cuộc sống.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote>&quot;Tr&iacute; Tuệ Nh&acirc;n Tạo sẽ kh&ocirc;ng thay thế con người, m&agrave; n&oacute; sẽ tăng cường khả năng của con người.&quot; - Satya Nadella, CEO Microsoft.</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sự ph&aacute;t triển của AI kh&ocirc;ng chỉ l&agrave; một bước tiến về c&ocirc;ng nghệ m&agrave; c&ograve;n l&agrave; một cuộc c&aacute;ch mạng về tư duy, đ&ograve;i hỏi sự hợp t&aacute;c giữa c&aacute;c nh&agrave; khoa học, kỹ sư, ch&iacute;nh phủ v&agrave; cộng đồng để đảm bảo AI được ph&aacute;t triển v&agrave; sử dụng v&igrave; lợi &iacute;ch tốt nhất của nh&acirc;n loại.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\n&nbsp; &nbsp; <img alt=\"AI and Human Collaboration\" src=\"https://images.unsplash.com/photo-1620712948622-c31994a5c9a4?q=80&amp;w=1770&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D\" /><br />\r\n&nbsp; &nbsp;</p>\r\n\r\n<p>Tương lai của AI nằm ở sự hợp t&aacute;c giữa con người v&agrave; m&aacute;y m&oacute;c.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '1763661417.jpg', '', '', 0, '2025-11-20 16:59:58', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_reactions`
--

CREATE TABLE `post_reactions` (
  `source_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reaction` enum('like','dislike') NOT NULL,
  `reacted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post_reactions`
--

INSERT INTO `post_reactions` (`source_id`, `user_id`, `reaction`, `reacted_at`) VALUES
(13, 1, 'like', '2025-10-26 07:22:15'),
(16, 1, 'like', '2025-10-26 07:22:34'),
(17, 1, 'like', '2025-11-24 03:41:28'),
(25, 1, 'like', '2025-11-20 17:55:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `socials`
--

CREATE TABLE `socials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `socials`
--

INSERT INTO `socials` (`id`, `user_id`, `facebook`, `github`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 1, 'fb.com', 'https://github.com/tngmait12', '', '2025-11-24 01:27:11', '2025-11-24 01:27:51'),
(2, 2, NULL, NULL, NULL, '2025-11-24 01:27:11', '2025-11-24 01:27:11'),
(3, 3, NULL, NULL, NULL, '2025-11-24 01:27:11', '2025-11-24 01:27:11'),
(4, 5, NULL, NULL, NULL, '2025-11-24 01:27:11', '2025-11-24 01:27:11'),
(5, 6, NULL, NULL, NULL, '2025-11-24 01:27:11', '2025-11-24 01:27:11'),
(6, 10, NULL, NULL, NULL, '2025-11-24 01:27:11', '2025-11-24 01:27:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=user, 1=author, 2=admin',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `role_as`, `status`, `created_at`, `gender`, `phone`, `image`, `verification_token`, `email_verified_at`, `reset_token`, `reset_token_expires`) VALUES
(1, 'Truong Vu', 'Tong Mai', 'tongmaitruongvu11@gmail.com', '$2y$10$moojnNqL3gF4UrYh9/tKfeKm6Y.Q8r3jXwPW0z4pfCumUUkMw7E86', 1, 0, '2025-09-30 15:04:05', 'male', '0382345491', '1763948746.jpg', NULL, NULL, NULL, NULL),
(2, 'Trường', 'Mai', 'tongmaitruongvu123@gmail.com', '$2y$10$7kvJCNVDl5x8mCOrjd14HunLsm.cHHrzIxhYLVGBtRNXZ5iX3cmDy', 0, 1, '2025-09-30 15:08:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Nguyen', 'The Ving', 'ntv1@gmail.com', '$2y$10$skf1MLjgc8UwGQJGUM05k.Oabx5SElulkz/nemkBqpxEl9OKU7uZe', 0, 2, '2025-10-02 01:35:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Trường', 'Mai', 'tongmaitruongvu1@gmail.com', '$2y$10$pyasEwRg6a7NCQCEC2InaObxE5lNLmjIJ.YOFg7f3.kNEwK7DKqXW', 0, 0, '2025-10-26 07:24:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Ma', 'Yasuo', 'tongmaitruongvu19@gmail.com', '$2y$10$H0PeWQrUaeFcUaIxnCNJ5ujPXuPhgYSIe2eBe3yIddbv9yZdHOlha', 1, 0, '2025-10-26 07:56:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Trường', 'Mai', 'vu.tmt.64cntt@ntu.edu.vn', '$2y$10$oOa5t9aTbDXCKHl34sfs7uLl.UzFD3fiQqFEaBL.dAq/w4JNhAJ9W', 0, 0, '2025-11-17 05:51:18', NULL, NULL, NULL, NULL, '2025-11-16 23:51:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_bookmarks`
--

CREATE TABLE `user_bookmarks` (
  `user_id` int(11) NOT NULL COMMENT 'ID của người dùng đang lưu bài viết',
  `post_id` int(11) NOT NULL COMMENT 'ID của bài viết được lưu',
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_bookmarks`
--

INSERT INTO `user_bookmarks` (`user_id`, `post_id`, `saved_at`) VALUES
(1, 17, '2025-11-24 03:41:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `reply` (`reply`);

--
-- Chỉ mục cho bảng `comment_reactions`
--
ALTER TABLE `comment_reactions`
  ADD PRIMARY KEY (`source_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD PRIMARY KEY (`source_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_social` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`reply`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comment_reactions`
--
ALTER TABLE `comment_reactions`
  ADD CONSTRAINT `comment_reactions_ibfk_1` FOREIGN KEY (`source_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_reactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD CONSTRAINT `post_reactions_ibfk_1` FOREIGN KEY (`source_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_reactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `socials`
--
ALTER TABLE `socials`
  ADD CONSTRAINT `fk_user_social` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_bookmarks`
--
ALTER TABLE `user_bookmarks`
  ADD CONSTRAINT `user_bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_bookmarks_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 02, 2025 lúc 12:35 PM
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
  `navbar_status` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0 COMMENT '0: visible; 1: hidden; 2:deleted',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `navbar_status`, `status`, `created_at`) VALUES
(2, 'PHP', 'php-subject', '<p>PHP l&agrave; một ng&ocirc;n ngữ lập tr&igrave;nh ph&iacute;a Server d&ugrave;ng để x&acirc;y dựng c&aacute;c ứng dụng Website. Điểm mạnh của PHP l&agrave; t&iacute;nh cộng đồng của n&oacute; cao, nghĩa l&agrave; tr&ecirc;n thế giới c&oacute; kh&aacute; nhiều lập tr&igrave;nh vi&ecirc;n sử dụng PHP để x&acirc;y dựng dự &aacute;n cho ri&ecirc;ng họ hoặc cho kh&aacute;ch h&agrave;ng của họ. Ngo&agrave;i ra một điểm mạnh nữa của PHP đ&oacute; l&agrave; c&oacute; kh&aacute; nhiều CMS, Framework được x&acirc;y dựng từ PHP gi&uacute;p r&uacute;t gọn qu&aacute; tr&igrave;nh tạo một website, v&igrave; vậy c&oacute; kh&aacute; nhiều lập tr&igrave;nh vi&ecirc;n lựa chọn ng&ocirc;n ngữ n&agrave;y.</p>\r\n', 'PHP Language', 1, 1, '2025-10-02 08:17:00'),
(6, 'PHP Ajax', 'php-ajax', '<p>Ajax l&agrave; một kỹ thuật thường sử dụng trong c&aacute;c ứng dụng website 2.0 bởi v&igrave; n&oacute; gi&uacute;p c&aacute;c thao t&aacute;c tr&ecirc;n website trở n&ecirc;n nhanh v&agrave; chuy&ecirc;n nghiệp hơn. Đối với một PHP developer m&agrave; kh&ocirc;ng sử dụng được kỹ thuật n&agrave;y th&igrave; quả thật l&agrave; bất lợi khi đi xin việc l&agrave;m đấy.</p>\r\n', 'PHP Advanced', 0, 1, '2025-12-02 10:26:22'),
(8, 'Laravel Framework', 'laravel-framework', '<p>Hướng dẫn lập trình với Laravel Framework dành cho người mới bắt đầu.</p>', 'Học Laravel Framework', 1, 1, '2025-12-02 10:55:00'),
(9, 'MySQL Database', 'mysql-database', '<p>Kiến thức về quản trị cơ sở dữ liệu MySQL và tối ưu truy vấn.</p>', 'Tài liệu MySQL', 0, 1, '2025-12-02 10:55:00'),
(10, 'Python & AI', 'python-ai', '<p>C&aacute;c b&agrave;i viết về Python v&agrave; ứng dụng trong tr&iacute; tuệ nh&acirc;n tạo.</p>\r\n', 'Python AI Tutorial', 0, 1, '2025-12-02 10:55:00'),
(11, 'Frontend Web', 'frontend-web', '<p>Tổng hợp kiến thức HTML, CSS và JavaScript để xây dựng giao diện web.</p>', 'Học Frontend cơ bản', 0, 1, '2025-12-02 10:55:00'),
(12, 'Góc Dev', 'goc-dev', '<p>Chia sẻ kinh nghiệm thực tập, phỏng vấn và đời sống lập trình viên.</p>', 'Blog tâm sự Dev', 1, 1, '2025-12-02 10:55:00');

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
(13, 27, 1, NULL, NULL, 'bài viết thật hữu ích', '2025-12-02 10:59:26'),
(14, 27, 11, 13, 13, 'Agree', '2025-12-02 11:01:44');

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
(27, 'Ajax là gì? Viết chương trình Ajax bằng Javascript', 'what-is-ajax', '<p>Trong b&agrave;i n&agrave;y ch&uacute;ng ta sẽ t&igrave;m hiểu về Ajax, một kỹ thuật d&ugrave;ng để xử l&yacute; c&aacute;c chức năng tr&ecirc;n Website. Trước đ&acirc;y Ajax l&agrave; một kỹ thuật n&acirc;ng cao, nhưng kể từ khi c&oacute; NodeJS th&igrave; n&oacute; trở n&ecirc;n tầm thường trong mắt lập tr&igrave;nh vi&ecirc;n.</p>\r\n\r\n<p>Tuy nhi&ecirc;n, d&ugrave; sao đi nữa th&igrave; việc sử dụng Ajax sẽ gi&uacute;p website hoạt động trơn tru, kh&aacute;ch h&agrave;ng truy cập v&agrave;o sẽ cảm thấy tốc độ xử l&yacute; rất nhanh n&ecirc;n rất th&acirc;n thiện với người d&ugrave;ng. Vậy Ajax l&agrave; g&igrave; th&igrave; ch&uacute;ng ta c&ugrave;ng t&igrave;m hiểu ngay nh&eacute;.</p>\r\n\r\n<h2>1. Ajax l&agrave; g&igrave;?</h2>\r\n\r\n<p>Ajax (<em>Asynchronous JavaScript and XML</em>) l&agrave; một kỹ thuật gi&uacute;p tạo ra trang&nbsp;<a href=\"https://freetuts.net/web-dong-la-gi-web-tinh-la-gi-343.html\" target=\"_blank\">Web động</a>&nbsp;m&agrave; ho&agrave;n to&agrave;n kh&ocirc;ng reload lại to&agrave;n bộ trang. Đối với c&ocirc;ng nghệ web hiện nay th&igrave;&nbsp;<code>ajax</code>&nbsp;kh&ocirc;ng thể thiếu, n&oacute; l&agrave; một phần l&agrave;m n&ecirc;n sự sinh động cho website. C&ograve;n đối với ng&agrave;nh SEO th&igrave; khi sử dụng&nbsp;<code>ajax</code>&nbsp;lại kh&ocirc;ng tốt, tại v&igrave; bot Google sẽ kh&ocirc;ng index được. Nhưng thực tế ta c&oacute; c&aacute;ch khắc phục v&agrave; vấn đề n&agrave;y ta sẽ t&igrave;m hiểu n&oacute; ở một b&agrave;i kh&aacute;c.</p>\r\n\r\n<p>Ajax được viết bằng ng&ocirc;n ngữ&nbsp;<code>Javascript</code>&nbsp;n&ecirc;n n&oacute; chạy tr&ecirc;n client, tức l&agrave; mỗi tr&igrave;nh duyệt sẽ chạy độc lập ho&agrave;n to&agrave;n kh&ocirc;ng ảnh hưởng lẫn nhau. Hiện nay c&oacute; nhiều thư viện javascript như [<em>jQuery</em>], [<em>Angular</em>], [<em>React JS</em>] đều hỗ trợ kỹ thuật n&agrave;y nhằm gi&uacute;p ch&uacute;ng ta thao t&aacute;c dễ d&agrave;ng hơn. Nhưng t&ocirc;i muốn c&aacute;c bạn nắm r&otilde; bản chất của&nbsp;<code>ajax</code>&nbsp;n&ecirc;n trong b&agrave;i n&agrave;y ch&uacute;ng ta sẽ code thuần javascript 100% nh&eacute;.</p>\r\n\r\n<h2>2. Viết chương tr&igrave;nh Ajax Javascript</h2>\r\n\r\n<p>Ch&uacute;ng ta viết một chương tr&igrave;nh đơn giản đ&oacute; l&agrave; lấy nội dung trả về của một file PHP, c&aacute;c bước thực hiện như sau:</p>\r\n\r\n<h3>Tạo file index.php để xử l&yacute; ajax</h3>\r\n\r\n<p>C&aacute;c bạn tạo một project v&agrave; tạo một file&nbsp;<code>index.php</code>&nbsp;với nội dung nhu sau:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>1</p>\r\n\r\n			<p>2</p>\r\n\r\n			<p>3</p>\r\n\r\n			<p>4</p>\r\n\r\n			<p>5</p>\r\n\r\n			<p>6</p>\r\n\r\n			<p>7</p>\r\n\r\n			<p>8</p>\r\n\r\n			<p>9</p>\r\n\r\n			<p>10</p>\r\n\r\n			<p>11</p>\r\n\r\n			<p>12</p>\r\n\r\n			<p>13</p>\r\n\r\n			<p>14</p>\r\n\r\n			<p>15</p>\r\n\r\n			<p>16</p>\r\n\r\n			<p>17</p>\r\n\r\n			<p>18</p>\r\n			</td>\r\n			<td>\r\n			<p><code>&lt;!DOCTYPE html&gt;</code></p>\r\n\r\n			<p><code>&lt;</code><code>html</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>head</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>title</code><code>&gt;&lt;/</code><code>title</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>meta</code> <code>http-equiv</code><code>=</code><code>&quot;Content-Type&quot;</code> <code>content</code><code>=</code><code>&quot;text/html; charset=UTF-8&quot;</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>script</code> <code>language</code><code>=</code><code>&quot;javascript&quot;</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>function load_ajax(){</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>alert(&#39;Clicked&#39;);</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>}</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>script</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>head</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>body</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>div</code> <code>id</code><code>=</code><code>&quot;result&quot;</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>Nội dung ajax sẽ được load ở đ&acirc;y</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>div</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;</code><code>input</code> <code>type</code><code>=</code><code>&quot;button&quot;</code> <code>name</code><code>=</code><code>&quot;clickme&quot;</code> <code>id</code><code>=</code><code>&quot;clickme&quot;</code> <code>onclick</code><code>=</code><code>&quot;load_ajax()&quot;</code> <code>value</code><code>=</code><code>&quot;Click Me&quot;</code><code>/&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/</code><code>body</code><code>&gt;</code></p>\r\n\r\n			<p><code>&lt;/</code><code>html</code><code>&gt;</code></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Trong đ&oacute; t&ocirc;i đ&atilde; tạo một thẻ&nbsp;<code>div</code>&nbsp;d&ugrave;ng để chứa nội dung&nbsp;<strong>load ajax</strong>, một button trong đ&oacute; c&oacute; sự kiện&nbsp;<strong>onclick</strong>, sự kiện n&agrave;y sẽ gọi đến h&agrave;m&nbsp;<strong>load_ajax</strong>. C&aacute;c bạn test thử bằng c&aacute;ch chạy file l&ecirc;n v&agrave; click thử v&agrave;o button, nếu n&oacute;&nbsp;<code>alert</code>&nbsp;với nọi dung l&agrave; &quot;<strong><em>clicked</em></strong>&quot; tức l&agrave; ta tạo file th&agrave;nh c&ocirc;ng rồi đấy.</p>\r\n\r\n<h3>Tạo file trả về nội dung ajax</h3>\r\n\r\n<p>Bạn tạo một file&nbsp;<a href=\"https://freetuts.net/hoc-php\" target=\"_blank\">php&nbsp;</a>với t&ecirc;n l&agrave; t&ecirc;n l&agrave;&nbsp;<code>result.php</code>&nbsp;với nội dung như sau:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>1</p>\r\n\r\n			<p>2</p>\r\n\r\n			<p>3</p>\r\n\r\n			<p>4</p>\r\n\r\n			<p>5</p>\r\n			</td>\r\n			<td>\r\n			<p><code>&lt;?php </code></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><code>echo</code> <code>&#39;Đ&acirc;y l&agrave; nội dung trả về&#39;</code><code>;</code></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p><code>?&gt;</code></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<h3>Viết code gọi ajax lấy nội dung từ file result</h3>\r\n\r\n<p>B&acirc;y giờ ta sẽ viết h&agrave;m xủ l&yacute;&nbsp;<strong>gọi ajax</strong>&nbsp;để lấy nội dung từ file&nbsp;<code>result.php</code>&nbsp;v&agrave; g&aacute;n nội dung đ&oacute; v&agrave;o thẻ div như khai b&aacute;o ở file&nbsp;<code>index.php</code>&nbsp;tr&ecirc;n. Nội dung như sau:</p>\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p>1</p>\r\n\r\n			<p>2</p>\r\n\r\n			<p>3</p>\r\n\r\n			<p>4</p>\r\n\r\n			<p>5</p>\r\n\r\n			<p>6</p>\r\n\r\n			<p>7</p>\r\n\r\n			<p>8</p>\r\n\r\n			<p>9</p>\r\n\r\n			<p>10</p>\r\n\r\n			<p>11</p>\r\n\r\n			<p>12</p>\r\n\r\n			<p>13</p>\r\n\r\n			<p>14</p>\r\n\r\n			<p>15</p>\r\n\r\n			<p>16</p>\r\n\r\n			<p>17</p>\r\n\r\n			<p>18</p>\r\n\r\n			<p>19</p>\r\n\r\n			<p>20</p>\r\n\r\n			<p>21</p>\r\n\r\n			<p>22</p>\r\n\r\n			<p>23</p>\r\n\r\n			<p>24</p>\r\n\r\n			<p>25</p>\r\n\r\n			<p>26</p>\r\n\r\n			<p>27</p>\r\n\r\n			<p>28</p>\r\n\r\n			<p>29</p>\r\n\r\n			<p>30</p>\r\n\r\n			<p>31</p>\r\n\r\n			<p>32</p>\r\n\r\n			<p>33</p>\r\n\r\n			<p>34</p>\r\n\r\n			<p>35</p>\r\n\r\n			<p>36</p>\r\n\r\n			<p>37</p>\r\n\r\n			<p>38</p>\r\n\r\n			<p>39</p>\r\n\r\n			<p>40</p>\r\n\r\n			<p>41</p>\r\n\r\n			<p>42</p>\r\n\r\n			<p>43</p>\r\n\r\n			<p>44</p>\r\n\r\n			<p>45</p>\r\n\r\n			<p>46</p>\r\n\r\n			<p>47</p>\r\n\r\n			<p>48</p>\r\n\r\n			<p>49</p>\r\n\r\n			<p>50</p>\r\n\r\n			<p>51</p>\r\n\r\n			<p>52</p>\r\n\r\n			<p>53</p>\r\n			</td>\r\n			<td>\r\n			<p><code>&lt;!DOCTYPE html&gt;</code></p>\r\n\r\n			<p><code>&lt;html&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;head&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;title&gt;&lt;/title&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;meta http-equiv=</code><code>&quot;Content-Type&quot;</code> <code>content=</code><code>&quot;text/html; charset=UTF-8&quot;</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;script language=</code><code>&quot;javascript&quot;</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>function</code> <code>load_ajax()</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>{</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// Tạo một biến lưu trữ đối tượng XML HTTP. Đối tượng n&agrave;y</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// t&ugrave;y thuộc v&agrave;o tr&igrave;nh duyệt browser ta sử dụng n&ecirc;n phải kiểm</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// tra như bước b&ecirc;n dưới</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>var</code> <code>xmlhttp;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>&nbsp;</p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// Nếu tr&igrave;nh duyệt l&agrave;&nbsp; IE7+, Firefox, Chrome, Opera, Safari</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>if</code> <code>(window.XMLHttpRequest)</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>{</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>xmlhttp = </code><code>new</code> <code>XMLHttpRequest();</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>}</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// Nếu tr&igrave;nh duyệt l&agrave; IE6, IE5</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>else</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>{</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>xmlhttp = </code><code>new</code> <code>ActiveXObject(</code><code>&quot;Microsoft.XMLHTTP&quot;</code><code>);</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>}</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>&nbsp;</p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// Khởi tạo một h&agrave;m gửi ajax</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>xmlhttp.onreadystatechange = </code><code>function</code><code>()</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>{</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// Nếu đối tượng XML HTTP trả về với hai th&ocirc;ng số b&ecirc;n dưới th&igrave; mọi chuyện </code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// coi như th&agrave;nh c&ocirc;ng</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>if</code> <code>(xmlhttp.readyState == 4 &amp;&amp; xmlhttp.status == 200)</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>{</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// Sau khi th&agrave;nh c&ocirc;ng tiến h&agrave;nh thay đổi nội dung của thẻ div, nội dung</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// ở đ&acirc;y ch&iacute;nh l&agrave; </code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>document.getElementById(</code><code>&quot;result&quot;</code><code>).innerHTML = xmlhttp.responseText;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>}</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>};</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>&nbsp;</p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// Khai b&aacute;o với phương thức GET, v&agrave; url ch&iacute;nh l&agrave; file result.php</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>xmlhttp.open(</code><code>&quot;GET&quot;</code><code>, </code><code>&quot;result.php&quot;</code><code>, </code><code>true</code><code>);</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code>&nbsp;</p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// Cuối c&ugrave;ng l&agrave; Gửi ajax, sau khi gọi h&agrave;m send th&igrave; function vừa tạo ở</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>// tr&ecirc;n (onreadystatechange) sẽ được chạy</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>xmlhttp.send();</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>}</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/script&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/head&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;body&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;div id=</code><code>&quot;result&quot;</code><code>&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>Nội dung ajax sẽ được load ở đ&acirc;y</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/div&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;input type=</code><code>&quot;button&quot;</code> <code>name=</code><code>&quot;clickme&quot;</code> <code>id=</code><code>&quot;clickme&quot;</code> <code>onclick=</code><code>&quot;load_ajax()&quot;</code> <code>value=</code><code>&quot;Click Me&quot;</code><code>/&gt;</code></p>\r\n\r\n			<p><code>&nbsp;&nbsp;&nbsp;&nbsp;</code><code>&lt;/body&gt;</code></p>\r\n\r\n			<p><code>&lt;/html&gt;</code></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Như vậy l&agrave; ta c&oacute; to&agrave;n bộ 2 file l&agrave;&nbsp;<code>index.php</code>&nbsp;v&agrave;&nbsp;<code>result.php</code>. Trong đ&oacute; file&nbsp;<code>index.php</code>&nbsp;t&ocirc;i viết h&agrave;m xử l&yacute; gọi ajax v&agrave; lấy kết quả đổ v&agrave;o thẻ&nbsp;<code>div#result</code>. C&ograve;n file&nbsp;<code>result.php</code>&nbsp;sẽ&nbsp;<code>echo</code>&nbsp;một c&acirc;u ch&agrave;o với nội dung l&agrave; &quot;<em>Đ&acirc;y l&agrave; nội dung trả về</em>&#39;.</p>\r\n\r\n<p>B&acirc;y giờ c&aacute;c bạn click v&agrave;o&nbsp;<code>button</code>&nbsp;để xem kết quả nh&eacute;, nếu mọi chuyện ok th&igrave; thẻ&nbsp;<code>div</code>&nbsp;sẽ bị thay đổi nội dung ch&iacute;nh bằng nội dung trong file&nbsp;<code>result.php</code>. C&aacute;c bạn c&oacute; thể thay đổi nội dung trong file&nbsp;<code>result.php</code>&nbsp;để test.</p>\r\n\r\n<p><strong>T&oacute;m lại ta c&oacute; c&aacute;c bước tạo một ứng dụng ajax như sau:</strong></p>\r\n\r\n<ul>\r\n	<li>Tạo&nbsp;<code>file1.php</code>&nbsp;hiển thị ra tr&igrave;nh duyệt</li>\r\n	<li>Tạo&nbsp;<code>file2.php</code><strong>&nbsp;</strong>trả về kết quả</li>\r\n	<li>Viết xử l&yacute; ajax ở&nbsp;<code>file1.php</code>, đoạn ajax sẽ gọi đến&nbsp;<code>file2.php</code>&nbsp;để lấy nội dung sau đ&oacute; xử l&yacute; theo y&ecirc;u cầu.</li>\r\n</ul>\r\n\r\n<p>Như vậy ta đ&atilde; biết ajax l&agrave; g&igrave; rồi nhỉ? T&ocirc;i th&igrave; t&ocirc;i chưa biết n&oacute; l&agrave; g&igrave;</p>\r\n', '1764671449.jpg', 'PHP AJax', 'Trong bài này chúng ta chỉ tìm hiểu khái niệm ajax là gì và thực hiện ví dụ cách sử dụng ajax trong Javascript thuần, nhưng trong thực tế thì chúng ta thường sử dụng các thư viện Javascript như jQuery để thực hiện nên kể từ bài tiếp theo tôi sẽ không dùng Javascript nữa.', 1, '2025-12-02 10:30:49', 6, 1),
(29, 'Lập trình hướng đối tượng là gì?', 'lap-trinh-oop', '<h2>1. Đối tượng l&agrave; g&igrave;?</h2>\r\n\r\n<p>C&acirc;u hỏi n&agrave;y m&igrave;nh sẽ trả lời dưới dạng nghe v&agrave; hiểu chứ về ng&ocirc;n từ th&igrave; c&oacute; khi n&oacute; lại kh&ocirc;ng đ&uacute;ng n&ecirc;n c&aacute;c bạn bỏ qua nh&eacute;.</p>\r\n\r\n<p><strong>Đối tượng</strong>&nbsp;l&agrave; những sự vật, sự việc m&agrave; n&oacute; c&oacute; những t&iacute;nh chất, đặc t&iacute;nh, h&agrave;nh động giống nhau v&agrave; ta gom g&oacute;p lại th&agrave;nh đối tượng.</p>\r\n\r\n<p>B&agrave;i viết n&agrave;y được đăng tại [free tuts .net]</p>\r\n\r\n<p>Đối tượng ta kh&ocirc;ng thể đếm được v&igrave; n&oacute; chỉ l&agrave; h&igrave;nh tượng đại diện cho một nh&oacute;m c&aacute; thể, nhưng thể hiện của đối tượng th&igrave; ta đếm được. V&iacute; dụ đối tượng trộm cắp ta kh&ocirc;ng đếm được v&igrave; n&oacute; chỉ l&agrave; định danh cho những kẻ ăn trộm nhưng 7 đối tượng trộm cắp th&igrave; lại đếm được v&igrave; 7 con người n&agrave;y l&agrave; h&igrave;nh tượng thể hiện cho đối tượng trộm cắp.</p>\r\n\r\n<p>Ta c&oacute; thể tự định nghĩa những đối tượng kh&ocirc;ng c&oacute; thật để giải quyết b&agrave;i to&aacute;n, v&iacute; dụ như đối tượng người ngo&agrave;i h&agrave;nh tinh, &hellip;</p>\r\n\r\n<h3>C&aacute;c v&iacute; dụ:</h3>\r\n\r\n<p>Động vật ta c&oacute; thể gh&eacute;p ch&uacute;ng th&agrave;nh một đối tượng v&igrave; ch&uacute;ng c&oacute; c&aacute;c đặc t&iacute;nh như mắt, mũi, ch&acirc;n, tay , .. v&agrave; c&aacute;c h&agrave;nh động như đi, ăn, uống nước, &hellip; Mỗi con vật như ch&oacute;, m&egrave;o l&agrave; một thể hiện của đối tượng động vật.</p>\r\n\r\n<p>Nh&agrave; l&agrave; một đối tượng v&igrave; nh&agrave; c&oacute; c&aacute;c đặc t&iacute;nh như chiều cao, mặt tiền mặt hậu, s&acirc;n, &hellip; v&agrave; c&oacute; c&aacute;c h&agrave;nh động như x&acirc;y nh&agrave;, xập nh&agrave; &hellip; Mỗi ng&ocirc;i nh&agrave; l&agrave; một thể hiện của đối tượng Nh&agrave;.</p>\r\n\r\n<p>Sinh Vi&ecirc;n l&agrave; một đối tượng v&igrave; sinh vi&ecirc;n c&oacute; c&aacute;c đặc t&iacute;nh như t&ecirc;n, điểm thi, m&atilde; sinh vi&ecirc;n&hellip;&nbsp; v&agrave; những h&agrave;nh động như đi thi, điểm danh, &hellip; Mỗi sinh vi&ecirc;n l&agrave; một thể hiện của đối tượng Sinh Vi&ecirc;n.</p>\r\n\r\n<p>Xe đạp l&agrave; một đối tượng v&igrave; xe đạp c&oacute; c&aacute;c đặc t&iacute;nh như b&aacute;nh xe, xăm xe, vỏ b&aacute;nh xe v&agrave; c&oacute; những h&agrave;nh động như chạy, dừng, đ&acirc;m v&agrave;o bụi &hellip; :D. Mỗi chiếc xe đạp l&agrave; 1 thể hiện của xe đạp.</p>\r\n\r\n<h2>2. Lập tr&igrave;nh hướng đối tượng l&agrave; g&igrave; ?</h2>\r\n\r\n<p>Lập tr&igrave;nh hướng đối tượng l&agrave; lập tr&igrave;nh hỗ trợ c&ocirc;ng nghệ đối tượng (OOP) gi&uacute;p tăng năng xuất v&agrave; đơn giản h&oacute;a c&ocirc;ng việc x&acirc;y dựng phần mềm, bảo tr&igrave; phần mềm, cho ph&eacute;p lập tr&igrave;nh vi&ecirc;n tập trung v&agrave;o c&aacute;c đối tượng giống như trong thực tế.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>C&oacute; một v&agrave;i &yacute; kiến cho rằng lập tr&igrave;nh hướng đối tượng dễ tiếp thu cho những người mới bắt đầu v&igrave; n&oacute; rất giống với thực tế nhưng bản th&acirc;n t&ocirc;i th&igrave; cho rằng phải nắm c&aacute;c phương ph&aacute;p lập tr&igrave;nh truyền thống th&igrave; l&uacute;c qua lập tr&igrave;nh hướng đối tượng sẽ rất dễ.</p>\r\n\r\n<h2>3. Lập tr&igrave;nh hướng đối tượng bắt nguồn từ đ&acirc;u ?</h2>\r\n\r\n<p>Xuất ph&aacute;t từ c&aacute;c nhược điểm của c&aacute;c&nbsp;<a href=\"https://freetuts.net/phuong-phap-lap-trinh-truyen-thong-26.html\" target=\"_blank\">phương ph&aacute;p lập tr&igrave;nh truyền thống</a>&nbsp;như:</p>\r\n\r\n<ul>\r\n	<li>Kh&ocirc;ng quản l&yacute; được d&ograve;ng code khi c&oacute; sự thay đổi chương tr&igrave;nh, c&oacute; nhiều chương tr&igrave;nh c&ugrave;ng sử dụng một biến chung n&ecirc;n rất nguy hiểm khi chương tr&igrave;nh ng&agrave;y c&agrave;ng lớn.</li>\r\n	<li>Kh&ocirc;ng tiết kiệm được t&agrave;i nguy&ecirc;n con người v&agrave; t&agrave;i nguy&ecirc;n hệ thống, giải thuật gắn liền với dữ liệu n&ecirc;n khi thay đổi dữ liệu th&igrave; giải thuật buộc phải thay đổi theo.</li>\r\n	<li>Dữ liệu kh&ocirc;ng bị che dấu cần l&agrave; d&ugrave;ng n&ecirc;n kh&ocirc;ng c&oacute; t&iacute;nh bảo mật</li>\r\n</ul>\r\n\r\n<p>Để khắc phục những hạn chế đ&oacute; khi giải quy&ecirc;t c&aacute;c b&agrave;i to&aacute;n lớn người ta x&acirc;y dựng một phương ph&aacute;p tiếp cận mới, đ&oacute; l&agrave;&nbsp;<strong>phương ph&aacute;p lập tr&igrave;nh hướng đối tượng.</strong></p>\r\n', '', 'Lập trình OOP', 'Trong bài này chúng ta chỉ điểm qua những khái niệm căn bản của lập trình hướng đối tượng trong php.', 1, '2025-12-02 11:22:51', 2, 11),
(30, 'HTTP Middleware', 'HTTP-Middleware', '<h2>Tạo middleware</h2>\r\n\r\n<p>Để tạo một middleware mới, sử dụng c&acirc;u lệnh Artisan&nbsp;<code>make:middleware</code>:</p>\r\n\r\n<pre>\r\n<code>php artisan make:middleware AgeMiddleware\r\n</code></pre>\r\n\r\n<p>C&acirc;u lệnh n&agrave;y sẽ tạo class&nbsp;<code>AgeMiddleware</code>&nbsp;b&ecirc;n trong thư mục&nbsp;<code>app/Http/Middleware</code>. Trong middleware n&agrave;y, ch&uacute;ng ta sẽ chỉ cho ph&eacute;p truy cập v&agrave;o route nếu như gi&aacute; trị&nbsp;<code>age</code>&nbsp;cung cấp lớn hơn 200. Nếu kh&ocirc;ng, th&igrave; sẽ chuyển hướng users trở lại &quot;home&quot; URI.</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\nnamespace AppHttpMiddleware;\r\n\r\nuse Closure;\r\n\r\nclass AgeMiddleware\r\n{\r\n    /**\r\n     * Run the request filter.\r\n     *\r\n     * @param  IlluminateHttpRequest  $request\r\n     * @param  Closure  $next\r\n     * @return mixed\r\n     */\r\n    public function handle($request, Closure $next)\r\n    {\r\n        if ($request-&gt;input(&#39;age&#39;) &lt;= 200) {\r\n            return redirect(&#39;home&#39;);\r\n        }\r\n\r\n        return $next($request);\r\n    }\r\n\r\n}\r\n</code></pre>\r\n\r\n<p>Như bạn thấy, nếu&nbsp;<code>age</code>&nbsp;nhỏ hơn hoặc bằng&nbsp;<code>200</code>, middleware sẽ trả lại một HTTP chuyển hướng tới client; ngược lại, request sẽ được gửi tiếp để xử l&yacute;. Để truyền request v&agrave;o s&acirc;u hơn trong ứng dụng (cho ph&eacute;p middleware &quot;vượt qua&quot;), đơn giản chỉ cần gọi callback&nbsp;<code>$next</code>&nbsp;với&nbsp;<code>$request</code>.</p>\r\n\r\n<p>Tốt nhất l&agrave; h&atilde;y h&igrave;nh dung middleware l&agrave; một chuỗi c&aacute;c &quot;layers&quot; tr&ecirc;n HTTP request cần phải đi qua trước khi đi v&agrave;o trong chương tr&igrave;nh. Mỗi layer sẽ thực hiện kiểm tra request v&agrave; thậm ch&iacute; c&oacute; thể huỷ từ chối request ho&agrave;n to&agrave;n.</p>\r\n\r\n<h3><em>Before</em>&nbsp;/&nbsp;<em>After</em>&nbsp;Middleware</h3>\r\n\r\n<p>Việc một middleware chạy trước hay sau một request phụ thuộc v&agrave;o ch&iacute;nh n&oacute;. V&iacute; dụ, middleware dưới đ&acirc;y sẽ thực hiện v&agrave;i t&aacute;c vụ&nbsp;<strong>trước khi</strong>&nbsp;request được chương tr&igrave;nh xử l&yacute;:</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\nnamespace AppHttpMiddleware;\r\n\r\nuse Closure;\r\n\r\nclass BeforeMiddleware\r\n{\r\n    public function handle($request, Closure $next)\r\n    {\r\n        // Perform action\r\n\r\n        return $next($request);\r\n    }\r\n}\r\n</code></pre>\r\n\r\n<p>Tuy nhi&ecirc;n, middleware n&agrave;y sẽ thực hiện việc của n&oacute;&nbsp;<strong>sau khi</strong>&nbsp;request được xử l&yacute; bởi chương tr&igrave;nh:</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\nnamespace AppHttpMiddleware;\r\n\r\nuse Closure;\r\n\r\nclass AfterMiddleware\r\n{\r\n    public function handle($request, Closure $next)\r\n    {\r\n        $response = $next($request);\r\n\r\n        // Perform action\r\n\r\n        return $response;\r\n    }\r\n}\r\n</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Đăng k&iacute; middleware</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Global Middleware</h3>\r\n\r\n<p>Nếu bạn muốn một middleware c&oacute; thể được thực thi trong mỗi HTTP request tới chương tr&igrave;nh, đơn giản chỉ cần th&ecirc;m t&ecirc;n class của middleware đ&oacute; v&agrave;o trong thuộc t&iacute;nh&nbsp;<code>$middleware</code>&nbsp;của class&nbsp;<code>app/Http/Kernel.php</code>.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Thiết lập middleware cho route</h3>\r\n\r\n<p>Nếu bạn muốn thiết lập middleware cho một số route cụ thể, bạn đầu ti&ecirc;n cần phải th&ecirc;m middleware v&agrave;o trong biến&nbsp;<code>$routeMiddleware</code>&nbsp;trong file&nbsp;<code>app/Http/Kernel.php</code>&nbsp;v&agrave; đặt cho n&oacute; một key:</p>\r\n\r\n<pre>\r\n<code>// Within AppHttpKernel Class...\r\n\r\nprotected $routeMiddleware = [\r\n    &#39;auth&#39; =&gt; AppHttpMiddlewareAuthenticate::class,\r\n    &#39;auth.basic&#39; =&gt; IlluminateAuthMiddlewareAuthenticateWithBasicAuth::class,\r\n    &#39;guest&#39; =&gt; AppHttpMiddlewareRedirectIfAuthenticated::class,\r\n    &#39;throttle&#39; =&gt; IlluminateRoutingMiddlewareThrottleRequests::class,\r\n];\r\n</code></pre>\r\n\r\n<p>Sau khi đ&atilde; được khai b&aacute;o trong HTTP Kernel, bạn c&oacute; thể sử dụng kho&aacute;&nbsp;<code>middleware</code>&nbsp;để thiết lập th&ocirc;ng số c&agrave;i v&agrave;o trong route:</p>\r\n\r\n<pre>\r\n<code>Route::get(&#39;admin/profile&#39;, [&#39;middleware&#39; =&gt; &#39;auth&#39;, function () {\r\n    //\r\n}]);\r\n</code></pre>\r\n\r\n<p>Sử dụng một&nbsp;<code>array</code>&nbsp;để thực hiện g&aacute;n nhiều middleware v&agrave;o trong route:</p>\r\n\r\n<pre>\r\n<code>Route::get(&#39;/&#39;, [&#39;middleware&#39; =&gt; [&#39;first&#39;, &#39;second&#39;], function () {\r\n    //\r\n}]);\r\n</code></pre>\r\n\r\n<p>Ngo&agrave;i ra, bạn cũng c&oacute; thể thực hiện m&oacute;c nối h&agrave;m&nbsp;<code>middleware</code>&nbsp;v&agrave;o trong khai b&aacute;o của route:</p>\r\n\r\n<pre>\r\n<code>Route::get(&#39;/&#39;, function () {\r\n    //\r\n})-&gt;middleware([&#39;first&#39;, &#39;second&#39;]);\r\n</code></pre>\r\n\r\n<p>Khi g&aacute;n middleware, bạn cũng c&oacute; thể sử dụng t&ecirc;n class đầy đủ của middleware muốn g&aacute;n:</p>\r\n\r\n<pre>\r\n<code>use AppHttpMiddlewareFooMiddleware;\r\n\r\nRoute::get(&#39;admin/profile&#39;, [&#39;middleware&#39; =&gt; FooMiddleware::class, function () {\r\n    //\r\n}]);\r\n</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Tạo nh&oacute;m middleware</h3>\r\n\r\n<p>Sẽ c&oacute; l&uacute;c bạn muốn thực hiện nh&oacute;m một v&agrave;i middleware lại v&agrave;o trong một kho&aacute; để c&oacute; thể thực hiện g&aacute;n v&agrave;o route dễ d&agrave;ng hơn. Bạn c&oacute; thể l&agrave;m như vậy bằng c&aacute;ch sử dụng thuộc t&iacute;nh&nbsp;<code>$middlewareGroups</code>&nbsp;của HTTP kernel.</p>\r\n\r\n<p>Về cơ bản, Laravel cung cấp sẵn hai nh&oacute;m middleware thường sử dụng m&agrave; bạn c&oacute; thể muốn &aacute;p dụng cho web UI hay API:</p>\r\n\r\n<pre>\r\n<code>/**\r\n * The application&#39;s route middleware groups.\r\n *\r\n * @var array\r\n */\r\nprotected $middlewareGroups = [\r\n    &#39;web&#39; =&gt; [\r\n        AppHttpMiddlewareEncryptCookies::class,\r\n        IlluminateCookieMiddlewareAddQueuedCookiesToResponse::class,\r\n        IlluminateSessionMiddlewareStartSession::class,\r\n        IlluminateViewMiddlewareShareErrorsFromSession::class,\r\n        AppHttpMiddlewareVerifyCsrfToken::class,\r\n    ],\r\n\r\n    &#39;api&#39; =&gt; [\r\n        &#39;throttle:60,1&#39;,\r\n        &#39;auth:api&#39;,\r\n    ],\r\n];\r\n</code></pre>\r\n\r\n<p>C&aacute;c nh&oacute;m middleware được g&aacute;n v&agrave;o route v&agrave; controller action sử dụng c&uacute; ph&aacute;p tương tự như với từng middleware ri&ecirc;ng. Việc sử dụng nh&oacute;m middleware sẽ l&agrave;m cho việc g&aacute;n c&aacute;c middleware v&agrave;o trong một route trở n&ecirc;n tiện hơn:</p>\r\n\r\n<pre>\r\n<code>Route::group([&#39;middleware&#39; =&gt; [&#39;web&#39;]], function () {\r\n    //\r\n});\r\n</code></pre>\r\n\r\n<p>N&ecirc;n nhớ l&agrave;, nh&oacute;m middleware&nbsp;<code>web</code>&nbsp;được tự động &aacute;p dụng v&agrave;o trong file&nbsp;<code>routes.php</code>&nbsp;qua&nbsp;<code>RouteServiceProvider</code>.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Middleware Parameters</h2>\r\n\r\n<p>Middleware cũng c&oacute; thể nhận c&aacute;c tham số truyền v&agrave;o. V&iacute; dụ, nếu chương tr&igrave;nh cần x&aacute;c nhận user đ&atilde; được x&aacute;c thực c&oacute; &quot;role&quot; cụ thể trước khi thực hiện một thao t&aacute;c n&agrave;o đ&oacute;, bạn c&oacute; thể tạo ra&nbsp;<code>RoleMiddleware</code>&nbsp;để nhận t&ecirc;n của role như một tham số.</p>\r\n\r\n<p>C&aacute;c tham số của middleware sẽ được truyền v&agrave;o th&agrave;nh tham số của h&agrave;m&nbsp;<code>handle</code>&nbsp;ngay sau tham số&nbsp;<code>$next</code>:</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\nnamespace AppHttpMiddleware;\r\n\r\nuse Closure;\r\n\r\nclass RoleMiddleware\r\n{\r\n    /**\r\n     * Run the request filter.\r\n     *\r\n     * @param  IlluminateHttpRequest  $request\r\n     * @param  Closure  $next\r\n     * @param  string  $role\r\n     * @return mixed\r\n     */\r\n    public function handle($request, Closure $next, $role)\r\n    {\r\n        if (! $request-&gt;user()-&gt;hasRole($role)) {\r\n            // Redirect...\r\n        }\r\n\r\n        return $next($request);\r\n    }\r\n\r\n}\r\n</code></pre>\r\n\r\n<p>Tham số cho middleware cũng c&oacute; thể được khai b&aacute;o tr&ecirc;n route bằng c&aacute;ch ph&acirc;n c&aacute;ch t&ecirc;n middleware v&agrave; tham số bởi dấu&nbsp;<code>:</code>. Nhiều tham số ph&acirc;n c&aacute;ch nhau bởi dấu phẩy&nbsp;<code>,</code>:</p>\r\n\r\n<pre>\r\n<code>Route::put(&#39;post/{id}&#39;, [&#39;middleware&#39; =&gt; &#39;role:editor&#39;, function ($id) {\r\n    //\r\n}]);\r\n</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Terminable Middleware</h2>\r\n\r\n<p>Sẽ c&oacute; l&uacute;c một middleware cần thực hiện chỉ sau khi HTTP response đ&atilde; được gửi xong cho tr&igrave;nh duyệt. V&iacute; dụ, &quot;session&quot; middleware đi k&egrave;m với Laravel cung cấp session data cho storage&nbsp;<em>sau khi</em>&nbsp;response được gửi tới tr&igrave;nh duyệt. Để l&agrave;m được việc n&agrave;y, cần phải tạo một middleware kiểu &quot;kết th&uacute;c&quot; bằng c&aacute;ch th&ecirc;m v&agrave;o h&agrave;m&nbsp;<code>terminate</code>&nbsp;v&agrave;o trong middleware:</p>\r\n\r\n<pre>\r\n<code>&lt;?php\r\n\r\nnamespace IlluminateSessionMiddleware;\r\n\r\nuse Closure;\r\n\r\nclass StartSession\r\n{\r\n    public function handle($request, Closure $next)\r\n    {\r\n        return $next($request);\r\n    }\r\n\r\n    public function terminate($request, $response)\r\n    {\r\n        // Store the session data...\r\n    }\r\n}\r\n</code></pre>\r\n\r\n<p>H&agrave;m&nbsp;<code>terminate</code>&nbsp;sẽ nhận cả request v&agrave; response. Khi m&agrave; bạn khai b&aacute;o một terminable middleware, bạn phải th&ecirc;m n&oacute; v&agrave;o trong danh s&aacute;ch global middleware trong HTTP kernel.</p>\r\n\r\n<p>Khi gọi h&agrave;m&nbsp;<code>terminate</code>&nbsp;trong middleware, Laravel sẽ thực hiện resolve một instance mới cho middleware từ&nbsp;<a href=\"https://laravel.com/docs/master/container\">service container</a>. Nếu bạn muốn sử dụng c&ugrave;ng một instance khi m&agrave;&nbsp;<code>handle</code>&nbsp;v&agrave;&nbsp;<code>terminate</code>&nbsp;được gọi, đăng k&iacute; middleware v&agrave;o trong container sử dụng h&agrave;m&nbsp;<code>singleton</code>.</p>\r\n', '', 'HTTP Middleware', 'HTTP middleware cung cấp một giải pháp tiện ích cho việc lock các HTTP request vào ứng dụng. Ví dụ, Laravel có chứa một middleware xác thực người dùng đăng nhập vào hệ thống. Nếu user chưa đăng nhập, middleware sẽ chuyển hướng user tới màn hình login. Còn nếu user đã đăng nhập rồi, thì middleware sẽ cho phép request được thực hiện tiếp tiến trình xử lý.', 1, '2025-12-02 11:26:36', 8, 1);
INSERT INTO `posts` (`id`, `name`, `slug`, `description`, `image`, `meta_title`, `meta_description`, `status`, `created_at`, `category_id`, `user_id`) VALUES
(31, 'Blade Templates', 'Blade-Templates', '<h2>Kế thừa template</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Tạo một layout</h3>\r\n\r\n<p>Hai lợi &iacute;ch ch&iacute;nh của việc sử dụng Blade l&agrave;&nbsp;<em>kế thừa template</em>&nbsp;v&agrave;&nbsp;<em>sections</em>. Để bắt đầu, h&atilde;y c&ugrave;ng nhau xem v&iacute; dụ đơn giản dưới đ&acirc;y. Đầu ti&ecirc;n, ch&uacute;ng ta c&ugrave;ng xem một trang layout &quot;master&quot;. V&igrave; hầu hết c&aacute;c ứng dụng web bảo tr&igrave; một mẫu layout chung giữa c&aacute;c trang với nhau, n&ecirc;n sẽ rất l&agrave; tiện nếu tạo ra layout n&agrave;y th&agrave;nh một Blade view ri&ecirc;ng biệt:</p>\r\n\r\n<pre>\r\n<code><!-- Stored in resources/views/layouts/master.blade.php -->\r\n\r\n</code></pre>\r\n\r\n<p>App Name - @yield(&#39;title&#39;)</p>\r\n\r\n<p><code>@section(&#39;sidebar&#39;) This is the master sidebar. @show </code></p>\r\n\r\n<p><code>@yield(&#39;content&#39;) </code></p>\r\n\r\n<p>Như bạn thấy, file n&agrave;y c&oacute; chứa m&atilde; HTML cơ bản. Tuy nhi&ecirc;n, h&atilde;y ch&uacute; &yacute; ở hai directive&nbsp;<code>@section</code>&nbsp;v&agrave;&nbsp;<code>@yield</code>. Về&nbsp;<code>@section</code>&nbsp;directive, như c&aacute;i t&ecirc;n đ&atilde; thể hiện, thực hiện khai b&aacute;o một khối dữ liệu, trong khi&nbsp;<code>@yield</code>&nbsp;lại được sử dụng để hiển thị dữ liệu ở một vị tr&iacute; đặt trước.</p>\r\n\r\n<p>L&uacute;c n&agrave;y ch&uacute;ng ta đ&atilde; tạo xong một layout, h&atilde;y c&ugrave;ng nhau tạo ra c&aacute;c trang con kế thừa từ layout n&agrave;y.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Mở rộng layout</h3>\r\n\r\n<p>Khi tạo một trang con, bạn c&oacute; thể sử dụng&nbsp;<code>@extends</code>&nbsp;để cho biết l&agrave; layout của trang con n&agrave;y sẽ thực hiện &quot;kế thừa&quot; từ đ&acirc;u. View m&agrave;&nbsp;<code>@extends</code>&nbsp;một Blade layout c&oacute; thể inject nội dung v&agrave;o trong mục&nbsp;<code>@section</code>. Nhớ lại ở v&iacute; dụ trước, nội dung của những section n&agrave;y sẽ được hiển thị sử dụng&nbsp;<code>@yield</code>:</p>\r\n\r\n<pre>\r\n<code><!-- Stored in resources/views/child.blade.php -->\r\n\r\n@extends(&#39;layouts.master&#39;)\r\n\r\n@section(&#39;title&#39;, &#39;Page Title&#39;)\r\n\r\n@section(&#39;sidebar&#39;)\r\n    @parent\r\n\r\n    </code></pre>\r\n\r\n<p><code>This is appended to the master sidebar.</code></p>\r\n\r\n<p><code>@endsection @section(&#39;content&#39;) </code></p>\r\n\r\n<p><code>This is my body content.</code></p>\r\n\r\n<p><code>@endsection </code></p>\r\n\r\n<p>Ở v&iacute; dụ n&agrave;y, phần&nbsp;<code>sidebar</code>&nbsp;c&oacute; sử dụng&nbsp;<code>@parent</code>&nbsp;để thực hiện th&ecirc;m nội dung v&agrave;o trong sidebar (thay v&igrave; ghi đ&egrave; to&agrave;n bộ).&nbsp;<code>@parent</code>&nbsp;sẽ được thay thế bởi nội dung của layout khi view được render.</p>\r\n\r\n<p>Dĩ nhi&ecirc;n, tương tự như view PHP thuần, Blade view c&oacute; thể được trả về từ route sử dụng h&agrave;m helper&nbsp;<code>view</code>:</p>\r\n\r\n<pre>\r\n<code>Route::get(&#39;blade&#39;, function () {\r\n    return view(&#39;child&#39;);\r\n});\r\n</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Hiển thị data</h2>\r\n\r\n<p>Bạn c&oacute; thể hiển thị data truyền v&agrave;o trong Blade views bằng c&aacute;ch đặt biến v&agrave;o trong cặp&nbsp;<strong>dấu ngoặc nhọn</strong>. V&iacute; dụ, với route dưới đ&acirc;y:</p>\r\n\r\n<pre>\r\n<code>Route::get(&#39;greeting&#39;, function () {\r\n    return view(&#39;welcome&#39;, [&#39;name&#39; =&gt; &#39;Samantha&#39;]);\r\n});\r\n</code></pre>\r\n\r\n<p>th&igrave; bạn c&oacute; thể hiển thị nội dung của biến&nbsp;<code>name</code>&nbsp;như n&agrave;y:</p>\r\n\r\n<pre>\r\n<code>Hello, {{ $name }}.\r\n</code></pre>\r\n\r\n<p>Dĩ nhi&ecirc;n l&agrave; bạn kh&ocirc;ng hề bị giới hạn trong việc hiển thị nội dung của biến truyền v&agrave;o trong view. Bạn cũng c&oacute; thể hiển thị kết quả của bất cứ h&agrave;m PHP n&agrave;o. Ch&iacute;nh x&aacute;c hơn, bạn c&oacute; thể đặt bất cứ m&atilde; PHP n&agrave;o bạn muốn v&agrave;o trong một mệnh đề hiển thị của Blade:</p>\r\n\r\n<pre>\r\n<code>The current UNIX timestamp is {{ time() }}.\r\n</code></pre>\r\n\r\n<blockquote>\r\n<p><strong>Ch&uacute; &yacute;:</strong>&nbsp;Cặp dấu&nbsp;<code>{{ }}</code>&nbsp;của Blade được tự động gửi tới h&agrave;m&nbsp;<code>htmlentities</code>&nbsp;của PHP để ngăn chặn c&aacute;c h&agrave;nh vi tấn c&ocirc;ng XSS.</p>\r\n</blockquote>\r\n\r\n<p>Blade &amp; JavaScript Frameworks</p>\r\n\r\n<p>V&igrave; nhiều framework Javascript cũng sử dụng cặp dấu&nbsp;<strong>ngoặc nhọn</strong>&nbsp;để cho biết một biểu thức cần được hiển thị l&ecirc;n tr&igrave;nh duyệt, bạn c&oacute; thể sử dụng dấu&nbsp;<code>@</code>&nbsp;để b&aacute;o cho Blade biết l&agrave; biểu thức n&agrave;y cần được giữ lại. V&iacute; dụ:</p>\r\n\r\n<pre>\r\n\r\n&nbsp;</pre>\r\n\r\n<h1><code>Laravel</code></h1>\r\n\r\n<p><code>Hello, @{{ name }}. </code></p>\r\n\r\n<p>Ở v&iacute; dụ n&agrave;y, k&iacute; hiệu&nbsp;<code>@</code>&nbsp;sẽ bị Blade xo&aacute; đi; v&igrave; thế&nbsp;<code>{{ name }}</code>&nbsp;sẽ được giữ lại v&agrave; cho ph&eacute;p n&oacute; được render tiếp bởi Javascript kh&aacute;c của bạn.</p>\r\n\r\n<p>Hiển thị dữ liệu nếu tồn tại</p>\r\n\r\n<p>Đ&ocirc;i l&uacute;c bạn muốn hiển thị gi&aacute; trị một biến, nhưng bạn kh&ocirc;ng chắc nếu như biến được đ&atilde; được set. Ch&uacute;ng ta c&oacute; thể thể hiện theo kiểu m&atilde; nguồn PHP như n&agrave;y:</p>\r\n\r\n<pre>\r\n<code>{{ isset($name) ? $name : &#39;Default&#39; }}\r\n</code></pre>\r\n\r\n<p>Tuy nhi&ecirc;n, thay v&igrave; viết thay kiểu ternary, Blade cung cấp bạn một c&aacute;ch ngắn gọn:</p>\r\n\r\n<pre>\r\n<code>{{ $name or &#39;Default&#39; }}\r\n</code></pre>\r\n\r\n<p>Ở v&iacute; dụ n&agrave;y, nếu biến&nbsp;<code>$name</code>&nbsp;tồn tại, gi&aacute; trị của n&oacute; sẽ được hiển thị. C&ograve;n nếu như n&oacute; kh&ocirc;ng tồn tại, th&igrave; từ&nbsp;<code>Default</code>&nbsp;sẽ được hiển thị.</p>\r\n\r\n<p>Hiển thị dữ liệu chưa unescape</p>\r\n\r\n<p>Mặc định, cặp dấu&nbsp;<code>{{ }}</code>&nbsp;được tự động gửi qua h&agrave;m&nbsp;<code>htmlentities</code>&nbsp;để ngăn chặn tấn c&ocirc;ng XSS. Nếu bạn kh&ocirc;ng muốn dữ liệu bị escape, bạn c&oacute; thể sử dụng c&uacute; ph&aacute;p sau:</p>\r\n\r\n<pre>\r\n<code>Hello, {!! $name !!}.\r\n</code></pre>\r\n\r\n<blockquote>\r\n<p><strong>Ch&uacute; &yacute;:</strong>&nbsp;Phải thật cẩn thận khi hiển thị nội dung được người d&ugrave;ng cung cấp. Lu&ocirc;n lu&ocirc;n sử dụng cặp dấu ngoặc nhọn để escape c&aacute;c thẻ HTML trong nội dung.</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Cấu tr&uacute;c điều khiển</h2>\r\n\r\n<p>Ngo&agrave;i việc kế thừa template v&agrave; hiển thị dữ liệu, Blade cũng cung cấp c&aacute;c tiện &iacute;ch cho c&aacute;c cấu tr&uacute;c điều khiển cơ bản của PHP, như mệnh đề điều kiện hay v&ograve;ng lặp. Những tiện &iacute;ch n&agrave;y rất hữu &iacute;ch khi l&agrave;m việc với cấu tr&uacute;c điều khiển của PHP.</p>\r\n\r\n<p>Sử dụng If</p>\r\n\r\n<p>Bạn c&oacute; thể sử dụng&nbsp;<code>if</code>&nbsp;với c&aacute;c directive&nbsp;<code>@if</code>,&nbsp;<code>@elseif</code>,&nbsp;<code>@else</code>, v&agrave;&nbsp;<code>@endif</code>. Những directive n&agrave;y tương ứng giống hệt c&aacute;c từ kho&aacute; của PHP:</p>\r\n\r\n<pre>\r\n<code>@if (count($records) === 1)\r\n    I have one record!\r\n@elseif (count($records) &gt; 1)\r\n    I have multiple records!\r\n@else\r\n    I don&#39;t have any records!\r\n@endif\r\n</code></pre>\r\n\r\n<p>Để tiện hơn, Blade cũng cung cấp điều kiện&nbsp;<code>@unless</code>:</p>\r\n\r\n<pre>\r\n<code>@unless (Auth::check())\r\n    You are not signed in.\r\n@endunless\r\n</code></pre>\r\n\r\n<p>Bạn cũng c&oacute; thể kiểm tra nếu một phần layout c&oacute; chứa nội dung n&agrave;o kh&ocirc;ng sử dụng&nbsp;<code>@hasSection</code>:</p>\r\n\r\n<pre>\r\n\r\n&nbsp;</pre>\r\n\r\n<p>@hasSection(&#39;title&#39;) @yield(&#39;title&#39;) - App Name @else App Name @endif<code> </code></p>\r\n\r\n<p>V&ograve;ng lặp</p>\r\n\r\n<p>Ngo&agrave;i cấu tr&uacute;c điều kiện, Blade cũng cung cấp c&aacute;c phương thức hỗ trợ cho việc xử l&yacute; v&ograve;ng lặp, v&agrave; c&aacute;c phần n&agrave;y tương tự với PHP:</p>\r\n\r\n<pre>\r\n<code>@for ($i = 0; $i &lt; 10; $i++)\r\n    The current value is {{ $i }}\r\n@endfor\r\n\r\n@foreach ($users as $user)\r\n    </code></pre>\r\n\r\n<p><code>This is user {{ $user-&gt;id }}</code></p>\r\n\r\n<p><code>@endforeach @forelse ($users as $user) </code></p>\r\n\r\n<ul>\r\n	<li><code>{{ $user-&gt;name }}</code></li>\r\n	<li><code>@empty </code>\r\n	<p><code>No users</code></p>\r\n	<code> @endforelse @while (true) </code>\r\n\r\n	<p><code>I&#39;m looping forever.</code></p>\r\n	<code> @endwhile </code>\r\n\r\n	<p>Khi sử dụng v&ograve;ng lặp, bạn c&oacute; thể cần kết th&uacute;c hay bỏ qua v&ograve;ng lặp hiện tại:</p>\r\n\r\n	<pre>\r\n<code>@foreach ($users as $user)\r\n    @if($user-&gt;type == 1)\r\n        @continue\r\n    @endif\r\n\r\n    </code></pre>\r\n\r\n	<ul>\r\n		<li><code>{{ $user-&gt;name }}</code></li>\r\n		<li><code>@if($user-&gt;number == 5) @break @endif @endforeach </code>\r\n		<p>Bạn cũng c&oacute; thể th&ecirc;m điều kiện v&agrave;o khai tr&ecirc;n c&ugrave;ng một d&ograve;ng:</p>\r\n\r\n		<pre>\r\n<code>@foreach ($users as $user)\r\n    @continue($user-&gt;type == 1)\r\n\r\n    </code></pre>\r\n\r\n		<ul>\r\n			<li><code>{{ $user-&gt;name }}</code></li>\r\n			<li><code>@break($user-&gt;number == 5) @endforeach </code>\r\n			<p>Ch&egrave;n th&ecirc;m view con</p>\r\n\r\n			<p>Sử dụng&nbsp;<code>@include</code>, cho ph&eacute;p bạn dễ d&agrave;ng ch&egrave;n th&ecirc;m một Blade view v&agrave;o trong một view c&oacute; sẵn. Tất cả c&aacute;c biến sử dụng được ở view cha đều c&oacute; thể sử dụng được ở view ch&egrave;n th&ecirc;m:</p>\r\n\r\n			<pre>\r\n\r\n&nbsp;</pre>\r\n			<code>@include(&#39;shared.errors&#39;) </code>\r\n\r\n			<p><code><!-- Form Contents --> </code></p>\r\n			<code> </code><code> </code>\r\n\r\n			<p>Mặc d&ugrave;, c&aacute;c view được ch&egrave;n th&ecirc;m kế thừa tất cả dữ liệu từ view cha, bạn cũng c&oacute; thể truyền v&agrave;o một mảng c&aacute;c dữ liệu bổ sung:</p>\r\n\r\n			<pre>\r\n<code>@include(&#39;view.name&#39;, [&#39;some&#39; =&gt; &#39;data&#39;])\r\n</code></pre>\r\n\r\n			<blockquote>\r\n			<p><strong>Ch&uacute; &yacute;:</strong>&nbsp;Bạn n&ecirc;n tr&aacute;nh sử dụng&nbsp;<code>__DIR__</code>&nbsp;v&agrave;&nbsp;<code>__FILE__</code>&nbsp;ở trong Blade view, v&igrave; ch&uacute;ng sẽ tham chiếu tới vị tr&iacute; của file view bị cache.</p>\r\n			</blockquote>\r\n\r\n			<p>Render views cho collection</p>\r\n\r\n			<p>Bạn c&oacute; thể kết hợp v&ograve;ng lặp v&agrave; view ch&egrave;n th&ecirc;m trong một d&ograve;ng với&nbsp;<code>@each</code>:</p>\r\n\r\n			<pre>\r\n<code>@each(&#39;view.name&#39;, $jobs, &#39;job&#39;)\r\n</code></pre>\r\n\r\n			<p>Tham số thứ nhất l&agrave; t&ecirc;n của view partial để render c&aacute;c element trong mảng hay collection. Tham số thứ hai l&agrave; mảng hay collection bạn muốn lặp, c&ograve;n tham số thứ ba l&agrave; t&ecirc;n của biến sẽ được g&aacute;n v&agrave;o trong v&ograve;ng lặp b&ecirc;n trong view. V&igrave; thế, nếu như bạn muốn lặp qua một mảng t&ecirc;n&nbsp;<code>jobs</code>, bạn sẽ cần phải truy xuất v&agrave;o mỗi job th&ocirc;ng qua biến t&ecirc;n l&agrave;&nbsp;<code>job</code>&nbsp;ở b&ecirc;n trong view partial.</p>\r\n\r\n			<p>Bạn cũng c&oacute; thể truyền v&agrave;o tham số thứ tư v&agrave;o trong&nbsp;<code>@each</code>. Tham số n&agrave;y chỉ định view sẽ được render nếu như mảng bị rỗng.</p>\r\n\r\n			<pre>\r\n<code>@each(&#39;view.name&#39;, $jobs, &#39;job&#39;, &#39;view.empty&#39;)\r\n</code></pre>\r\n\r\n			<p>Comments</p>\r\n\r\n			<p>Blade cũng cho ph&eacute;p bạn viết comments trong view. Tuy nhi&ecirc;n, kh&ocirc;ng giống như HTML comment, Blade comment kh&ocirc;ng đi k&egrave;m trong nội dung HTML được trả về:</p>\r\n\r\n			<pre>\r\n<code>{{-- This comment will not be present in the rendered HTML --}}\r\n</code></pre>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<h2>Stacks</h2>\r\n\r\n			<p>Blade cũng cho ph&eacute;p bạn đẩy v&agrave;o stack để c&oacute; thể được render ở một vị tr&iacute; n&agrave;o trong view hay layout kh&aacute;c:</p>\r\n\r\n			<pre>\r\n<code>@push(&#39;scripts&#39;)\r\n    \r\n@endpush\r\n</code></pre>\r\n\r\n			<p>Bạn c&oacute; thể đẩy v&agrave;o stack tuỳ &yacute; bao nhi&ecirc;u lần bạn muốn. Để render, bạn sử dụng&nbsp;<code>@stack</code>:</p>\r\n\r\n			<pre>\r\n\r\n&nbsp;</pre>\r\n			<code> </code>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<h2>Service Injection</h2>\r\n\r\n			<p>Để nh&uacute;ng v&agrave;o một service trong Laravel&nbsp;<a href=\"https://laravel.com/docs/master/container\">service container</a>, sử dụng&nbsp;<code>@inject</code>. Tham số thứ nhất truyền v&agrave;o l&agrave; t&ecirc;n của biến m&agrave; service sẽ được đặt v&agrave;o, c&ograve;n tham số thứ hai l&agrave; t&ecirc;n của class hay interface của service bạn muốn resolve:</p>\r\n\r\n			<pre>\r\n<code>@inject(&#39;metrics&#39;, &#39;AppServicesMetricsService&#39;)\r\n\r\n</code></pre>\r\n\r\n			<p><code>Monthly Revenue: {{ $metrics-&gt;monthlyRevenue() }}. </code></p>\r\n			<code> </code>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<h2>Mở rộng Blade</h2>\r\n\r\n			<p>Blade thậm ch&iacute; cho ph&eacute;p bạn tạo directive ri&ecirc;ng. Bạn c&oacute; thể sử dụng h&agrave;m&nbsp;<code>directive</code>&nbsp;để đăng k&iacute; một directive. Khi tr&igrave;nh bi&ecirc;n dịch của Blade gặp directive, n&oacute; sẽ gọi tới callback được cung cấp với tham số tương ứng.</p>\r\n\r\n			<p>V&iacute; dụ sau đ&acirc;y tạo một directive&nbsp;<code>@datetime($var)</code>&nbsp;để thực hiện format một biến&nbsp;<code>$var</code>:</p>\r\n\r\n			<pre>\r\n<code><!--?php\r\n\r\nnamespace AppProviders;\r\n\r\nuse Blade;\r\nuse IlluminateSupportServiceProvider;\r\n\r\nclass AppServiceProvider extends ServiceProvider\r\n{\r\n    /**\r\n     * Perform post-registration booting of services.\r\n     *\r\n     * @return void\r\n     */\r\n    public function boot()\r\n    {\r\n        Blade::directive(\'datetime\', function($expression) {\r\n            return \"<?php echo with{$expression}--->format(&#39;m/d/Y H:i&#39;); ?&gt;&quot;;\r\n        });\r\n    }\r\n\r\n    /**\r\n     * Register bindings in the container.\r\n     *\r\n     * @return void\r\n     */\r\n    public function register()\r\n    {\r\n        //\r\n    }\r\n}\r\n</code></pre>\r\n\r\n			<p>Như bạn thấy, h&agrave;m helper&nbsp;<code>with</code>&nbsp;được sử dụng trong directive n&agrave;y. H&agrave;m&nbsp;<code>with</code>&nbsp;đơn giản chỉ trả về đối tượng hay gi&aacute; trị được cung cấp v&agrave; cho ph&eacute;p m&oacute;c nối h&agrave;m một c&aacute;ch tiện lợi. M&atilde; PHP được sinh ra cuối c&ugrave;ng bởi directive n&agrave;y sẽ l&agrave;:</p>\r\n\r\n			<pre>\r\n<code><!--?php echo with($var)--->format(&#39;m/d/Y H:i&#39;); ?&gt;\r\n</code></pre>\r\n\r\n			<p>Sau khi cập nhật logic của một Blade directive, bạn cần xo&aacute; hết tất cả c&aacute;c Blade views đ&atilde; bị cache bằng c&aacute;ch sử dụng c&acirc;u lệnh Artisan&nbsp;<code>view:clear</code>.</p>\r\n			</li>\r\n		</ul>\r\n		</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n<!-- Head Contents -->\r\n\r\n<p>@stack(&#39;scripts&#39;)</p>\r\n', '1764675297.webp', 'Blade Templates', 'Blade là một templating engine đơn giản nhưng rất mạnh mẽ được tạo ra và đi cùng với Laravel. Không giống các templating engine khác, Blade không cấm bạn sử dụng PHP thuần trong view. Tất cả các views của Blade được compile thành mã PHP thuần và được cache lại cho tới khi bị chỉnh sửa, nghĩa là Blade về cơ bản không làm tăng thêm chi phí ban đầu nào trong ứng dụng. Các file của Blade view sử dụng đuôi là .blade.php và cơ bản được lưu trong thư mục resources/views.', 1, '2025-12-02 11:27:34', 8, 1);

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
(10, 'Trường', 'Mai', 'vu.tmt.64cntt@ntu.edu.vn', '$2y$10$oOa5t9aTbDXCKHl34sfs7uLl.UzFD3fiQqFEaBL.dAq/w4JNhAJ9W', 0, 0, '2025-11-17 05:51:18', NULL, NULL, NULL, NULL, '2025-11-16 23:51:31', NULL, NULL),
(11, 'Vu', 'Truong', 'accclonezeroone@gmail.com', '$2y$10$GyZTTFxsoR0fWsv2ScMQ1OL9goPYfHBzXyxU6NsggYrIQfWlzDhaK', 0, 0, '2025-12-01 10:20:43', NULL, NULL, NULL, NULL, '2025-12-01 04:25:20', NULL, NULL);

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
(11, 27, '2025-12-02 11:15:46');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-03-20 15:04:50
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mydatabase`
--

-- --------------------------------------------------------

--
-- 資料表結構 `order_group`
--

CREATE TABLE `order_group` (
  `order_group_id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL COMMENT '行程編號',
  `amount` int(11) NOT NULL COMMENT '訂單金額',
  `deposit` int(11) NOT NULL COMMENT '訂金',
  `deposit_date` date NOT NULL COMMENT '訂金付款日期/期限',
  `final_payment` int(11) NOT NULL COMMENT '尾款金額',
  `final_payment_date` date NOT NULL COMMENT '尾款付款日期/期限',
  `pay` varchar(10) NOT NULL COMMENT '付款方式',
  `information` varchar(20) NOT NULL COMMENT '處理狀態',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '訂單建立時間',
  `edited_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '訂單修改時間',
  `member_id` int(11) NOT NULL COMMENT '會員id',
  `detail_id` int(11) NOT NULL COMMENT '交易id(積分明細)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `order_group`
--

INSERT INTO `order_group` (`order_group_id`, `travel_id`, `amount`, `deposit`, `deposit_date`, `final_payment`, `final_payment_date`, `pay`, `information`, `created_at`, `edited_at`, `member_id`, `detail_id`) VALUES
(1, 3, 282000, 100000, '2024-10-01', 182000, '2024-10-31', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:04:16', 20, 5),
(2, 40, 50900, 10000, '2024-04-08', 40900, '2024-04-18', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:23:07', 11, 4),
(3, 5, 309000, 120000, '2024-08-01', 189000, '2024-08-25', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:23:18', 5, 9),
(4, 11, 219900, 100000, '2024-05-03', 119900, '2024-05-11', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:23:33', 19, 32),
(5, 17, 36900, 8000, '2024-03-14', 28900, '2024-03-25', '轉帳', '等待收取尾款', '2024-03-19 03:03:17', '2024-03-19 03:22:28', 41, 17),
(6, 36, 79900, 20000, '2024-04-15', 59900, '2024-05-01', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:24:35', 1, 11),
(7, 6, 295000, 120000, '2024-08-13', 175000, '2024-09-03', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:25:37', 22, 3),
(8, 8, 250000, 100000, '2024-09-12', 150000, '2024-10-01', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:26:19', 9, 26),
(9, 19, 50900, 10000, '2024-03-19', 40900, '2024-03-19', '轉帳', '等待出團 (已收尾款確定出團)', '2024-03-19 03:03:17', '2024-03-19 03:27:23', 33, 23),
(10, 22, 32900, 8000, '2024-03-19', 24900, '2024-03-28', '轉帳', '等待收取尾款', '2024-03-19 03:03:17', '2024-03-19 03:27:59', 36, 19),
(11, 27, 269000, 110000, '2024-06-07', 159000, '2024-06-21', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:28:55', 37, 38),
(12, 49, 198900, 100000, '2024-05-31', 98900, '2024-06-14', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:30:10', 26, 28),
(13, 33, 219900, 100000, '2024-08-15', 119900, '2024-08-29', '轉帳', '尚未付款', '2024-03-19 03:03:17', '2024-03-19 03:31:13', 24, 30),
(15, 1, 210000, 100000, '2024-03-19', 110, '2024-03-19', '轉帳', '尚未付款', '2024-03-19 05:59:24', '2024-03-19 05:59:24', 1, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `order_group`
--
ALTER TABLE `order_group`
  ADD PRIMARY KEY (`order_group_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_group`
--
ALTER TABLE `order_group`
  MODIFY `order_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

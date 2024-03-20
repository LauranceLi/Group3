-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-03-18 09:57:51
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
-- 資料庫： `the_travel_project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registration_time` datetime NOT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `employee_role_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `title_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `employee_nickname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='管理員';

--
-- 傾印資料表的資料 `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `password`, `email`, `registration_time`, `last_login_time`, `employee_role_id`, `status`, `title_id`, `department_id`, `employee_nickname`) VALUES
(1, '李千囷', '123456', 'lars108218@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1, 0, 0, 'Laurance'),
(2, '張筱筠', '123456', 'molly3898@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1, 0, 0, '筱筠'),
(3, '韓光樺', '123456', 'helenhan46@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1, 0, 0, '光樺'),
(4, '周韋霆', '123456', 'asd0979724893@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1, 0, 0, '韋霆'),
(5, '黄柏皓', '123456', 'daniel1761590944@gmail.com', '2024-03-08 12:45:14', NULL, 1, 1, 0, 0, '柏皓');

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `member_id` int(30) NOT NULL,
  `guest_id` int(30) DEFAULT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `member_name` varchar(225) NOT NULL,
  `nickname` varchar(225) NOT NULL,
  `remaining_points` int(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `registration_time` datetime NOT NULL,
  `last_login_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `members`
--

INSERT INTO `members` (`member_id`, `guest_id`, `email`, `password`, `member_name`, `nickname`, `remaining_points`, `phone_number`, `registration_time`, `last_login_time`) VALUES
(240311001, 555, 'lars108218@gmail.com', '123456', '李千囷', '囷', 50, '0986108218', '2024-03-11 09:50:39', NULL),
(240311002, NULL, 'didi860725@gmail.com', '123456', 'Laurance', 'Lars', 500, '0908710032', '2024-03-11 13:01:41', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `permission`
--

CREATE TABLE `permission` (
  `permission_role_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `role_set` int(11) NOT NULL,
  `employees` tinyint(1) NOT NULL,
  `members` tinyint(1) NOT NULL,
  `points` tinyint(1) NOT NULL,
  `itinerary` tinyint(1) NOT NULL,
  `orders` tinyint(1) NOT NULL,
  `products` tinyint(1) NOT NULL,
  `form` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `permission`
--

INSERT INTO `permission` (`permission_role_id`, `sid`, `role_set`, `employees`, `members`, `points`, `itinerary`, `orders`, `products`, `form`) VALUES
(1, 3, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 4, 0, 0, 1, 1, 1, 1, 1, 0),
(468, 450, 0, 0, 0, 0, 0, 0, 1, 0),
(481, 463, 0, 0, 0, 0, 0, 0, 0, 0),
(482, 464, 0, 0, 0, 0, 0, 0, 0, 0),
(483, 465, 0, 0, 0, 0, 0, 0, 0, 0),
(484, 466, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `role_set`
--

CREATE TABLE `role_set` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `role_set`
--

INSERT INTO `role_set` (`role_id`, `role_name`, `description`, `created_at`, `employee_id`) VALUES
(1, '管理員', '擁有所有權限。', '2024-03-18 09:43:50', 1),
(2, '銷售部門經理', '123', '2024-03-18 09:49:22', 1),
(468, '商品上架人員', '', '2024-03-18 13:50:33', 1),
(481, 'test2', 'ˊ˙3e46', '2024-03-18 16:43:59', 1),
(482, 'test2', 'ˊ˙3e46', '2024-03-18 16:46:24', 1),
(483, 'test2', 'ˊ˙3e46', '2024-03-18 16:47:07', 1),
(484, 'test2', 'ˊ˙3e46', '2024-03-18 16:47:32', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_role_id` (`employee_role_id`);

--
-- 資料表索引 `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `role_id` (`permission_role_id`),
  ADD KEY `permission_role_id` (`permission_role_id`);

--
-- 資料表索引 `role_set`
--
ALTER TABLE `role_set`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `permission`
--
ALTER TABLE `permission`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `role_set`
--
ALTER TABLE `role_set`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=487;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

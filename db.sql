-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-05-17 07:12:01
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `PID` int(4) UNSIGNED ZEROFILL NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_img` mediumblob NOT NULL,
  `product_img_type` varchar(50) NOT NULL,
  `product_price` int(10) UNSIGNED NOT NULL,
  `product_amount` int(10) UNSIGNED NOT NULL,
  `product_shop` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `shop`
--

CREATE TABLE `shop` (
  `SID` int(4) UNSIGNED ZEROFILL NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `shop_location` geometry NOT NULL,
  `shop_category` varchar(100) NOT NULL,
  `shop_owner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `shop`
--

INSERT INTO `shop` (`SID`, `shop_name`, `shop_location`, `shop_category`, `shop_owner`) VALUES
(0001, 'mc', 0x00000000010100000097900f7a365d5e40fa7e6abc74933840, 'fast food', '123');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `UID` int(4) UNSIGNED ZEROFILL NOT NULL,
  `user_account` varchar(100) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_phone` int(10) UNSIGNED ZEROFILL NOT NULL,
  `user_location` geometry NOT NULL,
  `user_type` enum('user','manger') NOT NULL DEFAULT 'user',
  `user_balance` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`UID`, `user_account`, `user_password`, `user_name`, `user_phone`, `user_location`, `user_type`, `user_balance`) VALUES
(0001, '123', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '123', 0123456789, 0x00000000010100000024eeb1f4a1b34440dc2e34d769640140, 'manger', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PID`);

--
-- 資料表索引 `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`SID`),
  ADD UNIQUE KEY `shop_name` (`shop_name`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `PID` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shop`
--
ALTER TABLE `shop`
  MODIFY `SID` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `UID` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

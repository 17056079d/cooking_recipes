-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-04-11 20:10:07
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `cooking_recipes`
--

-- --------------------------------------------------------

--
-- 資料表結構 `favourite`
--

CREATE TABLE `favourite` (
  `RID` int(10) UNSIGNED NOT NULL,
  `UID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `favourite`
--

INSERT INTO `favourite` (`RID`, `UID`) VALUES
(0, 2),
(4, 0),
(4, 1),
(5, 0),
(5, 1),
(6, 1),
(9, 0),
(10, 0),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `ingredients`
--

CREATE TABLE `ingredients` (
  `InID` int(11) NOT NULL,
  `RID` int(11) NOT NULL,
  `InName` varchar(50) NOT NULL,
  `Amount` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ingredients`
--

INSERT INTO `ingredients` (`InID`, `RID`, `InName`, `Amount`) VALUES
(131, 35, '', ''),
(132, 35, '', ''),
(133, 35, '', ''),
(134, 36, '', ''),
(135, 36, '', ''),
(136, 36, '', ''),
(137, 37, '', ''),
(138, 37, '', ''),
(139, 37, '', ''),
(140, 38, '', ''),
(141, 38, '', ''),
(142, 38, '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `recipes`
--

CREATE TABLE `recipes` (
  `RID` int(10) UNSIGNED NOT NULL,
  `RName` varchar(50) NOT NULL,
  `Introduction` varchar(1500) NOT NULL,
  `Imagepath` varchar(100) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Imagename` varchar(100) NOT NULL,
  `Cuisine` varchar(20) NOT NULL,
  `Author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `recipes`
--

INSERT INTO `recipes` (`RID`, `RName`, `Introduction`, `Imagepath`, `Category`, `Imagename`, `Cuisine`, `Author`) VALUES
(35, '1', '', '/xampp/htdocs/', 'drink', '', 'Chinese', '1'),
(36, '12', '', '/xampp/htdocs/', 'drink', '', 'ltalian', '1'),
(37, '12', '', '/xampp/htdocs/', 'drink', '', 'German', '1'),
(38, '124', '', '/xampp/htdocs/', 'drink', '', 'Chinese', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `step`
--

CREATE TABLE `step` (
  `RID` int(10) UNSIGNED NOT NULL,
  `SID` int(3) UNSIGNED NOT NULL,
  `Method` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `step`
--

INSERT INTO `step` (`RID`, `SID`, `Method`) VALUES
(35, 90, ''),
(35, 91, ''),
(35, 92, ''),
(36, 93, ''),
(36, 94, ''),
(36, 95, ''),
(37, 96, ''),
(37, 97, ''),
(37, 98, ''),
(38, 99, ''),
(38, 100, ''),
(38, 101, '');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Password`, `Email`) VALUES
(0, 'test', 'test', 'test@gmail.com'),
(1, '1', '1', '1@1.com'),
(2, '2', '2', '17056079d@connect.polyu.hk');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`RID`,`UID`);

--
-- 資料表索引 `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`InID`);

--
-- 資料表索引 `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`RID`),
  ADD UNIQUE KEY `RID` (`RID`);

--
-- 資料表索引 `step`
--
ALTER TABLE `step`
  ADD PRIMARY KEY (`SID`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `InID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `recipes`
--
ALTER TABLE `recipes`
  MODIFY `RID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `step`
--
ALTER TABLE `step`
  MODIFY `SID` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

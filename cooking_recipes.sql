-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-29 12:29:47
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
-- 資料表結構 `ingradients`
--

CREATE TABLE `ingradients` (
  `InID` int(10) NOT NULL,
  `InName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `recipes`
--

CREATE TABLE `recipes` (
  `RID` int(10) NOT NULL,
  `RName` varchar(50) NOT NULL,
  `Introduction` varchar(150) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `Category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `step`
--

CREATE TABLE `step` (
  `RID` int(10) NOT NULL,
  `SID` int(3) NOT NULL,
  `Method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `step_ingredients`
--

CREATE TABLE `step_ingredients` (
  `RID` int(10) NOT NULL,
  `SID` int(3) NOT NULL,
  `InID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `UserID` int(10) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ingradients`
--
ALTER TABLE `ingradients`
  ADD PRIMARY KEY (`InID`),
  ADD UNIQUE KEY `InID` (`InID`);

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
  ADD PRIMARY KEY (`RID`,`SID`),
  ADD UNIQUE KEY `RID` (`RID`),
  ADD KEY `SID` (`SID`);

--
-- 資料表索引 `step_ingredients`
--
ALTER TABLE `step_ingredients`
  ADD PRIMARY KEY (`RID`,`SID`,`InID`),
  ADD UNIQUE KEY `RID` (`RID`,`InID`),
  ADD KEY `SID` (`SID`,`InID`),
  ADD KEY `InID` (`InID`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-04-09 20:13:30
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

-- --------------------------------------------------------

--
-- 資料表結構 `ingredients`
--

CREATE TABLE `ingredients` (
  `InID` int(11) NOT NULL,
  `RID` int(11) NOT NULL,
  `InName` varchar(30) NOT NULL,
  `Amount` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `ingredients`
--

INSERT INTO `ingredients` (`InID`, `RID`, `InName`, `Amount`) VALUES
(35, 0, 'beef chuck roast', '3 pound'),
(36, 0, 'water', '1 cup'),
(37, 0, 'garlic', '5 cloves'),
(38, 5, '', ''),
(39, 5, '', ''),
(40, 5, '', ''),
(41, 6, 'asdddddddddddddd', 'asd'),
(42, 6, 'asddddddddd', 'asd'),
(43, 6, 'asddddd', 'asd'),
(44, 7, '一二三四', '一二三四'),
(45, 7, '一二三四', '一二三四'),
(46, 7, '一二三四', '一二三四'),
(47, 8, 'asd', 'asd'),
(48, 8, 'asd', 'asd'),
(49, 8, 'asd', 'ads'),
(50, 9, 'asd', 'as'),
(51, 9, 'asd', 'asd'),
(52, 9, 'asd', 'asd'),
(53, 10, 'awe', 'awe'),
(54, 10, 'awe', 'awe'),
(55, 10, 'awe', 'awe'),
(56, 11, '', ''),
(57, 11, '', ''),
(58, 11, '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `recipes`
--

CREATE TABLE `recipes` (
  `RID` int(10) UNSIGNED NOT NULL,
  `RName` varchar(50) NOT NULL,
  `Introduction` varchar(300) NOT NULL,
  `Imagepath` varchar(100) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Imagename` varchar(100) NOT NULL,
  `Cuisine` varchar(20) NOT NULL,
  `Author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `recipes`
--

INSERT INTO `recipes` (`RID`, `RName`, `Introduction`, `Imagepath`, `Category`, `Imagename`, `Cuisine`, `Author`) VALUES
(4, 'Stove Pot Roast With Mashed Potatoes', 'Wonderful flavors make the meat the star of the dish by combining simple ingredients for a mouth-watering meal. Our southern family has passed this re', '/xampp/htdocs/', 'dishes', 'stove.jpg', 'Global', 0),
(5, '1', '', '/xampp/htdocs/', 'drink', '', 'Chinese', 0),
(6, '1asdasd', 'asddddddddddddddddddddddddsdaaaaaaaaaa', '/xampp/htdocs/', 'drink', '', 'Chinese', 0),
(7, '一二三四一二三四', '一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四一二三四', '/xampp/htdocs/', 'drink', '', 'Chinese', 0),
(8, 'asd', 'asd', '/xampp/htdocs/', 'drink', '', 'Chinese', 0),
(9, 'asdasd', 'asdasd', '/xampp/htdocs/', 'drink', '', 'Chinese', 0),
(10, 'awe', 'awe', '/xampp/htdocs/', 'drink', '', 'Chinese', 1),
(11, 'asd', 'as', '/xampp/htdocs/', 'drink', 'stove test.jpg', 'Chinese', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `step`
--

CREATE TABLE `step` (
  `RID` int(10) UNSIGNED NOT NULL,
  `SID` int(3) UNSIGNED NOT NULL,
  `Method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `step`
--

INSERT INTO `step` (`RID`, `SID`, `Method`) VALUES
(0, 11, 'Season chuck roast with salt and black pepper; sear in a large, deep skillet or Dutch oven over medi'),
(0, 12, 'Pour beef broth and water into the skillet with roast. Arrange onion wedges and garlic cloves around'),
(0, 13, 'Cover potatoes with water in a large pot and bring to a boil; reduce heat to low and simmer until te'),
(5, 14, ''),
(5, 15, ''),
(5, 16, ''),
(6, 17, 'asd'),
(6, 18, 'asd'),
(6, 19, 'asddasasd'),
(6, 20, 'dad'),
(7, 21, '一二三四'),
(7, 22, '一二三四'),
(7, 23, '一二三四'),
(8, 24, 'ads'),
(8, 25, 'asd'),
(8, 26, 'd'),
(9, 27, 'ads'),
(9, 28, 'ads'),
(9, 29, 'asd'),
(10, 30, 'aew'),
(10, 31, 'aewa'),
(10, 32, 'we'),
(11, 33, ''),
(11, 34, ''),
(11, 35, '');

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
(1, '1', '1', '1@1.com');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`RID`,`UID`),
  ADD UNIQUE KEY `RID` (`RID`),
  ADD UNIQUE KEY `UID` (`UID`);

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
  MODIFY `InID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `recipes`
--
ALTER TABLE `recipes`
  MODIFY `RID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `step`
--
ALTER TABLE `step`
  MODIFY `SID` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

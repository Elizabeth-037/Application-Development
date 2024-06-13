-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-04-17 10:44:53
-- 服务器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `Feedback`
--

-- --------------------------------------------------------

--
-- 表的结构 `userfeedback`
--

CREATE TABLE `userfeedback` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `feedback_type` varchar(50) NOT NULL,
  `feedback_content` text NOT NULL,
  `satisfaction` varchar(20) NOT NULL,
  `urgency` varchar(20) NOT NULL,
  `additional_description` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `userfeedback`
--

INSERT INTO `userfeedback` (`id`, `order_number`, `contact_info`, `feedback_type`, `feedback_content`, `satisfaction`, `urgency`, `additional_description`, `image_path`) VALUES
(1, '123', '12345', '产品问题', '1', 'good', '', '很好', ''),
(3, '0809', '334455', '客户服务', '我觉得客户服务很好', 'average', '', '我觉得上次服务也很好', ''),
(6, '123', '13111', '客户服务', '我觉得很好', 'poor', '', '20240414尝试增加图片', 'uploads/DSC02866.JPG'),
(7, '123', '334455', '客户服务', '我觉得很好', 'poor', '', '很好', 'uploads/DSC02914.JPG'),
(11, '123456', '13120592370', '物流问题', 'haohaohao', 'poor', '', 'henhao', 'uploads/DSC02892.JPG'),
(12, '123456', '13120592370', '物流问题', 'haohaohao', 'poor', '', 'henhao', 'uploads/截屏2024-04-14 17.27.31.png'),
(13, '123456', '13120592370', '物流问题', 'haohaohao', 'poor', '', 'henhao', 'uploads/截屏2024-04-14 17.27.31.png'),
(15, '222222', '334455', '产品问题', '上传的图片找不到了', 'good', '', '上传的图片找不到了', 'uploads/截屏2024-04-14 17.27.31.png'),
(18, 'xin', '12345', '物流问题', '新增紧急程度', 'average', '4', '很好', 'newuploads/DSC02866.JPG'),
(19, '000', '13111', '客户服务', '2222', 'good', '1', '111', 'newuploads/DSC02866.JPG'),
(21, '123', '13120592370', '产品问题', '去瞧瞧', 'average', '2', '右边开始放图片', 'newuploads/'),
(22, '000', '13111', 'Customer Service Issue', 'very good', 'average', '2', 'none', 'newuploads/4.png'),
(23, '123456', '13111', 'Logistic Issue', '111', 'average', '3', '1111', 'newuploads/3.png'),
(24, '123456', '1888', 'Logistic Issue', '111', 'average', '3', '1111', 'newuploads/3.png'),
(25, '123456', '1888', 'Logistic Issue', '111', 'average', '3', '1111', 'newuploads/3.png'),
(26, '123456', '1888', 'Logistic Issue', '111', 'average', '3', '1111', 'newuploads/3.png'),
(27, '123456', '1888', 'Logistic Issue', '111', 'average', '3', '1111', 'newuploads/1.png'),
(28, '123456', '12345', 'Customer Service Issue', 'very good', 'average', '3', 'nothing', 'newuploads/4.png'),
(29, '123456789', '000000', 'Customer Service Issue', 'very good', 'average', '4', 'nothing', 'newuploads/4.png');

--
-- 转储表的索引
--

--
-- 表的索引 `userfeedback`
--
ALTER TABLE `userfeedback`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `userfeedback`
--
ALTER TABLE `userfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

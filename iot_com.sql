-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-02-06 18:39:24
-- 服务器版本： 5.6.51-log
-- PHP 版本： 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `iot.com`
--
CREATE DATABASE IF NOT EXISTS `iot.com` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `iot.com`;

-- --------------------------------------------------------

--
-- 表的结构 `iotuser`
--

CREATE TABLE `iotuser` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `status` bit(1) NOT NULL DEFAULT b'0' COMMENT '状态',
  `power` int(11) NOT NULL DEFAULT '2' COMMENT '权限',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `chinese` varbinary(150) NOT NULL COMMENT '昵称',
  `password` char(32) NOT NULL COMMENT '密码',
  `salt` char(4) NOT NULL COMMENT '盐',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `creatdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='iot网站用户表';

--
-- 转存表中的数据 `iotuser`
--

INSERT INTO `iotuser` (`id`, `status`, `power`, `name`, `chinese`, `password`, `salt`, `date`, `creatdate`) VALUES
(1, b'0', 1, 'Admin0', 0x30e58fb7e7aea1e79086e59198, 'f2bfb6fadb0c6df382f60d302d836844', '6325', '2022-02-06 10:00:18', '2022-02-05 15:16:40'),
(2, b'0', 3, 'test0', 0xe6b58be8af9530, '0e36d938a29d094f1e91cedcd25a2c58', '4317', '2022-02-06 09:17:06', '2022-02-06 09:17:06');

-- --------------------------------------------------------

--
-- 表的结构 `iotuser_func`
--

CREATE TABLE `iotuser_func` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `status` bit(1) NOT NULL DEFAULT b'0' COMMENT '状态',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `chinese` varbinary(150) NOT NULL COMMENT '中文',
  `parent` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '爸爸',
  `level` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '级别',
  `power` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '权限'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='功能列表';

--
-- 转存表中的数据 `iotuser_func`
--

INSERT INTO `iotuser_func` (`id`, `status`, `name`, `chinese`, `parent`, `level`, `power`) VALUES
(1, b'0', 'home', 0xe68891e79a84e4b8bbe9a1b5, 0, 0, 1),
(2, b'0', 'manage', 0xe7bd91e7ab99e7aea1e79086, 0, 0, 2),
(3, b'0', 'func', 0xe7bd91e7ab99e58a9fe883bde7aea1e79086, 2, 1, 3),
(4, b'0', 'user', 0xe794a8e688b7e7aea1e79086, 2, 1, 6),
(5, b'0', 'power', 0xe69d83e99990e7aea1e79086, 2, 1, 8),
(11, b'0', 'demo0', 0xe7a4bae4be8b30, 0, 0, 32),
(7, b'0', 'cache', 0xe7bc93e5ad98e7aea1e79086, 2, 1, 10),
(8, b'0', 'group', 0xe794a8e688b7e7bb84e7aea1e79086, 2, 1, 11),
(9, b'1', 'test', 0xe6b58be8af95, 0, 0, 23),
(12, b'0', 'demo1', 0xe7a4bae4be8b31, 0, 0, 33),
(13, b'0', 'demo2', 0xe7a4bae4be8b32, 0, 0, 34),
(14, b'0', 'demosub0', 0xe7a4bae4be8be584bfe5ad9030, 13, 1, 35),
(15, b'0', 'demosub1', 0xe7a4bae4be8be584bfe5ad9031, 13, 1, 36);

-- --------------------------------------------------------

--
-- 表的结构 `iotuser_group`
--

CREATE TABLE `iotuser_group` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `chinese` varbinary(150) NOT NULL COMMENT '中文',
  `power` varchar(250) NOT NULL DEFAULT '' COMMENT '权限',
  `parent` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '爸爸'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `iotuser_group`
--

INSERT INTO `iotuser_group` (`id`, `name`, `chinese`, `power`, `parent`) VALUES
(1, 'system_super_advanced_highest_administrators', 0xe7b3bbe7bb9fe8b685e7baa7e58588e8bf9be69c80e9ab98e7baa7e588abe7aea1e79086e59198, 'all', 0),
(2, 'anonymous', 0xe58cbfe5908de794a8e688b7, '1', 0),
(3, 'basic_user_group', 0xe59fbae69cace794a8e688b7e7bb84, '1', 0),
(4, 'test', 0xe6b58be8af95, '2,8,11,3,16,20,6', 0);

-- --------------------------------------------------------

--
-- 表的结构 `iotuser_power`
--

CREATE TABLE `iotuser_power` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `chinese` varbinary(150) NOT NULL COMMENT '中文',
  `parent` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '爸爸',
  `type` int(10) UNSIGNED NOT NULL COMMENT '类型',
  `value` varchar(50) NOT NULL DEFAULT '' COMMENT '值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限表';

--
-- 转存表中的数据 `iotuser_power`
--

INSERT INTO `iotuser_power` (`id`, `name`, `chinese`, `parent`, `type`, `value`) VALUES
(1, 'home', 0xe68891e79a84e4b8bbe9a1b5, 0, 5, '1'),
(2, 'manage', 0xe7bd91e7ab99e7aea1e79086, 0, 5, '1'),
(3, 'func', 0xe7bd91e7ab99e58a9fe883bde7aea1e79086, 2, 5, '1'),
(4, 'create', 0xe5a29ee58aa0e58a9fe883bd, 3, 1, '1'),
(5, 'delete', 0xe588a0e999a4e58a9fe883bd, 3, 2, '1'),
(6, 'user', 0xe794a8e688b7e7aea1e79086, 2, 5, '1'),
(7, 'update', 0xe4bfaee694b9e58a9fe883bd, 3, 3, '1'),
(8, 'power', 0xe69d83e99990e7aea1e79086, 2, 5, '1'),
(28, 'create', 0xe5a29ee58aa0e794a8e688b7, 6, 1, '1'),
(10, 'cache', 0xe7bc93e5ad98e7aea1e79086, 2, 5, '1'),
(11, 'group', 0xe794a8e688b7e7bb84e7aea1e79086, 2, 5, '1'),
(12, 'retrieve', 0xe69fa5e8afa2e58a9fe883bd, 3, 4, '1'),
(13, 'create', 0xe5a29ee58aa0e69d83e99990, 8, 1, '1'),
(14, 'delete', 0xe588a0e999a4e69d83e99990, 8, 2, '1'),
(15, 'update', 0xe4bfaee694b9e69d83e99990, 8, 3, '1'),
(16, 'retrieve', 0xe69fa5e8afa2e69d83e99990, 8, 4, '1'),
(17, 'create', 0xe5a29ee58aa0e794a8e688b7e7bb84, 11, 1, '1'),
(18, 'delete', 0xe588a0e999a4e794a8e688b7e7bb84, 11, 2, '1'),
(19, 'update', 0xe4bfaee694b9e794a8e688b7e7bb84, 11, 3, '1'),
(20, 'retrieve', 0xe69fa5e8afa2e794a8e688b7e7bb84, 11, 4, '1'),
(21, 'delete', 0xe588a0e999a4e7bc93e5ad98, 10, 2, '1'),
(27, 'delete', 0xe588a0e999a4e794a8e688b7, 6, 2, '1'),
(23, 'test', 0xe6b58be8af95, 0, 5, '1'),
(26, 'quote', 0xe5bc95e794a8e69d83e99990, 8, 4, '1'),
(29, 'update', 0xe4bfaee694b9e794a8e688b7, 6, 3, '1'),
(30, 'retrieve', 0xe69fa5e8afa2e794a8e688b7, 6, 4, '1'),
(31, 'quote', 0xe5bc95e794a8e794a8e688b7e7bb84, 11, 4, '1'),
(32, 'demo0', 0xe7a4bae4be8b30, 0, 5, '1'),
(33, 'demo1', 0xe7a4bae4be8b31, 0, 5, '1'),
(34, 'demo2', 0xe7a4bae4be8b32, 0, 5, '1'),
(35, 'demosub0', 0xe7a4bae4be8be584bfe5ad9030, 34, 5, '1'),
(36, 'demosub1', 0xe7a4bae4be8be584bfe5ad9031, 34, 5, '1');

--
-- 转储表的索引
--

--
-- 表的索引 `iotuser`
--
ALTER TABLE `iotuser`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `iotuser_func`
--
ALTER TABLE `iotuser_func`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `iotuser_group`
--
ALTER TABLE `iotuser_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `iotuser_power`
--
ALTER TABLE `iotuser_power`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `iotuser`
--
ALTER TABLE `iotuser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `iotuser_func`
--
ALTER TABLE `iotuser_func`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `iotuser_group`
--
ALTER TABLE `iotuser_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `iotuser_power`
--
ALTER TABLE `iotuser_power`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

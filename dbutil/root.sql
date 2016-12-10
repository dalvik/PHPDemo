-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 12, 2016 at 03:17 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `root`
--

-- --------------------------------------------------------

--
-- Table structure for table `br_friend`
--

CREATE TABLE IF NOT EXISTS `br_friend` (
  `_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `friend_id` int(11) NOT NULL COMMENT '好友ID',
  `nick_name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '好友昵称',
  `header_icon` varchar(100) NOT NULL COMMENT '好友头像',
  `signature` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '好友签名',
  `user_type` int(11) NOT NULL COMMENT '好友类型',
  `user_id` int(11) NOT NULL COMMENT '自己的用户ID',
  `friend_status` int(11) NOT NULL COMMENT '好友状态1正常-1好友解除-2黑名单',
  PRIMARY KEY (`_id`),
  UNIQUE KEY `friend_id` (`friend_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `br_friend`
--

INSERT INTO `br_friend` (`_id`, `friend_id`, `nick_name`, `header_icon`, `signature`, `user_type`, `user_id`, `friend_status`) VALUES
(1, 123456789, '那么', 'header/a.jpg', '个性签名', 1, 963852741, 1),
(2, 123456780, '那么', 'header/a.jpg', '个性签名', 1, 963852741, 1);

-- --------------------------------------------------------

--
-- Table structure for table `br_user`
--

CREATE TABLE IF NOT EXISTS `br_user` (
  `_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `usercode` int(11) NOT NULL COMMENT '用户注册码',
  `telephone` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(32) NOT NULL COMMENT '邮箱地址',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `realname` varchar(32) NOT NULL COMMENT '真实姓名',
  `nickname` varchar(32) DEFAULT NULL COMMENT '用户昵称',
  `sex` int(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` double NOT NULL COMMENT '生日',
  `height` int(3) NOT NULL DEFAULT '0' COMMENT '身高',
  `weight` int(3) NOT NULL DEFAULT '0' COMMENT '体重',
  `headicon` varchar(32) NOT NULL COMMENT '头像',
  `company` varchar(32) NOT NULL COMMENT '公司名称',
  `vocation` varchar(32) NOT NULL COMMENT '行业',
  `school` varchar(32) NOT NULL COMMENT '学校',
  `signature` varchar(80) NOT NULL COMMENT '签名',
  `interest` varchar(50) NOT NULL COMMENT '兴趣',
  `balance` int(5) NOT NULL DEFAULT '0' COMMENT '余额',
  `technique` int(5) NOT NULL COMMENT '技能值',
  `rongyuntoken` varchar(50) NOT NULL COMMENT '融云token',
  `isfristlogin` int(1) NOT NULL DEFAULT '0' COMMENT '是否首次登陆',
  `rich` int(1) NOT NULL DEFAULT '0' COMMENT '土豪',
  `invite_code` varchar(10) NOT NULL COMMENT '邀请码',
  `invite_time` double NOT NULL COMMENT '邀请时间',
  `register_time` double NOT NULL COMMENT '注册时间',
  `user_status` int(1) NOT NULL DEFAULT '0' COMMENT '用户状态',
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '类型：官方或其他',
  PRIMARY KEY (`_id`),
  UNIQUE KEY `usercode` (`usercode`,`telephone`,`email`),
  KEY `_id` (`_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `br_user`
--

INSERT INTO `br_user` (`_id`, `usercode`, `telephone`, `email`, `password`, `realname`, `nickname`, `sex`, `birthday`, `height`, `weight`, `headicon`, `company`, `vocation`, `school`, `signature`, `interest`, `balance`, `technique`, `rongyuntoken`, `isfristlogin`, `rich`, `invite_code`, `invite_time`, `register_time`, `user_status`, `type`) VALUES
(1, 963852741, '13539865236', 'abc.acc@123.com', '', 'real', 'nick', 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', 0, 0, '', 0, 0, 0, 0),
(3, 3, 'abc@123.com', '', '123456', '', NULL, 0, 0, 0, 0, '', '', '', '', '', '', 0, 0, '', 0, 0, '123456', 1468832513, 1468838093, 1000, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

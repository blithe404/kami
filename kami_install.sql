/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.10.10
 Source Server Type    : MySQL
 Source Server Version : 50558
 Source Host           : 192.168.10.10
 Source Database       : kami

 Target Server Type    : MySQL
 Target Server Version : 50558
 File Encoding         : utf-8

 Date: 01/13/2018 04:28:00 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `k_admin`
-- ----------------------------
DROP TABLE IF EXISTS `k_admin`;
CREATE TABLE `k_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `datetime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `k_admin`
-- ----------------------------
BEGIN;
INSERT INTO `k_admin` VALUES ('1', 'admin', '282a694d196a31babc741e2d1a7c8c7f', '192.168.10.1', '1515785876', '1515787574');
COMMIT;

-- ----------------------------
--  Table structure for `k_bank`
-- ----------------------------
DROP TABLE IF EXISTS `k_bank`;
CREATE TABLE `k_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `card` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `k_bank`
-- ----------------------------
BEGIN;
INSERT INTO `k_bank` VALUES ('1', '工商银行', '钱老板', '66666666666666666');
COMMIT;

-- ----------------------------
--  Table structure for `k_conf`
-- ----------------------------
DROP TABLE IF EXISTS `k_conf`;
CREATE TABLE `k_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `k_conf`
-- ----------------------------
BEGIN;
INSERT INTO `k_conf` VALUES ('1', 'site_name', '站点名称', '一直游点卡商城');
COMMIT;

-- ----------------------------
--  Table structure for `k_file`
-- ----------------------------
DROP TABLE IF EXISTS `k_file`;
CREATE TABLE `k_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `k_img`
-- ----------------------------
DROP TABLE IF EXISTS `k_img`;
CREATE TABLE `k_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `k_img`
-- ----------------------------
BEGIN;
INSERT INTO `k_img` VALUES ('1', '0', 'logo', '/Uploads/siteimg/2018-01-13/5a58ff91663fa.jpg'), ('2', '2', 'banner', '/Uploads/siteimg/2018-01-13/5a59037824f6a.png'), ('3', '3', 'img1', '/Uploads/siteimg/2018-01-13/5a58fe1d71ca5.jpg'), ('4', '4', 'img2', '/Uploads/siteimg/2018-01-13/5a58fe2809597.jpg'), ('5', '4', 'img3', '/Uploads/siteimg/2018-01-13/5a58fe360aaa3.png'), ('6', '8', 'img4', '/Uploads/siteimg/2018-01-13/5a59038e06ea7.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `k_order`
-- ----------------------------
DROP TABLE IF EXISTS `k_order`;
CREATE TABLE `k_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `number` int(11) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `datetime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `k_pay_order`
-- ----------------------------
DROP TABLE IF EXISTS `k_pay_order`;
CREATE TABLE `k_pay_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `money` varchar(255) NOT NULL,
  `paytime` int(11) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `datetime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `k_product`
-- ----------------------------
DROP TABLE IF EXISTS `k_product`;
CREATE TABLE `k_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sale` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `img` varchar(255) NOT NULL,
  `datetime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `k_product`
-- ----------------------------
BEGIN;
INSERT INTO `k_product` VALUES ('2', '2', '电信话费充值卡密', '101', '10.00', '/Uploads/product/2018-01-12/5a58631820a52.png', '1515741988', '1515775517'), ('3', '3', '移动话费充值卡密', '0', '20.00', '/Uploads/product/2018-01-12/5a5863398eee3.png', '1515742010', '1515775525'), ('4', '5', '联通话费充值卡密', '1', '30.00', '/Uploads/product/2018-01-12/5a58635b4806a.png', '1515742043', '1515775275'), ('5', '4', 'Q币充值卡密', '0', '40.00', '/Uploads/product/2018-01-12/5a58636c4a20a.png', '1515742061', '1515775263'), ('8', '6', '盛大点券充值卡密', '0', '89.00', '/Uploads/product/2018-01-12/5a587da432fff.gif', '1515748772', '1515775542');
COMMIT;

-- ----------------------------
--  Table structure for `k_product_category`
-- ----------------------------
DROP TABLE IF EXISTS `k_product_category`;
CREATE TABLE `k_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `k_product_category`
-- ----------------------------
BEGIN;
INSERT INTO `k_product_category` VALUES ('2', '电信', '1'), ('3', '移动', '2'), ('4', 'Q币', '4'), ('5', '联通', '3'), ('6', '盛大点券', '5');
COMMIT;

-- ----------------------------
--  Table structure for `k_user`
-- ----------------------------
DROP TABLE IF EXISTS `k_user`;
CREATE TABLE `k_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `idcard` varchar(255) NOT NULL,
  `idcard_img` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bankcard` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `bind_bank` int(11) NOT NULL DEFAULT '0',
  `datetime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;

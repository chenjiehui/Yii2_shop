

CREATE TABLE `shop_admin`(
  `adminId` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `adminUser`VARCHAR(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `adminPass` CHAR(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `adminEmail` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `loginTime` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录时间',
  `loginIp` BIGINT NOT NULL DEFAULT '0' COMMENT '登录IP',
  `createTime` INT UNSIGNED NOT NULL  DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`adminId`),
  UNIQUE shop_admin_adminUser_adminPass(`adminUser`,`adminPass`),
  UNIQUE shop_admin_adminUser_adminMail(`adminUser`,`adminEmail`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO shop_admin(adminUser, adminPass, adminEmail, loginTime) VALUES('admin',md5('chenjiehui'),'599194429@qq.com',unix_timestamp());


CREATE TABLE IF NOT EXISTS `shop_user`(
  `userId` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `userName` VARCHAR(32) NOT NULL DEFAULT  '',
  `userPass` CHAR(32) NOT NULL DEFAULT '',
  'userEmail' VARCHAR(100) NOT NULL DEFAULT '',
  `createTime` INT UNSIGNED NOT NULL DEFAULT '0',
  UNIQUE shop_user_userName_userPass(`userName`,`userPass`),
  UNIQUE shop_user_userEmail_userPass(`userEmail`,`userPass`),
  PRIMARY KEY (`userId`)
)ENGINE=InnoDB DEFAULT CHARSET =utf8;

CREATE TABLE IF NOT EXISTS shop_profile(
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `trueName` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `age` TINYINT NOT NULL  DEFAULT '' COMMENT '年龄',
  `sex` ENUM('0','1','2') NOT NULL DEFAULT '0' COMMENT '性别',
  `birthDay` DATE NOT NULL DEFAULT '2016-01-01',
  `nickName` VARCHAR(32) NOT NULL DEFAULT '',
  `company` VARCHAR(100) NOT NULL DEFAULT '',
  `userId` BIGINT UNSIGNED NOT NULL DEFAULT '0',
  `creatrTime` INT UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE shop_profile_userid(`userId`)
)ENGINE =InnoDB DEFAULT CHARSET =utf8;

CREATE TABLE IF NOT EXISTS `shop_category`(
  `cateid` BIGINT UNSIGNED NOT NULL  AUTO_INCREMENT,
  `title` VARCHAR(32) NOT NULL  DEFAULT '',
  `parentid` BIGINT UNSIGNED NOT NULL DEFAULT '0',
  `createtime` INT UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`cateid`),
  KEY shop_category_parentid(`parentid`)
)ENGINE =InnoDB DEFAULT CHARSET =utf8;

CREATE TABLE IF NOT EXISTS `shop_product`(
  `productid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cateid` BIGINT UNSIGNED NOT NULL  DEFAULT '0',
  `title` VARCHAR(200) not NULL DEFAULT '',
  `descr` TEXT,
  `num` BIGINT UNSIGNED NOT NULL DEFAULT '0',
  `price` DECIMAL(10,2) NOT NULL DEFAULT '00000000.00',
  `issale` ENUM('0','1') NOT NULL DEFAULT '0',
  `saleprice` DECIMAL(10,2) NOT NULL DEFAULT '00000000.00',
  `isshot` ENUM('0','1') NOT NULL DEFAULT '0',
  'createtime' INT UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`productid`),
  KEY shop_product_cateid(`cateid`)
)ENGINE = InnoDB DEFAULT CHARSET utf8;

DROP TABLE IF EXISTS `shop_cart`;
CREATE TABLE IF NOT EXISTS `shop_cart`(
    `cartid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `productid` BIGINT UNSIGNED NOT NULL DEFAULT '0',
    `productnum` INT UNSIGNED NOT NULL DEFAULT '0',
    `price` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
    `userid` BIGINT UNSIGNED NOT NULL DEFAULT '0',
    `createtime` INT UNSIGNED NOT NULL DEFAULT '0',
    KEY shop_cart_productid(`productid`),
    KEY shop_cart_userid(`userid`)
)ENGINE=InnoDB DEFAULT CHARSET='utf8';

DROP TABLE IF EXISTS `shop_order`;
CREATE TABLE IF NOT EXISTS `shop_order`(
    `orderid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userid` BIGINT UNSIGNED NOT NULL DEFAULT '0',
    `addressid` BIGINT UNSIGNED NOT NULL DEFAULT '0',
    `amount` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
    `status` INT UNSIGNED NOT NULL DEFAULT '0',
    `expressid` INT UNSIGNED NOT NULL DEFAULT '0',
    `expressno` VARCHAR(50) NOT NULL DEFAULT '',
    `tradeno` VARCHAR(100) NOT NULL DEFAULT '',
    `tradeext` TEXT,
    `createtime` INT UNSIGNED NOT NULL DEFAULT '0',
    `updatetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    KEY shop_order_userid(`userid`),
    KEY shop_order_addressid(`addressid`),
    KEY shop_order_expressid(`expressid`)
)ENGINE=InnoDB DEFAULT CHARSET='utf8';


DROP TABLE IF EXISTS `shop_order_detail`;
CREATE TABLE IF NOT EXISTS `shop_order_detail`(
    `detailid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `productid` BIGINT UNSIGNED NOT NULL DEFAULT '0',
    `price` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
    `productnum` INT UNSIGNED NOT NULL DEFAULT '0',
    `orderid` BIGINT UNSIGNED NOT NULL DEFAULT '0',
    `createtime` INT UNSIGNED NOT NULL DEFAULT '0',
    KEY shop_order_detail_productid(`productid`),
    KEY shop_order_detail_orderid(`orderid`)
)ENGINE=InnoDB DEFAULT CHARSET='utf8';


DROP TABLE IF EXISTS `shop_address`;
CREATE TABLE IF NOT EXISTS `shop_address`(
    `addressid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `firstname` VARCHAR(32) NOT NULL DEFAULT '',
    `lastname` VARCHAR(32) NOT NULL DEFAULT '',
    `company` VARCHAR(100) NOT NULL DEFAULT '',
    `address` TEXT,
    `postcode` CHAR(6) NOT NULL DEFAULT '',
    `email` VARCHAR(100) NOT NULL DEFAULT '',
    `telephone` VARCHAR(20) NOT NULL DEFAULT '',
    `userid` BIGINT UNSIGNED NOT NULL DEFAULT '0',
    `createtime` INT UNSIGNED NOT NULL DEFAULT '0',
    KEY shop_address_userid(`userid`)
)ENGINE=InnoDB DEFAULT CHARSET='utf8';

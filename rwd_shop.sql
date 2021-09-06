drop database if exists rwd_shop;
CREATE DATABASE `rwd_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rwd_shop`;


create table product (
	id int auto_increment primary key, 
	name varchar(200) not null, 
	price int not null
);


CREATE TABLE `user` (
  `id` int auto_increment primary key, 
  `user1` varchar(20) NOT NULL,
  `pasd` varchar(20) NOT NULL,
  `mail` varchar(20) NOT NULL,  
  `name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS `order_form` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(128) NOT NULL COMMENT '標題',
  `address`  MEDIUMTEXT  NOT NULL,
  price int ,
  `mail` varchar(20) ,
  `product`  MEDIUMTEXT  NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  ;

CREATE TABLE IF NOT EXISTS `forum` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(20) NOT NULL,
  `Title` varchar(128) NOT NULL COMMENT '標題',
  `article`  MEDIUMTEXT  NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  ;

--
-- 列出以下資料庫的數據： `order_form`
--

INSERT INTO `order_form` (`Time`, `name`, `address`,`price`,`mail`,`product`) VALUES
('2011-05-17 14:13:45', '0900111111','新北市中和區' ,'1200','123@gmail.com','連身裙'),
('2011-05-17 14:13:45', '0900111112','北護大資管系' ,'200','aa1113321@yahoo.com.tw','褲子'),
('2011-05-17 14:13:45', '0900111113','淡江大學資管系' ,'880','zzx5566@gmail.com','上衣');

INSERT INTO `forum` (`Time`, `name`,`Title`, `article`) VALUES
('2011-05-17 14:13:45', "test" ,'衣服好好看喔','紅色的大衣材質好不好啊' ),
('2011-05-17 14:13:45', "test" ,'好貴','大衣好貴唷~~~' ),
('2011-05-17 14:13:45', "test2" ,'防災用品安全嗎','防災用品材質好不好啊' ),
('2011-05-17 14:13:45', "test2" ,'想買想買','地震好可怕' ),
('2011-05-17 14:13:45', "test2" ,'安全第一','安全第一' );

-- --------------------------------------------------------
INSERT INTO `user` (`user1`, `pasd`, `mail`, `address`, `name`) VALUES
('admin', 'admin', 'admin', '台北', 'admin'),
('test', '1234', '1111', '1', 'test');


insert into product values(null, '地震防災急救避難包', 1300);
insert into product values(null, '戶外急難求生繩防災手錶', 1270);
insert into product values(null, 'CLUB地震防災包',2900);
insert into product values(null, 'CLUB防災頭套', 450);
insert into product values(null, 'JOANNA純棉防災頭套二入', 650);
insert into product values(null, '專業調焦手電筒', 2470);
insert into product values(null, '德國LED獨角仙手電筒', 1260);
insert into product values(null, '伸縮調焦手電筒', 999);
insert into product values(null, '金德恩急救防災避難包', 1100);



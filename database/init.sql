CREATE TABLE `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nurse_id` int(10) unsigned DEFAULT NULL,
  `type` enum('men_zhen','zhu_yuan') DEFAULT NULL COMMENT '患者类型',
  `skill` enum('yi_ban','liang_hao','man_yi') DEFAULT NULL COMMENT '护理技能',
  `attitude` enum('e_lie','yi_ban','liang_hao','man_yi') DEFAULT NULL COMMENT '服务态度',
  `impression` int(10) unsigned DEFAULT NULL COMMENT '总体印象',
  `comment` text COMMENT '评价',
  `pic` varchar(1024) DEFAULT NULL COMMENT '照片',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `nurse` (
  `nurse_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) DEFAULT NULL,
  `extra` text COMMENT 'json',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nurse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
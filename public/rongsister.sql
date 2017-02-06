# Host: localhost  (Version: 5.6.17)
# Date: 2016-12-30 17:13:51
# Generator: MySQL-Front 5.3  (Build 4.214)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "rong_category"
#

DROP TABLE IF EXISTS `rong_category`;
CREATE TABLE `rong_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '// 自动编号',
  `type_name` varchar(20) DEFAULT NULL COMMENT '// 类名',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '// 创建时间',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '// 排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '// 菜单显示 0不显示 1显示',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '// 回收站(0为未删除 1为已删除） 默认为0 ',
  `path` varchar(32) DEFAULT NULL COMMENT '//路由路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='相册分类表';

#
# Data for table "rong_category"
#

/*!40000 ALTER TABLE `rong_category` DISABLE KEYS */;
INSERT INTO `rong_category` VALUES (4,'相册',1483081350,0,1,0,'admin/album'),(7,'蓉姐动态',1483087121,0,1,0,'admin/news');
/*!40000 ALTER TABLE `rong_category` ENABLE KEYS */;

#
# Structure for table "rong_news"
#

DROP TABLE IF EXISTS `rong_news`;
CREATE TABLE `rong_news` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '// 自动编号',
  `title` varchar(126) DEFAULT NULL COMMENT '标题',
  `picture` varchar(126) DEFAULT NULL COMMENT '路径',
  `content` text COMMENT '操作内容',
  `pop` int(10) NOT NULL DEFAULT '0' COMMENT '人气',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0新鲜事 1涨知识',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '// 创建时间',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '// 排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '// 状态',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '// 回收站(0为未删除 1为已删除） 默认为0 ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='新闻表';

#
# Data for table "rong_news"
#

/*!40000 ALTER TABLE `rong_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `rong_news` ENABLE KEYS */;

#
# Structure for table "rong_picture"
#

DROP TABLE IF EXISTS `rong_picture`;
CREATE TABLE `rong_picture` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '// 自动编号',
  `typeid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分类1亲子 2家庭 3美景 4旅行 5工作',
  `picture` varchar(126) DEFAULT NULL COMMENT '路径',
  `picture_name` varchar(32) DEFAULT NULL COMMENT '图片名称',
  `pop` int(10) NOT NULL DEFAULT '0' COMMENT '人气',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '// 创建时间',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '// 排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '// 状态',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '// 回收站(0为未删除 1为已删除） 默认为0 ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='相册表';

#
# Data for table "rong_picture"
#

/*!40000 ALTER TABLE `rong_picture` DISABLE KEYS */;
/*!40000 ALTER TABLE `rong_picture` ENABLE KEYS */;

#
# Structure for table "rong_user"
#

DROP TABLE IF EXISTS `rong_user`;
CREATE TABLE `rong_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '// 自动编号',
  `username` varchar(20) DEFAULT NULL COMMENT '// 用户名',
  `password` varchar(256) DEFAULT NULL COMMENT '// 密码',
  `nickname` varchar(20) DEFAULT NULL COMMENT '// 真实姓名',
  `intro` text,
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '// 创建时间',
  `last_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '// 最后登录的时间',
  `last_login_ip` char(15) NOT NULL DEFAULT '0' COMMENT '// 最后登录的ip',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '// 排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '// 状态',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '// 回收站(0为未删除 1为已删除） 默认为0 ',
  `times` smallint(6) NOT NULL DEFAULT '0' COMMENT '//登录次数',
  `images` varchar(126) DEFAULT NULL COMMENT '//头像',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员表';

#
# Data for table "rong_user"
#

/*!40000 ALTER TABLE `rong_user` DISABLE KEYS */;
INSERT INTO `rong_user` VALUES (1,'siyezhouxin','eyJpdiI6Imw5QnBxdnBsUjEyQm53VHJRK3FFaGc9PSIsInZhbHVlIjoiWUdxTnhlQVVMRXE5RXVqZ0prYkxzeVR1VEdjTlVcL1JcL29nSE5ibTVhTTZzPSIsIm1hYyI6IjlmNzIwOTFiMjExZGMyOGU0NTJjMzIxYTAzY2QzZWIzNTJiYjI3ZDNiYTU5MTllMGI5ZTAyMTRlMGJjYjRiMDMifQ==','李犁','特殊管理员',1482917226,1483087958,'0',0,0,0,1,'public/uploads/20161229164657128.jpg'),(4,'hurong','eyJpdiI6IkYzVURlZDdhbkFuVFo3RXNyMzZuNkE9PSIsInZhbHVlIjoiUHY0WUZkYklnbXVmQ2xcL0E4WTFTOXc9PSIsIm1hYyI6IjY3Yzg1MTcxYzg2ZmZjYzQ1OGVlZTk3ZmM5NDU0NzI2YzgwMDcyNWRlNDgxOGRkYjYyZGMyNmNiZTNjNjFjNzIifQ==','胡蓉','蓉姐是最棒的1234',1482917226,1483088209,'0',0,0,0,22,'public/uploads/20161230170421556.jpg');
/*!40000 ALTER TABLE `rong_user` ENABLE KEYS */;

#
# Structure for table "rong_user_log"
#

DROP TABLE IF EXISTS `rong_user_log`;
CREATE TABLE `rong_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(30) DEFAULT NULL COMMENT '// 用户名',
  `ip` char(15) NOT NULL DEFAULT '0' COMMENT '// 登录的ip',
  `content` text COMMENT '操作内容',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '// 登录时间',
  `system` varchar(255) DEFAULT NULL COMMENT '// 登录的操作系统',
  `browser` varchar(255) DEFAULT NULL COMMENT '// 登录的浏览器',
  `remark` varchar(255) DEFAULT NULL COMMENT '// 备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COMMENT='管理员日志表';

#
# Data for table "rong_user_log"
#

/*!40000 ALTER TABLE `rong_user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `rong_user_log` ENABLE KEYS */;

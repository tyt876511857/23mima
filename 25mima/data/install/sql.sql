create table if not exists #@__category(							/*商品分类表*/
 `id` smallint(5) unsigned not null primary key AUTO_INCREMENT,			/*自增ID*/
 `typename` varchar(90) not null default '',							/*分类名*/
 `unit` varchar(4) not null default '',									/*单位*/
 `pid` smallint(5) unsigned not null default '0',						/*父ID*/
 `rank` tinyint(2) unsigned not null default '5',						/*排序*/
 `is_show` tinyint(1) unsigned not null default '1',					/*是否显示*/
 `show_in_nav` tinyint(1) unsigned not null default '0',				/*是否在导航显示*/
 `keywords` varchar(255) NOT NULL default '',							/*关键字*/
 `description` varchar(255) NOT NULL default '',						/*分类描述*/
 `grade` tinyint(4) NOT NULL default '0',                   /*价格分级*/
 `filter_attr` varchar(255) NOT NULL default '0',						/*属性筛选*/
 `site` varchar(20) NOT NULL default '',										/*模板地址*/
 `content` Text comment '内容'
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__goods(								/*商品表*/
	`goods_id` int(10) unsigned not null primary key auto_increment,     /*自增ID*/
	`cat_id` smallint(5) unsigned not null default '0',				              	/*分类ID*/
	`goods_sn` varchar(60) not null default '',							/*商品货号*/
	`goods_name` varchar(120) not null default '',                      /*商品名称*/
	`click` int(5) unsigned not null default '0',                       /*点击数*/
	`brand_id` smallint(5) unsigned not null default '0',				/*品牌ID*/
	`goods_number` smallint(5) unsigned not null default '0',           /*库存量*/
	`goods_weight` decimal(10,3) unsigned not null default '0.000',		/*商品重量*/
	`market_price` decimal(10,2) unsigned NOT NULL default '0.00',  	/*市场价*/
	`shop_price` decimal(10,2) unsigned NOT NULL default '0.00',		/*本店价*/
	`promote_price` decimal(10,2) unsigned NOT NULL default '0.00',		/*促销价*/
	`promote_start_date` int(11) unsigned NOT NULL default '0',			/*促销开始日期*/
	`promote_end_date` int(11) unsigned NOT NULL default '0',			/*促销结束日期*/
	`warn_number` tinyint(3) unsigned NOT NULL default '1',				/*商品报警数量*/
	`keywords` varchar(255) NOT NULL default '',						/*商品关键字，放在商品页的关键字中，为搜索引擎收录用*/
	`description` varchar(255) NOT NULL default '',						/*简短描述*/			
	`goods_brief` text NOT NULL,										/*详细描述*/
	`goods_thumb` varchar(40) NOT NULL default '',						/*微缩图片*/
	`goods_img` varchar(40) NOT NULL default '',						/*列表页图片*/
	`is_real` tinyint(3) unsigned NOT NULL default '1',					/*是否是实物，1，是；0，否；*/
	`extension_code` varchar(30) NOT NULL default '',					/*扩展属性*/
	`is_on_sale` tinyint(1) unsigned NOT NULL default '1',				/*上架*/
	`is_alone_sale` tinyint(1) unsigned NOT NULL default '1',			/*是否能单独销售，1，是；0，否；如果不能单独销售，则只能作为某商品的配件或者赠品销售*/
	`is_shipping` tinyint(1) unsigned NOT NULL default '0', 			/*是否免运费*/
	`integral` int unsigned NOT NULL default '0',						/*积分代替金额消费*/
	`add_time` int(10) unsigned NOT NULL default '0',					/*添加时间*/
	`rank` smallint(4) unsigned NOT NULL default '100',					/*排序*/
	`is_delete` tinyint(1) unsigned NOT NULL default '0',				/*是否已删除0，否；1，已删除*/
	`is_best` tinyint(1) unsigned NOT NULL default '0',					/*是否是精品*/
	`is_new` tinyint(1) unsigned NOT NULL default '0',					/*是否是新品*/
	`is_hot` tinyint(1) unsigned NOT NULL default '0',					/*是否热销*/
	`is_promote` tinyint(1) unsigned NOT NULL default '0',				/*是否特价促销*/
	`bonus_type_id` tinyint(3) unsigned NOT NULL default '0',			/*购买该商品所能领到的红包类型*/			
	`last_update` int(10) unsigned NOT NULL default '0',				/*更新商品配置时间*/
	`goods_type` smallint(5) unsigned NOT NULL default '0',				/*商品所属类型id*/
	`seller_note` varchar(255) NOT NULL default '',						/*商品的商家备注*/				
	`give_integral` int NOT NULL default '0'					        /*成功交易赠送的积分数量*/
)ENGINE=InnoDB DEFAULT CHARACTER SET UTF8;

create table if not exists #@__goods_group( /*商品搭配表*/
  `id` int(10) unsigned not null primary key auto_increment,
  `goods_id` int(10) unsigned not null default '0' comment '商品ID',
  `group_goods_id` int(10) unsigned not null default '0' comment '配件商品ID'
)ENGINE=InnoDB default character set utf8;

create table if not exists #@__goods_gallery(								/*商品相册表*/
	`img_id` mediumint(8) unsigned NOT NULL primary key auto_increment,
  `goods_id` mediumint(8) unsigned NOT NULL default '0',
	`img_url` varchar(255) NOT NULL default '',
	`img_desc` varchar(255) NOT NULL default ''
)ENGINE=InnoDB DEFAULT CHARACTER SET UTF8;

create table if not exists #@__goods_type(								/*商品类型表*/
  `cat_id` smallint(5) unsigned NOT NULL primary key auto_increment,
  `typename` varchar(60) NOT NULL default '',								/*商品类型名*/
  `enabled` tinyint(1) unsigned NOT NULL default '1',						/*类型状态，1，为可用；0为不可用；不可用的类型*/
  `attr_group` VARCHAR( 255 ) NOT null                          			/*商品属性分组*/
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__attribute(/*商品类型属性表*/
  `attr_id` smallint(5) unsigned NOT NULL primary key auto_increment,
  `cat_id` smallint(5) unsigned NOT NULL default '0' COMMENT '商品类型ID',
  `attr_name` varchar(60) NOT NULL default '' COMMENT '属性名字',
  `attr_input_type` tinyint(1) unsigned NOT NULL default '1' COMMENT '录入方式',
  `attr_type` tinyint(1) unsigned NOT NULL default '1' COMMENT '属性是否可选',
  `attr_values` text NOT NULL COMMENT '属性值',
  `attr_index` tinyint(1) unsigned NOT NULL default '0' COMMENT '检索',
  `rank` tinyint(3) unsigned NOT NULL default '0',
  `is_linked` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否关联',
  `attr_group` tinyint( 1 ) unsigned NOT NULL DEFAULT '0'
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__goods_attr(							/*各商品附加属性表*/
`goods_attr_id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT, /*自增ID号*/
`goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0', /*该具体属性属于的商品，取值于ecs_goods的goods_id*/ 
`attr_id` smallint(5) unsigned NOT NULL DEFAULT '0', /*该具体属性属于的属性类型的id，取自ecs_attribute的attr_id*/
`attr_value` varchar(255) DEFAULT '' NOT NULL, /*该具体属性的值*/ 
`attr_price` varchar(255) NOT NULL /*该属性对应在商品原价格上要加的价格*/
)ENGINE=InnoDB DEFAULT CHARACTER SET UTF8;

create table if not exists #@__brand(
  `brand_id` smallint(5) unsigned NOT NULL primary key auto_increment,/*自增ID号*/
  `brand_name` varchar(60) NOT NULL default '',                             /*品牌名称'*/
  `brand_logo` varchar(40) NOT NULL default '',                             /*上传的该品牌公司logo图片'*/
  `brand_desc` text,                                           				/*品牌描述'*/
  `site_url` varchar(255) NOT NULL default '',                              /*品牌的网址'*/
  `rank` tinyint(3) unsigned NOT NULL DEFAULT '50',                   		/*品牌在前台页面的显示顺序，数字越大越靠后'*/
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1'                      	/*该品牌是否显示，0，否；1，显示'*/
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__myad(								/*广告表*/
	id SMALLINT(5) unsigned not null primary key auto_increment,
	type varchar(20) not null default '' COMMENT '调用代码',
	title varchar(20) not null default '',
	description varchar(50) not null default '',
	url text,															
	litpic varchar(200) not null default '',
	switch tinyint unsigned not null default '1' COMMENT '开关',
	content text COMMENT '内容',
	rank smallint(5) not null default '50' COMMENT '排序'
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__sysconfig(											/*系统配置表*/
	id SMALLINT(5) unsigned not null primary key auto_increment,
	varname varchar(20) not null default '' COMMENT '配置参数',
	info varchar(100) not null default '' COMMENT '配置标题',
	groupid smallint(6) NOT NULL default '1' COMMENT '页数',
  type varchar(10) NOT NULL default 'string' COMMENT '表格属性',
	value text	 COMMENT '配置内容'
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__arttype (								/*文章栏目表*/
  `id` smallint(5) unsigned NOT NULL primary key auto_increment,
  `typename` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `rank` tinyint(3) unsigned NOT NULL default '50' COMMENT '排序',
  `pid` smallint(5) unsigned NOT NULL default '0' COMMENT '父ID',
  `site` varchar(20) not null default '' comment '模板地址',
  `art_site` varchar(20) not null default '' comment '文章模板地址',
  `litpic` varchar(200) not null default '' comment '栏目图片',
  `content` Text comment '内容'
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__article (                            /*文章表*/
  `id` mediumint(8) unsigned NOT NULL primary key auto_increment,
  `cat_id` smallint(5) NOT NULL default '0' COMMENT '分类ID',
  `title` varchar(150) NOT NULL default '',
  `content` longtext  COMMENT '内容',
  `author` varchar(30) NOT NULL default '' COMMENT '作者',
  `keywords` varchar(255) NOT NULL default '',
  `article_type` tinyint(1) unsigned NOT NULL default '2' COMMENT '文章类型0普通1置顶2特荐',
  `is_open` tinyint(1) unsigned NOT NULL default '1'  COMMENT '是否显示，1显示，0不显示',
  `add_time` int(10) unsigned NOT NULL default '0' COMMENT '文章添加时间',
  `litpic` varchar(200) not null default '',
  `description` varchar(255) default NULL
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__user (								/*用户表*/
  `id` int(10) unsigned NOT NULL primary key auto_increment,
  `username` varchar(24) not null UNIQUE default '' COMMENT '用户昵称',
  `litpic` varchar(200) not null default '',
  `qq` char(11) not null default '',
  `email` varchar(32) not null default '',
  `pwd` char(32) not null default '',
  `cardid` varchar(32) not null default '' COMMENT '卡号',
  `name` varchar(3) not null default '' COMMENT '姓名',
  `register` int (10) unsigned not null default '0' comment '注册时间',
  `logintime` int(10) unsigned not null default '0' COMMENT '登陆时间',
  `logintype` tinyint(1) unsigned not null default '0' comment '第三方登陆类型1:QQ 2微信 3 新浪 4 豆瓣',
  `openid` char(32) not null default '' comment '第三方用户ID',
  `loginip` char(20) not null default '' COMMENT '登陆IP'
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__t_user (               /*找回密码表*/
  `id` int(10) unsigned NOT NULL primary key auto_increment,
  `email` varchar(32) not null default '',
  `rand` varchar(32) not null default '' comment '随机数',
  `time` int(10) unsigned not null default '0',
  `type` tinyint(1) unsigned not null default '0' comment '状态码'
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__link(  					/*友情链接表*/
  `id` smallint(5) unsigned NOT NULL PRIMARY KEY auto_increment,
  `title` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `logo` varchar(255) NOT NULL default '',
  `rank` tinyint(3) unsigned NOT NULL default '50' COMMENT '显示顺序'
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

create table if not exists #@__favorite(        /*收藏夹*/
  `id` int(10) unsigned not null primary key auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '用户ID',
  `goods_id` int(10) unsigned not null default '0' COMMENT '商品ID',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '收藏时间'
)engine=myisam default character set utf8;

create table if not exists #@__comment(       /*评论表*/
  `id` int(10) unsigned not null primary key auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '用户ID',
  `user_name` varchar(60) NOT NULL COMMENT '评论人的名称,取$_session用户名',
  `goods_id` int(10) unsigned not null default '0' COMMENT '商品ID或者文章ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户评论的类型；0，评论的是商品；1，评论的是文章',
  `content` text NOT NULL COMMENT '评论的内容',
  `comment_rank` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '该文章或者商品的星级；只有1到5星；由数字代替；其中5是代表5星',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论的时间',
  `ip` varchar(15) NOT NULL default '0' COMMENT '评论时的用户ip',
  `ding` SMALLINT(5) unsigned not null default '0' comment '顶',
  `cai` SMALLINT(5) unsigned not null default '0' comment '踩'
)engine=myisam default character set utf8;

create table if not exists #@__comment_list(
  `id` int(10) unsigned not null primary key auto_increment,
  `comment_id` int(10) unsigned not null default '0' comment '评论表ID',
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '用户ID'
)engine=myisam default character set utf8;

create table if not exists #@__shopping(
  `id` int(10) unsigned not null primary key auto_increment,
  `goods_id` int(10) unsigned not null default '0' COMMENT '商品ID',
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '用户ID',
  `indent_id` int(10) unsigned NOT NULL default '0' COMMENT '购物车为0，其余为订单ID',
  `number` SMALLINT(3) unsigned NOT NULL default '0' COMMENT '数量',
  `unit_price` decimal(7,2) unsigned NOT NULL default '0.00' comment '价格',
  `attr_value` varchar(30) DEFAULT '' NOT NULL COMMENT '属性值'
)engine=InnoDB default character set utf8;

create table if not exists #@__indent(
  `id` int(10) unsigned not null primary key auto_increment,
  `indent` char(14) not null default '' comment '订单号时间+随机4',
  `coupon_array` varchar(20) not null default '' comment '优惠劵组',
  `goods_array` varchar(30) not null default '' COMMENT '赠品商品组',
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '用户ID',
  `price` decimal(7,2) unsigned NOT NULL default '0.00' comment '价格',
  `site` int(10) default '0' not null comment '收货地址表对应ID',
  `delivery` tinyint(1) unsigned not null default '1' comment '送货时间：1均可2假日送3工作日送',
  `payment` tinyint(1) unsigned not null default '0' comment '支付方式',
  `type` tinyint(1) unsigned not null default '0' comment '状态：0未付款，1已付款，2已发货,3已确认付款',
  `addtime` int(10) unsigned not null default '0' comment '订单提交时间',
  `WIDtrade_no` char(32) not null default '' comment '交易号',
  `REFUND_STATUS` tinyint(1) unsigned not null default '0' comment '退款状态:0正常,1退款，2退款已处理,3退款进行中',
  `WIDtransport_type` varchar(8) not null default '' comment '物流运输类型',
  `company` varchar(12) not null default '' comment '快递公司',
  `express` varchar(20) not null default '' comment '快递单号'
)engine=InnoDB default character set utf8;

create table if not exists #@__coupon(
  `id` int(10) unsigned not null primary key auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0' comment '用户ID',
  `coupon` char(14) not null default '' comment '优惠劵号',
  `coupon_type` tinyint(1) unsigned not null default '1' comment '优惠劵类别：1,抵用劵',
  `is_expense` tinyint(1) unsigned not null default '0' comment '0未消费，1已消费',
  `coupon_price` decimal(6,2) unsigned NOT NULL default '0.00' comment '优惠价格'
)engine=InnoDB default character set utf8;

create table if not exists #@__site(
  `id` int(10) unsigned not null primary key auto_increment comment '收货地址表',
  `user_id` int(10) unsigned NOT NULL default '0' comment '用户ID',
  `name` varchar(13) default '' not null comment '收货人',
  `phone` char(11) default '' not null comment '收货人手机号码',
  `encoding` char(6) default '' not null comment '邮政',
  `acquiesce` tinyint(1) unsigned not null default '1' comment '默认地址',
  `sheng` varchar(9) default '' not null comment '省',
  `shi` varchar(24) default '' not null comment '市',
  `xian` varchar(24) default '' not null comment '镇',
  `site` varchar(250) default '' not null comment '收货地址'
)engine=myisam default character set utf8;

drop table if exists #@__admin;
create table if not exists #@__admin(                       /*管理员表*/
  id int(10) unsigned not null primary key auto_increment,    /**/
  usertype tinyint unsigned not null,                 /*用户组ID*/
  userid char(30) not null UNIQUE default '',               /*登陆名*/
  pwd char(32) not null default '',                 /*密码*/
  uname char(20) not null default '',                 /*管理员姓名*/
  logintime int(10) unsigned not null default '0',          /*登陆时间*/
  loginip char(20) not null default ''                /*登陆IP*/
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

drop table if exists #@__purviews;
CREATE TABLE IF NOT EXISTS #@__purviews (             /*权限表*/
  id smallint(6) unsigned NOT NULL primary key AUTO_INCREMENT,
  name varchar(20) NOT NULL,                      /*节点名称*/
  title varchar(50) DEFAULT NULL,                   /*节点标题*/
  pid smallint(6) unsigned NOT null                   /*父ID*/
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

drop table if exists #@__admintype;
CREATE TABLE IF NOT EXISTS #@__admintype (              /*用户组表*/
  id tinyint unsigned NOT NULL primary key AUTO_INCREMENT,      
  name varchar(20) NOT NULL,                      /*用户组名*/
  purviews text                             /*权限*/
)ENGINE=MyISAM DEFAULT CHARACTER SET UTF8;

insert into #@__purviews (id,name,title,pid) values
(1,'Admin','特别权限(仅超级管理员使用)',0),
(2,'Goods','商品管理',0),
(3,'Myad','辅助插件',0),
(4,'News','文章管理',0),
(5,'Member','会员管理',0),
(6,'System','系统管理',0),
(101,'admin_all','可以进行任意操作',1),
(201,'Goods_add','添加商品',2),
(202,'Goods_update','修改商品',2),
(203,'Goods_totrack','删除商品',2),
(204,'Goods_delete','彻底删除',2),
(205,'Category_add','添加商品分类',2),
(206,'Category_move','转移商品',2),
(207,'Category_update','修改商品分类',2),
(208,'Category_delete','删除商品分类',2),
(209,'Brand_add','添加品牌',2),
(210,'Brand_update','修改品牌',2),
(211,'Brand_delete','删除品牌',2),
(212,'GoodsType_index','商品类型操作',2),
(301,'Myad_index','广告操作',3),
(302,'Link_index','友链操作',3),
(401,'News_index','栏目管理',4),
(402,'Article_index','文章管理',4),
(501,'Member_index','会员管理',5),
(502,'Member_delete','删除会员',5),
(503,'Comment_delete','删除评论',5),
(601,'System_runsys','修改商品设置',6),
(602,'Mysql_add','操作数据库',6),
(603,'Rbac_runadd','添加/修改管理员',6),
(604,'Rbac_runupdate_group','添加/修改用户组',6);
insert into #@__admintype (id,name,purviews) values
('1','超级管理员','admin_all'),
('2','频道管理员','Goods_add,Goods_update,Category_add,Category_update,Category_delete,Brand_add,Brand_update,Brand_delete,GoodsType_index,Myad_index,Link_index,News_index,Article_index,Member_index'),
('3','信息发布员','Goods_add,Goods_update,Category_move,News_index,Article_index');
insert into #@__sysconfig (varname,info,groupid,type,value) values
('cfg_shop_name','商店名称','1','string','ECSHOP'),   
('cfg_shop_title','商店标题','1','string','ECSHOP演示站'),
('cfg_shop_description','商店描述','1','string','ECSHOP演示站'),
('cfg_shop_keywords','商店关键字','1','string','ECSHOP演示站'),
('cfg_user_notice','用户中心公告','1','bstring',''),
('cfg_shop_notice',' 商店公告','1','bstring',''),
('cfg_search_keywords','搜索关键字请用(,)分隔多个关键字','1','string',''),
('cfg_thumb_width','缩略图宽度','1','number','102'),
('cfg_thumb_height','缩略图高度','1','number','150')
;
insert into #@__admin (usertype,userid,uname,pwd) values (1,'admin','boss',md5('boss'));
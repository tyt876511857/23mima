alter table gs_bg_zheye add totalscore int(11) not null default 0 comment '所有人数的总分';

alter table gs_user add frompart tinyint(1) not null default 0 comment '用户第三方接入来源，1为同程';

alter table gs_user add thirduid int(11) not null default 0 comment '用户第三方接入来源uid';

alter table gs_user add thirdtoid int(11) not null default 0 comment '用户第三方接入来源对应产品或者其他的id，同程的为产品id';

alter table gs_user add token varchar(255) not null default '' comment '第三方的token';
alter table gs_user add tokentime int(11) not null default 0 comment '第三方的token时间';
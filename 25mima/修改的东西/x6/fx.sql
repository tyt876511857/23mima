alter table gs_bg_zheye add totalscore int(11) not null default 0 comment '�����������ܷ�';

alter table gs_user add frompart tinyint(1) not null default 0 comment '�û�������������Դ��1Ϊͬ��';

alter table gs_user add thirduid int(11) not null default 0 comment '�û�������������Դuid';

alter table gs_user add thirdtoid int(11) not null default 0 comment '�û�������������Դ��Ӧ��Ʒ����������id��ͬ�̵�Ϊ��Ʒid';

alter table gs_user add token varchar(255) not null default '' comment '��������token';
alter table gs_user add tokentime int(11) not null default 0 comment '��������tokenʱ��';
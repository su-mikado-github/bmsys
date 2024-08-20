-- Project Name : 業務管理システム
-- Date/Time    : 2024/08/20 10:46:38
-- Author       : Shuji Ushiyama
-- RDBMS Type   : MySQL
-- Application  : A5:SQL Mk-2

-- メニュー項目
drop table if exists menu_items cascade;

create table menu_items (
  id BIGINT AUTO_INCREMENT not null comment 'メニュー項目ID'
  , menu_id BIGINT not null comment 'メニューID'
  , display_order BIGINT default 0 not null comment '表示順'
  , screen_key VARCHAR(256) not null comment '画面識別キー'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint menu_items_PKC primary key (id)
) comment 'メニュー項目' ;

-- メニュー
drop table if exists menus cascade;

create table menus (
  id BIGINT AUTO_INCREMENT not null comment 'メニューID'
  , key VARCHAR(256) not null comment 'メニュー識別キー'
  , name VARCHAR(256) comment 'メニュー名'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint menus_PKC primary key (id)
) comment 'メニュー' ;

-- アクション権限グループ
drop table if exists action_permission_groups cascade;

create table action_permission_groups (
  id BIGINT AUTO_INCREMENT not null comment '画面権限グループID'
  , action_id BIGINT not null comment 'アクションID'
  , permission_group_id BIGINT not null comment '権限グループID'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint action_permission_groups_PKC primary key (id)
) comment 'アクション権限グループ' ;

-- 画面権限グループ
drop table if exists screen_permission_groups cascade;

create table screen_permission_groups (
  id BIGINT AUTO_INCREMENT not null comment '画面権限グループID'
  , screen_id BIGINT not null comment '画面ID'
  , permission_group_id BIGINT not null comment '権限グループID'
  , is_create TINYINT default 0 not null comment '登録許可フラグ:0:拒否 1:許可'
  , is_update TINYINT default 0 not null comment '更新許可フラグ:0:拒否 1:許可'
  , is_delete TINYINT default 0 not null comment '削除許可フラグ:0:拒否 1:許可'
  , is_download TINYINT default 0 not null comment 'ダウンロード許可フラグ:0:拒否 1:許可'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint screen_permission_groups_PKC primary key (id)
) comment '画面権限グループ' ;

-- アクション
drop table if exists actions cascade;

create table actions (
  id BIGINT AUTO_INCREMENT not null comment 'アクションID'
  , action_key VARCHAR(256) comment 'アクション識別キー'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint actions_PKC primary key (id)
) comment 'アクション' ;

-- 画面
drop table if exists screens cascade;

create table screens (
  id BIGINT AUTO_INCREMENT not null comment '画面ID'
  , screen_key VARCHAR(256) not null comment '画面識別キー'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint screens_PKC primary key (id)
) comment '画面' ;

-- 利用者権限グループ
drop table if exists user_permission_groups cascade;

create table user_permission_groups (
  id BIGINT AUTO_INCREMENT not null comment '利用者権限グループID'
  , user_id BIGINT not null comment '利用者ID'
  , permission_group_id BIGINT not null comment '権限グループID'
  , start_date DATE default '0000-01-01' not null comment '開始日'
  , end_date DATE default '9999-12-31' not null comment '終了日'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint user_permission_groups_PKC primary key (id)
) comment '利用者権限グループ' ;

-- 権限グループ
drop table if exists permission_groups cascade;

create table permission_groups (
  id BIGINT AUTO_INCREMENT not null comment '権限グループID'
  , name VARCHAR(256) comment '権限グループ名称'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint permission_groups_PKC primary key (id)
) comment '権限グループ' ;

-- システム設定
drop table if exists system_settings cascade;

create table system_settings (
  id BIGINT AUTO_INCREMENT not null comment 'システム設定ID'
  , property_key VARCHAR(256) not null comment 'システム・プロパティ名'
  , property_group VARCHAR(256) default '*' not null comment 'システム・プロパティ・グループ'
  , data_type INT default 0 not null comment 'データ型'
  , is_required TINYINT default 0 not null comment '必須フラグ:0:任意 1:必須'
  , description TEXT comment '説明文'
  , string_value VARCHAR(1024) comment '文字列'
  , text_value TEXT comment '文章'
  , integer_value INT comment '整数値'
  , double_value DOUBLE comment '浮動小数値'
  , date_value DATE comment '日付値'
  , json_value MEDIUMTEXT comment 'JSON値'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint system_settings_PKC primary key (id)
) comment 'システム設定' ;

-- 利用有給
drop table if exists use_salarys cascade;

create table use_salarys (
  id BIGINT AUTO_INCREMENT not null comment '利用有給ID'
  , user_id BIGINT not null comment '利用者ID'
  , use_date DATE not null comment '有給取得日'
  , use_days DECIMAL(2,1) not null comment '有給取得日数:0.5または1.0のいずれか'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint use_salarys_PKC primary key (id)
) comment '利用有給' ;

-- 有給
drop table if exists salarys cascade;

create table salarys (
  id BIGINT AUTO_INCREMENT not null comment '有給ID'
  , user_id BIGINT not null comment '利用者ID'
  , days INT not null comment '付与日数:1以上'
  , start_date DATE default '0000-01-01' not null comment '開始日:有給有効期間の開始日'
  , end_date DATE default '9999-12-31' not null comment '終了日:有給有効期間の終了日'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint salarys_PKC primary key (id)
) comment '有給' ;

-- パスワード履歴
drop table if exists password_historys cascade;

create table password_historys (
  id BIGINT AUTO_INCREMENT not null comment 'パスワード履歴ID'
  , user_id BIGINT not null comment '利用者ID'
  , password VARCHAR(128) not null comment 'パスワード:ハッシュ化する事'
  , start_date DATE default '0000-01-01' not null comment '開始日:有効期間の開始日。期間に含む。'
  , end_date DATE default '9999-12-31' not null comment '終了日:有効期間の終了日。期間に含む。'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint password_historys_PKC primary key (id)
) comment 'パスワード履歴' ;

-- 利用者
drop table if exists users cascade;

create table users (
  id BIGINT AUTO_INCREMENT not null comment '利用者ID'
  , email VARCHAR(128) not null comment 'メールアドレス'
  , employee_no INT not null comment '社員番号'
  , password VARCHAR(128) not null comment '現在パスワード:ハッシュ化する事'
  , last_name VARCHAR(64) not null comment '姓'
  , first_name VARCHAR(64) not null comment '名'
  , last_name_hirakana VARCHAR(128) not null comment '姓かな'
  , first_name_hirakana VARCHAR(128) not null comment '名かな'
  , hire_date DATE not null comment '入社日'
  , first_paid_grant_date DATE not null comment '初回有給付与日'
  , reminder_token VARCHAR(256) not null comment 'リマインダー・トークン'
  , create_tm BIGINT not null comment '作成日時'
  , create_id BIGINT not null comment '作成者ID'
  , update_tm BIGINT not null comment '更新日時'
  , update_id BIGINT not null comment '更新者ID'
  , is_deleted TINYINT default 0 not null comment '削除済フラグ:0:未削除 1:削除済み'
  , deleted_tm BIGINT comment '削除日時'
  , data_version BIGINT default 1 comment 'バージョン:楽観排他用。レコードのバージョン'
  , constraint users_PKC primary key (id)
) comment '利用者' ;


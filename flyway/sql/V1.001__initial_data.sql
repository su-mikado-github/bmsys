-- 利用者
insert into users(email,employee_no,password,last_name,first_name,last_name_hirakana,first_name_hirakana,hire_date,first_paid_grant_date,email_verified_at,remember_token) values 
    ('shuji.ushiyama@gmail.com', 0, '$2y$10$nSq2GVsfDQYkuem5xQoB6.OkNRYZ0iNOCC3aIsNluLhMpxlW/X9i2', 'システム', '管理者', 'しすてむ', 'かんりしゃ', DATE '2000-10-01', DATE '2000-10-01', null, 'xveMMF08aWhbRLJk0jaCAqY2RWVDYsbCaaoQSUbIhNQ6OC2hxLuZTfjyVdTX')
;

-- ロール
insert into roles(role_key,name) values 
    ('admin', '管理者')
    , ('mg', 'マネージャ')
    , ('smg', 'サブマネージャ')
    , ('*','メンバー')
;

-- 利用者ロール
insert into user_roles(user_id,role_id,start_date,end_date)
    select id, (select id from roles where role_key='admin'), DATE '2024-01-01', DATE '2024-01-01' from users
;

-- 画面
insert into screens(screen_key,name,short_name,icon,display_order) values
    ('top', 'トップ', 'トップ', 'mdi mdi-home-account', 1)
    , ('attest', '認証', '認証', 'mdi mdi-login', 2)
    , ('mypage', 'マイページ', 'マイページ', 'mdi mdi-account-box', 3)
    , ('members', '利用者一覧', '利用者一覧', 'mdi mdi-account-group', 4)
    , ('roles', 'ロール一覧', 'ロール一覧', 'mdi mdi-cog-outline', 5)
    , ('permission-setting', '権限設定', '権限設定', 'mdi mdi-cog-outline', 6)
;

-- 画面ロール
insert into screen_roles(screen_id,role_id)
    select id, (select id from roles where role_key='admin') from screens
;

-- メニュー
insert into menus(menu_key,name) values
    ('header.menu', 'メニュー')
;

-- メニュー項目
insert into menu_items(menu_id,menu_group_no,display_order,screen_id) values
    ((select id from menus where menu_key='header.menu'), 1, 1, (select id from screens where screen_key='members'))
    , ((select id from menus where menu_key='header.menu'), 1, 2, (select id from screens where screen_key='roles'))
    , ((select id from menus where menu_key='header.menu'), 1, 3, (select id from screens where screen_key='permission-setting'))
;
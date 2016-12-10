<?php

if(!defined("common_result_success")) define("common_result_success", "200");//执行成功

if(!defined("user_status_active")) define("user_status_active", "1000");//激活成功
if(!defined("user_status_actived")) define("user_status_actived", "1005");//已激活
if(!defined("user_register_success")) define("user_register_success", "1010");//注册成功
if(!defined("user_login_success")) define("user_login_success", "1011");//登陆成功
if(!defined("user_status_locked")) define("user_status_locked", "-1001");//用户被锁定
if(!defined("user_status_not_exist")) define("user_status_not_exist", "-1002");//用户不存在
if(!defined("user_status_destory")) define("user_status_destory", "-1003");//用户已注销
if(!defined("user_status_not_actived")) define("user_status_not_actived", "-1004");//未激活

if(!defined("user_active_error")) define("user_active_error", "-1006");//内部错误，激活失败
if(!defined("user_invite_outoff_time")) define("user_invite_outoff_time", "-1007");//邀请码超期
if(!defined("user_invite_not_exist")) define("user_invite_not_exist", "-1008");//邀请码错误
if(!defined("user_invite_error")) define("user_invite_error", "-1014");//邀请失败
if(!defined("user_register_error")) define("user_register_error", "-1009");//内部错误，注册失败

if(!defined("user_login_error")) define("user_login_error", "-1010");//用户名或密码错误
if(!defined("user_update_error")) define("user_update_error", "-1012");//用户信息更新失败
if(!defined("user_query_error")) define("user_query_error", "-1012");//用户信息查询失败
if(!defined("user_isregister_error")) define("user_isregister_error", "-1013");//检查用户是否注册失败

if(!defined("invite_type_email")) define("invite_type_email", "1");
if(!defined("invite_type_telephone")) define("invite_type_telephone", "2");
?>
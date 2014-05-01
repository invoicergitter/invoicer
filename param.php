<?php

/*
 * global params
 */
$param['host'] = "localhost";
$param['online'] = true;
$param['link_data'] = __DIR__."/data/";
$param['mail_new_account'] = false;
$param['mail_error_transaction'] = false;
$param['mail_error_db'] = false;
$param['online_exception_pass'] = "debo33";


/*
 * lang params
 */
$param['lang'] = isset($_SESSION['lang'])?$_SESSION['lang']:'fr';

/*
 * database params
 */
$param['db_name'] = 'biller';
$param['db_user'] = 'root';
$param['db_host'] = 'localhost';
$param['db_psw'] = '';


/*
 * theme params
 */
$param['theme'] = 'basic';
$param['link_theme_rep'] = str_replace("\\","/",__DIR__."/V/themes/".$param['theme']."/");
$param['link_style_rep'] = "../V/themes/".$param['theme']."/"."style/";




<?php
    // 이 상수가 정의되지 않으면 각각의 개별 페이지는 별도로 실행될 수 없음
    define("_INCLUDE_", TRUE);

    if (function_exists("date_default_timezone_set"))
        date_default_timezone_set("Asia/Seoul");

    $com['charset'] = "utf-8";
    $com['myip'] = $_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    $com['server_time'] = time();
    $com['upfile_size'] = 1024*1024*1024*50; // 20MB

    $com['time_ymd'] = date("Y-m-d",time());
    $com['time_his'] = date("H:i:s",time());
    $com['time_ymdhis'] = date("Y-m-d H:i:s",time());
    $date = $com['time_ymdhis'];


    $com['dbip_key'] = '8e59bc0d7cf06709a2c1bf8c873c0b6e4284addc';


    function set_domain($domain, $domain_data)
	{
        global $com;

        $com['domain'] = $domain;
        $com['domain_data'] = $domain_data;
    }


    function set_dev_mode()
	{
        global $com, $root_path;

        switch ($_SERVER['HTTP_HOST']) {
            case '192.168.0.11':
            case '192.168.0.80': // HJin
            case '192.168.0.152': // HJin
            case 'sportslineup.example.com':
            case '127.0.0.1':
                $com['dev_mode'] = 'D';
                set_domain($_SERVER['HTTP_HOST'], $_SERVER['HTTP_HOST']);
                session_save_path("{$root_path}/data_logs");
                break;

            default:
                $com['dev_mode'] = 'L';
                ini_set("session.cookie_domain", '.'.$_SERVER['SERVER_NAME']);
                set_domain($_SERVER['SERVER_NAME'], "hol1000.com");
                session_save_path("{$root_path}/data_logs");
                break;
        }
    }

    set_dev_mode();


    $com['url'] = "http://".$com['domain'];
    $com['url_data'] = "http://".$com['domain_data'];

    //board editor 네이버 SmartEditor v2.8.2(보안패치 v2.8.2.3) - 2016.11.10
    $com['editor_path'] = '/lib/SE2.8.2';

    $com['admin_level'] = 90;

    $com['meta_keywords'] = '';
    $com['meta_description'] = '';

?>

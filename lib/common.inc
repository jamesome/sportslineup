<?php

    /*******************************************************************************
    ** 공통 변수, 상수, 코드
    *******************************************************************************/
    error_reporting(E_ALL ^ E_NOTICE);
    //error_reporting(E_ALL);
    //ini_set('display_errors',  0 );

    // 보안설정이나 프레임이 달라도 쿠키가 통하도록 설정
    header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

    set_time_limit(0);  //처리 시간제한 없앰
    // ini_set('upload_max_filesize', '20M');    //파일첨부 20메가로 제한
    // ini_set('post_max_size', '50M');             //POST첨부 50메가로 제한

    // phpBB2 참고
    // php.ini 의 magic_quotes_gpc 값이 FALSE 인 경우 addslashes() 적용
    // SQL Injection 등으로 부터 보호
    //
    if(!get_magic_quotes_gpc())
    {
        $_GET = addslash_array($_GET);
        $_POST = addslash_array($_POST);
        $_COOKIE = addslash_array($_COOKIE);
    }

    function addslash_array($arr)
    {
        $arr2 = array();
        if (is_array($arr)) {
            while (list($k, $v) = each($arr)) {
                if (is_array($arr[$k])) {
                    $arr2[$k] = addslash_array($arr[$k]);
                } else {
                    $arr2[$k] = addslashes($v);
                }
            }
            @reset($arr);
        }
        return $arr2;
    }

    //==========================================================================================================================
    // XSS(Cross Site Scripting) 공격에 의한 데이터 검증 및 차단
    //--------------------------------------------------------------------------------------------------------------------------
    function xss_clean($data)
    {
        // If its empty there is no point cleaning it :\
        if (empty($data))
            return $data;

        // Recursive loop for arrays
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = xss_clean($value);
            }

            return $data;
        }

        // http://svn.bitflux.ch/repos/public/popoon/trunk/classes/externalinput.php
        // +----------------------------------------------------------------------+
        // | Copyright (c) 2001-2006 Bitflux GmbH                                 |
        // +----------------------------------------------------------------------+
        // | Licensed under the Apache License, Version 2.0 (the "License");      |
        // | you may not use this file except in compliance with the License.     |
        // | You may obtain a copy of the License at                              |
        // | http://www.apache.org/licenses/LICENSE-2.0                           |
        // | Unless required by applicable law or agreed to in writing, software  |
        // | distributed under the License is distributed on an "AS IS" BASIS,    |
        // | WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or      |
        // | implied. See the License for the specific language governing         |
        // | permissions and limitations under the License.                       |
        // +----------------------------------------------------------------------+
        // | Author: Christian Stocker <chregu@bitflux.ch>                        |
        // +----------------------------------------------------------------------+

        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/i', '$1;', $data);

        if (function_exists("html_entity_decode")) {
            $data = html_entity_decode($data);
        } else {
            $trans_tbl = get_html_translation_table(HTML_ENTITIES);
            $trans_tbl = array_flip($trans_tbl);
            $data = strtr($data, $trans_tbl);
        }

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#i', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#i', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#i', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#i', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        return $data;
    }

    $_GET = xss_clean($_GET);
    //==========================================================================================================================


    //==========================================================================================================================
    // extract($_GET); 명령으로 인해 page.php?_POST[var1]=data1&_POST[var2]=data2 와 같은 코드가 _POST 변수로 사용되는 것을 막음
    // 081029 : letsgolee 님께서 도움 주셨습니다.
    //--------------------------------------------------------------------------------------------------------------------------
    $ext_arr = array ('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST',
                      'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS',
                      'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS');
    $ext_cnt = count($ext_arr);
    for ($i=0; $i<$ext_cnt; $i++) {
        // GET 으로 선언된 전역변수가 있다면 unset() 시킴
        if (isset($_GET[$ext_arr[$i]])) unset($_GET[$ext_arr[$i]]);
    }
    //==========================================================================================================================

    // PHP 4.1.0 부터 지원됨
    // php.ini 의 register_globals=off 일 경우
    @extract($_GET);
    @extract($_POST);
    @extract($_SERVER);


    //-------------------------------------------
    // SESSION 설정
    //-------------------------------------------
    ini_set("session.use_trans_sid", 0);    // PHPSESSID를 자동으로 넘기지 않음
    ini_set("url_rewriter.tags",""); // 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)

    if (isset($SESSION_CACHE_LIMITER))
        @session_cache_limiter($SESSION_CACHE_LIMITER);
    else
        @session_cache_limiter("no-cache, must-revalidate");

    ini_set("session.cache_expire", 180); // 세션 캐쉬 보관시간 (분)
    ini_set("session.gc_maxlifetime", 10800); // session data의 garbage collection 존재 기간을 지정 (초)
    ini_set("session.gc_probability", 1); // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
    ini_set("session.gc_divisor", 100); // session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.

    require_once("$root_path/lib/config.inc");  // 설정 파일

    @session_start();

    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/html; charset=$com[charset]");
    $gmnow = gmdate("D, d M Y H:i:s") . " GMT";
    //header("Expires: 0"); // rfc2616 - Section 14.21
    header("Last-Modified: " . $gmnow);
    header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
    header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
    header("Pragma: no-cache"); // HTTP/1.0

    include_once("$root_path/libraries/Js_load.php");

    require_once("$root_path/lib/lib.inc"); // 공통 라이브러리
    require_once("$root_path/lib/value.inc");  // 기타 배열값

?>

<?
    $root_path = $_SERVER['DOCUMENT_ROOT'];

    require_once "$root_path/lib/common.inc";
    require_once("$root_path/lib/common_db.inc");  // DB 설정 및 접속, 라이브러리

	/*
     * set_config_save
     * get_config_list
     *
     * <member>
     * set_member_join
     * set_member_simple_join
     * set_member_levelup
     * set_member_leveldown
     * set_member_auth
     * get_member_join_auth
     * set_auth_log
     * set_member_draw
     * set_member_drawrestore
     * set_join_auth_log join
     * set_join_auth_log kind
     * set_join_auth_ok join
     * set_join_auth_ok kind
     * set_member_block
     * set_member_unblock
     * set_member_nickname
     * set_member_password
     * set_member_login
     * get_member_block_time
     * get_member_info
     * get_member_info_from
     * get_member_idx_from
     * get_member_id_from_auth
     * get_auth_log
     * get_login_log
     * set_session_info
     * get_member_session_info
     * get_member_list
     * get_member_level_percent
     * set_findpass_change
     * set_member_email
     * get_ip_block_time
     *
     * <board>
     * set_board_insert
     * set_board_update
     * set_board_delete
     * set_board_recommend
     * set_board_hit
     * set_board_select
     * set_board_accuse
     * set_board_manage
     * set_comment_insert
     * set_comment_update
     * set_comment_delete
     * set_accuse_insert
     * get_board_list
     * get_board_list_search
     * get_board_list_best
     * get_board_view
     * get_search_list
     *
     * <memo>
     * get_address_blockcheck
     * set_address_save
     * set_address_delete_add_idx
     * get_address_list
     * set_memo_config
     * get_memo_config
     * set_memo_insert
     * set_memo_update
     * get_memo_count
     * get_memo_list
     * get_memo_data
     *
     *
     * <point>
     * set_point_log
     * get_point_log_list
     *
     * <item>
     *
     * <admin>
     * set_member_joinrefer_insert
     * set_popup_save
     * set_popup_used
     * set_popup_delete
     * get_popup_list
     * set_banner_save
     * set_banner_used
     * set_banner_delete
     * get_banner_list
     * get_site_banner_info
     * get_site_popup_info
     *
     * get_iplocate_info
     * get_loginlog_list
     *
     * get_member_active_analyze
     * get_access_log_analyze
     * set_ip_block
     * set_ip_unblock
     * get_comment_all_list
     * get_board_accuse_list
     * get_member_level_count
     *
     * < event & ticket>
     * set_event_save
     * set_event_manage_type
     * set_event_manage_is_use
     * set_event_manage_is_del
     * set_event_attend
     * get_event_list
     * set_ticket_buy
     * set_ticket_used
     * get_ticket_list
     * set_event_hit
     *
     * set_ticket_log
     * get_ticket_info
     *
     */


    $test_option = array('get_board_list');

    $dbcon = new DB_Con();



    if(in_array("set_event_save", $test_option)){
        echo "set_event_save</br>";

        $arr = array();
        $arr['_event_id'] = insert_db_data("event_test_12");
        $arr['_event_type'] = "notice"; // ticket, notice
        $arr['_event_subject'] = insert_db_data("테스트 이벤트 입니다. ");
        $arr['_image_name'] = insert_db_data("test.jpg");
        $arr['_contents'] = insert_db_contents("<p> 테스트 이벤트 </p>");
        $arr['_ticket_coin'] = '20';
        $arr['_ticket_limit'] = '1';
        $arr['_start_date'] = '2016-12-22';
        $arr['_end_date'] = '2016-12-30';
        $arr['_is_use'] = 'Y';

        $row = call_procedure_data("set_event_save", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_event_manage_type", $test_option)){
        echo "set_event_manage type</br>";

        $arr = array();
        $arr['_event_id'] = "event_test_12";
        $arr['_kind'] = "type";
        $arr['_value'] = "notice"; // ticket, notice

        $row = call_procedure_data("set_event_manage", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_event_manage_is_use", $test_option)){
        echo "set_event_manage is_use</br>";

        $arr = array();
        $arr['_event_id'] = "event_test_12";
        $arr['_kind'] = "is_use";
        $arr['_value'] = "Y";

        $row = call_procedure_data("set_event_manage", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_event_hit", $test_option)){
        echo "set_event_hit</br>";

        $arr = array();
        $arr['_event_id'] = "event_test_12";

        $row = call_procedure_data("set_event_hit", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_event_manage_is_del", $test_option)){
        echo "set_event_manage is_del</br>";

        $arr = array();
        $arr['_event_id'] = "event_test_12";
        $arr['_kind'] = "is_del";
        $arr['_value'] = "N";

        $row = call_procedure_data("set_event_manage", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_event_attend", $test_option)){
        echo "set_event_attend</br>";

        $arr = array();
        $arr['_event_id'] = "event_test_123";
        $arr['_user_idx'] = "1";
        $arr['_join_result'] = "ekkkk";

        $row = call_procedure_data("set_event_attend", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_ticket_buy", $test_option)){
        echo "set_ticket_buy</br>";

        $arr = array();
        $arr['_event_id'] = "event_test_123";
        $arr['_user_idx'] = "1";
        $arr['_is_use'] = "N";

        $row = call_procedure_data("set_ticket_buy", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_ticket_used", $test_option)){
        echo "set_ticket_used</br>";

        $arr = array();
        $arr['_ticket_id'] = "1U3Z-MOII-1M2G-0SW2";
        $arr['_is_use'] = "Y";

        $row = call_procedure_data("set_ticket_used", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_ticket_info", $test_option)){
        echo "get_ticket_info</br>";

        $arr = array();
        $arr['_ticket_id'] = "1U3Z-MOII-1M2G-0SW2";

        $row = call_procedure_data("get_ticket_info", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("get_event_info", $test_option)){
        echo "get_event_info</br>";

        $arr = array();
        $arr['_event_id'] = "event_test_123";

        $row = call_procedure_data("get_event_info", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_event_list", $test_option)){
        echo "get_event_list</br>";

        $arr = array();
        $arr['_kind'] = ''; // '', 'ing', 'end'
        $arr['_is_use'] = ''; // '', 'Y', 'N'
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '20';

        $row = call_procedure_list("get_event_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_ticket_list", $test_option)){
        echo "get_ticket_list</br>";

        $arr = array();
        $arr['_srch_kind'] = ''; // '', 'midx', 'level', 'mid', 'nick', 'email', 'ticketid'
        $arr['_srch_text'] = ''; // '', 'ing', 'end'
        $arr['_ord_kind'] = 'dateadc'; // '', 'dateadc', datedesc', 'useasc', 'usedesc'
        $arr['_skip_num'] = '-10';
        $arr['_list_max'] = '10';

        $row = call_procedure_list("get_ticket_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_level_count", $test_option)){
        echo "get_member_level_count</br>";

        $arr = array();
        $arr['_member_type'] = ''; // '', 'join', 'leave', 'block'

        $row = call_procedure_list("get_member_level_count", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_accuse_delete", $test_option)){
        echo "set_accuse_delete</br>";

        $arr = array();
        $arr['_idx'] = "3";

        $row = call_procedure_data("set_accuse_delete", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_board_accuse_list", $test_option)){
        echo "get_board_accuse_list</br>";

        $arr = array();
        $arr['_board_table'] = ''; // '', 'memo', community', 'school', 'offline', 'notice'
        $arr['_srch_type'] = 'content';  // '', 내용('content'), 신고당한('illenick', 'illeid', 'illeidx'), 신고한('accunick', 'accuid', 'accuidx')
        $arr['_srch_text'] = 'sdf';
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '20';

        $row = call_procedure_list("get_board_accuse_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_comment_all_list", $test_option)){
        echo "get_comment_all_list</br>";

        $arr = array();
        $arr['_board_table'] = ''; // '', 'community', 'school', 'offline', 'notice'
        $arr['_srch_type'] = 'nickname';  // '', 'comment', 'nickname', 'mid'
        $arr['_srch_text'] = '블루스피카1';
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '20';

        $row = call_procedure_list("get_comment_all_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_ip_block_time", $test_option)){
        echo "get_ip_block_time</br>";

        $arr = array();
        $arr['_ip'] = '1';

        $row = call_procedure_data("get_ip_block_time", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_ip_block_list", $test_option)){
        echo "get_ip_block_list</br>";

        $arr = array();
        $arr['_type'] = 'R';
        $arr['_ip'] = '1';
        $arr['_view_del'] = 'Y'; //'', 'Y'
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '20';

        $row = call_procedure_list("get_ip_block_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_ip_block", $test_option)){
        echo "set_ip_block</br>";

        $arr = array();
        $arr['_type'] = "R";
        $arr['_ip'] = "192.168.100.3";
        $arr['_reason_key'] = "prison_1";

        $row = call_procedure_data("set_ip_block", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_ip_unblock", $test_option)){
        echo "set_ip_unblock</br>";

        $arr = array();
        $arr['_ip'] = "192.168.100.1";

        $row = call_procedure_data("set_ip_unblock", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_site_accessjoin_analyze", $test_option)){
        echo "get_site_accessjoin_analyze</br>";

        $arr = array();
        $arr['_kind'] = 'day'; // 'day', 'month', 'year'
        $arr['_start_date'] = '2016-11-01'; //
        $arr['_end_date'] = '2016-12-10'; //

        $row = call_procedure_list("get_site_accessjoin_analyze", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_join_analyze", $test_option)){
        echo "get_member_join_analyze</br>";

        $arr = array();
        $arr['_kind'] = 'day'; // 'day', 'month', 'year'
        $arr['_start_date'] = '2016-11-01'; //
        $arr['_end_date'] = '2016-12-10'; //

        $row = call_procedure_list("get_member_join_analyze", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_access_log_analyze", $test_option)){
        echo "get_access_log_analyze</br>";

        $arr = array();
        $arr['_kind'] = 'day'; // 'day', 'month', 'year'
        $arr['_start_date'] = '2016-11-01'; //
        $arr['_end_date'] = '2016-12-10'; //

        $row = call_procedure_list("get_access_log_analyze", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_active_analyze", $test_option)){
        echo "get_member_active_analyze</br>";

        $arr = array();
        $arr['_member_idx'] = '3';
        $arr['_month'] = '1'; //

        $row = call_procedure_list("get_member_active_analyze", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_loginlog_list", $test_option)){
        echo "get_loginlog_list</br>";

        $arr = array();
        $arr['_srch_kind'] = ''; // '', 'midx', 'mid', 'nick', 'ip', 'locate'
        $arr['_srch_text'] = '';
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '20';

        $row = call_procedure_list("get_loginlog_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_iplocate_info", $test_option)){
        echo "get_iplocate_info</br>";

        $arr = array();
        $arr['_ip'] = '1.214.245.200';
        $arr['_iptype'] = 'IPv4';

        $row = call_procedure_data("get_iplocate_info", $arr);

        print_r($row);
        print('ip:'.$row['ip']);
        echo "</br></br>";
    }

    if(in_array("set_iplocate_save", $test_option)){
        echo "set_iplocate_save</br>";

        $arr = array();
        $arr['_ip'] = '1.214.245.195';
        $arr['_iptype'] = 'IPv4';
        $arr['_contine_cd'] = 'AS';
        $arr['_contine_nm'] = 'Asia';
        $arr['_country_cd'] = 'KR';
        $arr['_country_nm'] = 'South Korea';
        $arr['_state'] = 'Seoul';
        $arr['_city'] = 'Seoul (Hangang-daero)';

        $row = call_procedure_data("set_iplocate_save", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_search_list", $test_option)){
        echo "get_search_list</br>";

        $arr = array();
        $arr['_table'] = '';
        $arr['_list_max'] = '5';
        $arr['_search_type'] = 'nickname';
        $arr['_search_text'] = insert_db_data('길라임1');

        $row = call_procedure_list("get_search_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_site_banner_info", $test_option)){
        echo "get_site_banner_info</br>";

        $arr = array();
        $arr['_banneridx'] = '442';

        $row = call_procedure_data("get_site_banner_info", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_site_popup_info", $test_option)){
        echo "get_site_popup_info</br>";

        $arr = array();
        $arr['_popidx'] = '34';

        $row = call_procedure_data("get_site_popup_info", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_member_email',$test_option)){
        echo "set_member_email</br>";

        $arr = array();
        $arr['_member_idx'] = '2';
        $arr['_new_nickname'] = 'breakm51@gmail.com' ;

        $row = call_procedure_data("set_member_email", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_findpass_change',$test_option)){
        echo "set_findpass_change</br>";

        $arr = array();
        $arr['_memid'] = 'breakm19';
        $arr['_mememail'] = 'breakm39@gmail.com';
        $arr['_new_password'] = get_pass('b1u2rn2');

        $row = call_procedure_data("set_findpass_change", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_config_save',$test_option)){
        echo "set_config_save</br>";

        $arr = array();
        $arr['_type'] = 'test';
        $arr['_key'] = 'test1';
        $arr['_value'] = '1';
        $arr['_descript'] = '테스트 111';

        $row = call_procedure_data("set_config_save", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_config_delete',$test_option)){
        echo "set_config_delete</br>";

        $arr = array();
        $arr['_type'] = 'test';
        $arr['_key'] = 'test1';

        $row = call_procedure_data("set_config_delete", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('get_config_list',$test_option)){
        echo "get_config_list</br>";

        $arr = array();
        $arr['_type'] = 'level_name';

        $row = call_procedure_list("get_config_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('get_config_list',$test_option)){
        echo "get_config_list array</br>";

        $arr = array();
        $arr['_type'] = "'level_name','test'";

        $row = call_procedure_list("get_config_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_auth_log", $test_option)){
        echo "set_auth_log</br>";

        $arr = array();
        $arr['_req_id'] = "id123456";
        $arr['_auth_di'] = "CC0GCCqGSIb3DQIJAyEAHQQE1lrby3kr3p0/Lw3KpcwMeyapxqCinCcke6vgn4Q=";
        $arr['_session_id'] = "ccv8d8k2lur9vhj9n81o4l6910";
        $arr['_type'] = "phone";
        $arr['_info'] = "장현진|19741103|1";
        $arr['_memo'] = "window";

        $row = call_procedure_data("set_auth_log", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_auth_log", $test_option)){
        echo "set_auth_log</br>";

        $arr = array();
        $arr['_req_id'] = "id123456";
        $arr['_auth_di'] = "CC0GCCqGSIb3DQIJAyEAHQQE1lrby3kr3p0/Lw3KpcwMeyapxqCinCcke6vgn4Q=";
        $arr['_session_id'] = "ccv8d8k2lur9vhj9n81o4l6910";
        $arr['_type'] = "phone";
        $arr['_info'] = "장현진|19741103|1";
        $arr['_memo'] = "window";

        $row = call_procedure_data("set_auth_log", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_member_levelup',$test_option)){
        echo "set_member_levelup</br>";


        $return = '';
        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_islevelup'] = '$return';

        $row = call_procedure_data("set_member_levelup", $arr);
        print_r($row);
        print('return:'.$return);
        echo "</br></br>";
    }

    if(in_array('set_member_leveldown',$test_option)){
        echo "set_member_leveldown</br>";


        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_isleveldown'] = '';

        $row = call_procedure_data("set_member_leveldown", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array('set_member_auth',$test_option)){
        echo "set_member_auth</br>";


        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_auth_di'] = 'CC0GCCqGSIb3DQIJAyEAHQQE1lrby3kr3p0/Lw3KpcwMeyapxqCinCcke6vgn4Q=';
        $row = call_procedure_data("set_member_auth", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("get_member_join_auth", $test_option)){
        echo "get_member_join_auth</br>";

        $arr = array();
        $arr['_email'] = 'breakm33@gmail.com';
        $arr['_mobile'] = '01087498522';

        $row = call_procedure_data("get_member_join_auth", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_join_auth_log", $test_option)){
        echo "set_join_auth_log join</br>";

        $arr = array();
        $arr['_auth_info'] = "breakm40@gmail.com";
        $arr['_auth_type'] = "join";
        $arr['_session_id'] = "4hr9sdyf9asyf9awyf87yf2s"; // session_id();
        $arr['_auth_number'] = "237609";

        $row = call_procedure_data("set_join_auth_log", $arr);

        print_r($row);
        echo "</br></br>";
    }
    if(in_array("set_join_auth_ok", $test_option)){
        echo "set_join_auth_ok join</br>";

        $arr = array();
        $arr['_auth_info'] = "breakm40@gmail.com";
        $arr['_auth_type'] = "join";
        $arr['_session_id'] = "4hr9sdyf9asyf9awyf87yf2s"; //session_id();
        $arr['_auth_number'] = "237609";

        $row = call_procedure_data("set_join_auth_ok", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_join_auth_log", $test_option)){
        echo "set_join_auth_log find</br>";

        $arr = array();
        $arr['_email'] = "breakm33@gmail.com";
        $arr['_auth_type'] = "find";
        $arr['_session_id'] = "4hr9sdyf9asyf9awyf87yf33";
        $arr['_auth_number'] = "237629";

        $row = call_procedure_data("set_join_auth_log", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_join_auth_ok", $test_option)){
        echo "set_join_auth_ok find</br>";

        $arr = array();
        $arr['_email'] = "breakm33@gmail.com";
        $arr['_auth_type'] = "find";
        $arr['_session_id'] = "4hr9sdyf9asyf9awyf87yf33";
        $arr['_auth_number'] = "237629";

        $row = call_procedure_data("set_join_auth_ok", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_member_join", $test_option)){
        echo "set_member_join</br>";

        $arr = array();
        $arr['_member_id'] = "breakm42";
        $arr['_email'] = "hol1000@gmail.com";
        $arr['_mobile'] = "";
        $arr['_nickname'] = "가이라2";
        $arr['_auth_type'] = "E";
        $arr['_member_pass'] = get_pass("b1u2rn");
        $arr['_auth_di'] = '';
        $arr['_is_email_recv'] = 'Y';

        $row = call_procedure_data("set_member_join", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_member_simple_join", $test_option)){
        echo "set_member_simple_join</br>";

        $arr = array();
        $arr['_member_id'] = "admin";
        $arr['_email'] = "hol1000.com@gmail.com";
        $arr['_nickname'] = "관리자";
        $arr['_member_pass'] = get_pass("ghfcjs1");
        $arr['_member_level'] = '90';
        $arr['_is_manager'] = 'Y';

        $row = call_procedure_data("set_member_simple_join", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array('set_member_draw',$test_option)){
        echo "set_member_draw</br>";

        $arr = array();
        $arr['_member_id'] = 'breakm19';
        $arr['_email'] = 'breakm39@gmail.com';
        $arr['_password'] = get_pass('b1u2rn') ;
        $arr['_draw_reason'] = 'draw_50|@|@sdf' ;

        $row = call_procedure_data("set_member_draw", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_member_drawrestore',$test_option)){
        echo "set_member_drawrestore</br>";

        $arr = array();
        $arr['_member_idx'] = '8';

        $row = call_procedure_data("set_member_drawrestore", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_mobile_auth_log", $test_option)){
        echo "set_mobile_auth_log</br>";

        $arr = array();
        $arr['_mobile'] = '01089028147';
        $arr['_auth_type'] = "join";
        $arr['_session_id'] = "4hr9sdyf9asyf9awyf87yf2";
        $arr['_auth_number'] = "237609";

        $row = call_procedure_data("set_mobile_auth_log", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_mobile_auth_ok", $test_option)){
        echo "set_mobile_auth_ok</br>";

        $arr = array();
        $arr['_mobile'] = '01089028147';
        $arr['_auth_type'] = "find";
        $arr['_session_id'] = "4hr9sdyf9asyf9awyf87yf2";
        $arr['_auth_number'] = "237609";

        $row = call_procedure_data("set_mobile_auth_ok", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_member_nickname',$test_option)){
        echo "set_member_nickname</br>";

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_new_nickname'] = '블루스피아1' ;

        $row = call_procedure_data("set_member_nickname", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array('set_member_password',$test_option)){
        echo "set_member_password</br>";

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_now_password'] = get_pass("b1u2rn2");
        $arr['_new_password'] = get_pass("b1u2rn");

        $row = call_procedure_data("set_member_password", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_member_login", $test_option)){
        echo "set_member_login</br>";

        $arr = array();
        $arr['_member_id'] = "breakm33";
        $arr['_member_pass'] = get_pass("b1u2rn");
        $arr['_ip'] = $com['myip'];
        $arr['_is_mobile'] = get_isMobile($_SERVER['HTTP_USER_AGENT']);
        $arr['_user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        $row = call_procedure_data("set_member_login", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_block_time", $test_option)){
        echo "get_member_block_time</br>";

        $arr = array();
        $arr['_member_idx'] = "1";
        $arr['_block_time'] = "";

        $row = call_procedure_data("get_member_block_time", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_info", $test_option)){
        echo "get_member_info enc</br>";

        $arr = array();
        $arr['_member_idx'] = get_idx_enc("63");

        $row = call_procedure_data("get_member_info", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_info", $test_option)){
        echo "get_member_info</br>";

        $arr = array();
        $arr['_member_idx'] = "1";

        $row = call_procedure_data("get_member_info", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_level_percent", $test_option)){
        echo "get_member_level_percent</br>";

        $arr = array();
        $arr['_member_idx'] = "1";

        $row = call_procedure_data("get_member_level_percent", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_sel_from", $test_option)){
        echo "get_member_sel_from nickname</br>";

        $arr = array();
        $arr['_type'] = "coin"; // nickname, mobile, level, point, coin, last_login_date, last_login_ip
        $arr['_member_idx'] = "1";

        $row = call_procedure_data("get_member_sel_from", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_sel_from", $test_option)){
        echo "get_member_sel_from mobile</br>";

        $arr = array();
        $arr['_type'] = "mobile";
        $arr['_member_idx'] = "1";

        $row = call_procedure_data("get_member_sel_from", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_idx_from", $test_option)){
        echo "get_member_idx_from email</br>";

        $arr = array();
        $arr['_type'] = "email";
        $arr['_member'] = 'breakm33@gmail.com';
        // $arr['_type'] = "nickname";
        // $arr['_member'] = "N우리";
        // $arr['_type'] = "mobile";
        // $arr['_member'] = "01089028147";
        // $arr['_type'] = "id";
        // $arr['_member'] = "breakm33";

        $row = call_procedure_data("get_member_idx_from", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_idx_from", $test_option)){
        echo "get_member_idx_from nick</br>";

        $arr = array();
        $arr['_type'] = "nickname";
        $arr['_member'] = "Ns우리";
        // $arr['_type'] = "mobile";
        // $arr['_member'] = "01089028147";
        // $arr['_type'] = "id";
        // $arr['_member'] = "breakm33";

        $row = call_procedure_data("get_member_idx_from", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_idx_from", $test_option)){
        echo "get_member_idx_from mobile</br>";

        $arr = array();
        $arr['_type'] = "mobile";
        $arr['_member'] = "01089028147";

        $row = call_procedure_data("get_member_idx_from", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_idx_from", $test_option)){
        echo "get_member_idx_from id</br>";

        $arr = array();
        $arr['_type'] = "id";
        $arr['_member'] = "breakm33";

        $row = call_procedure_data("get_member_idx_from", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("get_member_id_from_auth", $test_option)){
        echo "get_member_id_from_auth</br>";

        $arr = array();
        $arr['_auth_di'] = "CC0GCCqGSIb3DQIJAyEAHQQE1lrby3kr3p0/Lw3KpcwMeyapxqCinCcke6vgn4Q=";
        $arr['_info'] = "장현진|19741103|1";

        $row = call_procedure_data("get_member_id_from_auth", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_auth_log", $test_option)){
        echo "get_auth_log</br>";

        $arr = array();
        $arr['_member_idx'] = "1";
        $arr['_auth_type'] = ""; // phone, ipin
        $arr['_is_join'] = "Y";

        $row = call_procedure_data("get_auth_log", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('get_login_log',$test_option)){
        echo "get_login_log</br>";

        $arr = array();
        $arr['_member_idx'] = '';
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '10';

        $row = call_procedure_list("get_login_log", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_session_info", $test_option)){
        echo "set_session_info</br>";

        $arr = array();
        $arr['_session_id'] = "ccv8d8k2lur9vhj9n81o4l6910";
        $arr['_member_idx'] = "1";
        $arr['_status'] = "I";

        $row = call_procedure_data("set_session_info", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_session_info", $test_option)){
        echo "get_member_session_info</br>";

        $arr = array();
        $arr['_member_idx'] = get_idx_enc("23");
        // $arr['_member_idx'] = "1";

        $row = call_procedure_data("get_member_session_info", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_accuse_insert", $test_option)){
        echo "set_accuse_insert</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_table_idx'] = "22";
        $arr['_illegal_midx'] = "3";
        $arr['_accuse_midx'] = "12";
        $arr['_reason_type'] = "accuse_1";
        $arr['_reason_detail'] = "시로리소아사";

        $row = call_procedure_data("set_accuse_insert", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_member_block", $test_option)){
        echo "set_member_block</br>";

        $arr = array();
        $arr['_type'] = "R";
        $arr['_member_idx'] = "1";
        $arr['_reason_key'] = "prison_1";
        $arr['_level_key'] = "3";

        $row = call_procedure_data("set_member_block", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_member_unblock", $test_option)){
        echo "set_member_unblock</br>";

        $arr = array();
        $arr['_member_idx'] = "1";

        $row = call_procedure_data("set_member_unblock", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_member_list", $test_option)){
        echo "get_member_list</br>";

        $arr = array();
            $arr['_member_type'] = 'join'; // '', 'join', 'leave', 'block'
            $arr['_srch_sel'] = ''; // '', 'auth', 'notauth', 'joinmobile', 'joinnotauth'
            $arr['_srch_kind'] = ''; // '', 'mid', 'mobile', 'nick'
            $arr['_srch_text'] = '';
            $arr['_skip_num'] = '0';
            $arr['_list_max'] = '25';

        $row = call_procedure_list("get_member_list", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_board_insert", $test_option)){
        echo "set_board_insert</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_type'] = "poker";
        $arr['_subtype'] = "";
        $arr['_subject'] = "333ss";
        $arr['_contents'] = insert_db_contents('<p><img src="http://localhost/data/photo2015/10/f7732ea023a113af3f7bcf7680e25db5_63af6efa00b8de2890e857880645116c.jpg" alt="bbb.jpg" style="width: 640px; height: 347px" /></p>
<p>&nbsp;ㅅㅅㅅㅅㅅ 우하닝리나어미어림어리ㅓ</p>');
        $arr['_member_idx'] = "65";
        $arr['_ip'] = $com['myip'];

        $row = call_procedure_data("set_board_insert", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_board_update", $test_option)){
        echo "set_board_update</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_idx'] = "2";
        $arr['_subtype'] = "야구";
        $arr['_subject'] = "3332";
        $arr['_contents'] = "333sdf2342";

        $row = call_procedure_data("set_board_update", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_board_delete", $test_option)){
        echo "set_board_delete</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_idx'] = "2";

        $row = call_procedure_data("set_board_delete", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_board_recommend", $test_option)){
        echo "set_board_recommend</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_idx'] = "2";
        $arr['_member_idx'] = "2";
        $arr['_is_good'] = "Y";
        $arr['_ip'] = $com['myip'];

        $row = call_procedure_data("set_board_recommend", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_board_recommend_admin", $test_option)){
        echo "set_board_recommend_admin</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_idx'] = "2";
        $arr['_member_idx'] = "2";
        $arr['_is_good'] = "Y";
        $arr['_ip'] = $com['myip'];

        $row = call_procedure_data("set_board_recommend_admin", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_board_hit", $test_option)){
        echo "set_board_hit</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_idx'] = "82";

        $row = call_procedure_data("set_board_hit", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_board_accuse", $test_option)){
        echo "set_board_accuse</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_idx'] = "2";
        $arr['_accuse_midx'] = "1";
        $arr['_reason_type'] = "accuse_2";
        $arr['_reason_detail'] = "";

        $row = call_procedure_data("set_board_accuse", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_board_select", $test_option)){
        echo "set_board_select</br>";

        $arr = array();
        $arr['_table'] = 'community';
        $arr['_idx'] = '3';
        $arr['_type'] = 'humor';
        $arr['_subtype'] = '유머';

        $row = call_procedure_data("set_board_select", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_board_manage", $test_option)){
        echo "set_board_manage</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_idx'] = "2";
        $arr['_accuse_midx'] = "1";
        $arr['_reason_type'] = "accuse_2";
        $arr['_reason_detail'] = "";

        $row = call_procedure_data("set_board_manage", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("get_board_list", $test_option)){
        echo "get_board_list</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_type'] = "";
        $arr['_subtype'] = "";
        $arr['_skip_num'] = "";
        $arr['_list_max'] = "";

        $row = call_procedure_list("get_board_list", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("get_board_list_search", $test_option)){
        echo "get_board_list_search</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_type'] = "";
        $arr['_subtype'] = "";
        $arr['_search_type'] = "nickname";
        $arr['_search_text'] = "N우리";
        $arr['_skip_num'] = "";
        $arr['_list_max'] = "";

        $row = call_procedure_list("get_board_list_search", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_board_list_best", $test_option)){
        echo "get_board_list_best</br>";

        $arr = array();
        $arr['_table'] = "";
        $arr['_type'] = "";
        $arr['_skip_num'] = "";
        $arr['_list_max'] = "";

        $row = call_procedure_list("get_board_list_best", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("get_board_view", $test_option)){
        echo "get_board_view</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_board_idx'] = "1";

        $row = call_procedure_data("get_board_view", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array('set_address_save',$test_option)){
        echo "set_address_save</br>";

        $arr = array();
        $arr['_member_idx'] = '6';
        $arr['_add_member_encidx'] = '7' ; // 11.13 암호화
        $arr['_add_type'] = 'FR' ; //FR FB

        $row = call_procedure_data("set_address_save", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_address_save',$test_option)){
        echo "set_address_save enc</br>";

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_add_member_idx'] = get_idx_enc('7') ;
        $arr['_add_type'] = 'FR' ; //FR, BL, RA

        $row = call_procedure_data("set_address_save", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('get_address_blockcheck',$test_option)){
        echo "get_address_blockcheck</br>";

        $arr = array();
        $arr['_send_member_idx'] = '6';
        $arr['_recv_member_idx'] = '7' ;

        $row = call_procedure_data("get_address_blockcheck", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_address_save',$test_option)){
        echo "set_address_save</br>";

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_add_member_idx'] = '5';
        $arr['_add_type'] = 'FR' ; //FR, BL, RA

        $row = call_procedure_data("set_address_save", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_address_delete_add_idx',$test_option)){
        echo "set_address_delete_add_idx</br>";

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_address_idx'] = '5';

        $row = call_procedure_data("set_address_delete_add_idx", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array('get_address_list',$test_option)){
        echo "get_address_list</br>";

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_addr_type'] = 'FR' ; //FR FB RA ALL N A ㄱ~ ㅎ
        $arr['_search_nick'] = '';
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '10';

        $row = call_procedure_list("get_address_list", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array('set_memo_config',$test_option)){
        echo "set_memo_config</br>";

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_is_rand'] = 'N' ;

        $row = call_procedure_data("set_memo_config", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array('get_memo_config',$test_option)){
        echo "get_memo_config</br>";

        $arr = array();
        $arr['_member_idx'] = '1';

        $row = call_procedure_data("get_memo_config", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array('set_memo_insert',$test_option)){
        echo 'set_memo_insert';

        $arr = array();
        $arr['_send_member_idx'] = '1';
        $arr['_recv_member_idx'] = get_idx_enc('5'); ///암호화.
        $arr['_usecoin'] = '100';
        $arr['_is_rand'] = 'N';
        $arr['_is_recv_pay'] = 'N';
        $arr['_contents'] = insert_db_contents(' 쪽지 테스트스!!! ');
        $arr['_is_block'] = '0';
        $arr['_is_sendcoin'] = 'Y';

        $row = call_procedure_data("set_memo_insert", $arr);
        echo "</br>";
        print_r($row);
        echo "</br></br>";
    }

    if(in_array('set_memo_update',$test_option)){
        echo 'set_memo_update';
// 'is_recvpoint,is_keep,delete_date,is_accuse,'
        $arr = array();
        $arr['memo_idx'] = '2';
        $arr['_set_column'] = 'is_keep';
        $arr['_set_value'] = 'Y';
        $arr['_accuse_type'] = ''; // column: is_accuse, value: Y, accuse_1/accuse_2

        $row = call_procedure_data("set_memo_update", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_point_log", $test_option)){
        echo "set_point_log</br>";

        $arr = array();
        $arr['_type'] = 'wcommunity';
        $arr['_key'] = '2';
        $arr['_point'] = '10';
        $arr['_member_idx'] = '1';
        $arr['_data'] = insert_db_data(json_encode(array('community','10')));

        $row = call_procedure_data("set_point_log", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("get_point_log_list", $test_option)){
        echo "get_point_log_list</br>";

        $arr = array();
        $arr['_srch_kind'] = 'midx'; // '', 'midx', 'mid', 'nick', 'email'
        $arr['_srch_text'] = '1';
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '20';

        $row = call_procedure_list("get_point_log_list", $arr);

        foreach($row as $k=>$v){
            $row[$k]['msg'] = get_point_log_msg($v['value'], $v['data']);
           unset($row[$k]['value']);
        }

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_coin_log", $test_option)){
        echo "set_coin_log</br>";

        $arr = array();
        $arr['_type'] = 'admgift';
        $arr['_key'] = '20161109';
        $arr['_coin'] = '200';
        $arr['_member_idx'] = '1';
        $arr['_data'] = insert_db_data(json_encode(array('관리자 증정','100','선물받음.')));

        $row = call_procedure_data("set_coin_log", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_coin_log_list", $test_option)){
        echo "get_coin_log_list</br>";

        $arr = array();
        $arr['_srch_kind'] = 'midx'; // '', 'midx', 'mid', 'nick', 'email'
        $arr['_srch_text'] = '1';
        $arr['_order_kind'] = 'dateasc';
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '20';

        $row = call_procedure_list("get_coin_log_list", $arr);

        foreach($row as $k=>$v){
            $row[$k]['msg'] = get_point_log_msg($v['value'], $v['data']);
            unset($row[$k]['value']);
        }

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_memo_count", $test_option)){
        echo "get_memo_count</br>";

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_memo_type'] = 'send';
        $arr['_start_date'] = '';

        $row = call_procedure_data("get_memo_count", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array('get_memo_list',$test_option)){
        echo 'get_memo_list';

        $arr = array();
        $arr['_member_idx'] = '1';
        $arr['_memo_type'] = 'send';
        $arr['_skip_num'] = '0';
        $arr['_list_max'] = '5';

        $row = call_procedure_list("get_memo_list", $arr);

        foreach($row as $k=>$v){
            $row[$k]['msg'] = get_point_log_msg($v['value'], $v['data']);
            unset($row[$k]['value']);
        }

        print_r($row);

        echo "</br></br>";

    }


    if(in_array('get_memo_data',$test_option)){
        echo 'get_memo_data';

        $arr = array();
        $arr['_memo_idx'] = '8';
        $arr['_memo_type'] = 'recveive';
        $arr['_member_idx'] = '5'; //get_session('ses_user_idx');

        $row = call_procedure_data("get_memo_data", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_members_joinrefer_insert", $test_option)){
        echo "set_members_joinrefer_insert</br>";

        $arr = array();
        $arr['_session_id'] = session_id();
        $arr['_join_type'] = 'facebook';
        $arr['_referer'] = 'http://l.facebook.com/l.php?u=http%3A%2F%2Frt.score888.com%2Fregister_form_mf.php&h=wAQHMb_-H&s=1';
        $arr['_params'] = insert_db_data(json_encode(array('uid_num'=>'333', 'ad_no'=>'1111')) );
        $arr['_member_idx'] = '';
        $arr['_is_join'] = '';

        $row = call_procedure_data("set_members_joinrefer_insert", $arr);

        print_r($row);
        echo "</br></br>";
    }



    if(in_array("set_popup_save", $test_option)){
        echo "set_popup_save</br>";

        $arr = array();
        $arr['_popidx'] = '';
        $arr['_popname'] = '레이어 팝업 테스트';
        $arr['_type'] = 'layer';
        $arr['_ltop'] = '100';
        $arr['_lleft'] = '100';
        $arr['_swidth'] = '200';
        $arr['_sheight'] = '430';
        $arr['_imagename'] = '';
        $arr['_linkurl'] = insert_db_data('http://naver.com');
        $arr['_is_used'] = 'Y';

        $row = call_procedure_data("set_popup_save", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_popup_used", $test_option)){
        echo "set_popup_used</br>";

        $arr = array();
        $arr['_popidx'] = '2';
        $arr['_is_used'] = 'N';

        $row = call_procedure_data("set_popup_used", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_popup_delete", $test_option)){
        echo "set_popup_delete</br>";

        $arr = array();
        $arr['_popidx'] = '3';

        $row = call_procedure_data("set_popup_delete", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_popup_list", $test_option)){
        echo "get_popup_list</br>";

        $arr = array();
        $arr['_type'] = '';  // window, layer
        $arr['_is_used'] = '';  // '', Y

        $row = call_procedure_list("get_popup_list", $arr);

        print_r($row);
        echo "</br></br>";
    }



    if(in_array("set_banner_save", $test_option)){
        echo "set_banner_save</br>";

        $arr = array();
        $arr['_banidx'] = '';
        $arr['_banname'] = '베너 테스트';
        $arr['_type'] = 'botright'; //'topleft','topright','botleft','botright','midcenter'
        $arr['_seqno'] = '1';
        $arr['_imagename'] = '';
        $arr['_linkurl'] = insert_db_data('http://naver.com');
        $arr['_linktarget'] = insert_db_data('_self');
        $arr['_is_used'] = 'Y';

        $row = call_procedure_data("set_banner_save", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_banner_used", $test_option)){
        echo "set_banner_used</br>";

        $arr = array();
        $arr['_popidx'] = '2';
        $arr['_is_used'] = 'Y';

        $row = call_procedure_data("set_banner_used", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_banner_delete", $test_option)){
        echo "set_banner_delete</br>";

        $arr = array();
        $arr['_popidx'] = '3';

        $row = call_procedure_data("set_banner_delete", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_banner_list", $test_option)){
        echo "get_banner_list</br>";

        $arr = array();
        $arr['_type'] = '';  // window, layer
        $arr['_is_used'] = 'Y';  // '', Y

        $row = call_procedure_data("get_banner_list", $arr);

        print_r($row);
        echo "</br></br>";
    }


    if(in_array("set_comment_insert", $test_option)){
        echo "set_comment_insert</br>";

        $arr = array();
        $arr['_table'] = "community";
        $arr['_board_idx'] = "2";
        $arr['_root_idx'] = "";
        $arr['_parent_idx'] = "";
        $arr['_contents'] = insert_db_contents('댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입');
        $arr['_member_idx'] = "1";
        $arr['_ip'] = $com['myip'];

        $row = call_procedure_data("set_comment_insert", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_comment_update", $test_option)){
        echo "set_comment_update</br>";

        $arr = array();
        $arr['_idx'] = "1";
        $arr['_contents'] = insert_db_contents('sssss댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입니다.댓글입sssssss');
        $arr['_member_idx'] = "1";

        $row = call_procedure_data("set_comment_update", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_comment_delete", $test_option)){
        echo "set_comment_delete</br>";

        $arr = array();
        $arr['_idx'] = "2";
        $arr['_member_idx'] = "1";
        $arr['_is_blind'] = "";
        $arr['_is_admin'] = "";

        $row = call_procedure_data("set_comment_delete", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_alarm_notice_input", $test_option))
    {
        echo "set_alarm_notice_input</br>";

        $arr = array();
        //$arr['_type'] = 'notice';//insert_db_data($board_type);
        $arr['_board_idx'] = '200';//$notice_idx;
        $arr['_member_idx'] = '53';//$user_idx;
        //$arr['_reply_idx'] = '1';

        $row = call_procedure_data('set_alarm_notice_input', $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_alarm_data", $test_option))
    {
        echo "get_alarm_data</br>";

        $arr = array();
        $arr['_member_idx'] = get_session('ses_user_idx');

        $row = call_procedure_list("get_alarm_data", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_alarm_data_cm", $test_option))
    {
        echo "get_alarm_data_cm</br>";

        $arr = array();
        $arr['_member_idx'] = get_session('ses_user_idx');

        $row = call_procedure_list("get_alarm_data_cm", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("set_alarm_is_read", $test_option))
    {
        echo "set_alarm_is_read</br>";

        $arr = array();
        //$arr['_id_read'] = 'Y';
        $arr['_idx'] = '1755';//$idx;
        $arr['_is_read'] = 'Y';
        $row = call_procedure_data("set_alarm_is_read", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_board_member_idx", $test_option))
    {
        echo "get_board_member_idx</br>";
        $btype = 'free';

        $arr = array();
        $arr['_board_table'] = $dbtable_from_type[$btype];
        $arr['_board_idx'] = '1121186';

        $row = call_procedure_data("get_board_member_idx", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_alarm_comment_member_idx", $test_option))
    {
        echo "get_alarm_comment_member_idx</br>";

        $arr = array();
        $arr['_root_idx'] = '539';

        $row = call_procedure_data("get_alarm_comment_member_idx", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_alarm_com_member_idx", $test_option))
    {
        echo "get_alarm_com_member_idx</br>";

        $arr = array();
        $arr['_root_idx'] = '579';
        $arr['_idx'] = '582';

        $row = call_procedure_data("get_alarm_com_member_idx", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_alarm_count", $test_option))
    {
        echo "get_alarm_count</br>";

        $arr = array();
		$arr['_member_idx'] = get_session('ses_user_idx');

		$row = call_procedure_list("get_alarm_count", $arr);

        print_r($row);
        echo "</br></br>";
    }

    if(in_array("get_ticket_excel_list", $test_option))
    {
        echo "get_ticket_excel_list</br>";

        $arr = array();
		$arr['_emode'] = '';

		$row = call_procedure_list("get_ticket_excel_list", $arr);

        print_r($row);
        echo "</br></br>";
    }




?>

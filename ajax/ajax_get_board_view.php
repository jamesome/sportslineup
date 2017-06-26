<?php

    $root_path = $_SERVER['DOCUMENT_ROOT'];
    require_once $root_path."/lib/common.inc";
    require_once $root_path."/lib/common_db.inc";

    $rows = array();

    if ($_POST['board_idx']) {

        try {
            if (!$dbcon) $dbcon = new DB_con();

            $call_fn_name = 'get_board_view';

            $arr = array();
            $arr['_table'] = $dbtable_from_type[$btype];
            $arr['_board_idx'] = $bidx;

            $rows['data'] = call_procedure_data($call_fn_name, $arr);

            if ($rows['data']['is_delete'] == 'Y' || count($rows['data']) < 1) {
                $rows['data'] = array();
                $rows['data']['is_delete'] = 'Y';
            } else {
                $com['bdtable']=$dbtable_from_type[$rows['data']['type']];
                $com['bdtype']=$rows['data']['type'];

                $rows['data']['auth'] = false;
                if (is_board_modify_auth($rows['data']['member_idx'])) {
                    $rows['data']['auth'] = true;
                }

                $rows['data']['profile_src'] = get_user_profile_path($rows['data']['member_idx']);
                $rows['data']['user_idx'] = get_idx_enc($rows['data']['member_idx']);
                $rows['data']['user_level'] = $rows['data']['member_level'];
                $rows['data']['subject'] = get_db_data($rows['data']['subject']);
                $contents = get_db_data($rows['data']['contents']);
                if ($g_mobile == '1') {
                    //img, iframe, embed
                    $contents = set_image_mobile_from_content($contents);
                }

                $rows['data']['contents'] = $contents;

                unset($rows['data']['member_idx']);
                unset($rows['data']['member_level']);
            }

            echo json_encode($rows);
        } catch (Exception $ex) {
            print "db connect error:".$ex->getMessage().', code:'.$ex->getCode();
        }

    } else {
        echo json_encode('Test Data');
    }




?>

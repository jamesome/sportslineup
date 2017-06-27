<?php
/*
 * news list
 * post only
 * requset: type:post, btype, bstype, srch_kind, srch_text, skip_no, list_max, g_mobile
 * 			srch_kind > subject, content, subcontent, nickname
 * response: type:json, data
 *
 */
	$root_path = $_SERVER['DOCUMENT_ROOT'];
	require_once $root_path."/lib/common.inc";
	require_once $root_path."/lib/common_db.inc";

	$rows = array();

	if ($_POST['type']) {
		try {
			if (!$dbcon) $dbcon = new DB_con();

			$call_fn_name = 'get_board_list';

			if ($srch_kind && $srch_text) {
				$call_fn_name .= '_search';
			}

			$arr = array();
			$arr['_table'] = $dbtable_from_type[$type];
			$arr['_type'] = $type;
			$arr['_subtype'] = '';//$bstype;
			$arr['_skip_no'] = '0';//$skip_no;
			$arr['_list_max'] = '15';//$list_max;

			if ($srch_kind && $srch_text) {
				$arr['_srch_kind'] = $srch_kind;
				$arr['_srch_text'] = $srch_text;
			}

			$rows = call_procedure_list($call_fn_name, $arr);

			foreach ($rows as $k => $v) {

				$rows[$k]['subject'] = com_strcut(get_db_data($v['subject']), '72', '..');
        		$rows[$k]['img_tag_use'] = check_contents_image($v['contents']);

        		if (get_session('ses_user_level') >= $com['admin_level']) {
					$rows[$k]['m_member_idx'] = $v['member_idx'];
				}

				$rows[$k]['user_idx'] = get_idx_enc($v['member_idx']);
				$rows[$k]['user_level'] = $v['member_level'];
				unset($rows[$k]['member_idx']);
				unset($rows[$k]['member_level']);
				unset($rows[$k]['contents']);

			}

        	echo $jsondata=json_encode($rows);

		} catch (Exception $ex) {
			print "db connect error:".$ex->getMessage().', code:'.$ex->getCode();
		}

	}

?>

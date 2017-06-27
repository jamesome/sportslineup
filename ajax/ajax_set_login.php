<?php
/*
 * 유저 로그인 ajax
 * post only
 * requset: type:post, userid, userpw
 * response: type:string
 * 		> ok:성공
 * 		> error:오류
 * 		> uid : 아이디 없음.
 *   	> upass : 비번 없음.
 *
 */
	$root_path = $_SERVER['DOCUMENT_ROOT'];
	require_once $root_path."/lib/common.inc";
	require_once $root_path."/lib/common_db.inc";

	if ($_POST['userid']) {
		$uid = $userid;
		$upw = $userpw;
		unset($userid);
		unset($userpw);

		try {
			if (!$dbcon) $dbcon = new DB_con();
		} catch (Exception $ex) {
			print "db connect error:".$ex->getMessage().', code:'.$ex->getCode();
		}
		if (!isset($ex)) {
			$arr = array();
			$arr['_user_id'] = $uid;
			$arr['_user_pass'] = get_pass($upw);
			$arr['_ip'] = $com['myip'];
			$arr['_user_agent'] = $_SERVER['HTTP_USER_AGENT'];

			$row = call_procedure_data("set_member_login", $arr);

			if ($row['result'] == -1) {
				echo 'error';
			} else if ($row['result'] == -2) {
				echo 'uid';
			} else if ($row['result'] == -4) {
				echo 'upass';
			} else if ($row['idx'] > 0) {

				set_session("ses_user_idx", $row['idx']);
				set_session("ses_user_id", $row['memid']);

				echo 'ok';
			}
		}
	}

?>

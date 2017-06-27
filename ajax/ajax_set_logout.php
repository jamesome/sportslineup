<?php
/*
 * 유저 로그아웃 ajax
 * post only
 * requset: type:post, mode = logout
 * response: type:string
 *
 */
	$root_path = $_SERVER['DOCUMENT_ROOT'];
	require_once $root_path."/lib/common.inc";
	require_once $root_path."/lib/common_db.inc";

	if ($_POST['mode'] == 'logout') {

		try {
			if (!$dbcon) $dbcon = new DB_con();
		} catch(Exception $ex) {
			print "db connect error:".$ex->getMessage().', code:'.$ex->getCode();
		}

		if (!isset($ex)) {
			set_session("ses_user_idx", '');
			set_session("ses_user_id", '');

			$sess_id = session_id();
			set_table_update('session'," status='O' "," id='$sess_id' ");

			while (isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '');
				unset($_COOKIE[session_name()]);
			}

			session_destroy();
			session_start();
			session_regenerate_id(TRUE);

			echo 'ok';
		}

	}

?>

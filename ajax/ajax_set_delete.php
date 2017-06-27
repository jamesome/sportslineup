<?php
/*
 * 게시글 선택 삭제 (관리자용)
 * session user_level check
 * post only
 * requset: type:post, cmode, btable, bidx
 * 			cmode > delete, btable, bidx
 * 			cmode > seldelete, bidxs > array (구분자 | (구분자 table/bidx) )
 *
 *
 * response: type:json, data
 * result
 * 		> ok:성공
 * 		> error:오류
 * 		> level : 관리자 아님.
 *   	> mode : mode없음
 */
	$root_path = $_SERVER['DOCUMENT_ROOT'];
	require_once $root_path."/lib/common.inc";
	require_once $root_path."/lib/common_db.inc";

	$rows = array('result'=>'');

	$user_idx = get_session('ses_user_idx');

	if ($user_lev >= $com['admin_level']) {

		try {
			$dbcon = new DB_con();
		} catch(Exception $ex) {
			print "db connect error:".$ex->getMessage().', code:'.$ex->getCode();
		}

		if ($cmode == 'delete') {
			if (!isset($ex)) {
				// 내용 user_idx확인.
		        $call_fn_name = "get_board_view";
				$arr = array();
		        $arr['_board_table'] = insert_db_data($btable);
		        $arr['_board_idx'] = insert_db_data($bidx);

		        $row = call_procedure_data($call_fn_name, $arr);
		        $del_contents = $row['contents'];

		        if(!is_board_modify_auth($user_idx))
				{
		            set_error_logs('aboard delete auth', insert_db_data(json_encode($arr)).$user_idx);
		            $rows['result'] = 'auth';
		        }

		        if($rows['result'] == '')
		        {
			        // 관리자 삭제
		        	$call_fn_name = 'set_board_manage';
		            $arr = array();
		            $arr['_board_table'] = insert_db_data($btable);
		            $arr['_board_idx'] = insert_db_data($bidx);
		            $arr['_comment_idx'] = '';
		            $arr['_comment'] = 'board_delete';
		            $arr['_delete_member_idx'] = $user_idx;
		            $arr['_ip'] = $com['myip'];
		            $arr['_session_id'] = session_id();

		            $row = call_procedure_data($call_fn_name, $arr);

		            if($row['result']<0)
		            {
		            	set_error_logs('aboard delete manage', insert_db_data(json_encode($arr)).$user_idx);
		            	$rows['result'] == 'error';
		            }
			        unset($row);
			    }

			    if($rows['result'] == '')
		        {
			        // delete
			        $call_fn_name = 'set_board_delete';

					$arr = array();
					$arr['_board_table'] = insert_db_data($btable);
					$arr['_board_idx'] = $bidx;

					$row = call_procedure_data($call_fn_name, $arr);

			        if(is_numeric($row['result']) && $row['result'] == $bidx )
					{
						$arr = array();
						$arr['_notice_idx'] = $row['result'];
						$arr['_btable'] = '';
						$arr['_bidx'] = '';

						$rows2 = call_procedure_list("get_notice_with_notice_idx", $arr);

						foreach ($rows2 as $value)
						{
							$board_table = $dbtable_from_type[$value['table_type']];

							$arr = array();
							$arr['_board_table'] = insert_db_data($board_table);
							$arr['_board_idx'] = $value['table_idx'];

							$row = call_procedure_data($call_fn_name, $arr);

							$arr = array();
							$arr['_btable'] = insert_db_data($board_table);
							$arr['_bidx'] = $row['result'];

							call_procedure_list("set_notice_with_delete_from_board", $arr);
						}
						$rows['result'] = 'ok';
					}
					else
					{
						$rows['result'] = 'error';
					}
				}
			}
		} else if($cmode == 'selbrddelete') {
			if(!isset($ex))
			{
				$arr_binfo = explode('|', $bidxs);
				if(count($arr_binfo))
				{
					foreach($arr_binfo as $bidx)
					{

						if($bidx == '') continue;

						if($rows['result'] == '')
				        {
							// 내용 user_idx확인.
					        $call_fn_name = "get_board_view";
							$arr = array();
					        $arr['_board_table'] = insert_db_data($btable);
					        $arr['_board_idx'] = insert_db_data($bidx);

					        $row = call_procedure_data($call_fn_name, $arr);
					        $del_contents = $row['contents'];

					        if(!is_board_modify_auth($user_idx))
							{
					            set_error_logs('aboard delete auth', insert_db_data(json_encode($arr)).$user_idx);
					            $rows['result'] = 'auth';
					        }
					    }
					    else
					    {
							break;
					    }

				        if($rows['result'] == '')
				        {
					        // 관리자 삭제
				        	$call_fn_name = 'set_board_manage';
				            $arr = array();
				            $arr['_board_table'] = insert_db_data($btable);
				            $arr['_board_idx'] = insert_db_data($bidx);
				            $arr['_comment_idx'] = '';
				            $arr['_comment'] = 'board_delete';
				            $arr['_delete_member_idx'] = $user_idx;
				            $arr['_ip'] = $com['myip'];
				            $arr['_session_id'] = session_id();

				            $row = call_procedure_data($call_fn_name, $arr);

				            if($row['result']<0)
				            {
				            	set_error_logs('aboard delete manage', insert_db_data(json_encode($arr)).$user_idx);
				            	$rows['result'] == 'error';
				            }
					        unset($row);
					    }

					    if($rows['result'] == '')
				        {
					        // delete
					        $call_fn_name = 'set_board_delete';

							$arr = array();
							$arr['_board_table'] = insert_db_data($btable);
							$arr['_board_idx'] = $bidx;

							$row = call_procedure_data($call_fn_name, $arr);

					        if(is_numeric($row['result']) && $row['result'] == $bidx )
							{
								$arr = array();
								$arr['_notice_idx'] = $row['result'];
								$arr['_btable'] = '';
								$arr['_bidx'] = '';

								$rows2 = call_procedure_list("get_notice_with_notice_idx", $arr);

								foreach ($rows2 as $value)
								{
									$board_table = $dbtable_from_type[$value['table_type']];

									$arr = array();
									$arr['_board_table'] = insert_db_data($board_table);
									$arr['_board_idx'] = $value['table_idx'];

									$row = call_procedure_data($call_fn_name, $arr);

									$arr = array();
									$arr['_btable'] = insert_db_data($board_table);
									$arr['_bidx'] = $row['result'];

									call_procedure_list("set_notice_with_delete_from_board", $arr);
								}

								//$rows['result'] = 'ok';
							}
							else
							{
								$rows['result'] = 'error';
							}
						}
					}
				}

				if($rows['result'] == '')
				{
					$rows['result'] = 'ok';
				}

			}
			else
			{
				$rows['result'] = 'db';
			}

		}

		unset($row);
	}
	else
	{
		$rows['result'] = 'level';
	}


	echo json_encode($rows);

?>

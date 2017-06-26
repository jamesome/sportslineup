<?php

    $root_path = $_SERVER['DOCUMENT_ROOT'];
    require_once $root_path."/lib/common.inc";
    require_once $root_path."/lib/common_db.inc";

    // $main_news_array = array(
    //                         array('main'),
    //                         array('sub'),
    //                         array('soccer'),
    //                         array('baseball'),
    //                         array('basketball'),
    //                         array('valleyball'),
    //                         array('hockey')
    //                     );
    $main_board_array = array(
							array('free'),
							array('best'),
							array('tournament'),
							array('photo'),
							array('poker'),
							array('cafe')
						);
    $main_rows = array();

    if (count($main_board_array)) {
    	try {
    		$dbcon = new DB_con();

    		foreach ($main_board_array AS $bk => $news_type) {
    			$main_rows[$news_type[0]] = get_board_lists($news_type[0]);
    		}

        	echo json_encode($main_board_array[0]);

    	} catch (Exception $ex) {
    		print "db connect error:".$ex->getMessage().', code:'.$ex->getCode();
    	}
    }

    function get_board_lists($news_type)
    {
        global $com, $dbtable_from_type, $thumb_size;

        $result = $arr = array();
		$board_max = 3;
		$call_fn_name = 'get_board_list_notnotice';

		// $arr['_table'] = $dbtable_from_type[$news_type];
		// $arr['_type'] = $news_type;
		// $arr['_subtype'] = "";
		// $arr['_skip_no'] = "0";
		// $arr['_list_max'] = $board_max;
        //
    	// $result = call_procedure_list($call_fn_name, $arr);

        $arr['_table'] = $dbtable_from_type[$news_type];
		$arr['_type'] = $news_type;
		$arr['_subtype'] = "";
		$arr['_skip_no'] = "0";
		$arr['_list_max'] = $board_max;

		$result = call_procedure_list($call_fn_name, $arr);

		foreach ($result as $k => $v) {
    		$result[$k]['thumb'] = $com['url_data']."/data/thumb/".$thumb_size['photo'][0].'_'.$thumb_size['photo'][1].'/'.$v['type'].'/'.$v['idx'];
    		$result[$k]['subject'] = com_strcut(get_db_data($v['subject']), '46', '..');
        	$result[$k]['view_contents'] = strip_tags($rows[$k]['contents']);
        	$result[$k]['reg_date'] = strip_tags($rows[$k]['contents']);
            //$result[$k]['type'] = strip_tags($rows[$k]['contents']);
			unset($result[$k]['contents']);
		}

    	return $result;
    }

?>

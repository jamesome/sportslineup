<?php

    // 세션변수 생성
    function set_session($session_name, $value)
    {
        if(!is_numeric($value) && $value == null){
            unset( $_SESSION["$session_name"] );
            unset( $$session_name );
        }else{
            $$session_name = $_SESSION[$session_name] = $value;
        }
    }

    // 세션변수값 얻음
    function get_session($session_name)
    {
        return $_SESSION["$session_name"];
    }

    // 쿠키변수값 생성
    function set_cookie($cookie_name, $value, $expire)
    {
        if(!is_numeric($value) && $value == null){
            setcookie($cookie_name, "", time()-(3600));
            unset( $_COOKIE["$cookie_name"] );
            unset( $$cookie_name );
        }else{
            setcookie($cookie_name, $value, time()+(60*60*24*$expire));
            $$cookie_name = $value;
        }
    }

    // 쿠키변수값 얻음
    function get_cookie($cookie_name)
    {
        return $_COOKIE["$cookie_name"];
    }

    // 암호화
    function get_pass($str){
        $str1 = substr(md5($str),0,15);
        $str2 = substr(md5($str),-15);
        $ret = md5($str1.$str2);
        $ret = substr($ret,0,25).$str1;
        return $ret;
    }

    // idx 암호화
    function get_idx_enc($idx){
        if(is_numeric($idx)){
            return hash('sha256', hash('sha256', $idx));
        }else{
            return $idx;
        }
    }

    //
    function _microtime () {
        return array_sum(explode(' ',microtime()));
    }

    /// 경고창 이동
    function alert_href($msg, $url="", $target="", $ex=""){
        global $com;

        $alert = "";
        $href = "";

        if($url=="")
            $href = "location.href='$com[r_main]';";
        else if(stristr($url, "close"))
            $href = "self.opener=self;self.close();";   //window.close();
        else if(stristr($url, "back"))
            $href = "history.go(-1);";
        else if(stristr($url, "reload"))
            $href = "location.reload();";
        else
            $href = "location.href='$url';";

        if($msg == '')
            $alert = "";
        else {
            $msg = str_replace('"', '\"', $msg);
            $alert = "alert(\"$msg\");";
        }

        $target = $target ? $target.'.' : '';

        echo "<script language=\"javascript\">$alert $ex {$target}$href</script>";
        exit;
    }


    /// form 생성후 전송
    function gen_form_submit($url, $val, $target=""){
        global $com;

        if($target)
             $target = '_'. $target;
        else
             $target = '_self';

        echo "<form name='gen_form_frm' method='post' action='$url' target='$target'>";
        foreach($val as $k=>$v){
            echo "<input type='hidden' name='$k' value='$v'>";
        }
        echo "</form>";

        echo "<script>document.gen_form_frm.submit();</script>";
        exit;
    }

    // 입력값 검사 상수
    define('_ALPHAUPPER_', 1); // 영대문자
    define('_ALPHALOWER_', 2); // 영소문자
    define('_ALPHABETIC_', 4); // 영대,소문자
    define('_NUMERIC_', 8); // 숫자
    define('_HANGUL_', 16); // 한글
    define('_SPACE_', 32); // 공백
    define('_SPECIAL_', 64); // 특수문자

    // 문자열이 한글, 영문, 숫자, 특수문자로 구성되어 있는지 검사
    function check_string($str, $options)
    {
        $s = '';
        for($i=0;$i<strlen($str);$i++) {
            $c = $str[$i];
            $oc = ord($c);

            // 한글
            if ($oc >= 0xA0 && $oc <= 0xFF) {
                if (strtoupper($com['charset']) == 'UTF-8') {
                    if ($options & _HANGUL_) {
                        $s .= $c . $str[$i+1] . $str[$i+2];
                    }
                    $i+=2;
                } else {
                    // 한글은 2바이트 이므로 문자하나를 건너뜀
                    $i++;
                    if ($options & _HANGUL_) {
                        $s .= $c . $str[$i];
                    }
                }
            }
            // 숫자
            else if ($oc >= 0x30 && $oc <= 0x39) {
                if ($options & _NUMERIC_) {
                    $s .= $c;
                }
            }
            // 영대문자
            else if ($oc >= 0x41 && $oc <= 0x5A) {
                if (($options & _ALPHABETIC_) || ($options & _ALPHAUPPER_)) {
                    $s .= $c;
                }
            }
            // 영소문자
            else if ($oc >= 0x61 && $oc <= 0x7A) {
                if (($options & _ALPHABETIC_) || ($options & _ALPHALOWER_)) {
                    $s .= $c;
                }
            }
            // 공백
            else if ($oc >= 0x20) {
                if ($options & _SPACE_) {
                    $s .= $c;
                }
            }
            else {
                if ($options & _SPECIAL_) {
                    $s .= $c;
                }
            }
        }

        // 넘어온 값과 비교하여 같으면 참, 틀리면 거짓
        return ($str == $s);
    }

    // 문자열 제한(한글포함)
    function com_strcut( $str, $size, $l_str="..." ){
        global $com;
        return mb_strimwidth(trim($str), '0',$size,$l_str,$com['charset']);;
    }

    // DB 입력 데이터 변형
    function insert_db_data($data){
        $data = addslashes(trim(strip_tags($data)));
        return $data;
    }

    // DB 입력 컨텐츠 변형
    function insert_db_contents($data){
        $data = addslashes(trim($data));
        return $data;
    }

    // DB 데이터 출력 변형
    function get_db_data($data, $type=''){
        if($type=='html'){
            $data = htmlspecialchars (stripslashes($data));
        }else{
            $data = stripslashes($data);
        }
        return $data;
    }

    // 게시판 날짜 변경 (날짜, 날짜구분자, 전체표시여부)
    function get_board_date($date, $separate='', $type=''){
        global $com;
        $date = str_replace('T', ' ', $date);
        if($separate){
            $date = str_replace('-', $separate, $date);
        }

        if($type==1){
            return substr($date, 0, 16);
        }else if($type==2){
            return substr($date, 0, 19);
        }else if($type==3){
            $time = strtotime($date);
            $week = date('w', $time);
            return date('m/d ', $time).$com['day'][$week].date(' H:i', $time);
        }else{
            if(date('Y') == substr($date, 0, 4)
                && date('m') == substr($date, 5, 2)
                && date('d') == substr($date, 8, 2))
            {
                return substr($date, 11, 5);

            }else{
                return substr($date, 0, 10);
            }
        }
    }

    // 게시판 댓글 리스트 호출 및 변환.
    function call_get_comment_list($table, $idx){
        global $com;
        $arr = array();
        $arr['_board_table'] = $table;
        $arr['_board_idx'] = $idx;

        $row = call_procedure_list("get_comment_list", $arr);

        foreach($row as $k=>$v){
            if($v['is_blind'] == 'Y'){
                $row[$k]['comment'] = '블라인드 처리된 글입니다.';
            }else if($v['is_delete'] == 'Y'){
                $row[$k]['comment'] = '삭제된 글입니다.';
            }else{
                $row[$k]['comment'] = str_replace(array("\r\n", "\n", "\n"), "<br />", get_db_data($v['comment']));
            }


            $row[$k]['user_idx'] = $v['user_idx'] = $v['member_idx'];
            $row[$k]['user_level'] = $v['user_level'] = $v['member_level'];
            $row[$k]['profile_src'] = get_user_profile_path($v['member_idx']);

            if( $row[$k]['user_idx'] == get_session('ses_user_idx') || get_session('ses_user_level') >= $com['admin_level']){
               $row[$k]['is_mod_auth'] = true;
            }
            if(get_session('ses_user_idx') && $v['is_delete']=='N'){
               $row[$k]['is_reply'] = true;
            }
            unset($v['member_idx']);
            unset($row[$k]['member_idx']);
            unset($row[$k]['m_member_idx']);
            unset($v['member_level']);
            unset($row[$k]['member_level']);
        }
        return $row;
    }

    // 파일 저장 경로 설정.
    function get_file_path($uploadDirs, $d_name, $is_trans_name=true){
        if(!is_dir($uploadDirs)){
            mkdir($uploadDirs, 0777);
            chmod($uploadDirs, 0777);
        }
        $uploadDirs .= date("Y/", time());
        if(!is_dir($uploadDirs)){
            mkdir($uploadDirs, 0777);
            chmod($uploadDirs, 0777);
        }
        $uploadDirs .= date("m/", time());
        if(!is_dir($uploadDirs)){
            mkdir($uploadDirs, 0777);
            chmod($uploadDirs, 0777);
        }

        if($is_trans_name){
            $d_name_arr = explode('.',$d_name);
            $filename_ext = strtolower(array_pop($d_name_arr));
            $tmp_name = md5(time().get_session("ses_user_idx"))."_".md5($d_name);
            $tmp_name .= '.'.$filename_ext;
        }else{
            $tmp_name = $d_name;
        }

        $newPath = $uploadDirs.$tmp_name;

        $ret[0] = $tmp_name;
        $ret[1] = $newPath;

        return $ret;
    }

    // GET 데이터에서 idx 제외
    function get_sub_idx_from_qstr($qstr=''){
        $qstr = $qstr ? $qstr : $_SERVER['QUERY_STRING'];
        $qstr = preg_replace('/\&idx=[0-9]*/','',urldecode($qstr));
        $qstr = preg_replace('/\&bmode=[a-z]*/','',urldecode($qstr));
        return $qstr;
    }

    // 게시글 이미지 경로 변경.
    function get_image_url_change($contents){
        global $com;

        $search_patterns = '/(src=\\\"http:\/\/'.$com['domain'].'\/data)/';
        $replace_string = 'src=\"http://'.$com['domain_data'].'/data';

        $contents = preg_replace($search_patterns, $replace_string, $contents);

        return $contents;
    }

    // 글쓰기 권한 확인
    function is_board_write_auth(){
        global $com;
        /*
         * 글쓰기 권한 확인
         */

        $ret = false;
        if($com['bdtable'] == 'notice'){
            if($com['bdtype'] == 'notice'){
                if(get_session('ses_user_level') >= $com['admin_level']){
                    $ret = get_session('ses_user_idx');
                }
            }else if($com['bdtype'] == 'faq'){
                if(get_session('ses_user_level') >= $com['admin_level']){
                    $ret = get_session('ses_user_idx');
                }
            }
        }else if($com['bdtable'] == 'school' || $com['bdtable'] == 'offline'){
            if(get_session('ses_user_level') >= $com['admin_level']){
                $ret = get_session('ses_user_idx');
            }
        }else{
            // community
            if($com['bdtype'] == 'best'){// || $com['bdtype'] == 'grinding'
                $ret = false;
            }else if(get_session('ses_user_idx')){
                $ret = true;
            }
        }
        return $ret;
    }

    // 수정 및 삭제 권한 확인
    function is_board_modify_auth($board_member_idx){
        global $com;
        /*
         * 수정 및 삭제 권한 확인
         */
        $ret = false;
        if($com['bdtable'] == 'notice'){
            if($com['bdtype'] == 'notice'){
                if(get_session('ses_user_level') >= $com['admin_level']){
                    $ret = get_session('ses_user_idx');
                }
            }
        }else if($com['bdtable'] == 'school'){
            // if($com['bdtype'] == 'mov'){
                if(get_session('ses_user_level') >= $com['admin_level']){
                    $ret = get_session('ses_user_idx');
                }
            // }
        }else if($com['bdtable'] == 'offline'){
            // if($com['bdtype'] == 'cafe'){
                if(get_session('ses_user_level') >= $com['admin_level']){
                    $ret = get_session('ses_user_idx');
                }
            // }
        }else{
            if($board_member_idx == get_session('ses_user_idx') || get_session('ses_user_level')>=$com['admin_level']){
                $ret = true;
            }
        }
        return $ret;
    }

    // 댓글 쓰기 권한 확인
    function is_comment_write_auth(){
        global $com;
        /*
         * 댓글 쓰기 권한 확인
         */
        $com['bdtable'];
        return get_session('ses_user_idx');
    }

    // 고객센터 관리자 보기 권한
    // true 이면 고객센터를 일반 게시판 처럼 볼수 있음.
    function is_notice_auth(){
        global $com;
        return (get_session('ses_user_level') >= $com['admin_level'] || $com['bdtable'] != 'notice');
    }


    // 게시글 이미지 태그 확인.
    function check_contents_image($contents){
        if(strpos(strtolower($contents), "<img") !== false){
            return true;
        }else{
            return false;
        }
    }

    // 게시글 동영상 태그 확인
    function check_contents_movie($contents){
        $contents = strtolower($contents);
        if(strpos($contents, "<iframe") !== false){
            if(strpos($contents, '//videofarm.daum.net') !== false){

            }else if(strpos($contents, 'youtube.com/') !== false){

            }else if(strpos($contents, '//player.vimeo.com') !== false){

            }else if(strpos($contents, 'dailymotion.com/') !== false){

            }else if(strpos($contents, 'soundcloud.com/') !== false){

            }else{
                return false;
            }
            return true;
        }else{
            return false;
        }
    }

    // 타사이트에 링크된 이미지 가져오기.
    function set_save_image_from_link($contents){
        global $root_path, $com, $site_conf;

        preg_match_all("/<img[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", stripslashes($contents), $matches);

        $snoopy = new Snoopy;
        $snoopy->rawheaders["Pragma"] = "no-cache";

        $img_length = sizeof($matches[1]);
        $new_image_array = array($img_length);

        for($i=0; $i < $img_length; $i++){
            $img_path = $matches[1][$i];
            if(stripos($img_path, 'hol1000') !== false ){
                continue;
            }

            $temp_referer = explode('/', $img_path);
            $snoopy->referer = "http://".$temp_referer[2];

            $snoopy->fetch($img_path);

            $savefile_path = get_file_path($root_path.'/data/photo/', basename($img_path));

            $filename = $savefile_path[0];
            $savefile = $savefile_path[1];

            $fh = fopen($savefile, "w");
            fwrite($fh, $snoopy->results);
            fclose($fh);
            chmod($savefile, 0777);

            $savepath = str_replace($root_path, '', $savefile);
            $contents = str_replace($img_path, $com['url_data'].$savepath, $contents);
        }
        return $contents;
    }

    function set_copy_image_from_tempdata($contents){
        global $root_path, $com, $site_conf;

        preg_match_all("/<img[^>]*src=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/", stripslashes($contents), $matches);


        $img_length = sizeof($matches[1]);
        $new_image_array = array($img_length);

        for($i=0; $i < $img_length; $i++){
            $img_path = $matches[1][$i];
            if(stripos($img_path, 'hol1000') !== false  && stripos($img_path, '/data/photo/') !== false ){
                continue;
            }
            $savefile_path = get_file_path($root_path.'/data/photo/', basename($img_path));

            $filename = $savefile_path[0];
            $savefile = $savefile_path[1];

            // set_test_logs('tmepphoto', array($img_path, $filename, $savefile, $savefile_path) ,'img');
            $img_root_path = str_replace($com['url'], $root_path, $img_path);
            @copy($img_root_path, $savefile);
            chmod($savefile, 0777);

            $savepath = str_replace($root_path, '', $savefile);
            $contents = str_replace($img_path, $com['url_data'].$savepath, $contents);
        }

        return $contents;

    }

    // 게시글에서 썸네일 만들 이미지 경로 가져오기.
    function get_contents_image_path($contents){
        global $root_path;
        preg_match_all("/<img[^>]*src=['\"]?([^>\'\"]+)['\"]?[^>]*>/", stripslashes($contents), $matches);

        if(sizeof($matches[1])){
            $temp_arr = explode('/',$matches[1][0]);
            array_shift($temp_arr);
            array_shift($temp_arr);
            array_shift($temp_arr);
            return $root_path.'/'.implode('/',$temp_arr);
        }else{
            return false;
        }
    }

    // 웹 동영상 썸네일 저장하기 경로 가져오기.
    function set_save_thumbnail_from_movie($contents)
    {
        global $root_path, $com, $site_conf;

        $thumb_link = get_thumbnail_from_movie($contents, false);

        $snoopy = new Snoopy;
        $snoopy->rawheaders["Pragma"] = "no-cache";

        if($thumb_link)
        {
            if(stripos($thumb_link, 'hol1000') !== false ){
                return false;
            }
            else{

            $temp_referer = explode('/', $thumb_link);
            $snoopy->referer = "http://".$temp_referer[2];

            $snoopy->fetch($thumb_link);

            $savefile_path = get_file_path($root_path.'/data/temphoto/', basename($thumb_link));

            $filename = $savefile_path[0];
            $savefile = $savefile_path[1];

            $fh = fopen($savefile, "w");
            fwrite($fh, $snoopy->results);
            fclose($fh);
            chmod($savefile, 0777);

            $savepath = str_replace($root_path, '', $savefile);

            return $savefile;
            }
        }
        else
        {
            return false;
        }


    }

    // 웹 동영상 썸네일 가져오기
    function get_thumbnail_from_movie($contents, $og_base_img=''){
        preg_match_all("/<iframe[^>]*src=['\"]?([^>\'\"]+)['\"]?[^>]*>/", stripslashes($contents), $matches);

        $ret = $og_base_img;
        if(count($matches[1])){
            $temp_arr = explode('/',$matches[1][0]);
            $domain = $temp_arr[2];

            if(strpos($domain, 'daum') !== false){
                preg_match("/vid=([0-9a-zA-Z]*)/", $temp_arr[6], $matche);

                $code = $matche[1];
                /*
                $ajaxUrl = 'http://tvpot.daum.net/clip/ClipInfoXml.do?vid='.$code;
                $ret_post = file_get_contents($ajaxUrl);
                $ret_post = json_decode($ret_post, true);
                xml 형태임. 크로스 도메인 걸림. 귀찮음.
                */
                $ret = 'http://t1.daumcdn.net/tvpot/thumb/'.$code.'/thumb.png';

            }else if(strpos($domain, 'youtube') !== false){
                $code = $temp_arr[4];
                $ret = "http://img.youtube.com/vi/$code/0.jpg";

            }else if(strpos($domain, 'vimeo') !== false){
                $code = $temp_arr[4];
                $ajaxUrl = 'http://vimeo.com/api/v2/video/'.$code.'.json';
                $ret_post = file_get_contents($ajaxUrl);
                $ret_post = json_decode($ret_post, true);

                $ret = $ret_post[0]['thumbnail_large'];

            }else if(strpos($domain, 'dailymotion') !== false){
                $code = $temp_arr[5];
                $thumb = "thumbnail_480_url";  // 60, 120, 180, 240, 360, 480, 720
                $ajaxUrl = 'https://api.dailymotion.com/video/'.$code.'?fields='.$thumb;
                $ret_post = file_get_contents($ajaxUrl);
                $ret_post = json_decode($ret_post, true);

                $ret = $ret_post[$thumb];

            }else if(strpos($domain, 'soundcloud') !== false){
                preg_match("/tracks\/([0-9]*)/", stripslashes($contents), $matche);

                $code = $matche[1];

                /*
                 * http://soundcloud.com/you/apps
                 * id : skykyh83@gmail.com
                 * Client ID : 3a529ab9a452e029e11b71d0fd4c739e
                 * Client Secret : a40efbf3c7aa5efbdaa26c5388647ffa
                 */

                $client_id = '3a529ab9a452e029e11b71d0fd4c739e';
                $ajaxUrl = 'http://api.soundcloud.com/tracks/'.$code.'.json?client_id='.$client_id;

                $ret_post = file_get_contents($ajaxUrl);
                $ret_post = json_decode($ret_post, true);

                /*
                 * original : 썸네일의 원본크기
                 * mini : 16x16 크기의 썸네일
                 * tiny : 20x20 크기의 썸네일
                 * small : 32x32 크기의 썸네일
                 * badge : 47x47 크기의 썸네일
                 * t67x67 : 67x67 크기의 썸네일
                 * large : 100x100 크기의 썸네일(기본값)
                 * t300x300 : 300x300 크기의 썸네일
                 * crop : 400x400 크기의 썸네일
                 * t500x500 : 500x500 크기의 썸네일
                 */

                $ret = str_replace('large','t500x500', $ret_post['artwork_url']);
            }

        }

        return $ret;
    }

    // 썸네일 생성.
    function set_thumbnail($file, $save_file, $max_width, $max_height){
        if(!is_file($file)){
            return false;
        }
        list($img_width, $img_height, $ext) = getimagesize($file);

        $ext_types = array(
            1,  // gif
            2,  // jpg
            3   // png
        );

        if (!in_array($ext, $ext_types)) {
            return false;
        }

        switch ($ext) {
            case 1 :
                $img = imageCreateFromGif($file);
            break;
            case 2 :
                $img = imageCreateFromJpeg($file);
            break;
            case 3 :
                $img = imageCreateFromPng($file);
            break;
        }

        if(!$img){
            return false;
        }

        $save_img = imagecreatetruecolor($max_width, $max_height);
        $offset_x = 0;

        if(($img_width / $max_width) < ($img_height / $max_height)){
            //$img_width = ($img_width / $max_width) * $max_width;
            $img_height = ($img_width / $max_width) * $max_height;
        }else if(($img_width / $max_width) > ($img_height / $max_height)){
            $tmp_width = ($img_height / $max_height) * $max_width;
            $offset_x = ($img_width - $tmp_width) / 2;
            $img_width = $tmp_width;
            //$img_height = ($img_height / $max_height) * $max_height;
        }

        imagecopyresampled($save_img, $img, 0, 0, $offset_x, 0, $max_width, $max_height, $img_width, $img_height);
        imageinterlace($save_img, 1);

        switch ($ext) {
            case 1 :
                imagegif($save_img, $save_file);
            break;
            case 2 :
                imagejpeg($save_img, $save_file, 100);
            break;
            case 3 :
                imagepng($save_img, $save_file);
            break;
        }
        chmod($save_file, 0777);
        imagedestroy($img);
        imagedestroy($save_img);

        return true;
    }


    //  게시판 썸네일 생성.
    function set_board_thumbnail($file, $type, $idx){
        global $root_path, $thumb_size;

        $small_path = $medium_path = $root_path."/data/thumb/";

        if(!is_dir($small_path)){
            mkdir($small_path, 0777);
            chmod($small_path, 0777);
        }

        $small_path .= $thumb_size['mini'][0].'_'.$thumb_size['mini'][1];
        $medium_path .= $thumb_size['photo'][0].'_'.$thumb_size['photo'][1];

        if(!is_dir($small_path)){
            mkdir($small_path, 0777);
            chmod($small_path, 0777);
        }
        if(!is_dir($medium_path)){
            mkdir($medium_path, 0777);
            chmod($medium_path, 0777);
        }

        $small_path .= "/$type";
        $medium_path .= "/$type";
        if(!is_dir($small_path)){
            mkdir($small_path, 0777);
            chmod($small_path, 0777);
        }
        if(!is_dir($medium_path)){
            mkdir($medium_path, 0777);
            chmod($medium_path, 0777);
        }

        $small_path .= "/$idx";
        $medium_path .= "/$idx";
        if(is_file($small_path)){
            unlink($small_path);
        }
        if(is_file($medium_path)){
            unlink($medium_path);
        }

        set_thumbnail($file, $small_path, $thumb_size['mini'][0], $thumb_size['mini'][1]);
        set_thumbnail($file, $medium_path, $thumb_size['photo'][0], $thumb_size['photo'][1]);
    }


    // curl post
    function get_curl_post($url, $post_data){
        $curl = curl_init();

        $opt = array(
           CURLOPT_URL                 => $url,
           CURLOPT_HEADER              => false,
           CURLOPT_POST                => true,
           CURLOPT_POSTFIELDS          => $post_data
        );

        curl_setopt_array( $curl, $opt );

        ob_start();
        $ret = curl_exec($curl);
        $ret = ob_get_contents();
        ob_end_clean();
        // $curl_errno = curl_errno($curl);
        // $curl_error = curl_error($curl);

        return $ret = trim($ret);
    }

    // 에러 로그
    function set_error_logs($key, $msg){
        global $root_path, $com;

        $file_path = $root_path."/data_logs/error/".date("Ymd",time())."_log";
        $fp = fopen($file_path, "a+");
        fwrite($fp, '['.date("H:i:s",time()).'] '.$key.' : '.$msg."\n");
        fclose($fp);
        chmod($file_path, 0777);
    }

    // 로그
    function set_test_logs($key, $msg, $addname){
        global $root_path, $com;

        $file_path = $root_path."/data_logs/sql/".date("YmdH",time()).$addname."_log";
        $fp = fopen($file_path, "a+");
        fwrite($fp, '['.date("H:i:s",time()).'][test] '.$key.' : '.json_encode($msg)."\n");
        fclose($fp);
        chmod($file_path, 0777);
    }

    // 포인트 사용 로그
    function set_point_log($type, $key, $point, $member_idx, $arrData){
        global $com;

        if($point == 0){
            return 'ok';
        }

        if(!$type || !$key || !$point || !$member_idx){
            return 'value';
        }
        if(get_session('ses_user_level') < $com['admin_level']){
            if(get_session('ses_user_point')+$point < 0){
                return 'point';
            }
        }

        if(count($arrData) < 2 && !is_array($arrData)){
            $data = insert_db_data($arrData);
        }else{
            $data = insert_db_data(json_encode($arrData, JSON_UNESCAPED_UNICODE));
        }

        $arr = array();
        $arr['_type'] = $type;
        $arr['_key'] = $key;
        $arr['_point'] = $point;
        $arr['_member_idx'] = $member_idx;
        $arr['_data'] = $data;

        $row = call_procedure_data("set_point_log", $arr);

        if($row['result'] == -1){
            set_error_logs('set_point_log error', insert_db_data(json_encode($arr)).get_session('ses_user_idx'));
            return 'error';
        }else if($row['result'] == -2){
            set_error_logs('set_point_log point', insert_db_data(json_encode($arr)).get_session('ses_user_idx'));
            return 'point';
        }else if($row['result'] == -3){
            set_error_logs('set_point_log lack', insert_db_data(json_encode($arr)).get_session('ses_user_idx'));
            return 'overlap';
        }else if($row['_levelup'] > 0){

            set_session("ses_user_point", $row['result']);
            return 'levelup';
        }else if($row['_leveldown'] > 0){

            set_session("ses_user_point", $row['result']);
            return 'leveldown';
        }else{

            set_session("ses_user_point", $row['result']);
            return 'ok';
        }
    }

    // 포인트 로그 내용 변환
    function get_point_log_msg($value, $data){
        $str_len = sizeof(explode('%s', $value));
        $ret_msg = '';

        $jdata = json_decode($data);

        if(!is_array($jdata))
        {
            $jdata = $data;
        }
        else if(is_array($jdata) && count($jdata) < 2)
        {
            $jdata = $jdata[0];
        }

        switch ($str_len) {
            case 2:
                $ret_msg = sprintf($value, $jdata);
                break;
            case 3:
                $ret_msg = sprintf($value, $jdata[0], $jdata[1]);
                break;
            case 4:
                $ret_msg = sprintf($value, $jdata[0], $jdata[1], $jdata[2]);
                break;
            case 5:
                $ret_msg = sprintf($value, $jdata[0], $jdata[1], $jdata[2], $jdata[3]);
                break;
            default:
                $ret_msg = $value;
                break;
        }

        return $ret_msg;
    }


    // 모바일 접속 확인
    function get_isMobile($agent){
        global $com;

        $m = $com['MobileArray'];

        $checkCount = 0;
        $tlen = sizeof($m);
        for($i=0; $i<$tlen; $i++){
            if(preg_match("/$m[$i]/", strtolower($agent))){ $checkCount++; break; }
        }

        return ($checkCount >= 1) ? 'Y' : 'N';
    }


        /// 환경설정 가져오기.
    function get_config_array( $type ){
        $arr = array();
        $arr['_type'] = $type;
        $row = call_procedure_list("get_config_list", $arr);

        $result = array();
        if(is_array($row)){
            foreach($row AS $k => $v){
                if(strpos($type, "','") !== false)
                {
                    $result[$v['type']][$v['key']]['value'] = $v['value'];
                    $result[$v['type']][$v['key']]['descript'] = $v['description'];

                }
                else
                {
                    $result[$v['key']]['value'] = $v['value'];
                    $result[$v['key']]['descript'] = $v['description'];
                }
            }
        }

        // ksort($result);

        return $result;
    }


    // 코인 사용 로그
    function set_coin_log($type, $key, $coin, $member_idx, $arrData){
        global $com, $root_path;

        if($coin == 0){
            return 'ok';
        }

        if(!$type || !$key || !$coin || !$member_idx){
            return 'value';
        }
        // if(get_session('ses_user_level') < $com['admin_level']){
        //     if(get_session('ses_user_point')+$coin < 0){
        //         return 'coin';
        //     }
        // }

        if(count($arrData) < 2 && !is_array($arrData)){
            $data = insert_db_data($arrData);
        }else{
            $data = insert_db_data(json_encode($arrData, JSON_UNESCAPED_UNICODE));
        }

        $arr = array();
        $arr['_type'] = $type;
        $arr['_key'] = $key;
        $arr['_coin'] = $coin;
        $arr['_member_idx'] = $member_idx;
        $arr['_data'] = $data;

        $row = call_procedure_data("set_coin_log", $arr);

        if($row['result'] == -1){
            set_error_logs('set_coin_log error', insert_db_data(json_encode($arr)).get_session('ses_user_idx'));
            return 'error';
        }else if($row['result'] == -2){
            set_error_logs('set_coin_log coin', insert_db_data(json_encode($arr)).get_session('ses_user_idx'));
            return 'coin';
        }else if($row['result'] == -3){
            set_error_logs('set_coin_log overlap', insert_db_data(json_encode($arr)).get_session('ses_user_idx'));
            return 'overlap';
        }else{
            return 'ok';
        }
    }

    // 메일 발송
    // http://xpertmailer.sourceforge.net/
    // /lib/XPM4-v.0.5
    function send_mail($recv_mail, $recv_name, $subject, $contents){
        global $com;
        $response = false;

        try
        {
            // need php extends php_openssl.dll
            $xMail = new MAIL;

            // connect
            $xMail->Host = 'smtp.gmail.com'; // address
            $xMail->Port = 465; // port
            $xMail->User = $com['mail_username']; // username
            $xMail->Pass = $com['mail_password']; // password
            $xMail->Vssl = 'tls'; //SSL
            $xMail->Tout = 10; // timeout in seconds
            // $xMail->Name = 'localhost'; // local hostname (used in EHLO/HELO SMTP conversation)
            // $xMail->Auth = 'cram-md5'; // authentication type

            // // $xMailcon = $xMail->Connect('smtp.gmail.com', 465, 'username', 'password', 'tls', 10) or die(print_r($xMail->Result));
            $xMailcon = $xMail->Connect();
            if(!$xMailcon)
            {
                throw new Exception('xMail Connect err');
            }

            $xMail->From($com['admin_mail'], $com['admin_name']); // from address
            $xMail->AddTo($recv_mail, $recv_name); // to address
             // subject
            $xMail->Subject = array(
                                'content' => $subject,
                                'charset'=>'utf-8',
                                'encoding'=>'base64'
                                );
            $xMail->Html = array(
                                'content' => $contents,
                                'charset'=>'utf-8',
                                'encoding'=>'base64'
                                );

            // mail send
            $xMailSend = $xMail->Send($xMailcon);
            if(!$xMailSend)
            {
                throw new Exception('xMail Send err');
            }

            $xMail->Disconnect(); // disconnect from server
            // print_r($xMail->History); // optional, for debugging

            $response = true;
        }
        catch(Exception $e)
        {
            // print('mail err:'.$e->getMessage().', code:'.$e->getCode());
        }

        return $response;

    }

    // 회원 프로파일 이미지 가져오기
    function get_user_profile_path($idx){
        global $root_path, $com;

        $profileDir = '/data/user/';
        $profile = $profileDir.get_idx_enc($idx).".jpg";

        $ret = false;

        if($com['dev_mode'] != "D"){
            $ret = is_file($root_path.$profile);
        }else{
            $ret = is_file($root_path.$profile);
        }

        if(!$ret){
            $profile='/data/user/join_user_profile.png';
        }

        return $com['url_data'].$profile;
    }

    function set_access_ip_write(){
        global $root_path, $com, $dbcon;

        //if(!$dbcon){ $dbcon = new DB_Con();}

        $my_server = array('127.0.0.1','23.253.242.26');

        //$cnt = get_table_tcount('login_log', " remote_ip = '".$com['myip']."' ");
        if(!$cnt && !in_array($com['myip'], $my_server)){

            $logs_dir = $root_path."/data_logs/access";
            if(!is_dir($logs_dir)){
                mkdir($logs_dir, 0777);
                chmod($logs_dir, 0777);
            }
            $logs_dir .= '/'.date("Ym",time());
            if(!is_dir($logs_dir)){
                mkdir($logs_dir, 0777);
                chmod($logs_dir, 0777);
            }

            $file_path = $logs_dir.'/'.date("YmdH",time())."_log";
            $fp = fopen($file_path, "a+");
            fwrite($fp, $com['time_his'].' '.$com['myip']." ".$_SERVER['REQUEST_URI']." ".get_session('ses_user_idx')." ".$_SERVER['HTTP_REFERER']."\n");
            fclose($fp);
            chmod($file_path, 0777);  //changed to add the zero
        }
        //$dbcon->close();
    }

    // youtube id 추출
    function get_youtube_id($url){
        $matches = '';
        // preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $movie_url, $matches); //$matches[1]
        preg_match("/^.*((youtu.be\/)|(v\/|vi\/)|(\/u\/\w\/)|(embed\/|watch\?|ytscreeningroom\?|\/\?))\??(v(?:i?)=)?([^#\&\?]*).*/", $url, $matches); // $matches[7]

        return (is_array($matches)&& strlen($matches[7])>0) ? $matches[7] : false;
    }

    //랜덤문자열
    function get_random_string($type = '', $len = 10) {
      $lowercase = 'abcdefghijklmnopqrstuvwxyz';
      $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $numeric = '0123456789';
      $special = '`~!@#$%^&*()-_=+\|[{]};:\'",<.>/?';
      $key = '';
      $token = '';
      if ($type == '') {
          $key = $lowercase.$uppercase.$numeric;
      } else {
          if (strpos($type,'09') > -1) $key .= $numeric;
          if (strpos($type,'az') > -1) $key .= $lowercase;
          if (strpos($type,'AZ') > -1) $key .= $uppercase;
          if (strpos($type,'$') > -1) $key .= $special;
      }
      for ($i = 0; $i < $len; $i++) {
          $token .= $key[mt_rand(0, strlen($key) - 1)];
      }
      return $token;
    }


    // 사이트 점검 등록.
    function set_site_inspect($type, $msg){
        global $root_path, $com;
        // 점검공지 시작
        // 관리자 이상체크, referer 체크
        if(!is_dir($root_path."/data/inspect/")){
            @mkdir($root_path."/data/inspect/", 0777);
            chmod($root_path."/data/inspect/", 0777);
        }

        $site_file = $root_path."/data/inspect/".get_pass('site_inspect');
        if($type == 'start')
        {
            $fp = fopen($site_file, "w"); // zero length
            fwrite($fp, $type."\n");
            fwrite($fp, $msg."\n");
            fwrite($fp, '['.date("Y-m-d H:i:s",time()).'] '.$type."\n");
            fclose($fp);
            chmod($site_file, 0777);

        }
        else if($type == 'end' && is_file($site_file))
        {
            $fp = fopen($site_file, "a"); // end of
            fwrite($fp, '['.date("Y-m-d H:i:s",time()).'] '.$type."\n");
            fclose($fp);

            // copy rename
            copy($site_file, $site_file."_".date("ymd_His",time()));
            @unlink($site_file);
        }
    }

    // 사이트 점검
    function get_site_inspect(){
        global $root_path, $com;

        $site_file = $root_path."/data/inspect/".get_pass('site_inspect');
        $rows = array();
        if(is_file($site_file))
        {
            $site_contents = file_get_contents($site_file);
            $site_contents_arr = explode("\n",$site_contents);
            if(count($site_contents_arr))
            {
                $rows['type'] = $site_contents_arr[0];
                $rows['msg'] =  $site_contents_arr[1];
                list($rows['date'],$rows['time'],) = explode(' ',$site_contents_arr[2]);
                // foreach($site_contents_arr as $key=>$value){
                //  echo $key.':'.$value.'<br>';
                // }
            }

            return $rows;
        }
        else
        {
            return false;
        }
    }


    // 이미지 업데이트.
    // $fname :: 폴더명
    // $locfile :: 업데이트 로컬 파일 $_FILES['file']
    // $save_name :: 새파일명(확장자 업로드 파일에서 );
    function set_image_upload($fname, $locfile, $save_name)
    {
        global $root_path, $com, $site_conf;
        $allow_file = array("jpg", "jpeg", "png", "gif");

        // 디렉토리..
        $img_path = $root_path.'/data/'.$fname;
        if( !is_dir($img_path) )
        {
            @mkdir($img_path, 0777);
            chmod($img_path, 0777);
        }

        $tmpfiles = $locfile['tmp_name'];
        if(is_uploaded_file($tmpfiles))
        {
            $tmpfilename = strtolower($locfile['name']);
            $filevalue = explode('.',$tmpfilename);
            $filename_ext = strtolower(array_pop($filevalue));

            if( !in_array($filename_ext, $allow_file) )
            {
                // 파일 확장자
                // $ret[0] = 'notallow';
                $ret = false;
            }
            else
            {
                $fileSaveName = $save_name.'.'.$filename_ext;
                $fileSavePath = $img_path.'/'.$fileSaveName;

                // ok
                @move_uploaded_file($tmpfiles, $fileSavePath);

                // $ret[0] = 'ok';
                $ret[0] = $fileSaveName;
                $ret[1] = $fileSavePath;
            }

        }
        else
        {
            // $ret[0] = 'notlocal';
            $ret = false;
        }

        return $ret;
    }

    // 이미지 삭제
    // $fname :: 폴더명
    // $img_name :: 이미지명
    function set_image_unlink($fname, $img_name)
    {
        global $root_path;

        $img_path = $root_path.'/data/'.$fname.'/'.$img_name;
        if(is_file($img_path))
        {
            @unlink($img_path);
        }
    }


    // ip 주소의 ipv6 체크
    function is_ipv6($ip)
    {
        // $ip = getRealIpAddr();
        if (!preg_match("/^([0-9a-f\.\/:]+)$/",strtolower($ip))) {
            return false;
        }

        if (substr_count($ip,":") < 2) {
            return false;
        }

        $part = preg_split("/[:\/]/", $ip);
        foreach ($part as $i) {
            if (strlen($i) > 4) {
                return false;
            }
        }

        return true;
    }

    // db ip 정보 체크
    function get_is_iploate( $ip, $is_data=false )
    {
        $ret = false;

        $arr = array();
        $arr['_ip'] = $ip;
        $arr['_iptype'] = (is_ipv6($ip) === true ? 'ipv6':'ipv4');

        $row = call_procedure_data("get_iplocate_info", $arr);
        if(count($row) && $is_data)
        {
            $ret = $row;
        }
        else if(count($row))
        {
            $ret = true;
        }

        return $ret;
    }

    // db ip 정보 저장
    // api http://dp-ip.com 무료 하루 2,500건.
    function set_iplocate_from_dbip($ip)
    {
        global $com;

        $url = 'http://api.db-ip.com/v2/'.$com['dbip_key'];

        $agjson = @file_get_contents($url.'/'.$ip);

        if(!$agjson){
            $agjson = get_curl_post($url.'/'.$ip,'');
        }

        $row['result'] = false;
        if($agjson)
        {
            $agent = json_decode($agjson, true);
        }
        if($agent['city'])
        {
            $arr = array();
            $arr['_ip'] = $ip;
            $arr['_iptype'] = (is_ipv6($ip) === true ? 'ipv6':'ipv4');
            $arr['_contine_cd'] = $agent['continentCode'];
            $arr['_contine_nm'] = $agent['continentName'];
            $arr['_country_cd'] = $agent['countryCode'];
            $arr['_country_nm'] = $agent['countryName'];
            $arr['_state'] = $agent['stateProv'];
            $arr['_city'] = $agent['city'];

            $row = call_procedure_data("set_iplocate_save", $arr);
            if($row['result']<0)
            {
                set_error_logs('iplocate err:', insert_db_data(json_encode($arr)).$ip);
            }
        }

        return $row['result'];
    }
?>

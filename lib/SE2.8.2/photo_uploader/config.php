<?php
    $root_path = $_SERVER['DOCUMENT_ROOT'];
    require_once $root_path."/lib/common.inc";

// ---------------------------------------------------------------------------
# 이미지가 저장될 디렉토리의 전체 경로를 설정합니다.
# 끝에 슬래쉬(/)는 붙이지 않습니다.
# 주의: 이 경로의 접근 권한은 쓰기, 읽기가 가능하도록 설정해 주십시오.


define('DATA_DIR', $root_path."/data");


# 위에서 설정한 'SAVE_DIR'의 URL을 설정합니다.
# 끝에 슬래쉬(/)는 붙이지 않습니다.
define('DATA_URL', $com['url_data']."/data");

$allow_file = array("jpg", "png", "bmp", "gif");

// 임시 폴더에 저장후 save시 이동시킴. 
$use_temp = true;
define('TEMP_DIR', "temphoto");
define('REAL_DIR', "photo");

$photo_maxWidth = 700;
// ---------------------------------------------------------------------------
?>
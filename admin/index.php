<?php

	$root_path = $_SERVER['DOCUMENT_ROOT'];
	require_once $root_path."/lib/common.inc";

    if (!get_session('ses_user_idx')) {
        alert_href("You are not authorized to access that section.", "/");
    } else {
        alert_href("", "/admin/board_list.php");
    }

?>

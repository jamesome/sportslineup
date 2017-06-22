<?
    $root_path = $_SERVER['DOCUMENT_ROOT'];
    require_once $root_path."/lib/common.inc";

	$com['title'] = "";
	$com['css'] = "sub";
//	include_once("$inc_path/head.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>동영상 확인</title>
</head>

<body>
	<embed src="<?=$url?>" autostart="true" loop="true">
</body>
</html>

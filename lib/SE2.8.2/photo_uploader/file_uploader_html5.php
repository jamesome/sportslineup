<?php

	require_once "config.php";

 	$sFileInfo = '';
	$headers = array();
	 
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}

	$filename = rawurldecode($headers['file_name']);
	// $filename_ext = strtolower(array_pop(explode('.',$filename)));
	$filevalue = explode('.',$filename);
	$filename_ext = strtolower(array_pop($filevalue));
	// $allow_file = array("jpg", "png", "bmp", "gif");  // config.php

	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$filename;
	} else {
		$file = new stdClass;
		// $file->name = date("YmdHis").mt_rand().".".$filename_ext;
		$file->content = file_get_contents("php://input");

		// $fileSaveDir = '../../upload/';
		// if(!is_dir($fileSaveDir)){
		// 	mkdir($fileSaveDir, 0777);
		// }
		
		if($use_temp)
		{
			$fileSaveDir = get_file_path(DATA_DIR.'/'.TEMP_DIR.'/', $filename);
		}
		else
		{
			$fileSaveDir = get_file_path(DATA_DIR.'/'.REAL_DIR.'/', $filename);
		}

		$fileSaveName = $fileSaveDir[0];
		$fileSavePath = $fileSaveDir[1];
		$fileSaveUrl = str_replace(DATA_DIR, DATA_URL, $fileSaveDir[1]);
		
		if(file_put_contents($fileSavePath, $file->content)) 
		{
		// $fileSaveSize = filesize($fileSavePath);
			chmod($fileSavePath, 0777);
			// image resize
			list($img_width, $img_height, $type) = getimagesize($fileSavePath);
			if($img_width > $photo_maxWidth && $photo_maxWidth){ 
	            $img_height = round(($photo_maxWidth/$img_width) * $img_height);
	            $img_width = $photo_maxWidth;
	        }

			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$filename;
			// $sFileInfo .= "&sFileSize=". $fileSaveSize; 
			$sFileInfo .= "&sFileURL=".$fileSaveUrl;
			$sFileInfo .= "&sFileWidth=".$img_width;
			$sFileInfo .= "&sFileHeight=".$img_height;
		}
		
		echo $sFileInfo;
	}
?>
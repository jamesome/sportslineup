<?php

	require_once "config.php";

// default redirection
$url = 'callback.html?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	// $filename_ext = strtolower(array_pop(explode('.',$name)));
	$filevalue = explode('.',$name);
	$filename_ext = strtolower(array_pop($filevalue));
	// $allow_file = array("jpg", "png", "bmp", "gif"); // config.php
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		// $fileSaveDir = '../../upload/';
		
		// if(!is_dir($fileSaveDir)){
		// 	mkdir($fileSaveDir, 0777);
		// }
		if($use_temp)
		{
			$fileSaveDir = get_file_path(DATA_DIR.'/'.TEMP_DIR.'/', $name);
		}
		else
		{
			$fileSaveDir = get_file_path(DATA_DIR.'/'.REAL_DIR.'/', $name);
		}
		// $fileSavePath = $fileSaveDir.urlencode($_FILES['Filedata']['name']);
		$fileSaveName = $fileSaveDir[0];
		$fileSavePath = $fileSaveDir[1];
		$fileSaveUrl = str_replace(DATA_DIR, DATA_URL, $fileSaveDir[1]);
		
		@move_uploaded_file($tmp_name, $fileSavePath);		
        chmod($fileSavePath, 0777);
        
		// $fileSaveSize = filesize($fileSavePath);
		// image resize
		list($img_width, $img_height, $type) = getimagesize($fileSavePath);
		if($img_width > $photo_maxWidth && $photo_maxWidth){ 
            $img_height = round(($photo_maxWidth/$img_width) * $img_height);
            $img_width = $photo_maxWidth;
        }
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($name));
		// $url .= "&sFileSize=". $fileSaveSize; 
		$url .= "&sFileURL=".$fileSaveUrl;
		$url .= "&sFileWidth=".$img_width;
		$url .= "&sFileHeight=".$img_height;
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>
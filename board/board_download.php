<?php
    $real_name = $_GET["real_name"];
    $file_name = $_GET["file_name"];
    $file_type = $_GET["file_type"];
    $file_path = "./data/".$real_name;

    //$_SERVER['HTTP_USER_AGENT'] 웹 브라우저의 정보를 가져온다
    //preg_match(data, target) target 에서 data 정보를 찾는다 

    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || 
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && 
            strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

    //IE인경우 한글파일명이 깨지는 경우를 방지하기 위한 코드 
    if( $ie ){
         $file_name = iconv('utf-8', 'euc-kr', $file_name);
    }

    if( file_exists($file_path) )
    { 
		$fp = fopen($file_path,"rb"); 
		Header("Content-type: application/x-msdownload"); 
        Header("Content-Length: ".filesize($file_path));     
        Header("Content-Disposition: attachment; filename=".$file_name);   
        Header("Content-Transfer-Encoding: binary"); 
		Header("Content-Description: File Transfer"); 
        Header("Expires: 0");       
    } 
	
    if(!fpassthru($fp)) 
		fclose($fp); 
?>

  

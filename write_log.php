<?php

function createLog($query)
{
    $sess_id = session_id();
    if(!isset($sess_id))
    {
        session_start();  // 로그인할 때 세션 선언
        $sess_id = session_id();
    } 
    
    if(!isset($query))
    {
        $query = "NULL";
    }

    $searchTime = date("Y-m-d H:i:s");
    // Output the search query and search time

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $siteUrl = $protocol . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');
    
    $ip = $_SERVER['REMOTE_ADDR'];

    $data = array(
        // 헤더 데이터
        //array("id" ,"query", "time", "site", "ip"),
        // CSV데이터
        array($sess_id, $query, $searchTime, $siteUrl, $ip), 
    );
    // 파일 작성
    $outFile = fopen("log_data.csv", "a+");
    foreach ($data as $fields) 
    {
    // 파일 데이터 작성
        fputcsv($outFile, $fields);
    }
    session_destroy();
}


?>
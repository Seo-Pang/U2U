<?php
function addLogCSV($page) {
    //$data = array("세션 id", '페이지', '시간');
    $file = './U2ULog.csv';
    $username = $_SESSION['UserName'];
    $log_id = session_id();
    $gettime = date("Y-m-d H:i:s");

    if(!$log_id)
    {
        $log_id = $_SERVER['REMOTE_ADDR'];
    }
    if(isset($username))
    {
        $log_id = $username;
    }

    $data = array($log_id, $page, $gettime);
    $handle = fopen($file, 'a+'); // 'a' 모드는 파일을 추가 모드로 열기
    // 데이터 추가
    fputcsv($handle, $data);
    fclose($handle);
}

?>
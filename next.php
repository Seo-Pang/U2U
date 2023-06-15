<?php 

    session_start();
	header('Content-Type: text/html; charset=UTF-8');
    include 'UserLoginCheck.php';

    if ((isset($_SESSION['UserID']) && isset($_SESSION['UserName']))) 
    {
        $user = UserFind($_SESSION["UserID"]);
        echo $user["name"]." 로그인에 성공했습니다!"."<br>";
        echo "ID:   ".$user["id"]."<br>";
        echo "PW:   ".$user["password"]."<br>";
        echo "Email:".$user["email"]."<br>";

    } 
    else 
    {
        echo "유효하지 않은 사용자 이름 또는 비밀번호입니다.";
    }
    
?>
<?php
	header('Content-Type: text/html; charset=UTF-8');
	session_start();

	if(isset($_SESSION['UserName'])){
		$username = $_SESSION['UserName'];
        echo ("<script>location.replace('add.php');</script>");
    }
    else{
        echo "<script>alert('로그인 후 이용이 가능합니다..');</script>";
        echo ("<script>location.replace('index.php');</script>");
    }
?>
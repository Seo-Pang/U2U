<!DOCTYPE html>
<?php 
	header('Content-Type: text/html; charset=UTF-8');
    session_start();
    include 'UserLoginCheck.php';
?>
    
    
<html>
<head>
<link href="siteDesign.css" rel="stylesheet">
    <title>로그인</title>
</head>
<body>

<div class="centered-image">
                <a href="index.php">
                        <img src="/image/u2u.png" alt="이미지", style="width: 404px;">
                </a>
	</div>
<div class="centered-category">

    <h2>로그인</h2>
    <form method="post" action="./loginSQL.php">
        <label for="username">사용자 이름:</label>
        <input class="search-input" type="text" name="UserID" id="UserID" required><br><br>
        <label for="password">비밀번호: </label>
        <input class="search-input" type="password" name="UserPW" id="UserPW" required><br><br>
        <input class="search-button" type="submit" value="로그인">
    </form>
</div>
</body>
</html>

<!DOCTYPE html>
<?php 
	header('Content-Type: text/html; charset=UTF-8');
    session_start();
    include 'UserLoginCheck.php';
?>
    
    
<html>
<head>
    <title>로그인</title>
</head>
<body>
    <h2>로그인</h2>
    <form method="post" action="./loginSQL.php">
        <label for="username">사용자 이름:</label>
        <input type="text" name="UserID" id="UserID" required><br><br>
        <label for="password">비밀번호:</label>
        <input type="password" name="UserPW" id="UserPW" required><br><br>
        <input type="submit" value="로그인">
    </form>
</body>
</html>
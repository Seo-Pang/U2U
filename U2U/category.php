<?php 
	header('Content-Type: text/html; charset=UTF-8');
	$message = "";
?>

<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Dropdown Example</title>
    <style>
        select 
        {
            width: 120px;
            height: 30px;
        }
        input[type="submit"]
        {
            width: 120px;
            height: 30px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // 첫 번째 드롭다운 메뉴가 변경되었을 때의 이벤트 처리
        function onChangeFirstDropdown() {
            // 선택된 항목의 값 가져오기
            var firstValue = $('#firstDropdown').val();

            // AJAX를 사용하여 서버로 데이터 전송
            $.ajax({
                url: 'get_second_dropdown.php', // 두 번째 드롭다운 항목을 동적으로 생성하는 PHP 파일 경로
                type: 'POST',
                data: {firstValue: firstValue},
                success: function(response) 
                {
                    // 서버로부터 받은 데이터로 두 번째 드롭다운 메뉴 갱신
                    $('#secondDropdown').html(response);
                }
            });
        }
    </script>
</head>
<body>
    <a href="mainpage.php">
        <img src="/image/u2u.png" alt="Image" width="250" height="150">
    </a>
    <h1>U2U Game Select</h1>

    <form method="post" action="posts.php">
        <select id="firstDropdown" onchange="onChangeFirstDropdown()">
        <option value=""><게임선택></option>
        <?php
        include("./SQLconstants.php");
        $conn = new mysqli($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database);

            // 연결 확인
            if ($conn->connect_error) 
            {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            // 쿼리 실행하여 데이터 가져오기
            $sql = "SELECT game_id, game_name FROM game";
            $result = $conn->query($sql);

            // 드롭다운 옵션 생성
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['game_id'] . "'>" . $row['game_name'] . "</option>";
                }
            }

            // 데이터베이스 연결 닫기
            $conn->close();
        ?>

        <!--<option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>-->
        </select>
    
    <select id="secondDropdown">
        <!-- 초기에는 두 번째 드롭다운 메뉴가 비어있음 -->
    </select>
    <input type="submit" value="Submit">
    </form>
    </br>
</body>
</html>


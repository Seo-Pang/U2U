<!DOCTYPE html>
<html>
    
<head>
    <title>U2U : User Item Platform</title>
    <link href="siteDesign.css" rel="stylesheet">
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
<div class="centered-image">
        <a href="index.php">
            <img src="/image/u2u.png" alt="이미지", style="width: 404px;">
        </a>
    </div>

<div class="centered-category">
<form method="GET" action="posts.php">
        <select class="dropdown", id="firstDropdown", onchange="onChangeFirstDropdown()">
        <option value="">--게임 이름을 선택해주세요--</option>
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
    
    <select class="dropdown" id="secondDropdown" name="server" >
    <option value="">--서버 이름을 선택해주세요--</option>
    </br>
    <div class="centered-search">
        <input class="search-input" type="text" name="title" placeholder="게시글 제목을 입력하세요.">
        <input class="search-button" type="submit" value="검색">
    </div>
</form>
    
 </div>
</body>
</html>
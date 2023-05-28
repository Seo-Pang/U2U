<!DOCTYPE html>
<html>
<head>
    <title>U2U</title>
<style>
        /* 이미지를 상단 가운데에 배치하기 위한 CSS */
        .centered-image {
            text-align: center;
            margin-top: 50px;
	}
	.centered-search{
	    text-align: center;
            margin-top: 60px;
	}
	.search-input {
            width: 800px; /* 검색창의 너비 조정 */
            padding: 5px;
            font-size: 16px;
	}
	.search-button {
	    padding: 5px 10px;
            font-size: 16px;
	}
	.centered-category{
            text-align: center;
            margin-top: 70px;
	}
	.dropdown {
            width: 405px; /* 드롭다운의 너비 조정 */
            padding: 10px;
            font-size: 16px;
	}
	.circle-container {
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            top: 400px;
            text-align: center;
        }
	.circle {
	    margin-top: 80px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: gray;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .circle a {
            text-decoration: none;
            color: white;
            font-size: 24px;
            font-weight: bold;
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
<div class="centered-image">
	<?php
        // 이미지 파일 경로
        $imagePath = "/image/u2u.png";
        ?>

        <a href="mainpage.php">
            <img src="<?php echo $imagePath; ?>" alt="이미지">
        </a>
    </div>


<div class="centered-search">

<form method="GET" action="posts.php">
        <input class="search-input" type="text" name="query" placeholder="게시글 제목을 입력하세요.">
        <input class="search-button" type="submit" value="검색">
    </form>
</div>

<div class="centered-category">
<form method="post" action="posts.php">
        <select class="dropdown" id="firstDropdown" onchange="onChangeFirstDropdown()">
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
    
    <select class="dropdown" id="secondDropdown">

</select>

    <input class="search-button" type="submit" value="검색">
    </form>
    </br>
 </div>

<div class="circle-container">
<div class="circle">
        <?php
        $text = "로그인";//미구현
        $url = "https://www.naver.com/"; // 로그인 누르면 이동하는 위치
        echo "<a href='$url'>$text</a>";
        ?>
    </div>
</div>


</body>
</html>
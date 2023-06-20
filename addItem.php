<!DOCTYPE html>
<html>
	<title>U2U - 아이템 등록</title>
	<link href = "sitestyle.css" rel = "stylesheet">
	<style>
		.write-item{
		    width: 100%;
		    height: 40px;
		    height: auto;
		    margin: 0px auto;
		    margin-top: 40px;
		    text-align: center;
		}

		.write-image{
		    width: 100%;
		    height: 40px;
		    height: auto;
		    margin: 0px auto;
		    margin-top: 40px;
		    text-align: center;
		}
	</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		function onChangeFirstDropdown() 
		{
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

		function showMessage( message )
		{
			if ( ( message != null ) && ( message != "" ) && ( message.substring( 0, 3 ) == " * " )  ) 
			{
				alert( message );
			}
		}

		// 지정한 url로 이동하는 함수 
		function move( url )	
 		{
			document.formm.action = url;
			document.formm.submit();
		}

	</script>
</head>
<body>
	<div class = "header">
		<div class = "header-right-items">
			<div class = "header-item"> 로그인 </div>
		</div>
	</div>
	<div class = "nav">
		<div class = "nav-first">
			<div class = "logo">
				<a href = "index.php">
				<img src = "/image/u2u.png" style = "width:202px; height:126px;">
				</a>
			</div>
		</div>
		<div class = "nav-second">
			<div class = "page-info" style = "float: left; width: 800px;'">아이템 추가</div>
		</div>
	</div>
	<div class = "write-background">
		<div class = "write-category-select" style = "min-height: 40px;">
			<div class = "siteText" style = "margin-right: 40px;">카테고리</div>
			<div class = "centered-category">
				<form method = "post" action = "posts.php">
					<select class = "dropdown" id = "firstDropdown" onchange = "onChangeFirstDropdown()"
					style = "width: 660px; float:left;">
							<?php
								
					    		include("./SQLconstants.php");
					    		$conn = new mysqli($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database);

					    		if($conn -> connect_error)
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
		            </select>
			    </form>
			</div>
		</div>
		<form name = "formm" method = "post" action = "./addItemSQL.php">
			<div class = "write-item">
				<div class = "siteText">아이템 이름</div>
				<input class = "item-name" type = "text" name = "name" placeholder = "아이템 이름을 입력하세요...">
			</div>
			<div class = "write-image">
				<div class = "siteText">이미지 링크</div>
				<input class = "item-image" type = "text" name = "image" placeholder = "이미지 링크를 입력하세요...">
			</div>
			<div class = "endWrite">
				<div class = "endWrite-right-items">
					<button class = "sumbit-btn" onClick = "javascript:document.formm.submit();">완 료</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
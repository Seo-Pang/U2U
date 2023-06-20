<?php
include("./write_log.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>U2U - 게시글 작성</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
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
	<style>

		.nameText{
		    float: left;
		    width: 660px;
		    height: 40px;
		    text-align: left;
		    line-height: 40px;
		    margin-left: 20px;
		}
	</style>
</head>
<link href="sitestyle.css" rel="stylesheet">
<link href="siteDesign.css" rel="stylesheet">
<body>
	<div class="black-bar">
	    <?php
	        session_start();
	        if(!isset($_SESSION['UserName'])){
	            echo "<a class = ".'login-link'." href = ".'login.php'."> 로그인</a>";
	        }
	        else{
	            $username = $_SESSION['UserName'];
	            echo "<a class = ".'login-link'." href = ".'logout.php'."> ".$username."님</a>";
	        }
	    ?>
	</div>
	<div class = "nav">
		<div class = "nav-first">
			<div class = "logo"> 
				<a href = "index.php">
				<img src = "/image/u2u.png" style = "width: 202px; height: 126px;">
				</a>
			</div>
			<div class = "find-item"> </div>
		</div>
		<div class = "nav-second">
			<div class = "page-info" style = "float: left; width: 800px;">게시글 작성</div>
		</div>
	</div>
	<div class = "write-background">
		<div class = "write-category-select" style = "min-height:40px;">
			<div class = "siteText" style = "margin-right:40px;">카테고리</div>
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
	    <form name = "formm" method = "post" action = "./addSQL.php">
		    <div class = "write-userid" style = "height: 40px;">
		    	<div class = "siteText">작성자 ID</div>
		    	<?php
		    		echo "<div class = ".'nameText'." name = ".'user_id'.">".$username."</div>";
		    	?>
		    </div>
		    <div class = "write-title">
		    	<div class = "siteText">제 목</div>
		    	<input class = "post-title" type = "text" name = "title" placeholder = "게시글 제목을 입력하세요...">
		    </div>
		    <div class = "write-sellcost">
		    	<div class = "siteText">판매가격</div>
		    	<input class = "post-sellcost" type = "int" name = "sell_cost" placeholder = "판매 가격을 입력하세요...">
		    </div>
		    <div class = "write-itemoption">
		    	<div class = "siteText">아이템설명</div>
		    	<input class = "post-itemoption" type = "text" name = "item_option" placeholder = "아이템 설명을 입력하세요...">
		    </div>
		    <div class = "write-content">
		    	<div class = "siteText">상세 내용</div>
		    	<input class = "post-content" type = "text" name = "content" placeholder = "상세 내용을 입력하세요..."
		    	style = "height: 400px;">
		    </div>
		    <div class = "select-item" style = "min-height:40px;">
		    	<div class = "siteText" style = "margin-right:40px;">아이템 선택</div>
		    	<select class = "dropdown" id = "gameDropdown" name = "item_id"
		    	style = "width: 540px; float: left;">
		    	<?php
		    		include("./SQLconstants.php");
		    		$conn = new mysqli($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database);

		    		if($conn -> connect_error)
					{
						die("데이터베이스 연결 실패: " . $conn->connect_error);
					}

					// 쿼리 실행하여 데이터 가져오기
		            $sql = "SELECT item_id, name FROM item";
		            $result = $conn->query($sql);

		            // 드롭다운 옵션 생성
		            if ($result->num_rows > 0) {
		                while ($row = $result->fetch_assoc()) {
		                    echo "<option value='" . $row['item_id'] . "'>" . $row['name'] . "</option>";
		                }
		            }

		            // 데이터베이스 연결 닫기
		            $conn->close();
		            
				?>
				</select>
				<button class = "addItem" style = "float:left;" onClick = "javascript:move('./addItem.php')">아이템 추가</button>
			</div>
			
			<!--서버 임시 추가-->
			<div class = "select-item" style = "min-height:40px;">
		    	<div class = "siteText" style = "margin-right:40px;">서버 선택</div>
		    	<select class = "dropdown" id = "gameDropdown" name = "server_id"
		    	style = "width: 540px; float: left;">
		    	<?php
		    		include("./SQLconstants.php");
		    		$conn = new mysqli($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database);

		    		if($conn -> connect_error)
					{
						die("데이터베이스 연결 실패: " . $conn->connect_error);
					}

					// 쿼리 실행하여 데이터 가져오기
		            $sql = "SELECT server_id, server_name FROM server";
		            $result = $conn->query($sql);

		            // 드롭다운 옵션 생성
		            if ($result->num_rows > 0) {
		                while ($row = $result->fetch_assoc()) {
		                    echo "<option value='" . $row['server_id'] . "'>" . $row['server_name'] . "</option>";
		                }
		            }

		            // 데이터베이스 연결 닫기
		            $conn->close();
		            
				?>
				</select>
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

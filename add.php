<!DOCTYPE html>
<html>
	<title>U2U - 게시글 작성</title>
	<style>

		a{
			text-decoration: none;
			color: white;
		}

		a:visited{
			text-decoration: none;
			color: white;
		}

		.header{
			height: 40px;
			display: flex;
			align-items: center;
			padding-right: 20px;
		}

		.header-right-items{
			display: flex;
			margin-left: auto;
		}

		.header-item{
			margin-left: 10px;
		}

		.nav-background{
			width: 100%;
			height: auto;
			overflow: auto;
			margin: 0px auto;
		}

		.nav{
			width: 800px;
			margin: 0px auto;
		}

		.nav-first{
			text-align: center;
			margin-top: 40px;
			height: 126px;
		}

		.nav-second{
			text-align: center;
			height: 40px;
			margin-top: 40px;
		}

		.page-info{
			line-height: 40px;
			width: 500px;
			height: 40px;
			text-align: center;
			background-color: black;
			color: white;
		}

		.category-select{
			width: 80px;
			height: 40px;
			background-color: black;
			color: white;
			margin-left: 20px;
		}

		.reboot-site{
			width: 80px;
			height: 40px;
			background-color: black;
			color: white;
			margin-left: 20px;
		}

		.write-site{
			width: 80px;
			height: 40px;
			background-color: black;
			color: white;
			margin-left: 20px;
		}

		.write-background{
			width: 820px;
			height: auto;
			overflow: auto;
			margin: 0px auto;
		}

		.write-category-select{
			width: 100%;
			height: 40px;
			margin: 0px auto;
			margin-top: 40px;
			text-align: center;
		}

		.write-userid{
			width: 100%;
			height: 40px;
			height: auto;
			margin: 0px auto;
			margin-top: 40px;
			text-align: center;
		}

		.write-title{
			width: 100%;
			height: 40px;
			height: auto;
			margin: 0px auto;
			margin-top: 40px;
			text-align: center;
		}

		.write-sellcost{
			width: 100%;
			height: 40px;
			height: auto;
			margin: 0px auto;
			margin-top: 40px;
			text-align: center;
		}

		.write-itemoption{
			width: 100%;
			height: 40px;
			height: auto;
			margin: 0px auto;
			margin-top: 40px;
			text-align: center;
		}

		.write-content{
			width: 100%;
			height: 40px;
			height: auto;
			margin: 0px auto;
			margin-top: 40px;
			text-align: center;
		}

		.select-item{
			width: 100%;
			height: 40px;
			margin: 0px auto;
			margin-top: 40px;
			text-align: center;
			margin-bottom: 40px;
		}

		.siteText{
			float: left;
			width: 100px;
			height: 40px;
			text-align: center;
			margin-right: 20px;
			line-height: 40px;
		}

		.addItem{
			width: 100px;
			height: 40px;
			background-color: black;
			color: white;
			margin-left: 20px;
		}

		input{
			height: 40px;
			width: 660px;
		}

		select{
			height: 40px;
		}

		.endWrite{
			width: 100%;
			height: 40px;
			margin: 0px auto;
			margin-top: 40px;
			text-align: center;
		}

		.header-right-items{
			display: flex;
			margin-left: auto;
		}

		.sumbit-btn{
			width: 120px;
			height: 40px;
			background-color: black;
			color: white;
			margin-left: 20px;
		}

	</style>
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
</head>
<body>
	<div class = "header">
		<div class = "header-right-items">
			<div class = "header-item">사용자님, 반갑습니다.</div>
			<div class = "header-item"><a href = # style = "color: black">로그아웃</a></div>
		</div>
	</div>
	<div class = "nav">
		<div class = "nav-first">
			<div class = "logo"> 
				<a href = "mainpage.php">
				<img src = "image/u2u.png" style = "width: 202px; height: 126px;">
				</a>
			</div>
			<div class = "find-item"> </div>
		</div>
		<div class = "nav-second">
			<div class = "page-info" style = "float: left;">게시글 작성</div>
			<button class = "category-select" style = "float: left;">카테고리</button>
			<a href = "add.php"><button class = "reboot-site" style = "float: left;">새로고침</button></a>
			<button class = "write-site" style = "float: left;">글쓰기</button>
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
		    <div class = "write-userid">
		    	<div class = "siteText">작성자 ID</div>
		    	<input class = "post-id" type = "text" name = "user_id" placeholder = "작성자 아이디를 입력하세요...">
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
			<div class = "endWrite">
				<div class = "endWrite-right-items">
					<button class = "sumbit-btn" onClick = "javascript:document.formm.submit();">완 료</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>

<?php 
	header('Content-Type: text/html; charset=UTF-8');
	$message = "";
    $prePage = $_SERVER["HTTP_REFERER"];//이전 페이지 주소
?>

<!DOCTYPE html>
<html>

<head>     
<title>게시글</title>
   
</head>     
<link href="sitestyle.css" rel="stylesheet">
    <script langauge = "javascript">
        function purchase()//테스트용 함수
        {
            alert("성공적으로 구매를 요청했습니다.");
        }
    </script>

<body>
    <div class = "header">
		<div class = "header-right-items">
			<div class = "header-item">사용자님,반갑습니다</div>
			<div class = "header-item"><a href = # style = "color: black">로그아웃</a></div>
		</div>

	</div>

    <div class = "nav">
		<div class = "nav-first">
			<div class = "logo"> 
				<a href = "index.php">
				<img src = "/image/u2u.png" style = "width: 202px; height: 126px;">
				</a>
			</div>
		</div>
        
	</div>
    <div class = "page-info" style = "float: left;">게시글 상세 정보</div>
    <div>
    <?php
    	// MySQL 드라이버 연결 
    	include("./SQLconstants.php"); 
	    $conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

        // MySQL 검색 실행 및 결과 출력
	    $query = "select post.*, item.* FROM post LEFT OUTER JOIN item ON
            post.item_id = item.item_id where post_id = ".$_GET['idx'];
        $result = mysqli_query( $conn, $query );
        while( $row = mysqli_fetch_array( $result ) )
        {
            echo "<BR>";
            echo "<BR>게시글 번호 : ".$row['post_id'];
            echo "<BR>게시글 제목 : ".$row['title'];
            echo "<BR>작성자 : ".$row['user_id'];
            echo "<BR>아이템 : ".$row['name'];
            echo "<BR><img src = '".$row['image']."' height='280' width='180'>";
            echo "<BR>가격 : ".$row['sell_cost'];
            echo "<BR>아이템 옵션 : ".$row['item_option'];
            echo "<BR>내용 : ".$row['content'];

            //거래 상태에 따른 텍스트와 게시글 행 배경색 설정 --->적용 못했음
            switch($row['transaction_status'])
            {
                case 1:
                    $transaction_status_text = "거래 가능";
                    $transaction_status_color = "#00FF40";
                    break;
                case 2:
                    $transaction_status_text = "거래중";
                    $transaction_status_color = "#F7D358";
                    break;
                case 3:
                    $transaction_status_text = "거래 완료";
                    $transaction_status_color = "#FA5858";
                    break;
                default:
                    $transaction_status_text = "미확인";
                    $transaction_status_color = "#A4A4A4";
            }
            echo "<BR>거래 상태: ".$transaction_status_text;
        }
        	// MySQL 드라이버 연결 해제
	mysqli_free_result( $result );
	mysqli_close( $conn );
    ?>
    </div>
    <?php
        //버튼을 눌렀을 때 이벤트 처리 함수는 구현 못함
        ?>
    <div class = "nav-second">
            <form>
            <input class = "category-select" style = "float: left;" type ="button" value ="구매" onClick = "purchase();">
            </form>
			<a href = <?php echo $prePage;?>><button class = "reboot-site" style = "float: left;">뒤로가기</button></a>
            <input class = "write-site" style = "float: left;" type ="button" value = "삭제" onClick = "javascript:document.formm.submit();">


		</div>
    </body>
</html>
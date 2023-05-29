<?php 
	header('Content-Type: text/html; charset=UTF-8');
	$message = "";
?>

<!DOCTYPE html>
<html>

<head>     
<title>u2u - 게시글 목록</title>
		<script language="javascript">
			// 전달받은 메시지 출력
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

            function move_get()
            {


                // URL에서 _GET 변수 가져오기
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);

                // 변수 추출
                const serverVariable = urlParams.get('server');
                // 현재 게임을 바꾸고 나중에 서버로 해야함

                const title = document.getElementById('title').value;

                // 두 번째 페이지의 URL에 변수 추가
                const nextPageUrl = window.location.pathname+ '?server='+ encodeURIComponent(serverVariable) +'&title=' + title;

                // 다음 페이지로 이동
                window.location.href = nextPageUrl;
            }
        
        
</script>

<?php
    $server_id = $_GET['server'];
?>


</head>

<body onLoad="showMessage( '<?php echo $_POST['message'];?>' );" >
    <a href="index.php">
        <img src="/image/u2u.png" alt="Image" width="250" height="150">
    </a>
		<!-- 화면구성 -->
		<BR> 
		<form name="formm" method="GET" action="posts.php">				
			&nbsp; &nbsp; &nbsp; 
			게시글 제목 : <INPUT TYPE="text" id='title' SIZE="60"> 
			<INPUT TYPE = "button" value = "검색" onClick="javascript:move_get(title);">
            <INPUT TYPE = "button" value = "글쓰기" onClick="javascript:move( './add.php' );">
		</form>  
		 &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;
    
    <?php
    
    // 드롭다운에서 선택된 값 확인
    if (isset($server_id )) 
    {
        
        //$selectedOption = $_GET['firstDropdown'];
        // 선택된 값에 대한 작업 수행
        // ...
        // MySQL 드라이버 연결 
        //echo "Selected option: " . $selectedOption;
    }
    include("./SQLconstants.php");

    
    $conn = mysqli_connect($mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database) or die("Can't access DB");

        // 전달 받은 메시지 확인
        $message = $_GET['title'];
        $message = ((($message == null) || ($message == "")) ? "_%" : $message);

        // MySQL 검색 실행 및 결과 출력
        
        $query = "select post.*, item.* FROM post LEFT OUTER JOIN item ON
        post.item_id = item.item_id where post.title like '%" . $message . "%' 
        and post.server_id LIKE ".$server_id;
    

        

        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) 
        {
            /*SELECT post.*, item.* FROM post LEFT OUTER JOIN item ON post.item_id =item.item_id*/
            echo "<BR>";
            echo "=========================================================";
            echo "<BR>[ 제목 ]: " . $row['title'];
            echo "<BR>[ 작성자 ]: " . $row['user_id'];
            echo "<BR>[ 아이템 ]: " . $row['name'];
            echo "<BR><img src = '" . $row['image'] . "' height='280' width='180'>";
            echo "<BR>[ 가격 ]: " . $row['sell_cost']. " 원";
            echo "<BR>[ 아이템 설명 ]: " . $row['item_option'];
            echo "<BR>[ 상세 내용 ]: " .$row['content'];
            echo "<BR>";
            echo "=========================================================";   
            echo "<BR>";
        }

        // MySQL 드라이버 연결 해제
        mysqli_free_result($result);
        mysqli_close($conn);
    ?>

</body>

</html>
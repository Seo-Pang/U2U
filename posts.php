<?php 
	header('Content-Type: text/html; charset=UTF-8');
	$message = "";
    include("./writeLog.php");
    addLogCSV("posts");
?>

<!DOCTYPE html>
<html>

<head>     
    <style>
        tr{
            border-style : solid;
        }
        /*
        a:link {
          color : black;
          text-decoration: none;
        }
        a:visited {
          color : purple;
          text-decoration: none;
        }
        a:hover {
          color : gray;
          text-decoration: underline;
        }
        a:active {
          color : green;
          text-decoration: none;
        }
        */
    </style>
<title>u2u - 게시글 목록</title>
<link href="siteDesign.css" rel="stylesheet">
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
    $game_id = $_GET['game'];
    $title = $_GET['title'];
?>


</head>

<body onLoad="showMessage( '<?php echo $_POST['message'];?>' );" >
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

<div class="centered-menu-posts">
    <a href="index.php">
        <img src="/image/u2u.png" alt="Image" width="250" height="150">
    </a>
		<!-- 화면구성 -->
		 
		<form name="formm" method="GET" action="posts.php">				 
			<INPUT class="search-input-posts" TYPE="text" id='title' SIZE="60"> 
			<INPUT class="search-button-posts" type = "button" value = "검색" onClick="javascript:move_get(title);">
            		<INPUT class="search-button-posts" TYPE = "button" value = "글쓰기" onClick="javascript:move( './checkLogin.php' );">
		</form>
</div>
<div class="centered-menu-posts">

<table>

    <thead>
	<tr class="black-shape-post">
            <th width="70">번호</th>
            <th width="180">이미지</th>
            <th width="300">제목</th>
            <th width="220">작성자</th>
            <th width="200">아이템</th>
            <th width="100">가격</th>
            <th width="100">서버</th>
            <th width="100">거래 상태</th>
	</tr>
	</thead>
</table>
</div>
<div>
    <tbody>

        <?php
       // 드롭다운에서 선택된 값 확인

                include("./SQLconstants.php");
                 $conn = mysqli_connect($mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database) or die("Can't access DB");
               // 전달 받은 메시지 확인
                     $message = $_GET['title'];
                     $message = ((($message == null) || ($message == "")) ? "_%" : $message);
        if(isset($server_id))
        {
            
            $query = "select server_name FROM server WHERE server_id = ".$server_id;
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result);
            $server_name = $row['server_name'];
           
            $query = "select post.*, item.* FROM post LEFT OUTER JOIN item ON
                      post.item_id = item.item_id where post.title like '%" . $message . "%' 
                      and post.server_id LIKE ".$server_id." ORDER BY transaction_status ASC, post_id ASC";
        }
       else
       {    //서버 선택 안했을 경우 쿼리문
            $query = "select post.*, item.* FROM post LEFT OUTER JOIN item ON
                  post.item_id = item.item_id where post.title like '%" . $message . "%' 
                  and item.game_id =".$game_id." ORDER BY transaction_status ASC, post_id ASC";

       }
            $result = mysqli_query($conn, $query);
    
            while ($row = mysqli_fetch_array($result)) 
            {
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
    
           ?>
    <a href="postinfo.php?idx=<?php echo $row['post_id'];?>" class ="textlink" style = "color: black; text-decoration: none">
	<div class="centered-menu-posts">
	<table>
            <tr>
                <td width = "70"><?php echo $row['post_id'];?></td>
                <td width = "180"><a href="postinfo.php?idx=<?php echo $row['post_id'];?>"><?php echo "<img src='" . $row['image'] . "' height='100' width='100'>";?></a></td>
                <td width = "300"><?php echo $row['title'];?></td>
                <td width = "220"><?php echo $row['user_id'];?></td>
                <td width = "200"><?php echo $row['name'];?></td>
                <td width = "100"><?php echo $row['sell_cost']."원";?></td>
                <td width = "100">
                    <?php 
                        if(isset($server_id)) echo $server_name;
                        else echo $row['server_id'];
                    ?></td>
                <td width = "100"><?php echo $transaction_status_text;?></td>
                <br>
                </a></tr>
	</table>
	</div>
	<div class="centered-menu-posts"><div class="gray-bar"></div></div>
        <?php } ?>
    </tbody >
</div>
</body>
<?php
        // MySQL 드라이버 연결 해제
        mysqli_free_result($result);
        mysqli_close($conn);
?>
</html>

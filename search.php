<?php 
	header('Content-Type: text/html; charset=UTF-8');
	$message = "";
?>
<html>
	<HEAD>      
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
		</script>
	</HEAD>
<body onLoad="showMessage( '<?php echo $_POST['message'];?>' );" >
		<!-- 화면구성 -->
		<BR> 
		<form name = "formm" method = "post">				
			&nbsp; &nbsp; &nbsp; 
			게시글 제목 : <INPUT TYPE="text" NAME="message" SIZE="60"> 
			<INPUT TYPE = "button" value = "검색" onClick="javascript:move( './search.php' );">
		</form>  
		 &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; 
		<INPUT TYPE = "button" value = "새 게시글 추가" onClick="javascript:move( './add.php' );">	
		&nbsp; &nbsp; 
		<INPUT TYPE = "button" value = "게시글 삭제" onClick="javascript:move( './delete.php' );">	
		&nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; 

		<BR> <BR> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<BR> <BR>  
<?php 
	// MySQL 드라이버 연결 
	include("./SQLconstants.php"); 
	$conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

	// 전달 받은 메시지 확인
	$message =  $_POST['message'];
	$message = ( ( ( $message == null ) || ( $message == "" ) ) ? "_%" : $message );

	// MySQL 검색 실행 및 결과 출력
	$query = "select post.*, item.* FROM post LEFT OUTER JOIN item ON
		post.item_id = item.item_id where title like '%".$message."%';";
	$result = mysqli_query( $conn, $query );
	while( $row = mysqli_fetch_array( $result ) )
	{
		/*SELECT post.*, item.* FROM post LEFT OUTER JOIN item ON
post.item_id =item.item_id*/

		echo "<BR>게시글 제목 : ".$row['title'];
		echo "<BR>작성 회원 : ".$row['user_id'];
		echo "<BR>아이템 이름 : ".$row['name'];
		echo "<BR><img src = '".$row['image']."' height='280' width='180'>";
		echo "<BR>판매금액 : ".$row['sell_cost'];
		echo "<BR>상세 설명 : ".$row['item_option'];
		echo "<BR>" ;
	}

	// MySQL 드라이버 연결 해제
	mysqli_free_result( $result );
	mysqli_close( $conn );
?>
</body>
</html> 
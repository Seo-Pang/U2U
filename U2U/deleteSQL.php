<?php 
	header('Content-Type: text/html; charset=UTF-8');
	$id = $_GET['id'];

	// MySQL 드라이버 연결 
	include("./SQLconstants.php"); 
	$conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

	// MySQL 책 삭제 실행 	
	$query = "delete from post where post_id = '".$id."';";
	$result = mysqli_query( $conn, $query );
	if( $result ) 
	{	
		$message = "ID ".$id."인 게시글을 삭제하였습니다."; 
	} 
	else 
	{
		$message = "ID ".$message."인 게시글을 찾을 수 없습니다. 삭제시 게시글 제목이 아니고 게시글 ID를 입력해주세요."; 
	} 

	// MySQL 드라이버 연결 해제
	mysqli_free_result( $result );
	mysqli_close( $conn );
?>

<form name = "frm" method = "post" action = "./index.php" >
	<input type = 'hidden' name = 'message' value = ' * <?php echo str_replace("'", "", $message);?>' >
</form>
<script language="javascript">
	document.frm.submit();
</script>


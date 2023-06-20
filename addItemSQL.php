<?php 
	header('Content-Type: text/html; charset=UTF-8');
	include("./SQLconstants.php");

	$game_name = $_POST['game_name'];
	$name = $_POST['name'];
	$image = $_POST['image'];
	$message = "";

	// MySQL 드라이버 연결 
	$conn = mysqli_connect( $mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database ) or die( "Can't access DB" );
	//게임 이름에 따른 게임 id 가져오기
	$query = "SELECT game_id FROM game WHERE game_name = '".$game_name."';";
	$data = mysqli_query( $conn, $query );
	$game_id = mysqli_num_rows($data);
	$query = "SELECT item_id FROM item WHERE name = '".$name."';";
	$data = mysqli_query( $conn, $query );
	if(mysqli_num_rows($data)>0) //이미 아이템이 등록되어 있다면 추가x
	{
		$message = "이미 등록되어 있는 아이템입니다."; 
	}
	else	//아이템이 없다면 등록 실행
	{
		$query = "SELECT * FROM item"; 
		$data = mysqli_query( $conn, $query );
		$new_item_id = mysqli_num_rows($data)+1;
		// MySQL 아이템 등록 실행 
		$query = "INSERT INTO item( item_id, game_id, name, image ) VALUES ( '".$new_item_id."', '".$game_id."', '".$name."', '".$image."');"; 
		$result = mysqli_query( $conn, $query );
		if( $result ) 
		{	
			$message = "아이템 (".$name.")을 등록하였습니다"; 
		} 
		else 
		{
			$message = "아이템 (".$name.")을 등록할 수 없습니다"; 
		} 
	}
	// MySQL 드라이버 연결 해제
	mysqli_close( $conn );
?>

<form name = "frm" method = "post" action = "./posts.php" >
	<input type = 'hidden' name = 'message' value = ' * <?php echo $message;?>' >
</form>
<script language="javascript">
	document.frm.submit();
</script>

<?php 
	header('Content-Type: text/html; charset=UTF-8');
?>
<HTML>
<head>     
<title>Posts</title>
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
</head>
	<BODY>

	<a href="mainpage.php">
        <img src="/image/u2u.png" alt="Image" width="250" height="150">
    </a>

		<!-- 화면구성 -->
		<br>
		<b>  <INPUT TYPE = "button" value = "뒤로가기" onClick="javascript:move( './posts.php' );">
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[글쓰기] </b>
		<br> 
		<form name = "formm" method = "post" action = "./addSQL.php">				
			<br> 작&nbsp;&nbsp;&nbsp;성&nbsp;&nbsp;&nbsp;자&nbsp;&nbsp;&nbsp;: <INPUT TYPE = "text" NAME = "user_id" SIZE="60" >
			<br> 아이템&nbsp;&nbsp;ID&nbsp;&nbsp;&nbsp;&nbsp;: <INPUT TYPE = "int" NAME = "item_id" SIZE="60" >
			<br> 제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <INPUT TYPE = "text" NAME = "title" SIZE="60" >
			<br> 판매&nbsp;&nbsp;&nbsp;&nbsp;금액 : <INPUT TYPE = "int" NAME = "sell_cost" SIZE="60" >
			<br> 아이템 설명 : <INPUT TYPE = "text" NAME = "item_option" SIZE="60" >
			<br> 상세&nbsp;&nbsp;&nbsp;&nbsp;내용 : <INPUT TYPE = "text" NAME = "content" SIZE="60" >
		</form>  
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 

		<INPUT TYPE="button" value="등록" onClick="javascript:document.formm.submit();"> &nbsp; 
	</BODY>
</HTML>

<?php 
	header('Content-Type: text/html; charset=UTF-8');
?>
<HTML>
	<BODY>
		<!-- 화면구성 -->
		<br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<b> - 아이템 등록 - </b>
		<br> 
		<form name = "formm" method = "post" action = "./addItemSQL.php">				
			<br> 게임명:  <INPUT TYPE = "int" name = "game_name" SIZE="60" >
			<br> 아이템 명 : <INPUT TYPE = "text" NAME = "name" SIZE="60" >
			<br> 게임 장르: <INPUT TYPE = "text" NAME = "game_genre" SIZE="60" >
			<br> 아이템 이미지 : <INPUT TYPE = "text" NAME = "image" SIZE="60" >
		</form>  
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<INPUT TYPE="button" value="등록" onClick="javascript:document.formm.submit();"> &nbsp; 
	</BODY>
</HTML>
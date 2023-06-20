<?php
    include("./SQLconstants.php");
    include("./writeLog.php"); 
	$conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

    // MySQL 검색 실행 및 결과 출력
	$query = "DELETE FROM post WHERE post_id = ".$_POST['idx'];
    $result = mysqli_query( $conn, $query );
    if($result)
    {
        echo "<script>alert('성공적으로 삭제하였습니다.');</script>";
        echo "삭제"   .$_POST['idx'];  ; 
        
    }

    else
    {
        echo "<script>alert('삭제 처리에 '" . $_POST['prepage'] . "'실패하였습니다.');</script>"; 
        echo "실패"    .$_POST['idx'];  ;
    }

    echo "<script>location.href='" . $_POST['prepage'] . "'</script>";
    addLogCSV("deletePost");
    
?>
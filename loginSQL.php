<?php 
	header('Content-Type: text/html; charset=UTF-8');
    session_start();
    include("./SQLconstants.php");
    $conn = mysqli_connect( $mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database ) or die( "Can't access DB" );


    $user_id = $_POST['UserID'];
    $user_password = $_POST['UserPW'];

    $query = "SELECT * FROM user WHERE ID = \"".$user_id."\" and password = \"".$user_password."\"";
	$result = mysqli_query( $conn, $query );
    $row = mysqli_fetch_array($result);
    

    if( $result ) 
    {
       
        if(isset($row))
        {
            $_SESSION['UserID'] = $row['id'];
            $_SESSION['UserName'] = $row['name'];
            echo("<script>location.replace('next.php');</script>"); 
            
        }
        else
        {
            $_SESSION["UserID"] = $user_id;
            echo "<script>alert('로그인이 실패하였습니다.');</script>";
            echo("<script>location.replace('login.php');</script>"); 
        }
        
        
    }
    else
    {
        $_SESSION["UserID"] = $user_id;
        echo "<script>alert('...로그인이 실패하였습니다...');</script>";
        echo("<script>location.replace('login.php');</script>"); 

    }

    /* debugging
    echo 'POST<pre>';
    var_dump($_POST);
    echo '</pre>';
    echo 'Row<pre>';
    var_dump($row);
    echo '</pre>';
    echo 'result<pre>';
    var_dump($result);
    echo '</pre>';
    */


    mysqli_free_result( $result );
	mysqli_close( $conn );

?>
<?php


function UserFind($id)
{
    include 'SQLconstants.php';
    $conn = mysqli_connect( $mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database ) or die( "Can't access DB" );
    $query = "SELECT * FROM user WHERE ID = \"".$id."\"";
	$result = mysqli_query( $conn, $query );
    $row = mysqli_fetch_array($result);
    return $row;
}
?>
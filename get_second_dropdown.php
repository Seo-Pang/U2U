<!-- get_second_dropdown.php -->
<?php

include("./SQLconstants.php");
$conn = new mysqli($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database);
if ($conn->connect_error) 
{
    die(" " . $conn->connect_error);
}

$firstValue = $_POST['firstValue'];
$options = '';
 $sql = "SELECT game_id, server_id, server_name FROM server where game_id = ". $firstValue;
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['server_id'] . "'>" . $row['server_name'] . "</option>";
    }
}

echo $options;
?>

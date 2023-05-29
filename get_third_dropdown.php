<!-- get_second_dropdown.php -->
<?php

include("./SQLconstants.php");
$conn = new mysqli($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database);
if ($conn->connect_error) 
{
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

$secondValue = $_POST['secondValue'];
$options = '';
 // 쿼리 실행하여 데이터 가져오기
 $sql = "SELECT game_id, server_id, server_name FROM server where game_id = ". $secondValue;
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['server_id'] . "'>" . $row['server_name'] . "</option>";
    }
}

// 첫 번째 드롭다운 메뉴의 선택된 값 가져오기
// 두 번째 드롭다운 메뉴의 항목을 동적으로 생성
// 생성된 항목들을 클라이언트에게 반환
echo $options;
?>

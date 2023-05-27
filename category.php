

<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Dropdown Example</title>
    <style>
        select 
        {
            width: 120px;
            height: 30px;
        }
        input[type="submit"]
        {
            width: 120px;
            height: 30px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // ù ��° ��Ӵٿ� �޴��� ����Ǿ��� ���� �̺�Ʈ ó��
        function onChangeFirstDropdown() {
            // ���õ� �׸��� �� ��������
            var firstValue = $('#firstDropdown').val();

            // AJAX�� ����Ͽ� ������ ������ ����
            $.ajax({
                url: 'get_second_dropdown.php', // �� ��° ��Ӵٿ� �׸��� �������� �����ϴ� PHP ���� ���
                type: 'POST',
                data: {firstValue: firstValue},
                success: function(response) 
                {
                    // �����κ��� ���� �����ͷ� �� ��° ��Ӵٿ� �޴� ����
                    $('#secondDropdown').html(response);
                }
            });
        }
    </script>
</head>
<body>
<div class="container">
    <a href="test.php">
        <img src="/image/u2u.png" alt="Image" width="250" height="150">
    </a>
    <h1>U2U Game Select</h1>
    <select id="firstDropdown" onchange="onChangeFirstDropdown()">
        <?php
        include("./SQLconstants.php");
        $conn = new mysqli($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database);

            // ���� Ȯ��
            if ($conn->connect_error) 
            {
                die("�����ͺ��̽� ���� ����: " . $conn->connect_error);
            }

            // ���� �����Ͽ� ������ ��������
            $sql = "SELECT game_id, game_name FROM game";
            $result = $conn->query($sql);

            // ��Ӵٿ� �ɼ� ����
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['game_id'] . "'>" . $row['game_name'] . "</option>";
                }
            }

            // �����ͺ��̽� ���� �ݱ�
            $conn->close();
        ?>

        <!--<option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>-->
    </select>
    <select id="secondDropdown">
        <!-- �ʱ⿡�� �� ��° ��Ӵٿ� �޴��� ������� -->
    </select>
    <input type="submit" value="Submit">
    </br>
</div>
</body>
</html>


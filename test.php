<!DOCTYPE html>
<html>
<head>
    <title>Search Box Example</title>
</head>
<body>
    <a href="test.php">
        <img src="/image/u2u.png" alt="Image" width="250" height="150">
    </a>
    <form method="GET" action="test.php">
        <input type="text" name="query" placeholder="Enter your search query">
        <input type="submit" value="Search">
    </form>


    <?php

    session_start();  // �α����� �� ���� ����
    $sess_id = session_id();


    if (isset($_GET['query'])) {
        $searchQuery = $_GET['query'];
        $searchTime = $_GET['searchTime'];

        // Perform your search logic here
        $searchTime = date("Y-m-d H:i:s");
        // Output the search query and search time
        echo "Search Query: " . $searchQuery . "<br>";
        echo "Search Time: " . $searchTime . "<br>";
    }

    $data = array(
        // ��� ������
        array("id" ,"query", "time",),
        // CSV������
        array($sess_id, $searchQuery, $searchTime), 
    );
    // ���� �ۼ�
    $outFile = fopen("csvWriteTest.csv", "a+");
    foreach ($data as $fields) 
    {
    // ���� ������ �ۼ�
        fputcsv($outFile, $fields);
    }
    session_destroy();
    ?>
</body>
</html>







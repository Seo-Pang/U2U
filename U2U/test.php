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

    session_start();  // 로그인할 때 세션 선언
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
        // 헤더 데이터
        array("id" ,"query", "time",),
        // CSV데이터
        array($sess_id, $searchQuery, $searchTime), 
    );
    // 파일 작성
    $outFile = fopen("csvWriteTest.csv", "a+");
    foreach ($data as $fields) 
    {
    // 파일 데이터 작성
        fputcsv($outFile, $fields);
    }
    session_destroy();
    ?>
</body>
</html>







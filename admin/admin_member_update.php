<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";
    
    if ($_SESSION["userlevel"] !== "1" && !isset($_SESSION["userlevel"]))
    {
       alert_back("수정권한이 없습니다.");
    }

    $num   = $_POST["num"];
    $level = $_POST["level"];
    $point = $_POST["point"];

    // $con = mysqli_connect("localhost", "user1", "12345", "sample");
    $sql = "update members set level=$level, point=$point where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>


<?php
    session_start();
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";

    if ($_SESSION["userlevel"] !== "1" && !isset($_SESSION["userlevel"]))
    {
       alert_back("삭제권한이 없습니다.");
    }

    $num   = $_GET["num"];

    // $con = mysqli_connect("localhost", "user1", "12345", "sample");
    $sql = "delete from members where num = $num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>


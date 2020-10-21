<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";
    $num   = $_GET["num"];
    $page   = $_GET["page"];

    // $con = mysqli_connect("localhost", "user1", "12345", "sample");
    $sql = "select * from notice where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $sql = "delete from notice where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'notice_list.php?page=$page';
	     </script>
	   ";
?>


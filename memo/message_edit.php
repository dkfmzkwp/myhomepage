<meta charset='utf-8'>
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/myhome/db/db_connector.php";

$num  = $_GET["num"];
$subject = $_POST["subject"];
$content = $_POST["content"];

// $con = mysqli_connect("localhost", "user1", "12345", "sample");
$sql = "update message set subject = '$subject', content='$content' where num = $num;";
$result = mysqli_query($con, $sql);

mysqli_close($con);                // DB 연결 끊기

echo "
	   <script>
	    location.href = 'message_box.php?mode=send';
	   </script>
	";
?>
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";

$num = $_GET["num"];
$page = $_GET["page"];
$copied_file_name = $_GET["file_copied"];

$sql = "select * from board where num = $num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$id = $row["id"];

//삭제를 위한 권한
if (!isset($_SESSION["userid"]) || ($_SESSION["userlevel"] !== "1" && $_SESSION["userid"] !== $id)) {
    mysqli_close($con);
    alert_back("수정 권한이 없습니다.");
}

// $con = mysqli_connect("localhost", "user1", "12345", "sample");
$sql = "update board set file_name='', file_type='', file_copied=''";
$sql .= " where num=$num";
mysqli_query($con, $sql);

if ($copied_file_name) {
    $file_path = "./data/" . $copied_file_name;
    unlink($file_path);
  }

mysqli_close($con);

echo "
	      <script>
	          history.back();
	      </script>
	  ";
?>
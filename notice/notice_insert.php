<meta charset="utf-8">
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/create_table.php";

create_table($con, 'notice'); // board 테이블 생성

session_start();
//세션값 확인
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";

if (!$userid) {
	echo ("
                    <script>
                    alert('공지사항 글쓰기는 로그인 후 이용해 주세요!');
                    history.go(-1)
                    </script>
        ");
	exit;
}

$subject = $_POST["subject"];
$content = $_POST["content"];

$subject = test_input($subject);
$content = test_input($content);

$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

// $con = mysqli_connect("localhost", "user1", "12345", "sample");

$sql = "insert into notice (id, name, subject, content, regist_day, hit) ";
$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0)";
mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

// 포인트 부여하기
$point_up = 100;

$sql = "select point from members where id='$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$new_point = $row["point"] + $point_up;

$sql = "update members set point=$new_point where id='$userid'";
mysqli_query($con, $sql);

mysqli_close($con);                // DB 연결 끊기

echo "
	   <script>
	    location.href = 'notice_list.php';
	   </script>
	";
?>
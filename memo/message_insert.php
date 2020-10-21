<meta charset='utf-8'>
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/myhome/db/db_connector.php";

if (!($_SERVER["REQUEST_METHOD"] === "POST")) {
	alert_back("Action 방식이 올바르지 않습니다.");
}

if (!isset($_POST["send_id"])) {
	alert_back("로그인 후 이용해 주세요!");
}

if (!isset($_POST['rv_id'])) {
	alert_back("rv_id 값이 없습니다.");
}

if (!isset($_POST['subject'])) {
	alert_back("subject 값이 없습니다.");
}

if (!isset($_POST['content'])) {
	alert_back("content 값이 없습니다.");
}

$send_id = $_POST["send_id"]; //보내는 사람
$rv_id = $_POST['rv_id']; //받는 사람
$subject = $_POST['subject']; //쪽지 제목
$content = $_POST['content']; //쪽지 내용

test_input($subject);
test_input($content);

$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

// $con = mysqli_connect("localhost", "user1", "12345", "sample");
$sql = "select * from members where id='$rv_id'"; //members 테이블에 받는사람이 진짜 존재하는지 점검
$result = mysqli_query($con, $sql);
$num_record = mysqli_num_rows($result); //레코드셋의 갯수를 확인하여 저장한다.

if ($num_record) {
	$sql = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
	$sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
} else {
	alert_back("수신아이디가 잘못 되었습니다.");
}

mysqli_close($con);                // DB 연결 끊기

echo "
	   <script>
	    location.href = 'message_box.php?mode=send';
	   </script>
	";
?>
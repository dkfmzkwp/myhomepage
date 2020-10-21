<?php
// 1.데이터베이스 시간설정
date_default_timezone_set("Asia/Seoul");

$servername = "localhost";
$username = "root";
$password = "123456";

// 2.데이터베이스 접속 밒 오류처리(데이터베이스 생성기능 부여)
$con = mysqli_connect("$servername", "$username", "$password");
if (!$con) {
    die("connect faild" . mysqli_connect_error());
}

// 3.데이터베이스 존재하는지 확인
$database_flag = false;
$sql = "show databases";
$result = mysqli_query($con, $sql) or die("Error" . mysqli_error($con));

while ($row = mysqli_fetch_array($result)) {
    if ($row["Database"] == "sample") {
        $database_flag = true;
        break;
    }
}

// 4.데이터베이스 생성 (데이터 베이스가 존재하지 않으면)
if ($database_flag === false) {
    $sql = "create database sample";
    $value = mysqli_query($con, $sql) or die("Error" . mysqli_error($con));
    if ($value === true) {
        echo "<script>
                alert('sample Database 생성 완료.');
            </script>";
    }
}

// 5.데이터베이스 접속 ($con 에 데이터베이스 연결)
$db_con = mysqli_select_db($con, "sample") or die("Error" . mysqli_error($con));
if (!$db_con) {
    echo "<script>
            alert('sample Database 선택안됨.');
                  </script>";
}

function alert_back($message)
{
    echo ("
			<script>
			alert('$message');
			history.go(-1)
			</script>
			");
    exit;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} // 특수문자 방어


function alert11($message)
{
    echo ("
			<script>
			alert('$message');
			</script>
			");
    exit;
}
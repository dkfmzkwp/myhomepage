<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/myhome/db/db_connector.php";
include_once $_SERVER['DOCUMENT_ROOT'] ."/myhome/db/create_table.php";

create_table($con, 'board');

// if(!isset($_SESSION['userid'])){
//   echo "<script>alert('권한없음!12');history.go(-1);</script>";
//   exit;
// }

// $userid = $_SESSION['userid'];
// $username = $_SESSION['username'];
// // $usernick = $_SESSION['usernick'];

if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";
if (isset($_SESSION["username"])) $username = $_SESSION["username"];
else $username = "";

if (!$userid) {
	echo ("
                    <script>
                    alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
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

$upload_dir = "./data/"; //저장할 파일 위치

$upfile_name	 = $_FILES["upfile"]["name"];
$upfile_tmp_name = $_FILES["upfile"]["tmp_name"]; // 서버가 임의로 준 파일명 (서버-임시 버퍼 장치에 저장)
$upfile_type     = $_FILES["upfile"]["type"];
$upfile_size     = $_FILES["upfile"]["size"]; // 안되면 php init 에서 최대크기 수정
$upfile_error    = $_FILES["upfile"]["error"];

if ($upfile_name && !$upfile_error) {
	$file = explode(".", $upfile_name);
	$file_name = $file[0];
	$file_ext  = $file[1];

	$new_file_name = date("Y_m_d_H_i_s");
	$new_file_name = $new_file_name . "_" . $file_name;
	$copied_file_name = $new_file_name . "." . $file_ext; // 2020_09_23_11_10_20_memo.sql
	$uploaded_file = $upload_dir . $copied_file_name; // ./data/2020_09_23_11_10_20_memo.sql

	if ($upfile_size  > 1000000) {
		echo ("
				<script>
				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
		exit;
	}

	if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
		echo ("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
		exit;
	}
} else {
	$upfile_name      = "";
	$upfile_type      = "";
	$copied_file_name = "";
}

// $con = mysqli_connect("localhost", "user1", "12345", "sample");

$sql = "insert into board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
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
	    location.href = 'board_list.php';
	   </script>
    ";
    
    }else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
        $num   = $_GET["num"];
        $page   = $_GET["page"];
        
        // $con = mysqli_connect("localhost", "user1", "12345", "sample");
        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        
        $copied_name = $row["file_copied"];
        $id = $row["id"];
        
        //삭제를 위한 권한
        if(!isset($_SESSION["userid"]) || ($_SESSION["userlevel"] !== "1" && $_SESSION["userid"] !== $id)){
          mysqli_close($con);
          alert_back("삭제 권한이 없습니다.");
        }
        
        //해당된 파일을 찾아서 삭제처리
        if ($copied_name) {
          $file_path = "./data/" . $copied_name;
          unlink($file_path);
        }
        
        $sql = "delete from board where num = $num";
        mysqli_query($con, $sql);
        mysqli_close($con);
        
        echo "
                 <script>
                     location.href = 'board_list.php?page=$page';
                 </script>
               ";        
               
    }else if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
        $num = $_POST["num"];
        $page = $_POST["page"];
        $subject = $_POST["subject"];
        $content = $_POST["content"];
        
        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        
        $id = $row["id"];
        
        //삭제를 위한 권한
        if (!isset($_SESSION["userid"]) || ($_SESSION["userlevel"] !== "1" && $_SESSION["userid"] !== $id)) {
            mysqli_close($con);
            alert_back("수정 권한이 없습니다.");
        }
        
        $upload_dir = "./data/"; //저장할 파일 위치
        
        $upfile_name	 = $_FILES["upfile"]["name"];
        $upfile_tmp_name = $_FILES["upfile"]["tmp_name"]; // 서버가 임의로 준 파일명 (서버-임시 버퍼 장치에 저장)
        $upfile_type     = $_FILES["upfile"]["type"];
        $upfile_size     = $_FILES["upfile"]["size"]; // 안되면 php init 에서 최대크기 수정
        $upfile_error    = $_FILES["upfile"]["error"];
        
        if ($upfile_name && !$upfile_error) {
            $file = explode(".", $upfile_name);
            $file_name = $file[0];
            $file_ext  = $file[1];
        
            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name = $new_file_name . "_" . $file_name;
            $copied_file_name = $new_file_name . "." . $file_ext; // 2020_09_23_11_10_20_memo.sql
            $uploaded_file = $upload_dir . $copied_file_name; // ./data/2020_09_23_11_10_20_memo.sql
        
            if ($upfile_size  > 1000000) {
                echo ("
                        <script>
                        alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                        history.go(-1)
                        </script>
                        ");
                exit;
            }
        
            if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                echo ("
                            <script>
                            alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                            history.go(-1)
                            </script>
                        ");
                exit;
            }
        } else {
            $upfile_name      = "";
            $upfile_type      = "";
            $copied_file_name = "";
        }
        
        // $con = mysqli_connect("localhost", "user1", "12345", "sample");
        $sql = "update board set subject='$subject', content='$content', file_name='$upfile_name', 
        file_type='$upfile_type', file_copied='$copied_file_name' ";
        $sql .= " where num=$num";
        mysqli_query($con, $sql);
        
        mysqli_close($con);
        
        echo "
                  <script>
                      location.href = 'board_list.php?page=$page';
                  </script>
              ";

    }

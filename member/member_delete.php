<?php
session_start();
include_once "../db/db_connector.php";
$id = $_SESSION["userid"];

$del_sql = "delete from members where id = '$id'";
$value = mysqli_query($con, $del_sql) or die("Error" . mysqli_error($con));

if ($value) {
    unset($_SESSION["userid"]);
    unset($_SESSION["username"]);
    unset($_SESSION["userlevel"]);
    unset($_SESSION["userpoint"]);

    ?>
    <script>
             alert('탈퇴 성공.');
	         location.href = "http://<?=$_SERVER['HTTP_HOST']?>/myhome/index.php";
	     </script>
    <?php
} 

else {
    echo "
            <script>
                alert('회원탈퇴 오류.');
                history.go(-1);
            </script>
        ";
}

mysqli_close($con);


?>
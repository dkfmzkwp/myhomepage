<?php
    include_once "../db/db_connector.php";
   
    $id = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];

    $email = $email1."@".$email2;
    
    // $con = mysqli_connect("localhost", "user1", "12345", "sample");
    $sql = "update members set pass='$pass', name='$name' , email='$email'";
    $sql .= " where id='$id'";
    $value = mysqli_query($con, $sql) or die("Error".mysqli_error($con));
    
    if($value){
        session_start();
            $_SESSION["username"] = $name;
    }
    else{
        echo "
            <script>
                alert('정보수정 오류.');
                history.go(-1);
            </script>
        ";
    }

    mysqli_close($con);     

    
?>

<script>
	          location.href = "http://<?=$_SERVER['HTTP_HOST']?>/myhome/index.php";
	      </script>

   

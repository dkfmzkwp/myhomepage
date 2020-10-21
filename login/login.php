<?php
  include_once "../db/db_connector.php";

    $id   = $_POST["id"];
    $pass = $_POST["pass"];

  //  $con = mysqli_connect("localhost", "root", "123456", "sample");
   $sql = "select * from members where id='$id'";
   $result = mysqli_query($con, $sql); //레코드셋

   $num_match = mysqli_num_rows($result); //레코드셋의 갯수

   if(!$num_match) 
   {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다!');
             history.go(-1); // == location.href = 'login_form.php'; -> 입력한값을 지운다
           </script>
         ");
    }
    else
    {
        $row = mysqli_fetch_array($result); //레코드셋을 배열로 가져온다
        $db_pass = $row["pass"]; //인덱스가 아닌 필드명으로 찾는다 프레임워크의 맵방식

        mysqli_close($con);

        if($pass != $db_pass)
        {

           echo("
              <script>
                window.alert('비밀번호가 틀립니다!');
                history.go(-1);
              </script>
           ");
           exit;
        }
        else
        {
            session_start();
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];
            $_SESSION["userpoint"] = $row["point"];

        
           
?>
<script>
          location.href = "http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/index.php";
 </script>
<?php
        }
      }
?>
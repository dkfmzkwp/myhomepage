<?php
  session_start();
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  unset($_SESSION["userlevel"]);
  unset($_SESSION["userpoint"]);
  
?>

<script>
          location.href = "http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/index.php";
 </script>

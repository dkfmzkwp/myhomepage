<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>CFGN_Nation</title>
<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/css/common.css?ver=1">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/memo/css/message.css">
<script>
  function check_input() {
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>
</head>
<body> 
<header>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/header.php"; ?>
</header>  
<section>
<div id="main_img_bar">
		<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
    </div>
   	<div id="message_box">
	    <h3 id="write_title">
	    		쪽지 수정 하기
		</h3>
<?php
    $num  = $_GET["num"];
    
    include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";
    $sql = "select * from message where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$send_id      = $row["send_id"];
	$rv_id      = $row["rv_id"];
	$subject    = $row["subject"];
    $content    = $row["content"];
    
	// $con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql2 = "select name from members where name = '$rv_id'";
    $result2 = mysqli_query($con, $sql2);
    $record = mysqli_fetch_array($result2);
    $rv_name    = $record["name"];
    
?>		
	    <form  name="message_form" method="post" action="message_edit.php?num=<?= $num ?>">
	    	<input type="hidden" name="send_id" value="<?=$user_id?>">
	    	<input type="hidden" name="rv_id" value="<?=$send_id?>">
	    	<div id="write_msg">
	    	    <ul>
				<li>
					<span class="col1">보내는 사람 : </span>
					<span class="col2"><?=$userid?></span>
				</li>	
				<li>
					<span class="col1">수신 아이디 : </span>
					<span class="col2"><?=$rv_name?>(<?=$rv_id?>)</span>
				</li>	
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">글 내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	    <button type="button" onclick="check_input()">수정</button>
	    	</div>
	    </form>
	</div> <!-- message_box -->
</section> 
<footer>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/footer.php"; ?>
</footer>
</body>
</html>
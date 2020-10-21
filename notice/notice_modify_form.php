<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>CFGN_Nation</title>
<link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/css/common.css?ver=1">
<link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/notice/css/notice.css">
<script>
  function check_input() {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>
<body> 
<header>
<?php include $_SERVER['DOCUMENT_ROOT']."/myhome/header.php";?>
</header>  
<section>
	<div id="main_img_bar">
    <img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
    </div>
   	<div id="board_box">
	    <h3 id="board_title">
	    		공지사항 > 글 쓰기
		</h3>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";

	$num  = $_GET["num"];
	$page = $_GET["page"];
	
	// $con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql = "select * from notice where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$name       = $row["name"];
	$subject    = $row["subject"];
	$content    = $row["content"];		
?>
	    <form  name="board_form" method="post" action="notice_modify.php?num=<?=$num?>&page=<?=$page?>">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"><?=$content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li>
				<li><button type="button" onclick="location.href='notice_list.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
<?php include $_SERVER['DOCUMENT_ROOT']."/myhome/footer.php";?>
</footer>
</body>
</html>

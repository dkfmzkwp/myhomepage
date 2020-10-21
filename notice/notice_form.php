<!DOCTYPE html>

<html>
<head> 
<meta charset="utf-8">
<title>CFGN_Nation</title>
<link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/css/common.css?ver=1">
<link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/notice/css/notice.css">
<script src="./js/notice.js"></script>
</head>
<body> 
<header>
	<?php include $_SERVER['DOCUMENT_ROOT']."/myhome/header.php";?>
</header>  
<!-- <?php
if (!isset($_SESSION["userid"]) )
	{
		echo("<script>
				alert('게시판은 로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
		exit;
	}
?> -->
<section>
	<div id="main_img_bar">
		<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
    </div>
   	<div id="board_box">
	    <h3 id="board_title">
	    		공지사항 > 글 쓰기
		</h3>
	    <form  name="board_form" method="post" action="notice_insert.php">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$username?></span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text"></span>
	    		</li>	    	
	    		<li id="text_area">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
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

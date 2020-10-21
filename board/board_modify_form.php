<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/css/common.css?ver=1">
<link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/board/css/board.css">
<script src="./js/board.js"></script>
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
	    		게시판 > 글 쓰기
		</h3>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";
	$num  = $_GET["num"];
	$page = $_GET["page"];
	
	
	// $con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$id       = $row["id"];
	$name       = $row["name"];
	$subject    = $row["subject"];
	$content    = $row["content"];		
	$file_name  = $row["file_name"];
	$copied_file_name = $row["file_copied"];

	if(!isset($_SESSION["userid"]) || ($_SESSION["userlevel"] !== "1" && $_SESSION["userid"] !== $id)){
		mysqli_close($con);
		alert_back("수정 권한이 없습니다.");
	  }
?>
	    <form  name="board_form" method="post" action="board_dmi.php?mode=update" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<input type="hidden" name="num" value="<?=$num?>">
					<input type="hidden" name="page" value="<?=$page?>">
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
	    		<li>
					<span class="col1"> 첨부 파일 : </span>
					<?php 
					if($file_name === ''){?>
					<span class="col2"><input type="file" name="upfile"></span>
					<?php
					} else?>
					<?php
					{?>
					<span class="col2" onclick="location.href='board_file_delete.php?num=<?= $num ?>&page=<?= $page ?>&file_copied=<?=$copied_file_name?>'"><?=$file_name?></span>
				<?php	
				}?>
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li>
				<li><button type="button" onclick="location.href='board_list.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section> 
<footer>
<?php include $_SERVER['DOCUMENT_ROOT']."/myhome/footer.php";?></footer>
</body>
</html>

<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>CFGN_Nation</title>
<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/css/common.css?ver=1">
<link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/member/css/member.css">
<script type="text/javascript" src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/member/js/member_modify.js"></script>
</head>
<body> 
	<header>
	<?php include $_SERVER['DOCUMENT_ROOT']."/myhome/header.php";?>
    </header>
<?php    
	include_once "../db/db_connector.php";
   	// $con = mysqli_connect("localhost", "root", "123456", "sample");
    $sql    = "select * from members where id='$userid'"; // $userid -> 'header.php' 에서 만든 세션값 가져옴
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    $pass = $row["pass"];
    $name = $row["name"];

    $email = explode("@", $row["email"]); //$row["email"] 속에 있는것을 @ 기준으로 분리 시킨다
    $email1 = $email[0];
    $email2 = $email[1];

    mysqli_close($con);
?>
	<section>
	<div id="main_img_bar">
		<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
    </div>
        <div id="main_content">
      		<div id="join_box">
          	<form  name="member_form" method="post" action="member_modify.php">
			    <h2>회원 정보수정</h2>
    		    	<div class="form id">
				        <div class="col1">아이디</div>
				        <div class="col2">
							<?=$userid?>
							<input type="hidden" name="id" value="<?=$userid?>">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>

			       	<div class="form">
				        <div class="col1">비밀번호</div>
				        <div class="col2">
							<input type="password" name="pass" value="<?=$pass?>">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">비밀번호 확인</div>
				        <div class="col2">
							<input type="password" name="pass_confirm" value="<?=$pass?>">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">이름</div>
				        <div class="col2">
							<input type="text" name="name" value="<?=$name?>">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form email">
				        <div class="col1">이메일</div>
				        <div class="col2">
							<input type="text" name="email1" value="<?=$email1?>">@<input 
							       type="text" name="email2" value="<?=$email2?>">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="bottom_line"> </div>
			       	<div class="buttons">
	                	<img style="cursor:pointer" src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/button_save.gif" onclick="check_input()">&nbsp;
                  		<img id="reset_button" style="cursor:pointer" src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/button_reset.gif"
                  			onclick="reset_form()">
	           		</div>
           	</form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
	<?php include $_SERVER['DOCUMENT_ROOT']."/myhome/footer.php";?>
    </footer>
</body>
</html>


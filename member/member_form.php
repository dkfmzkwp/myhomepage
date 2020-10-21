<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CFGN_Nation</title>
	<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/css/common.css?ver=1">
	<link rel="stylesheet" type="text/css" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/member/css/member.css">
	<link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/css/normalize.css">
	<script type="text/javascript" src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/member/js/member.js"></script>
	<script src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/js/vendor/modernizr.custom.min.js"></script>
	<script src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/js/vendor/jquery-1.10.2.min.js"></script>
	<script src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/js/slide.js"></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT']."/myhome/header.php";?>
	</header>

	<section>
	<div id="main_img_bar">
		<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
    </div>

		<div id="main_content">
			<div id="join_box">
				<form name="member_form" method="post" action="member_insert.php">
					<h2>회원 가입</h2>
					<table>
						<tr>
							<th>아이디</th>
							<td align='center'><input type="text" name="id" id="id"></td>
							<td><a href="#"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/check_id.gif" onclick="check_id()"></a></td>
						</tr>
						<tr>
							<th>비밀번호</th>
							<td align='center'><input type="password" name="pass"></td>
						</tr>
						<tr>
							<th>비밀번호 확인</th>
							<td align='center'><input type="password" name="pass_confirm"></td>
						</tr>
						<tr>
							<th>이름</th>
							<td align='center'><input type="text" name="name"></td>
						</tr>
						<tr>
							<th>이메일</th>
							<td><input type="text" name="email1">@<input type="text" name="email2"></td>
						</tr>
					</table>
					<div class="bottom_line"> </div><br>
					<img style="cursor:pointer" src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/button_save.gif" onclick="check_input()">&nbsp;
					<img id="reset_button" style="cursor:pointer" src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/button_reset.gif" onclick="reset_form()">
				</form>
			</div> <!-- join_box -->
		</div> <!-- main_content -->
	</section>

	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT']."/myhome/footer.php";?>
	</footer>
</body>

</html>
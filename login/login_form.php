<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CFGN_Nation</title>
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/css/common.css?ver=1">
	<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/login/css/login.css?after">

	<script type="text/javascript" src="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/login/js/login.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/js/vendor/modernizr.custom.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/js/vendor/jquery-1.10.2.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/js/slide.js"></script>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/header.php"; ?>
	</header>
	<section>
	<div id="main_img_bar">
	<div>
		<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
    </div>
		</div>
		<div id="main_content">
			<div id="login_box">
				<div id="login_title">
					<span>로그인</span>
				</div>
				<div id="login_form">
					<form name="login_form" method="post" action="login.php">
						<ul>
							<li><input type="text" name="id" placeholder="아이디"></li>
							<li><input type="password" id="pass" name="pass" placeholder="비밀번호"></li> <!-- pass -->
						</ul>
						<div id="login_btn">
							<a href="#"><img src="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/img/login.png" onclick="check_input()"></a>
						</div>
					</form>
				</div> <!-- login_form -->
			</div> <!-- login_box -->
		</div> <!-- main_content -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/footer.php"; ?>
	</footer>
</body>

</html>
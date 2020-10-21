<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>CFGN_Nation</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?ver=1">
<link rel="stylesheet" type="text/css" href="./css/main.css">
<link rel="stylesheet" href="./css/normalize.css">
<script src="./js/vendor/modernizr.custom.min.js"></script>
<script src="./js/vendor/jquery-1.10.2.min.js"></script>
<script src="./js/vendor/jquery-ui-1.10.3.custom.min.js"></script>
<script src="./js/slide.js"></script>
</head>
<body> 
	<header>
    	<?php include "./header.php";?>
    </header>
	<section>
	<div id="main_img_bar">
			<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
		</div>
        <div id="info" style="margin-left: 250px; margin-top:50px">
            <img src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/01_01.jpg" alt="">
        </div>
	</section> 
	<footer>
    	<?php include "./footer.php";?>
    </footer>
</body>
</html>
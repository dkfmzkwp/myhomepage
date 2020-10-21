<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CFGN_Nation</title>
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/css/common.css?ver=1">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/notice/css/notice.css">
</head>
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/header.php"; ?>
	</header>
	<section>
		<div id="main_img_bar">
			<img src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/myhome/img/main_img1.jpg">
		</div>
		<div id="board_box">
			<h3 class="title">
				공지사항 > 내용보기
			</h3>

			<?php
			include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";

			$num  = $_GET["num"];
			$page  = $_GET["page"];

			// $con = mysqli_connect("localhost", "user1", "12345", "sample");
			$sql = "select * from notice where num=$num";
			$result = mysqli_query($con, $sql);

			$row = mysqli_fetch_array($result);
			$id      = $row["id"];
			$name      = $row["name"];
			$regist_day = $row["regist_day"];
			$subject    = $row["subject"];
			$content    = $row["content"];
			$hit          = $row["hit"];

			$content = str_replace(" ", "&nbsp;", $content);
			$content = str_replace("\n", "<br>", $content);

			$new_hit = $hit + 1;
			$sql = "update notice set hit=$new_hit where num=$num";
			mysqli_query($con, $sql);
			?>

			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :</b> <?= $subject ?></span>
					<span class="col2"><?= $name ?> | <?= $regist_day ?></span>
				</li>
				<li>
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='notice_list.php?page=<?= $page ?>'">목록</button></li>
				<?php
					if ($userlevel == 1) {
					?>
				<li><button onclick="location.href='notice_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button></li>
				<li><button onclick="location.href='notice_delete.php?num=<?= $num ?>&page=<?= $page ?>'">삭제</button></li>
				<li><button onclick="location.href='notice_form.php'">글쓰기</button></li>
				<?php
					}
					?>
			</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/footer.php"; ?>
	</footer>
</body>

</html>
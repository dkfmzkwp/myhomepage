<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CFGN_Nation</title>
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/css/common.css?ver=1">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/memo/css/message.css">
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
			<h3 class="title">
				<?php
				include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";
				$mode = $_GET["mode"];
				$num  = $_GET["num"];

				// $con = mysqli_connect("localhost", "user1", "12345", "sample");
				$sql = "select * from message where num=$num";
				$result = mysqli_query($con, $sql);

				$row = mysqli_fetch_array($result);
				$send_id    = $row["send_id"];
				$rv_id      = $row["rv_id"];
				$regist_day = $row["regist_day"];
				$subject    = $row["subject"];
				$content    = $row["content"];

				$content = str_replace(" ", "&nbsp;", $content);
				$content = str_replace("\n", "<br>", $content);

				if ($mode == "send")
					$result2 = mysqli_query($con, "select name from members where id='$rv_id'");
				else
					$result2 = mysqli_query($con, "select name from members where id='$send_id'");

				$record = mysqli_fetch_array($result2);
				$msg_name = $record["name"];

				if ($mode == "send")
					echo "송신 쪽지함 > 내용보기";
				else
					echo "수신 쪽지함 > 내용보기";
				?>
			</h3>
			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :</b> <?= $subject ?></span>
					<span class="col2"><?= $msg_name ?> | <?= $regist_day ?></span>
				</li>
				<li>
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
				<li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
				
				<?php
				if ($mode == "rv"){
				?>
					<li><button onclick="location.href='message_response_form.php?num=<?= $num ?>'">답변 쪽지</button></li>
				<?php
				}
				?>

				<li><button onclick="location.href='message_delete.php?num=<?= $num ?>&mode=<?= $mode ?>'">삭제</button></li>

				<?php
				if($mode == "send"){
				?>
				<li><button onclick="location.href='message_edit_form.php?num=<?= $num ?>&mode=<?= $mode ?>'">수정</button></li>
				<?php
				}
				?>
			</ul>
		</div> <!-- message_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/footer.php"; ?>
	</footer>
</body>

</html>
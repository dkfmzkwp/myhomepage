<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CFGN_Nation</title>
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/css/common.css?ver=1">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/notice/css/notice.css">
</head>

<body>
	<header>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/header.php"; ?>
	</header>
	<section>
		<div id="main_img_bar">
			<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
		</div>
		<div id="board_box">
			<h3>
				공지사항 > 목록보기
			</h3>
			<ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>

				<?php
				include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";

				if (isset($_GET["page"]))
					$page = $_GET["page"];
				else
					$page = 1; //시작 페이지 설정

				// $con = mysqli_connect("localhost", "user1", "12345", "sample");
				$sql = "select * from notice order by num desc";
				$result = mysqli_query($con, $sql); // 레코드 셋 (레코드들의 집함)
				$total_record = mysqli_num_rows($result); // 전체 글 수

				$scale = 10;

				// 전체 페이지 수($total_page) 계산 
				if ($total_record % $scale == 0)
					$total_page = floor($total_record / $scale);
				else
					$total_page = floor($total_record / $scale) + 1;

				// 표시할 페이지($page)에 따라 $start 계산  
				$start = ($page - 1) * $scale;

				$number = $total_record - $start;
				// $number = $start + 1;

				for ($i = $start; $i < $start + $scale && $i < $total_record; $i++) {
					mysqli_data_seek($result, $i);
					// 가져올 레코드로 위치(포인터) 이동
					$row = mysqli_fetch_array($result);
					// 하나의 레코드 가져오기
					$num         = $row["num"];
					$id          = $row["id"];
					$name        = $row["name"];
					$subject     = $row["subject"];
					$regist_day  = $row["regist_day"];
					$hit         = $row["hit"];
				?>
					<li>
						<span class="col1"><?= $number ?></span>
						<span class="col2"><a href="notice_view.php?num=<?= $num ?>&page=<?= $page ?>"><?= $subject ?></a></span>
						<span class="col3"><?= $name ?></span>
						<span class="col5"><?= $regist_day ?></span>
						<span class="col6"><?= $hit ?></span>
					</li>
				<?php
					$number--;
				}
				mysqli_close($con);

				?>
			</ul>
			<ul id="page_num">
				<?php
				if ($total_page >= 2 && $page >= 2) {
					$new_page = $page - 1;
					echo "<li><a href='notice_list.php?page=$new_page'>◀ 이전</a> </li>";
				} else
					echo "<li>&nbsp;</li>";

				// 게시판 목록 하단에 페이지 링크 번호 출력
				for ($i = 1; $i <= $total_page; $i++) {
					if ($page == $i)     // 현재 페이지 번호 링크 안함
					{
						echo "<li><b> $i </b></li>";
					} else {
						echo "<li><a href='notice_list.php?page=$i'> $i </a><li>";
					}
				}
				if ($total_page >= 2 && $page != $total_page) {
					$new_page = $page + 1;
					echo "<li> <a href='notice_list.php?page=$new_page'>다음 ▶</a> </li>";
				} else
					echo "<li>&nbsp;</li>";
				?>
			</ul> <!-- page -->
			<ul class="buttons">
				<!-- <li><button onclick="location.href='notice_list.php'">목록</button></li> -->
				<li>
					<?php
					if ($userlevel == 1) {
					?>
						<button onclick="location.href='notice_form.php'">글쓰기</button>
					<?php
					} else {
					?>
						<a href="javascript:alert('공지사항은 관리자만 작성 가능합니다.')"><button>글쓰기</button></a>
					<?php
					}
					?>
				</li>
			</ul>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/footer.php"; ?>
	</footer>
</body>

</html>
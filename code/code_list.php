<?php
//userid에 세션이 없다면 ""가 기본값으로 들어가게 되어있음, ""은 null과 같고 null은 0과 같음, 0은 조건문에서 false와 같음 


include_once $_SERVER["DOCUMENT_ROOT"]."/myhome/db/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/myhome/db/create_table.php";

create_table($con,'wod');//코드리뷰 테이블생성
create_table($con,'code_ripple');//코드리뷰 덧글 테이블생성

$sql="SELECT * from wod;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $id=$row['id'];
    $hit=$row['hit'];
    $subject= $row['subject'];
    $content= $row['content'];
    $subject=str_replace("\n", "<br>", $subject);
    $subject=str_replace(" ", "&nbsp;", $subject);
    $content=str_replace("\n", "<br>", $content);
    $content=str_replace(" ", "&nbsp;", $content);
    $file_name=$row['file_name_0'];
    $file_copied=$row['file_copied_0'];
    $file_type=$row['file_type_0'];
    $day=$row['regist_day'];

    $file_type_tok=explode('/', $file_type);
    $file_type=$file_type_tok[0];

    if (!empty($file_copied)&&$file_type =="image") {
        //이미지 정보를 가져오기 위한 함수 width, height, type
        $image_info=getimagesize("./data/".$file_copied);
        $image_width=$image_info[0];
        $image_height=$image_info[1];
        $image_type=$image_info[2];
        if ($image_width>400) {
            $image_width = 400;
        }
    } else {
        $image_width=0;
        $image_height=0;
        $image_type="";
    }


//상수 정의한 것, final int SCALE = 10; 이거와 같음
define('SCALE', 9);


$result=mysqli_query($con,$sql);
$total_record=mysqli_num_rows($result);

//페이지 나타낼 때 사용하는 것
$total_page=($total_record % SCALE == 0 )?($total_record/SCALE):(ceil($total_record/SCALE));

//2.페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

$start=($page -1) * SCALE;
$number = $total_record - $start;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>CFGN_Nation</title>
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/css/common.css?ver=1">
	<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/myhome/code/css/code.css">
    </head>
    <body>
        <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/header.php"; ?>
        </header>
<?php
   if (!$userid ){
    echo("<script>
            alert('로그인 후 이용해주세요!');
            history.go(-1);
            </script>
        ");
    exit;
}
?>

        <section>
        <div id="main_img_bar">
			<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
		</div>
            <!-- ********************** -->
            <!-- data list -->
            <!-- ********************** -->
            <br><br><br>
            <div class="list_box">
                <h2>오늘의 WOD</h2>
                <ul id="image_list">
                    <?php
                    // db의 code table 내용을 가져옴
                    $sql="SELECT * from `wod` order by num desc;";
                    $result=mysqli_query($con,$sql);
                    
                    // 전체 레코드 수
                    $num_row = mysqli_num_rows($result);

                    // 한페이지에 나타낼 레코드 수 9개

                    // 전체 페이지 수
                    ($num_row % SCALE == 0) ? $total_page = $num_row/SCALE : $total_page = ceil($num_row/SCALE);
                    
                    //출력을 시작할 레코드 위치 구하기 : 현재 페이지에서 -1 한 값에 뿌릴 개수를 곱하여 이전에 출력한 수를 구하고 남은 위치부터 출력함
                    $start=($page -1) * SCALE;
                    mysqli_data_seek($result, $start);

                    //list 출력하기
                    $flag_break = 0;
                    while($row = mysqli_fetch_array($result)){
                ?>
                    <li class='code_view_anchor'>
                        <a href='./view.php?page=<?=$page?>&num=<?=$row['num']?>&hit=<?=$row['hit']+1?>'>
                        <span class='imageBox'>
                                    <img src='http://<?php echo $_SERVER['HTTP_HOST'] ?>/myhome/code/img/<?= $row['category'] ?>.png' alt="<?= $row['category'] ?>">
                                </span>
                            <span class='contentBox'>
                                <h3>제목 :
                                    <?=$row['subject']?></h3>
                                <span class="content_explain">
                                    <p>날짜 :
                                        <?=$row['regist_day']?></p>
                                    <p>아이디 :
                                        <?=$row['id']?></p>
                                    <p>조회수 :
                                        <?=$row['hit']?></p>
                                </span>
                            </span>
                        </a>
                    </li>
                <?php
                    if($flag_break == 8){
                        $flag_break = 0;
                    break;
                    }else{
                        $flag_break++;
                    }
                }
                ?>
                </ul>
                <!-- ********************** -->
                <!-- 하단 페이지 수 -->
                <!-- ********************** -->
                <ul id="page_num">
                <?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='code_list.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++){
        // 현재 페이지 번호 링크 안함
        if ($page == $i){
			echo "<li><b> $i </b></li>";
		}else{
			echo "<li><a href='code_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)	{
		$new_page = $page+1;	
		echo "<li> <a href='code_list.php?page=$new_page'>다음 ▶</a> </li>";
	}else 
		echo "<li>&nbsp;</li>";
?>
                </ul>

                <!-- ********************** -->
                <!-- 하단 글쓰기 버튼 -->
                <!-- ********************** -->
                <ul class="buttons">
                    <li>
                        <?php 
                //로그인 안해도 글쓰기 버튼을 보여줌, 바로 alert 찍을 수 있도록 설계함
                if($userlevel == 1) {
                ?>
                        <button onclick="location.href='code_write_edit_form.php'">글쓰기</button>
                    <?php
                }
                ?>
                    </li>
                </ul>
            </div>
            <!-- code_box -->
        </section>
        <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/footer.php"; ?>
        </footer>
    </body>
</html>
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
        <div id="main_img_bar">
			<img src="http://<?php echo $_SERVER['HTTP_HOST']?>/myhome/img/main_img1.jpg">
		</div>
        <?php
include_once $_SERVER["DOCUMENT_ROOT"]."/myhome/db/db_connector.php";

if(!isset($_SESSION['userid'])){
  echo "<script>alert('권한없음11!');history.go(-1);</script>";
  exit;
}

$mode="insert";
$subject="";
$content="";
$category="";
$id= $_SESSION['userid'];

if(isset($_GET["mode"])&&$_GET["mode"]=="update"){
    $mode="update";
    $num = test_input($_GET["num"]);
    // 쿼리문의 ''와 겹칠 수 있기 때문에 \ 표기를 자동으로 해줌, ,보안상 해줘야 하는 것
    $q_num = mysqli_real_escape_string($con, $num);

    $sql="SELECT * from `wod` where num ='$q_num';";
    $result = mysqli_query($con,$sql);

    if (!$result) alert_back("Error: " . mysqli_error($con));

    $row=mysqli_fetch_array($result);
    $id=$row['id'];
    $hit=$row['hit'];
    $category = $row['category'];
    $subject= htmlspecialchars($row['subject']);
    $content= htmlspecialchars($row['content']);
    $subject=str_replace("\n", "<br>",$subject);
    $subject=str_replace(" ", "&nbsp;",$subject);
    $content=str_replace("\n", "<br>",$content);
    $content=str_replace(" ", "&nbsp;",$content);
    $day=$row['regist_day'];

    // file 있을 때만 
    if(isset($row['file_name_0'])){
      $file_name_0=$row['file_name_0'];
      $file_copied_0=$row['file_copied_0'];
      $file_type_0=$row['file_type_0'];
    }
    mysqli_close($con);
}
?>
        <div id="wrap">
            <div id="col2">
                <div id="title">
                    <h3>WOD> 글쓰기</h3>
                </div>
                <div class="clear"></div>
                <div id="write_form_title"><img src="../free/img/write_form_title.gif"></div>
                <div class="clear"></div>
                <form
                    name="board_form"
                    action="dml_board.php"
                    method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="<?=$mode?>">
                    <input type="hidden" name="num" value="<?=$num?>">
                    <input type="hidden" name="hit" value="<?=$hit?>">
                    <table>
                        <tr>
                            <td>아이디</td>
                            <td><?=$id?></td>
                        </tr>
                        <tr>
                            <td>제&nbsp;&nbsp;목</td>
                            <td>
                                <input id="input_subject" type="text" name="subject" value=<?=$subject?>>
                            </td>
                        </tr>
                        <td>분&nbsp;&nbsp;류</td>
                        <td>
                            <select id="input_category" name="category">
                                <option value="">--선택하세요--</option>
                                <option value="Light day" <?php if ($category == 'Light day') echo "SELECTED"; ?>>Light day</option>
                                <option value="Friendly day" <?php if ($category == 'Friendly day') echo "SELECTED"; ?>>Friendly day</option>
                                <option value="Heavy day" <?php if ($category == 'Heavy day') echo "SELECTED"; ?>>Heavy day</option>
                                <option value="Random day" <?php if ($category == 'Random day') echo "SELECTED"; ?>>Random day</option>
                                <option value="Benchmark day" <?php if ($category == 'Benchmark day') echo "SELECTED"; ?>>Benchmark day</option>
                            </select>
                        </td>
                        <tr>
                            <td>내&nbsp;&nbsp;용</td>
                            <td>
                                <textarea name="content" rows="15" cols="79"><?=$content?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>파&nbsp;&nbsp;일</td>
                        <td>
                            <?php
                  // 업데이트를 할지 삽입을 할지
                    if($mode=="insert"){
                      echo '<input type="file" name="upfile" >이미지(2MB)파일(0.5MB)';
                    }else if($mode=="update"){
                  ?>
                                <input
                                    type="file"
                                    name="upfile"
                                    onclick='document.getElementById("del_file").checked=true; document.getElementById("del_file").disabled=true'>
                                <?php
                    }
                  ?>
                                <?php
                    if($mode=="update" && !empty($file_name_0)){
                      echo "$file_name_0 파일등록";
                      echo '<input type="checkbox" id="del_file" name="del_file" value="1">삭제';
                      echo '<div class="clear"></div>';
                    }
                  ?>
                            </td>
                        </tr>
                    </table>
                    <div id="write_button">
                        <input
                            type="image"
                            onclick='document.getElementById("del_file").disabled=false'
                            src="../free/img/ok.png">&nbsp;
                        <a href="./code_list.php"><img src="../free/img/list.png"></a>
                    </div>
                    <!--end of write_button-->
                </form>

            </div>
            <!--end of col2 -->
        </div>
        <!--end of content -->
    </div>
    <!--end of wrap -->
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/myhome/footer.php"; ?>
        </footer>
</body>
</html>
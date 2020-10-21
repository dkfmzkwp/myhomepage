<script>
    function delete_member(){
        const value = confirm("탈퇴 하시겠습니까?")
        if(value){
            location.href="http://<?=$_SERVER['HTTP_HOST']?>/myhome/member/member_delete.php";
        }
    }
</script>

<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>		
        <div id="top">
            <h3>
                <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/index.php"><img src="http://<?=$_SERVER['HTTP_HOST']?>/myhome/img/home.jpg" alt=""></a>
            </h3>
            <ul id="top_menu">  
<?php
    if(!$userid) {
?>                
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/member/member_form.php">회원 가입</a> </li>
                <li> | </li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/login/login_form.php">로그인</a></li>
<?php
    } else {
                $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
                // $logged = "aaa"."("."kss".")님[Level:"."9".", Point:"."100"."]";
?>
                <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/login/logout.php">로그아웃</a> </li>
                <li> | </li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/member/member_modify_form.php">정보 수정</a></li>
                <li> | </li>
                <li><a href="#" onclick="delete_member();">회원 탈퇴</a></li>
<?php
    }
?>
<?php
    if($userlevel==1) {
?>
                <li> | </li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/admin/admin.php">관리자</a></li>
<?php
    }
?>
            </ul>
        </div>
        <div id="menu_bar">
            <ul>  
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/info.php">소개</a></li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/notice/notice_list.php">공지사항</a></li>
                <!-- <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/board/board_list.php">게시판</a></li> -->
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/free/list.php">자유게시판</a></li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/code/code_list.php">W.O.D</a></li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/myhome/memo/message_box.php?mode=rv">쪽지함</a></li>                                
            </ul>
        </div>
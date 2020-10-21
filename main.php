<div id="main_img_bar">
    <div class="slideshow">
        <div class="slideshow_slides">
            <a href="#"> <img src="./img/nh.jpg" alt="slide1"> </a>
            <a href="#"> <img src="./img/sl.jpg" alt="slide2"> </a>
            <a href="#"> <img src="./img/ej.jpg" alt="slide3"> </a>
            <a href="#"> <img src="./img/ss.jpg" alt="slide4"> </a>
        </div>

        <div class="slideshow_nav">
            <a href="#" class="prev">prev</a>
            <a href="#" class="next">next</a>
        </div>

        <div class="indicator">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
        </div>
    </div>
</div>

<div id="main_content">
    <div id="latest">
        <h4>최근 게시글</h4>
        <ul>
            <!-- 최근 게시 글 DB에서 불러오기 -->
            <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . "/myhome/db/db_connector.php";

            $sql = "select * from board order by num desc limit 5";
            $result = mysqli_query($con, $sql); //결과값을 레코드셋으로 돌려준다

            if (!$result)
                echo "<li>게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다! </li>";
            else {
                while ($row = mysqli_fetch_array($result)) //레코드셋 안의 객체들을 배열로 하나씩 가져온다
                {
                    $regist_day = substr($row["regist_day"], 0, 10); //index가 아닌 필드명으로 찾는다
            ?>
                    <li>
                        <span><?= $row["subject"] ?></span>
                        <span><?= $row["name"] ?></span>
                        <span><?= $regist_day ?></span>
                    </li>
            <?php
                }
            }
            ?>
        </ul>
    </div>
    <div id="point_rank">
        <h4>포인트 랭킹</h4>
        <ul>
            <!-- 포인트 랭킹 표시하기 -->
            <?php
            $rank = 1;
            $sql = "select * from members order by point desc limit 5";
            $result = mysqli_query($con, $sql);

            if (!$result)
                echo "<li>회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!</li>";
            else {
                while ($row = mysqli_fetch_array($result)) {
                    $name  = $row["name"];
                    $id    = $row["id"];
                    $point = $row["point"];
                    $name = mb_substr($name, 0, 1) . " * " . mb_substr($name, 2, 1);
            ?>
                    <li>
                        <span><?= $rank ?></span>
                        <span><?= $name ?></span>
                        <span><?= $id ?></span>
                        <span><?= $point ?></span>
                    </li>
            <?php
                    $rank++;
                }
            }

            mysqli_close($con);
            ?>
        </ul>
    </div>
</div>
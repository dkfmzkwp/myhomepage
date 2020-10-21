<?php
function create_table($con, $table_name)
{
    $flag = false;
    $sql = "show tables from sample";
    $result = mysqli_query($con, $sql) or die('Error' . mysqli_error($con));

    //반복문을 통해 레코드셋($result)에서 한 레코드씩 가져와서 필드내용을 조사
    //해당된 테이블 명이 있는지 확인
    while ($row = mysqli_fetch_row($result)) {
        if ($row[0] === "$table_name") {
            $flag = true;
            break;
        }
    } //while

    //해당된 테이블명이 없으면(flag=false) 해당 테이블명을 찾아서 테이블 쿼리문을 작성한다
    if ($flag === false) {
        switch ($table_name) {
            case 'message':
                $sql = "CREATE TABLE `message` (
                        `num` int(11) NOT NULL AUTO_INCREMENT,
                        `send_id` char(20) NOT NULL,
                        `rv_id` char(20) NOT NULL,
                        `subject` char(200) NOT NULL,
                        `content` text NOT NULL,
                        `regist_day` char(20) DEFAULT NULL,
                        PRIMARY KEY (`num`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                    ";
                break;

            case 'board':
                $sql = "CREATE TABLE `board` (
                        `num` int NOT NULL AUTO_INCREMENT,
                        `id` char(15) NOT NULL,
                        `name` char(10) NOT NULL,
                        `subject` char(200) NOT NULL,
                        `content` text NOT NULL,
                        `regist_day` char(20) NOT NULL,
                        `hit` int NOT NULL,
                        `file_name` char(40) DEFAULT NULL,
                        `file_type` char(40) DEFAULT NULL,
                        `file_copied` char(40) DEFAULT NULL,
                        PRIMARY KEY (`num`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                    ";
                break;

            case 'notice':
                $sql = "CREATE TABLE `notice` (
                            `num` int NOT NULL AUTO_INCREMENT,
                            `id` char(15) NOT NULL,
                            `name` char(10) NOT NULL,
                            `subject` char(200) NOT NULL,
                            `content` text NOT NULL,
                            `regist_day` char(20) NOT NULL,
                            `hit` int NOT NULL,
                            `file_name` char(40) DEFAULT NULL,
                            `file_type` char(40) DEFAULT NULL,
                            `file_copied` char(40) DEFAULT NULL,
                            PRIMARY KEY (`num`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                        ";
                break;

            case 'free':
                $sql = "CREATE TABLE `free` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `id` char(15) NOT NULL,
                    `name` char(10) NOT NULL,
                    `subject` varchar(100) NOT NULL,
                    `content` text NOT NULL,
                    `regist_day` char(20) DEFAULT NULL,
                    `hit` int(11) DEFAULT NULL,
                    `file_name_0` char(40) DEFAULT NULL,
                    `file_copied_0` char(30) DEFAULT NULL,
                    `file_type_0` char(30) DEFAULT NULL,
                    PRIMARY KEY (`num`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            case 'free_ripple':
                $sql = "CREATE TABLE `free_ripple` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `parent` int(11) NOT NULL,
                    `id` char(15) NOT NULL,
                    `name` char(10) NOT NULL,
                    `content` text NOT NULL,
                    `regist_day` char(20) DEFAULT NULL,
                    PRIMARY KEY (`num`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            case 'wod':
                $sql = "CREATE TABLE `wod` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `id` char(15) NOT NULL,
                    `subject` varchar(100) NOT NULL,
                    `content` text NOT NULL,
                    `regist_day` char(20) DEFAULT NULL,
                    `hit` int(11) DEFAULT NULL,
                    `category` char(50) NOT NULL,
                    `file_name_0` char(40) DEFAULT NULL,
                    `file_copied_0` char(30) DEFAULT NULL,
                    `file_type_0` char(30) DEFAULT NULL,
                    PRIMARY KEY (`num`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            case 'code_ripple':
                $sql = "CREATE TABLE `code_ripple` (
                    `num` int(11) NOT NULL AUTO_INCREMENT,
                    `parent` int(11) NOT NULL,
                    `id` char(15) NOT NULL,
                    `name` char(10) NOT NULL,
                    `nick` char(10) NOT NULL,
                    `content` text NOT NULL,
                    `regist_day` char(20) DEFAULT NULL,
                    PRIMARY KEY (`num`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                break;

            default:
                echo "<script>alert('해당 테이블이 존재하지 않는다.');</script>";
                break;
        } //switch
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('{$table_name}해당 테이블 생성됨.');</script>";
        } else {
            echo "테이블 생성 실패" . mysqli_error($con);
        }
    } //if(flag===false)


}

<?php
    session_start();
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: login.php');
        exit();
    }
?>
<!-- 声明文档类型为 HTML -->
<!DOCTYPE html>
<!-- HTML 页面开始 -->
<html>
	<head>
		<!-- 设置字符集为 UTF-8 -->
		<meta charset="utf-8" />
		<!-- 页面标题为空 -->
		<title>admin_video</title>
        <!-- 引入 CSS 样式文件 -->
		<link rel="stylesheet" href="css/admin_video.css">
	</head>
	<body>
        <form action="change_now_video.php" method="post"> 
            <?php
                $conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
                $sql_select = "SELECT * FROM video";
                $ret = mysqli_query($conn, $sql_select);
                $row = mysqli_fetch_all($ret);
                $sum = count($row);
                $power = $_SESSION['power'];
                for($i = 0; $i < $sum; $i++){
                    $name = $row[$i][0];
                    $situation = $row[$i][1];
                    if($situation == 0)
                        echo "<button class=\"video\" type=\"submit\" ";
                    else
                        echo "<p class=\"video_p\" style=\"background-color: orange;\"";
                    echo "name=\"1\" value=\"$name\"";
                    echo ">";
                    echo $name;
                    if($situation == 0){
                        echo "</button>";
                        //echo "<button>1</button>";
                        echo "<br>";
                    }
                    else{
                        echo "</p>";
                    }
                    if($i != $sum - 1)
                        echo "\n\t\t\t";
                    else
                        echo "\n";
                }
                mysqli_close($conn);
                echo "<input type=\"text\" style=\"display:none\" name=\"power\" value=\"$power\"></button>"
            ?>
        </form>
        <form action="delete_video.php" method="post">
            <div style="position:absolute; left:80%; top:1%">
                <?php
                    $conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
                    $sql_select = "SELECT * FROM video";
                    $ret = mysqli_query($conn, $sql_select);
                    $row = mysqli_fetch_all($ret);
                    $sum = count($row);
                    $power = $_SESSION['power'];
                    for($i = 0; $i < $sum; $i++){
                        $name = $row[$i][0];
                        $situation = $row[$i][1];
                        echo "<div ";
                        if($situation == 1)
                            echo "style=\"height:28px\" ";
                        echo "><button ";
                        if($situation == 0)
                            echo "type=\"submit\" ";
                        else
                            echo "type=\"button\" ";
                        if($situation == 1)
                            echo "class=\"delete\" ";
                        echo "name=\"1\" value=\"$name\">Del</button></div><br>";
                        if($i != $sum - 1)
                            echo "\n\t\t\t";
                        else
                            echo "\n";
                        }
                        mysqli_close($conn);
                        echo "<input type=\"text\" style=\"display:none\" name=\"power\" value=\"$power\"></button>"
                
                ?>
            </div>
        </form>
        <form action="download_video.php" method="post">
            <div style="position:absolute; left:85%; top:1%">
                <?php
                    $conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
                    $sql_select = "SELECT * FROM video";
                    $ret = mysqli_query($conn, $sql_select);
                    $row = mysqli_fetch_all($ret);
                    $sum = count($row);
                    $power = $_SESSION['power'];
                    for($i = 0; $i < $sum; $i++){
                        $name = $row[$i][0];
                        $situation = $row[$i][1];
                        echo "<div ";
                        if($situation == 1)
                            echo "style=\"height:28px\" ";
                        echo "><button ";
                        echo "type=\"submit\" ";
                        if($situation == 1)
                            echo "class=\"delete\" ";
                        echo "name=\"1\" value=\"$name\">Get</button></div><br>";
                        if($i != $sum - 1)
                            echo "\n\t\t\t";
                        else
                            echo "\n";
                        }
                        mysqli_close($conn);
                        echo "<input type=\"text\" style=\"display:none\" name=\"power\" value=\"$power\"></button>"
                
                ?>
            </div>
        </form>
        <br>
        <a href="add_video.php">点击上传视频</a>
        <br>
        <a href="index.php">点击回到视频界面</a>
	</body>

</html>
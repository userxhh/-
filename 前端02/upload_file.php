<?php
    //首先判断文件是否是视频
    $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    if ($ext != 'mp4' && $ext != 'avi' && $ext != 'mov' && $ext != 'mp3') {
        header("Location:add_video.php?err=1");
        exit();
    } 
    //其次判断文件是否已经在服务器中
    $filename = $_FILES["file"]["name"];
    $conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
    $sql_select = "SELECT * FROM video WHERE name = '$filename'";
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret);
    if($row['name'] == $filename){
        header("Location:add_video.php?err=2");
        exit();
    }
    //存储视频到文件部分
    if ($_FILES["file"]["error"] > 0){
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else{
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
        if (file_exists("upload/" . $_FILES["file"]["name"])){
            echo $_FILES["file"]["name"] . " already exists. ";
        }
        else{
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "video/" . $_FILES["file"]["name"]);
            echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
        }
    }
    //更新数据库内容
    $name = $_FILES["file"]["name"];
	$conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
    $sql_add = "INSERT into video (name,situation)values(\"$name\",0);";
	mysqli_query($conn, $sql_add);
    //返回
    mysqli_close($conn);
    header("Location:admin_video.php");
?>

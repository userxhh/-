<?php
    session_start();
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: login.php');
        exit();
    }
?>
<html>
<body>
    <form action="upload_file.php" method="post"
        enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file" /> 
        <br>
        <input type="submit" name="submit" value="Submit" />
    </form>
    <a href="admin_video.php">返回</a>
    <p colspan="2" style="color:red;font-size:10px;"> 
    <?php
        $err = isset($_GET["err"]) ? $_GET["err"] : "";
        switch ($err) {
            case 1:
                echo "文件类型不为视频或者音频";
                break;
            case 2:
                echo "视频已经存在于服务器中";
                break;
            } 
    ?>
    </p>
</body>
</html>
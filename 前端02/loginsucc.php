<?php
    session_start();
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>登录成功</title>
    <meta name="content-type";charset="UTF-8">
</head>
<body> 
    <div> 
        <?php
            // $Id:$ 
             //声明变量
            $username = isset($_GET['id']) ? $_GET['id'] : ""; //判断session是否为空
            $power = $_SESSION['power']; 
        if (!empty($username)) { 
        ?> 
    <h1>登录成功！</h1> 欢迎您！
        <?php
            echo $username; 
        ?> 
    <a href="index.php">跳转到播放界面</a>
    <br/> 
    <a href="login.php">退出</a> 
    <!-- 跳转至主网页 -->
        <?php
        } 
        else { //未登录，无权访问
        ?>
        <h1>你无权访问！！！</h1> 
            <?php
        } ?> 
    </div>
</body>
</html>

<?php
// $Id:$ //声明变量
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
//判断用户名和密码是否为空
if (!empty($username) && !empty($password)) { //建立连接
    $conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database'); //准备SQL语句
    $sql_select = "SELECT id,code,power FROM message WHERE id = '$username' AND code = '$password'"; //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret); //判断用户名或密码是否正确
    if ($username == $row['id'] && $password == $row['code']){ 
        $power = $row['power'];
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['power'] = $power;
        header("Location:loginsucc.php?id=$username"); //关闭数据库,跳转至loginsucc.php
        mysqli_close($conn);
    }
    else{ 
        //用户名或密码错误，赋值err为1
        header("Location:login.php?err=1");
    }
} else { //用户名或密码为空，赋值err为2
    header("Location:login.php?err=2");
} ?>

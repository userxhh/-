<?php
// $Id:$ //声明变量
$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$re_password = isset($_POST['re_password']) ? $_POST['re_password'] : "";
$admin = isset($_POST['admin']) ? $_POST['admin'] : "";
if ($password == $re_password) { //建立连接
    $conn = mysqli_connect("localhost", "root", "0poiuytrewq", "web_database"); //准备SQL语句,查询用户名
    $sql_select = "SELECT id FROM message WHERE id = '$username'"; //执行SQL语句
    $ret = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_array($ret); 
    $power = 'guest';
    if($admin == "on"){
        $power = 'admin';
    }
    //判断用户名是否已存在
    if ($username == $row['id']) { //用户名已存在，显示提示信息
        header("Location:register.php?err=1");
    } 
    else { //用户名不存在，插入数据 //准备SQL语句
        $sql_insert = "INSERT INTO message(id,code,power) VALUES('$username','$password','$power')"; //执行SQL语句
        mysqli_query($conn, $sql_insert);
        header("Location:register.php?err=3");
    } //关闭数据库
    mysqli_close($conn);
} else {
    header("Location:register.php?err=2");
} ?>

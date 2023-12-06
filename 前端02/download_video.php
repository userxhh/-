<?php
    $name = isset($_POST['1']) ? $_POST['1'] : "";
    $conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
    $power = isset($_POST['power']) ? $_POST['power'] : "";
    $file_url = 'video/' . $name; // 文件的URL

    // 设置HTTP头信息
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $name);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    // 将文件内容输出到输出缓冲区
    readfile($file_url);
?>
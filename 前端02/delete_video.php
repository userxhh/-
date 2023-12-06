<?php
    $name = isset($_POST['1']) ? $_POST['1'] : "";
	$conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
    $power = isset($_POST['power']) ? $_POST['power'] : "";
    $sql_delete = "DELETE FROM video WHERE name='$name';";
	mysqli_query($conn, $sql_delete);
    echo "power:";
    echo $power;
    echo " |here";
	mysqli_close($conn);
    $file = 'video/'.$name;
    if (file_exists($file)) {
        unlink($file);
        echo "文件已删除";
    } 
    else {
        echo "文件不存在";
    }
    header("Location:admin_video.php?power=$power");
?>
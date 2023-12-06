<?php
    $name = isset($_POST['1']) ? $_POST['1'] : "";
	$conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
    $power = isset($_POST['power']) ? $_POST['power'] : "";
    $sql_change = "UPDATE video set situation=0 where situation=1;";
	mysqli_query($conn, $sql_change);
    echo "power:";
    echo $power;
    echo " |here";
    $sql_change = "UPDATE video set situation=1 where name='$name';";
	mysqli_query($conn, $sql_change);
	mysqli_close($conn);
    header("Location:admin_video.php?power=$power");
?>
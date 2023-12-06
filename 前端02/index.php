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
		<!-- 引入 CSS 样式文件 -->
		<link rel="stylesheet" href="css/style.css">
		<!-- 页面标题为空 -->
		<title>myvideo</title>
	</head>
	<body>
	<!-- 视频播放器的外层容器 -->
	<input style="display:none;" id="power" value="<?php echo $_SESSION['power']?>">
	<div>
		<!-- 视频元素 -->
		<video id="myvideo"
		style="	position: absolute;
				width: 531px; 
				height: 300px;
				display: block;
				top: 50%;
				left: 30%;
				transform: translate(-50%,-50%);
				" poster = "img/pause.jpeg" autoplay loop>
			<!-- 视频源 -->
		    <source src = <?php
					$conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
					$sql_select = "SELECT * FROM video where situation = 1";
					$ret = mysqli_query($conn, $sql_select);
					$row = mysqli_fetch_all($ret);
					echo "\"video\\";
					echo $row[0][0];
					echo "\"";
					mysqli_close($conn);
				?>
				type="video/mp4">
			<!-- 当视频源无法播放时，显示提示信息 -->
		    <div>video element not supported.</div>
		</video>
		<!-- 显示播放速率的提示信息 -->
		<p style="	position: absolute;
					top: 70%;
					left: 15%;" id="p1">
					选择播放速率：
					 
		<!-- 播放速率的选择器 -->
		<select id="setRate">
		<option value="0.5">0.5</option>
		<option value="1" selected>1.0</option>
		<option value="1.25">1.25</option>
		<option value="1.5">1.5</option>
		<option value="2">2.0</option>
		</select>
		</p>
		<!-- 显示播放曲目的提示信息 -->
		<p style="	position: absolute;
					top: 75%;
					left: 15%;
					display:none" id="p3">
					选择播放曲目：
		<!-- 播放曲目的选择器 -->
		<select id="changeVideo">
			<?php
				$conn = mysqli_connect('localhost', 'root', '0poiuytrewq', 'web_database');
				$sql_select = "SELECT * FROM video";
				$ret = mysqli_query($conn, $sql_select);
				$row = mysqli_fetch_all($ret);
				$sum = count($row);
				for($i = 0; $i < $sum; $i++){
					echo "<option value=\"" ;
					echo $row[$i][0];
					echo "\"";
					if($row[$i][1] == 1)
						echo " selected>";
					else
						echo ">";
					echo $row[$i][0];
					echo "</option>";
				}
			?>
		</select>
		<br>
		<a href="admin_video.php" style="display:none" id="admin_video">点击此处修改列表</a>
		</p>
		<!-- 播放、暂停、音量加、音量减按钮 -->
		<button class="play" id="vplay">play</button>
		<button class="pause" id="vpause">pause</button>
		<button class="volplus" id="volplus">vol+</button>
		<button class="volminus" id="volminus">vol-</button>
		<!-- 音量条的外层容器 -->
		<div id="volbar" class="volbar">
		<!-- 音量条的初始值为 10 -->
		10
		</div>
		<!-- 音量条 -->
		<div  class="vol" id="volBar">
		</div>
		<!-- 音量条旁边的提示信息 -->
		<p style="	position: absolute;
					top: 59%;
					left: 60.6%;" id="p2">vol</p>
		<!-- 外部容器 -->
		<div class="wrappers" id = "proGress">
			<!-- 包裹进度条 -->
			<div class="wrapper">
				<!-- 进度条 -->
				<div id="progress">
					<!-- 进度条右边圆角 -->
					<div id="progress-bar"></div>
				</div>
			</div>
			<!-- 设置进度条默认显示 0-->
			<span id="show">0:0:0</span>
		</div>
	</div>
	</body>
	<script src="js/myScript.js"></script>
</html>
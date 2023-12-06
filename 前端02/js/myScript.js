// 获取id为'myvideo'的video元素,即为视频元素
let myvideo = document.getElementById('myvideo');
// 获取id为'vplay'的元素，播放按钮
let vplay = document.getElementById('vplay');
// 获取id为'vpause'的元素，暂停按钮
let vpause = document.getElementById('vpause')
// 获取id为'setRate'的元素，选择播放速率
let setRate = document.getElementById('setRate')
// 获取id为'changeVideo'的元素，更换视频内容
let changeVideo = document.getElementById('changeVideo')
// 获取id为'volbar'的元素，音量条
let volbar = document.getElementById('volbar')
// 获取id为'volBar'的元素，音量条的外部容器
let volBar = document.getElementById('volBar')
// 获取id为'volplus'的元素，音量加按钮
let volplus = document.getElementById('volplus')
// 获取id为'volminus'的元素，音量减按钮
let volminus = document.getElementById('volminus')
// 获取id为'progress'的元素，进度条
var progress = document.getElementById("progress");
// 获取id为'show'的元素，进度条的进度显示
var show = document.getElementById("show");
// 获取id为'progress-bar'的元素，右边的圆点
// 为进度条右侧圆点绑定鼠标按下事件
var progress_bar =  document.getElementById("progress-bar");
// 获取id为'proGress'的元素，进度条的外部容器
var proGress = document.getElementById("proGress");
// 获取id为'p1'的元素，更换播放速率的内容
let p1 = document.getElementById('p1')
// 获取id为'p2'的元素，音量条的提示信息
let p2 = document.getElementById('p2')
// 获取id为'p3'的元素，更换播放内容
let p3 = document.getElementById('p3')
// 获取id为'admin_video'的元素，更换播放列表
let admin_video = document.getElementById('admin_video')
// 初始化音量值为0.1
let vol = 1
// 获取视频总时长
var totalTime = myvideo.duration;
// 权限
var power = document.getElementById('power').value;

window.onload = function(){
	myvideo.oncanplay = function () {
		totalTime = myvideo.duration;
	}
	if(power == "admin" || power == "king"){
		p3.style.display='block';
		admin_video.style.display='block';
	}
}

myvideo.addEventListener("loadedmetadata", function() {
	if(power == "admin" || power == "king"){
		p3.style.display='block';
	}
	totalTime = myvideo.duration;
});

// 全屏函数，element为要全屏的元素
function fullScreen(element) {
    if (element.requestFullscreen)
        element.requestFullscreen();
    else if (element.mozRequestFullScreen)
        element.mozRequestFullScreen();
    else if (element.webkitRequestFullScreen)
        element.webkitRequestFullScreen();
}

// 退出全屏函数
function exitFullscreen() {
    var de = document;
    if (de.exitFullscreen) {
        de.exitFullscreen();
    } else if (de.mozCancelFullScreen) {
        de.mozCancelFullScreen();
    } else if (de.webkitCancelFullScreen) {
        de.webkitCancelFullScreen();
    }
}

// 单击视频事件，实现全屏和退出全屏
myvideo.onclick = function(){
	var isFullScreen = document.fullscreen || document.mozFullScreen || document.webkitIsFullScreen;
	isFullScreen == undefined ? false : isFullScreen;
	if(!isFullScreen){
		fullScreen(myvideo);
	}
	else{
		exitFullscreen();
	}
}

// 监听键盘事件，空格键实现播放/暂停视频
document.onkeydown = function(event){
	var e = event || window.event || arguments.callee.caller.arguments[0];
    if(e && e.keyCode == 32){ // 按空格
		if(!(myvideo.paused || myvideo.ended || myvideo.seeking || myvideo.readyState < myvideo.HAVE_FUTURE_DATA))
			myvideo.pause();
		else
			myvideo.play();
    }
};
		
// 绑定'播放'按钮的点击事件，使视频开始播放
vplay.addEventListener('click',function(){
    myvideo.play();
	console.log('play');
	myvideo.volume = vol * 0.1;
});

// 监听暂停按钮，点击后暂停视频
vpause.addEventListener('click',function(){
	myvideo.pause();
})

// 监听倍速按钮，切换视频的播放速度
setRate.addEventListener('change',function (){
	var index = setRate.selectedIndex;
	myvideo.playbackRate = setRate.options[index].value;
	myvideo.play();
});

// 监听视频列表，切换当前播放的视频
changeVideo.addEventListener('change',function (){
	var index = changeVideo.selectedIndex;
	var src = 'video/' + changeVideo.options[index].value;

	myvideo.setAttribute("src",src);
	myvideo.addEventListener("loadedmetadata", function() {
		totalTime = myvideo.duration;
	});
	myvideo.play();
	myvideo.volume = vol * 0.1;
});

//监听音量加键，增加视频音量
volplus.addEventListener('click',function(){
	vol += (vol !== 10);
	myvideo.volume = vol / 10;
	volbar.style.height = vol * 2 + '%';
	volbar.style.top = 60.2 - vol * 2 + '%';
	volbar.innerHTML = (10 * vol).toFixed(0);
});

//监听音量减键，减少视频音量
volminus.addEventListener('click',function(){
	vol -= (vol !== 0);
	myvideo.volume = vol / 10;
	volbar.style.height = vol * 2 + '%';
	volbar.style.top = 60.2 - vol * 2 + '%';
	if(vol !== 0)
		volbar.innerHTML = (10 * vol).toFixed(0);
	else
		volbar.innerHTML = '';
});

//进度条右侧原点点击的事件
progress_bar.onmousedown = function(){
	myvideo.play();
	console.log(myvideo.duration);
	totalTime = myvideo.duration;
	var nowTime = 0;
	var progressLeft = event.clientX - this.offsetLeft;
	//移动事件
    document.onmousemove = function(event){
		event = window.event || event;
		// 获取鼠标坐标
		var progressX = event.clientX - progressLeft;
		if(progressX <= 0){
			// 暂停拖动（如果拖动条超出范围，则停止拖动）
			progressX = 0;
		}
		else if(progressX >= 800){
			progressX = 800;
		}
		progress_bar.style.left = progressX + "px";
		// 显示进度条
		progress.style.width = progressX + "px";
		// 计算应该切到多少时间
		nowTime = totalTime * progressX / 800;
		var hour = Math.floor(nowTime / 3600);
		var minute = Math.floor((nowTime % 3600) / 60)
		var second = Math.floor((nowTime % 3600) % 60)
		// 显示进度条百分比
		show.innerHTML = hour + ':' + minute + ':' + second;
	};
    // 为右侧圆点绑定鼠标抬起事件
    document.onmouseup = function(){
		// 取消鼠标移动事件
		document.onmousemove = null;
		// 取消鼠标抬起事件
		document.onmouseup = null;
		myvideo.currentTime = nowTime;
    };
    //取消浏览器对拖拽内容进行搜索的默认行为
	return false;
};

//使用事件监听方式捕捉事件， 此事件可作为实时监测video 播放状态
myvideo.addEventListener("timeupdate",function(){
    var nowTime;
    //用秒数来显示当前播放进度
    nowTime = Math.floor(myvideo.currentTime);
	var hour = Math.floor(nowTime / 3600);
	var minute = Math.floor((nowTime % 3600) / 60)
	var second = Math.floor((nowTime % 3600) % 60)
	show.innerHTML = hour + ':' + minute + ':' + second;
	var progressX = nowTime * 800 / totalTime;
	progress_bar.style.left = progressX + "px";
	// 显示进度条
	progress.style.width = progressX + "px";
},false);

function watchWindowSize() {
	// 获取窗口的宽度和高度，不包括滚动条
	var w = document.documentElement.clientWidth;
	var h = document.documentElement.clientHeight;
	// 打印结果
	console.log("宽: " + w + ", " + "高: " + h);
	if(w < 950){
		volBar.style.display="none";
		volbar.style.display="none";
		p2.style.display="none";
		volplus.style.display="none";
		volminus.style.display="none";
		vplay.style.display="none";
		vpause.style.display="none";
		myvideo.style.left="50%";
	}
	else{
		volBar.style.display="block";
		volbar.style.display="block";
		p2.style.display="block";
		volplus.style.display="block";
		volminus.style.display="block";
		vplay.style.display="block";
		vpause.style.display="block";
		myvideo.style.left="30%";
	}
}

window.addEventListener("resize", watchWindowSize);
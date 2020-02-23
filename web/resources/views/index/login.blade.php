<?php
use App\Helper\Assets;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>集团后台登陆</title>
<link rel="stylesheet" type="text/css" href="<?=Assets::css('index/login.css')?>" />
<style>
body {
	height: 100%;
	background: #16a085;
	overflow: hidden;
}

.alert {
	color: #a94442;
	background-color: #f2dede;
	border-color: #ebccd1;
	padding: 15px;
	border: 1px solid transparent;
}

.geetest_slicebg canvas {
	z-index: 10;
}
</style>
</head>
<body>
	<dl class="admin_login">
		<form id="login_form" method="post">
			<dt>
				<strong>日志后台管理系统</strong>
				<em>Management System</em>
			</dt>
			<div class="alert" style="display: none;">用户名或密码错误</div>
			<dd class="user_icon">
				<input type="text" name="username" placeholder="账号" class="login_txtbx" />
			</dd>
			<dd class="pwd_icon">
				<input type="password" name="password" placeholder="密码" class="login_txtbx" />
			</dd>
			<dd class="val_icon">
				<div class="checkcode">
					<div id="embed-captcha"></div>
					<p id="wait" class="show">正在加载验证码......</p>
					<p id="notice" class="hide">请先完成验证</p>
				</div>
			</dd>
			<dd>
				<input type="submit" value="立即登陆" class="submit_btn" />
			</dd>
			<dd>
				<p>© 2019-<?=date('Y')?></p>
			</dd>
		</form>
	</dl>
	<script src="<?=Assets::js('jquery.min.js')?>"></script>
	<script src="<?=Assets::js('Particleground.js')?>"></script>
	<script src="<?=Assets::js('jquery.md5.js')?>"></script>
	<script src="<?=Assets::js('gt.js')?>"></script>
	<script>
	$(document).ready(function() {
		  //粒子背景特效
		  $('body').particleground({
		    dotColor: '#5cbdaa',
		    lineColor: '#5cbdaa'
		  });
	});
	var handlerEmbed = function (captchaObj) {
		$(".submit_btn").click(function (e) {
			var validate = captchaObj.getValidate();
			if (!validate) {
				$("#notice")[0].className = "show";
				setTimeout(function () {
					$("#notice")[0].className = "hide";
				}, 2000);
				$('.alert').show().html('请点击验证');
				e.preventDefault();
			}

			var data = {
				username:$.trim($('#login_form input[name=username]').val()),
				password:$.md5($.trim($('#login_form input[name=password]').val())),
				geetest_challenge:$('#login_form input[name=geetest_challenge]').val(),
				geetest_validate:$('#login_form input[name=geetest_validate]').val(),
				geetest_seccode:$('#login_form input[name=geetest_seccode]').val(),
			};
			$.post('<?=url('index/login')?>',data,function(response){
				if(response.code==1)
				{
					window.location = '/';
				}
				else
				{
					$('.alert').show().html(response.message);
					captchaObj.reset();
				}
			});
			return false;
		});
		// 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
		captchaObj.appendTo("#embed-captcha");
		captchaObj.onReady(function () {
			$("#wait")[0].className = "hide";
		});
		// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
	};
	$.ajax({
		// 获取id，challenge，success（是否启用failback）
		url: "<?=url('index/code')?>?t=" + (new Date()).getTime(), // 加随机数防止缓存
		type: "get",
		dataType: "json",
		success: function (data) {
			// console.log(data);
			// 使用initGeetest接口
			// 参数1：配置参数
			// 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
			initGeetest({
				gt: data.data.gt,
				challenge: data.data.challenge,
				new_captcha: data.data.new_captcha,
				product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
				offline: !data.data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
				// 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
			}, handlerEmbed);
		}
	});
	</script>
</body>
</html>

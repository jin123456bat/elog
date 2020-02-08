<?php
use jin123456bat\assets;
use think\facade\Request;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title><?=$setting['site_title']?> | <?=$setting['site_desc']?></title>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('panel.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=assets::css('progress.css')?>" type="text/css" media="all" />
<!-- 当前页面使用的样式 -->
<link rel="stylesheet" href="<?=assets::css('admin/mine.css')?>" type="text/css" media="all" />
</head>
<body>
	{include file='common/header' /}
	<div class="container">
		{include file='common/sidebar' /}
		<div class="main">
			<div class="title">
				<div class="white-block">
					<div class="wall-block">
						<p><?=$menu_queue?></p>
					</div>
				</div>
			</div>
			<div class="body">
				<div class="white-block">
					<div class="top-tips">
						<div class="top-tips-title">操作提示</div>
						<div class="top-tips-body">
							<p>头像上传之后必须点击保存才可以生效,修改头像不需要密码验证</p>
							<p>修改密码必须填写旧密码和新密码</p>
							<p>密码不填写则不修改密码</p>
						</div>
					</div>
					<div class="line"></div>
					<form class="form" id="form" method="post" action="<?=url('admin/mine')?>">
						<div class="panel col-md-5 center-block">
							<div class="panel-head">
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">头像</label>
									<div class="col-md-7">
										<div class="circleProgress_wrapper center-block display-none">
											<div class="wrapper right">
												<div class="circleProgress rightcircle"></div>
											</div>
											<font id="loading">loading</font>
											<div class="wrapper left">
												<div class="circleProgress leftcircle"></div>
											</div>
										</div>
										<img id="upload_gravatar" data-url="<?=url('common/component/upload')?>" class="image circle border center-block" style="width: 100px; height: 100px;" src="<?=!empty($user['gravatar_url'])?$user['gravatar_url']:''?>" onerror="this.src='<?=assets::common('plus.png','image')?>';">
										<input type="hidden" name="gravatar" value="<?=$user['gravatar']?>">
									</div>
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">旧登陆密码</label>
									<input type="text" class="input_text col-md-7" name="old_password" placeholder="旧登陆密码">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">新登陆密码</label>
									<input type="text" class="input_text col-md-7" name="new_password" placeholder="新登陆密码">
								</div>
							</div>
						</div>
						<div class="form-submit">
							<div class="center-block submit-body">
								<button type="submit" class="button button-submit button-large">保存</button>
								<button type="reset" class="button button-cancel button-large">重置</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	{include file='common/footer' /}
	<!-- 通用js -->
	<script type="text/javascript" src="<?=assets::common('jquery.min.js','js')?>"></script>
	<!-- 全局js调用 -->
	<script type="text/javascript" src="<?=assets::js('global.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('spop.min.js')?>"></script>
	<!-- 当前页面使用插件的js -->
	<script type="text/javascript" src="<?=assets::js('button.loading.js')?>"></script>
	<script type="text/javascript" src="<?=assets::js('jquery.md5.js')?>"></script>
	<script>
$.ajaxSetup({
	headers: {
        '__token__': '<?=Request::token('__token__')?>' ,
    },
});
</script>
	<!-- 当前页面独有的js -->
	<script type="text/javascript">
	$('#upload_gravatar').on('click',function(){
		var input = $('<input type="file">');
		var upload_image = $(this);
		input.on('change',function(){
			var file = $(this)[0].files[0];
			var formData = new FormData();
			formData.append('file',file);
			formData.append('type','gravatar');
			formData.append('imagesize','gravatar_preview');
			var xhr = new XMLHttpRequest();
			xhr.open('POST',upload_image.data('url'),true);
			xhr.upload.onloadstart = function(){
				//开始上传
				$('.circleProgress_wrapper').removeClass('display-none');
				$('.circleProgress_wrapper #loading').text('0%');
				upload_image.addClass('display-none');
			}
			xhr.upload.onprogress = function(event){
				//上传进度条
				if (event.lengthComputable) {
					$('.circleProgress_wrapper #loading').text(Math.round(event.loaded / event.total * 100) + "%");
				}
			};
			xhr.onload = function(){
				upload_image.removeClass('display-none');
				$('.circleProgress_wrapper').addClass('display-none');
				if(xhr.status == 200 && xhr.readyState == 4)
				{
					var response = xhr.response;
					response = $.parseJSON(response);
					if(response.code==1)
					{
						upload_image.attr('src',response.data.url);
						$('input[name=gravatar]').val(response.data.id);
					}
					else
					{
						spop({
						    template: response.message,
						    style: response.code==1?'success':'error',
						    autoclose: 3000,
						    position:'bottom-right',
						    icon:true,
						    group:false,
						});
					}
				}
			};
			xhr.send(formData);
		}).trigger('click');
		return false;
	});


	$('#form').on('submit',function(){
		var data = {
			gravatar:$('input[name=gravatar]').val(),
		};
		var old_password = $.trim($('input[name=old_password]').val());
		var new_password = $.trim($('input[name=new_password]').val());
		if(old_password.length>0 && new_password.length>0)
		{
			data.old_password = $.md5(old_password);
			data.new_password = $.md5(new_password);
		}
		
		$('#form .button-submit').loading('start');
		$.post($(this).attr('action'),data,function(response){
			$('#form .button-submit').loading('stop');
			spop({
			    template: response.message,
			    style: response.code==1?'success':'error',
			    autoclose: 3000,
			    position:'bottom-right',
			    icon:true,
			    group:false,
			    onClose:function(){
			    	window.location = response.data.url;
			    }
			});
		});
		return false;
	});
	</script>
</body>
</html>
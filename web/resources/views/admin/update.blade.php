<?php
use App\Helper\Assets;
use Illuminate\Support\Facades\Request;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>日志管理系统</title>
<!-- 所有页面使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('main.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('spop.min.css')?>" type="text/css" media="all" />
<!-- 当前页面的插件使用的样式 -->
<link rel="stylesheet" href="<?=Assets::css('form.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('button.loading.css')?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?=Assets::css('panel.css')?>" type="text/css" media="all" />
</head>
<body>
	@include('common.header')
	<div class="container">
		@include('common.sidebar')
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
							<p>超级管理员拥有全部权限</p>
						</div>
					</div>
					<div class="line"></div>
					<form class="form" id="form" method="post" action="<?=url('admin/update')?>?id=<?=Request::input('id')?>">
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">基础信息</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">用户名</label>
									<input type="text" class="input_text col-md-7" name="username" value="<?=$admin['username']?>" placeholder="登陆用户名" readonly="readonly">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">真实姓名</label>
									<input type="text" class="input_text col-md-7" name="realname" value="<?=$admin['realname']?>" placeholder="真实姓名">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">邮箱</label>
									<input type="text" class="input_text col-md-7" name="email" value="<?=$admin['email']?>" placeholder="邮箱">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">手机号码</label>
									<input type="text" class="input_text col-md-7" name="mobile" value="<?=$admin['mobile']?>" placeholder="手机号码">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">新密码</label>
									<input type="text" class="input_text col-md-7" name="password" placeholder="新密码">
								</div>
								<div class="form-group col-md-10">
									<label class="label col-md-2">锁定状态</label>
									<select class="select col-md-7" name="islock">
										<option value="0" <?=$admin['islock']==0?"selected":''?>>未锁定</option>
										<option value="1" <?=$admin['islock']==1?"selected":''?>>已锁定</option>
									</select>
								</div>
							</div>
						</div>
						<div class="line"></div>
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">权限</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-md-2 label">是否超管</label>
									<select class="col-md-7 select" name="issupper">
										<option value="0" <?=$admin['issupper']==0?"selected":''?>>否</option>
										<option value="1" <?=$admin['issupper']==1?"selected":''?>>是</option>
									</select>
								</div>
							</div>
						</div>
						<div class="line"></div>
						<div class="panel col-md-7 center-block">
							<div class="panel-head">
								<div class="panel-title">绑定微信号</div>
							</div>
							<div class="panel-body">
								<div class="form-group col-md-10">
									<label class="label col-md-2">绑定微信</label>
									<div class="qrcode col-md-3" style="width: 100px;">
										<img class="gravatar" src="<?=$qrcode?>" style="width: 100px;">
										<div class="nickname" style="text-align: center; font-size: 12px;">微信扫描二维码</div>
										<input type="hidden" name="wechat_info" value="">
										<button data-image="<?=$qrcode?>" class="button button-xs col-md-10 wechat_bind_delete display-none" style="margin: 5px 0px;">解除绑定</button>
									</div>
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
	@include('common.footer')
<!-- 通用js -->
<script type="text/javascript" src="<?=Assets::js('jquery.min.js')?>"></script>
<!-- 全局js调用 -->
<script type="text/javascript" src="<?=Assets::js('global.js')?>"></script>
<script type="text/javascript" src="<?=Assets::js('spop.min.js')?>"></script>
<!-- 当前页面使用插件的js -->
<script type="text/javascript" src="<?=Assets::js('button.loading.js')?>"></script>
<script type="text/javascript" src="<?=Assets::js('jquery.md5.js')?>"></script>
<script type="text/javascript" src="<?=Assets::js('jquery.validate.min.js')?>"></script>
<script type="text/javascript" src="<?=Assets::js('messages_zh.min.js')?>"></script>
<script type="text/javascript" src="<?=Assets::js('socket.io.js')?>"></script>
<script type="text/javascript" src="<?=Assets::js('websocket.js')?>"></script>
<!-- 当前页面独有的js -->
<script type="text/javascript">
$(function(){
    websocket.join('','company_admin_bind_wechat',{
		qrcode_id:'<?=$qrcode_id?>'
	});
    websocket.on('user_qrcode_info',function(response){
        if(response.subscribe == 0)
		{
			$('.qrcode .gravatar').remove();
			$('.qrcode .nickname').html('成功绑定微信');
		}
		else
		{
			$('.qrcode .gravatar').attr('src',response.headimgurl);
			$('.qrcode .nickname').html(response.nickname);
		}
		$('input[name=wechat_info]').val(JSON.stringify(response));
		$('.wechat_bind_delete').removeClass('display-none');
    });

	$('.wechat_bind_delete').on('click',function(){
		$('input[name=wechat_info]').val('');
		$('.nickname').html('微信扫描二维码');
		$('.gravatar').attr('src',$(this).data('image'));
		$(this).addClass('display-none');
		return false;
	});

	// 手机号
	jQuery.validator.addMethod("mobile", function(value, element) {
		var tel = /^1[34578]\d{9}$/;
		return this.optional(element) || (tel.test(value));
	}, "请填写正确的手机号码");

	$('#form').validate({
		rules : {
			username : {
				required : true,
				maxlength : 32,
			},
			realname : {
				required : true,
			},
			email : {
				required : true,
				email : true,
			},
			mobile : {
				required : true,
				mobile : true,
			},
		},
		errorPlacement : function(error, element) {
			if (element.attr('name') == 'issupper') {
				error.css({
					color : '#f4516c',
					marginTop : '0.2rem',
					fontSize : '0.85rem',
					fontFamily : 'Poppins',
					lineHeight : '1.5',
					paddingLeft : '5px',
				}).removeClass('col-offset-2');
				if (element.parents('.panel').find(
						'.panel-title label').length == 0) {
					error.appendTo(element.parents('.panel').find(
							'.panel-title'));
				}
			} else {
				error.css({
					color : '#f4516c',
					marginTop : '0.2rem',
					fontSize : '0.85rem',
					fontFamily : 'Poppins',
					lineHeight : '1.5',
					paddingLeft : '5px',
				});
				error.appendTo(element.parent());
			}
		},
		focusInvalid : true,
		errorClass : 'col-offset-2 error',
		success : function(error, element) {
			if ($(element).attr('name') == 'issupper') {
				$(element).parents('.panel').css({
					border : '',
					borderRadius : '',
				});
				$(element).parents('.panel').find(
						'.panel-title label').remove();
			} else {
				error.remove();
			}
		},
		highlight : function(element, b, c) {
			if ($(element).attr('name') == 'issupper') {
				$(element).parents('.panel').css({
					border : '1px solid #f4516c',
					borderRadius : '3px',
				});
			} else {
				$(element).css({
					borderColor : '#f4516c'
				});
			}
		},
		submitHandler : function(form) {
			var data = {
				username:$.trim($(form).find('input[name=username]').val()),
				realname:$.trim($(form).find('input[name=realname]').val()),
				email:$.trim($(form).find('input[name=email]').val()),
				mobile:$.trim($(form).find('input[name=mobile]').val()),
				password:$.md5($.trim($(form).find('input[name=password]').val())),
				islock:$(form).find('select[name=islock]').val(),
				issupper:$(form).find('select[name=issupper]').val(),
				islock:$(form).find('select[name=islock]').val(),
				wechat_info:$(form).find('input[name=wechat_info]').val(),
			};
			$(form).find('.button-submit').loading('start');
			$.post($(form).attr('action'),data,function(response){
				$(form).find('.button-submit').loading('stop');
				if(response.code==1)
				{
					window.location = '/admin/index';
				}
				else
				{
					spop({
					    template: response.message,
					    style: response.code==1?'success':'error',
					    autoclose: 5000,
					    position:'bottom-right',
					    icon:true,
					    group:false,
					});
				}
			});
			return false;
		}
	});
});
</script>
</body>
</html>